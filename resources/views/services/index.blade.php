@extends('layouts.app')

@section('title', 'Dịch Vụ & Giải Pháp Toàn Diện - Truyền Thông Cửu Long')
@section('meta_description', 'Từ sáng tạo nội dung, sản xuất media đến giải pháp công nghệ, chúng tôi đồng hành cùng doanh nghiệp kiến tạo giá trị thương hiệu và bứt phá trong kỷ nguyên số.')

@section('content')
<div class="w-full bg-[#fafbfc]" style="font-family: var(--font-primary);" x-data="{
    activeTab: 'all',
    filterCategory(cat) {
        this.activeTab = cat;
        const target = document.getElementById('danh-muc-dich-vu');
        if (target) {
            target.scrollIntoView({ behavior: 'smooth' });
        }
    }
}">

    <!-- ==================== 1. HERO SECTION ==================== -->
    <section class="pt-24 pb-12 sm:pt-28 sm:pb-14 lg:pt-28 lg:pb-16 relative overflow-hidden bg-white">
        <!-- Decorative Dot Matrix from Mockup (Top-Right) -->
        <div class="absolute top-8 right-12 hidden xl:grid grid-cols-6 gap-2.5 opacity-30 pointer-events-none">
            <span class="w-1.5 h-1.5 rounded-full bg-[#ff7a29]"></span><span class="w-1.5 h-1.5 rounded-full bg-[#ff7a29]"></span><span class="w-1.5 h-1.5 rounded-full bg-[#ff7a29]"></span><span class="w-1.5 h-1.5 rounded-full bg-[#ff7a29]"></span><span class="w-1.5 h-1.5 rounded-full bg-[#ff7a29]"></span><span class="w-1.5 h-1.5 rounded-full bg-[#ff7a29]"></span>
            <span class="w-1.5 h-1.5 rounded-full bg-[#ff7a29]"></span><span class="w-1.5 h-1.5 rounded-full bg-[#ff7a29]"></span><span class="w-1.5 h-1.5 rounded-full bg-[#ff7a29]"></span><span class="w-1.5 h-1.5 rounded-full bg-[#ff7a29]"></span><span class="w-1.5 h-1.5 rounded-full bg-[#ff7a29]"></span><span class="w-1.5 h-1.5 rounded-full bg-[#ff7a29]"></span>
            <span class="w-1.5 h-1.5 rounded-full bg-[#ff7a29]"></span><span class="w-1.5 h-1.5 rounded-full bg-[#ff7a29]"></span><span class="w-1.5 h-1.5 rounded-full bg-[#ff7a29]"></span><span class="w-1.5 h-1.5 rounded-full bg-[#ff7a29]"></span><span class="w-1.5 h-1.5 rounded-full bg-[#ff7a29]"></span><span class="w-1.5 h-1.5 rounded-full bg-[#ff7a29]"></span>
            <span class="w-1.5 h-1.5 rounded-full bg-[#ff7a29]"></span><span class="w-1.5 h-1.5 rounded-full bg-[#ff7a29]"></span><span class="w-1.5 h-1.5 rounded-full bg-[#ff7a29]"></span><span class="w-1.5 h-1.5 rounded-full bg-[#ff7a29]"></span><span class="w-1.5 h-1.5 rounded-full bg-[#ff7a29]"></span><span class="w-1.5 h-1.5 rounded-full bg-[#ff7a29]"></span>
        </div>

        <!-- Decorative Dot Matrix from Mockup (Bottom-Left) -->
        <div class="absolute bottom-6 left-6 hidden xl:grid grid-cols-6 gap-2.5 opacity-25 pointer-events-none">
            <span class="w-1.5 h-1.5 rounded-full bg-[#ff7a29]"></span><span class="w-1.5 h-1.5 rounded-full bg-[#ff7a29]"></span><span class="w-1.5 h-1.5 rounded-full bg-[#ff7a29]"></span><span class="w-1.5 h-1.5 rounded-full bg-[#ff7a29]"></span><span class="w-1.5 h-1.5 rounded-full bg-[#ff7a29]"></span><span class="w-1.5 h-1.5 rounded-full bg-[#ff7a29]"></span>
            <span class="w-1.5 h-1.5 rounded-full bg-[#ff7a29]"></span><span class="w-1.5 h-1.5 rounded-full bg-[#ff7a29]"></span><span class="w-1.5 h-1.5 rounded-full bg-[#ff7a29]"></span><span class="w-1.5 h-1.5 rounded-full bg-[#ff7a29]"></span><span class="w-1.5 h-1.5 rounded-full bg-[#ff7a29]"></span><span class="w-1.5 h-1.5 rounded-full bg-[#ff7a29]"></span>
        </div>

        <div class="w-full max-w-[1720px] mx-auto px-4 sm:px-6 lg:px-8 xl:px-12 2xl:px-16 relative z-10">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-6 xl:gap-8 items-center">
                <!-- Left: Razor-Sharp Vector Typography & Interactive Buttons -->
                <div class="lg:col-span-6 xl:col-span-6 space-y-4 sm:space-y-5 lg:space-y-6">
                    <!-- Eyebrow Pill Tag -->
                    <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-[#fff4ec] border border-[#ffcdb5] text-[#ff5400] text-xs sm:text-sm font-bold tracking-wide font-mono uppercase">
                        <span class="material-symbols-outlined text-[16px]">token</span>
                        <span>DỊCH VỤ CỦA CHÚNG TÔI</span>
                    </div>

                    <!-- Main Heading -->
                    <h1 class="text-3xl sm:text-4xl lg:text-[40px] xl:text-[46px] 2xl:text-[50px] font-black text-[#0c192e] tracking-tight leading-[1.12]">
                        <span class="block whitespace-nowrap">Giải Pháp Truyền Thông</span>
                        <span class="block whitespace-nowrap text-[#ff5400] mt-1 sm:mt-1.5">&amp; Công Nghệ Toàn Diện</span>
                    </h1>

                    <!-- Subtitle -->
                    <p class="text-sm sm:text-base text-slate-500 max-w-xl leading-relaxed font-normal">
                        Từ sáng tạo nội dung, sản xuất media đến giải pháp công nghệ, chúng tôi đồng hành cùng doanh nghiệp kiến tạo giá trị thương hiệu và bứt phá trong kỷ nguyên số.
                    </p>

                    <!-- Buttons -->
                    <div class="pt-2 flex flex-wrap items-center gap-3.5">
                        <a href="#danh-muc-dich-vu" class="inline-flex items-center gap-2 px-7 py-3.5 rounded-full text-white text-xs sm:text-sm font-bold shadow-md shadow-orange-500/20 hover:shadow-lg hover:-translate-y-0.5 transition-all duration-300" style="background: linear-gradient(to right, #ff5400, #ff6a1a); color: #ffffff;">
                            <span>Khám phá dịch vụ</span>
                            <span class="material-symbols-outlined text-[18px]">arrow_forward</span>
                        </a>

                        <a href="{{ route('contact') }}" class="inline-flex items-center gap-2 px-6 py-3.5 rounded-full bg-white border border-slate-200 hover:border-slate-300 hover:bg-slate-50 text-slate-700 text-xs sm:text-sm font-semibold shadow-xs hover:-translate-y-0.5 transition-all duration-300">
                            <span class="material-symbols-outlined text-[18px] text-slate-500">forum</span>
                            <span>Liên hệ tư vấn</span>
                        </a>
                    </div>
                </div>

                <!-- Right: Ultra-Sharp Graphic with Seamless Transparent Borders -->
                <div class="lg:col-span-6 xl:col-span-6 relative flex items-center justify-center lg:justify-end">
                    <img src="{{ asset('images/services/services_hero_showcase.png') }}?v={{ time() }}" 
                         alt="Giải Pháp Truyền Thông & Công Nghệ Toàn Diện Cửu Long" 
                         class="w-full max-w-[680px] xl:max-w-[760px] 2xl:max-w-[820px] h-auto object-contain select-none transition-transform duration-500 hover:scale-[1.01]"
                         loading="eager"
                         fetchpriority="high">
                </div>
            </div>
        </div>
    </section>

    <!-- ==================== 2. SERVICE CATEGORIES ROW (FLOATING CARD CONTAINER) ==================== -->
    <div class="w-full max-w-[1720px] mx-auto px-4 sm:px-6 lg:px-8 xl:px-12 2xl:px-16 -mt-6 sm:-mt-8 relative z-20">
        <div class="bg-white rounded-2xl sm:rounded-3xl p-1.5 sm:p-2 shadow-[0_12px_36px_-6px_rgba(0,0,0,0.08)] border border-slate-100 flex flex-nowrap overflow-x-auto xl:grid xl:grid-cols-7 items-center gap-1 xl:gap-1.5 scrollbar-none">
            <!-- Tab 0: Tất cả dịch vụ (Active by default) -->
            <button type="button" 
                    @click="filterCategory('all')"
                    :class="activeTab === 'all' ? 'text-white shadow-md shadow-orange-500/25' : 'bg-slate-50 text-slate-700 hover:bg-orange-50/50'"
                    :style="activeTab === 'all' ? 'background: linear-gradient(to right, #ff5400, #ff6a1a); color: #ffffff;' : ''"
                    class="py-2.5 px-3 rounded-xl xl:rounded-2xl transition-all duration-300 flex items-center justify-between gap-1.5 text-left group w-full shrink-0 xl:shrink min-w-[140px] xl:min-w-0">
                <div class="flex items-center gap-1.5 min-w-0">
                    <span class="material-symbols-outlined text-[18px] shrink-0">grid_view</span>
                    <span class="text-xs xl:text-[12.5px] 2xl:text-[13px] font-bold whitespace-nowrap truncate">Tất cả dịch vụ</span>
                </div>
                <span class="material-symbols-outlined text-[13px] shrink-0 group-hover:translate-x-0.5 transition-transform">arrow_forward</span>
            </button>

            <!-- Tab 1: Media & Sản Xuất -->
            <button type="button" 
                    @click="filterCategory('media')"
                    :class="activeTab === 'media' ? 'text-white shadow-md shadow-orange-500/25' : 'bg-white hover:bg-slate-50 text-slate-700 border border-slate-100/90'"
                    :style="activeTab === 'media' ? 'background: linear-gradient(to right, #ff5400, #ff6a1a); color: #ffffff;' : ''"
                    class="py-2 px-2 xl:px-2.5 rounded-xl xl:rounded-2xl transition-all duration-300 flex items-center justify-between gap-1 text-left group w-full shrink-0 xl:shrink min-w-[150px] xl:min-w-0">
                <div class="flex items-center gap-1.5 min-w-0">
                    <div class="w-7 h-7 rounded-lg xl:rounded-xl flex items-center justify-center shrink-0" :class="activeTab === 'media' ? 'bg-white/20 text-white' : 'bg-slate-100/90 text-slate-700'">
                        <span class="material-symbols-outlined text-[16px]">videocam</span>
                    </div>
                    <div class="min-w-0">
                        <div class="text-xs xl:text-[12px] 2xl:text-[13px] font-bold truncate leading-tight">Media &amp; Sản Xuất</div>
                        <div class="text-[9px] xl:text-[9.5px] leading-tight mt-0.5 truncate" :class="activeTab === 'media' ? 'text-white/80' : 'text-slate-400'">Video • Hình ảnh • Giải pháp</div>
                    </div>
                </div>
                <span class="material-symbols-outlined text-[12px] shrink-0 group-hover:translate-x-0.5 transition-transform" :class="activeTab === 'media' ? 'text-white' : 'text-slate-400'">arrow_forward</span>
            </button>

            <!-- Tab 2: Web & App -->
            <button type="button" 
                    @click="filterCategory('webapp')"
                    :class="activeTab === 'webapp' ? 'text-white shadow-md shadow-orange-500/25' : 'bg-white hover:bg-slate-50 text-slate-700 border border-slate-100/90'"
                    :style="activeTab === 'webapp' ? 'background: linear-gradient(to right, #ff5400, #ff6a1a); color: #ffffff;' : ''"
                    class="py-2 px-2 xl:px-2.5 rounded-xl xl:rounded-2xl transition-all duration-300 flex items-center justify-between gap-1 text-left group w-full shrink-0 xl:shrink min-w-[150px] xl:min-w-0">
                <div class="flex items-center gap-1.5 min-w-0">
                    <div class="w-7 h-7 rounded-lg xl:rounded-xl flex items-center justify-center shrink-0 font-bold text-xs" :class="activeTab === 'webapp' ? 'bg-white/20 text-white' : 'bg-slate-100/90 text-slate-700'">
                        &lt;/&gt;
                    </div>
                    <div class="min-w-0">
                        <div class="text-xs xl:text-[12px] 2xl:text-[13px] font-bold truncate leading-tight">Web &amp; App</div>
                        <div class="text-[9px] xl:text-[9.5px] leading-tight mt-0.5 truncate" :class="activeTab === 'webapp' ? 'text-white/80' : 'text-slate-400'">Website • Ứng dụng • Số hóa</div>
                    </div>
                </div>
                <span class="material-symbols-outlined text-[12px] shrink-0 group-hover:translate-x-0.5 transition-transform" :class="activeTab === 'webapp' ? 'text-white' : 'text-slate-400'">arrow_forward</span>
            </button>

            <!-- Tab 3: Marketing -->
            <button type="button" 
                    @click="filterCategory('marketing')"
                    :class="activeTab === 'marketing' ? 'text-white shadow-md shadow-orange-500/25' : 'bg-white hover:bg-slate-50 text-slate-700 border border-slate-100/90'"
                    :style="activeTab === 'marketing' ? 'background: linear-gradient(to right, #ff5400, #ff6a1a); color: #ffffff;' : ''"
                    class="py-2 px-2 xl:px-2.5 rounded-xl xl:rounded-2xl transition-all duration-300 flex items-center justify-between gap-1 text-left group w-full shrink-0 xl:shrink min-w-[150px] xl:min-w-0">
                <div class="flex items-center gap-1.5 min-w-0">
                    <div class="w-7 h-7 rounded-lg xl:rounded-xl flex items-center justify-center shrink-0" :class="activeTab === 'marketing' ? 'bg-white/20 text-white' : 'bg-slate-100/90 text-slate-700'">
                        <span class="material-symbols-outlined text-[16px]">campaign</span>
                    </div>
                    <div class="min-w-0">
                        <div class="text-xs xl:text-[12px] 2xl:text-[13px] font-bold truncate leading-tight">Marketing</div>
                        <div class="text-[9px] xl:text-[9.5px] leading-tight mt-0.5 truncate" :class="activeTab === 'marketing' ? 'text-white/80' : 'text-slate-400'">Ads • Facebook • SEO</div>
                    </div>
                </div>
                <span class="material-symbols-outlined text-[12px] shrink-0 group-hover:translate-x-0.5 transition-transform" :class="activeTab === 'marketing' ? 'text-white' : 'text-slate-400'">arrow_forward</span>
            </button>

            <!-- Tab 4: Thiết Kế & Đồ Họa -->
            <button type="button" 
                    @click="filterCategory('design')"
                    :class="activeTab === 'design' ? 'text-white shadow-md shadow-orange-500/25' : 'bg-white hover:bg-slate-50 text-slate-700 border border-slate-100/90'"
                    :style="activeTab === 'design' ? 'background: linear-gradient(to right, #ff5400, #ff6a1a); color: #ffffff;' : ''"
                    class="py-2 px-2 xl:px-2.5 rounded-xl xl:rounded-2xl transition-all duration-300 flex items-center justify-between gap-1 text-left group w-full shrink-0 xl:shrink min-w-[150px] xl:min-w-0">
                <div class="flex items-center gap-1.5 min-w-0">
                    <div class="w-7 h-7 rounded-lg xl:rounded-xl flex items-center justify-center shrink-0" :class="activeTab === 'design' ? 'bg-white/20 text-white' : 'bg-slate-100/90 text-slate-700'">
                        <span class="material-symbols-outlined text-[16px]">draw</span>
                    </div>
                    <div class="min-w-0">
                        <div class="text-xs xl:text-[12px] 2xl:text-[13px] font-bold truncate leading-tight">Thiết Kế &amp; Đồ Họa</div>
                        <div class="text-[9px] xl:text-[9.5px] leading-tight mt-0.5 truncate" :class="activeTab === 'design' ? 'text-white/80' : 'text-slate-400'">Branding • UI/UX • Ấn phẩm</div>
                    </div>
                </div>
                <span class="material-symbols-outlined text-[12px] shrink-0 group-hover:translate-x-0.5 transition-transform" :class="activeTab === 'design' ? 'text-white' : 'text-slate-400'">arrow_forward</span>
            </button>

            <!-- Tab 5: AI & Công Nghệ -->
            <button type="button" 
                    @click="filterCategory('ai')"
                    :class="activeTab === 'ai' ? 'text-white shadow-md shadow-orange-500/25' : 'bg-white hover:bg-slate-50 text-slate-700 border border-slate-100/90'"
                    :style="activeTab === 'ai' ? 'background: linear-gradient(to right, #ff5400, #ff6a1a); color: #ffffff;' : ''"
                    class="py-2 px-2 xl:px-2.5 rounded-xl xl:rounded-2xl transition-all duration-300 flex items-center justify-between gap-1 text-left group w-full shrink-0 xl:shrink min-w-[150px] xl:min-w-0">
                <div class="flex items-center gap-1.5 min-w-0">
                    <div class="w-7 h-7 rounded-lg xl:rounded-xl flex items-center justify-center shrink-0" :class="activeTab === 'ai' ? 'bg-white/20 text-white' : 'bg-slate-100/90 text-slate-700'">
                        <span class="material-symbols-outlined text-[16px]">memory</span>
                    </div>
                    <div class="min-w-0">
                        <div class="text-xs xl:text-[12px] 2xl:text-[13px] font-bold truncate leading-tight">AI &amp; Công Nghệ</div>
                        <div class="text-[9px] xl:text-[9.5px] leading-tight mt-0.5 truncate" :class="activeTab === 'ai' ? 'text-white/80' : 'text-slate-400'">AI Studio • Automation • 3D</div>
                    </div>
                </div>
                <span class="material-symbols-outlined text-[12px] shrink-0 group-hover:translate-x-0.5 transition-transform" :class="activeTab === 'ai' ? 'text-white' : 'text-slate-400'">arrow_forward</span>
            </button>

            <!-- Tab 6: Booking & Sự Kiện -->
            <button type="button" 
                    @click="filterCategory('booking')"
                    :class="activeTab === 'booking' ? 'text-white shadow-md shadow-orange-500/25' : 'bg-white hover:bg-slate-50 text-slate-700 border border-slate-100/90'"
                    :style="activeTab === 'booking' ? 'background: linear-gradient(to right, #ff5400, #ff6a1a); color: #ffffff;' : ''"
                    class="py-2 px-2 xl:px-2.5 rounded-xl xl:rounded-2xl transition-all duration-300 flex items-center justify-between gap-1 text-left group w-full shrink-0 xl:shrink min-w-[150px] xl:min-w-0">
                <div class="flex items-center gap-1.5 min-w-0">
                    <div class="w-7 h-7 rounded-lg xl:rounded-xl flex items-center justify-center shrink-0" :class="activeTab === 'booking' ? 'bg-white/20 text-white' : 'bg-slate-100/90 text-slate-700'">
                        <span class="material-symbols-outlined text-[16px]">calendar_month</span>
                    </div>
                    <div class="min-w-0">
                        <div class="text-xs xl:text-[12px] 2xl:text-[13px] font-bold truncate leading-tight">Booking &amp; Sự Kiện</div>
                        <div class="text-[9px] xl:text-[9.5px] leading-tight mt-0.5 truncate" :class="activeTab === 'booking' ? 'text-white/80' : 'text-slate-400'">Team Media • Quay phim</div>
                    </div>
                </div>
                <span class="material-symbols-outlined text-[12px] shrink-0 group-hover:translate-x-0.5 transition-transform" :class="activeTab === 'booking' ? 'text-white' : 'text-slate-400'">arrow_forward</span>
            </button>
        </div>
    </div>

    <!-- ==================== 3. FEATURED SERVICES (DANH MỤC DỊCH VỤ NỔI BẬT) ==================== -->
    <section id="danh-muc-dich-vu" class="w-full max-w-[1720px] mx-auto px-4 sm:px-6 lg:px-12 xl:px-16 2xl:px-20 mt-8 sm:mt-12 pt-10 sm:pt-14 relative overflow-hidden">
        <!-- Soft Orange Gradient Wave on Left (From Mockup) -->
        <div class="absolute -top-12 -left-20 w-[460px] h-[460px] rounded-full pointer-events-none" 
             style="background: radial-gradient(circle at 20% 30%, rgba(255, 175, 130, 0.35) 0%, rgba(255, 235, 220, 0.15) 50%, transparent 75%); filter: blur(40px);"></div>
        
        <svg class="absolute -left-10 top-0 w-80 h-96 opacity-60 pointer-events-none hidden sm:block" viewBox="0 0 200 240" fill="none">
            <path d="M-40,0 C30,40 50,130 15,200 C-5,240 -20,250 -60,250 Z" fill="url(#peach_wave_grad)" />
            <defs>
                <linearGradient id="peach_wave_grad" x1="0" y1="0" x2="1" y2="1">
                    <stop offset="0%" stop-color="#ffd2b8" stop-opacity="0.7"/>
                    <stop offset="100%" stop-color="#fff5eb" stop-opacity="0.1"/>
                </linearGradient>
            </defs>
        </svg>

        <!-- Dot Matrix Decoration on Right (From Mockup) -->
        <div class="absolute top-10 right-8 hidden xl:grid grid-cols-6 gap-2.5 opacity-35 pointer-events-none">
            <span class="w-1.5 h-1.5 rounded-full bg-[#ff7a29]"></span><span class="w-1.5 h-1.5 rounded-full bg-[#ff7a29]"></span><span class="w-1.5 h-1.5 rounded-full bg-[#ff7a29]"></span><span class="w-1.5 h-1.5 rounded-full bg-[#ff7a29]"></span><span class="w-1.5 h-1.5 rounded-full bg-[#ff7a29]"></span><span class="w-1.5 h-1.5 rounded-full bg-[#ff7a29]"></span>
            <span class="w-1.5 h-1.5 rounded-full bg-[#ff7a29]"></span><span class="w-1.5 h-1.5 rounded-full bg-[#ff7a29]"></span><span class="w-1.5 h-1.5 rounded-full bg-[#ff7a29]"></span><span class="w-1.5 h-1.5 rounded-full bg-[#ff7a29]"></span><span class="w-1.5 h-1.5 rounded-full bg-[#ff7a29]"></span><span class="w-1.5 h-1.5 rounded-full bg-[#ff7a29]"></span>
            <span class="w-1.5 h-1.5 rounded-full bg-[#ff7a29]"></span><span class="w-1.5 h-1.5 rounded-full bg-[#ff7a29]"></span><span class="w-1.5 h-1.5 rounded-full bg-[#ff7a29]"></span><span class="w-1.5 h-1.5 rounded-full bg-[#ff7a29]"></span><span class="w-1.5 h-1.5 rounded-full bg-[#ff7a29]"></span><span class="w-1.5 h-1.5 rounded-full bg-[#ff7a29]"></span>
            <span class="w-1.5 h-1.5 rounded-full bg-[#ff7a29]"></span><span class="w-1.5 h-1.5 rounded-full bg-[#ff7a29]"></span><span class="w-1.5 h-1.5 rounded-full bg-[#ff7a29]"></span><span class="w-1.5 h-1.5 rounded-full bg-[#ff7a29]"></span><span class="w-1.5 h-1.5 rounded-full bg-[#ff7a29]"></span><span class="w-1.5 h-1.5 rounded-full bg-[#ff7a29]"></span>
        </div>

        <!-- Section Header -->
        <div class="text-center max-w-4xl mx-auto mb-12 sm:mb-14 relative z-10 pt-4 sm:pt-6">
            <!-- Eyebrow Pill -->
            <div class="inline-flex items-center gap-1.5 px-3.5 py-1.5 rounded-full bg-[#fff5eb] border border-[#ffcdb5] text-[#ff5400] text-xs font-bold tracking-wide font-mono uppercase shadow-2xs align-middle">
                <span class="material-symbols-outlined text-[15px]">diamond</span>
                <span>DỊCH VỤ NỔI BẬT</span>
            </div>

            <!-- Title & Handwritten Callout -->
            <div class="relative inline-block mt-3 sm:mt-0 sm:ml-3 align-middle">
                <h2 class="text-3xl sm:text-4xl lg:text-[42px] font-black tracking-tight leading-tight">
                    <span class="text-[#0c192e]">Danh Mục Dịch Vụ </span>
                    <span class="text-[#ff5400]">Nổi Bật</span>
                </h2>

                <!-- Handwritten Callout (From Mockup) -->
                <div class="hidden lg:block pointer-events-none select-none z-30"
                     style="position: absolute; top: -48px; right: -210px; width: 235px;">
                    <img src="{{ asset('images/services/services_handwritten_callout.png') }}?v={{ time() }}" 
                         alt="Giải pháp toàn diện cho thương hiệu của bạn!" 
                         class="w-full h-auto drop-shadow-xs"
                         style="filter: contrast(1.15) saturate(1.1);">
                </div>
            </div>

            <!-- Subtitle -->
            <p class="text-xs sm:text-sm text-slate-500 font-normal leading-relaxed max-w-2xl mx-auto mt-3">
                Chúng tôi cung cấp các dịch vụ chuyên nghiệp, đáp ứng đa dạng nhu cầu của doanh nghiệp trong lĩnh vực truyền thông, marketing và công nghệ.
            </p>
        </div>

        <!-- Service Cards Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 sm:gap-7 relative z-10">
            <!-- Card 1: Quay Phim Sự Kiện & Team Building -->
            <div x-show="activeTab === 'all' || activeTab === 'media'" 
                 class="bg-white rounded-[28px] sm:rounded-[32px] p-4 sm:p-5 border border-slate-100 shadow-[0_10px_30px_-5px_rgba(0,0,0,0.06)] hover:shadow-2xl hover:border-orange-200/90 hover:-translate-y-1.5 transition-all duration-300 flex flex-col justify-between group relative overflow-hidden">
                <!-- Top Image -->
                <div class="relative rounded-2xl overflow-hidden aspect-[16/10] bg-slate-100">
                    <img src="{{ asset('images/services/service_card_1_film.png') }}?v={{ time() }}" 
                         alt="Quay Phim Sự Kiện & Team Building" 
                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    <!-- Badge 01 -->
                    <span class="absolute top-2.5 left-2.5 px-2.5 py-0.5 rounded-lg text-white text-xs font-black shadow-xs tracking-wider"
                          style="background: linear-gradient(135deg, #ff7a1a 0%, #ff4800 100%);">
                        01
                    </span>
                </div>

                <!-- Floating Icon -->
                <div class="relative -mt-6 sm:-mt-7 ml-3.5 sm:ml-4 z-10 w-12 h-12 rounded-2xl flex items-center justify-center"
                     style="background: linear-gradient(135deg, #ff6a1a 0%, #ff4800 100%); color: #ffffff; box-shadow: 0 0 0 4px #ffffff, 0 10px 24px -4px rgba(255, 84, 0, 0.4);">
                    <span class="material-symbols-outlined text-[24px]" style="color: #ffffff;">videocam</span>
                </div>

                <!-- Card Body -->
                <div class="pt-3 px-1 space-y-3 flex-1 flex flex-col justify-between">
                    <div class="space-y-2.5">
                        <h3 class="text-base sm:text-lg lg:text-[19px] font-extrabold text-[#0c192e] group-hover:text-[#ff5400] transition-colors leading-snug">
                            Quay Phim Sự Kiện &amp; Team Building
                        </h3>
                        <p class="text-xs sm:text-[13px] text-slate-500 leading-relaxed font-normal">
                            Tạo nên những thước phim sống động, ghi lại khoảnh khắc đáng nhớ và lan tỏa giá trị thương hiệu.
                        </p>
                        <ul class="pt-1 space-y-1.5 text-xs sm:text-[13px] text-slate-600 font-normal">
                            <li class="flex items-center gap-2.5">
                                <span class="text-[#ff5400] font-bold text-sm leading-none shrink-0">✓</span>
                                <span>Quay phim sự kiện, hội nghị, hội thảo</span>
                            </li>
                            <li class="flex items-center gap-2.5">
                                <span class="text-[#ff5400] font-bold text-sm leading-none shrink-0">✓</span>
                                <span>Sản xuất phim doanh nghiệp</span>
                            </li>
                            <li class="flex items-center gap-2.5">
                                <span class="text-[#ff5400] font-bold text-sm leading-none shrink-0">✓</span>
                                <span>TVC quảng cáo, video viral</span>
                            </li>
                            <li class="flex items-center gap-2.5">
                                <span class="text-[#ff5400] font-bold text-sm leading-none shrink-0">✓</span>
                                <span>Chụp ảnh sự kiện</span>
                            </li>
                        </ul>
                    </div>

                    <!-- Footer Link -->
                    <div class="pt-5 mt-2 border-t border-slate-100/90 flex items-center justify-between">
                        <a href="{{ route('services.media') }}" class="inline-flex items-center gap-1.5 text-xs sm:text-[13px] font-bold text-[#ff5400] hover:text-[#d94800] group/link">
                            <span>Xem chi tiết</span>
                            <span class="material-symbols-outlined text-[16px] group-hover/link:translate-x-1 transition-transform">arrow_forward</span>
                        </a>
                    </div>
                </div>

                <!-- Watermark Petal with Number in bottom-right corner -->
                <div class="absolute bottom-0 right-0 w-24 h-12 flex items-center justify-center pl-3 pt-1 pointer-events-none select-none"
                     style="background: linear-gradient(135deg, #fffbf8 0%, #fff1e8 100%); border-top: 1px solid #fdd1b5; border-left: 1px solid #fdd1b5; border-top-left-radius: 38px;">
                    <span class="font-black italic text-xl tracking-tight" style="color: #f8be9c;">01</span>
                </div>
            </div>

            <!-- Card 2: Thiết Kế & Lập trình Web - App -->
            <div x-show="activeTab === 'all' || activeTab === 'webapp'" 
                 class="bg-white rounded-[28px] sm:rounded-[32px] p-4 sm:p-5 border border-slate-100 shadow-[0_10px_30px_-5px_rgba(0,0,0,0.06)] hover:shadow-2xl hover:border-orange-200/90 hover:-translate-y-1.5 transition-all duration-300 flex flex-col justify-between group relative overflow-hidden">
                <!-- Top Image -->
                <div class="relative rounded-2xl overflow-hidden aspect-[16/10] bg-slate-100">
                    <img src="{{ asset('images/services/service_card_2_webapp.png') }}?v={{ time() }}" 
                         alt="Thiết Kế & Lập trình Web - App" 
                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    <!-- Badge 02 -->
                    <span class="absolute top-2.5 left-2.5 px-2.5 py-0.5 rounded-lg text-white text-xs font-black shadow-xs tracking-wider"
                          style="background: linear-gradient(135deg, #ff7a1a 0%, #ff4800 100%);">
                        02
                    </span>
                </div>

                <!-- Floating Icon -->
                <div class="relative -mt-6 sm:-mt-7 ml-3.5 sm:ml-4 z-10 w-12 h-12 rounded-2xl flex items-center justify-center"
                     style="background: linear-gradient(135deg, #ff6a1a 0%, #ff4800 100%); color: #ffffff; box-shadow: 0 0 0 4px #ffffff, 0 10px 24px -4px rgba(255, 84, 0, 0.4);">
                    <span class="font-mono font-bold text-[18px]" style="color: #ffffff;">&lt;/&gt;</span>
                </div>

                <!-- Card Body -->
                <div class="pt-3 px-1 space-y-3 flex-1 flex flex-col justify-between">
                    <div class="space-y-2.5">
                        <h3 class="text-base sm:text-lg lg:text-[19px] font-extrabold text-[#0c192e] group-hover:text-[#ff5400] transition-colors leading-snug">
                            Thiết Kế &amp; Lập trình Web - App
                        </h3>
                        <p class="text-xs sm:text-[13px] text-slate-500 leading-relaxed font-normal">
                            Xây dựng website, ứng dụng theo yêu cầu, giải pháp tối ưu cho doanh nghiệp.
                        </p>
                        <ul class="pt-1 space-y-1.5 text-xs sm:text-[13px] text-slate-600 font-normal">
                            <li class="flex items-center gap-2.5">
                                <span class="text-[#ff5400] font-bold text-sm leading-none shrink-0">✓</span>
                                <span>Website doanh nghiệp, landing page</span>
                            </li>
                            <li class="flex items-center gap-2.5">
                                <span class="text-[#ff5400] font-bold text-sm leading-none shrink-0">✓</span>
                                <span>Web app, hệ thống quản lý</span>
                            </li>
                            <li class="flex items-center gap-2.5">
                                <span class="text-[#ff5400] font-bold text-sm leading-none shrink-0">✓</span>
                                <span>UI/UX, giao diện hiện đại</span>
                            </li>
                            <li class="flex items-center gap-2.5">
                                <span class="text-[#ff5400] font-bold text-sm leading-none shrink-0">✓</span>
                                <span>Bảo trì &amp; nâng cấp</span>
                            </li>
                        </ul>
                    </div>

                    <!-- Footer Link -->
                    <div class="pt-5 mt-2 border-t border-slate-100/90 flex items-center justify-between">
                        <a href="{{ route('templates.index') }}" class="inline-flex items-center gap-1.5 text-xs sm:text-[13px] font-bold text-[#ff5400] hover:text-[#d94800] group/link">
                            <span>Xem chi tiết</span>
                            <span class="material-symbols-outlined text-[16px] group-hover/link:translate-x-1 transition-transform">arrow_forward</span>
                        </a>
                    </div>
                </div>

                <!-- Watermark Petal with Number in bottom-right corner -->
                <div class="absolute bottom-0 right-0 w-24 h-12 flex items-center justify-center pl-3 pt-1 pointer-events-none select-none"
                     style="background: linear-gradient(135deg, #fffbf8 0%, #fff1e8 100%); border-top: 1px solid #fdd1b5; border-left: 1px solid #fdd1b5; border-top-left-radius: 38px;">
                    <span class="font-black italic text-xl tracking-tight" style="color: #f8be9c;">02</span>
                </div>
            </div>

            <!-- Card 3: Quảng Cáo Google Ads & Facebook -->
            <div x-show="activeTab === 'all' || activeTab === 'marketing'" 
                 class="bg-white rounded-[28px] sm:rounded-[32px] p-4 sm:p-5 border border-slate-100 shadow-[0_10px_30px_-5px_rgba(0,0,0,0.06)] hover:shadow-2xl hover:border-orange-200/90 hover:-translate-y-1.5 transition-all duration-300 flex flex-col justify-between group relative overflow-hidden">
                <!-- Top Image -->
                <div class="relative rounded-2xl overflow-hidden aspect-[16/10] bg-slate-100">
                    <img src="{{ asset('images/services/service_card_3_ads.png') }}?v={{ time() }}" 
                         alt="Quảng Cáo Google Ads & Facebook" 
                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    <!-- Badge 03 -->
                    <span class="absolute top-2.5 left-2.5 px-2.5 py-0.5 rounded-lg text-white text-xs font-black shadow-xs tracking-wider"
                          style="background: linear-gradient(135deg, #ff7a1a 0%, #ff4800 100%);">
                        03
                    </span>
                </div>

                <!-- Floating Icon -->
                <div class="relative -mt-6 sm:-mt-7 ml-3.5 sm:ml-4 z-10 w-12 h-12 rounded-2xl flex items-center justify-center"
                     style="background: linear-gradient(135deg, #ff6a1a 0%, #ff4800 100%); color: #ffffff; box-shadow: 0 0 0 4px #ffffff, 0 10px 24px -4px rgba(255, 84, 0, 0.4);">
                    <span class="material-symbols-outlined text-[24px]" style="color: #ffffff;">campaign</span>
                </div>

                <!-- Card Body -->
                <div class="pt-3 px-1 space-y-3 flex-1 flex flex-col justify-between">
                    <div class="space-y-2.5">
                        <h3 class="text-base sm:text-lg lg:text-[19px] font-extrabold text-[#0c192e] group-hover:text-[#ff5400] transition-colors leading-snug">
                            Quảng Cáo Google Ads &amp; Facebook
                        </h3>
                        <p class="text-xs sm:text-[13px] text-slate-500 leading-relaxed font-normal">
                            Gia tăng nhận diện thương hiệu, tiếp cận đúng khách hàng mục tiêu với chi phí tối ưu.
                        </p>
                        <ul class="pt-1 space-y-1.5 text-xs sm:text-[13px] text-slate-600 font-normal">
                            <li class="flex items-center gap-2.5">
                                <span class="text-[#ff5400] font-bold text-sm leading-none shrink-0">✓</span>
                                <span>Quảng cáo Google Ads</span>
                            </li>
                            <li class="flex items-center gap-2.5">
                                <span class="text-[#ff5400] font-bold text-sm leading-none shrink-0">✓</span>
                                <span>Quảng cáo Facebook Ads</span>
                            </li>
                            <li class="flex items-center gap-2.5">
                                <span class="text-[#ff5400] font-bold text-sm leading-none shrink-0">✓</span>
                                <span>SEO từ khóa</span>
                            </li>
                            <li class="flex items-center gap-2.5">
                                <span class="text-[#ff5400] font-bold text-sm leading-none shrink-0">✓</span>
                                <span>Social Media Marketing</span>
                            </li>
                        </ul>
                    </div>

                    <!-- Footer Link -->
                    <div class="pt-5 mt-2 border-t border-slate-100/90 flex items-center justify-between">
                        <a href="{{ route('contact') }}" class="inline-flex items-center gap-1.5 text-xs sm:text-[13px] font-bold text-[#ff5400] hover:text-[#d94800] group/link">
                            <span>Xem chi tiết</span>
                            <span class="material-symbols-outlined text-[16px] group-hover/link:translate-x-1 transition-transform">arrow_forward</span>
                        </a>
                    </div>
                </div>

                <!-- Watermark Petal with Number in bottom-right corner -->
                <div class="absolute bottom-0 right-0 w-24 h-12 flex items-center justify-center pl-3 pt-1 pointer-events-none select-none"
                     style="background: linear-gradient(135deg, #fffbf8 0%, #fff1e8 100%); border-top: 1px solid #fdd1b5; border-left: 1px solid #fdd1b5; border-top-left-radius: 38px;">
                    <span class="font-black italic text-xl tracking-tight" style="color: #f8be9c;">03</span>
                </div>
            </div>

            <!-- Card 4: 3D Motion Design & AI Studio -->
            <div x-show="activeTab === 'all' || activeTab === 'design' || activeTab === 'ai' || activeTab === 'media'" 
                 class="bg-white rounded-[28px] sm:rounded-[32px] p-4 sm:p-5 border border-slate-100 shadow-[0_10px_30px_-5px_rgba(0,0,0,0.06)] hover:shadow-2xl hover:border-orange-200/90 hover:-translate-y-1.5 transition-all duration-300 flex flex-col justify-between group relative overflow-hidden">
                <!-- Top Image -->
                <div class="relative rounded-2xl overflow-hidden aspect-[16/10] bg-slate-100">
                    <img src="{{ asset('images/services/service_card_4_ai3d.png') }}?v={{ time() }}" 
                         alt="3D Motion Design & AI Studio" 
                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    <!-- Badge 04 -->
                    <span class="absolute top-2.5 left-2.5 px-2.5 py-0.5 rounded-lg text-white text-xs font-black shadow-xs tracking-wider"
                          style="background: linear-gradient(135deg, #ff7a1a 0%, #ff5400 100%);">
                        04
                    </span>
                </div>

                <!-- Floating Icon -->
                <div class="relative -mt-6 sm:-mt-7 ml-3.5 sm:ml-4 z-10 w-12 h-12 rounded-2xl flex items-center justify-center"
                     style="background: linear-gradient(135deg, #ff6a1a 0%, #ff4800 100%); color: #ffffff; box-shadow: 0 0 0 4px #ffffff, 0 10px 24px -4px rgba(255, 84, 0, 0.4);">
                    <span class="material-symbols-outlined text-[24px]" style="color: #ffffff;">view_in_ar</span>
                </div>

                <!-- Card Body -->
                <div class="pt-3 px-1 space-y-3 flex-1 flex flex-col justify-between">
                    <div class="space-y-2.5">
                        <h3 class="text-base sm:text-lg lg:text-[19px] font-extrabold text-[#0c192e] group-hover:text-[#ff5400] transition-colors leading-snug">
                            3D Motion Design &amp; AI Studio
                        </h3>
                        <p class="text-xs sm:text-[13px] text-slate-500 leading-relaxed font-normal">
                            Kết hợp công nghệ hiện đại để tạo ra những sản phẩm truyền thông ấn tượng, khác biệt.
                        </p>
                        <ul class="pt-1 space-y-1.5 text-xs sm:text-[13px] text-slate-600 font-normal">
                            <li class="flex items-center gap-2.5">
                                <span class="text-[#ff5400] font-bold text-sm leading-none shrink-0">✓</span>
                                <span>3D Animation, Motion Graphic</span>
                            </li>
                            <li class="flex items-center gap-2.5">
                                <span class="text-[#ff5400] font-bold text-sm leading-none shrink-0">✓</span>
                                <span>Video AI, hình ảnh AI</span>
                            </li>
                            <li class="flex items-center gap-2.5">
                                <span class="text-[#ff5400] font-bold text-sm leading-none shrink-0">✓</span>
                                <span>Sản xuất nội dung sáng tạo</span>
                            </li>
                            <li class="flex items-center gap-2.5">
                                <span class="text-[#ff5400] font-bold text-sm leading-none shrink-0">✓</span>
                                <span>Thiết kế sản phẩm 3D</span>
                            </li>
                        </ul>
                    </div>

                    <!-- Footer Link -->
                    <div class="pt-5 mt-2 border-t border-slate-100/90 flex items-center justify-between">
                        <a href="{{ route('services.media') }}" class="inline-flex items-center gap-1.5 text-xs sm:text-[13px] font-bold text-[#ff5400] hover:text-[#d94800] group/link">
                            <span>Xem chi tiết</span>
                            <span class="material-symbols-outlined text-[16px] group-hover/link:translate-x-1 transition-transform">arrow_forward</span>
                        </a>
                    </div>
                </div>

                <!-- Watermark Petal with Number in bottom-right corner -->
                <div class="absolute bottom-0 right-0 w-24 h-12 flex items-center justify-center pl-3 pt-1 pointer-events-none select-none"
                     style="background: linear-gradient(135deg, #fffbf8 0%, #fff1e8 100%); border-top: 1px solid #fdd1b5; border-left: 1px solid #fdd1b5; border-top-left-radius: 38px;">
                    <span class="font-black italic text-xl tracking-tight" style="color: #f8be9c;">04</span>
                </div>
            </div>

            <!-- Card 5: Booking Team Media -->
            <div x-show="activeTab === 'all' || activeTab === 'booking' || activeTab === 'media'" 
                 class="bg-white rounded-[28px] sm:rounded-[32px] p-4 sm:p-5 border border-slate-100 shadow-[0_10px_30px_-5px_rgba(0,0,0,0.06)] hover:shadow-2xl hover:border-orange-200/90 hover:-translate-y-1.5 transition-all duration-300 flex flex-col justify-between group relative overflow-hidden">
                <!-- Top Image -->
                <div class="relative rounded-2xl overflow-hidden aspect-[16/10] bg-slate-100">
                    <img src="{{ asset('images/services/service_card_5_booking.png') }}?v={{ time() }}" 
                         alt="Booking Team Media" 
                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    <!-- Badge 05 -->
                    <span class="absolute top-2.5 left-2.5 px-2.5 py-0.5 rounded-lg text-white text-xs font-black shadow-xs tracking-wider"
                          style="background: linear-gradient(135deg, #ff7a1a 0%, #ff5400 100%);">
                        05
                    </span>
                </div>

                <!-- Floating Icon -->
                <div class="relative -mt-6 sm:-mt-7 ml-3.5 sm:ml-4 z-10 w-12 h-12 rounded-2xl flex items-center justify-center"
                     style="background: linear-gradient(135deg, #ff6a1a 0%, #ff4800 100%); color: #ffffff; box-shadow: 0 0 0 4px #ffffff, 0 10px 24px -4px rgba(255, 84, 0, 0.4);">
                    <span class="material-symbols-outlined text-[24px]" style="color: #ffffff;">calendar_month</span>
                </div>

                <!-- Card Body -->
                <div class="pt-3 px-1 space-y-3 flex-1 flex flex-col justify-between">
                    <div class="space-y-2.5">
                        <h3 class="text-base sm:text-lg lg:text-[19px] font-extrabold text-[#0c192e] group-hover:text-[#ff5400] transition-colors leading-snug">
                            Booking Team Media
                        </h3>
                        <p class="text-xs sm:text-[13px] text-slate-500 leading-relaxed font-normal">
                            Kết nối với đội ngũ media chuyên nghiệp, sẵn sàng cho mọi dự án của bạn.
                        </p>
                        <ul class="pt-1 space-y-1.5 text-xs sm:text-[13px] text-slate-600 font-normal">
                            <li class="flex items-center gap-2.5">
                                <span class="text-[#ff5400] font-bold text-sm leading-none shrink-0">✓</span>
                                <span>Booking ekip quay phim, chụp ảnh</span>
                            </li>
                            <li class="flex items-center gap-2.5">
                                <span class="text-[#ff5400] font-bold text-sm leading-none shrink-0">✓</span>
                                <span>Booking KOL/Influencer</span>
                            </li>
                            <li class="flex items-center gap-2.5">
                                <span class="text-[#ff5400] font-bold text-sm leading-none shrink-0">✓</span>
                                <span>Thuê studio, thiết bị</span>
                            </li>
                            <li class="flex items-center gap-2.5">
                                <span class="text-[#ff5400] font-bold text-sm leading-none shrink-0">✓</span>
                                <span>Tổ chức sự kiện, Livestream</span>
                            </li>
                        </ul>
                    </div>

                    <!-- Footer Link -->
                    <div class="pt-5 mt-2 border-t border-slate-100/90 flex items-center justify-between">
                        <a href="{{ route('booking') }}" class="inline-flex items-center gap-1.5 text-xs sm:text-[13px] font-bold text-[#ff5400] hover:text-[#d94800] group/link">
                            <span>Xem chi tiết</span>
                            <span class="material-symbols-outlined text-[16px] group-hover/link:translate-x-1 transition-transform">arrow_forward</span>
                        </a>
                    </div>
                </div>

                <!-- Watermark Petal with Number in bottom-right corner -->
                <div class="absolute bottom-0 right-0 w-24 h-12 flex items-center justify-center pl-3 pt-1 pointer-events-none select-none"
                     style="background: linear-gradient(135deg, #fffbf8 0%, #fff1e8 100%); border-top: 1px solid #fdd1b5; border-left: 1px solid #fdd1b5; border-top-left-radius: 38px;">
                    <span class="font-black italic text-xl tracking-tight" style="color: #f8be9c;">05</span>
                </div>
            </div>

            <!-- Card 6: Thiết Kế Thương Hiệu & Đồ Họa -->
            <div x-show="activeTab === 'all' || activeTab === 'design'" 
                 class="bg-white rounded-[28px] sm:rounded-[32px] p-4 sm:p-5 border border-slate-100 shadow-[0_10px_30px_-5px_rgba(0,0,0,0.06)] hover:shadow-2xl hover:border-orange-200/90 hover:-translate-y-1.5 transition-all duration-300 flex flex-col justify-between group relative overflow-hidden">
                <!-- Top Image -->
                <div class="relative rounded-2xl overflow-hidden aspect-[16/10] bg-slate-100">
                    <img src="{{ asset('images/services/service_card_6_branding.png') }}?v={{ time() }}" 
                         alt="Thiết Kế Thương Hiệu & Đồ Họa" 
                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    <!-- Badge 06 -->
                    <span class="absolute top-2.5 left-2.5 px-2.5 py-0.5 rounded-lg text-white text-xs font-black shadow-xs tracking-wider"
                          style="background: linear-gradient(135deg, #ff7a1a 0%, #ff5400 100%);">
                        06
                    </span>
                </div>

                <!-- Floating Icon -->
                <div class="relative -mt-6 sm:-mt-7 ml-3.5 sm:ml-4 z-10 w-12 h-12 rounded-2xl flex items-center justify-center"
                     style="background: linear-gradient(135deg, #ff6a1a 0%, #ff4800 100%); color: #ffffff; box-shadow: 0 0 0 4px #ffffff, 0 10px 24px -4px rgba(255, 84, 0, 0.4);">
                    <span class="material-symbols-outlined text-[24px]" style="color: #ffffff;">draw</span>
                </div>

                <!-- Card Body -->
                <div class="pt-3 px-1 space-y-3 flex-1 flex flex-col justify-between">
                    <div class="space-y-2.5">
                        <h3 class="text-base sm:text-lg lg:text-[19px] font-extrabold text-[#0c192e] group-hover:text-[#ff5400] transition-colors leading-snug">
                            Thiết Kế Thương Hiệu &amp; Đồ Họa
                        </h3>
                        <p class="text-xs sm:text-[13px] text-slate-500 leading-relaxed font-normal">
                            Định hình bản sắc trực quan ấn tượng, chuyên nghiệp và đồng bộ cho doanh nghiệp.
                        </p>
                        <ul class="pt-1 space-y-1.5 text-xs sm:text-[13px] text-slate-600 font-normal">
                            <li class="flex items-center gap-2.5">
                                <span class="text-[#ff5400] font-bold text-sm leading-none shrink-0">✓</span>
                                <span>Bộ nhận diện thương hiệu, Logo Guideline</span>
                            </li>
                            <li class="flex items-center gap-2.5">
                                <span class="text-[#ff5400] font-bold text-sm leading-none shrink-0">✓</span>
                                <span>Profile doanh nghiệp, Catalogue, Brochure</span>
                            </li>
                            <li class="flex items-center gap-2.5">
                                <span class="text-[#ff5400] font-bold text-sm leading-none shrink-0">✓</span>
                                <span>Bao bì sản phẩm, tem nhãn chuyên nghiệp</span>
                            </li>
                            <li class="flex items-center gap-2.5">
                                <span class="text-[#ff5400] font-bold text-sm leading-none shrink-0">✓</span>
                                <span>Ấn phẩm truyền thông số &amp; POSM sự kiện</span>
                            </li>
                        </ul>
                    </div>

                    <!-- Footer Link -->
                    <div class="pt-5 mt-2 border-t border-slate-100/90 flex items-center justify-between">
                        <a href="{{ route('contact') }}" class="inline-flex items-center gap-1.5 text-xs sm:text-[13px] font-bold text-[#ff5400] hover:text-[#d94800] group/link">
                            <span>Xem chi tiết</span>
                            <span class="material-symbols-outlined text-[16px] group-hover/link:translate-x-1 transition-transform">arrow_forward</span>
                        </a>
                    </div>
                </div>

                <!-- Watermark Petal with Number in bottom-right corner -->
                <div class="absolute bottom-0 right-0 w-24 h-12 flex items-center justify-center pl-3 pt-1 pointer-events-none select-none"
                     style="background: linear-gradient(135deg, #fffbf8 0%, #fff1e8 100%); border-top: 1px solid #fdd1b5; border-left: 1px solid #fdd1b5; border-top-left-radius: 38px;">
                    <span class="font-black italic text-xl tracking-tight" style="color: #f8be9c;">06</span>
                </div>
            </div>
        </div>
    </section>

    <!-- ==================== 4. LỢI THẾ CỦA TRUYỀN THÔNG CỬU LONG ==================== -->
    <section class="w-full max-w-[1720px] mx-auto px-4 sm:px-6 lg:px-12 xl:px-16 2xl:px-20 mt-16 sm:mt-24">
        <div class="rounded-[32px] p-8 sm:p-10 lg:p-12 relative overflow-hidden border border-[#fee8d8] shadow-xs" style="background-color: #fff8f0;">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-10 items-center relative z-10">
                <!-- Left: Title, Intro & Button -->
                <div class="lg:col-span-4 xl:col-span-4 space-y-4">
                    <div class="inline-flex items-center gap-1.5 text-xs font-bold text-[#ff5400] uppercase tracking-wider font-mono">
                        <span class="text-sm font-black">*</span>
                        <span>TẠI SAO CHỌN CHÚNG TÔI?</span>
                    </div>
                    <h3 class="text-2xl sm:text-3xl lg:text-[34px] font-extrabold text-[#0b1a30] tracking-tight leading-tight">
                        Lợi Thế Của Truyền<br class="hidden sm:inline">
                        Thông Cửu Long
                    </h3>
                    <p class="text-xs sm:text-sm text-slate-600 leading-relaxed font-normal max-w-sm">
                        Không chỉ là nhà cung cấp dịch vụ, chúng tôi là đối tác đồng hành trên hành trình phát triển thương hiệu của bạn.
                    </p>
                    <div class="pt-2">
                        <a href="{{ route('about') }}" class="inline-flex items-center gap-2 px-6 py-3 rounded-full text-white text-xs sm:text-sm font-bold shadow-md hover:shadow-lg hover:scale-105 transition-all" style="background-color: #ff5400; color: #ffffff;">
                            <span>Về chúng tôi</span>
                            <span class="material-symbols-outlined text-[16px]">arrow_forward</span>
                        </a>
                    </div>
                </div>

                <!-- Right: 4 Centered Feature Cards Grid -->
                <div class="lg:col-span-8 xl:col-span-8 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-4">
                    <!-- Feature 1: Kinh nghiệm thực chiến -->
                    <div class="bg-white rounded-2xl p-6 shadow-sm border border-orange-100/70 hover:shadow-md hover:-translate-y-1 transition-all duration-300 flex flex-col items-center text-center justify-between min-h-[210px]">
                        <div class="w-14 h-14 rounded-full bg-orange-50/90 text-[#ff5400] flex items-center justify-center shrink-0 mb-3.5 border border-orange-100/80">
                            <span class="material-symbols-outlined text-[28px]">lightbulb</span>
                        </div>
                        <div class="space-y-1.5">
                            <h4 class="text-sm sm:text-base font-bold text-[#0b1a30] leading-snug">Kinh nghiệm thực chiến</h4>
                            <p class="text-xs text-slate-500 leading-relaxed font-normal">
                                Đội ngũ giàu kinh nghiệm, đã triển khai hàng trăm dự án thực tế.
                            </p>
                        </div>
                    </div>

                    <!-- Feature 2: Sáng tạo không giới hạn -->
                    <div class="bg-white rounded-2xl p-6 shadow-sm border border-orange-100/70 hover:shadow-md hover:-translate-y-1 transition-all duration-300 flex flex-col items-center text-center justify-between min-h-[210px]">
                        <div class="w-14 h-14 rounded-full bg-orange-50/90 text-[#ff5400] flex items-center justify-center shrink-0 mb-3.5 border border-orange-100/80">
                            <span class="material-symbols-outlined text-[28px]">favorite</span>
                        </div>
                        <div class="space-y-1.5">
                            <h4 class="text-sm sm:text-base font-bold text-[#0b1a30] leading-snug">Sáng tạo không giới hạn</h4>
                            <p class="text-xs text-slate-500 leading-relaxed font-normal">
                                Luôn mang đến những ý tưởng mới mẻ, khác biệt và hiệu quả.
                            </p>
                        </div>
                    </div>

                    <!-- Feature 3: Cam kết chất lượng -->
                    <div class="bg-white rounded-2xl p-6 shadow-sm border border-orange-100/70 hover:shadow-md hover:-translate-y-1 transition-all duration-300 flex flex-col items-center text-center justify-between min-h-[210px]">
                        <div class="w-14 h-14 rounded-full bg-orange-50/90 text-[#ff5400] flex items-center justify-center shrink-0 mb-3.5 border border-orange-100/80">
                            <span class="material-symbols-outlined text-[28px]">verified_user</span>
                        </div>
                        <div class="space-y-1.5">
                            <h4 class="text-sm sm:text-base font-bold text-[#0b1a30] leading-snug">Cam kết chất lượng</h4>
                            <p class="text-xs text-slate-500 leading-relaxed font-normal">
                                Đúng tiến độ, đúng yêu cầu, hiệu quả đo lường rõ ràng.
                            </p>
                        </div>
                    </div>

                    <!-- Feature 4: Đồng hành lâu dài -->
                    <div class="bg-white rounded-2xl p-6 shadow-sm border border-orange-100/70 hover:shadow-md hover:-translate-y-1 transition-all duration-300 flex flex-col items-center text-center justify-between min-h-[210px]">
                        <div class="w-14 h-14 rounded-full bg-orange-50/90 text-[#ff5400] flex items-center justify-center shrink-0 mb-3.5 border border-orange-100/80">
                            <span class="material-symbols-outlined text-[28px]">groups</span>
                        </div>
                        <div class="space-y-1.5">
                            <h4 class="text-sm sm:text-base font-bold text-[#0b1a30] leading-snug">Đồng hành lâu dài</h4>
                            <p class="text-xs text-slate-500 leading-relaxed font-normal">
                                Hỗ trợ và tối ưu liên tục sau khi dự án hoàn thành.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ==================== 5. FULL-WIDTH CTA BANNER (FLUSH TO FOOTER) ==================== -->
    <section class="w-full mt-16 sm:mt-24 relative overflow-hidden" style="background-color: #0c1722;">
        <div class="w-full grid grid-cols-1 lg:grid-cols-12 min-h-[300px] lg:min-h-[340px] items-stretch relative" style="background-color: #0c1722;">
            <!-- Left Info Block -->
            <div class="lg:col-span-7 xl:col-span-7 px-6 sm:px-12 lg:px-16 xl:px-20 py-12 sm:py-16 flex flex-col justify-center relative z-20" style="background-color: #0c1722;">
                <div class="space-y-4 max-w-xl">
                    <div class="inline-flex items-center gap-1.5 text-xs font-bold uppercase font-mono tracking-wider" style="color: #ff751a;">
                        <span class="text-sm font-black">*</span>
                        <span>SẴN SÀNG BẮT ĐẦU?</span>
                    </div>
                    <h3 class="text-2xl sm:text-3xl lg:text-[38px] font-extrabold text-white tracking-tight leading-[1.2]">
                        Bạn Đang Có Một Bài Toán<br>
                        Cần Giải Quyết?
                    </h3>
                    <p class="text-xs sm:text-sm leading-relaxed font-normal max-w-lg" style="color: #cbd5e1;">
                        Hãy để Truyền Thông Cửu Long đồng hành cùng bạn. Liên hệ ngay để được tư vấn giải pháp phù hợp nhất với nhu cầu của doanh nghiệp.
                    </p>
                    <div class="pt-3 flex flex-wrap items-center gap-3.5">
                        <a href="{{ route('contact') }}" class="px-7 py-3 rounded-full text-white text-xs sm:text-sm font-bold shadow-md hover:shadow-lg hover:scale-105 transition-all flex items-center gap-2" style="background-color: #ff5400; color: #ffffff;">
                            <span>Liên hệ ngay</span>
                            <span class="material-symbols-outlined text-[16px]">arrow_forward</span>
                        </a>
                        <a href="{{ route('projects.index') }}" class="px-6 py-3 rounded-full text-xs sm:text-sm font-semibold transition-all flex items-center gap-2 shadow-xs hover:bg-[#162338]" style="background-color: rgba(255, 255, 255, 0.08); border: 1px solid rgba(255, 255, 255, 0.25); color: #ffffff;">
                            <span class="material-symbols-outlined text-[16px]">grid_view</span>
                            <span>Xem các dự án khác</span>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Right Photo Block: Orange Diagonal Polygon + Laptop + Desk + Coffee + Plant -->
            <div class="lg:col-span-5 xl:col-span-5 relative overflow-hidden min-h-[260px] lg:min-h-full" style="background-color: #0c1722;">
                <img src="{{ asset('images/services/services_cta_laptop.png') }}?v={{ time() }}" 
                     alt="Truyền Thông Cửu Long Workspace" 
                     class="w-full h-full object-cover object-left lg:object-center">
            </div>
        </div>
    </section>

</div>
@endsection
