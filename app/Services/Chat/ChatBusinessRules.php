<?php

namespace App\Services\Chat;

/**
 * Single Source of Truth (SSOT) for Cuu Long Media business rules.
 * Governs AI Runtime, Automation Engine, Business Guard, and test fixtures.
 */
class ChatBusinessRules
{
    // BR-01: Trạng thái dịch vụ media
    public const MEDIA_SERVICE_STATUS = 'temporarily_suspended';
    public const MEDIA_SUSPENSION_NOTICE = 'Dịch vụ media hiện đang tạm thời ngưng nhận.';
    public const MEDIA_SUSPENSION_DETAILED_NOTICE = 'Dạ hiện tại Cửu Long Media đang tạm ngưng tiếp nhận các công việc Media (quay phim, chụp ảnh, sản xuất video, flycam) để nâng cấp hệ thống. Quý khách vui lòng liên hệ Hotline/Zalo: 0939 363 262 để được hỗ trợ chi tiết ạ.';

    // BR-02: Giá tham khảo Quay / Camera
    public const CAMERA_REFERENCE_PRICE_MIN = '1.500.000đ';
    public const CAMERA_REFERENCE_PRICE_MAX = '2.000.000đ';
    public const CAMERA_REFERENCE_PRICE_MIN_INT = 1500000;
    public const CAMERA_REFERENCE_PRICE_MAX_INT = 2000000;
    public const CAMERA_UNIT = 'máy';
    public const CAMERA_PRICE_TYPE = 'giá tham khảo';
    public const CAMERA_CANONICAL_PRICE_TEXT = '1.500.000đ – 2.000.000đ/máy';

    // BR-03: Giá tham khảo Flycam (CANONICAL)
    public const FLYCAM_REFERENCE_PRICE_MIN = '1.000.000đ';
    public const FLYCAM_REFERENCE_PRICE_MAX = '1.500.000đ';
    public const FLYCAM_REFERENCE_PRICE_MIN_INT = 1000000;
    public const FLYCAM_REFERENCE_PRICE_MAX_INT = 1500000;
    public const FLYCAM_UNIT = 'lần';
    public const FLYCAM_PRICE_TYPE = 'giá tham khảo';
    public const FLYCAM_CANONICAL_PRICE_TEXT = '1.000.000đ – 1.500.000đ/lần';

    // Forbidden legacy / incorrect Flycam values to detect and reject
    public const FORBIDDEN_FLYCAM_PRICES = [
        '3.000.000đ',
        '5.000.000đ',
        '3.000.000',
        '5.000.000',
        '3tr',
        '5tr',
        '3.000.000đ – 5.000.000đ/buổi',
        '3.000.000 - 5.000.000',
    ];
    public const FORBIDDEN_FLYCAM_UNITS = [
        '/buổi',
        'buổi',
    ];

    // BR-04: Hotline / Zalo
    public const HOTLINE = '0939 363 262';
    public const ZALO = '0939 363 262';

    // BR-05: Địa chỉ doanh nghiệp
    public const ADDRESS = 'Lầu 5, 57 Hùng Vương, phường Ninh Kiều, TP Cần Thơ';

    // BR-06: Ngôn ngữ & Phong cách
    public const LANGUAGE = 'vi';

    /**
     * Get structured array of all canonical rules for audit or prompt injection.
     */
    public static function all(): array
    {
        return [
            'media_service_status' => self::MEDIA_SERVICE_STATUS,
            'media_suspension_notice' => self::MEDIA_SUSPENSION_NOTICE,
            'flycam' => [
                'price_min' => self::FLYCAM_REFERENCE_PRICE_MIN,
                'price_max' => self::FLYCAM_REFERENCE_PRICE_MAX,
                'unit' => self::FLYCAM_UNIT,
                'price_type' => self::FLYCAM_PRICE_TYPE,
                'canonical_text' => self::FLYCAM_CANONICAL_PRICE_TEXT,
            ],
            'camera' => [
                'price_min' => self::CAMERA_REFERENCE_PRICE_MIN,
                'price_max' => self::CAMERA_REFERENCE_PRICE_MAX,
                'unit' => self::CAMERA_UNIT,
                'price_type' => self::CAMERA_PRICE_TYPE,
                'canonical_text' => self::CAMERA_CANONICAL_PRICE_TEXT,
            ],
            'hotline' => self::HOTLINE,
            'zalo' => self::ZALO,
            'address' => self::ADDRESS,
        ];
    }
}
