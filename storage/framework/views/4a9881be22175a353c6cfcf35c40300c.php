<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>" class="dark scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="<?php echo $__env->yieldContent('meta_description', 'Apex Automotive - Official Luxury Supercar & Hypercar Dealer'); ?>">
    <title><?php echo $__env->yieldContent('title', 'APEX AUTOMOTIVE | Official Luxury Showroom & Hypercar Dealer'); ?></title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@500;700;800;900&family=Inter:wght@300;400;500;600;700&family=Outfit:wght@300;400;500;600;700;800&family=Playfair+Display:wght@700;800&family=Space+Mono:wght@400;700&display=swap" rel="stylesheet">

    <!-- FontAwesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <!-- Tailwind / Vite -->
    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>

    <?php echo $__env->yieldContent('styles'); ?>
</head>
<body class="<?php echo $__env->yieldContent('body_class', 'bg-neutral-50 dark:bg-[#0a0a0c] text-neutral-900 dark:text-neutral-100 font-sans antialiased selection:bg-red-600 selection:text-white min-h-screen flex flex-col transition-colors duration-300'); ?>">
    
    <!-- MASTER LAYOUT INCLUDES THE CHATBOT GLOBALLY -->
    <?php echo $__env->make('partials.chatbot', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    <!-- PAGE CONTENT -->
    <?php echo $__env->yieldContent('content'); ?>

    <!-- PAGE SCRIPTS -->
    <?php echo $__env->yieldContent('scripts'); ?>
    
    <script>
        // HAKI Protection for all images
        document.addEventListener('contextmenu', function(e) {
            if (e.target.tagName === 'IMG') {
                e.preventDefault();
            }
        });
        document.addEventListener('dragstart', function(e) {
            if (e.target.tagName === 'IMG') {
                e.preventDefault();
            }
        });
    </script>
</body>
</html>
<?php /**PATH C:\xampp\htdocs\apex-automotive\resources\views/layouts/app.blade.php ENDPATH**/ ?>