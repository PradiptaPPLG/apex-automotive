<?php $__env->startSection('title', $car->exists ? 'Edit Mobil Showroom' : 'Tambah Mobil Showroom Baru'); ?>
<?php $__env->startSection('page_header', $car->exists ? 'Edit Mobil: '.$car->name : 'Tambah Mobil Showroom Baru'); ?>

<?php $__env->startSection('content'); ?>
<div style="max-width: 1400px; margin: 0 auto;">
    <form id="carForm" method="POST" action="<?php echo e($car->exists ? route('manager.cars.update', $car) : route('manager.cars.store')); ?>" enctype="multipart/form-data" style="display: flex; flex-direction: column; gap: 40px;">
        <?php echo csrf_field(); ?>
        <?php if($car->exists): ?>
            <?php echo method_field('PUT'); ?>
        <?php endif; ?>
        
        <!-- KOLOM KIRI (GENERAL INFO) -->
        <div class="card-panel" style="display: flex; flex-direction: column; gap: 20px;">

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px;">
                <?php
                    $primaryVariant = $car->variants ? $car->variants->where('type', 'primer')->first() : null;
                ?>
                <div style="position: relative;">
                    <label style="display: block; font-family: 'Space Mono', monospace; font-size: 11px; color: var(--text-muted); text-transform: uppercase; margin-bottom: 6px;">Nama Unit / Model <span style="color:#ef4444;">*</span></label>
                    <input type="text" name="name" id="carNameInput" value="<?php echo e(old('name', $car->name)); ?>" required placeholder="Contoh: McLaren Senna GTR" class="mgr-input" autocomplete="off">
                    <div id="carSuggestions" style="position: absolute; top: 100%; left: 0; right: 0; background: var(--bg-card, #1a1a2e); background-color: var(--bg-card, #1a1a2e); border: 1px solid var(--border); border-radius: 4px; z-index: 9999; display: none; max-height: 260px; overflow-y: auto; margin-top: 4px; box-shadow: 0 8px 32px rgba(0,0,0,0.7); isolation: isolate;"></div>
                    <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <span style="color: #f87171; font-size: 11px; margin-top: 4px; display: block;"><?php echo e($message); ?></span>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <div>
                    <label style="display: block; font-family: 'Space Mono', monospace; font-size: 11px; color: var(--text-muted); text-transform: uppercase; margin-bottom: 6px;">Brand / Manufacturer</label>
                    <input type="text" name="brand" id="carBrandInput" value="<?php echo e(old('brand', $car->brand)); ?>" placeholder="Contoh: McLaren Automotive" class="mgr-input">
                </div>
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 16px;">
                <div>
                    <label style="display: block; font-family: 'Space Mono', monospace; font-size: 11px; color: var(--text-muted); text-transform: uppercase; margin-bottom: 6px;">Kategori <span style="color:#ef4444;">*</span></label>
                    <select name="category" required class="mgr-select">
                        <option value="Hypercar"   <?php echo e(old('category', $car->category) == 'Hypercar'    ? 'selected' : ''); ?>>Hypercar</option>
                        <option value="Supercar"   <?php echo e(old('category', $car->category) == 'Supercar'    ? 'selected' : ''); ?>>Supercar</option>
                        <option value="Luxury SUV" <?php echo e(old('category', $car->category) == 'Luxury SUV'  ? 'selected' : ''); ?>>Luxury SUV</option>
                        <option value="Grand Tourer" <?php echo e(old('category', $car->category) == 'Grand Tourer' ? 'selected' : ''); ?>>Grand Tourer</option>
                    </select>
                </div>

                <div>
                    <label style="display: block; font-family: 'Space Mono', monospace; font-size: 11px; color: var(--text-muted); text-transform: uppercase; margin-bottom: 6px;">Harga Estimasi (IDR) <span style="color:#ef4444;">*</span></label>
                    <input type="text" id="price_display" value="<?php echo e(old('price', $car->price) ? number_format(old('price', $car->price), 0, ',', '.') : ''); ?>" required placeholder="Contoh: 25.000.000.000" class="mgr-input" oninput="formatPrice(this)">
                    <input type="hidden" name="price" id="price_hidden" value="<?php echo e(old('price', $car->price)); ?>">
                </div>

                <div>
                    <label style="display: block; font-family: 'Space Mono', monospace; font-size: 11px; color: var(--text-muted); text-transform: uppercase; margin-bottom: 6px;">Tahun</label>
                    <input type="number" name="year" value="<?php echo e(old('year', $car->year ?? date('Y'))); ?>" placeholder="2026" class="mgr-input">
                </div>
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 16px;">
                <div>
                    <label style="display: block; font-family: 'Space Mono', monospace; font-size: 11px; color: var(--text-muted); text-transform: uppercase; margin-bottom: 6px;">Transmisi</label>
                    <input type="text" name="transmission" value="<?php echo e(old('transmission', $car->transmission)); ?>" placeholder="7-Speed Dual Clutch" class="mgr-input">
                </div>

                <div>
                    <label style="display: block; font-family: 'Space Mono', monospace; font-size: 11px; color: var(--text-muted); text-transform: uppercase; margin-bottom: 6px;">Bahan Bakar</label>
                    <input type="text" name="fuel_type" value="<?php echo e(old('fuel_type', $car->fuel_type)); ?>" placeholder="V8 Twin-Turbo / Hybrid" class="mgr-input">
                </div>

                <div>
                    <label style="display: block; font-family: 'Space Mono', monospace; font-size: 11px; color: var(--text-muted); text-transform: uppercase; margin-bottom: 6px;">Status Ketersediaan <span style="color:#ef4444;">*</span></label>
                    <select name="status" required class="mgr-select">
                        <option value="available" <?php echo e(old('status', $car->status) == 'available' ? 'selected' : ''); ?>>Available (Tersedia)</option>
                        <option value="reserved"  <?php echo e(old('status', $car->status) == 'reserved'  ? 'selected' : ''); ?>>Reserved (Dipesan)</option>
                        <option value="sold"      <?php echo e(old('status', $car->status) == 'sold'      ? 'selected' : ''); ?>>Sold (Terjual)</option>
                    </select>
                </div>
            </div>

            <!-- Upload Gambar Section -->
            <div style="background: var(--bg-hover); border: 1px dashed var(--border); padding: 18px; border-radius: 6px;">
                <label style="display: block; font-family: 'Space Mono', monospace; font-size: 11px; color: var(--text-muted); text-transform: uppercase; margin-bottom: 8px; font-weight: 700;">
                    <i class="fa-solid fa-image" style="color: #ef4444; margin-right: 4px;"></i> Upload Foto Utama Kendaraan
                </label>
                
                <div style="display: grid; grid-template-columns: 1fr 140px; gap: 16px; align-items: start;">
                        <div>
                            <span style="font-size: 11px; color: var(--text-muted); display: block; margin-bottom: 4px;">Pilih File Berkas Gambar</span>
                            <input type="file" name="image_file" accept="image/*" class="mgr-input" onchange="previewImageFile(this)" style="padding: 8px;">
                            <input type="hidden" name="image_url" value="<?php echo e(old('image_url', $car->image_url)); ?>">
                            <?php $__errorArgs = ['image_file'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <span style="color: #f87171; font-size: 11px; margin-top: 4px; display: block;"><?php echo e($message); ?></span>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            
                            <div style="display: grid; grid-template-columns: 50px 1fr 100px; gap: 10px; margin-top: 12px; align-items: center; border: 1px dashed rgba(255,255,255,0.1); padding: 10px; border-radius: 4px;">
                                <input type="color" name="primary_color_hex" value="<?php echo e(old('primary_color_hex', $primaryVariant->hex ?? '#ffffff')); ?>" onchange="updatePalettePreview()" style="width: 100%; height: 38px; padding: 2px; border: 1px solid var(--border); background: var(--bg-hover); border-radius: 4px; cursor: pointer;">
                                <input type="text" name="primary_color_name" value="<?php echo e(old('primary_color_name', $primaryVariant->name ?? '')); ?>" oninput="updatePalettePreview()" placeholder="Nama Warna Utama (Misal: Alpine White)" class="mgr-input">
                                <div style="display: flex; align-items: center; border: 1px solid var(--border); border-radius: 4px; background: var(--bg-hover); height: 38px; overflow: hidden;">
                                    <span style="font-size: 10px; font-family: monospace; color: var(--text-muted); padding: 0 6px;">STOCK</span>
                                    <input type="number" name="primary_stock" value="<?php echo e(old('primary_stock', $primaryVariant->stock ?? 0)); ?>" min="0" style="width: 100%; height: 100%; border: none; background: transparent; text-align: center; color: var(--text-heading); font-family: monospace; font-size: 12px; outline: none;">
                                </div>
                            </div>
                        </div>

                    <div>
                        <div id="imagePreviewContainer" onclick="if(document.getElementById('imagePreviewImg').src) openImageModal(document.getElementById('imagePreviewImg').src)" style="width: 140px; height: 95px; border-radius: 6px; overflow: hidden; background: #000; border: 1px solid var(--border); display: flex; align-items: center; justify-content: center; position: relative; cursor: pointer;">
                            <?php if($car->image_url): ?>
                                <img id="imagePreviewImg" src="<?php echo e($car->image_url); ?>" alt="Preview" style="width: 100%; height: 100%; object-fit: cover;">
                            <?php else: ?>
                                <div id="imagePreviewPlaceholder" style="text-align: center; color: var(--text-dim); font-size: 11px;">
                                    <i class="fa-solid fa-cloud-arrow-up" style="font-size: 20px; display: block; margin-bottom: 4px; color: #ef4444;"></i>
                                    Format JPG/PNG/WEBP
                                </div>
                                <img id="imagePreviewImg" src="" alt="Preview" style="width: 100%; height: 100%; object-fit: cover; display: none;">
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Varian Warna & Palet Warna Section -->
            <div style="background: rgba(255,255,255,0.02); border: 1px solid var(--border); padding: 18px; border-radius: 6px; margin-top: 4px;">
                <div style="margin-bottom: 14px;">
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 12px; padding-bottom: 10px; border-bottom: 1px dashed var(--border);">
                        <h4 style="margin: 0; font-family: 'Space Mono', monospace; font-size: 11px; text-transform: uppercase; letter-spacing: 1px; color: var(--text-heading); display: flex; align-items: center; gap: 8px;">
                            <i class="fa-solid fa-palette" style="color: #dc2626;"></i> Kelola Varian (Warna / Bodykit / Primer)
                        </h4>
                        <button type="button" onclick="addVariantRow()" style="padding: 6px 14px; background: #dc2626; color: #fff; border: none; border-radius: 4px; font-size: 11px; cursor: pointer; font-family: 'Space Mono', monospace; font-weight: 700;">
                            <i class="fa-solid fa-plus"></i> Tambah Varian
                        </button>
                    </div>
                    <p style="font-size: 12px; color: var(--text-muted); margin-top: 4px;">Kelola varian mobil beserta foto dan stoknya masing-masing. Tipe varian dapat berupa Warna, Bodykit, atau Primer.</p>

                    <!-- Quick Preset Buttons -->
                    <div style="display: flex; gap: 6px; flex-wrap: wrap; margin-top: 10px;">
                        <span style="font-size: 10px; font-family: 'Space Mono', monospace; color: var(--text-muted); align-self: center; margin-right: 4px;">PRESET WARNA:</span>
                        <button type="button" onclick="addVariantRow('Rosso Corsa Red', '#dc2626')" style="padding: 3px 8px; background: rgba(220,38,38,0.2); border: 1px solid #dc2626; color: #f87171; border-radius: 3px; font-size: 10px; cursor: pointer;">🔴 Rosso Corsa</button>
                        <button type="button" onclick="addVariantRow('Obsidian Black', '#111827')" style="padding: 3px 8px; background: rgba(17,24,39,0.5); border: 1px solid #4b5563; color: #d1d5db; border-radius: 3px; font-size: 10px; cursor: pointer;">⚫ Obsidian Black</button>
                        <button type="button" onclick="addVariantRow('Pearl White', '#f9fafb')" style="padding: 3px 8px; background: rgba(249,250,251,0.1); border: 1px solid #e5e7eb; color: #ffffff; border-radius: 3px; font-size: 10px; cursor: pointer;">⚪ Pearl White</button>
                        <button type="button" onclick="addVariantRow('Giallo Auge Yellow', '#f59e0b')" style="padding: 3px 8px; background: rgba(245,158,11,0.2); border: 1px solid #f59e0b; color: #fbbf24; border-radius: 3px; font-size: 10px; cursor: pointer;">🟡 Giallo Yellow</button>
                    </div>          </div>
                </div>

                <div id="variantsContainer" style="display: flex; flex-direction: column; gap: 10px;">
                    <?php
                        if (old('variant_names')) {
                            $existingVariants = array_map(function($t, $n, $h, $s, $i) { 
                                return ['type' => $t, 'name' => $n, 'hex' => $h, 'stock' => $s, 'image_url' => $i]; 
                            }, old('variant_types'), old('variant_names'), old('variant_hexes'), old('variant_stocks'), old('variant_images_existing'));
                        } else {
                            $existingVariants = $car->exists 
                                ? $car->variants()->where('type', '!=', 'primer')->get()->toArray() 
                                : [];
                        }

                        if (empty($existingVariants)) {
                            $existingVariants = [
                                ['type' => 'color', 'name' => 'Rosso Corsa Red', 'hex' => '#dc2626', 'stock' => 0, 'image_url' => null],
                            ];
                        }
                    ?>

                    <?php $__currentLoopData = $existingVariants; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="variant-row" style="display: grid; grid-template-columns: 100px 50px 1fr 100px 220px 40px; gap: 10px; align-items: center; border: 1px dashed var(--border); padding: 10px; border-radius: 4px;">
                            <select name="variant_types[<?php echo e($index); ?>]" class="mgr-input" style="height: 38px;" onchange="handleVariantTypeChange(this)">
                                <option value="color" <?php echo e((isset($v['type']) && $v['type'] == 'color') ? 'selected' : ''); ?>>Warna Tambahan</option>
                                <option value="bodykit" <?php echo e((isset($v['type']) && $v['type'] == 'bodykit') ? 'selected' : ''); ?>>Bodykit</option>
                            </select>
                            <div style="width: 100%; height: 38px; position: relative;">
                                <input type="color" name="variant_hexes[<?php echo e($index); ?>]" value="<?php echo e($v['hex'] ?? '#dc2626'); ?>" onchange="updatePalettePreview()" style="width: 100%; height: 100%; padding: 2px; border: 1px solid var(--border); background: var(--bg-hover); border-radius: 4px; cursor: pointer; <?php echo e((isset($v['type']) && $v['type'] == 'bodykit') ? 'display: none;' : ''); ?>">
                                <div class="bodykit-badge" style="width: 100%; height: 100%; background: var(--bg-hover); border: 1px solid var(--border); border-radius: 4px; display: <?php echo e((isset($v['type']) && $v['type'] == 'bodykit') ? 'flex' : 'none'); ?>; align-items: center; justify-content: center; font-size: 10px; font-family: monospace; font-weight: bold; color: var(--text-muted);">KIT</div>
                            </div>
                            <input type="text" name="variant_names[<?php echo e($index); ?>]" value="<?php echo e($v['name'] ?? ''); ?>" oninput="updatePalettePreview()" placeholder="Nama (misal: Rosso Corsa)" class="mgr-input">
                            <div style="display: flex; align-items: center; border: 1px solid var(--border); border-radius: 4px; background: var(--bg-hover); height: 38px; overflow: hidden;">
                                <span style="font-size: 10px; font-family: monospace; color: var(--text-muted); padding: 0 6px;">STOCK</span>
                                <input type="number" name="variant_stocks[<?php echo e($index); ?>]" value="<?php echo e($v['stock'] ?? 0); ?>" min="0" style="width: 100%; height: 100%; border: none; background: transparent; text-align: center; color: var(--text-heading); font-family: monospace; font-size: 12px; outline: none;">
                            </div>
                            <div style="display: flex; align-items: center; gap: 8px;">
                                <div onclick="if(this.querySelector('img').src) openImageModal(this.querySelector('img').src)" style="width: 38px; height: 38px; border-radius: 4px; border: 1px solid var(--border); overflow: hidden; background: var(--bg-card); flex-shrink: 0; display: flex; align-items: center; justify-content: center; cursor: pointer;">
                                    <img src="<?php echo e($v['image_url'] ?? ''); ?>" alt="" style="width: 100%; height: 100%; object-fit: cover; <?php echo e(empty($v['image_url']) ? 'display: none;' : ''); ?>" class="variant-img-preview">
                                    <div class="variant-img-placeholder" style="color: var(--text-dim); <?php echo e(!empty($v['image_url']) ? 'display: none;' : ''); ?>"><i class="fa-solid fa-image"></i></div>
                                </div>
                                <div style="flex: 1; display: flex; flex-direction: column; gap: 5px;">
                                    <input type="file" name="variant_images_upload[<?php echo e($index); ?>]" accept="image/*" class="mgr-input" style="padding: 5px; font-size: 11px;" onchange="previewVariantImage(this)">
                                    <input type="hidden" name="variant_images_existing[<?php echo e($index); ?>]" value="<?php echo e($v['image_url'] ?? ''); ?>">
                                </div>
                            </div>
                            <button type="button" onclick="removeVariantRow(this)" style="height: 38px; background: rgba(239,68,68,0.1); border: 1px solid rgba(239,68,68,0.2); color: #f87171; border-radius: 4px; cursor: pointer; display: flex; align-items: center; justify-content: center;">
                                <i class="fa-solid fa-trash-can"></i>
                            </button>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>

                <!-- Live Color Palette Dots Preview -->
                <div style="margin-top: 14px; padding-top: 12px; border-top: 1px border-dashed var(--border); display: flex; align-items: center; gap: 10px;">
                    <span style="font-size: 10px; font-family: 'Space Mono', monospace; color: var(--text-muted);">PREVIEW PALET DI POPUP:</span>
                    <div id="livePalettePreview" style="display: flex; gap: 8px; align-items: center;">
                        <!-- Injected live by JS -->
                    </div>
                </div>
            </div>

        </div> <!-- End of Left Column -->

        <!-- BAGIAN BAWAH (DOSSIER & SPECS) -->
        <div class="card-panel" style="display: flex; flex-direction: column; gap: 20px; border-top: 3px solid #ef4444;">
            <div style="border-bottom: 1px dashed var(--border); padding-bottom: 12px;">
                <h4 style="margin: 0; font-family: 'Space Mono', monospace; font-size: 12px; text-transform: uppercase; letter-spacing: 2px; color: #ef4444; display: flex; align-items: center; gap: 8px;">
                    <i class="fa-solid fa-file-lines"></i> OFFICIAL TECHNICAL DOSSIER
                </h4>
                <p style="font-size: 11px; color: var(--text-muted); margin-top: 6px;">Deskripsi unit dan spesifikasi teknis untuk halaman informasi detail.</p>
            </div>

            <?php
                $descData = [];
                if ($car->description) {
                    $parsed = json_decode($car->description, true);
                    if(json_last_error() === JSON_ERROR_NONE) {
                        $descData = $parsed;
                    } else {
                        // Fallback for old simple text
                        $descData['intro'] = $car->description;
                    }
                }
            ?>

            <div>
                <label style="display: block; font-family: 'Space Mono', monospace; font-size: 11px; color: var(--text-muted); text-transform: uppercase; margin-bottom: 6px;">Judul Dokumen (Title)</label>
                <input type="text" name="desc_title" value="<?php echo e(old('desc_title', $descData['title'] ?? '')); ?>" placeholder="Contoh: AUDI R8 V10 PERFORMANCE GT4 SPEC" class="mgr-input">
            </div>

            <div>
                <label style="display: block; font-family: 'Space Mono', monospace; font-size: 11px; color: var(--text-muted); text-transform: uppercase; margin-bottom: 6px;">Subjudul (Subtitle)</label>
                <input type="text" name="desc_subtitle" value="<?php echo e(old('desc_subtitle', $descData['subtitle'] ?? '')); ?>" placeholder="Contoh: Comprehensive Technical Blueprint & Official Manufacturer Specification Documentation" class="mgr-input">
            </div>

            <div>
                <label style="display: block; font-family: 'Space Mono', monospace; font-size: 11px; color: var(--text-muted); text-transform: uppercase; margin-bottom: 6px;">Overview & Ringkasan Desain (Intro)</label>
                <textarea name="desc_intro" rows="3" placeholder="Deskripsi umum tentang mobil..." class="mgr-input" style="resize: vertical;"><?php echo e(old('desc_intro', $descData['intro'] ?? '')); ?></textarea>
            </div>

            <div>
                <label style="display: block; font-family: 'Space Mono', monospace; font-size: 11px; color: var(--text-muted); text-transform: uppercase; margin-bottom: 6px;">Arsitektur Balap & Warisan Teknologi (History)</label>
                <textarea name="desc_history" rows="3" placeholder="Deskripsi teknis tentang sejarah atau pengembangan mesin..." class="mgr-input" style="resize: vertical;"><?php echo e(old('desc_history', $descData['history'] ?? '')); ?></textarea>
            </div>

            <!-- TABEL SPESIFIKASI DINAMIS -->
            <div style="background: rgba(255,255,255,0.02); border: 1px solid var(--border); padding: 18px; border-radius: 6px; margin-top: 4px;">
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 12px; padding-bottom: 10px; border-bottom: 1px dashed var(--border);">
                    <h4 style="margin: 0; font-family: 'Space Mono', monospace; font-size: 11px; text-transform: uppercase; letter-spacing: 1px; color: var(--text-heading); display: flex; align-items: center; gap: 8px;">
                        <i class="fa-solid fa-sliders"></i> Tabel Spesifikasi Teknis
                    </h4>
                    <button type="button" onclick="addSpecRow()" style="padding: 6px 14px; background: #dc2626; color: #fff; border: none; border-radius: 4px; font-size: 11px; cursor: pointer; font-family: 'Space Mono', monospace; font-weight: 700;">
                        <i class="fa-solid fa-plus"></i> Tambah Baris
                    </button>
                </div>
                <input type="hidden" name="specs_json" id="specs_json">

                <div id="specsContainer" style="display: flex; flex-direction: column; gap: 10px;">
                    <?php
                        $existingSpecs = [];
                        if (old('spec_keys')) {
                            $existingSpecs = array_map(function($k, $v, $i) { 
                                return ['key' => $k, 'val' => $v, 'icon' => $i]; 
                            }, old('spec_keys'), old('spec_vals'), old('spec_icons') ?? array_fill(0, count(old('spec_keys')), 'fa-circle-info'));
                        } else {
                            if ($car->exists && is_array($car->specs)) {
                                foreach($car->specs as $k => $v) {
                                    $specVal = is_array($v) ? ($v['val'] ?? '') : $v;
                                    $specIcon = is_array($v) ? ($v['icon'] ?? 'fa-circle-info') : 'fa-circle-info';
                                    $existingSpecs[] = ['key' => $k, 'val' => $specVal, 'icon' => $specIcon];
                                }
                            }
                        }

                        if (empty($existingSpecs)) {
                            $existingSpecs = [
                                ['key' => 'Mesin & Konfigurasi', 'val' => '', 'icon' => 'fa-engine'],
                                ['key' => 'Tenaga Maksimum', 'val' => '', 'icon' => 'fa-bolt'],
                            ];
                        }
                    ?>

                    <?php $__currentLoopData = $existingSpecs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="spec-row" style="display: grid; grid-template-columns: 1fr 1fr 140px 40px; gap: 10px; align-items: center;">
                            <input type="text" name="spec_keys[]" value="<?php echo e($s['key']); ?>" placeholder="Komponen (Misal: Mesin)" class="mgr-input">
                            <input type="text" name="spec_vals[]" value="<?php echo e($s['val']); ?>" placeholder="Spesifikasi (Misal: 5.2L V10)" class="mgr-input">
                            <select name="spec_icons[]" class="mgr-input" style="padding-left: 8px;">
                                <?php $curr = $s['icon'] ?? 'fa-circle-info'; ?>
                                <option value="fa-circle-info" <?php echo e($curr == 'fa-circle-info' ? 'selected' : ''); ?>>Info</option>
                                <option value="fa-bolt" <?php echo e($curr == 'fa-bolt' ? 'selected' : ''); ?>>Listrik / Power</option>
                                <option value="fa-gauge-high" <?php echo e($curr == 'fa-gauge-high' ? 'selected' : ''); ?>>Kecepatan</option>
                                <option value="fa-gears" <?php echo e($curr == 'fa-gears' ? 'selected' : ''); ?>>Mesin / Gigi</option>
                                <option value="fa-truck-monster" <?php echo e($curr == 'fa-truck-monster' ? 'selected' : ''); ?>>Drivetrain</option>
                                <option value="fa-weight-hanging" <?php echo e($curr == 'fa-weight-hanging' ? 'selected' : ''); ?>>Berat</option>
                                <option value="fa-wind" <?php echo e($curr == 'fa-wind' ? 'selected' : ''); ?>>Aerodinamika</option>
                                <option value="fa-tachometer-alt" <?php echo e($curr == 'fa-tachometer-alt' ? 'selected' : ''); ?>>Torsi / RPM</option>
                                <option value="fa-gas-pump" <?php echo e($curr == 'fa-gas-pump' ? 'selected' : ''); ?>>Bahan Bakar</option>
                                <option value="fa-battery-full" <?php echo e($curr == 'fa-battery-full' ? 'selected' : ''); ?>>Baterai</option>
                            </select>
                            <button type="button" onclick="this.closest('.spec-row').remove()" style="height: 38px; background: rgba(239,68,68,0.1); border: 1px solid rgba(239,68,68,0.2); color: #f87171; border-radius: 4px; cursor: pointer; display: flex; align-items: center; justify-content: center;">
                                <i class="fa-solid fa-trash-can"></i>
                            </button>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>

            <div style="display: flex; align-items: center; justify-content: flex-end; gap: 12px; margin-top: auto; border-top: 1px solid var(--border); padding-top: 16px;">
                <a href="<?php echo e(route('manager.cars.index')); ?>" style="padding: 10px 18px; background: var(--bg-hover); color: var(--text-muted); text-decoration: none; border-radius: 4px; font-size: 13px; border: 1px solid var(--border);">Batal</a>
                <button type="submit" style="padding: 10px 24px; background: #dc2626; color: #fff; border: none; font-family: 'Space Mono', monospace; font-size: 11px; font-weight: 700; text-transform: uppercase; border-radius: 4px; cursor: pointer;">
                    <?php echo e($car->exists ? 'Simpan Perubahan' : 'Tambah Mobil'); ?>

                </button>
            </div>
        </div>
    </form>
</div>

<!-- Full Image Preview Modal -->
<div id="fullImageModal" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.85); z-index: 9999; align-items: center; justify-content: center; backdrop-filter: blur(4px);">
    <div style="position: relative; max-width: 90%; max-height: 90%; background: #000; border-radius: 8px; overflow: hidden; box-shadow: 0 10px 25px rgba(0,0,0,0.5);">
        <button type="button" onclick="closeImageModal()" style="position: absolute; top: 10px; right: 10px; background: rgba(0,0,0,0.5); color: #fff; border: 1px solid rgba(255,255,255,0.2); width: 32px; height: 32px; border-radius: 50%; display: flex; align-items: center; justify-content: center; cursor: pointer; transition: background 0.2s;">
            <i class="fa-solid fa-xmark"></i>
        </button>
        <img id="fullImageModalImg" src="" alt="Full Preview" style="max-width: 100%; max-height: 85vh; display: block; object-fit: contain;">
    </div>
</div>

<script>
    function openImageModal(src) {
        if (!src || src.trim() === '' || src.endsWith('null') || src.includes('undefined')) return;
        const modal = document.getElementById('fullImageModal');
        const img = document.getElementById('fullImageModalImg');
        img.src = src;
        modal.style.display = 'flex';
    }

    function closeImageModal() {
        const modal = document.getElementById('fullImageModal');
        modal.style.display = 'none';
    }

    function previewImageFile(input) {
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const img = document.getElementById('imagePreviewImg');
                const placeholder = document.getElementById('imagePreviewPlaceholder');
                img.src = e.target.result;
                img.style.display = 'block';
                if (placeholder) placeholder.style.display = 'none';
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    function previewImageUrl(url) {
        if (url && url.trim() !== '') {
            const img = document.getElementById('imagePreviewImg');
            const placeholder = document.getElementById('imagePreviewPlaceholder');
            img.src = url;
            img.style.display = 'block';
            if (placeholder) placeholder.style.display = 'none';
        }
    }

    function previewVariantImage(input) {
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const container = input.closest('.variant-row');
                const img = container.querySelector('.variant-img-preview');
                const placeholder = container.querySelector('.variant-img-placeholder');
                if(img) {
                    img.src = e.target.result;
                    img.style.display = 'block';
                }
                if (placeholder) placeholder.style.display = 'none';
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    let variantIndex = <?php echo e(count($existingVariants ?? [])); ?>;

    function addVariantRow(colorName = '', hexCode = '#dc2626') {
        const container = document.getElementById('variantsContainer');
        const row = document.createElement('div');
        row.className = 'variant-row';
        row.style.cssText = 'display: grid; grid-template-columns: 100px 50px 1fr 100px 220px 40px; gap: 10px; align-items: center; border: 1px dashed var(--border); padding: 10px; border-radius: 4px;';
        row.innerHTML = `
            <select name="variant_types[${variantIndex}]" class="mgr-input" style="height: 38px;" onchange="handleVariantTypeChange(this)">
                <option value="color">Warna Tambahan</option>
                <option value="bodykit">Bodykit</option>
            </select>
            <div style="width: 100%; height: 38px; position: relative;">
                <input type="color" name="variant_hexes[${variantIndex}]" value="${hexCode}" onchange="updatePalettePreview()" style="width: 100%; height: 100%; padding: 2px; border: 1px solid var(--border); background: var(--bg-hover); border-radius: 4px; cursor: pointer;">
                <div class="bodykit-badge" style="width: 100%; height: 100%; background: var(--bg-hover); border: 1px solid var(--border); border-radius: 4px; display: none; align-items: center; justify-content: center; font-size: 10px; font-family: monospace; font-weight: bold; color: var(--text-muted);">KIT</div>
            </div>
            <input type="text" name="variant_names[${variantIndex}]" value="${colorName}" oninput="updatePalettePreview()" placeholder="Nama (misal: Rosso Corsa)" class="mgr-input">
            <div style="display: flex; align-items: center; border: 1px solid var(--border); border-radius: 4px; background: var(--bg-hover); height: 38px; overflow: hidden;">
                <span style="font-size: 10px; font-family: monospace; color: var(--text-muted); padding: 0 6px;">STOCK</span>
                <input type="number" name="variant_stocks[${variantIndex}]" value="0" min="0" style="width: 100%; height: 100%; border: none; background: transparent; text-align: center; color: var(--text-heading); font-family: monospace; font-size: 12px; outline: none;">
            </div>
            <div style="display: flex; align-items: center; gap: 8px;">
                <div onclick="if(this.querySelector('img').src) openImageModal(this.querySelector('img').src)" style="width: 38px; height: 38px; border-radius: 4px; border: 1px solid var(--border); overflow: hidden; background: var(--bg-card); flex-shrink: 0; display: flex; align-items: center; justify-content: center; cursor: pointer;">
                    <img src="" alt="" style="width: 100%; height: 100%; object-fit: cover; display: none;" class="variant-img-preview">
                    <div class="variant-img-placeholder" style="color: var(--text-dim);"><i class="fa-solid fa-image"></i></div>
                </div>
                <div style="flex: 1; display: flex; flex-direction: column; gap: 5px;">
                    <input type="file" name="variant_images_upload[${variantIndex}]" accept="image/*" class="mgr-input" style="padding: 5px; font-size: 11px;" onchange="previewVariantImage(this)">
                    <input type="hidden" name="variant_images_existing[${variantIndex}]" value="">
                </div>
            </div>
            <button type="button" onclick="removeVariantRow(this)" style="height: 38px; background: rgba(239,68,68,0.1); border: 1px solid rgba(239,68,68,0.2); color: #f87171; border-radius: 4px; cursor: pointer; display: flex; align-items: center; justify-content: center;">
                <i class="fa-solid fa-trash-can"></i>
            </button>
        `;
        container.appendChild(row);
        variantIndex++;
        updateVariantRowsUI();
        updatePalettePreview();
    }

    function removeVariantRow(button) {
        const rows = document.querySelectorAll('.variant-row');
        if (rows.length > 1) {
            button.closest('.variant-row').remove();
        } else {
            const inputs = button.closest('.variant-row').querySelectorAll('input');
            const selects = button.closest('.variant-row').querySelectorAll('select');
            if (inputs[0] && inputs[0].type === 'color') inputs[0].value = '#dc2626';
            if (inputs[1] && inputs[1].type === 'text') inputs[1].value = '';
            if (inputs[2] && inputs[2].type === 'number') inputs[2].value = '0';
            if (selects[0]) selects[0].value = 'color';
        }
        updateVariantRowsUI();
        updatePalettePreview();
    }

    function addSpecRow() {
        const container = document.getElementById('specsContainer');
        const row = document.createElement('div');
        row.className = 'spec-row';
        row.style.cssText = 'display: grid; grid-template-columns: 1fr 1fr 140px 40px; gap: 10px; align-items: center;';
        row.innerHTML = `
            <input type="text" name="spec_keys[]" value="" placeholder="Komponen (Misal: Mesin)" class="mgr-input">
            <input type="text" name="spec_vals[]" value="" placeholder="Spesifikasi (Misal: 5.2L V10)" class="mgr-input">
            <select name="spec_icons[]" class="mgr-input" style="padding-left: 8px;">
                <option value="fa-circle-info">Info</option>
                <option value="fa-bolt">Listrik / Power</option>
                <option value="fa-gauge-high">Kecepatan</option>
                <option value="fa-gears">Mesin / Gigi</option>
                <option value="fa-truck-monster">Drivetrain</option>
                <option value="fa-weight-hanging">Berat</option>
                <option value="fa-wind">Aerodinamika</option>
                <option value="fa-tachometer-alt">Torsi / RPM</option>
                <option value="fa-gas-pump">Bahan Bakar</option>
                <option value="fa-battery-full">Baterai</option>
            </select>
            <button type="button" onclick="this.closest('.spec-row').remove()" style="height: 38px; background: rgba(239,68,68,0.1); border: 1px solid rgba(239,68,68,0.2); color: #f87171; border-radius: 4px; cursor: pointer; display: flex; align-items: center; justify-content: center;">
                <i class="fa-solid fa-trash-can"></i>
            </button>
        `;
        container.appendChild(row);
    }

    function handleVariantTypeChange(select) {
        updateVariantRowsUI();
        updatePalettePreview();
    }

    function updateVariantRowsUI() {
        const rows = document.querySelectorAll('.variant-row');
        let kitCount = 1;
        rows.forEach(row => {
            const select = row.querySelector('select[name^="variant_types"]');
            const colorInput = row.querySelector('input[type="color"]');
            const badge = row.querySelector('.bodykit-badge');
            
            if (select && select.value === 'bodykit') {
                if (colorInput) colorInput.style.display = 'none';
                if (badge) {
                    badge.style.display = 'flex';
                    badge.textContent = 'KIT ' + kitCount;
                }
                kitCount++;
            } else {
                if (colorInput) colorInput.style.display = 'block';
                if (badge) badge.style.display = 'none';
            }
        });
    }

    function updatePalettePreview() {
        const previewContainer = document.getElementById('livePalettePreview');
        if (!previewContainer) return;

        let html = '';
        
        const primaryColorHex = document.querySelector('input[name="primary_color_hex"]');
        const primaryColorName = document.querySelector('input[name="primary_color_name"]');
        if (primaryColorHex && primaryColorHex.value) {
            const nameVal = (primaryColorName && primaryColorName.value) ? primaryColorName.value : 'Warna Utama';
            html += `<div title="${nameVal} (Warna Utama)" style="width: 24px; height: 24px; border-radius: 50%; background-color: ${primaryColorHex.value}; border: 2px solid #ef4444; box-shadow: 0 2px 4px rgba(0,0,0,0.3); position: relative; z-index: 10;"></div>`;
        }

        const hexInputs = document.querySelectorAll('input[name^="variant_hexes"]');
        const nameInputs = document.querySelectorAll('input[name^="variant_names"]');
        const typeInputs = document.querySelectorAll('select[name^="variant_types"]');
        
        hexInputs.forEach((hexIn, idx) => {
            if (typeInputs[idx] && typeInputs[idx].value !== 'color' && typeInputs[idx].value !== 'primer') return;
            const nameVal = nameInputs[idx] ? nameInputs[idx].value : 'Warna';
            const hexVal = hexIn.value;
            html += `<div title="${nameVal}" style="width: 22px; height: 22px; border-radius: 50%; background-color: ${hexVal}; border: 2px solid rgba(255,255,255,0.4); box-shadow: 0 2px 4px rgba(0,0,0,0.3); margin-left: -6px;"></div>`;
        });
        
        previewContainer.innerHTML = html;
    }

    document.addEventListener('DOMContentLoaded', () => {
        updateVariantRowsUI();
        updatePalettePreview();
        
        // Autocomplete & Auto-fill Brand Logic
        const commonCars = [
            // McLaren
            { model: "McLaren Senna GTR", brand: "McLaren Automotive" },
            { model: "McLaren 720S", brand: "McLaren Automotive" },
            { model: "McLaren 765LT", brand: "McLaren Automotive" },
            { model: "McLaren P1", brand: "McLaren Automotive" },
            { model: "McLaren Artura", brand: "McLaren Automotive" },
            { model: "McLaren GT", brand: "McLaren Automotive" },
            { model: "McLaren Speedtail", brand: "McLaren Automotive" },
            { model: "McLaren 570S", brand: "McLaren Automotive" },
            { model: "McLaren 600LT", brand: "McLaren Automotive" },
            { model: "McLaren Elva", brand: "McLaren Automotive" },

            // Ferrari
            { model: "Ferrari SF90 Stradale", brand: "Ferrari" },
            { model: "Ferrari F8 Tributo", brand: "Ferrari" },
            { model: "Ferrari 812 Superfast", brand: "Ferrari" },
            { model: "Ferrari LaFerrari", brand: "Ferrari" },
            { model: "Ferrari 296 GTB", brand: "Ferrari" },
            { model: "Ferrari Roma", brand: "Ferrari" },
            { model: "Ferrari Purosangue", brand: "Ferrari" },
            { model: "Ferrari Daytona SP3", brand: "Ferrari" },
            { model: "Ferrari Portofino M", brand: "Ferrari" },
            { model: "Ferrari 458 Italia", brand: "Ferrari" },
            { model: "Ferrari 488 Pista", brand: "Ferrari" },
            { model: "Ferrari Enzo", brand: "Ferrari" },

            // Lamborghini
            { model: "Lamborghini Aventador SVJ", brand: "Lamborghini" },
            { model: "Lamborghini Huracan EVO", brand: "Lamborghini" },
            { model: "Lamborghini Urus Performante", brand: "Lamborghini" },
            { model: "Lamborghini Revuelto", brand: "Lamborghini" },
            { model: "Lamborghini Sian FKP 37", brand: "Lamborghini" },
            { model: "Lamborghini Countach LPI 800-4", brand: "Lamborghini" },
            { model: "Lamborghini Huracan Sterrato", brand: "Lamborghini" },
            { model: "Lamborghini Huracan Tecnica", brand: "Lamborghini" },
            { model: "Lamborghini Gallardo", brand: "Lamborghini" },
            { model: "Lamborghini Murcielago SV", brand: "Lamborghini" },

            // Porsche
            { model: "Porsche 911 GT3 RS", brand: "Porsche" },
            { model: "Porsche 911 Turbo S", brand: "Porsche" },
            { model: "Porsche Taycan Turbo S", brand: "Porsche" },
            { model: "Porsche 918 Spyder", brand: "Porsche" },
            { model: "Porsche 911 GT2 RS", brand: "Porsche" },
            { model: "Porsche Cayman GT4 RS", brand: "Porsche" },
            { model: "Porsche Panamera Turbo S", brand: "Porsche" },
            { model: "Porsche Cayenne Turbo GT", brand: "Porsche" },
            { model: "Porsche Macan GTS", brand: "Porsche" },
            { model: "Porsche Carrera GT", brand: "Porsche" },

            // Aston Martin
            { model: "Aston Martin Valkyrie", brand: "Aston Martin" },
            { model: "Aston Martin DB11", brand: "Aston Martin" },
            { model: "Aston Martin DBS Superleggera", brand: "Aston Martin" },
            { model: "Aston Martin Vantage F1 Edition", brand: "Aston Martin" },
            { model: "Aston Martin DBX707", brand: "Aston Martin" },
            { model: "Aston Martin Valhalla", brand: "Aston Martin" },
            { model: "Aston Martin DB12", brand: "Aston Martin" },

            // Rolls-Royce
            { model: "Rolls-Royce Phantom VIII", brand: "Rolls-Royce" },
            { model: "Rolls-Royce Cullinan Black Badge", brand: "Rolls-Royce" },
            { model: "Rolls-Royce Ghost Series II", brand: "Rolls-Royce" },
            { model: "Rolls-Royce Spectre", brand: "Rolls-Royce" },
            { model: "Rolls-Royce Wraith", brand: "Rolls-Royce" },

            // Bentley
            { model: "Bentley Continental GT Speed", brand: "Bentley" },
            { model: "Bentley Bentayga EWB", brand: "Bentley" },
            { model: "Bentley Flying Spur Mulliner", brand: "Bentley" },
            { model: "Bentley Batur", brand: "Bentley" },

            // Bugatti
            { model: "Bugatti Chiron Super Sport 300+", brand: "Bugatti" },
            { model: "Bugatti Veyron Grand Sport Vitesse", brand: "Bugatti" },
            { model: "Bugatti Divo", brand: "Bugatti" },
            { model: "Bugatti Centodieci", brand: "Bugatti" },
            { model: "Bugatti Bolide", brand: "Bugatti" },
            { model: "Bugatti Tourbillon", brand: "Bugatti" },

            // Koenigsegg
            { model: "Koenigsegg Jesko Attack", brand: "Koenigsegg" },
            { model: "Koenigsegg Gemera", brand: "Koenigsegg" },
            { model: "Koenigsegg Regera", brand: "Koenigsegg" },
            { model: "Koenigsegg Agera RS", brand: "Koenigsegg" },
            { model: "Koenigsegg CC850", brand: "Koenigsegg" },

            // Pagani
            { model: "Pagani Huayra Roadster BC", brand: "Pagani" },
            { model: "Pagani Zonda Cinque", brand: "Pagani" },
            { model: "Pagani Utopia", brand: "Pagani" },

            // Mercedes-Benz / AMG
            { model: "Mercedes-AMG GT Black Series", brand: "Mercedes-Benz" },
            { model: "Mercedes-AMG ONE", brand: "Mercedes-Benz" },
            { model: "Mercedes-AMG G63 Brabus", brand: "Mercedes-Benz" },
            { model: "Mercedes-Maybach S680", brand: "Mercedes-Benz" },
            { model: "Mercedes-AMG C63 S E Performance", brand: "Mercedes-Benz" },
            { model: "Mercedes-AMG GT 63 S 4-Door", brand: "Mercedes-Benz" },
            { model: "Mercedes-SL 63 AMG", brand: "Mercedes-Benz" },

            // BMW
            { model: "BMW M4 Competition Coupe", brand: "BMW", category: "Supercar", year: 2026, transmission: "8-Speed M Steptronic", fuel_type: "TwinPower Turbo Inline-6", description: "BMW M4 Competition Coupe merepresentasikan tradisi divisi M Motorsport dalam memadukan performa lintasan balap sirkuit dengan kenyamanan berkendara harian tingkat tinggi." },
            { model: "BMW M2 Coupe (G87)", brand: "BMW", category: "Supercar", year: 2024, transmission: "8-Speed M Steptronic", fuel_type: "TwinPower Turbo Inline-6" },
            { model: "BMW M3 Sedan (G80)", brand: "BMW", category: "Supercar", year: 2024, transmission: "8-Speed M Steptronic", fuel_type: "TwinPower Turbo Inline-6" },
            { model: "BMW M4 Coupe", brand: "BMW", category: "Supercar" },
            { model: "BMW M2 Competition", brand: "BMW" },
            { model: "BMW M5 Competition", brand: "BMW", category: "Supercar", year: 2024, transmission: "8-Speed M Steptronic", fuel_type: "TwinPower Turbo V8" },
            { model: "BMW M5 CS", brand: "BMW" },
            { model: "BMW M4 CSL", brand: "BMW" },
            { model: "BMW M3 Competition xDrive", brand: "BMW" },
            { model: "BMW XM Label Red", brand: "BMW", category: "Luxury SUV", year: 2025, transmission: "8-Speed M Steptronic", fuel_type: "Plug-in Hybrid V8" },
            { model: "BMW M8 Competition Coupe", brand: "BMW" },
            { model: "BMW i8 Roadster", brand: "BMW", category: "Supercar", year: 2020, transmission: "6-Speed Automatic", fuel_type: "Plug-in Hybrid 3-cylinder" },

            // Lamborghini
            { model: "Lamborghini Revuelto V12 Hybrid", brand: "Lamborghini" },
            { model: "Lamborghini Aventador SVJ", brand: "Lamborghini" },
            { model: "Lamborghini Huracan EVO", brand: "Lamborghini" },
            { model: "Lamborghini Urus Performante", brand: "Lamborghini" },
            { model: "Lamborghini Sian FKP 37", brand: "Lamborghini" },
            { model: "Lamborghini Countach LPI 800-4", brand: "Lamborghini" },

            // McLaren
            { model: "McLaren Senna GTR Edition", brand: "McLaren Automotive", category: "Hypercar", year: 2021, transmission: "7-Speed SSG", fuel_type: "Twin-Turbo V8" },
            { model: "McLaren 720S", brand: "McLaren Automotive", category: "Supercar", year: 2023, transmission: "7-Speed SSG", fuel_type: "Twin-Turbo V8" },
            { model: "McLaren 765LT", brand: "McLaren Automotive", category: "Supercar", year: 2023, transmission: "7-Speed SSG", fuel_type: "Twin-Turbo V8" },
            { model: "McLaren P1", brand: "McLaren Automotive", category: "Hypercar", year: 2015, transmission: "7-Speed SSG", fuel_type: "Hybrid Twin-Turbo V8" },
            { model: "McLaren Artura", brand: "McLaren Automotive", category: "Supercar", year: 2024, transmission: "8-Speed SSG", fuel_type: "Plug-in Hybrid Twin-Turbo V6" },
            { model: "McLaren Speedtail", brand: "McLaren Automotive", category: "Hypercar", year: 2021, transmission: "7-Speed Dual-Clutch", fuel_type: "Hybrid Twin-Turbo V8" },

            // Porsche
            { model: "Porsche 911 GT3 RS (992)", brand: "Porsche" },
            { model: "Porsche 911 Turbo S", brand: "Porsche" },
            { model: "Porsche Taycan Turbo S", brand: "Porsche" },
            { model: "Porsche 918 Spyder", brand: "Porsche" },

            // Audi
            { model: "Audi R8 V10 Performance", brand: "Audi" },
            { model: "Audi RS6 Avant GT", brand: "Audi" },
            { model: "Audi RS e-tron GT", brand: "Audi" },
            { model: "Audi RS7 Sportback", brand: "Audi" },

            // Koenigsegg
            { model: "Koenigsegg Jesko Absolut", brand: "Koenigsegg" },
            { model: "Koenigsegg Jesko Attack", brand: "Koenigsegg" },
            { model: "Koenigsegg Gemera", brand: "Koenigsegg" },
            { model: "Koenigsegg Regera", brand: "Koenigsegg" },

            // Ferrari
            { model: "Ferrari SF90 XX Stradale", brand: "Ferrari" },
            { model: "Ferrari SF90 Stradale", brand: "Ferrari" },
            { model: "Ferrari F8 Tributo", brand: "Ferrari" },
            { model: "Ferrari 812 Superfast", brand: "Ferrari" },
            { model: "Ferrari LaFerrari", brand: "Ferrari" },

            // Bugatti
            { model: "Bugatti Chiron Pur Sport W16", brand: "Bugatti" },
            { model: "Bugatti Chiron Super Sport 300+", brand: "Bugatti" },
            { model: "Bugatti Divo", brand: "Bugatti" },
            { model: "Bugatti Tourbillon", brand: "Bugatti" },

            // Chevrolet
            { model: "Chevrolet Corvette C8 Z06 GT3", brand: "Chevrolet" },
            { model: "Chevrolet Corvette Stingray", brand: "Chevrolet" },

            // Pagani
            { model: "Pagani Huayra BC Benny Caiola", brand: "Pagani" },
            { model: "Pagani Zonda Cinque", brand: "Pagani" },
            { model: "Pagani Utopia", brand: "Pagani" },

            // Zenvo
            { model: "Zenvo TSR-S Centripetal Wing", brand: "Zenvo Automotive" },
            { model: "Zenvo Aurora Agil", brand: "Zenvo Automotive" },

            // Mercedes-Benz / AMG
            { model: "Mercedes-AMG GT Black Series", brand: "Mercedes-Benz" },
            { model: "Mercedes-AMG ONE", brand: "Mercedes-Benz" },
            { model: "Mercedes-AMG G63 Brabus", brand: "Mercedes-Benz" },
            { model: "Mercedes-Maybach S680", brand: "Mercedes-Benz" },

            // Subaru
            { model: "Subaru BRZ S (ZD8)", brand: "Subaru", category: "Supercar", year: 2024, transmission: "6-Speed Manual", fuel_type: "Naturally Aspirated Boxer-4 2.4L" },
            { model: "Subaru BRZ tS", brand: "Subaru", category: "Supercar", year: 2023, transmission: "6-Speed Manual", fuel_type: "Naturally Aspirated Boxer-4 2.4L" },
            { model: "Subaru BRZ GT300", brand: "Subaru", category: "Supercar", year: 2023, transmission: "6-Speed Sequential", fuel_type: "Naturally Aspirated Boxer-4" },
            { model: "Subaru WRX STI EJ257 Final Edition", brand: "Subaru", category: "Supercar", year: 2021, transmission: "6-Speed Manual", fuel_type: "EJ257 Turbocharged Boxer-4" },
            { model: "Subaru WRX STI Type RA-R", brand: "Subaru", category: "Supercar", year: 2018, transmission: "6-Speed Manual", fuel_type: "EJ20 Turbocharged Boxer-4" },
            { model: "Subaru Impreza WRX STI Spec C", brand: "Subaru", category: "Supercar", year: 2007, transmission: "6-Speed Manual", fuel_type: "EJ207 Turbocharged Boxer-4" },
            { model: "Subaru Forester STI", brand: "Subaru", category: "Luxury SUV", year: 2013, transmission: "6-Speed Manual", fuel_type: "EJ255 Turbocharged Boxer-4" },

            // Honda / Acura
            { model: "Honda Civic Type R (FL5)", brand: "Honda", category: "Supercar", year: 2024, transmission: "6-Speed Manual", fuel_type: "Turbocharged VTEC Inline-4 2.0L" },
            { model: "Honda Civic Type R (FK8)", brand: "Honda", category: "Supercar", year: 2021, transmission: "6-Speed Manual", fuel_type: "Turbocharged VTEC Inline-4 2.0L" },
            { model: "Honda Civic Type R (EP3)", brand: "Honda", category: "Supercar", year: 2005, transmission: "6-Speed Manual", fuel_type: "VTEC Inline-4 2.0L" },
            { model: "Honda Civic Type R FK2 Championship White", brand: "Honda", category: "Supercar", year: 2016, transmission: "6-Speed Manual", fuel_type: "Turbocharged VTEC Inline-4 2.0L" },
            { model: "Honda NSX Type S", brand: "Honda", category: "Supercar", year: 2022, transmission: "9-Speed DCT", fuel_type: "Hybrid Twin-Turbo V6" },
            { model: "Honda S2000 AP2", brand: "Honda", category: "Supercar", year: 2009, transmission: "6-Speed Manual", fuel_type: "VTEC Inline-4 2.0L" },
            { model: "Acura Integra Type R (DC2)", brand: "Acura", category: "Supercar", year: 2001, transmission: "5-Speed Manual", fuel_type: "VTEC Inline-4 1.8L" },

            // Nissan
            { model: "Nissan GT-R Nismo (R35)", brand: "Nissan" },
            { model: "Nissan Skyline GT-R R34 V-Spec II", brand: "Nissan" },

            // Lexus & Toyota & Ford & Others
            { model: "Lexus LFA Nurburgring Package", brand: "Lexus" },
            { model: "Toyota GR Supra 3.0", brand: "Toyota" },
            { model: "Toyota GR86 Gazoo Racing", brand: "Toyota", category: "Supercar", year: 2024, transmission: "6-Speed Manual", fuel_type: "Naturally Aspirated Boxer-4 2.4L" },
            { model: "Ford GT Heritage Edition", brand: "Ford" },
            { model: "Rimac Nevera", brand: "Rimac Automobili" },
            { model: "Range Rover SV Autobiography", brand: "Land Rover" }
        ];

        const nameInput = document.getElementById('carNameInput');
        const brandInput = document.getElementById('carBrandInput');
        const suggestionsBox = document.getElementById('carSuggestions');
        let selectedFromList = false;

        nameInput.addEventListener('input', function() {
            const query = this.value.toLowerCase().trim();
            suggestionsBox.innerHTML = '';
            selectedFromList = false;
            
            let filtered = [];
            if (query.length === 0) {
                // If empty, show all available cars in scrollable list
                filtered = commonCars;
            } else {
                filtered = commonCars.filter(car => car.model.toLowerCase().includes(query) || car.brand.toLowerCase().includes(query));
            }

            if (filtered.length > 0) {
                suggestionsBox.style.display = 'block';
                filtered.forEach(car => {
                    const item = document.createElement('div');
                    item.style.cssText = 'padding: 10px 14px; cursor: pointer; border-bottom: 1px solid var(--border); font-size: 13px; color: var(--text-heading); display: flex; justify-content: space-between; align-items: center; transition: background 0.2s;';
                    
                    let modelHtml = car.model;
                    if (query.length > 0) {
                        const regex = new RegExp(`(${query})`, 'gi');
                        modelHtml = car.model.replace(regex, '<span style="color: #ef4444; font-weight: 700;">$1</span>');
                    }
                    
                    item.innerHTML = `<span>${modelHtml}</span> <span style="font-size: 11px; color: var(--text-muted); background: var(--bg-hover, rgba(0,0,0,0.05)); padding: 2px 6px; border-radius: 4px;">${car.brand}</span>`;
                    
                    item.addEventListener('mouseenter', () => item.style.background = 'var(--bg-hover)');
                    item.addEventListener('mouseleave', () => item.style.background = 'transparent');
                    
                    item.addEventListener('click', (e) => {
                        e.stopPropagation();
                        nameInput.value = car.model;
                        brandInput.value = car.brand;

                        if (car.category) {
                            const catSelect = document.querySelector('select[name="category"]');
                            if (catSelect) catSelect.value = car.category;
                        }
                        if (car.year) {
                            const yearInput = document.querySelector('input[name="year"]');
                            if (yearInput) yearInput.value = car.year;
                        }
                        if (car.transmission) {
                            const transInput = document.querySelector('input[name="transmission"]');
                            if (transInput) transInput.value = car.transmission;
                        }
                        if (car.fuel_type) {
                            const fuelInput = document.querySelector('input[name="fuel_type"]');
                            if (fuelInput) fuelInput.value = car.fuel_type;
                        }
                        if (car.description) {
                            const descInput = document.querySelector('textarea[name="description"]');
                            if (descInput) descInput.value = car.description;
                        }

                        suggestionsBox.style.display = 'none';
                        selectedFromList = true;
                    });
                    
                    suggestionsBox.appendChild(item);
                });
            } else {
                suggestionsBox.style.display = 'none';
            }
        });

        // Close suggestions when clicking outside
        document.addEventListener('click', function(e) {
            if (e.target !== nameInput && !suggestionsBox.contains(e.target)) {
                suggestionsBox.style.display = 'none';
            }
        });

        // Show suggestions on focus or click
        nameInput.addEventListener('focus', function() {
            this.dispatchEvent(new Event('input'));
        });
        nameInput.addEventListener('click', function() {
            this.dispatchEvent(new Event('input'));
        });

        // --- Auto-Save & Prevent Data Loss ---
        const carForm = document.getElementById('carForm');
        let isDirty = false;

        carForm.addEventListener('input', function() {
            isDirty = true;
            saveDraft();
        });

        window.addEventListener('beforeunload', function(e) {
            if (isDirty) {
                e.preventDefault();
                e.returnValue = 'Anda masih dalam pengisian, apakah yakin ingin meninggalkan halaman?';
            }
        });

        carForm.addEventListener('submit', function() {
            isDirty = false;
            localStorage.removeItem('apex_car_draft');
            
            // Bypass array POST limits/bugs by sending as JSON
            const keys = Array.from(document.querySelectorAll('input[name="spec_keys[]"]')).map(el => el.value);
            const vals = Array.from(document.querySelectorAll('input[name="spec_vals[]"]')).map(el => el.value);
            const icons = Array.from(document.querySelectorAll('select[name="spec_icons[]"]')).map(el => el.value);
            const specsData = keys.map((key, i) => ({ key: key, val: vals[i] || '', icon: icons[i] || 'fa-circle-info' }));
            document.getElementById('specs_json').value = JSON.stringify(specsData);
        });

        function saveDraft() {
            const draft = {
                name: document.querySelector('input[name="name"]').value,
                brand: document.querySelector('input[name="brand"]').value,
                category: document.querySelector('select[name="category"]').value,
                price: document.querySelector('input[name="price"]').value,
                year: document.querySelector('input[name="year"]').value,
                transmission: document.querySelector('input[name="transmission"]').value,
                fuel_type: document.querySelector('input[name="fuel_type"]').value,
                description: document.querySelector('textarea[name="description"]').value,
                status: document.querySelector('select[name="status"]').value,
            };
            localStorage.setItem('apex_car_draft', JSON.stringify(draft));
        }

        <?php if(!$car->exists): ?>
        const savedDraft = localStorage.getItem('apex_car_draft');
        if (savedDraft) {
            try {
                const draft = JSON.parse(savedDraft);
                if (draft.name) document.querySelector('input[name="name"]').value = draft.name;
                if (draft.brand) document.querySelector('input[name="brand"]').value = draft.brand;
                if (draft.category) document.querySelector('select[name="category"]').value = draft.category;
                if (draft.price) {
                    const priceHidden = document.getElementById('price_hidden');
                    const priceDisplay = document.getElementById('price_display');
                    if(priceHidden) priceHidden.value = draft.price;
                    if(priceDisplay) priceDisplay.value = new Intl.NumberFormat('id-ID').format(draft.price).replace(/,/g, '.');
                }
                if (draft.year) document.querySelector('input[name="year"]').value = draft.year;
                if (draft.transmission) document.querySelector('input[name="transmission"]').value = draft.transmission;
                if (draft.fuel_type) document.querySelector('input[name="fuel_type"]').value = draft.fuel_type;
                if (draft.desc_title) document.querySelector('input[name="desc_title"]').value = draft.desc_title;
                if (draft.desc_subtitle) document.querySelector('input[name="desc_subtitle"]').value = draft.desc_subtitle;
                if (draft.desc_intro) document.querySelector('textarea[name="desc_intro"]').value = draft.desc_intro;
                if (draft.desc_history) document.querySelector('textarea[name="desc_history"]').value = draft.desc_history;
                if (draft.status) document.querySelector('select[name="status"]').value = draft.status;
            } catch (e) {}
        }
        <?php endif; ?>

        // --- Format Price on Input ---
        window.formatPrice = function(input) {
            let rawValue = input.value.replace(/[^0-9]/g, '');
            document.getElementById('price_hidden').value = rawValue;
            
            if (rawValue === '') {
                input.value = '';
            } else {
                input.value = new Intl.NumberFormat('id-ID').format(rawValue).replace(/,/g, '.');
            }
        };
    });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('manager.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\apex-automotive\resources\views/manager/cars/form.blade.php ENDPATH**/ ?>