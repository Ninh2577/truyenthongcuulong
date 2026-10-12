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
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    protected static function booted(): void
    {
        static::saved(function () {
            \Illuminate\Support\Facades\Cache::forget('clients.all');
        });

        static::deleted(function () {
            \Illuminate\Support\Facades\Cache::forget('clients.all');
        });
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('order', 'asc');
    }

    public function getLogoUrlAttribute(): string
    {
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
        // Specific project images if present
        if ($this->slug === 'ngan-hang-sacombank' || $this->slug === 'sacombank') {
            return asset('images/projects/sacombank-media-thumb.jpg');
        }
        if ($this->slug === 'hoya-lens-viet-nam' || $this->slug === 'hoya-lens') {
            return asset('images/projects/hoyalens-media-thumb.jpg');
        }
        if ($this->slug === 'phong-kham-da-khoa-gia-phuoc' || $this->slug === 'phong-kham-gia-phuoc') {
            return asset('images/projects/clinic-app-mockup.jpg');
        }
        if ($this->slug === 'truong-dai-hoc-van-hien' || $this->slug === 'dai-hoc-can-tho') {
            return asset('images/projects/web_thptnguyenvancu.jpg');
        }
        if ($this->slug === 'cholontourist' || $this->slug === 'citranco') {
            return asset('images/projects/web_cuulongcamping.jpg');
        }
        if ($this->slug === 'vina-agri' || $this->slug === 'cp-vietnam') {
            return asset('images/projects/web_nongsanmekong.jpg');
        }

        return match ($this->industry_label) {
            'Tài chính & Ngân hàng' => asset('images/banner1_clean.png'),
            'Công nghệ & Phần mềm' => asset('images/modern_tech_platform.jpg'),
            'Nông nghiệp & Sản xuất' => asset('images/projects/web_nongsanmekong.jpg'),
            'Du lịch & Dịch vụ' => asset('images/projects/web_cuulongcamping.jpg'),
            'Y tế, Giáo dục & Xã hội' => asset('images/projects/clinic-website-wp.jpg'),
            default => asset('images/projects/banner_du_an_media.png'),
        };
    }

    public function getRepresentativeNameAttribute(): string
    {
        $representatives = [
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
            'phong-kham-da-khoa-gia-phuoc' => 'BS. CKII Lê Văn Phước',
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
        $roles = [
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
}
