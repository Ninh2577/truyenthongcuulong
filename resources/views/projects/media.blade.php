@extends('layouts.app')

@section('title', 'Dự Án Media - Sản Xuất Phim & Video Chất Lượng Cao | Truyền Thông Cửu Long')
@section('meta_description', 'Khám phá các dự án Media tiêu biểu của Truyền Thông Cửu Long: Phim doanh nghiệp, TVC quảng cáo, video sự kiện, video viral và phim tài liệu du lịch chất lượng cao 4K.')
@section('canonical', route('projects.media'))

@php
    $mediaProjects = [
        [
            'id' => 1,
            'title' => 'Teambuilding Sacombank Nha Trang',
            'category_slug' => 'video-su-kien',
            'category_name' => 'Video Sự Kiện',
            'badge_style' => 'bg-slate-900/85 text-white border-slate-700/60',
            'description' => 'Ghi lại hành trình bùng nổ năng lượng, các trò chơi gắn kết đồng đội và tinh thần bứt phá của cán bộ nhân viên Sacombank tại biển Nha Trang.',
            'image' => 'https://img.youtube.com/vi/nGvVhO2kDo8/maxresdefault.jpg',
            'client' => 'Ngân Hàng Sacombank',
            'duration' => '2 phút 15 giây',
            'year' => '2024',
            'format' => '4K UHD • Flycam & Multi-Cam',
            'video_url' => 'https://www.youtube.com/embed/nGvVhO2kDo8',
            'features' => ['Ghi hình bãi biển Nha Trang với flycam 4K sắc nét', 'Bắt trọn khoảnh khắc cuồng nhiệt và quyết tâm của các đội thi', 'Âm nhạc sôi động, nhịp dựng nhanh tràn đầy năng lượng', 'Highlight đêm trao giải gala dinner giàu cảm xúc tự hào'],
        ],
        [
            'id' => 2,
            'title' => 'Gala Dinner Kredivo – Tinh Hoa Hội Tụ',
            'category_slug' => 'video-su-kien',
            'category_name' => 'Video Sự Kiện',
            'badge_style' => 'bg-slate-900/85 text-white border-slate-700/60',
            'description' => 'Đêm tiệc tri ân đỉnh cao với visual lighting sân khấu hoành tráng, âm thanh stereo sống động và những khoảnh khắc vinh danh cảm xúc.',
            'image' => 'https://img.youtube.com/vi/pwPRwTicUhI/maxresdefault.jpg',
            'client' => 'Kredivo Việt Nam',
            'duration' => '3 phút 45 giây',
            'year' => '2024',
            'format' => '4K Multi-Cam • Live Sound Rec',
            'video_url' => 'https://www.youtube.com/embed/pwPRwTicUhI',
            'features' => ['Hệ thống 4 máy quay ghi hình toàn cảnh và cận cảnh sân khấu', 'Thu âm trực tiếp từ bàn mixer chuẩn stereo không tạp âm', 'Hiệu ứng ánh sáng LED mapping huyền ảo và bắt mắt', 'Bàn giao video recap sự kiện chất lượng cao trong vòng 24 giờ'],
        ],
        [
            'id' => 3,
            'title' => 'Teambuilding RAKUS Việt Nam – Nha Trang',
            'category_slug' => 'video-su-kien',
            'category_name' => 'Video Sự Kiện',
            'badge_style' => 'bg-slate-900/85 text-white border-slate-700/60',
            'description' => 'Hành trình gắn kết văn hóa doanh nghiệp Nhật Bản với biển xanh cát trắng rực rỡ và hoạt động bãi biển nhiệt huyết của hơn 300 nhân sự IT.',
            'image' => 'https://img.youtube.com/vi/T9h_Jq_nNWU/maxresdefault.jpg',
            'client' => 'RAKUS Việt Nam',
            'duration' => '2 phút 50 giây',
            'year' => '2024',
            'format' => '4K HDR • Drone Cinematography',
            'video_url' => 'https://www.youtube.com/embed/T9h_Jq_nNWU',
            'features' => ['Điều phối ekip 6 nhân sự tác nghiệp đồng bộ trên bãi biển', 'Góc quay flycam bắt trọn đội hình xếp chữ thương hiệu RAKUS', 'Phỏng vấn nhanh cảm nghĩ của ban giám đốc và nhân sự', 'Video recap phục vụ truyền thông nội bộ và tuyển dụng xuất sắc'],
        ],
        [
            'id' => 4,
            'title' => 'Teambuilding Toya Vietnam – Phan Thiết',
            'category_slug' => 'video-su-kien',
            'category_name' => 'Video Sự Kiện',
            'badge_style' => 'bg-slate-900/85 text-white border-slate-700/60',
            'description' => 'Thước phim trải nghiệm vượt thử thách trên đồi cát Phan Thiết, lan tỏa năng lượng tích cực và sự gắn kết bền chặt của tập thể.',
            'image' => 'https://img.youtube.com/vi/dBFbsinzwNs/maxresdefault.jpg',
            'client' => 'Toya Vietnam',
            'duration' => '4 phút 10 giây',
            'year' => '2024',
            'format' => '4K Cinema • Color Grading',
            'video_url' => 'https://www.youtube.com/embed/dBFbsinzwNs',
            'features' => ['Thước phim nghệ thuật trên đồi cát vàng Mũi Né', 'Kỹ thuật color grading điện ảnh tông màu ấm áp', 'Ghi trọn mọi nụ cười và tinh thần đồng đội vượt thử thách', 'Bản quyền âm nhạc quốc tế cấp phép chính thức cho doanh nghiệp'],
        ],
        [
            'id' => 5,
            'title' => 'Video Giới Thiệu Doanh Nghiệp – Nhà Máy Sản Xuất',
            'category_slug' => 'phim-doanh-nghiep',
            'category_name' => 'Phim Doanh Nghiệp',
            'badge_style' => 'bg-slate-900/85 text-white border-slate-700/60',
            'description' => 'Phim giới thiệu quy trình sản xuất, năng lực và tầm nhìn phát triển của doanh nghiệp.',
            'image' => 'https://images.unsplash.com/photo-1581091226825-a6a2a5aee158?auto=format&fit=crop&w=800&q=80',
            'client' => 'Tập Đoàn Chế Biến & Sản Xuất Công Nghiệp',
            'duration' => '4 phút 15 giây',
            'year' => '2024',
            'format' => '4K Ultra HD • Cinema Lens',
            'video_url' => 'https://www.youtube.com/embed/dBFbsinzwNs',
            'features' => ['Ghi hình quy trình dây chuyền tự động hóa', 'Phỏng vấn ban lãnh đạo và đội ngũ kỹ sư', 'Hiệu ứng đồ họa 3D mô phỏng quy mô xưởng', 'Âm thanh surround sống động, thuyết minh chuyên nghiệp'],
        ],
        [
            'id' => 6,
            'title' => 'TVC Sản Phẩm – Thương Hiệu Cà Phê',
            'category_slug' => 'tvc-quang-cao',
            'category_name' => 'TVC Quảng Cáo',
            'badge_style' => 'bg-amber-500 text-white border-amber-400',
            'description' => 'Tạo nên câu chuyện thương hiệu gần gũi, truyền cảm hứng và kích thích hành vi mua hàng.',
            'image' => 'https://images.unsplash.com/photo-1514432324607-a09d9b4aefdd?auto=format&fit=crop&w=800&q=80',
            'client' => 'Thương Hiệu Cà Phê Đặc Sản Pacific',
            'duration' => '1 phút 30 giây',
            'year' => '2024',
            'format' => '4K DCI • Slow-Motion 120fps',
            'video_url' => 'https://www.youtube.com/embed/nGvVhO2kDo8',
            'features' => ['Kịch bản truyền tải câu chuyện hạt cà phê nguyên bản', 'Góc quay macro nghệ thuật từng giọt cà phê sánh mịn', 'Ánh sáng studio ấm áp, khơi gợi cảm xúc', 'Tối ưu định dạng cho quảng cáo truyền hình & digital ads'],
        ],
        [
            'id' => 7,
            'title' => 'Video Sự Kiện – Lễ Kỷ Niệm Công Ty',
            'category_slug' => 'video-su-kien',
            'category_name' => 'Video Sự Kiện',
            'badge_style' => 'bg-slate-900/85 text-white border-slate-700/60',
            'description' => 'Ghi lại những khoảnh khắc đáng nhớ, chuyên nghiệp và sống động nhất.',
            'image' => 'https://images.unsplash.com/photo-1511578314322-379afb476865?auto=format&fit=crop&w=800&q=80',
            'client' => 'Lễ Kỷ Niệm 10 Năm Thành Lập Tập Đoàn',
            'duration' => '3 phút 10 giây',
            'year' => '2024',
            'format' => '4K Multi-cam Setup',
            'video_url' => 'https://www.youtube.com/embed/pwPRwTicUhI',
            'features' => ['Hệ thống 4 máy quay bắt trọn mọi góc sân khấu', 'Âm thanh thu trực tiếp từ mixer đạt chuẩn stereo', 'Dựng video highlight recap bàn giao trong 24h', 'Lưu giữ trọn vẹn cảm xúc tự hào của tập thể'],
        ],
        [
            'id' => 8,
            'title' => 'Phim Du Lịch – Khám Phá Miền Tây',
            'category_slug' => 'phim-du-lich',
            'category_name' => 'Phim Du Lịch',
            'badge_style' => 'bg-slate-900/85 text-white border-slate-700/60',
            'description' => 'Hành trình trải nghiệm, khám phá vẻ đẹp văn hóa và con người Miền Tây sông nước.',
            'image' => 'https://images.unsplash.com/photo-1528127269322-539801943592?auto=format&fit=crop&w=800&q=80',
            'client' => 'Sở Du Lịch & Hiệp Hội Lữ Hành ĐBSCL',
            'duration' => '3 phút 45 giây',
            'year' => '2024',
            'format' => '4K Cinema • Flycam Drone HDR',
            'video_url' => 'https://www.youtube.com/embed/T9h_Jq_nNWU',
            'features' => ['Khung hình flycam toàn cảnh sông nước hữu tình', 'Âm nhạc bản địa kết hợp phối khí hiện đại', 'Trải nghiệm ẩm thực chợ nổi và vườn cây trái trĩu quả', 'Quảng bá văn hóa hiếu khách của người miền Tây'],
        ],
        [
            'id' => 9,
            'title' => 'Video Viral – Lan Tỏa Thương Hiệu',
            'category_slug' => 'video-viral',
            'category_name' => 'Video Viral',
            'badge_style' => 'bg-emerald-600 text-white border-emerald-500',
            'description' => 'Sáng tạo nội dung ngắn, bắt trend, tối ưu cho mạng xã hội.',
            'image' => 'https://images.unsplash.com/photo-1506744038136-46273834b3fb?auto=format&fit=crop&w=800&q=80',
            'client' => 'Chiến Dịch Lan Tỏa Thông Điệp Xanh',
            'duration' => '1 phút 00 giây',
            'year' => '2024',
            'format' => 'Full HD 9:16 & 16:9 TikTok/Reels',
            'video_url' => 'https://www.youtube.com/embed/nGvVhO2kDo8',
            'features' => ['Kịch bản hài hước, gây tò mò trong 3 giây đầu', 'Nhịp cắt dựng nhanh, bắt nhịp xu hướng âm nhạc hot', 'Tối ưu hiển thị dọc cho TikTok, Facebook Reels, Shorts', 'Đạt hơn 2.5 triệu lượt xem tự nhiên sau 1 tuần phát hành'],
        ],
        [
            'id' => 10,
            'title' => 'Video Sản Phẩm – Đặc Sản Vùng Miền',
            'category_slug' => 'video-san-pham',
            'category_name' => 'Video Sản Phẩm',
            'badge_style' => 'bg-slate-900/85 text-white border-slate-700/60',
            'description' => 'Giới thiệu sản phẩm chân thực, hấp dẫn, tăng độ tin cậy và thúc đẩy doanh số.',
            'image' => 'https://images.unsplash.com/photo-1615141982883-c7ad0e69fd62?auto=format&fit=crop&w=800&q=80',
            'client' => 'HTX Đặc Sản Nông Thủy Sản Miền Tây',
            'duration' => '2 phút 20 giây',
            'year' => '2024',
            'format' => '4K Macro • Studio Light',
            'video_url' => 'https://www.youtube.com/embed/dBFbsinzwNs',
            'features' => ['Quay cận cảnh chi tiết kết cấu và màu sắc sản phẩm', 'Chứng minh nguồn gốc sạch, quy trình đóng gói chuẩn', 'Truyền tải cảm giác ngon miệng và chất lượng vượt trội', 'Tích hợp kêu gọi hành động (CTA) đặt hàng hiệu quả'],
        ],
    ];

    $categories = [
        ['slug' => 'all', 'name' => 'Tất cả'],
        ['slug' => 'phim-doanh-nghiep', 'name' => 'Phim Doanh Nghiệp'],
        ['slug' => 'video-su-kien', 'name' => 'Video Sự Kiện'],
        ['slug' => 'tvc-quang-cao', 'name' => 'TVC Quảng Cáo'],
        ['slug' => 'video-viral', 'name' => 'Video Viral'],
        ['slug' => 'phim-du-lich', 'name' => 'Phim Du Lịch'],
        ['slug' => 'video-san-pham', 'name' => 'Video Sản Phẩm'],
    ];
@endphp

@section('content')
<div x-data="{
    activeTab: 'all',
    searchQuery: '',
    videoModal: false,
    activeVideoUrl: '',
    activeVideoTitle: '',
    previewModal: false,
    selectedProject: null,
    totalCount: {{ count($mediaProjects) }},

    openVideo(url, title) {
        let embed = url || 'https://www.youtube.com/embed/nGvVhO2kDo8';
        if (embed.includes('watch?v=')) {
            embed = embed.replace('watch?v=', 'embed/');
        }
        if (!embed.includes('autoplay=1')) {
            embed += (embed.includes('?') ? '&' : '?') + 'autoplay=1&rel=0';
        }
        this.activeVideoUrl = embed;
        this.activeVideoTitle = title || 'Video Dự Án Media';
        this.videoModal = true;
    },

    closeVideo() {
        this.videoModal = false;
        this.activeVideoUrl = '';
    },

    openModal(proj) {
        this.selectedProject = proj;
        this.previewModal = true;
    },

    closeModal() {
        this.previewModal = false;
        this.selectedProject = null;
    },

    isProjectVisible(categorySlug, searchHaystack) {
        let matchTab = (this.activeTab === 'all') || (categorySlug === this.activeTab);
        if (!matchTab) return false;
        if (!this.searchQuery.trim()) return true;
        let q = this.searchQuery.trim().toLowerCase();
        return searchHaystack.toLowerCase().includes(q);
    }
}" class="bg-[#fcfdfd] text-slate-800 antialiased selection:bg-[#ff5400] selection:text-white">

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Caveat:wght@600;700&family=Playfair+Display:ital,wght@1,600&display=swap');
        
        .font-script-calligraphy {
            font-family: 'Caveat', cursive, sans-serif;
        }

        .media-feature-card {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 10px 16px;
            border-radius: 16px;
            background-color: #ffffff;
            border: 1px solid #eef2f6;
            box-shadow: 0 2px 10px rgba(15, 23, 42, 0.03);
            transition: all 0.25s cubic-bezier(0.16, 1, 0.3, 1);
        }
        .media-feature-card:hover {
            transform: translateY(-2px);
            border-color: rgba(255, 84, 0, 0.4);
            box-shadow: 0 8px 20px -4px rgba(255, 84, 0, 0.12);
        }

        .tab-btn-pill {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 8px 22px;
            border-radius: 9999px;
            font-size: 13.5px;
            font-weight: 600;
            white-space: nowrap;
            transition: all 0.2s ease-in-out;
            cursor: pointer;
            border: 1px solid #e2e8f0;
            background-color: #ffffff;
            color: #475569;
        }
        .tab-btn-pill:hover {
            border-color: #ff5400;
            color: #ff5400;
            background-color: #fffaf5;
        }
        .tab-btn-pill.active {
            background-color: #ff5400 !important;
            border-color: #ff5400 !important;
            color: #ffffff !important;
            box-shadow: 0 4px 14px rgba(255, 84, 0, 0.35);
        }

        .media-project-card {
            border-radius: 22px;
            background-color: #ffffff;
            border: 1px solid #edf1f7;
            box-shadow: 0 4px 20px -2px rgba(15, 23, 42, 0.05);
            overflow: hidden;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            transition: all 0.35s cubic-bezier(0.16, 1, 0.3, 1);
            height: 100%;
        }
        .media-project-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 20px 35px -8px rgba(15, 23, 42, 0.12);
            border-color: rgba(255, 84, 0, 0.3);
        }
        .media-project-card:hover .project-img {
            transform: scale(1.06);
        }
        .project-img {
            transition: transform 0.65s cubic-bezier(0.16, 1, 0.3, 1);
        }

        /* Pulse ripple for play buttons */
        @keyframes ripple-pulse {
            0% { transform: scale(0.95); box-shadow: 0 0 0 0 rgba(255, 84, 0, 0.7); }
            70% { transform: scale(1); box-shadow: 0 0 0 16px rgba(255, 84, 0, 0); }
            100% { transform: scale(0.95); box-shadow: 0 0 0 0 rgba(255, 84, 0, 0); }
        }
        .play-btn-pulse {
            animation: ripple-pulse 2.2s infinite;
        }

        /* ==================== SECTION 4: DARK STATS BANNER ==================== */
        .media-stats-section {
            position: relative;
            background: linear-gradient(135deg, #060b17 0%, #0b1528 50%, #050a16 100%) !important;
            color: #ffffff !important;
            overflow: hidden;
            border-top: 1px solid rgba(255, 255, 255, 0.08);
            border-bottom: 1px solid rgba(255, 255, 255, 0.08);
            padding: 72px 0;
        }
        .media-stats-section::before {
            content: '';
            position: absolute;
            inset: 0;
            background-image: 
                radial-gradient(circle at 85% 25%, rgba(255, 84, 0, 0.16) 0%, transparent 45%),
                radial-gradient(circle at 10% 80%, rgba(37, 99, 235, 0.15) 0%, transparent 50%);
            pointer-events: none;
        }

        .media-stats-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 6px 16px;
            border-radius: 9999px;
            font-size: 11.5px;
            font-weight: 800;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            color: #ff8533 !important;
            background: rgba(255, 84, 0, 0.12) !important;
            border: 1px solid rgba(255, 84, 0, 0.35) !important;
            box-shadow: 0 0 20px rgba(255, 84, 0, 0.15);
        }

        .media-stats-heading {
            font-size: clamp(25px, 3.2vw, 36px);
            font-weight: 900;
            line-height: 1.25;
            color: #ffffff !important;
            letter-spacing: -0.02em;
        }

        .media-highlight-orange {
            background: linear-gradient(135deg, #ff8533 0%, #ff5400 50%, #ffaa66 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .media-stats-desc {
            font-size: 13.5px;
            line-height: 1.7;
            color: #cbd5e1 !important;
            max-width: 480px;
            font-weight: 400;
        }

        .media-stat-card {
            position: relative;
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            padding: 22px 14px;
            border-radius: 20px;
            background: rgba(255, 255, 255, 0.04) !important;
            border: 1px solid rgba(255, 255, 255, 0.09) !important;
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.35), inset 0 1px 1px rgba(255, 255, 255, 0.12);
            transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
        }
        .media-stat-card:hover {
            transform: translateY(-5px);
            background: rgba(255, 255, 255, 0.07) !important;
            border-color: rgba(255, 84, 0, 0.5) !important;
            box-shadow: 0 18px 35px -8px rgba(255, 84, 0, 0.28), inset 0 1px 1px rgba(255, 255, 255, 0.2);
        }

        .media-stat-icon-wrap {
            width: 50px;
            height: 50px;
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #ff6b1a 0%, #ff4500 100%) !important;
            color: #ffffff !important;
            box-shadow: 0 8px 20px rgba(255, 84, 0, 0.4);
            margin-bottom: 14px;
            transition: transform 0.3s ease;
        }
        .media-stat-card:hover .media-stat-icon-wrap {
            transform: scale(1.1) rotate(5deg);
        }

        .media-stat-number {
            font-size: clamp(26px, 2.5vw, 34px);
            font-weight: 900;
            line-height: 1.1;
            color: #ffffff !important;
            letter-spacing: -0.02em;
            background: linear-gradient(180deg, #ffffff 40%, #fed7aa 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .media-stat-label {
            font-size: 11.5px;
            font-weight: 500;
            line-height: 1.45;
            color: #94a3b8 !important;
            margin-top: 6px;
            max-width: 140px;
        }

        /* ==================== SECTION 7: CTA BANNER ==================== */
        .media-cta-banner {
            position: relative;
            background: linear-gradient(135deg, #ff5400 0%, #f74f00 45%, #e04500 100%) !important;
            color: #ffffff !important;
            overflow: hidden;
            box-shadow: 0 20px 40px -10px rgba(255, 84, 0, 0.35);
        }

        /* ==================== SECTION 5: DỰ ÁN TIÊU BIỂU ==================== */
        .media-showcase-section {
            position: relative;
            background-color: #ffffff;
            padding: 64px 0 84px;
            overflow: hidden;
            border-bottom: 1px solid #f1f5f9;
        }

        .media-showcase-badge {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            padding: 5px 16px;
            border-radius: 9999px;
            font-size: 11.5px;
            font-weight: 800;
            letter-spacing: 0.05em;
            text-transform: uppercase;
            color: #ff5400;
            background: #fff4ed;
            border: 1px solid #ffd8c4;
            box-shadow: 0 2px 8px rgba(255, 84, 0, 0.06);
            width: fit-content;
        }

        .media-showcase-btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 9px 22px;
            border-radius: 9999px;
            border: 1.5px solid #ff5400;
            background: #ffffff;
            color: #ff5400;
            font-size: 13px;
            font-weight: 700;
            transition: all 0.25s ease;
            cursor: pointer;
            box-shadow: 0 2px 10px rgba(255, 84, 0, 0.06);
            width: fit-content;
            text-decoration: none;
        }
        .media-showcase-btn:hover {
            background: #ff5400;
            color: #ffffff;
            box-shadow: 0 6px 20px rgba(255, 84, 0, 0.3);
            transform: translateY(-2px);
        }

        .media-main-card {
            background: #ffffff;
            border-radius: 24px;
            border: 1px solid #edf2f7;
            box-shadow: 0 12px 35px -6px rgba(15, 23, 42, 0.08);
            overflow: hidden;
            transition: all 0.3s ease;
            width: 100%;
            min-width: 0;
            box-sizing: border-box;
        }
        .media-main-card:hover {
            box-shadow: 0 20px 45px -8px rgba(15, 23, 42, 0.12);
            border-color: rgba(255, 84, 0, 0.35);
        }

        .media-mini-list {
            display: flex;
            flex-direction: column;
            gap: 12px;
            width: 100%;
            min-width: 0;
            overflow: hidden;
            box-sizing: border-box;
        }

        .media-mini-card {
            background: #ffffff;
            border-radius: 18px;
            border: 1.5px solid #f1f5f9;
            box-shadow: 0 4px 16px -2px rgba(15, 23, 42, 0.04);
            padding: 10px 12px;
            display: flex;
            align-items: center;
            gap: 12px;
            cursor: pointer;
            transition: all 0.25s cubic-bezier(0.16, 1, 0.3, 1);
            width: 100%;
            min-width: 0;
            overflow: hidden;
            box-sizing: border-box;
        }
        .media-mini-card:hover {
            transform: translateY(-2px);
            border-color: #ff5400;
            box-shadow: 0 8px 20px -4px rgba(255, 84, 0, 0.15);
        }
        .media-mini-card.active {
            border-color: #ff5400 !important;
            background: #fffaf7 !important;
            box-shadow: 0 8px 22px -4px rgba(255, 84, 0, 0.18);
        }

        /* HARD-CODED DIMENSIONS ON MINI THUMBNAIL - ABSOLUTELY CANNOT OVERFLOW */
        .media-mini-thumb {
            position: relative;
            width: 100px !important;
            min-width: 100px !important;
            max-width: 100px !important;
            height: 68px !important;
            min-height: 68px !important;
            max-height: 68px !important;
            border-radius: 12px;
            overflow: hidden;
            background-color: #0f172a;
            flex-shrink: 0;
        }
        .media-mini-thumb img {
            width: 100% !important;
            height: 100% !important;
            object-fit: cover !important;
            object-position: center !important;
            display: block !important;
        }
        .media-mini-content {
            min-width: 0;
            flex: 1 1 auto;
            overflow: hidden;
        }
        .media-mini-title {
            font-size: 12.5px;
            font-weight: 700;
            color: #0f172a;
            line-height: 1.35;
            margin: 0;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
        .media-mini-card:hover .media-mini-title {
            color: #ff5400;
        }

        /* ==================== SECTION 6: KHÁCH HÀNG CHIẾN LƯỢC MARQUEE ==================== */
        @keyframes marqueeScroll {
            0% { transform: translateX(0); }
            100% { transform: translateX(-50%); }
        }
        .marquee-container {
            position: relative;
            width: 100%;
            overflow: hidden;
            display: flex;
            align-items: center;
            padding: 10px 0;
            -webkit-mask-image: linear-gradient(to right, transparent, black 48px, black calc(100% - 48px), transparent);
            mask-image: linear-gradient(to right, transparent, black 48px, black calc(100% - 48px), transparent);
        }
        .marquee-track {
            display: flex;
            align-items: center;
            gap: 14px;
            width: max-content;
            animation: marqueeScroll 80s linear infinite;
            will-change: transform;
        }
        @media (min-width: 640px) {
            .marquee-track {
                gap: 20px;
            }
        }
        .marquee-container:hover .marquee-track {
            animation-play-state: paused;
        }
        @media (prefers-reduced-motion: reduce) {
            .marquee-track {
                animation: none;
            }
        }
        .marquee-client-card {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 10px 14px;
            border-radius: 16px;
            background-color: #ffffff;
            border: 1px solid rgba(226, 232, 240, 0.9);
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.04);
            transition: all 0.25s ease;
            flex-shrink: 0;
            height: 96px;
            width: 144px;
        }
        @media (min-width: 640px) {
            .marquee-client-card {
                height: 116px;
                width: 180px;
                padding: 12px;
            }
        }
        .marquee-client-card:hover {
            border-color: rgba(255, 84, 0, 0.45);
            box-shadow: 0 8px 18px -4px rgba(255, 84, 0, 0.16);
            transform: translateY(-2px);
        }
        .marquee-client-card img {
            height: 64px;
            width: auto;
            max-width: 115px;
            object-fit: contain;
            transition: transform 0.25s ease;
        }
        @media (min-width: 640px) {
            .marquee-client-card img {
                height: 86px;
                max-width: 155px;
            }
        }
        .marquee-client-card:hover img {
            transform: scale(1.05);
        }
    </style>


    <!-- ========================================================
         SECTION 1: HERO HEADER BANNER (SẢN XUẤT PHIM & VIDEO CHẤT LƯỢNG CAO)
         ======================================================== -->
    <section class="relative w-full overflow-hidden border-b border-slate-100 bg-[#fbfdfe]">
        
        <!-- ==================== DESKTOP (LG+): 100% UNCLIPPED NATURAL BANNER WITH OVERLAY ==================== -->
        <div class="hidden lg:block relative w-full select-none">
            <!-- Background Image in natural flow: w-full h-auto guarantees 100% full view with ZERO clipping -->
            <img src="{{ asset('images/projects/banner_du_an_media.png') }}?v={{ file_exists(public_path('images/projects/banner_du_an_media.png')) ? filemtime(public_path('images/projects/banner_du_an_media.png')) : time() }}" 
                 alt="Sản Xuất Phim &amp; Video Chất Lượng Cao" 
                 class="w-full h-auto block select-none pointer-events-none"
                 loading="eager"
                 fetchpriority="high"
                 width="1024"
                 height="409">

            <!-- Content Overlay strictly fitted inside the banner -->
            <div class="absolute inset-0 z-10 flex items-center">
                <div class="max-w-7xl mx-auto px-6 lg:px-8 xl:px-10 w-full">
                    <div class="grid grid-cols-12 gap-6 xl:gap-8 items-center">
                        
                        <!-- Left 60%: Text & 4 Badges on the open left side -->
                        <div class="col-span-7 xl:col-span-6 space-y-2 lg:space-y-2.5 xl:space-y-3.5">
                            
                            <!-- Eyebrow Badge -->
                            <div>
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider text-[#ff5400] bg-white/95 backdrop-blur-md border border-orange-200/80 shadow-xs">
                                    <span class="w-2 h-2 rounded-full bg-[#ff5400] animate-ping"></span>
                                    <span class="material-symbols-outlined text-[15px]">smart_display</span>
                                    <span>DỰ ÁN MEDIA</span>
                                </span>
                            </div>

                            <!-- Main Heading -->
                            <h1 class="text-2xl lg:text-[28px] xl:text-[36px] 2xl:text-[40px] font-black tracking-tight text-slate-900 leading-[1.18]">
                                Sản Xuất Phim &amp; Video <br>
                                <span class="text-[#ff5400]">Chất Lượng Cao</span>
                            </h1>

                            <!-- Description -->
                            <p class="text-slate-800 text-xs lg:text-[12px] xl:text-sm leading-relaxed max-w-lg font-normal drop-shadow-xs">
                                Chúng tôi mang đến những thước phim giàu cảm xúc, sáng tạo và hiệu quả truyền thông, giúp thương hiệu của bạn lan tỏa mạnh mẽ trên mọi nền tảng.
                            </p>

                            <!-- 4 Badges (2x2 Grid) -->
                            <div class="grid grid-cols-2 gap-2 xl:gap-2.5 pt-1 max-w-lg">
                                <div class="media-feature-card bg-white/90 backdrop-blur-md border border-orange-100/90 rounded-xl shadow-xs p-2 xl:p-2.5">
                                    <div class="w-7 h-7 xl:w-9 xl:h-9 rounded-lg bg-orange-50 border border-orange-200/80 text-[#ff5400] flex items-center justify-center shrink-0">
                                        <span class="material-symbols-outlined text-[17px] xl:text-[20px]">edit_note</span>
                                    </div>
                                    <div class="min-w-0">
                                        <h3 class="text-[11px] xl:text-xs font-bold text-slate-800 leading-snug">Kịch bản sáng tạo</h3>
                                    </div>
                                </div>

                                <div class="media-feature-card bg-white/90 backdrop-blur-md border border-orange-100/90 rounded-xl shadow-xs p-2 xl:p-2.5">
                                    <div class="w-7 h-7 xl:w-9 xl:h-9 rounded-lg bg-orange-50 border border-orange-200/80 text-[#ff5400] flex items-center justify-center shrink-0">
                                        <span class="material-symbols-outlined text-[17px] xl:text-[20px]">videocam</span>
                                    </div>
                                    <div class="min-w-0">
                                        <h3 class="text-[11px] xl:text-xs font-bold text-slate-800 leading-snug">Quay phim chuyên nghiệp</h3>
                                    </div>
                                </div>

                                <div class="media-feature-card bg-white/90 backdrop-blur-md border border-orange-100/90 rounded-xl shadow-xs p-2 xl:p-2.5">
                                    <div class="w-7 h-7 xl:w-9 xl:h-9 rounded-lg bg-orange-50 border border-orange-200/80 text-[#ff5400] flex items-center justify-center shrink-0">
                                        <span class="material-symbols-outlined text-[17px] xl:text-[20px]">movie</span>
                                    </div>
                                    <div class="min-w-0">
                                        <h3 class="text-[11px] xl:text-xs font-bold text-slate-800 leading-snug">Dựng phim hiện đại</h3>
                                    </div>
                                </div>

                                <div class="media-feature-card bg-white/90 backdrop-blur-md border border-orange-100/90 rounded-xl shadow-xs p-2 xl:p-2.5">
                                    <div class="w-7 h-7 xl:w-9 xl:h-9 rounded-lg bg-orange-50 border border-orange-200/80 text-[#ff5400] flex items-center justify-center shrink-0">
                                        <span class="material-symbols-outlined text-[17px] xl:text-[20px]">share</span>
                                    </div>
                                    <div class="min-w-0">
                                        <h3 class="text-[11px] xl:text-xs font-bold text-slate-800 leading-snug">Phân phối đa nền tảng</h3>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <!-- Right 40%: Camera on the right with Showreel Video Play Trigger -->
                        <div class="col-span-5 xl:col-span-6 h-full flex items-center justify-end">
                            <button type="button" 
                                    @click="openVideo('https://www.youtube.com/embed/nGvVhO2kDo8', 'Showreel Năng Lực Sản Xuất Media')"
                                    class="w-14 h-14 xl:w-16 xl:h-16 rounded-full bg-[#ff5400]/90 hover:bg-[#ff5400] text-white flex items-center justify-center shadow-2xl play-btn-pulse transition-all transform hover:scale-110 mr-8 xl:mr-16 cursor-pointer"
                                    title="Xem Showreel Media"
                                    aria-label="Xem Showreel Media">
                                <span class="material-symbols-outlined text-[30px] xl:text-[34px] translate-x-0.5">play_arrow</span>
                            </button>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <!-- ==================== MOBILE / TABLET (< LG): STACKED NATURAL VIEW ==================== -->
        <div class="block lg:hidden">
            <div class="relative w-full aspect-[2.5/1] overflow-hidden bg-slate-900">
                <img src="{{ asset('images/projects/banner_du_an_media.png') }}?v={{ file_exists(public_path('images/projects/banner_du_an_media.png')) ? filemtime(public_path('images/projects/banner_du_an_media.png')) : time() }}" 
                     alt="Sản Xuất Phim &amp; Video Chất Lượng Cao" 
                     class="w-full h-full object-cover object-center"
                     loading="eager">
                <div class="absolute inset-0 flex items-center justify-center">
                    <button type="button" 
                            @click="openVideo('https://www.youtube.com/embed/nGvVhO2kDo8', 'Showreel Năng Lực Sản Xuất Media')"
                            class="w-12 h-12 rounded-full bg-[#ff5400] text-white flex items-center justify-center shadow-lg play-btn-pulse"
                            aria-label="Xem Showreel Media">
                        <span class="material-symbols-outlined text-2xl translate-x-0.5">play_arrow</span>
                    </button>
                </div>
            </div>

            <div class="px-4 py-8 space-y-4 bg-white border-t border-slate-100">
                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider text-[#ff5400] bg-orange-50 border border-orange-200">
                    <span class="material-symbols-outlined text-[15px]">smart_display</span>
                    <span>DỰ ÁN MEDIA</span>
                </span>

                <h1 class="text-2xl font-black tracking-tight text-slate-900 leading-tight">
                    Sản Xuất Phim &amp; Video <br>
                    <span class="text-[#ff5400]">Chất Lượng Cao</span>
                </h1>

                <p class="text-slate-600 text-xs sm:text-sm leading-relaxed">
                    Chúng tôi mang đến những thước phim giàu cảm xúc, sáng tạo và hiệu quả truyền thông, giúp thương hiệu của bạn lan tỏa mạnh mẽ trên mọi nền tảng.
                </p>

                <div class="grid grid-cols-2 gap-2 pt-2">
                    <div class="media-feature-card p-2 rounded-xl border border-slate-100 shadow-2xs">
                        <div class="w-7 h-7 rounded-lg bg-orange-50 text-[#ff5400] flex items-center justify-center shrink-0">
                            <span class="material-symbols-outlined text-[16px]">edit_note</span>
                        </div>
                        <span class="text-[11px] font-bold text-slate-800">Kịch bản sáng tạo</span>
                    </div>

                    <div class="media-feature-card p-2 rounded-xl border border-slate-100 shadow-2xs">
                        <div class="w-7 h-7 rounded-lg bg-orange-50 text-[#ff5400] flex items-center justify-center shrink-0">
                            <span class="material-symbols-outlined text-[16px]">videocam</span>
                        </div>
                        <span class="text-[11px] font-bold text-slate-800">Quay phim chuyên nghiệp</span>
                    </div>

                    <div class="media-feature-card p-2 rounded-xl border border-slate-100 shadow-2xs">
                        <div class="w-7 h-7 rounded-lg bg-orange-50 text-[#ff5400] flex items-center justify-center shrink-0">
                            <span class="material-symbols-outlined text-[16px]">movie</span>
                        </div>
                        <span class="text-[11px] font-bold text-slate-800">Dựng phim hiện đại</span>
                    </div>

                    <div class="media-feature-card p-2 rounded-xl border border-slate-100 shadow-2xs">
                        <div class="w-7 h-7 rounded-lg bg-orange-50 text-[#ff5400] flex items-center justify-center shrink-0">
                            <span class="material-symbols-outlined text-[16px]">share</span>
                        </div>
                        <span class="text-[11px] font-bold text-slate-800">Phân phối đa nền tảng</span>
                    </div>
                </div>
            </div>
        </div>

    </section>


    <!-- ========================================================
         SECTION 2: BREADCRUMBS & FILTER TABS & SEARCH
         ======================================================== -->
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-10 sm:pt-12">
        
        <!-- Breadcrumb Row -->
        <div class="flex flex-wrap items-center justify-between gap-3 mb-6 text-xs sm:text-sm text-slate-500">
            <nav class="flex items-center gap-2 font-medium" aria-label="Breadcrumb">
                <a href="{{ route('home') }}" class="hover:text-[#ff5400] transition-colors flex items-center gap-1">
                    <span class="material-symbols-outlined text-[17px]">home</span>
                    <span>Trang chủ</span>
                </a>
                <span class="text-slate-300">&gt;</span>
                <a href="{{ route('projects.index') }}" class="hover:text-[#ff5400] transition-colors">Dự án</a>
                <span class="text-slate-300">&gt;</span>
                <span class="text-[#ff5400] font-bold">Media</span>
            </nav>

            <div class="flex items-center gap-3">
                <a href="{{ route('projects.website') }}" 
                   class="inline-flex items-center gap-1.5 text-xs font-semibold text-slate-600 hover:text-[#ff5400] transition-colors">
                    <span class="material-symbols-outlined text-[15px]">laptop_mac</span>
                    <span>Xem kho Website</span>
                    <span class="material-symbols-outlined text-[14px]">arrow_forward</span>
                </a>
            </div>
        </div>

        <!-- Filter Tabs Row + Search Input Container -->
        <div class="flex flex-col lg:flex-row items-stretch lg:items-center justify-between gap-4 mb-10 pb-2">
            
            <!-- Category Filter Pills -->
            <div class="flex items-center gap-2 overflow-x-auto pb-2 scrollbar-none no-scrollbar flex-wrap sm:flex-nowrap">
                @foreach($categories as $cat)
                    <button type="button" 
                            @click="activeTab = '{{ $cat['slug'] }}'" 
                            :class="{ 'active': activeTab === '{{ $cat['slug'] }}' }"
                            class="tab-btn-pill">
                        {{ $cat['name'] }}
                    </button>
                @endforeach
            </div>

            <!-- Search Input -->
            <div class="relative w-full lg:w-72 shrink-0">
                <input type="text" 
                       x-model="searchQuery" 
                       placeholder="Tìm kiếm dự án..." 
                       class="w-full pl-10 pr-9 py-2.5 rounded-full border border-slate-200 bg-white text-xs sm:text-sm text-slate-800 placeholder-slate-400 focus:outline-none focus:border-[#ff5400] focus:ring-2 focus:ring-orange-100 transition-all shadow-2xs">
                <span class="material-symbols-outlined absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400 text-[18px] pointer-events-none">
                    search
                </span>
                <button type="button" 
                        x-show="searchQuery.length > 0" 
                        @click="searchQuery = ''" 
                        class="absolute right-3 top-1/2 -translate-y-1/2 text-slate-400 hover:text-slate-600 cursor-pointer"
                        title="Xóa tìm kiếm">
                    <span class="material-symbols-outlined text-[16px]">close</span>
                </button>
            </div>

        </div>

    </section>


    <!-- ========================================================
         SECTION 3: MAIN MEDIA PROJECTS GRID (6 CARDS)
         ======================================================== -->
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-16 sm:pb-24">
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 sm:gap-8">
            
            @foreach($mediaProjects as $item)
                <div x-show="isProjectVisible('{{ $item['category_slug'] }}', '{{ strtolower($item['title'] . ' ' . $item['category_name'] . ' ' . $item['client'] . ' ' . $item['description']) }}')"
                     x-transition:enter="transition ease-out duration-300"
                     x-transition:enter-start="opacity-0 scale-95"
                     x-transition:enter-end="opacity-100 scale-100"
                     class="media-project-card group">
                    
                    <!-- Card Media Thumbnail Slot -->
                    <div class="relative aspect-[16/10] overflow-hidden bg-slate-900 cursor-pointer"
                         @click="openVideo('{{ $item['video_url'] }}', '{{ $item['title'] }}')">
                        
                        <img src="{{ $item['image'] }}" 
                             alt="{{ $item['title'] }}" 
                             class="w-full h-full object-cover object-center project-img"
                             loading="lazy">

                        <!-- Category Pill Badge (Top Left Inside Thumbnail) -->
                        <div class="absolute top-3.5 left-3.5 z-10">
                            <span class="inline-block px-3 py-1 rounded-full text-[11px] font-bold tracking-wide shadow-md {{ $item['badge_style'] }}">
                                {{ $item['category_name'] }}
                            </span>
                        </div>

                        <!-- Hover Video Play Trigger Overlay -->
                        <div class="absolute inset-0 bg-slate-950/40 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center">
                            <div class="w-14 h-14 rounded-full bg-[#ff5400] text-white flex items-center justify-center shadow-lg transform scale-75 group-hover:scale-100 transition-transform duration-300">
                                <span class="material-symbols-outlined text-[30px] translate-x-0.5">play_arrow</span>
                            </div>
                        </div>

                        <!-- Duration Badge (Bottom Right) -->
                        <div class="absolute bottom-3 right-3 z-10 px-2.5 py-1 rounded-md bg-black/70 backdrop-blur-xs text-white text-[11px] font-mono flex items-center gap-1 pointer-events-none">
                            <span class="material-symbols-outlined text-[13px] text-amber-400">schedule</span>
                            <span>{{ $item['duration'] }}</span>
                        </div>

                    </div>

                    <!-- Card Body -->
                    <div class="p-5 sm:p-6 flex flex-col justify-between flex-1">
                        
                        <div class="space-y-2.5">
                            
                            <!-- Project Title -->
                            <h3 class="font-bold text-slate-900 text-base sm:text-lg group-hover:text-[#ff5400] transition-colors line-clamp-2 leading-snug cursor-pointer"
                                @click="openModal({{ json_encode($item) }})">
                                {{ $item['title'] }}
                            </h3>

                            <!-- Project Description -->
                            <p class="text-xs sm:text-sm text-slate-600 line-clamp-2 leading-relaxed">
                                {{ $item['description'] }}
                            </p>

                        </div>

                        <!-- Card Footer Link: Xem chi tiết -> -->
                        <div class="pt-5 mt-4 border-t border-slate-100 flex items-center justify-between">
                            <button type="button" 
                                    @click="openModal({{ json_encode($item) }})"
                                    class="inline-flex items-center gap-1.5 text-xs sm:text-sm font-bold text-[#ff5400] hover:text-[#d94800] transition-colors group/link cursor-pointer">
                                <span>Xem chi tiết</span>
                                <span class="material-symbols-outlined text-[16px] group-hover/link:translate-x-1 transition-transform">arrow_forward</span>
                            </button>

                            <button type="button"
                                    @click="openVideo('{{ $item['video_url'] }}', '{{ $item['title'] }}')"
                                    class="w-8 h-8 rounded-full bg-orange-50 hover:bg-[#ff5400] text-[#ff5400] hover:text-white flex items-center justify-center transition-colors shadow-2xs"
                                    title="Phát video"
                                    aria-label="Phát video">
                                <span class="material-symbols-outlined text-[16px]">play_arrow</span>
                            </button>
                        </div>

                    </div>

                </div>
            @endforeach

        </div>

        <!-- No Results Fallback -->
        <div x-cloak 
             x-show="false" 
             class="text-center py-16 bg-white rounded-3xl border border-dashed border-slate-200 mt-8">
            <span class="material-symbols-outlined text-4xl text-slate-400 mb-2">videocam_off</span>
            <p class="text-slate-600 font-medium text-sm">Không tìm thấy dự án media phù hợp với từ khóa.</p>
            <button type="button" @click="activeTab = 'all'; searchQuery = ''" class="mt-3 px-4 py-2 rounded-full bg-[#ff5400] text-white font-bold text-xs">
                Xem tất cả dự án
            </button>
        </div>

    </section>


    <!-- ========================================================
         SECTION 4: DARK STATS BANNER (HÀNH TRÌNH TẠO NÊN NHỮNG THƯỚC PHIM GIÁ TRỊ)
         ======================================================== -->
    <section class="media-stats-section" style="background: linear-gradient(135deg, #060b17 0%, #0b1528 50%, #050a16 100%) !important; color: #ffffff !important;">
        
        <!-- Cinema Camera Rig Watermark Background -->
        <div class="absolute inset-0 opacity-15 pointer-events-none mix-blend-luminosity bg-cover bg-center"
             style="background-image: url('https://images.unsplash.com/photo-1536240478700-b869070f9279?auto=format&fit=crop&w=1600&q=80');"></div>

        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 lg:gap-14 items-center">
                
                <!-- Left Column: Eyebrow, Heading, Subtext -->
                <div class="lg:col-span-5 space-y-4">
                    
                    <div>
                        <span class="media-stats-badge">
                            <span class="material-symbols-outlined text-[15px]" style="color: #ff8533;">timeline</span>
                            <span>SỐ LIỆU NỔI BẬT</span>
                        </span>
                    </div>

                    <h2 class="media-stats-heading">
                        Hành Trình Tạo Nên <br class="hidden sm:inline">
                        <span class="media-highlight-orange">Những Thước Phim Giá Trị</span>
                    </h2>

                    <p class="media-stats-desc">
                        Với kinh nghiệm thực chiến và đội ngũ sáng tạo chuyên nghiệp, chúng tôi đã đồng hành cùng hàng trăm doanh nghiệp, thương hiệu trên khắp cả nước.
                    </p>

                </div>

                <!-- Right Column: 4 Stat Counters in a Row -->
                <div class="lg:col-span-7 grid grid-cols-2 sm:grid-cols-4 gap-4 sm:gap-4">
                    
                    <!-- Stat 1: 300+ -->
                    <div class="media-stat-card">
                        <div class="media-stat-icon-wrap">
                            <span class="material-symbols-outlined text-[24px]">movie</span>
                        </div>
                        <div class="media-stat-number">300+</div>
                        <div class="media-stat-label">
                            Dự án Media đã thực hiện
                        </div>
                    </div>

                    <!-- Stat 2: 150+ -->
                    <div class="media-stat-card">
                        <div class="media-stat-icon-wrap">
                            <span class="material-symbols-outlined text-[24px]">groups</span>
                        </div>
                        <div class="media-stat-number">150+</div>
                        <div class="media-stat-label">
                            Khách hàng tin tưởng
                        </div>
                    </div>

                    <!-- Stat 3: 98% -->
                    <div class="media-stat-card">
                        <div class="media-stat-icon-wrap">
                            <span class="material-symbols-outlined text-[24px]">sentiment_very_satisfied</span>
                        </div>
                        <div class="media-stat-number">98%</div>
                        <div class="media-stat-label">
                            Khách hàng hài lòng
                        </div>
                    </div>

                    <!-- Stat 4: 5+ -->
                    <div class="media-stat-card">
                        <div class="media-stat-icon-wrap">
                            <span class="material-symbols-outlined text-[24px]">military_tech</span>
                        </div>
                        <div class="media-stat-number">5+</div>
                        <div class="media-stat-label">
                            Năm kinh nghiệm trong lĩnh vực Media
                        </div>
                    </div>

                </div>

            </div>

        </div>
    </section>


    <!-- ========================================================
         SECTION 5: DỰ ÁN TIÊU BIỂU (GÓC NHÌN THỰC TẾ TỪ NHỮNG DỰ ÁN NỔI BẬT)
         ======================================================== -->
    @php
        $eventProjects = [
            collect($mediaProjects)->firstWhere('title', 'Teambuilding Sacombank Nha Trang'),
            collect($mediaProjects)->firstWhere('title', 'Gala Dinner Kredivo – Tinh Hoa Hội Tụ'),
            collect($mediaProjects)->firstWhere('title', 'Teambuilding RAKUS Việt Nam – Nha Trang'),
            collect($mediaProjects)->firstWhere('title', 'Teambuilding Toya Vietnam – Phan Thiết'),
        ];
        $defaultFeatured = $eventProjects[0];
    @endphp
    <section class="media-showcase-section relative bg-white py-16 sm:py-24 border-b border-slate-100 overflow-hidden" 
             x-data="{ currentFeatured: {{ json_encode($defaultFeatured) }} }">
        
        <!-- Decorative Top-Left Flowing Orange Wave Ribbon -->
        <div class="absolute top-0 left-0 w-64 sm:w-88 h-36 sm:h-52 pointer-events-none z-0 overflow-hidden select-none">
            <svg viewBox="0 0 360 220" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-full h-full">
                <path d="M-40 -20C70 0 150 45 175 110C195 165 145 205 75 218L-40 220Z" fill="url(#topWaveOrange)" opacity="0.95"/>
                <path d="M-40 30C50 50 110 90 135 145L-40 200Z" fill="#ffffff" opacity="0.25"/>
                <defs>
                    <linearGradient id="topWaveOrange" x1="-40" y1="-20" x2="180" y2="180" gradientUnits="userSpaceOnUse">
                        <stop stop-color="#ff7b2b"/>
                        <stop offset="1" stop-color="#ff4a00"/>
                    </linearGradient>
                </defs>
            </svg>
        </div>

        <!-- Decorative Bottom Flowing Warm Orange Gradient Wave -->
        <div class="absolute bottom-0 left-0 w-full h-36 sm:h-44 pointer-events-none z-0 overflow-hidden select-none">
            <svg viewBox="0 0 1440 180" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-full h-full" preserveAspectRatio="none">
                <path d="M0 110C240 50 490 85 730 125C1020 170 1260 140 1440 80V180H0Z" fill="url(#botWaveOrange)" opacity="0.45"/>
                <path d="M0 145C320 95 670 115 1000 155C1220 175 1370 160 1440 140V180H0Z" fill="#ff5400" opacity="0.12"/>
                <defs>
                    <linearGradient id="botWaveOrange" x1="0" y1="80" x2="1440" y2="180" gradientUnits="userSpaceOnUse">
                        <stop stop-color="#ff9955" stop-opacity="0.35"/>
                        <stop offset="0.5" stop-color="#ff5400" stop-opacity="0.25"/>
                        <stop offset="1" stop-color="#ff3b00" stop-opacity="0.35"/>
                    </linearGradient>
                </defs>
            </svg>
        </div>

        <!-- Decorative Bottom-Left Translucent Filmstrip Graphic -->
        <div class="absolute bottom-3 left-0 sm:left-4 -translate-x-8 sm:translate-x-0 pointer-events-none z-0 select-none opacity-40">
            <svg width="280" height="65" viewBox="0 0 280 65" fill="none" xmlns="http://www.w3.org/2000/svg" class="-rotate-12 transform origin-bottom-left">
                <rect x="0" y="4" width="280" height="56" rx="4" fill="#ffffff" stroke="#ff7a29" stroke-width="1.8" opacity="0.8"/>
                <!-- Sprockets Top -->
                <rect x="8" y="7" width="8" height="6" rx="1.5" fill="#ff5400" opacity="0.6"/>
                <rect x="24" y="7" width="8" height="6" rx="1.5" fill="#ff5400" opacity="0.6"/>
                <rect x="40" y="7" width="8" height="6" rx="1.5" fill="#ff5400" opacity="0.6"/>
                <rect x="56" y="7" width="8" height="6" rx="1.5" fill="#ff5400" opacity="0.6"/>
                <rect x="72" y="7" width="8" height="6" rx="1.5" fill="#ff5400" opacity="0.6"/>
                <rect x="88" y="7" width="8" height="6" rx="1.5" fill="#ff5400" opacity="0.6"/>
                <rect x="104" y="7" width="8" height="6" rx="1.5" fill="#ff5400" opacity="0.6"/>
                <rect x="120" y="7" width="8" height="6" rx="1.5" fill="#ff5400" opacity="0.6"/>
                <rect x="136" y="7" width="8" height="6" rx="1.5" fill="#ff5400" opacity="0.6"/>
                <rect x="152" y="7" width="8" height="6" rx="1.5" fill="#ff5400" opacity="0.6"/>
                <rect x="168" y="7" width="8" height="6" rx="1.5" fill="#ff5400" opacity="0.6"/>
                <rect x="184" y="7" width="8" height="6" rx="1.5" fill="#ff5400" opacity="0.6"/>
                <rect x="200" y="7" width="8" height="6" rx="1.5" fill="#ff5400" opacity="0.6"/>
                <rect x="216" y="7" width="8" height="6" rx="1.5" fill="#ff5400" opacity="0.6"/>
                <rect x="232" y="7" width="8" height="6" rx="1.5" fill="#ff5400" opacity="0.6"/>
                <rect x="248" y="7" width="8" height="6" rx="1.5" fill="#ff5400" opacity="0.6"/>
                <rect x="264" y="7" width="8" height="6" rx="1.5" fill="#ff5400" opacity="0.6"/>
                <!-- Film frames -->
                <rect x="6" y="16" width="50" height="32" rx="2" fill="#fff5ee" stroke="#ff7a29" stroke-width="1.2" opacity="0.75"/>
                <rect x="62" y="16" width="50" height="32" rx="2" fill="#fff5ee" stroke="#ff7a29" stroke-width="1.2" opacity="0.75"/>
                <rect x="118" y="16" width="50" height="32" rx="2" fill="#fff5ee" stroke="#ff7a29" stroke-width="1.2" opacity="0.75"/>
                <rect x="174" y="16" width="50" height="32" rx="2" fill="#fff5ee" stroke="#ff7a29" stroke-width="1.2" opacity="0.75"/>
                <rect x="230" y="16" width="44" height="32" rx="2" fill="#fff5ee" stroke="#ff7a29" stroke-width="1.2" opacity="0.75"/>
                <!-- Sprockets Bottom -->
                <rect x="8" y="51" width="8" height="6" rx="1.5" fill="#ff5400" opacity="0.6"/>
                <rect x="24" y="51" width="8" height="6" rx="1.5" fill="#ff5400" opacity="0.6"/>
                <rect x="40" y="51" width="8" height="6" rx="1.5" fill="#ff5400" opacity="0.6"/>
                <rect x="56" y="51" width="8" height="6" rx="1.5" fill="#ff5400" opacity="0.6"/>
                <rect x="72" y="51" width="8" height="6" rx="1.5" fill="#ff5400" opacity="0.6"/>
                <rect x="88" y="51" width="8" height="6" rx="1.5" fill="#ff5400" opacity="0.6"/>
                <rect x="104" y="51" width="8" height="6" rx="1.5" fill="#ff5400" opacity="0.6"/>
                <rect x="120" y="51" width="8" height="6" rx="1.5" fill="#ff5400" opacity="0.6"/>
                <rect x="136" y="51" width="8" height="6" rx="1.5" fill="#ff5400" opacity="0.6"/>
                <rect x="152" y="51" width="8" height="6" rx="1.5" fill="#ff5400" opacity="0.6"/>
                <rect x="168" y="51" width="8" height="6" rx="1.5" fill="#ff5400" opacity="0.6"/>
                <rect x="184" y="51" width="8" height="6" rx="1.5" fill="#ff5400" opacity="0.6"/>
                <rect x="200" y="51" width="8" height="6" rx="1.5" fill="#ff5400" opacity="0.6"/>
                <rect x="216" y="51" width="8" height="6" rx="1.5" fill="#ff5400" opacity="0.6"/>
                <rect x="232" y="51" width="8" height="6" rx="1.5" fill="#ff5400" opacity="0.6"/>
                <rect x="248" y="51" width="8" height="6" rx="1.5" fill="#ff5400" opacity="0.6"/>
                <rect x="264" y="51" width="8" height="6" rx="1.5" fill="#ff5400" opacity="0.6"/>
            </svg>
        </div>

        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 z-10">
            
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 xl:gap-8 items-center">
                
                <!-- Left Column (4 cols): Eyebrow, Heading, Subtext, Outline Button & Script Text -->
                <div class="lg:col-span-4 min-w-0 space-y-3.5">
                    
                    <div>
                        <span class="media-showcase-badge">
                            <span class="material-symbols-outlined text-[17px] text-[#ff5400]">movie</span>
                            <span>DỰ ÁN TIÊU BIỂU</span>
                        </span>
                    </div>

                    <h2 class="text-2xl sm:text-3xl lg:text-[28px] xl:text-[34px] font-black text-slate-900 tracking-tight leading-snug">
                        Góc Nhìn Thực Tế Từ <br>
                        <span class="relative inline-block text-[#ff5400] mt-1 whitespace-nowrap">
                            Những Dự Án Nổi Bật
                            <svg class="absolute -bottom-2 left-0 w-full h-2.5 text-[#ff5400]/80 pointer-events-none" viewBox="0 0 260 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M4 7C70 2 190 2 256 7" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"/>
                            </svg>
                        </span>
                    </h2>

                    <p class="text-xs sm:text-sm text-slate-600 leading-relaxed font-normal max-w-sm pt-0.5">
                        Mỗi dự án là một câu chuyện, mỗi khung hình là một giá trị. Cùng khám phá những sản phẩm media tiêu biểu mà chúng tôi đã thực hiện.
                    </p>

                    <div class="pt-1">
                        <a href="{{ route('contact') }}?service=media" 
                           class="media-showcase-btn group">
                            <span>Xem tất cả dự án</span>
                            <span class="material-symbols-outlined text-[16px] group-hover:translate-x-1 transition-transform">arrow_forward</span>
                        </a>
                    </div>

                    <!-- Calligraphy handwritten script with underline (Creative Media Production) -->
                    <div class="pt-3 pl-2 select-none">
                        <div class="font-script-calligraphy -rotate-6 text-[#ff5400] text-2xl sm:text-[26px] font-bold tracking-wide leading-tight">
                            Creative<br>
                            <span class="pl-3">Media</span><br>
                            <span class="pl-6">Production</span>
                            <svg class="w-28 h-3 text-[#ff5400] mt-0.5 ml-4" viewBox="0 0 140 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M4 8C45 2 95 2 136 8" stroke="currentColor" stroke-width="2.2" stroke-linecap="round"/>
                            </svg>
                        </div>
                    </div>

                </div>

                <!-- Center Column (5 cols): Large Featured Video Card -->
                <div class="lg:col-span-5 min-w-0 media-main-card group">
                    
                    <!-- Video Thumbnail with Play Button -->
                    <div class="relative w-full aspect-[16/10] overflow-hidden bg-slate-950 cursor-pointer"
                         @click="openVideo(currentFeatured.video_url, currentFeatured.title)">
                        
                        <img :src="currentFeatured.image" 
                             :alt="currentFeatured.title" 
                             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700 block">

                        <!-- Top-Left Solid Orange Pill Badge -->
                        <div class="absolute top-3.5 left-3.5 z-10">
                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold text-white bg-[#ff5400] shadow-md">
                                <span class="material-symbols-outlined text-[14px]">play_arrow</span>
                                <span x-text="currentFeatured.category_name">Video Sự Kiện</span>
                            </span>
                        </div>

                        <!-- Big Circular White Play Button Overlay -->
                        <div class="absolute inset-0 bg-slate-950/20 group-hover:bg-slate-950/40 transition-colors flex items-center justify-center">
                            <div class="w-14 h-14 sm:w-16 sm:h-16 rounded-full bg-white/95 text-[#ff5400] flex items-center justify-center shadow-2xl transform scale-95 group-hover:scale-110 transition-transform duration-300">
                                <span class="material-symbols-outlined text-[32px] sm:text-[36px] translate-x-0.5">play_arrow</span>
                            </div>
                        </div>

                    </div>

                    <!-- Card Body -->
                    <div class="p-4 sm:p-5 lg:p-6 space-y-2.5 bg-white">
                        
                        <h3 class="font-black text-slate-900 text-base sm:text-lg lg:text-xl group-hover:text-[#ff5400] transition-colors leading-snug cursor-pointer line-clamp-2"
                            x-text="currentFeatured.title"
                            @click="openModal(currentFeatured)">
                            {{ $defaultFeatured['title'] }}
                        </h3>

                        <!-- Meta Info Row -->
                        <div class="flex items-center gap-3 text-xs font-medium">
                            <span class="inline-flex items-center gap-1.5 text-slate-600 font-semibold">
                                <span class="material-symbols-outlined text-[16px] text-[#ff5400]">schedule</span>
                                <span x-text="currentFeatured.duration">{{ $defaultFeatured['duration'] }}</span>
                            </span>
                            <span class="text-slate-300">•</span>
                            <span class="inline-flex items-center gap-1.5 text-slate-600 font-semibold">
                                <span class="material-symbols-outlined text-[16px] text-[#ff5400]">calendar_today</span>
                                <span x-text="currentFeatured.year">{{ $defaultFeatured['year'] }}</span>
                            </span>
                        </div>

                        <p class="text-xs sm:text-sm text-slate-600 line-clamp-2 leading-relaxed"
                           x-text="currentFeatured.description">
                            {{ $defaultFeatured['description'] }}
                        </p>

                        <div class="pt-1">
                            <button type="button" 
                                    @click="openModal(currentFeatured)"
                                    class="inline-flex items-center gap-1.5 text-xs sm:text-sm font-bold text-[#ff5400] hover:underline cursor-pointer group/more">
                                <span>Xem chi tiết</span>
                                <span class="material-symbols-outlined text-[15px] group-hover/more:translate-x-1 transition-transform">arrow_forward</span>
                            </button>
                        </div>

                    </div>

                </div>

                <!-- Right Column (3 cols): 3 Stacked Mini Cards with Event Projects -->
                <div class="lg:col-span-3 min-w-0 w-full overflow-hidden space-y-3">
                    
                    <div class="media-mini-list">
                        @foreach([$eventProjects[1], $eventProjects[2], $eventProjects[3]] as $miniIndex => $miniItem)
                            <div class="media-mini-card group/mini cursor-pointer"
                                 :class="{ 'active': currentFeatured.title === '{{ addslashes($miniItem['title']) }}' }"
                                 @click="currentFeatured = {{ json_encode($miniItem) }}">
                                
                                <!-- Mini Video Thumbnail strictly constrained in pixels -->
                                <div class="media-mini-thumb" style="width: 100px; min-width: 100px; max-width: 100px; height: 68px; min-height: 68px; max-height: 68px; flex-shrink: 0; overflow: hidden; position: relative; border-radius: 12px; background: #0f172a;">
                                    <img src="{{ $miniItem['image'] }}" 
                                         alt="{{ $miniItem['title'] }}" 
                                         style="width: 100%; height: 100%; object-fit: cover; display: block;"
                                         class="group-hover/mini:scale-105 transition-transform duration-300">
                                    <div class="absolute inset-0 bg-black/25 flex items-center justify-center">
                                        <div class="w-6 h-6 rounded-full bg-white/95 text-[#ff5400] flex items-center justify-center shadow-xs">
                                            <span class="material-symbols-outlined text-[15px] translate-x-0.2">play_arrow</span>
                                        </div>
                                    </div>
                                </div>

                                <!-- Mini Card Content -->
                                <div class="media-mini-content">
                                    <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-md text-[10px] font-bold text-[#ff5400] bg-orange-50 border border-orange-200/80 mb-1">
                                        <span class="material-symbols-outlined text-[12px]">videocam</span>
                                        <span>{{ $miniItem['category_name'] }}</span>
                                    </span>
                                    <h4 class="media-mini-title group-hover/mini:text-[#ff5400] transition-colors">
                                        {{ $miniItem['title'] }}
                                    </h4>
                                </div>

                            </div>
                        @endforeach
                    </div>

                    <!-- 3 Carousel / pagination dots -->
                    <div class="flex items-center justify-center gap-2 pt-1.5">
                        <button type="button" 
                                @click="currentFeatured = {{ json_encode($eventProjects[1]) }}"
                                :class="currentFeatured.title === '{{ addslashes($eventProjects[1]['title']) }}' ? 'w-5 bg-[#ff5400]' : 'w-2 bg-slate-300'"
                                class="h-2 rounded-full transition-all duration-300 cursor-pointer"
                                aria-label="Xem dự án 1"></button>
                        <button type="button" 
                                @click="currentFeatured = {{ json_encode($eventProjects[2]) }}"
                                :class="currentFeatured.title === '{{ addslashes($eventProjects[2]['title']) }}' ? 'w-5 bg-[#ff5400]' : 'w-2 bg-slate-300'"
                                class="h-2 rounded-full transition-all duration-300 cursor-pointer"
                                aria-label="Xem dự án 2"></button>
                        <button type="button" 
                                @click="currentFeatured = {{ json_encode($eventProjects[3]) }}"
                                :class="currentFeatured.title === '{{ addslashes($eventProjects[3]['title']) }}' ? 'w-5 bg-[#ff5400]' : 'w-2 bg-slate-300'"
                                class="h-2 rounded-full transition-all duration-300 cursor-pointer"
                                aria-label="Xem dự án 3"></button>
                    </div>

                </div>

            </div>

        </div>
    </section>


    <!-- ========================================================
         SECTION 6: KHÁCH HÀNG CHIẾN LƯỢC • ĐỒNG HÀNH CÙNG TRUYỀN THÔNG CỬU LONG
         ======================================================== -->
    @php
        $clientLogos = range(1, 48);
        $logoVersion = file_exists(public_path('images/logoKhachHang/1.png')) 
            ? filemtime(public_path('images/logoKhachHang/1.png')) 
            : time();
    @endphp
    <section class="w-full bg-slate-50 border-b border-slate-200/80 py-8 lg:py-10 overflow-hidden" id="marquee-section">
        
        <!-- Header: Khách hàng & Đối tác tiêu biểu -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-4">
            <div class="flex items-center justify-center gap-3 text-center">
                <span class="h-px w-8 bg-slate-300"></span>
                <p class="font-mono text-xs font-bold uppercase tracking-widest text-slate-500">
                    Khách Hàng Chiến Lược &bull; Khách Hàng Đồng Hành Cùng Truyền Thông Cửu Long
                </p>
                <span class="h-px w-8 bg-slate-300"></span>
            </div>
        </div>

        <!-- Dải duy nhất: KHÁCH HÀNG & ĐỐI TÁC TIÊU BIỂU (Toàn bộ 48 Logo cuộn sang trái) -->
        <div class="marquee-container relative w-full overflow-hidden flex items-center py-2.5">
            <div class="marquee-track flex items-center gap-3.5 sm:gap-5 shrink-0" aria-label="Danh sách logo khách hàng đồng hành">
                {{-- Dải phần tử gốc cho người dùng và thiết bị trợ thính (Screen Reader) --}}
                @foreach($clientLogos as $logo)
                    <div class="marquee-client-card group shrink-0">
                        <img src="{{ asset('images/logoKhachHang/' . $logo . '.png') }}?v={{ $logoVersion }}"
                             alt="Logo khách hàng Cửu Long Media {{ $logo }}"
                             loading="lazy">
                    </div>
                @endforeach
                {{-- Dải nhân đôi phục vụ hiệu ứng lặp CSS vô tận, ẩn với Screen Reader để tránh đọc trùng --}}
                @foreach($clientLogos as $logo)
                    <div class="marquee-client-card group shrink-0" aria-hidden="true">
                        <img src="{{ asset('images/logoKhachHang/' . $logo . '.png') }}?v={{ $logoVersion }}"
                             alt=""
                             loading="lazy">
                    </div>
                @endforeach
            </div>
        </div>

    </section>


    <!-- ========================================================
         SECTION 7: PRE-FOOTER CTA BANNER (BẠN ĐANG CẦN SẢN XUẤT VIDEO?)
         ======================================================== -->
    <section class="media-cta-banner relative py-14 sm:py-18 text-white overflow-hidden shadow-xl" style="background: linear-gradient(135deg, #ff5400 0%, #f74f00 45%, #e04500 100%) !important; color: #ffffff !important;">
        
        <!-- Camera Background Silhouette Watermark -->
        <div class="absolute inset-0 opacity-15 mix-blend-overlay bg-cover bg-center pointer-events-none"
             style="background-image: url('https://images.unsplash.com/photo-1492691527719-9d1e07e534b4?auto=format&fit=crop&w=1600&q=80');"></div>

        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <div class="flex flex-col lg:flex-row items-center justify-between gap-8 text-center lg:text-left">
                
                <!-- Left Title & Eyebrow -->
                <div class="space-y-2 max-w-2xl">
                    <div class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-white/20 backdrop-blur-xs text-xs font-bold uppercase tracking-wider text-white">
                        <span class="material-symbols-outlined text-[15px]">videocam</span>
                        <span>BẠN ĐANG CẦN SẢN XUẤT VIDEO?</span>
                    </div>

                    <h2 class="text-2xl sm:text-3xl lg:text-4xl font-black text-white tracking-tight leading-tight">
                        Hãy Để Chúng Tôi Biến Ý Tưởng <br class="hidden sm:inline">
                        Của Bạn Thành Hiện Thực!
                    </h2>
                </div>

                <!-- Right Subtext & Button -->
                <div class="space-y-4 max-w-md text-center lg:text-right">
                    <p class="text-xs sm:text-sm text-white/90 leading-relaxed font-normal">
                        Liên hệ ngay với đội ngũ của chúng tôi để được tư vấn và nhận báo giá tốt nhất.
                    </p>

                    <div>
                        <a href="{{ route('contact') }}?service=media" 
                           class="inline-flex items-center gap-2 px-8 py-3.5 rounded-full bg-white hover:bg-orange-50 text-[#ff5400] font-black text-xs sm:text-sm shadow-xl hover:shadow-2xl hover:scale-105 active:scale-95 transition-all">
                            <span>Liên hệ ngay</span>
                            <span class="material-symbols-outlined text-[16px]">arrow_forward</span>
                        </a>
                    </div>
                </div>

            </div>

        </div>
    </section>


    <!-- ========================================================
         MODAL 1: INTERACTIVE YOUTUBE VIDEO LIGHTBOX POPUP
         ======================================================== -->
    <div x-show="videoModal" 
         x-cloak
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/85 backdrop-blur-md"
         @keydown.escape.window="closeVideo()">
        
        <div class="relative w-full max-w-4xl bg-slate-950 rounded-3xl overflow-hidden shadow-2xl border border-white/10"
             @click.away="closeVideo()">
            
            <!-- Video Modal Header -->
            <div class="flex items-center justify-between px-6 py-4 border-b border-slate-800 bg-slate-900/80">
                <div class="flex items-center gap-2">
                    <span class="w-2.5 h-2.5 rounded-full bg-red-500 animate-pulse"></span>
                    <h3 class="font-bold text-white text-sm sm:text-base line-clamp-1" x-text="activeVideoTitle"></h3>
                </div>
                <button type="button" 
                        @click="closeVideo()" 
                        class="w-9 h-9 rounded-full bg-white/10 text-white hover:bg-white/20 flex items-center justify-center transition-colors cursor-pointer"
                        title="Đóng video">
                    <span class="material-symbols-outlined text-lg">close</span>
                </button>
            </div>

            <!-- Responsive Video Iframe Container -->
            <div class="relative aspect-video w-full bg-black">
                <template x-if="videoModal">
                    <iframe :src="activeVideoUrl" 
                            class="w-full h-full border-0" 
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" 
                            allowfullscreen></iframe>
                </template>
            </div>

        </div>
    </div>


    <!-- ========================================================
         MODAL 2: PROJECT DETAIL & SPECS MODAL
         ======================================================== -->
    <div x-show="previewModal" 
         x-cloak
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/80 backdrop-blur-sm"
         @keydown.escape.window="closeModal()">
        
        <div class="relative w-full max-w-2xl bg-white rounded-3xl overflow-hidden shadow-2xl border border-slate-100 flex flex-col max-h-[90vh]"
             @click.away="closeModal()">
            
            <!-- Modal Header -->
            <div class="flex items-center justify-between px-6 py-4 border-b border-slate-100 bg-slate-50/70">
                <div class="flex items-center gap-2">
                    <span class="px-2.5 py-0.5 rounded-full text-xs font-bold bg-orange-100 text-[#ff5400]" 
                          x-text="selectedProject ? selectedProject.category_name : ''"></span>
                    <h3 class="font-bold text-slate-900 text-sm sm:text-base line-clamp-1" 
                        x-text="selectedProject ? selectedProject.title : ''"></h3>
                </div>
                <button type="button" 
                        @click="closeModal()" 
                        class="w-8 h-8 rounded-full bg-slate-100 text-slate-500 hover:bg-slate-200 flex items-center justify-center transition-colors cursor-pointer">
                    <span class="material-symbols-outlined text-lg">close</span>
                </button>
            </div>

            <!-- Modal Content -->
            <div class="overflow-y-auto p-6 space-y-5" x-if="selectedProject">
                
                <!-- Image & Play Trigger -->
                <div class="relative rounded-2xl overflow-hidden aspect-video bg-slate-900 group cursor-pointer"
                     @click="openVideo(selectedProject?.video_url, selectedProject?.title); closeModal();">
                    <img :src="selectedProject?.image" 
                         :alt="selectedProject?.title" 
                         class="w-full h-full object-cover">
                    <div class="absolute inset-0 bg-black/40 flex items-center justify-center">
                        <div class="w-16 h-16 rounded-full bg-[#ff5400] text-white flex items-center justify-center shadow-xl group-hover:scale-110 transition-transform">
                            <span class="material-symbols-outlined text-3xl translate-x-0.5">play_arrow</span>
                        </div>
                    </div>
                </div>

                <!-- Info Grid -->
                <div class="grid grid-cols-2 sm:grid-cols-3 gap-3 p-4 rounded-2xl bg-slate-50 border border-slate-100 text-xs">
                    <div>
                        <div class="text-slate-400 font-medium">Khách hàng</div>
                        <div class="font-bold text-slate-800 mt-0.5" x-text="selectedProject?.client"></div>
                    </div>
                    <div>
                        <div class="text-slate-400 font-medium">Thời lượng / Năm</div>
                        <div class="font-bold text-slate-800 mt-0.5" x-text="(selectedProject?.duration || '') + ' • ' + (selectedProject?.year || '')"></div>
                    </div>
                    <div class="col-span-2 sm:col-span-1">
                        <div class="text-slate-400 font-medium">Định dạng sản xuất</div>
                        <div class="font-bold text-[#ff5400] mt-0.5" x-text="selectedProject?.format"></div>
                    </div>
                </div>

                <!-- Description -->
                <div>
                    <h4 class="font-bold text-slate-900 text-sm mb-1.5">Giới thiệu sản xuất:</h4>
                    <p class="text-xs sm:text-sm text-slate-600 leading-relaxed" x-text="selectedProject?.description"></p>
                </div>

                <!-- Key Highlights -->
                <div>
                    <h4 class="font-bold text-slate-900 text-sm mb-2">Quy chuẩn thực hiện:</h4>
                    <ul class="grid grid-cols-1 sm:grid-cols-2 gap-2 text-xs text-slate-600">
                        <template x-for="feat in (selectedProject?.features || [])">
                            <li class="flex items-center gap-2">
                                <span class="material-symbols-outlined text-[16px] text-emerald-500 shrink-0">check_circle</span>
                                <span x-text="feat"></span>
                            </li>
                        </template>
                    </ul>
                </div>

            </div>

            <!-- Modal Footer -->
            <div class="p-4 sm:p-5 border-t border-slate-100 bg-slate-50 flex items-center justify-between gap-3">
                <button type="button" 
                        @click="closeModal()" 
                        class="px-5 py-2.5 rounded-full border border-slate-200 text-slate-600 font-semibold text-xs hover:bg-slate-100 transition-colors cursor-pointer">
                    Đóng
                </button>
                <div class="flex items-center gap-2">
                    <a href="{{ route('contact') }}?service=media" 
                       class="px-6 py-2.5 rounded-full bg-[#ff5400] text-white font-bold text-xs shadow-md shadow-orange-500/25 hover:bg-orange-600 transition-colors flex items-center gap-1.5">
                        <span class="material-symbols-outlined text-[16px]">forum</span>
                        <span>Yêu cầu báo giá Media</span>
                    </a>
                </div>
            </div>

        </div>
    </div>

</div>
@endsection
