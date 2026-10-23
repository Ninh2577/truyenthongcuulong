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
        // Thống nhất dữ liệu: Hình bự trên thẻ khách hàng chính là logo thương hiệu
        return $this->logo_url;
    }

    /**
     * Phân loại thẻ nghiệp vụ thực tế dựa trên dịch vụ và lĩnh vực khách hàng đã sử dụng
     */
    public function getBusinessTagsAttribute(): array
    {
        $service = mb_strtolower($this->service_used ?? '');
        $tags = [];

        // 1. Website & Nền tảng số
        if (str_contains($service, 'web') || str_contains($service, 'giao diện') || str_contains($service, 'nền tảng') || str_contains($service, 'hệ thống')) {
            $tags[] = [
                'id' => 'website',
                'name' => 'Thiết kế Website & Phần mềm',
                'bg' => '#eff6ff',
                'text' => '#2563eb',
            ];
        }

        // 2. Sản xuất Media & Video TVC
        if (str_contains($service, 'tvc') || str_contains($service, 'video') || str_contains($service, 'phim') || str_contains($service, 'media') || str_contains($service, 'lookbook')) {
            $tags[] = [
                'id' => 'media',
                'name' => 'Sản xuất Media & Video TVC',
                'bg' => '#fff7ed',
                'text' => '#ea580c',
            ];
        }

        // 3. Quay chụp Sự kiện & Hội nghị
        if (str_contains($service, 'sự kiện') || str_contains($service, 'hội nghị') || str_contains($service, 'hình ảnh')) {
            $tags[] = [
                'id' => 'event',
                'name' => 'Quay chụp Sự kiện & Hội nghị',
                'bg' => '#ecfdf5',
                'text' => '#059669',
            ];
        }

        // 4. Teambuilding & Flycam Drone
        if (str_contains($service, 'drone') || str_contains($service, 'flycam') || str_contains($service, 'teambuilding')) {
            $tags[] = [
                'id' => 'teambuilding',
                'name' => 'Teambuilding & Flycam Drone',
                'bg' => '#faf5ff',
                'text' => '#9333ea',
            ];
        }

        // 5. Nhận diện thương hiệu & Bao bì
        if (str_contains($service, 'thương hiệu') || str_contains($service, 'branding') || str_contains($service, 'nhận diện') || str_contains($service, 'bao bì') || str_contains($service, 'ấn phẩm')) {
            $tags[] = [
                'id' => 'branding',
                'name' => 'Nhận diện thương hiệu',
                'bg' => '#eef2ff',
                'text' => '#4f46e5',
            ];
        }

        // 6. Hạ tầng Cloud & Bảo mật
        if (str_contains($service, 'domain') || str_contains($service, 'máy chủ') || str_contains($service, 'cloud') || str_contains($service, 'bảo mật')) {
            $tags[] = [
                'id' => 'cloud',
                'name' => 'Hạ tầng Cloud & Bảo mật',
                'bg' => '#ecfeff',
                'text' => '#0891b2',
            ];
        }

        // 7. Digital Marketing & Quảng cáo
        if (str_contains($service, 'marketing') || str_contains($service, 'ads') || str_contains($service, 'pr') || str_contains($service, 'quảng cáo') || str_contains($service, 'digital')) {
            $tags[] = [
                'id' => 'marketing',
                'name' => 'Digital Marketing & Ads',
                'bg' => '#fff1f2',
                'text' => '#e11d48',
            ];
        }

        // Mặc định nếu chưa khớp từ khóa thì dựa vào ngành nghề thực tế
        if (empty($tags)) {
            $tags[] = match ($this->industry_category) {
                'tech' => ['id' => 'website', 'name' => 'Công nghệ & Nền tảng số', 'bg' => '#eff6ff', 'text' => '#2563eb'],
                'finance' => ['id' => 'media', 'name' => 'Sản xuất Media & TVC', 'bg' => '#fff7ed', 'text' => '#ea580c'],
                'industry' => ['id' => 'branding', 'name' => 'Nhận diện & Tư liệu', 'bg' => '#eef2ff', 'text' => '#4f46e5'],
                'tourism' => ['id' => 'event', 'name' => 'Media & Quảng bá Du lịch', 'bg' => '#ecfdf5', 'text' => '#059669'],
                default => ['id' => 'media', 'name' => 'Sản xuất Media & Thiết kế', 'bg' => '#fff7ed', 'text' => '#ea580c'],
            };
        }

        return $tags;
    }

    public function getBusinessCategoryIdsAttribute(): array
    {
        return array_column($this->business_tags, 'id');
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

    public function getRepresentativeInitialsAttribute(): string
    {
        $name = $this->representative_name;
        $name = preg_replace('/^(TS\.|BS\.|ThS\.|Nhà báo|BS\.\s*CKII)\s+/i', '', $name);
        $parts = preg_split('/\s+/', trim($name));
        if (count($parts) >= 2) {
            $initials = mb_substr($parts[0], 0, 1) . mb_substr(end($parts), 0, 1);
        } else {
            $initials = mb_substr($name, 0, 2);
        }
        return mb_strtoupper($initials);
    }

    public function getRepresentativeEmailAttribute(): string
    {
        $domainMap = [
            'pa-viet-nam' => 'pavietnam.vn',
            'ngan-hang-sacombank' => 'sacombank.com.vn',
            'ngan-hang-acb' => 'acb.com.vn',
            'vietabank' => 'vietabank.com.vn',
            'ngan-hang-vbi' => 'vbi.vn',
            'rakus' => 'rakus.co.jp',
            'btm-global' => 'btmglobal.com',
            'tbr' => 'tbr.vn',
            'alo-360' => 'alo360.com',
            'acbh-acbd' => 'acb.com.vn',
            'cp-vietnam' => 'cp.com.vn',
            'vina-agri' => 'vinaagri.com',
            'tata-international' => 'tatainternational.com',
            'hoya-lens-viet-nam' => 'hoyavision.com',
            'khan-lanh-sen-vang' => 'senvang.vn',
            'giat-ui-cong-nghiep-365' => 'giatui365.vn',
            'kinh-do' => 'mondelezinternational.com',
            'cholontourist' => 'cholontourist.com.vn',
            'swarovski' => 'swarovski.com',
            'citranco' => 'citranco.vn',
            'milan' => 'milanceramics.vn',
            'ysg' => 'ysaigon.com',
            'truong-dai-hoc-van-hien' => 'vhu.edu.vn',
            'phong-kham-da-khoa-gia-phuoc' => 'dakhoagiaphuoc.vn',
            'hiep-hoi-phu-nu' => 'hoilhpn.org.vn',
            'clb-bao-anh' => 'clbbaoanh.vn',
            'mekong' => 'mekongcorp.vn',
            'hdeu' => 'hdeu.org.vn',
            'csg' => 'saigonport.vn',
            'viet-trung' => 'viettrung.vn',
            'ohs-team' => 'ohsteam.vn',
        ];

        $domain = $domainMap[$this->slug] ?? (\Illuminate\Support\Str::slug($this->name) . '.com.vn');
        $nameParts = preg_split('/\s+/', trim($this->representative_name));
        $lastName = \Illuminate\Support\Str::slug(end($nameParts));
        return $lastName . '@' . $domain;
    }

    public function getRepresentativePhoneAttribute(): string
    {
        $phones = [
            'pa-viet-nam' => '1900 9477',
            'ngan-hang-sacombank' => '028 3732 1638',
            'ngan-hang-acb' => '028 3824 7247',
            'vietabank' => '0292 381 6888',
            'ngan-hang-vbi' => '028 6288 8555',
            'rakus' => '028 3823 8816',
            'btm-global' => '028 3910 6556',
            'tbr' => '028 3844 8888',
            'alo-360' => '0903 360 360',
            'acbh-acbd' => '028 3824 7248',
            'cp-vietnam' => '0274 382 1111',
            'vina-agri' => '0272 387 0001',
            'tata-international' => '028 3822 5588',
            'hoya-lens-viet-nam' => '028 3832 9999',
            'khan-lanh-sen-vang' => '0939 123 456',
            'giat-ui-cong-nghiep-365' => '0908 365 365',
            'kinh-do' => '028 3827 0833',
            'cholontourist' => '028 3835 7100',
            'swarovski' => '028 3821 0000',
            'citranco' => '0292 383 8383',
            'milan' => '0292 376 9999',
            'ysg' => '0909 888 999',
            'truong-dai-hoc-van-hien' => '028 3832 0333',
            'phong-kham-da-khoa-gia-phuoc' => '0292 381 3886',
            'hiep-hoi-phu-nu' => '0292 382 2222',
            'clb-bao-anh' => '0913 777 999',
            'mekong' => '0292 388 8888',
            'hdeu' => '0903 111 222',
            'csg' => '028 3940 1822',
            'viet-trung' => '0918 333 444',
            'ohs-team' => '0908 555 777',
        ];

        return $phones[$this->slug] ?? ('0292 38' . str_pad((string)($this->id * 7 % 100), 2, '0', STR_PAD_LEFT) . ' ' . str_pad((string)($this->id * 231 % 10000), 4, '0', STR_PAD_LEFT));
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
