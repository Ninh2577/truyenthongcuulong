<?php

namespace App\Providers\Filament;

use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Pages;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Widgets;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('admin')
            ->path('cuulongteam')
            ->login(\App\Filament\Pages\Auth\CustomLogin::class)
            ->brandName('Truyền Thông Cửu Long')
            ->colors([
                'primary' => \Filament\Support\Colors\Color::hex('#FF5400'),
                'warning' => \Filament\Support\Colors\Color::hex('#F59E0B'),
                'success' => \Filament\Support\Colors\Color::hex('#16A34A'),
                'danger' => \Filament\Support\Colors\Color::hex('#DC2626'),
                'info' => \Filament\Support\Colors\Color::hex('#2563EB'),
                'gray' => \Filament\Support\Colors\Color::Slate,
            ])
            ->font('Inter')
            ->brandLogo(fn () => view('filament.logo'))
            ->brandLogoHeight('2.6rem')
            ->favicon(asset('images/logo-ttcl.png'))
            ->sidebarCollapsibleOnDesktop()
            ->sidebarWidth('305px')
            ->collapsedSidebarWidth('76px')
            ->globalSearchKeyBindings(['command+k', 'ctrl+k'])
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->navigationGroups([
                'TỔNG QUAN',
                'NỘI DUNG & TIN TỨC',
                'DỊCH VỤ & KHÁCH HÀNG',
                'TUYỂN DỤNG & NHÂN SỰ',
                'Chat & CSKH',
                'CẤU HÌNH & HỆ THỐNG',
            ])
            ->renderHook(
                'panels::head.end',
                fn () => new \Illuminate\Support\HtmlString('
                    <script src="' . asset('vendor/tinymce/tinymce.min.js') . '"></script>
                    <script src="' . asset('vendor/tinymce/langs/vi.js') . '"></script>
                    <script src="' . asset('vendor/tinymce/tinymce-custom.js') . '?v=' . (@filemtime(public_path('vendor/tinymce/tinymce-custom.js')) ?: '1.1') . '"></script>
                    <script>
                        if (typeof tinymce !== "undefined") {
                            tinymce.baseURL = "' . asset('vendor/tinymce') . '";
                        }
                    </script>
                    <style>
                        /* Hide TinyMCE API key warning banner */
                        .tox-notifications-container,
                        .tox-notification,
                        .tox-notification--warning {
                            display: none !important;
                        }

                        /* ==========================================================================
                           CỬU LONG MEDIA — ENTERPRISE ADMIN SHELL DESIGN SYSTEM (PHASE 03.2)
                           ========================================================================== */
                        :root {
                            --cl-brand: #FF5400;
                            --cl-brand-hover: #E94A00;
                            --cl-brand-soft: rgba(255, 84, 0, 0.08);
                            --cl-brand-soft-dark: rgba(255, 84, 0, 0.16);
                        }

                        /* 1. Global Shell Polish */
                        body {
                            letter-spacing: -0.01em;
                        }

                        /* 2. Sidebar Container & Layout */
                        .fi-sidebar {
                            border-right: 1px solid #E2E8F0 !important;
                        }
                        .dark .fi-sidebar {
                            border-right-color: #1E293B !important;
                            background-color: #0B0F19 !important;
                        }
                        .fi-sidebar-header {
                            min-height: 4.25rem !important;
                            height: 4.25rem !important;
                            padding-left: 1rem !important;
                            padding-right: 0.75rem !important;
                            padding-top: 0.5rem !important;
                            padding-bottom: 0.5rem !important;
                            display: flex !important;
                            align-items: center !important;
                            justify-content: space-between !important;
                            gap: 0.5rem !important;
                            box-sizing: border-box !important;
                            position: relative !important;
                        }
                        .fi-sidebar-header > div:first-child {
                            flex: 1 1 auto !important;
                            min-width: 0 !important;
                            overflow: hidden !important;
                        }
                        .fi-sidebar-header .fi-logo {
                            height: auto !important;
                            max-height: none !important;
                            max-width: 100% !important;
                            display: flex !important;
                            align-items: center !important;
                            overflow: hidden !important;
                            text-decoration: none !important;
                        }
                        .fi-sidebar-header button.ms-auto,
                        .fi-sidebar-header .fi-icon-btn {
                            margin-left: auto !important;
                            flex-shrink: 0 !important;
                            width: 2rem !important;
                            height: 2rem !important;
                            border-radius: 8px !important;
                            display: inline-flex !important;
                            align-items: center !important;
                            justify-content: center !important;
                            position: relative !important;
                            z-index: 10 !important;
                            color: #64748B !important;
                            transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1) !important;
                        }
                        .fi-sidebar-header button.ms-auto:hover,
                        .fi-sidebar-header .fi-icon-btn:hover {
                            background-color: rgba(241, 245, 249, 1) !important;
                            color: #FF5400 !important;
                        }
                        .dark .fi-sidebar-header button.ms-auto:hover,
                        .dark .fi-sidebar-header .fi-icon-btn:hover {
                            background-color: rgba(30, 41, 59, 0.8) !important;
                            color: #FF5400 !important;
                        }

                        /* 3. Navigation Group Headings */
                        .fi-sidebar-group-label {
                            font-size: 11px !important;
                            font-weight: 700 !important;
                            letter-spacing: 0.06em !important;
                            text-transform: uppercase !important;
                            color: #94A3B8 !important;
                            padding-top: 0.5rem !important;
                            padding-bottom: 0.25rem !important;
                        }
                        .dark .fi-sidebar-group-label {
                            color: #64748B !important;
                        }

                        /* 4. Navigation Items & Active States */
                        .fi-sidebar-item {
                            margin: 1.5px 0 !important;
                        }
                        .fi-sidebar-item > a,
                        .fi-sidebar-item > button {
                            border-radius: 10px !important;
                            padding: 7px 12px !important;
                            font-size: 13.5px !important;
                            font-weight: 500 !important;
                            transition: all 160ms cubic-bezier(0.4, 0, 0.2, 1) !important;
                        }
                        .fi-sidebar-item:hover > a,
                        .fi-sidebar-item:hover > button {
                            background-color: rgba(241, 245, 249, 0.8) !important;
                            color: #0F172A !important;
                        }
                        .dark .fi-sidebar-item:hover > a,
                        .dark .fi-sidebar-item:hover > button {
                            background-color: rgba(30, 41, 59, 0.6) !important;
                            color: #F8FAFC !important;
                        }
                        .fi-sidebar-item-active > a,
                        .fi-sidebar-item-active > button {
                            background-color: rgba(255, 84, 0, 0.08) !important;
                            color: #FF5400 !important;
                            font-weight: 600 !important;
                            box-shadow: inset 3px 0 0 0 #FF5400 !important;
                        }
                        .fi-sidebar-item-active .fi-sidebar-item-icon {
                            color: #FF5400 !important;
                        }
                        .dark .fi-sidebar-item-active > a,
                        .dark .fi-sidebar-item-active > button {
                            background-color: rgba(255, 84, 0, 0.16) !important;
                            color: #FF5400 !important;
                            box-shadow: inset 3px 0 0 0 #FF5400 !important;
                        }

                        /* 5. Topbar Header */
                        .fi-topbar {
                            backdrop-filter: blur(12px) !important;
                            -webkit-backdrop-filter: blur(12px) !important;
                            border-bottom: 1px solid #E2E8F0 !important;
                            height: 3.75rem !important;
                        }
                        .dark .fi-topbar {
                            border-bottom-color: #1E293B !important;
                            background-color: rgba(11, 15, 25, 0.85) !important;
                        }
                        .fi-dropdown-panel {
                            z-index: 9999 !important;
                        }

                        /* Schema JSON-LD IDE Editor - Professional Terminal Styling */
                        .cl-schema-ide, .cl-ide-editor-container {
                            border-radius: 14px !important;
                        }
                        .cl-schema-textarea:focus, .cl-schema-textarea:focus-visible,
                        .cl-ide-editor-container textarea:focus, .cl-ide-editor-container textarea:focus-visible {
                            outline: none !important;
                            border: none !important;
                            box-shadow: none !important;
                        }

                        /* 6. Breadcrumbs */
                        .fi-breadcrumbs {
                            font-size: 12.5px !important;
                            font-weight: 500 !important;
                        }
                        .fi-breadcrumbs-item-label {
                            color: #64748B !important;
                        }
                        .dark .fi-breadcrumbs-item-label {
                            color: #94A3B8 !important;
                        }

                        /* 7. Search Bar */
                        .fi-global-search-field input {
                            border-radius: 10px !important;
                            border: 1px solid #E2E8F0 !important;
                            font-size: 13px !important;
                            background-color: rgba(248, 250, 252, 0.9) !important;
                            transition: all 150ms ease !important;
                        }
                        .dark .fi-global-search-field input {
                            border-color: #1E293B !important;
                            background-color: rgba(19, 27, 46, 0.7) !important;
                            color: #F8FAFC !important;
                        }
                        .fi-global-search-field input:focus {
                            border-color: #FF5400 !important;
                            box-shadow: 0 0 0 3px rgba(255, 84, 0, 0.15) !important;
                        }

                        /* 8. Accessibility Focus States */
                        a:focus-visible, button:focus-visible, input:focus-visible, select:focus-visible, textarea:focus-visible {
                            outline: 2px solid #FF5400 !important;
                            outline-offset: 2px !important;
                        }

                        /* 9. Card and Table Container Polish */
                        .fi-section, .fi-ta-ctn, .fi-wi-card {
                            border-radius: 16px !important;
                            border: 1px solid rgba(226, 232, 240, 0.9) !important;
                            box-shadow: 0 1px 3px 0 rgba(15, 23, 42, 0.03), 0 1px 2px -1px rgba(15, 23, 42, 0.03) !important;
                        }
                        .dark .fi-section, .dark .fi-ta-ctn, .dark .fi-wi-card {
                            border-color: rgba(30, 41, 59, 0.9) !important;
                            background-color: #131B2E !important;
                            box-shadow: none !important;
                        }

                        /* 10. Custom Dashboard Widget Polish & Dark Mode */
                        .cl-custom-card {
                            background-color: #ffffff;
                            border: 1px solid #E2E8F0;
                            border-radius: 16px;
                        }
                        .dark .cl-custom-card {
                            background-color: #131B2E !important;
                            border-color: #1E293B !important;
                        }
                        .cl-title {
                            color: #0F172A;
                        }
                        .dark .cl-title {
                            color: #F8FAFC !important;
                        }
                        .cl-subtext {
                            color: #64748B;
                        }
                        .dark .cl-subtext {
                            color: #94A3B8 !important;
                        }
                        .cl-action-box {
                            background-color: #FFF1F2;
                            border: 1px solid #FECDD3;
                        }
                        .dark .cl-action-box {
                            background-color: rgba(76, 5, 25, 0.35) !important;
                            border-color: rgba(159, 18, 57, 0.45) !important;
                        }
                        .cl-btn-secondary {
                            background-color: #F1F5F9;
                            color: #334155;
                        }
                        .dark .cl-btn-secondary {
                            background-color: #1E293B !important;
                            color: #E2E8F0 !important;
                        }
                        .dark .cl-btn-secondary:hover {
                            background-color: #334155 !important;
                        }

                        /* 11. Resource Table Design System (Phase 03.3) */
                        .fi-ta-header {
                            padding: 1rem 1.25rem !important;
                        }
                        .fi-ta-header-cell {
                            font-size: 11.5px !important;
                            font-weight: 700 !important;
                            letter-spacing: 0.05em !important;
                            text-transform: uppercase !important;
                            color: #64748B !important;
                            padding-top: 0.85rem !important;
                            padding-bottom: 0.85rem !important;
                        }
                        .dark .fi-ta-header-cell {
                            color: #94A3B8 !important;
                        }
                        .fi-ta-row {
                            transition: background-color 150ms ease !important;
                        }
                        .fi-ta-row:hover {
                            background-color: rgba(248, 250, 252, 0.8) !important;
                        }
                        .dark .fi-ta-row:hover {
                            background-color: rgba(30, 41, 59, 0.45) !important;
                        }
                        .fi-ta-cell {
                            padding-top: 0.85rem !important;
                            padding-bottom: 0.85rem !important;
                            font-size: 13.5px !important;
                        }
                        .fi-ta-image img {
                            border-radius: 8px !important;
                            object-fit: cover !important;
                            box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05) !important;
                        }
                        .fi-ta-empty-state {
                            padding: 3.5rem 1.5rem !important;
                        }
                        .fi-ta-empty-state-heading {
                            font-size: 16px !important;
                            font-weight: 700 !important;
                            color: #0F172A !important;
                        }
                        .dark .fi-ta-empty-state-heading {
                            color: #F8FAFC !important;
                        }
                        .fi-ta-empty-state-description {
                            font-size: 13.5px !important;
                            color: #64748B !important;
                            margin-top: 0.35rem !important;
                        }
                        .dark .fi-ta-empty-state-description {
                            color: #94A3B8 !important;
                        }

                        /* 12. Resource Form & Input Design System */
                        .fi-fo-field-wrp-label {
                            font-size: 13px !important;
                            font-weight: 600 !important;
                            color: #1E293B !important;
                        }
                        .dark .fi-fo-field-wrp-label {
                            color: #E2E8F0 !important;
                        }
                        .fi-fo-field-wrp-helper-text {
                            font-size: 12px !important;
                            color: #64748B !important;
                        }
                        .dark .fi-fo-field-wrp-helper-text {
                            color: #94A3B8 !important;
                        }
                        .fi-input, .fi-select-input {
                            border-radius: 8px !important;
                            font-size: 13.5px !important;
                        }
                        .fi-badge {
                            font-size: 11.5px !important;
                            font-weight: 600 !important;
                            border-radius: 9999px !important;
                            padding: 2px 8px !important;
                        }

                        /* 13. Sticky Post Edit Sidebar */
                        @media (min-width: 1024px) {
                            html, body, .fi-layout, .fi-main-ctn, .fi-main, .fi-page, form.fi-form, .fi-fo-component-ctn {
                                overflow-x: visible !important;
                            }
                            div:has(> .post-sidebar-sticky),
                            .post-sidebar-sticky-parent {
                                position: -webkit-sticky !important;
                                position: sticky !important;
                                top: 5rem !important;
                                align-self: flex-start !important;
                                z-index: 20 !important;
                            }
                            .post-sidebar-sticky {
                                position: -webkit-sticky !important;
                                position: sticky !important;
                                top: 5rem !important;
                                align-self: flex-start !important;
                                z-index: 20 !important;
                                max-height: calc(100vh - 6rem) !important;
                                overflow-y: auto !important;
                                overflow-x: visible !important;
                                padding-right: 4px !important;
                            }
                            .post-sidebar-sticky::-webkit-scrollbar {
                                width: 5px;
                            }
                            .post-sidebar-sticky::-webkit-scrollbar-track {
                                background: transparent;
                            }
                            .post-sidebar-sticky::-webkit-scrollbar-thumb {
                                background: rgba(148, 163, 184, 0.4);
                                border-radius: 9999px;
                            }
                            .post-sidebar-sticky::-webkit-scrollbar-thumb:hover {
                                background: #FF5400;
                            }
                        }
                    </style>
                    <script>
                        (function () {
                            function ensureStickyPostSidebar() {
                                var stickyEl = document.querySelector(".post-sidebar-sticky");
                                if (!stickyEl) return;

                                if (stickyEl.parentElement) {
                                    stickyEl.parentElement.classList.add("post-sidebar-sticky-parent");
                                    stickyEl.parentElement.style.position = "-webkit-sticky";
                                    stickyEl.parentElement.style.position = "sticky";
                                    stickyEl.parentElement.style.top = "5rem";
                                    stickyEl.parentElement.style.alignSelf = "flex-start";
                                    stickyEl.parentElement.style.zIndex = "20";
                                }

                                var parent = stickyEl.parentElement;
                                while (parent && parent !== document.body && parent !== document.documentElement) {
                                    var style = window.getComputedStyle(parent);
                                    if (style.overflowX === "clip" || style.overflowX === "hidden") {
                                        parent.style.overflowX = "visible";
                                    }
                                    if (parent.classList.contains("fi-layout")) {
                                        parent.style.overflowX = "visible";
                                    }
                                    parent = parent.parentElement;
                                }
                            }
                            document.addEventListener("DOMContentLoaded", ensureStickyPostSidebar);
                            document.addEventListener("livewire:navigated", ensureStickyPostSidebar);
                            document.addEventListener("livewire:init", ensureStickyPostSidebar);
                            window.addEventListener("load", ensureStickyPostSidebar);
                            setInterval(ensureStickyPostSidebar, 500);
                        })();
                    </script>
                ')
            )
            ->pages([
                \App\Filament\Pages\Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
            ->widgets([
                // Default widgets removed for a cleaner dashboard
            ])
            ->renderHook(
                'panels::body.end',
                fn () => view('filament.components.global-chat-notification')
            )
            ->renderHook(
                'panels::body.end',
                fn () => view('filament.components.elegant-confirm-modal')
            )
            ->userMenuItems([
                \Filament\Navigation\MenuItem::make()
                    ->label(fn () => auth()->user()?->hasEnabledTwoFactorAuthentication() ? 'Bảo mật 2FA (Đang bật)' : 'Kích hoạt bảo mật 2FA')
                    ->icon('heroicon-o-shield-check')
                    ->color(fn () => auth()->user()?->hasEnabledTwoFactorAuthentication() ? 'success' : 'warning')
                    ->url(fn (): string => filament()->getCurrentPanel()->route('two-factor.setup'))
                    ->visible(fn (): bool => (bool) (auth()->user()?->hasAnyRole(['super_admin', 'Admin']) || auth()->user()?->email === 'admin@truyenthongcuulong.com')),
            ])
            ->plugins([
                \Stephenjude\FilamentTwoFactorAuthentication\TwoFactorAuthenticationPlugin::make()
                    ->addTwoFactorMenuItem(false)
                    ->enableTwoFactorAuthentication(condition: true, challengeMiddleware: \App\Http\Middleware\TwoFactorChallenge::class),
                \BezhanSalleh\FilamentShield\FilamentShieldPlugin::make(),
            ])
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->authMiddleware([
                Authenticate::class,
            ]);
    }
}





