<?php

require 'vendor/autoload.php';

use chillerlan\QRCode\QRCode;
use chillerlan\QRCode\QROptions;

$options = new QROptions([
    'outputType' => QRCode::OUTPUT_MARKUP_SVG,
    'eccLevel' => QRCode::ECC_L,
    'addQuietzone' => true,
    'quietzoneSize' => 4,
    'svgWidth' => '130',
    'svgHeight' => '130',
    'xmlDeclaration' => false,
]);

$qr = new QRCode($options);
echo $qr->render('qrlogin|5|somehash');
