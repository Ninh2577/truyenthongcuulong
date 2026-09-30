<!-- ==================== TECH & SAAS PLATFORM (DEVCLOUD / SYNAPSE AI) ==================== -->
<div class="w-full bg-[#0b0f19] text-slate-100 font-sans selection:bg-indigo-500 selection:text-white" x-data="{
    pricingBilling: 'annual',
    activeTab: 'api'
}">

    <!-- Top Glow Line -->
    <div class="h-1 w-full bg-gradient-to-r from-indigo-500 via-purple-500 to-cyan-400"></div>

    <!-- Header Navigation -->
    <header class="bg-[#0b0f19]/90 backdrop-blur-md border-b border-slate-800 sticky top-0 z-30">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-20 flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-indigo-500 to-cyan-400 flex items-center justify-center text-white font-black text-xl shadow-lg shadow-indigo-500/30">
                    <span class="material-symbols-outlined text-[24px]">terminal</span>
                </div>
                <div class="flex flex-col">
                    <span class="text-xl font-black text-white tracking-tight font-mono">DevCloud</span>
                    <span class="text-[9px] font-bold text-indigo-400 tracking-widest uppercase">ENTERPRISE CLOUD PLATFORM</span>
                </div>
            </div>

            <nav class="hidden lg:flex items-center gap-8 text-xs font-bold text-slate-300 uppercase tracking-wider">
                <a href="#hero" class="text-indigo-400">Tính năng</a>
                <a href="#architecture" class="hover:text-indigo-400 transition-colors">Kiến trúc</a>
                <a href="#pricing" class="hover:text-indigo-400 transition-colors">Bảng giá</a>
                <a href="#stack" class="hover:text-indigo-400 transition-colors">Công nghệ</a>
                <a href="#contact" class="hover:text-indigo-400 transition-colors">Tài liệu API</a>
            </nav>

            <div class="flex items-center gap-3">
                <a href="#contact" class="hidden sm:inline-block text-xs font-bold text-slate-300 hover:text-white px-3 py-2">
                    Đăng Nhập
                </a>
                <a href="#pricing" class="px-5 py-2.5 rounded-full bg-gradient-to-r from-indigo-500 to-cyan-400 hover:opacity-90 text-white font-bold text-xs uppercase tracking-wider shadow-lg shadow-indigo-500/25 transition-all">
                    Dùng Thử 14 Ngày
                </a>
            </div>
        </div>
    </header>

    <!-- Hero Section with Code Terminal -->
    <section id="hero" class="py-16 lg:py-24 px-4 sm:px-8 relative overflow-hidden">
        <div class="absolute -top-40 left-1/2 -translate-x-1/2 w-[600px] h-[300px] bg-indigo-500/20 blur-[120px] rounded-full pointer-events-none"></div>

        <div class="max-w-7xl mx-auto grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
            <div class="lg:col-span-6 space-y-6">
                <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-indigo-500/10 border border-indigo-500/30 text-indigo-400 text-xs font-mono">
                    <span class="w-2 h-2 rounded-full bg-cyan-400 animate-pulse"></span>
                    <span>AI-POWERED DEV SEC OPS PIPELINE</span>
                </div>

                <h1 class="text-3xl sm:text-4xl lg:text-5xl font-black text-white leading-tight">
                    Nền Tảng Đám Mây <br><span class="text-transparent bg-clip-text bg-gradient-to-r from-indigo-400 via-purple-400 to-cyan-400">Tối Ưu Vận Hành Phần Mềm</span>
                </h1>

                <p class="text-xs sm:text-sm text-slate-400 leading-relaxed max-w-lg">
                    Tự động hóa triển khai CI/CD, giám sát lỗi thời gian thực và tự động mở rộng cụm microservices với độ trễ dưới 10ms.
                </p>

                <div class="flex flex-wrap items-center gap-4 pt-2">
                    <a href="#pricing" class="px-7 py-3 rounded-full bg-indigo-600 hover:bg-indigo-500 text-white font-bold text-xs uppercase tracking-wider shadow-lg shadow-indigo-600/30 transition-all">
                        Khởi Tạo Cụm Cloud Miễn Phí
                    </a>
                    <a href="#stack" class="px-6 py-3 rounded-full bg-slate-800 hover:bg-slate-700 text-slate-300 font-bold text-xs uppercase tracking-wider border border-slate-700 transition-all">
                        Khám Phá Tech Stack
                    </a>
                </div>

                <div class="pt-6 border-t border-slate-800 grid grid-cols-3 gap-3">
                    <div>
                        <div class="text-2xl font-black text-white font-mono">99.99%</div>
                        <div class="text-[10px] text-slate-400">SLA Cam Kết Uptime</div>
                    </div>
                    <div>
                        <div class="text-2xl font-black text-cyan-400 font-mono">&lt; 8ms</div>
                        <div class="text-[10px] text-slate-400">Độ trễ phản hồi API</div>
                    </div>
                    <div>
                        <div class="text-2xl font-black text-indigo-400 font-mono">SOC 2</div>
                        <div class="text-[10px] text-slate-400">Chuẩn bảo mật dữ liệu</div>
                    </div>
                </div>
            </div>

            <!-- Terminal Mockup Right -->
            <div class="lg:col-span-6 bg-[#0e1422] rounded-3xl border border-slate-800 shadow-2xl overflow-hidden font-mono text-xs">
                <div class="bg-[#151c2e] px-4 py-3 border-b border-slate-800 flex items-center justify-between">
                    <div class="flex items-center gap-2">
                        <span class="w-3 h-3 rounded-full bg-rose-500 inline-block"></span>
                        <span class="w-3 h-3 rounded-full bg-amber-500 inline-block"></span>
                        <span class="w-3 h-3 rounded-full bg-emerald-500 inline-block"></span>
                        <span class="ml-2 text-slate-400 text-[11px]">deploy-production.sh</span>
                    </div>
                    <span class="text-emerald-400 text-[10px] font-bold">● CONNECTED</span>
                </div>
                <div class="p-6 space-y-2 text-slate-300 leading-relaxed">
                    <p><span class="text-cyan-400">$</span> devcloud deploy --cluster=asia-southeast1</p>
                    <p class="text-slate-500">→ Verifying cryptographic signature...</p>
                    <p class="text-emerald-400">✓ Security audit passed (0 vulnerabilities)</p>
                    <p class="text-slate-500">→ Building zero-downtime container cluster...</p>
                    <p class="text-indigo-400">✓ 12 pods synchronized across 3 availability zones</p>
                    <p class="text-amber-400 font-bold">🚀 Live endpoint: https://api.enterprise.cuulong.tech</p>
                    <div class="p-3 mt-4 bg-slate-950 rounded-xl border border-slate-800 text-slate-400 text-[11px]">
                        Latency: 6.2ms | CPU: 12% | Memory: 410MB | Status: Healthy
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Pricing Switcher Section -->
    <section id="pricing" class="py-16 bg-[#080c14] border-t border-slate-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-xl mx-auto mb-10">
                <span class="text-xs font-mono font-bold text-indigo-400 uppercase tracking-widest">TRANSPARENT PRICING</span>
                <h2 class="text-2xl sm:text-3xl font-black text-white mt-1">Bảng Giá Linh Hoạt Theo Quy Mô</h2>
                <div class="inline-flex items-center gap-2 bg-slate-900 p-1 rounded-full border border-slate-800 mt-6 text-xs">
                    <button type="button" @click="pricingBilling = 'monthly'" :class="pricingBilling === 'monthly' ? 'bg-indigo-600 text-white font-bold' : 'text-slate-400'" class="px-4 py-1.5 rounded-full transition-all">Thanh toán tháng</button>
                    <button type="button" @click="pricingBilling = 'annual'" :class="pricingBilling === 'annual' ? 'bg-indigo-600 text-white font-bold' : 'text-slate-400'" class="px-4 py-1.5 rounded-full transition-all">Thanh toán năm (-20%)</button>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Tier 1 -->
                <div class="bg-[#0e1422] p-8 rounded-3xl border border-slate-800 space-y-6">
                    <div>
                        <h3 class="text-base font-bold text-white">Khởi Nghiệp (Startup)</h3>
                        <p class="text-xs text-slate-400 mt-1">Dành cho đội ngũ phát triển MVP hoặc sản phẩm đầu tiên.</p>
                        <div class="mt-4 text-3xl font-black text-white font-mono" x-text="pricingBilling === 'annual' ? '$24/tháng' : '$29/tháng'"></div>
                    </div>
                    <ul class="text-xs text-slate-300 space-y-2 border-t border-slate-800 pt-4">
                        <li>✓ 5 Cụm dịch vụ Microservices</li>
                        <li>✓ Băng thông 1TB Cloud Native</li>
                        <li>✓ Hỗ trợ kỹ thuật qua Discord & Email</li>
                    </ul>
                    <a href="#hero" class="block w-full py-3 rounded-xl bg-slate-800 hover:bg-slate-700 text-white text-xs font-bold text-center transition-all">
                        Bắt Đầu Miễn Phí
                    </a>
                </div>

                <!-- Tier 2: Pro Featured -->
                <div class="bg-[#121a2e] p-8 rounded-3xl border-2 border-indigo-500 space-y-6 shadow-xl shadow-indigo-500/10 relative">
                    <span class="absolute top-4 right-4 bg-gradient-to-r from-indigo-500 to-cyan-400 text-white text-[10px] font-black px-3 py-1 rounded-full">POPULAR</span>
                    <div>
                        <h3 class="text-base font-bold text-white">Doanh Nghiệp (Pro Team)</h3>
                        <p class="text-xs text-slate-400 mt-1">Dành cho công ty có lưu lượng truy cập cao và yêu cầu cao về bảo mật.</p>
                        <div class="mt-4 text-3xl font-black text-cyan-400 font-mono" x-text="pricingBilling === 'annual' ? '$69/tháng' : '$89/tháng'"></div>
                    </div>
                    <ul class="text-xs text-slate-300 space-y-2 border-t border-slate-800 pt-4">
                        <li>✓ Không giới hạn Microservices</li>
                        <li>✓ Băng thông 10TB Cloud Native</li>
                        <li>✓ Bảo mật tường lửa WAF & Chống DDoS</li>
                        <li>✓ Hỗ trợ kỹ sư cấp cao 24/7 SLA 15 phút</li>
                    </ul>
                    <a href="#hero" class="block w-full py-3 rounded-xl bg-gradient-to-r from-indigo-500 to-cyan-400 text-white text-xs font-bold text-center transition-all">
                        Nâng Cấp Gói Pro
                    </a>
                </div>

                <!-- Tier 3 -->
                <div class="bg-[#0e1422] p-8 rounded-3xl border border-slate-800 space-y-6">
                    <div>
                        <h3 class="text-base font-bold text-white">Hệ Thống Lớn (Enterprise)</h3>
                        <p class="text-xs text-slate-400 mt-1">Kiến trúc Dedicated Server riêng biệt và giải pháp On-Premises.</p>
                        <div class="mt-4 text-3xl font-black text-white font-mono">Tùy Biến</div>
                    </div>
                    <ul class="text-xs text-slate-300 space-y-2 border-t border-slate-800 pt-4">
                        <li>✓ Triển khai Private Cloud hoặc On-Premise</li>
                        <li>✓ Ký cam kết bảo mật NDA & SLA 99.99%</li>
                        <li>✓ Đội ngũ kỹ sư Cửu Long túc trực riêng</li>
                    </ul>
                    <a href="#hero" class="block w-full py-3 rounded-xl bg-slate-800 hover:bg-slate-700 text-white text-xs font-bold text-center transition-all">
                        Liên Hệ Kỹ Sư Trưởng
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-black text-slate-500 py-6 text-center text-xs border-t border-slate-900 font-mono">
        <p>© 2026 DevCloud High-Tech Software Architecture. Built with Truyền Thông Cửu Long.</p>
    </footer>

</div>
