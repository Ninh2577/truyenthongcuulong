<?php $__env->startSection('title', ($post->meta_title ?: $post->title) . ' - Truyá»n ThÃ´ng Cá»­u Long'); ?>
<?php $__env->startSection('meta_description', $post->meta_description ?: $post->summary); ?>
<?php $__env->startSection('og_image', $post->thumbnail ? $post->thumbnail_url : 'https://lh3.googleusercontent.com/aida/AEtjO1XFwX4HiQFmIiEoAWVzpyEesCWg-s3cW3_OywD-F4P2K6Ihv0FahvOINcwcDs5UYQ_y59TDDy5L5oB6SJndgCTfG4ajjq19W5C55BJfgOAAsK0ncT6ENswBz7W0Cujm6FKLHyDupQNpHhHONPunFiGdBNNQBaPpLYn4RZLhthR_kyx8X3ASC5uoOW2e19gEc8TdFIzSv9FVSu_QbQ4A3DkxVIY3Ucoocwzt26ZMrG5mc7CiH24dQCMDS5o'); ?>

<?php $__env->startSection('schema'); ?>
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "Article",
  "headline": "<?php echo e(addslashes($post->title)); ?>",
  "image": [
    "<?php echo e($post->thumbnail ? $post->thumbnail_url : 'https://truyenthongcuulong.com/logo.png'); ?>"
  ],
  "datePublished": "<?php echo e($post->published_at ? $post->published_at->toAtomString() : now()->toAtomString()); ?>",
  "dateModified": "<?php echo e($post->updated_at ? $post->updated_at->toAtomString() : now()->toAtomString()); ?>",
  "author": {
    "@type": "Organization",
    "name": "Truyá»n ThÃ´ng Cá»­u Long"
  },
  "publisher": {
    "@type": "Organization",
    "name": "Truyá»n ThÃ´ng Cá»­u Long",
    "logo": {
      "@type": "ImageObject",
      "url": "https://truyenthongcuulong.com/logo.png"
    }
  },
  "description": "<?php echo e(addslashes($post->summary)); ?>"
}
</script>

<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "BreadcrumbList",
  "itemListElement": [{
    "@type": "ListItem",
    "position": 1,
    "name": "Trang chá»§",
    "item": "<?php echo e(route('home')); ?>"
  },{
    "@type": "ListItem",
    "position": 2,
    "name": "Táº¡p chÃ­",
    "item": "<?php echo e(route('blog.index')); ?>"
  },{
    "@type": "ListItem",
    "position": 3,
    "name": "<?php echo e(addslashes($post->title)); ?>"
  }]
}
</script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<style>
    html {
        scroll-behavior: smooth;
    }
    .toc-link.active {
        color: #ea580c; /* text-orange-600 */
        font-weight: 800;
        border-left: 3px solid #ea580c;
        padding-left: 0.75rem;
        background: linear-gradient(90deg, rgba(255,237,213,0.5) 0%, rgba(255,237,213,0) 100%);
    }
    .toc-link {
        transition: all 0.3s ease;
        border-left: 3px solid transparent;
        padding-left: 0.75rem;
        padding-top: 0.25rem;
        padding-bottom: 0.25rem;
        border-radius: 0 8px 8px 0;
    }
    .toc-link:hover {
        color: #ea580c;
        border-left-color: #fdba74; /* orange-300 */
        background: linear-gradient(90deg, rgba(255,237,213,0.3) 0%, rgba(255,237,213,0) 100%);
    }
    .custom-scrollbar::-webkit-scrollbar {
        width: 6px;
    }
    .custom-scrollbar::-webkit-scrollbar-track {
        background: #f8fafc;
        border-radius: 10px;
    }
    .custom-scrollbar::-webkit-scrollbar-thumb {
        background: #cbd5e1;
        border-radius: 10px;
    }
    .custom-scrollbar::-webkit-scrollbar-thumb:hover {
        background: #94a3b8;
    }
</style>

<!-- Reading Progress Bar -->
<div id="reading-progress-bar" class="fixed top-[72px] left-0 h-1.5 bg-gradient-to-r from-orange-500 to-yellow-400 z-[60] transition-all w-0 shadow-sm"></div>

<div class="w-full bg-[#FAFAFA] pt-24 lg:pt-32 pb-20">
    <div class="max-w-[1200px] mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Breadcrumb -->
        <nav class="flex items-center gap-2 text-[13px] font-medium text-slate-500 mb-8 lg:mb-12 flex-wrap">
            <a href="<?php echo e(route('home')); ?>" class="hover:text-orange-600 transition-colors">Trang chá»§</a>
            <span class="text-slate-300">/</span>
            <a href="<?php echo e(route('blog.index')); ?>" class="hover:text-orange-600 transition-colors">Táº¡p chÃ­</a>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($post->category): ?>
            <span class="text-slate-300">/</span>
            <a href="<?php echo e(route('blog.resolve', $post->category->slug)); ?>" class="hover:text-orange-600 transition-colors"><?php echo e($post->category->name); ?></a>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </nav>

        <div class="flex flex-col lg:grid lg:grid-cols-[1fr_320px] gap-12 lg:items-stretch relative">
            
            <!-- MAIN CONTENT COL -->
            <div class="w-full min-w-0">
                
                <!-- Hero Section Side-by-Side -->
                <div class="flex flex-col lg:grid lg:grid-cols-2 gap-8 lg:gap-12 items-center mb-12">
                    <!-- Article Header -->
                    <header class="mb-0">
                        <?php
                            $highlightedTitle = $post->title;
                            if (!empty($post->focus_keyword)) {
                                $keyword = preg_quote(trim($post->focus_keyword), '/');
                                $highlightedTitle = preg_replace('/(' . $keyword . ')/iu', '<span class="text-transparent bg-clip-text bg-gradient-to-r from-orange-500 to-orange-400">$1</span>', $post->title);
                            }
                        ?>
                        <h1 class="font-headline text-[32px] sm:text-[40px] lg:text-[48px] font-black text-[#111827] leading-[1.15] tracking-tight mb-6">
                            <?php echo $highlightedTitle; ?>

                        </h1>

                        <div class="flex flex-wrap items-center justify-between gap-4 py-6 border-y border-slate-200/80 text-[13px] text-slate-600">
                            <div class="flex items-center gap-4">
                                <div class="w-10 h-10 rounded-full bg-gradient-to-tr from-orange-500 to-orange-400 flex items-center justify-center text-white font-bold shadow-md">
                                    CL
                                </div>
                                <div class="flex flex-col">
                                    <span class="font-bold text-[#111827] text-[14px]">Truyá»n ThÃ´ng Cá»­u Long</span>
                                    <span class="font-mono text-slate-500"><?php echo e($post->published_at ? $post->published_at->format('d/m/Y') : ''); ?> Â· Äá»c 5 phÃºt</span>
                                </div>
                            </div>

                            <!-- Social Share -->
                            <div class="flex items-center gap-3">
                                <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo e(urlencode(url()->current())); ?>" target="_blank" rel="noopener noreferrer" 
                                    class="w-9 h-9 rounded-full bg-slate-100 hover:bg-[#1877f2] hover:text-white flex items-center justify-center text-slate-600 transition-all shadow-sm">
                                    <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.469h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.469h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                                </a>
                                <a href="https://zalo.me/share?url=<?php echo e(urlencode(url()->current())); ?>" target="_blank" rel="noopener noreferrer" 
                                    class="w-9 h-9 rounded-full bg-slate-100 hover:bg-[#0068ff] hover:text-white flex items-center justify-center text-slate-600 font-bold transition-all shadow-sm text-xs">
                                    Z
                                </a>
                            </div>
                        </div>
                    </header>

                    <!-- Featured Thumbnail -->
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($post->thumbnail): ?>
                    <figure class="w-full aspect-[4/3] rounded-[24px] overflow-hidden shadow-xl border border-slate-200/50 bg-slate-100 relative group">
                        <img src="<?php echo e($post->thumbnail_url); ?>" alt="<?php echo e($post->title); ?>" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/40 via-transparent to-transparent opacity-60"></div>
                    </figure>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>

                <!-- Summary / Lead -->
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($post->summary): ?>
                <div class="p-6 sm:p-8 rounded-[24px] bg-orange-50/80 mb-12 relative overflow-hidden">
                    <div class="absolute top-0 left-0 w-2 h-full bg-orange-500"></div>
                    <p class="font-body text-lg sm:text-[20px] leading-[1.7] text-[#1f2937] font-medium italic relative z-10">
                        <?php echo e($post->summary); ?>

                    </p>
                </div>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                <!-- TOC Mobile (Accordion) -->
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(!empty($toc) && count($toc) > 1): ?>
                <div class="block lg:hidden rounded-2xl p-5 mb-10 bg-white border border-slate-200 shadow-sm" x-data="{ expanded: false }">
                    <div class="flex items-center justify-between cursor-pointer" @click="expanded = !expanded">
                        <div class="flex items-center gap-3">
                            <span class="material-symbols-outlined text-orange-500 text-[24px]">menu_book</span>
                            <h2 class="font-headline font-bold text-[#111827] text-lg">Ná»™i dung chÃ­nh</h2>
                        </div>
                        <span class="material-symbols-outlined text-slate-400 transition-transform duration-300" :class="expanded ? 'rotate-180' : ''">expand_more</span>
                    </div>
                    <ul x-show="expanded" x-collapse class="mt-4 space-y-2 text-[15px] font-body border-t border-slate-100 pt-4">
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $toc; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li class="<?php echo e($item['level'] === 3 ? 'ml-4 text-slate-500' : 'font-semibold text-slate-800'); ?>">
                            <a href="#<?php echo e($item['anchor']); ?>" class="hover:text-orange-600 transition-colors block py-1" @click="expanded = false">
                                <?php echo e($item['title']); ?>

                            </a>
                        </li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </ul>
                </div>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                <!-- Article Main Content Prose -->
                <article class="prose prose-lg prose-slate max-w-none w-full text-slate-700 leading-[1.8] font-body
                    prose-headings:font-headline prose-headings:font-bold prose-headings:text-[#111827] prose-headings:tracking-tight
                    prose-h2:text-[26px] prose-h2:sm:text-[30px] prose-h2:mt-14 prose-h2:mb-6 prose-h2:pb-4 prose-h2:border-b prose-h2:border-slate-200/80
                    prose-h3:text-[22px] prose-h3:sm:text-[24px] prose-h3:mt-10 prose-h3:mb-5
                    prose-p:mb-6
                    prose-a:text-orange-600 hover:prose-a:text-orange-700 prose-a:font-semibold prose-a:underline prose-a:underline-offset-4 prose-a:decoration-orange-300/50
                    prose-img:rounded-[20px] prose-img:shadow-lg prose-img:border prose-img:border-slate-200/50 prose-img:mx-auto prose-img:my-10 prose-img:w-full
                    prose-blockquote:border-l-4 prose-blockquote:border-orange-500 prose-blockquote:bg-orange-50/50 prose-blockquote:py-5 prose-blockquote:px-8 prose-blockquote:rounded-r-[20px] prose-blockquote:font-medium prose-blockquote:text-slate-700 prose-blockquote:text-[20px] prose-blockquote:leading-[1.7]
                    prose-ul:marker:text-orange-500 prose-ul:my-6 prose-ul:space-y-2
                    prose-ol:marker:text-orange-500 prose-ol:font-semibold prose-ol:my-6 prose-ol:space-y-2
                    [&>ul>li>strong]:text-[#111827] [&>ul>li>strong]:font-bold
                    prose-code:font-mono prose-code:text-orange-600 prose-code:bg-orange-50 prose-code:px-2 prose-code:py-1 prose-code:rounded-lg prose-code:text-[14px]">
                    <?php echo clean($post->content); ?>

                </article>

                <div class="mt-16 text-center text-slate-400 italic">
                    --- Háº¿t ---
                </div>

                <!-- Bottom Breadcrumb -->
                <nav class="flex items-center gap-2 text-[13px] font-medium text-slate-500 mt-10 p-5 bg-white border border-slate-200 rounded-[16px] shadow-sm flex-wrap">
                    <span class="material-symbols-outlined text-orange-500 text-[18px]">home</span>
                    <a href="<?php echo e(route('home')); ?>" class="hover:text-orange-600 transition-colors">Trang chá»§</a>
                    <span class="text-slate-300">/</span>
                    <a href="<?php echo e(route('blog.index')); ?>" class="hover:text-orange-600 transition-colors">Táº¡p chÃ­</a>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($post->category): ?>
                    <span class="text-slate-300">/</span>
                    <a href="<?php echo e(route('blog.resolve', $post->category->slug)); ?>" class="hover:text-orange-600 transition-colors"><?php echo e($post->category->name); ?></a>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </nav>

                <!-- Consultation Box CTA -->
                <div class="mt-12 p-8 sm:p-10 rounded-3xl bg-gradient-to-r from-orange-500 to-amber-500 text-white shadow-xl flex flex-col sm:flex-row items-center justify-between gap-6 relative overflow-hidden">
                    <div class="absolute -right-20 -bottom-20 w-64 h-64 rounded-full bg-white/20 blur-3xl pointer-events-none"></div>
                    <div class="flex flex-col gap-2 text-center sm:text-left relative z-10">
                        <h3 class="font-headline text-2xl font-bold text-white">Báº¡n cáº§n TÆ° váº¥n chiáº¿n lÆ°á»£c Truyá»n thÃ´ng?</h3>
                        <p class="text-sm text-white/90">Äáº·t lá»‹ch trao Ä‘á»•i trá»±c tiáº¿p 1:1 vá»›i chuyÃªn gia cá»§a Truyá»n ThÃ´ng Cá»­u Long.</p>
                    </div>
                    <a href="<?php echo e(route('contact')); ?>" class="px-8 py-3.5 rounded-full bg-white text-orange-600 hover:bg-orange-50 font-headline text-sm font-bold shadow-md hover:scale-105 transition-transform shrink-0 relative z-10 flex items-center gap-2">
                        ÄÄƒng KÃ½ Ngay
                        <span class="material-symbols-outlined text-[18px]">arrow_forward</span>
                    </a>
                </div>

            </div>
            
            <!-- RIGHT SIDEBAR (TOC) -->
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(!empty($toc) && count($toc) > 1): ?>
            <div class="hidden lg:block w-full">
                <!-- Sticky Container -->
                <div class="sticky top-32">
                    <div class="bg-white rounded-[24px] p-7 border border-slate-200 shadow-[0_8px_30px_rgb(0,0,0,0.04)]">
                        <h3 class="font-headline font-bold text-lg text-[#111827] mb-5 flex items-center gap-2">
                            <span class="w-1.5 h-6 bg-orange-500 rounded-full"></span>
                            Ná»™i Dung BÃ i Viáº¿t
                        </h3>
                        <nav class="toc-container max-h-[calc(100vh-250px)] overflow-y-auto pr-3 custom-scrollbar">
                            <ul class="space-y-1.5 text-[14px] font-medium">
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $toc; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li class="<?php echo e($item['level'] === 3 ? 'ml-4' : 'mt-3 first:mt-0'); ?>">
                                    <a href="#<?php echo e($item['anchor']); ?>" class="toc-link block text-slate-500">
                                        <?php echo e($item['title']); ?>

                                    </a>
                                </li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </ul>
                        </nav>
                    </div>
                    
                    <!-- Small Ad / CTA in Sidebar -->
                    <a href="<?php echo e(route('projects.index')); ?>" class="mt-6 block bg-slate-900 rounded-[24px] p-6 text-white overflow-hidden relative group">
                        <div class="absolute inset-0 bg-gradient-to-br from-orange-600/20 to-transparent group-hover:opacity-100 opacity-50 transition-opacity duration-500"></div>
                        <h4 class="font-headline font-bold text-xl relative z-10 mb-2">HÆ¡n 900+ Doanh Nghiá»‡p<br>ÄÃ£ Äá»“ng HÃ nh</h4>
                        <p class="text-slate-400 text-xs relative z-10 mb-4">Xem cÃ¡c case study thÃ nh cÃ´ng cá»§a chÃºng tÃ´i.</p>
                        <span class="inline-flex items-center text-xs font-bold text-orange-500 group-hover:text-orange-400 relative z-10 gap-1 transition-colors">KhÃ¡m phÃ¡ ngay <span class="material-symbols-outlined text-[16px] group-hover:translate-x-1 transition-transform">arrow_forward</span></span>
                    </a>

                    <!-- BÃ i Viáº¿t Má»›i Nháº¥t / Ná»•i Báº­t Widget -->
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(isset($popularPosts) && $popularPosts->count() > 0): ?>
                    <div class="mt-6 bg-white rounded-[24px] p-6 border border-slate-200 shadow-[0_8px_30px_rgb(0,0,0,0.04)]">
                        <h3 class="font-headline font-bold text-lg text-[#111827] mb-5 flex items-center gap-2">
                            <span class="w-1.5 h-6 bg-orange-500 rounded-full"></span>
                            BÃ i Viáº¿t Ná»•i Báº­t
                        </h3>
                        <div class="flex flex-col gap-4">
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $popularPosts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $popPost): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <a href="<?php echo e(route('blog.resolve', $popPost->slug)); ?>" class="group flex gap-3 items-center">
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($popPost->thumbnail): ?>
                                <div class="w-20 h-16 rounded-xl overflow-hidden shrink-0 bg-slate-100">
                                    <img src="<?php echo e($popPost->thumbnail_url); ?>" alt="<?php echo e($popPost->title); ?>" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                                </div>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                <h4 class="font-headline font-bold text-[13px] text-[#111827] group-hover:text-orange-600 transition-colors line-clamp-3 leading-snug">
                                    <?php echo e($popPost->title); ?>

                                </h4>
                            </a>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </div>
                    </div>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>
            </div>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

        </div>

        <!-- Related Articles Grid -->
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($relatedPosts->count() > 0): ?>
        <div class="mt-24 pt-16 border-t border-slate-200">
            <div class="flex items-center justify-between mb-10">
                <h3 class="font-headline font-black text-3xl sm:text-4xl text-[#111827] tracking-tight">BÃ i Viáº¿t Má»›i Nháº¥t</h3>
                <a href="<?php echo e(route('blog.index')); ?>" class="hidden sm:flex px-5 py-2.5 rounded-full bg-slate-100 hover:bg-slate-200 text-sm font-bold text-slate-700 transition-colors items-center gap-2">
                    Xem táº¥t cáº£
                </a>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $relatedPosts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rPost): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <a href="<?php echo e(route('blog.resolve', $rPost->slug)); ?>" class="group block">
                    <div class="aspect-[4/3] rounded-[24px] bg-slate-100 overflow-hidden relative mb-4">
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($rPost->thumbnail): ?>
                        <img src="<?php echo e($rPost->thumbnail_url); ?>" alt="<?php echo e($rPost->title); ?>" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" loading="lazy">
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        <div class="absolute top-3 left-3 px-3 py-1 bg-white/90 backdrop-blur rounded-full text-[10px] font-bold text-slate-800 uppercase tracking-widest shadow-sm">
                            <?php echo e($rPost->category?->name ?? 'Tin tá»©c'); ?>

                        </div>
                    </div>
                    <h4 class="font-headline font-bold text-[17px] text-[#111827] group-hover:text-orange-600 transition-colors line-clamp-2 leading-[1.4] mb-2">
                        <?php echo e($rPost->title); ?>

                    </h4>
                    <p class="text-[13px] text-slate-500 font-mono"><?php echo e($rPost->published_at ? $rPost->published_at->format('d/m/Y') : ''); ?></p>
                </a>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>
        </div>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    </div>
</div>

<!-- Back to top button -->
<button id="backToTop" class="fixed bottom-8 right-8 w-12 h-12 rounded-full bg-[#111827] text-white shadow-2xl flex items-center justify-center hover:bg-orange-500 hover:scale-110 transition-all duration-300 translate-y-20 opacity-0 z-[90]" aria-label="LÃªn Ä‘áº§u trang">
    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 10l7-7m0 0l7 7m-7-7v18"></path></svg>
</button>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // 1. Reading Progress Bar
        const progressBar = document.getElementById('reading-progress-bar');
        const updateProgress = () => {
            const winScroll = window.pageYOffset || document.documentElement.scrollTop;
            const height = document.documentElement.scrollHeight - document.documentElement.clientHeight;
            if (height > 0) {
                const scrolled = (winScroll / height) * 100;
                if (progressBar) progressBar.style.width = scrolled + '%';
            }
        };
        window.addEventListener('scroll', updateProgress, {passive: true});
        updateProgress();

        // 2. Scroll Spy for TOC
        const sections = Array.from(document.querySelectorAll('article h2[id], article h3[id]'));
        const navLinks = document.querySelectorAll('.toc-link');
        
        if (sections.length > 0 && navLinks.length > 0) {
            const observerOptions = {
                root: null,
                rootMargin: '-100px 0px -50% 0px',
                threshold: 0
            };

            const observerCallback = (entries) => {
                let currentIntersecting = null;
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        currentIntersecting = entry.target.getAttribute('id');
                    }
                });

                if (currentIntersecting) {
                    navLinks.forEach(link => {
                        link.classList.remove('active');
                        if (link.getAttribute('href') === `#${currentIntersecting}`) {
                            link.classList.add('active');
                        }
                    });
                }
            };

            const observer = new IntersectionObserver(observerCallback, observerOptions);
            sections.forEach(sec => observer.observe(sec));
        }

        // 3. Back to Top Button
        const bttBtn = document.getElementById('backToTop');
        window.addEventListener('scroll', () => {
            if (window.scrollY > 400) {
                bttBtn.classList.remove('translate-y-20', 'opacity-0');
            } else {
                bttBtn.classList.add('translate-y-20', 'opacity-0');
            }
        }, {passive: true});

        bttBtn.addEventListener('click', () => {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });
    });
</script>
<?php $__env->stopSection(); ?>



<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\truyenthongcuulong-laravel\resources\views/blog/show.blade.php ENDPATH**/ ?>