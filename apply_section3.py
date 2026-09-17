import re

with open("resources/views/profile.blade.php", "r", encoding="utf-8") as f:
    content = f.read()

section_3_grid_start = content.find('<div class="grid grid-cols-1 lg:grid-cols-12 gap-6">')
section_3_end = content.find('</section>', section_3_grid_start)

new_grid = """<div class="flex flex-col gap-6">
                    <!-- Hàng 1: 2 Thẻ lớn -->
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                        <!-- CARD 1: TEAM BUILDING & SỰ KIỆN -->
                        <div class="rounded-2xl bg-on-surface p-6 md:p-8 shadow-md flex flex-col justify-between group hover:shadow-xl transition-all duration-300 relative overflow-hidden">
                            <div class="absolute top-0 right-0 w-48 h-48 bg-primary-container/10 rounded-full blur-3xl pointer-events-none"></div>
                            <div>
                                <div class="flex items-center justify-between mb-4">
                                    <span class="w-12 h-12 rounded-xl bg-primary-container/20 text-primary-fixed flex items-center justify-center">
                                        <span class="material-symbols-outlined text-[28px]">movie</span>
                                    </span>
                                    <span class="px-3 py-1 rounded-full bg-primary-container text-on-primary-container font-label-sm text-label-sm font-bold uppercase">
                                        Chủ Lực • Sự Kiện
                                    </span>
                                </div>
                                <h3 class="font-headline-lg text-headline-md md:text-headline-lg text-surface-container-lowest mb-2">
                                    Quay Phim Sự Kiện &amp; Team Building
                                </h3>
                                <p class="font-body-md text-body-md text-surface-dim mb-6 max-w-xl">
                                    Hệ thống máy quay chuyên nghiệp kết hợp ekip đạo diễn, biên kịch. Ghi lại trọn vẹn cảm xúc và tinh thần đoàn kết trong mỗi sự kiện.
                                </p>
                                <div class="flex flex-wrap gap-2 mb-6">
                                    <span class="px-3 py-1 rounded-full bg-surface-container-lowest/10 text-surface-container-lowest font-label-sm text-label-sm">RED / ARRI Mini LF</span>
                                    <span class="px-3 py-1 rounded-full bg-surface-container-lowest/10 text-surface-container-lowest font-label-sm text-label-sm">Master ProRes 4444</span>
                                    <span class="px-3 py-1 rounded-full bg-surface-container-lowest/10 text-surface-container-lowest font-label-sm text-label-sm">Drone FPV Cine</span>
                                </div>
                            </div>
                            <div class="rounded-xl overflow-hidden h-48 md:h-64 w-full mt-2 relative">
                                <img alt="Quay Phim Sự Kiện Team Building" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" src="{{ asset('images/team-building-cover.jpg') }}"/>
                                <div class="absolute inset-0 bg-gradient-to-t from-on-surface via-transparent to-transparent"></div>
                            </div>
                        </div>

                        <!-- CARD 2: BOOKING KOC & LIVESTREAM -->
                        <div class="rounded-2xl bg-on-surface p-6 md:p-8 shadow-md flex flex-col justify-between group hover:shadow-xl transition-all duration-300 relative overflow-hidden">
                            <div class="absolute top-0 right-0 w-48 h-48 bg-primary-container/10 rounded-full blur-3xl pointer-events-none"></div>
                            <div>
                                <div class="flex items-center justify-between mb-4">
                                    <span class="w-12 h-12 rounded-xl bg-primary-container/20 text-primary-fixed flex items-center justify-center">
                                        <span class="material-symbols-outlined text-[28px]">broadcast_on_personal</span>
                                    </span>
                                    <span class="px-3 py-1 rounded-full bg-primary-container text-on-primary-container font-label-sm text-label-sm font-bold uppercase">
                                        Giải Pháp • Tương Tác
                                    </span>
                                </div>
                                <h3 class="font-headline-lg text-headline-md md:text-headline-lg text-surface-container-lowest mb-2">
                                    Booking KOC &amp; Mega Livestream
                                </h3>
                                <p class="font-body-md text-body-md text-surface-dim mb-6 max-w-xl">
                                    Tổ chức phòng Live đa góc máy chuyên nghiệp, kịch bản bán hàng cảm xúc cùng mạng lưới hơn 500+ KOL/KOC uy tín khu vực phía Nam.
                                </p>
                                <div class="flex flex-wrap gap-2 mb-6">
                                    <span class="px-3 py-1 rounded-full bg-surface-container-lowest/10 text-surface-container-lowest font-label-sm text-label-sm">Multi-cam 4K Switcher</span>
                                    <span class="px-3 py-1 rounded-full bg-surface-container-lowest/10 text-surface-container-lowest font-label-sm text-label-sm">Top Brand KOCs</span>
                                    <span class="px-3 py-1 rounded-full bg-surface-container-lowest/10 text-surface-container-lowest font-label-sm text-label-sm">Mega Sale Pipeline</span>
                                </div>
                            </div>
                            <div class="rounded-xl overflow-hidden h-48 md:h-64 w-full mt-2 relative">
                                <img alt="Sự Kiện Kredivo Hologram" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" src="{{ asset('images/mega-livestream-cover.jpg') }}"/>
                                <div class="absolute inset-0 bg-gradient-to-t from-on-surface via-transparent to-transparent"></div>
                            </div>
                        </div>
                    </div>

                    <!-- Hàng 2: 3 Thẻ nhỏ -->
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        <!-- CARD 3: WEB/APP -->
                        <div class="rounded-2xl bg-on-surface p-6 md:p-8 shadow-md flex flex-col justify-between hover:shadow-xl transition-all duration-300 overflow-hidden relative">
                            <div>
                                <div class="flex items-center justify-between mb-4">
                                    <span class="w-12 h-12 rounded-xl bg-primary-container/20 text-primary-fixed flex items-center justify-center">
                                        <span class="material-symbols-outlined text-[28px]">terminal</span>
                                    </span>
                                </div>
                                <h3 class="font-headline-md text-headline-md text-surface-container-lowest mb-2">
                                    Thiết Kế &amp; Lập Trình Web/App
                                </h3>
                                <p class="font-body-md text-body-md text-surface-dim mb-4">
                                    Hạ tầng kiến trúc Microservices chịu tải hàng triệu người dùng, tối ưu UI/UX cấp cao.
                                </p>
                                <div class="flex flex-wrap gap-2 mb-6">
                                    <span class="px-3 py-1 rounded-full bg-surface-container-lowest/10 text-surface-container-lowest font-label-sm text-label-sm">Next.js 14 / Flutter</span>
                                    <span class="px-3 py-1 rounded-full bg-surface-container-lowest/10 text-surface-container-lowest font-label-sm text-label-sm">Clean Architecture</span>
                                </div>
                            </div>
                            <!-- Terminal UI Block -->
                            <div class="rounded-xl bg-[#0d1117] border border-[#30363d] overflow-hidden mt-auto">
                                <div class="flex items-center px-3 py-2 border-b border-[#30363d] bg-[#161b22]">
                                    <div class="flex gap-1.5">
                                        <div class="w-2.5 h-2.5 rounded-full bg-[#ff5f56]"></div>
                                        <div class="w-2.5 h-2.5 rounded-full bg-[#ffbd2e]"></div>
                                        <div class="w-2.5 h-2.5 rounded-full bg-[#27c93f]"></div>
                                    </div>
                                    <div class="text-[#8b949e] text-[10px] uppercase mx-auto font-mono">Performance_Stats.sh</div>
                                </div>
                                <div class="p-4 font-mono text-[12px] sm:text-[13px] leading-relaxed">
                                    <div class="text-[#79c0ff]">~ $ <span class="text-[#e6edf3]">ping server -c 1</span></div>
                                    <div class="text-[#a5d6ff]">64 bytes from 192.168.1.1: time<span class="text-[#7ee787]"> < 200ms</span></div>
                                    <div class="text-[#79c0ff] mt-2">~ $ <span class="text-[#e6edf3]">check_uptime</span></div>
                                    <div class="text-[#e6edf3]">Status: <span class="text-[#7ee787]">99.9% Online</span></div>
                                </div>
                            </div>
                            <p class="text-surface-dim/60 text-[10px] italic text-right mt-2">*Chỉ số tham khảo</p>
                        </div>

                        <!-- CARD 4: PERFORMANCE MARKETING -->
                        <div class="rounded-2xl bg-on-surface p-6 md:p-8 shadow-md flex flex-col justify-between hover:shadow-xl transition-all duration-300 overflow-hidden relative">
                            <div>
                                <div class="flex items-center justify-between mb-4">
                                    <span class="w-12 h-12 rounded-xl bg-primary-container/20 text-primary-fixed flex items-center justify-center">
                                        <span class="material-symbols-outlined text-[28px]">trending_up</span>
                                    </span>
                                </div>
                                <h3 class="font-headline-md text-headline-md text-surface-container-lowest mb-2">
                                    Quảng Cáo Performance
                                </h3>
                                <p class="font-body-md text-body-md text-surface-dim mb-4">
                                    Tối ưu chi phí CPA, bứt phá doanh số với chiến lược ma trận nội dung ngắn và AI Ads tiên tiến.
                                </p>
                                <div class="flex flex-wrap gap-2 mb-6">
                                    <span class="px-3 py-1 rounded-full bg-surface-container-lowest/10 text-surface-container-lowest font-label-sm text-label-sm">TikTok Shop Ads</span>
                                    <span class="px-3 py-1 rounded-full bg-surface-container-lowest/10 text-surface-container-lowest font-label-sm text-label-sm">ROAS Tracking 3.5+</span>
                                </div>
                            </div>
                            <!-- SVG Chart Block -->
                            <div class="rounded-xl bg-surface-container-lowest/5 p-4 mt-auto border border-surface-container-lowest/10">
                                <div class="flex justify-between items-center mb-2">
                                    <span class="text-[11px] uppercase tracking-wider text-surface-dim">Growth Trend</span>
                                    <span class="text-[#7ee787] text-[12px] font-bold">+124%</span>
                                </div>
                                <svg class="w-full h-16" viewBox="0 0 200 50" preserveAspectRatio="none">
                                    <defs>
                                        <linearGradient id="gradientLine" x1="0%" y1="0%" x2="100%" y2="0%">
                                            <stop offset="0%" stop-color="#ffb599" stop-opacity="0.5"/>
                                            <stop offset="100%" stop-color="#cc4900" stop-opacity="1"/>
                                        </linearGradient>
                                        <linearGradient id="gradientArea" x1="0%" y1="0%" x2="0%" y2="100%">
                                            <stop offset="0%" stop-color="#cc4900" stop-opacity="0.2"/>
                                            <stop offset="100%" stop-color="#cc4900" stop-opacity="0"/>
                                        </linearGradient>
                                    </defs>
                                    <path d="M0,45 Q20,40 40,42 T80,30 T120,25 T160,10 T200,5 L200,50 L0,50 Z" fill="url(#gradientArea)"></path>
                                    <path d="M0,45 Q20,40 40,42 T80,30 T120,25 T160,10 T200,5" fill="none" stroke="url(#gradientLine)" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"></path>
                                    <circle cx="200" cy="5" r="4" fill="#cc4900" stroke="#fff" stroke-width="2"></circle>
                                </svg>
                            </div>
                            <p class="text-surface-dim/60 text-[10px] italic text-right mt-2">*Chỉ số tham khảo</p>
                        </div>

                        <!-- CARD 5: 3D MOTION DESIGN -->
                        <div class="rounded-2xl bg-on-surface p-6 md:p-8 shadow-md flex flex-col justify-between hover:shadow-xl transition-all duration-300">
                            <div>
                                <span class="w-12 h-12 rounded-xl bg-primary-container/20 text-primary-fixed flex items-center justify-center mb-6">
                                    <span class="material-symbols-outlined text-[32px]">view_in_ar</span>
                                </span>
                                <h3 class="font-headline-md text-headline-md text-surface-container-lowest mb-2">
                                    3D Motion Design &amp; AI Studio
                                </h3>
                                <p class="font-body-md text-body-md text-surface-dim mb-4">
                                    Mô phỏng sản phẩm 3D siêu thực, sân khấu ảo Virtual Production và ứng dụng Trí tuệ nhân tạo (GenAI) sinh tạo hình ảnh thương mại cao cấp.
                                </p>
                            </div>
                            <div class="flex flex-wrap gap-2 pt-4 mt-auto border-t border-surface-container-lowest/10">
                                <span class="px-3 py-1 rounded-full bg-surface-container-lowest/10 text-surface-container-lowest font-label-sm text-label-sm">CGI / VFX Render</span>
                                <span class="px-3 py-1 rounded-full bg-surface-container-lowest/10 text-surface-container-lowest font-label-sm text-label-sm">Unreal Engine 5</span>
                                <span class="px-3 py-1 rounded-full bg-surface-container-lowest/10 text-surface-container-lowest font-label-sm text-label-sm">GenAI Visuals</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
"""

content = content[:section_3_grid_start] + new_grid + content[section_3_end:]

with open("resources/views/profile.blade.php", "w", encoding="utf-8") as f:
    f.write(content)

print("Replaced section 3 with flex/grid combo.")
