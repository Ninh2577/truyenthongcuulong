@php
    $needs = [
        [
            'num' => '01',
            'badge' => 'BÀI TOÁN 01',
            'icon_svg' => '<svg class="w-5 h-5" viewBox="0 0 24 24" fill="#f97316"><path d="M16 10.5V7a1 1 0 00-1-1H3a1 1 0 00-1 1v10a1 1 0 001 1h12a1 1 0 001-1v-3.5l5 4V6.5l-5 4z"/><circle cx="5.5" cy="4" r="1.75"/><circle cx="11.5" cy="4" r="1.75"/></svg>',
            'icon_bg' => 'background-color: #fff4ed; border: 1px solid #fed7aa;',
            'color' => '#f97316',
            'title' => 'Quy trình vận hành phụ thuộc vào Excel & thủ công',
            'desc' => 'Dữ liệu phân tán, dễ sai sót khi đối soát và tốn nhiều nhân lực tổng hợp báo cáo khi quy trình mở rộng.',
            'image' => asset('images/needs/need_card_1.png'),
            'image_alt' => 'Giải pháp Web App & Hệ Thống Quản Trị',
            'action_label' => 'Chi tiết Web App',
            'action_url' => route('services.web-app'),
        ],
        [
            'num' => '02',
            'badge' => 'BÀI TOÁN 02',
            'icon_svg' => '<svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="#2563eb" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="16 18 22 12 16 6"></polyline><polyline points="8 6 2 12 8 18"></polyline></svg>',
            'icon_bg' => 'background-color: #eff6ff; border: 1px solid #bfdbfe;',
            'color' => '#2563eb',
            'title' => 'Cần website doanh nghiệp phù hợp với hoạt động thực tế',
            'desc' => 'Thiết kế theo nhận diện thương hiệu, phản ánh đúng dịch vụ cốt lõi, chuẩn SEO và tối ưu trải nghiệm khách hàng.',
            'image' => asset('images/needs/need_card_2.png'),
            'image_alt' => 'Giải pháp Website Doanh Nghiệp & Mẫu',
            'action_label' => 'Chi tiết website',
            'action_url' => route('templates.index'),
        ],
        [
            'num' => '03',
            'badge' => 'BÀI TOÁN 03',
            'icon_svg' => '<svg class="w-5 h-5" viewBox="0 0 24 24" fill="#10b981"><path d="M18 11v2h4v-2h-4zm-2 6.61c.96.71 2.21.75 3.2.18l1-1.73c-.47-.28-.9-.62-1.28-1.03l-2.92 2.58zM20.2 6.94l-1-1.73c-.99-.57-2.24-.53-3.2.18l2.92 2.58c.38-.41.81-.75 1.28-1.03zM4 9c-1.1 0-2 .9-2 2v2c0 1.1.9 2 2 2h1l5 5V4L5 9H4zm11 3c0-1.77-1.02-3.29-2.5-4.03v8.05c1.48-.73 2.5-2.25 2.5-4.02z"/></svg>',
            'icon_bg' => 'background-color: #ecfdf5; border: 1px solid #a7f3d0;',
            'color' => '#10b981',
            'title' => 'Cần hệ thống quản lý dữ liệu tập trung & phân quyền',
            'desc' => 'Phân quyền chặt chẽ theo phòng ban, kiểm soát lịch sử thao tác, bảo mật dữ liệu khách hàng và chống rò rỉ thông tin.',
            'image' => asset('images/needs/need_card_3.png'),
            'image_alt' => 'Giải pháp Quản Lý & Phân Quyền Dữ Liệu',
            'action_label' => 'Chi tiết phân quyền',
            'action_url' => route('services.web-app'),
        ],
        [
            'num' => '04',
            'badge' => 'BÀI TOÁN 04',
            'icon_svg' => '<svg class="w-5 h-5" viewBox="0 0 24 24" fill="#8b5cf6"><path d="M21 19V5c0-1.1-.9-2-2-2H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2zM8.5 13.5l2.5 3.01L14.5 12l4.5 6H5l3.5-4.5z"/></svg>',
            'icon_bg' => 'background-color: #f5f3ff; border: 1px solid #ddd6fe;',
            'color' => '#8b5cf6',
            'title' => 'Cần tự động hóa các bước xử lý nghiệp vụ & tăng trưởng',
            'desc' => 'Tự động hóa luồng tiếp nhận khách, xác nhận lịch hẹn và tối ưu Technical SEO để chuyển đổi tự nhiên từ tìm kiếm.',
            'image' => asset('images/needs/need_card_4.png'),
            'image_alt' => 'Giải pháp Marketing & Truyền Thông Số',
            'action_label' => 'Chi tiết tự động hóa & SEO',
            'action_url' => route('services.marketing'),
        ],
        [
            'num' => '05',
            'badge' => 'BÀI TOÁN 05',
            'icon_svg' => '<svg class="w-5 h-5" viewBox="0 0 24 24" fill="#06b6d4"><path d="M6 2v2h12V2h-2v2h-2V2h-2v2h-2V2H8v2H6zm0 18v2h2v-2h2v2h2v-2h2v2h2v-2h2v-2H6v2zm14-14h2v2h-2v2h2v2h-2v2h2v2h-2v2h-2V6h2zm-16 0H2v2h2v2H2v2h2v2H2v2h2v2h2V6H4zm4 2h8v8H8V8zm2 2v4h4v-4h-4z"/></svg>',
            'icon_bg' => 'background-color: #ecfeff; border: 1px solid #a5f3fc;',
            'color' => '#06b6d4',
            'title' => 'Cần ứng dụng công nghệ mới như AI, 3D, Motion vào sản xuất nội dung',
            'desc' => 'Tạo nội dung sáng tạo, khác biệt, rút ngắn thời gian sản xuất và tối ưu chi phí hiệu quả hơn.',
            'image' => asset('images/needs/need_card_5.png'),
            'image_alt' => 'Giải pháp 3D Motion & AI Studio',
            'action_label' => 'Chi tiết giải pháp sáng tạo',
            'action_url' => route('services.media'),
        ],
    ];
@endphp

<section class="w-full bg-gradient-to-b from-[#f8faff] via-white to-[#f4f8fe] pt-12 lg:pt-16 pb-6 lg:pb-8 relative border-b border-slate-200/80 overflow-hidden" id="business-needs">
    {{-- Hiệu ứng vệt sáng nền mỹ thuật theo thiết kế --}}
    <div class="absolute -top-24 -left-20 w-[450px] h-[450px] rounded-full bg-sky-200/25 blur-3xl pointer-events-none" aria-hidden="true"></div>
    <div class="absolute bottom-0 -left-10 w-[400px] h-[350px] rounded-full bg-amber-200/20 blur-3xl pointer-events-none" aria-hidden="true"></div>
    <div class="absolute -bottom-10 -right-10 w-[450px] h-[400px] rounded-full bg-sky-200/20 blur-3xl pointer-events-none" aria-hidden="true"></div>

    <div class="max-w-[1380px] mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        
        <!-- Slogan Viết Tay & Mũi Tên Cam (Top-Right tuyệt đối, trỏ chính xác về cột 5) -->
        <div class="hidden lg:block absolute right-6 xl:right-10 top-3 lg:top-5 w-28 xl:w-36 pointer-events-none select-none z-20" aria-hidden="true">
            <img src="{{ asset('images/needs/decor_handwriting.png') }}?v={{ filemtime(public_path('images/needs/decor_handwriting.png')) }}" 
                 alt="Giải pháp cho hành trình chuyển đổi số của bạn" 
                 class="w-full h-auto object-contain">
        </div>

        <!-- Section Header Container -->
        <div class="text-center max-w-3xl mx-auto mb-10 lg:mb-12">
            
            <!-- Eyebrow Pill with Orange Lines -->
            <div class="inline-flex items-center gap-2.5 mb-3.5">
                <span style="width: 32px; height: 2px; background-color: #f97316; display: inline-block; border-radius: 9999px;" aria-hidden="true"></span>
                <span style="background-color: #eef2f6; color: #475569; font-size: 11px; font-weight: 700; letter-spacing: 0.16em; padding: 4px 14px; border-radius: 9999px; border: 1px solid #e2e8f0;" class="shadow-2xs uppercase">
                    DỊCH VỤ CỦA CHÚNG TÔI
                </span>
                <span style="width: 32px; height: 2px; background-color: #f97316; display: inline-block; border-radius: 9999px;" aria-hidden="true"></span>
            </div>

            <!-- Title with Orange Emphasis (Never breaks into 2 lines on desktop) -->
            <h2 class="font-headline text-2xl sm:text-3xl lg:text-[38px] xl:text-[40px] font-extrabold tracking-tight text-[#0B132A] leading-tight">
                Bạn Đang Cần Giải Quyết <span style="color: #ff5500 !important;" class="font-black">Vấn Đề Gì?</span>
            </h2>

            <!-- Subtitle -->
            <p class="font-body text-slate-500 text-xs sm:text-[13.5px] lg:text-[14px] mt-3 max-w-2xl mx-auto leading-relaxed">
                Không cần nắm rõ thuật ngữ kỹ thuật. Chọn bài toán sát nhất với thực trạng doanh nghiệp<br class="hidden sm:inline"> để tiếp cận hướng giải pháp công nghệ phù hợp.
            </p>
        </div>

        <!-- 5 Business Needs Cards Grid (STRICT 5 columns on ALL screens >= 1024px) -->
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-3.5 xl:gap-4.5 items-stretch">
            @foreach($needs as $item)
                <div class="p-4 xl:p-4.5 rounded-2xl bg-white border border-slate-200/80 shadow-[0_4px_20px_rgba(0,0,0,0.03)] hover:shadow-[0_12px_28px_rgba(0,0,0,0.08)] hover:-translate-y-1 transition-all duration-300 flex flex-col justify-between group"
                     style="border-bottom: 3.5px solid {{ $item['color'] }};">
                    
                    <div class="flex flex-col">
                        <!-- Card Top Bar: Icon + Bài Toán Badge -->
                        <div class="flex items-center justify-between mb-3">
                            <div class="w-8.5 h-8.5 xl:w-9 xl:h-9 rounded-xl flex items-center justify-center shrink-0 shadow-2xs" style="{{ $item['icon_bg'] }}">
                                {!! $item['icon_svg'] !!}
                            </div>
                            <span class="text-[10px] font-mono font-bold text-slate-400 bg-slate-100/90 px-2.5 py-0.5 rounded-full uppercase tracking-wider border border-slate-200/60">
                                {{ $item['badge'] }}
                            </span>
                        </div>

                        <!-- Title -->
                        <h3 class="font-headline text-[13px] xl:text-[13.5px] font-bold text-[#0B132A] group-hover:text-primary transition-colors leading-[1.35] mb-2 min-h-[44px] xl:min-h-[46px] flex items-start">
                            {{ $item['title'] }}
                        </h3>

                        <!-- Description -->
                        <p class="font-body text-[11px] xl:text-[11.5px] text-slate-500 leading-relaxed mb-3.5 min-h-[52px] xl:min-h-[54px]">
                            {{ $item['desc'] }}
                        </p>

                        <!-- Embedded Solution Image Showcase -->
                        <div class="rounded-xl overflow-hidden border border-slate-100/90 relative aspect-[16/8.5] bg-slate-900 group-hover:border-slate-300 transition-colors shadow-2xs">
                            <img 
                                src="{{ $item['image'] }}" 
                                alt="{{ $item['image_alt'] }}" 
                                class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500 block"
                                loading="lazy"
                            >
                        </div>
                    </div>

                    <!-- Bottom Action Link -->
                    <div class="pt-3.5 flex items-center">
                        <a href="{{ $item['action_url'] }}" 
                           class="inline-flex items-center gap-1.5 text-xs font-headline font-bold group-hover:translate-x-1 transition-transform focus-visible:ring-2 focus-visible:ring-primary focus-visible:outline-none"
                           style="color: {{ $item['color'] }};">
                            <span>{{ $item['action_label'] }}</span>
                            <span class="text-sm font-bold leading-none select-none">→</span>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>

    </div>
</section>
