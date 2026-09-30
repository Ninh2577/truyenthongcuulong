<!-- ==================== NECKLE REAL ESTATE PORTAL (SATEK EXACT BENCHMARK) ==================== -->
<div class="w-full bg-[#f8fafc] text-slate-800 font-sans" x-data="{
    filterTab: 'all',
    searchType: 'sale',
    keyword: '',
    city: 'all'
}">

    <!-- Top Announcement Strip -->
    <div class="bg-[#111827] text-white text-xs py-2 px-4 sm:px-8 flex items-center justify-between border-b border-slate-800">
        <div class="flex items-center gap-3">
            <span class="inline-flex items-center gap-1.5 text-amber-400 font-bold">
                <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                <span>NECKLE MLS NETWORK</span>
            </span>
            <span class="hidden sm:inline text-slate-400">• Kết nối 1,500+ dự án bất động sản đã thẩm định pháp lý</span>
        </div>
        <div class="flex items-center gap-6 text-[11px] text-slate-300">
            <span>Hotline: <strong class="text-amber-400 font-mono">+990-737 621 432</strong></span>
            <span class="hidden md:inline">Zalo tư vấn: 0939 523 557</span>
        </div>
    </div>

    <!-- Header Navigation (Satek Exact Mockup) -->
    <header class="bg-white border-b border-slate-200 sticky top-0 z-30 shadow-xs">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-20 flex items-center justify-between gap-4">
            <!-- Brand Logo -->
            <div class="flex items-center gap-2 shrink-0">
                <div class="w-8 h-8 flex flex-col justify-center items-center gap-1 bg-amber-400 rounded-lg p-1.5 shadow-xs">
                    <span class="w-full h-1 bg-slate-900 rounded-full"></span>
                    <span class="w-full h-1 bg-slate-900 rounded-full"></span>
                    <span class="w-3/4 h-1 bg-slate-900 rounded-full self-start"></span>
                </div>
                <div class="flex flex-col">
                    <span class="text-xl font-black tracking-tight text-slate-900">Neckle</span>
                    <span class="text-[9px] font-bold uppercase tracking-widest text-slate-400">REAL ESTATE AGENCY</span>
                </div>
            </div>

            <!-- Search input bar (Center) -->
            <div class="hidden md:flex flex-1 max-w-md mx-6">
                <div class="relative w-full flex items-center">
                    <input type="text" placeholder="Search your projects, villas or condos..." class="w-full pl-4 pr-12 py-2.5 rounded-l-xl bg-slate-50 border border-slate-300 text-xs focus:bg-white focus:outline-none focus:border-amber-500 transition-all">
                    <button type="button" class="w-12 h-[38px] bg-slate-900 hover:bg-black text-white flex items-center justify-center rounded-r-xl transition-colors">
                        <span class="material-symbols-outlined text-[18px]">search</span>
                    </button>
                </div>
            </div>

            <!-- Nav Links & CTA (Right) -->
            <div class="flex items-center gap-4 shrink-0">
                <nav class="hidden xl:flex items-center gap-6 text-xs font-bold text-slate-700 uppercase">
                    <a href="#hero" class="text-amber-600">Home</a>
                    <a href="#properties" class="hover:text-amber-600 transition-colors">For Sale</a>
                    <a href="#properties" class="hover:text-amber-600 transition-colors">For Rent</a>
                    <a href="#contact" class="hover:text-amber-600 transition-colors">Contact Us</a>
                </nav>

                <div class="flex items-center gap-2.5">
                    <button type="button" class="hidden sm:flex items-center gap-1.5 text-xs font-bold text-slate-700 hover:text-amber-600 px-3 py-2">
                        <span class="material-symbols-outlined text-[18px]">account_circle</span>
                        <span>REGISTER / LOGIN</span>
                    </button>
                    <a href="#contact" class="px-5 py-2.5 rounded-xl bg-amber-400 hover:bg-amber-500 text-slate-950 font-extrabold text-xs shadow-sm flex items-center gap-1.5 transition-all">
                        <span class="material-symbols-outlined text-[16px]">add_circle</span>
                        <span>ADD PROPERTY</span>
                    </a>
                </div>
            </div>
        </div>
    </header>

    <!-- Hero Section (Exact Nimbus Properties Layout from Screenshot) -->
    <section id="hero" class="relative bg-gradient-to-b from-[#f8fafc] via-[#f1f5f9] to-white py-12 lg:py-20 overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12 items-center">
                
                <!-- Left text column -->
                <div class="lg:col-span-6 space-y-6">
                    <div class="flex items-center gap-3">
                        <span class="text-xs font-bold text-amber-500 font-mono tracking-wider">01</span>
                        <div class="w-8 h-px bg-slate-300"></div>
                        <span class="text-xs font-bold text-slate-500 uppercase tracking-widest">On Going Property</span>
                    </div>

                    <h1 class="text-4xl sm:text-5xl lg:text-6xl font-black text-slate-900 tracking-tight leading-none">
                        Nimbus Properties
                    </h1>

                    <p class="text-sm sm:text-base text-slate-600 leading-relaxed max-w-lg">
                        To help neckle company stand out and make an impression on potential investors, home seekers and luxury villa buyers.
                    </p>

                    <!-- CTA & Trustpilot -->
                    <div class="flex flex-wrap items-center gap-6 pt-2">
                        <a href="#properties" class="px-6 py-3.5 rounded-xl bg-amber-400 hover:bg-amber-500 text-slate-950 font-extrabold text-xs sm:text-sm shadow-md flex items-center gap-2 transition-all">
                            <span class="material-symbols-outlined text-[18px]">holiday_village</span>
                            <span>View Details</span>
                        </a>

                        <div class="flex items-center gap-2.5 border-l border-slate-200 pl-4">
                            <span class="text-emerald-600 font-extrabold text-xs flex items-center gap-1">
                                <span class="material-symbols-outlined text-[16px]">star</span> Trustpilot
                            </span>
                            <div class="flex text-emerald-500 text-xs">★★★★★</div>
                            <span class="text-[11px] text-slate-400 font-medium">Trust Rating 5.0 | 2,348 Reviews</span>
                        </div>
                    </div>
                </div>

                <!-- Right visual card (Exact Floating Black Spec Box from Screenshot) -->
                <div class="lg:col-span-6 relative">
                    <div class="relative rounded-3xl overflow-hidden shadow-2xl border-4 border-white bg-slate-900">
                        <img src="https://images.unsplash.com/photo-1600585154340-be6161a56a0c?auto=format&fit=crop&w=1200&q=80" alt="Nimbus Properties" class="w-full aspect-[4/3] object-cover">
                        
                        <!-- Floating Dark Box (Identical to Satek demo screenshot) -->
                        <div class="absolute bottom-6 left-6 right-6 sm:right-auto sm:min-w-[340px] bg-[#111827]/95 backdrop-blur-md text-white p-5 rounded-2xl border border-slate-700/80 shadow-2xl">
                            <div class="flex items-center justify-between border-b border-slate-700/80 pb-3 mb-3">
                                <div>
                                    <span class="text-xl sm:text-2xl font-black font-mono text-amber-400">$10,656.00</span>
                                    <span class="text-[10px] text-slate-400 block">Starting From</span>
                                </div>
                                <span class="inline-flex items-center gap-1 text-xs font-semibold text-slate-300 bg-slate-800 px-2.5 py-1 rounded-md">
                                    <span class="material-symbols-outlined text-[14px] text-amber-400">location_on</span>
                                    <span>Panama City</span>
                                </span>
                            </div>
                            <div class="grid grid-cols-3 gap-2 text-center text-xs">
                                <div class="bg-slate-800/80 p-2 rounded-lg">
                                    <span class="block font-black text-white">06 Beds</span>
                                    <span class="text-[10px] text-slate-400">Master Rooms</span>
                                </div>
                                <div class="bg-slate-800/80 p-2 rounded-lg">
                                    <span class="block font-black text-white">03 Baths</span>
                                    <span class="text-[10px] text-slate-400">Bathrooms</span>
                                </div>
                                <div class="bg-slate-800/80 p-2 rounded-lg">
                                    <span class="block font-black text-white truncate">453,234</span>
                                    <span class="text-[10px] text-slate-400">Sq.ft Area</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- Black Quick Feature Strip (From Satek Screenshot Bottom Bar) -->
    <section class="bg-[#111827] text-white py-5 border-y border-slate-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 grid grid-cols-2 md:grid-cols-4 gap-4">
            <a href="#properties" class="flex items-center gap-3 p-2 hover:text-amber-400 transition-colors group">
                <div class="w-10 h-10 rounded-xl bg-slate-800 group-hover:bg-amber-400 group-hover:text-slate-900 flex items-center justify-center transition-colors">
                    <span class="material-symbols-outlined text-[20px]">villa</span>
                </div>
                <div>
                    <h4 class="text-xs font-extrabold uppercase">Browse Rent Home</h4>
                    <p class="text-[10px] text-slate-400">450+ Properties</p>
                </div>
            </a>
            <a href="#properties" class="flex items-center gap-3 p-2 hover:text-amber-400 transition-colors group">
                <div class="w-10 h-10 rounded-xl bg-slate-800 group-hover:bg-amber-400 group-hover:text-slate-900 flex items-center justify-center transition-colors">
                    <span class="material-symbols-outlined text-[20px]">real_estate_agent</span>
                </div>
                <div>
                    <h4 class="text-xs font-extrabold uppercase">For Sale Home</h4>
                    <p class="text-[10px] text-slate-400">Villas & Penthouses</p>
                </div>
            </a>
            <a href="#properties" class="flex items-center gap-3 p-2 hover:text-amber-400 transition-colors group">
                <div class="w-10 h-10 rounded-xl bg-slate-800 group-hover:bg-amber-400 group-hover:text-slate-900 flex items-center justify-center transition-colors">
                    <span class="material-symbols-outlined text-[20px]">percent</span>
                </div>
                <div>
                    <h4 class="text-xs font-extrabold uppercase">Browse Offer</h4>
                    <p class="text-[10px] text-slate-400">Best Investment Deals</p>
                </div>
            </a>
            <a href="#contact" class="flex items-center gap-3 p-2 hover:text-amber-400 transition-colors group">
                <div class="w-10 h-10 rounded-xl bg-slate-800 group-hover:bg-amber-400 group-hover:text-slate-900 flex items-center justify-center transition-colors">
                    <span class="material-symbols-outlined text-[20px]">support_agent</span>
                </div>
                <div>
                    <h4 class="text-xs font-extrabold uppercase">Get In Touch</h4>
                    <p class="text-[10px] text-slate-400">24/7 Consultation</p>
                </div>
            </a>
        </div>
    </section>

    <!-- Properties Showcase Grid -->
    <section id="properties" class="py-16 bg-[#f8fafc]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row md:items-end justify-between gap-4 mb-10">
                <div>
                    <span class="text-xs font-bold text-amber-500 uppercase tracking-widest">DISCOVER PROPERTIES</span>
                    <h2 class="text-2xl sm:text-3xl font-black text-slate-900 mt-1">Dự Án Bất Động Sản Nổi Bật</h2>
                </div>
                <div class="flex items-center gap-2">
                    <button type="button" @click="filterTab = 'all'" :class="filterTab === 'all' ? 'bg-slate-900 text-white' : 'bg-white text-slate-700 hover:bg-slate-100'" class="px-4 py-2 rounded-xl text-xs font-bold transition-all shadow-2xs">Tất cả</button>
                    <button type="button" @click="filterTab = 'villa'" :class="filterTab === 'villa' ? 'bg-slate-900 text-white' : 'bg-white text-slate-700 hover:bg-slate-100'" class="px-4 py-2 rounded-xl text-xs font-bold transition-all shadow-2xs">Biệt thự</button>
                    <button type="button" @click="filterTab = 'apartment'" :class="filterTab === 'apartment' ? 'bg-slate-900 text-white' : 'bg-white text-slate-700 hover:bg-slate-100'" class="px-4 py-2 rounded-xl text-xs font-bold transition-all shadow-2xs">Căn hộ</button>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Card 1 -->
                <div class="bg-white rounded-3xl overflow-hidden border border-slate-200/90 shadow-sm hover:shadow-xl transition-all duration-300 flex flex-col group">
                    <div class="relative aspect-video overflow-hidden bg-slate-900">
                        <img src="https://images.unsplash.com/photo-1600585154340-be6161a56a0c?auto=format&fit=crop&w=700&q=80" alt="Sunflower Cottage" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        <span class="absolute top-4 left-4 bg-amber-400 text-slate-950 px-3 py-1 rounded-full text-[11px] font-extrabold shadow-md">FOR SALE</span>
                        <span class="absolute top-4 right-4 bg-black/60 backdrop-blur-md text-white px-3 py-1 rounded-full text-xs font-mono font-bold">$8,450,000</span>
                    </div>
                    <div class="p-6 flex flex-col flex-1">
                        <div class="flex items-center gap-1.5 text-xs text-slate-500 mb-2">
                            <span class="material-symbols-outlined text-[15px] text-amber-500">pin_drop</span>
                            <span>Riverside Boulevard, Quận 2</span>
                        </div>
                        <h3 class="text-base font-bold text-slate-900 mb-3 group-hover:text-amber-600 transition-colors">
                            Sunflower Luxury Riverside Villa
                        </h3>
                        <div class="grid grid-cols-3 gap-2 py-3 border-y border-slate-100 text-slate-600 text-xs text-center mb-4">
                            <div><strong class="text-slate-900">05</strong> Beds</div>
                            <div><strong class="text-slate-900">04</strong> Baths</div>
                            <div><strong class="text-slate-900">520</strong> m²</div>
                        </div>
                        <a href="#contact" class="w-full py-2.5 rounded-xl bg-slate-100 hover:bg-amber-400 hover:text-slate-950 text-slate-700 text-xs font-bold text-center transition-all">
                            Liên Hệ Xem Nhà Mẫu
                        </a>
                    </div>
                </div>

                <!-- Card 2 -->
                <div class="bg-white rounded-3xl overflow-hidden border border-slate-200/90 shadow-sm hover:shadow-xl transition-all duration-300 flex flex-col group">
                    <div class="relative aspect-video overflow-hidden bg-slate-900">
                        <img src="https://images.unsplash.com/photo-1545324418-cc1a3fa10c00?auto=format&fit=crop&w=700&q=80" alt="Penthouse Sky" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        <span class="absolute top-4 left-4 bg-emerald-500 text-white px-3 py-1 rounded-full text-[11px] font-extrabold shadow-md">FOR RENT</span>
                        <span class="absolute top-4 right-4 bg-black/60 backdrop-blur-md text-white px-3 py-1 rounded-full text-xs font-mono font-bold">$4,200/Mo</span>
                    </div>
                    <div class="p-6 flex flex-col flex-1">
                        <div class="flex items-center gap-1.5 text-xs text-slate-500 mb-2">
                            <span class="material-symbols-outlined text-[15px] text-amber-500">pin_drop</span>
                            <span>Metropolis Tower, Ba Đình</span>
                        </div>
                        <h3 class="text-base font-bold text-slate-900 mb-3 group-hover:text-amber-600 transition-colors">
                            Diamond Penthouse 360 Sky View
                        </h3>
                        <div class="grid grid-cols-3 gap-2 py-3 border-y border-slate-100 text-slate-600 text-xs text-center mb-4">
                            <div><strong class="text-slate-900">03</strong> Beds</div>
                            <div><strong class="text-slate-900">03</strong> Baths</div>
                            <div><strong class="text-slate-900">280</strong> m²</div>
                        </div>
                        <a href="#contact" class="w-full py-2.5 rounded-xl bg-slate-100 hover:bg-amber-400 hover:text-slate-950 text-slate-700 text-xs font-bold text-center transition-all">
                            Liên Hệ Xem Nhà Mẫu
                        </a>
                    </div>
                </div>

                <!-- Card 3 -->
                <div class="bg-white rounded-3xl overflow-hidden border border-slate-200/90 shadow-sm hover:shadow-xl transition-all duration-300 flex flex-col group">
                    <div class="relative aspect-video overflow-hidden bg-slate-900">
                        <img src="https://images.unsplash.com/photo-1512917774080-9991f1c4c750?auto=format&fit=crop&w=700&q=80" alt="Ocean Villa" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        <span class="absolute top-4 left-4 bg-amber-400 text-slate-950 px-3 py-1 rounded-full text-[11px] font-extrabold shadow-md">HOT DEAL</span>
                        <span class="absolute top-4 right-4 bg-black/60 backdrop-blur-md text-white px-3 py-1 rounded-full text-xs font-mono font-bold">$12,000,000</span>
                    </div>
                    <div class="p-6 flex flex-col flex-1">
                        <div class="flex items-center gap-1.5 text-xs text-slate-500 mb-2">
                            <span class="material-symbols-outlined text-[15px] text-amber-500">pin_drop</span>
                            <span>Bãi Dài, Cam Ranh, Khánh Hòa</span>
                        </div>
                        <h3 class="text-base font-bold text-slate-900 mb-3 group-hover:text-amber-600 transition-colors">
                            The Horizon Beachfront Mansion
                        </h3>
                        <div class="grid grid-cols-3 gap-2 py-3 border-y border-slate-100 text-slate-600 text-xs text-center mb-4">
                            <div><strong class="text-slate-900">06</strong> Beds</div>
                            <div><strong class="text-slate-900">06</strong> Baths</div>
                            <div><strong class="text-slate-900">850</strong> m²</div>
                        </div>
                        <a href="#contact" class="w-full py-2.5 rounded-xl bg-slate-100 hover:bg-amber-400 hover:text-slate-950 text-slate-700 text-xs font-bold text-center transition-all">
                            Liên Hệ Xem Nhà Mẫu
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Lead Capture Section -->
    <section id="contact" class="py-16 bg-slate-900 text-white">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center space-y-6">
            <span class="text-xs font-bold text-amber-400 uppercase tracking-widest font-mono">CONTACT SPECIALIST</span>
            <h2 class="text-2xl sm:text-3xl font-black">Đặt Lịch Thẩm Định & Tham Quan Dự Án</h2>
            <p class="text-xs sm:text-sm text-slate-400 max-w-xl mx-auto">
                Chuyên viên cấp cao của Neckle sẽ liên hệ bảo mật và gửi trọn bộ hồ sơ pháp lý qua Zalo/Email cho quý khách.
            </p>

            <form class="grid grid-cols-1 sm:grid-cols-3 gap-3 pt-4 text-left max-w-2xl mx-auto">
                <input type="text" placeholder="Họ và tên..." class="px-4 py-3 rounded-xl bg-slate-800 border border-slate-700 text-xs text-white focus:outline-none focus:border-amber-400">
                <input type="tel" placeholder="Số điện thoại..." class="px-4 py-3 rounded-xl bg-slate-800 border border-slate-700 text-xs text-white focus:outline-none focus:border-amber-400">
                <button type="button" onclick="alert('Đã tiếp nhận yêu cầu! Chuyên viên Neckle sẽ liên hệ trong ít phút.')" class="px-6 py-3 rounded-xl bg-amber-400 hover:bg-amber-500 text-slate-950 font-extrabold text-xs transition-all shadow-md">
                    Nhận Hồ Sơ VIP
                </button>
            </form>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-black text-slate-400 py-8 text-xs border-t border-slate-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col sm:flex-row items-center justify-between gap-4">
            <span>© 2026 Neckle Real Estate Agency. All rights reserved.</span>
            <div class="flex items-center gap-6">
                <span>Hotline: +990-737 621 432</span>
                <span>Cửu Long Tech Agency Partner</span>
            </div>
        </div>
    </footer>

</div>
