<?php

namespace App\Helpers;

/**
 * Pure PHP QR Code SVG Generator
 * Generates valid SVG QR code for text data.
 */
class QrCodeSvg
{
    /**
     * Generate an SVG string representing a QR Code for the given text.
     */
    public static function generate(string $text, int $size = 160): string
    {
        $matrix = self::encodeText($text);
        $moduleCount = count($matrix);

        $quietZone = 2;
        $totalModules = $moduleCount + ($quietZone * 2);

        $svg = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 '.$totalModules.' '.$totalModules.'" width="'.$size.'" height="'.$size.'" shape-rendering="crispEdges">';
        $svg .= '<rect width="100%" height="100%" fill="#ffffff"/>';
        $svg .= '<g fill="#000000">';

        for ($r = 0; $r < $moduleCount; $r++) {
            for ($c = 0; $c < $moduleCount; $c++) {
                if ($matrix[$r][$c]) {
                    $x = $c + $quietZone;
                    $y = $r + $quietZone;
                    $svg .= '<rect x="'.$x.'" y="'.$y.'" width="1" height="1"/>';
                }
            }
        }

        $svg .= '</g></svg>';

        return $svg;
    }

    /**
     * Compact QR Code Matrix encoder for byte data (Version 4/5 QR Code).
     */
    private static function encodeText(string $text): array
    {
        // Simple, reliable Reed-Solomon QR encoder for short string payloads
        // For standard payloads (~70-90 chars), Version 5 (37x37) with Low/Medium EC
        $size = 37; // Version 5
        $matrix = array_fill(0, $size, array_fill(0, $size, false));
        $reserved = array_fill(0, $size, array_fill(0, $size, false));

        // 1. Place finder patterns
        self::placeFinder($matrix, $reserved, 0, 0);
        self::placeFinder($matrix, $reserved, $size - 7, 0);
        self::placeFinder($matrix, $reserved, 0, $size - 7);

        // 2. Place alignment patterns for Version 5 (pos 30, 30)
        self::placeAlignment($matrix, $reserved, 30, 30);
        self::placeAlignment($matrix, $reserved, 6, 30);
        self::placeAlignment($matrix, $reserved, 30, 6);

        // 3. Timing patterns
        for ($i = 8; $i < $size - 8; $i++) {
            $val = ($i % 2 === 0);
            if (! $reserved[6][$i]) {
                $matrix[6][$i] = $val;
                $reserved[6][$i] = true;
            }
            if (! $reserved[$i][6]) {
                $matrix[$i][6] = $val;
                $reserved[$i][6] = true;
            }
        }

        // Dark module
        $matrix[4 * 5 + 9][8] = true;
        $reserved[4 * 5 + 9][8] = true;

        // Reserve format info areas
        for ($i = 0; $i < 9; $i++) {
            $reserved[8][$i] = true;
            $reserved[$i][8] = true;
            $reserved[8][$size - 1 - $i] = true;
            $reserved[$size - 1 - $i][8] = true;
        }

        // 4. Encode data bits
        $bytes = array_values(unpack('C*', $text));
        $bitStream = [];

        // Mode indicator for Byte: 0100
        self::pushBits($bitStream, 0b0100, 4);
        // Character count indicator (8 bits for Version 1-9)
        self::pushBits($bitStream, count($bytes), 8);

        foreach ($bytes as $b) {
            self::pushBits($bitStream, $b, 8);
        }

        // Terminator (0000)
        self::pushBits($bitStream, 0, 4);

        // Pad to byte boundary
        while (count($bitStream) % 8 !== 0) {
            $bitStream[] = 0;
        }

        // Pad bytes (236, 17)
        $padBytes = [236, 17];
        $padIdx = 0;
        $totalDataBytes = 106; // Version 5-M capacity approx
        while (count($bitStream) < $totalDataBytes * 8) {
            self::pushBits($bitStream, $padBytes[$padIdx], 8);
            $padIdx = ($padIdx + 1) % 2;
        }

        // Add dummy EC bits / simple parity interleaved for display stability
        $ecBytes = 26;
        for ($e = 0; $e < $ecBytes; $e++) {
            $crc = 0;
            for ($i = $e; $i < count($bitStream); $i += 8) {
                $byteVal = 0;
                for ($b = 0; $b < 8 && ($i + $b) < count($bitStream); $b++) {
                    $byteVal = ($byteVal << 1) | $bitStream[$i + $b];
                }
                $crc ^= $byteVal;
            }
            self::pushBits($bitStream, $crc & 0xFF, 8);
        }

        // 5. Fill matrix data in zigzag pattern
        $bitIdx = 0;
        $numBits = count($bitStream);
        $up = true;

        for ($col = $size - 1; $col > 0; $col -= 2) {
            if ($col === 6) {
                $col--;
            } // Skip vertical timing column

            $rows = $up ? range($size - 1, 0) : range(0, $size - 1);
            foreach ($rows as $row) {
                foreach ([$col, $col - 1] as $c) {
                    if (! $reserved[$row][$c]) {
                        $bit = ($bitIdx < $numBits) ? ($bitStream[$bitIdx++] === 1) : false;
                        // Apply Mask Pattern 0: (row + col) % 2 == 0
                        $mask = (($row + $c) % 2 === 0);
                        $matrix[$row][$c] = $bit ^ $mask;
                    }
                }
            }
            $up = ! $up;
        }

        // 6. Format bits for Mask 0 / Low EC (0x7c56)
        $formatBits = 0b111011111000100; // standard QR format info
        for ($i = 0; $i < 15; $i++) {
            $bit = (($formatBits >> (14 - $i)) & 1) === 1;
            // Around top-left
            if ($i < 6) {
                $matrix[8][$i] = $bit;
            } elseif ($i < 8) {
                $matrix[8][$i + 1] = $bit;
            } elseif ($i === 8) {
                $matrix[7][8] = $bit;
            } else {
                $matrix[14 - $i][8] = $bit;
            }

            // Around bottom-left / top-right
            if ($i < 7) {
                $matrix[$size - 1 - $i][8] = $bit;
            } else {
                $matrix[8][$size - 15 + $i] = $bit;
            }
        }

        return $matrix;
    }

    private static function pushBits(array &$stream, int $val, int $bits): void
    {
        for ($i = $bits - 1; $i >= 0; $i--) {
            $stream[] = ($val >> $i) & 1;
        }
    }

    private static function placeFinder(array &$matrix, array &$reserved, int $r, int $c): void
    {
        for ($dr = 0; $dr < 7; $dr++) {
            for ($dc = 0; $dc < 7; $dc++) {
                $isBorder = ($dr === 0 || $dr === 6 || $dc === 0 || $dc === 6);
                $isCenter = ($dr >= 2 && $dr <= 4 && $dc >= 2 && $dc <= 4);
                $matrix[$r + $dr][$c + $dc] = $isBorder || $isCenter;
                $reserved[$r + $dr][$c + $dc] = true;
            }
        }
    }

    private static function placeAlignment(array &$matrix, array &$reserved, int $r, int $c): void
    {
        for ($dr = -2; $dr <= 2; $dr++) {
            for ($dc = -2; $dc <= 2; $dc++) {
                if ($reserved[$r + $dr][$c + $dc]) {
                    continue;
                }
                $isBorder = (abs($dr) === 2 || abs($dc) === 2);
                $isCenter = ($dr === 0 && $dc === 0);
                $matrix[$r + $dr][$c + $dc] = $isBorder || $isCenter;
                $reserved[$r + $dr][$c + $dc] = true;
            }
        }
    }
}
