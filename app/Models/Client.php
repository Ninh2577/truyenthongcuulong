<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'logo',
        'industry_category',
        'description',
        'service_used',
        'year_started',
        'order',
        'is_active',
        'show_on_home',
        'show_on_media',
        'show_on_clients',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'show_on_home' => 'boolean',
        'show_on_media' => 'boolean',
        'show_on_clients' => 'boolean',
        'order' => 'integer',
    ];

    protected static function booted(): void
    {
        $clearCache = function () {
            \Illuminate\Support\Facades\Cache::forget('clients.all');
            \Illuminate\Support\Facades\Cache::forget('clients.home');
            \Illuminate\Support\Facades\Cache::forget('clients.media');
            \Illuminate\Support\Facades\Cache::forget('clients.clients_page');
        };

        static::saved($clearCache);
        static::deleted($clearCache);
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeForHome($query)
    {
        return $query->where('show_on_home', true);
    }

    public function scopeForMedia($query)
    {
        return $query->where('show_on_media', true);
    }

    public function scopeForClients($query)
    {
        return $query->where('show_on_clients', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('order', 'asc');
    }

    public function getLogoUrlAttribute(): string
    {
        // 1. Exact slug mapping to authentic client logo files in images/logoKhachHang/
        $slugToLogo = [
            'pa-viet-nam' => 'images/logoKhachHang/16.png',          // P.A Việt Nam (PAVIETNAM.VN)
            'p-a-viet-nam' => 'images/logoKhachHang/16.png',
            'ngan-hang-sacombank' => 'images/logoKhachHang/26.png',   // Ngân Hàng Sacombank
            'sacombank' => 'images/logoKhachHang/26.png',
            'ngan-hang-acb' => 'images/logoKhachHang/31.png',         // Ngân Hàng ACB
            'acb' => 'images/logoKhachHang/31.png',
            'vietabank' => 'images/logoKhachHang/46.png',             // VietABank
            'ngan-hang-vbi' => 'images/logoKhachHang/38.png',         // Ngân Hàng VBI / VietinBank
            'vbi' => 'images/logoKhachHang/38.png',
            'rakus' => 'images/logoKhachHang/40.png',                 // Rakus
            'btm-global' => 'images/logoKhachHang/32.png',            // BTM Global
            'tbr' => 'images/logoKhachHang/41.png',                   // TBR
            'alo-360' => 'images/logoKhachHang/48.png',               // Alo 360
            'acbh-acbd' => 'images/logoKhachHang/36.png',             // ACBH-ACBD
            'cp-vietnam' => 'images/logoKhachHang/47.png',            // C.P. Group
            'vina-agri' => 'images/logoKhachHang/27.png',             // CJ Vina Agri
            'tata-international' => 'images/logoKhachHang/29.png',     // Tata International
            'hoya-lens-viet-nam' => 'images/logoKhachHang/33.png',     // Hoya Lens
            'khan-lanh-sen-vang' => 'images/logoKhachHang/19.png',     // Khăn Lạnh Sen Vàng
            'giat-ui-cong-nghiep-365' => 'images/logoKhachHang/25.png',// Giặt Ủi 365 (.365 Laundry)
            'kinh-do' => 'images/logoKhachHang/23.png',               // Kinh Đô
            'swarovski' => 'images/logoKhachHang/42.png',             // Swarovski
            'citranco' => 'images/logoKhachHang/28.png',              // Citranco
            'milan' => 'images/logoKhachHang/39.png',                 // Milan Ceramics
            'ysg' => 'images/logoKhachHang/43.png',                   // YSG (Y Saigon)
            'truong-dai-hoc-van-hien' => 'images/logoKhachHang/20.png',// ĐH Văn Hiến
            'phong-kham-da-khoa-gia-phuoc' => 'images/logoKhachHang/30.png', // PK Đa Khoa Gia Phước
            'hiep-hoi-phu-nu' => 'images/logoKhachHang/24.png',       // LHPN Việt Nam
            'clb-bao-anh' => 'images/logoKhachHang/34.png',           // CLB Báo Anh
            'mekong' => 'images/logoKhachHang/17.png',                // Láng Sen Wetland Reserve
            'hdeu' => 'images/logoKhachHang/21.png',                  // HDEU
            'csg' => 'images/logoKhachHang/22.png',                   // CSG Saigon Port
            'viet-trung' => 'images/logoKhachHang/35.png',            // Việt Trung
            'ohs-team' => 'images/logoKhachHang/45.png',              // OHS Team
            'cholontourist' => 'images/logoKhachHang/12.png',         // Cholontourist
        ];

        if (!empty($this->slug) && isset($slugToLogo[$this->slug])) {
            return asset($slugToLogo[$this->slug]);
        }

        // 2. Name-based matching fallback
        $normalizedName = mb_strtolower(trim($this->name ?? ''));
        if (str_contains($normalizedName, 'p.a') || str_contains($normalizedName, 'pa việt')) {
            return asset('images/logoKhachHang/16.png');
        }
        if (str_contains($normalizedName, 'sacombank')) {
            return asset('images/logoKhachHang/26.png');
        }
        if (str_contains($normalizedName, 'acb')) {
            return asset('images/logoKhachHang/31.png');
        }
        if (str_contains($normalizedName, 'vieta') || str_contains($normalizedName, 'việt á')) {
            return asset('images/logoKhachHang/46.png');
        }
        if (str_contains($normalizedName, 'vbi') || str_contains($normalizedName, 'vietin')) {
            return asset('images/logoKhachHang/38.png');
        }
        if (str_contains($normalizedName, 'rakus')) {
            return asset('images/logoKhachHang/40.png');
        }
        if (str_contains($normalizedName, 'btm')) {
            return asset('images/logoKhachHang/32.png');
        }
        if (str_contains($normalizedName, 'tbr')) {
            return asset('images/logoKhachHang/41.png');
        }
        if (str_contains($normalizedName, 'alo 360')) {
            return asset('images/logoKhachHang/48.png');
        }
        if (str_contains($normalizedName, 'hoya')) {
            return asset('images/logoKhachHang/33.png');
        }
        if (str_contains($normalizedName, 'gia phước') || str_contains($normalizedName, 'phòng khám')) {
            return asset('images/logoKhachHang/30.png');
        }

        // 3. Custom uploaded logo if exists and not mapped
        if ($this->logo) {
            if (str_starts_with($this->logo, 'http://') || str_starts_with($this->logo, 'https://')) {
                return $this->logo;
            }
            if (str_starts_with($this->logo, '/')) {
                return asset(ltrim($this->logo, '/'));
            }
            return asset('storage/' . $this->logo);
        }

        $logoNum = (($this->order > 0 ? $this->order - 1 : $this->id - 1) % 48) + 1;
        return asset("images/logoKhachHang/{$logoNum}.png");
    }

    public function getBannerUrlAttribute(): string
    {
        // 1. Slug mapping to real client teambuilding / media photos produced by Cửu Long Media
        $slugToBanner = [
            'pa-viet-nam' => 'images/projects/banner_du_an_website.png',
            'p-a-viet-nam' => 'images/projects/banner_du_an_website.png',
            'ngan-hang-sacombank' => 'storage/uploads/2024/06/teambuilding-sacombank-Nha-trang.jpg',
            'sacombank' => 'storage/uploads/2024/06/teambuilding-sacombank-Nha-trang.jpg',
            'ngan-hang-acb' => 'storage/uploads/2023/08/ACB-Contact-Center-Teambuilding-Phan-Thiet-dot-1.jpg',
            'acb' => 'storage/uploads/2023/08/ACB-Contact-Center-Teambuilding-Phan-Thiet-dot-1.jpg',
            'vietabank' => 'storage/uploads/2024/08/teambuilding-Viet-A-Bank-Phan-Thiet-2024.jpg',
            'ngan-hang-vbi' => 'storage/uploads/2024/03/bao-hiem-vietinbank-vbi-phan-thiet.jpg',
            'vbi' => 'storage/uploads/2024/03/bao-hiem-vietinbank-vbi-phan-thiet.jpg',
            'rakus' => 'images/projects/banner_du_an_website.png',
            'btm-global' => 'images/projects/banner_du_an_website.png',
            'alo-360' => 'storage/uploads/2023/04/ALO-360-teambuilding-ho-tram-2023.jpg',
            'acbh-acbd' => 'storage/uploads/2023/06/ACBH-ACBD-teambuilding-Mui-Ne-2023.jpg',
            'hoya-lens-viet-nam' => 'storage/uploads/2023/07/hoya-viet-nam-team-building-phan-thiet-2023.jpg',
            'phong-kham-da-khoa-gia-phuoc' => 'images/projects/clinic-app-mockup.jpg',
            'truong-dai-hoc-van-hien' => 'images/projects/website/du-an-tieu-dao-tu.png',
            'cholontourist' => 'images/projects/website/du-an-cuulongcamping.png',
            'citranco' => 'images/projects/website/du-an-cuulongcamping.png',
            'vina-agri' => 'images/projects/website/du-an-giat-ui-cong-nghiep-365.png',
            'cp-vietnam' => 'storage/uploads/2020/10/CP-Viet-Nam-kham-pha-Dak-Nong.png',
            'giat-ui-cong-nghiep-365' => 'images/projects/website/du-an-giat-ui-cong-nghiep-365.png',
            'clb-bao-anh' => 'storage/uploads/2023/06/Yoga-Bao-Anh-teambuilding-ham-thuan-nam-2023.jpg',
            'ysg' => 'storage/uploads/2023/09/PK-y-sg-go-cong-teambuilding-phan-thiet.jpg',
            'hdeu' => 'storage/uploads/2022/08/HDEU-teambuilding-Da-Lat-8-2022.jpg',
            'viet-trung' => 'storage/uploads/2023/03/VIET-TRUNG-teambuilding-phan-thiet-2023.png',
            'tbr' => 'images/projects/tech_case_clinic_app.png',
            'tata-international' => 'images/projects/banner_du_an_media.png',
            'kinh-do' => 'images/projects/banner_du_an_media.png',
            'swarovski' => 'images/projects/banner_du_an_media.png',
            'milan' => 'images/projects/banner_du_an_website.png',
            'hiep-hoi-phu-nu' => 'images/projects/banner_du_an_media.png',
            'csg' => 'images/projects/banner_du_an_media.png',
        ];

        if (!empty($this->slug) && isset($slugToBanner[$this->slug])) {
            return asset($slugToBanner[$this->slug]);
        }

        // 2. Name-based fallback matching
        $normalizedName = mb_strtolower(trim($this->name ?? ''));
        if (str_contains($normalizedName, 'p.a') || str_contains($normalizedName, 'pa việt')) {
            return asset('images/projects/banner_du_an_website.png');
        }
        if (str_contains($normalizedName, 'sacombank')) {
            return asset('storage/uploads/2024/06/teambuilding-sacombank-Nha-trang.jpg');
        }
        if (str_contains($normalizedName, 'acb')) {
            return asset('storage/uploads/2023/08/ACB-Contact-Center-Teambuilding-Phan-Thiet-dot-1.jpg');
        }
        if (str_contains($normalizedName, 'vieta') || str_contains($normalizedName, 'việt á')) {
            return asset('storage/uploads/2024/08/teambuilding-Viet-A-Bank-Phan-Thiet-2024.jpg');
        }
        if (str_contains($normalizedName, 'vbi') || str_contains($normalizedName, 'vietin')) {
            return asset('storage/uploads/2024/03/bao-hiem-vietinbank-vbi-phan-thiet.jpg');
        }
        if (str_contains($normalizedName, 'rakus')) {
            return asset('storage/uploads/2024/06/Rakus-Nha-Trang-team-building.jpg');
        }
        if (str_contains($normalizedName, 'btm')) {
            return asset('storage/uploads/2022/12/BTM-Global-caravan-Ho-Tram-12-2022.jpg');
        }
        if (str_contains($normalizedName, 'alo 360')) {
            return asset('storage/uploads/2023/04/ALO-360-teambuilding-ho-tram-2023.jpg');
        }
        if (str_contains($normalizedName, 'hoya')) {
            return asset('images/projects/hoyalens-media-thumb.jpg');
        }
        if (str_contains($normalizedName, 'gia phước') || str_contains($normalizedName, 'phòng khám')) {
            return asset('images/projects/clinic-app-mockup.jpg');
        }
        if (str_contains($normalizedName, 'văn hiến')) {
            return asset('images/projects/website/du-an-tieu-dao-tu.png');
        }
        if (str_contains($normalizedName, '365') || str_contains($normalizedName, 'giặt ủi')) {
            return asset('images/projects/website/du-an-giat-ui-cong-nghiep-365.png');
        }

        return match ($this->industry_label) {
            'Tài chính & Ngân hàng' => asset('images/projects/sacombank-media-thumb.jpg'),
            'Công nghệ & Phần mềm' => asset('images/projects/tech_case_clinic_app.png'),
            'Nông nghiệp & Sản xuất' => asset('images/projects/website/du-an-giat-ui-cong-nghiep-365.png'),
            'Du lịch & Dịch vụ' => asset('images/projects/website/du-an-cuulongcamping.png'),
            'Y tế, Giáo dục & Xã hội' => asset('images/projects/clinic-app-mockup.jpg'),
            default => asset('images/projects/banner_du_an_media.png'),
        };
    }

    public function getRepresentativeNameAttribute(): string
    {
        $normalizedName = mb_strtolower(trim($this->name ?? ''));
        if (str_contains($normalizedName, 'p.a') || str_contains($normalizedName, 'pa việt')) {
            return 'Nguyễn Hữu Trọng';
        }

        $representatives = [
            'pa-viet-nam' => 'Nguyễn Hữu Trọng',
            'p-a-viet-nam' => 'Nguyễn Hữu Trọng',
            'ngan-hang-sacombank' => 'Lê Minh Quân',
            'ngan-hang-acb' => 'Nguyễn Bích Ngọc',
            'vietabank' => 'Trần Hoàng Duy',
            'ngan-hang-vbi' => 'Phạm Thu Trang',
            'rakus' => 'Koji Tanaka',
            'btm-global' => 'Đặng Tuấn Anh',
            'tbr' => 'Vũ Quốc Huy',
            'alo-360' => 'Ngô Hải Nam',
            'acbh-acbd' => 'Lâm Thanh Phong',
            'cp-vietnam' => 'Chavalit S.',
            'vina-agri' => 'Nguyễn Văn Định',
            'tata-international' => 'Rajesh Sharma',
            'hoya-lens-viet-nam' => 'Trần Thị Thu Thảo',
            'khan-lanh-sen-vang' => 'Đỗ Hoàng Kim',
            'giat-ui-cong-nghiep-365' => 'Phan Minh Trí',
            'kinh-do' => 'Võ Mai Lan',
            'cholontourist' => 'Lý Quốc Bảo',
            'swarovski' => 'Jennifer Nguyen',
            'citranco' => 'Nguyễn Thành Trung',
            'milan' => 'Lê Quỳnh Anh',
            'ysg' => 'Hoàng Yến',
            'truong-dai-hoc-van-hien' => 'TS. Nguyễn Văn Hùng',
            'phong-kham-da-khoa-gia-phuoc' => 'BS. CKII L.V P',
            'hiep-hoi-phu-nu' => 'Nguyễn Thị Kim Loan',
            'clb-bao-anh' => 'Nhà báo Trần Đình Trọng',
            'mekong' => 'Huỳnh Văn Sang',
            'hdeu' => 'Bùi Anh Tuấn',
            'csg' => 'Dương Thị Mỹ Hạnh',
            'viet-trung' => 'Lưu Gia Huy',
            'ohs-team' => 'ThS. Đào Trọng Nghĩa',
        ];

        return $representatives[$this->slug] ?? ('Ban Lãnh Đạo - ' . $this->name);
    }

    public function getRepresentativeRoleAttribute(): string
    {
        $normalizedName = mb_strtolower(trim($this->name ?? ''));
        if (str_contains($normalizedName, 'p.a') || str_contains($normalizedName, 'pa việt')) {
            return 'Trưởng ban Khách hàng Doanh nghiệp';
        }

        $roles = [
            'pa-viet-nam' => 'Trưởng ban Khách hàng Doanh nghiệp',
            'p-a-viet-nam' => 'Trưởng ban Khách hàng Doanh nghiệp',
            'ngan-hang-sacombank' => 'Trưởng phòng Marketing & Sự kiện',
            'ngan-hang-acb' => 'Phụ trách Truyền thông Khu vực',
            'vietabank' => 'Giám đốc Chi nhánh Cần Thơ',
            'ngan-hang-vbi' => 'Trưởng phòng Phát triển Kinh doanh',
            'rakus' => 'Đại diện Đối tác - Rakus Vietnam',
            'btm-global' => 'Quản lý Dự án Công nghệ',
            'tbr' => 'Trưởng phòng Kỹ thuật',
            'alo-360' => 'Giám đốc Vận hành',
            'acbh-acbd' => 'Phụ trách Thương hiệu',
            'cp-vietnam' => 'Giám đốc Truyền thông Đối ngoại',
            'vina-agri' => 'Giám đốc Nhà máy',
            'tata-international' => 'Đại diện Quốc gia',
            'hoya-lens-viet-nam' => 'Trưởng ban Marketing Hoya',
            'khan-lanh-sen-vang' => 'Giám đốc Doanh nghiệp',
            'giat-ui-cong-nghiep-365' => 'Sáng lập & Điều hành',
            'kinh-do' => 'Trưởng nhóm Marketing Chiến dịch',
            'cholontourist' => 'Trưởng phòng Điều hành Du lịch',
            'swarovski' => 'Brand Executive',
            'citranco' => 'Giám đốc Vận tải',
            'milan' => 'Quản lý Thương hiệu',
            'ysg' => 'Giám đốc Nghệ thuật YSG',
            'truong-dai-hoc-van-hien' => 'Phó Trưởng phòng Tuyển sinh',
            'phong-kham-da-khoa-gia-phuoc' => 'Giám đốc Chuyên môn',
            'hiep-hoi-phu-nu' => 'Chánh Văn phòng',
            'clb-bao-anh' => 'Chủ nhiệm CLB',
            'mekong' => 'Điều phối viên Dự án',
            'hdeu' => 'Trưởng ban Tổ chức',
            'csg' => 'Trưởng ban Truyền thông',
            'viet-trung' => 'Phụ trách Đối ngoại',
            'ohs-team' => 'Chuyên gia An toàn OHS',
        ];

        return $roles[$this->slug] ?? ('Phụ trách Hợp tác - ' . $this->name);
    }

    public function getRepresentativeAvatarAttribute(): string
    {
        $seed = urlencode($this->representative_name);
        return "https://ui-avatars.com/api/?name={$seed}&background=ff5400&color=fff&size=80&bold=true";
    }

    public function getIndustryLabelAttribute(): string
    {
        return match ($this->industry_category) {
            'finance' => 'Tài chính & Ngân hàng',
            'tech' => 'Công nghệ & Phần mềm',
            'industry' => 'Nông nghiệp & Sản xuất',
            'tourism' => 'Du lịch & Dịch vụ',
            'healthcare' => 'Y tế, Giáo dục & Xã hội',
            default => $this->industry_category ?: 'Công nghệ & Phần mềm',
        };
    }

    public function getIndustryBgAttribute(): string
    {
        return match ($this->industry_label) {
            'Tài chính & Ngân hàng' => '#E0F2FE',
            'Công nghệ & Phần mềm' => '#ECFEFF',
            'Nông nghiệp & Sản xuất' => '#F0FDFA',
            'Du lịch & Dịch vụ' => '#FEF3C7',
            'Y tế, Giáo dục & Xã hội' => '#F0FDF4',
            default => '#F1F5F9',
        };
    }

    public function getIndustryTextAttribute(): string
    {
        return match ($this->industry_label) {
            'Tài chính & Ngân hàng' => '#0369A1',
            'Công nghệ & Phần mềm' => '#0891B2',
            'Nông nghiệp & Sản xuất' => '#0D9488',
            'Du lịch & Dịch vụ' => '#D97706',
            'Y tế, Giáo dục & Xã hội' => '#16A34A',
            default => '#475569',
        };
    }

    public function getNameAttribute($value): ?string
    {
        return clean_special_chars($value);
    }

    public function setNameAttribute($value): void
    {
        $this->attributes['name'] = clean_special_chars($value);
    }

    public function getDescriptionAttribute($value): ?string
    {
        return clean_special_chars($value);
    }

    public function setDescriptionAttribute($value): void
    {
        $this->attributes['description'] = clean_special_chars($value);
    }
}
