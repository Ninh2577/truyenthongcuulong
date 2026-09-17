import re

with open("resources/views/profile.blade.php", "r", encoding="utf-8") as f:
    content = f.read()

# 1. Fix Z-index of aside dot nav
content = content.replace(
    '<aside aria-label="Điều hướng nhanh hồ sơ năng lực" class="fixed right-6 top-1/2 -translate-y-1/2 z-40 hidden lg:flex',
    '<aside aria-label="Điều hướng nhanh hồ sơ năng lực" class="fixed right-6 top-1/2 -translate-y-1/2 z-[60] hidden lg:flex'
)

# 2. Fix Hero Padding (Issue 3: FAB overlap)
content = content.replace(
    '<section class="relative w-full min-h-[92vh] flex flex-col justify-between overflow-hidden bg-on-surface text-surface-container-lowest -mt-20 pt-28 pb-10" id="hero">',
    '<section class="relative w-full min-h-[92vh] flex flex-col justify-between overflow-hidden bg-on-surface text-surface-container-lowest -mt-20 pt-28 pb-32 md:pb-36" id="hero">'
)

# 3. Replace Hero Stats (Issue 1)
stats_old = """                    <div class="flex flex-col items-center text-center p-2">
                        <span class="font-headline-lg text-headline-md md:text-headline-lg text-primary-fixed">100+</span>
                        <span class="font-body-sm text-body-sm text-surface-variant">Khách Hàng Doanh Nghiệp</span>
                    </div>
                    <div class="flex flex-col items-center text-center p-2">
                        <span class="font-headline-lg text-headline-md md:text-headline-lg text-primary-fixed">99.8%</span>
                        <span class="font-body-sm text-body-sm text-surface-variant">SLA Vận Hành Hệ Thống</span>
                    </div>
                    <div class="flex flex-col items-center text-center p-2">
                        <span class="font-headline-lg text-headline-md md:text-headline-lg text-primary-fixed">250+</span>
                        <span class="font-body-sm text-body-sm text-surface-variant">Dự Án Media &amp; TVC 4K</span>
                    </div>
                    <div class="flex flex-col items-center text-center p-2">
                        <span class="font-headline-lg text-headline-md md:text-headline-lg text-primary-fixed">1.2M+</span>
                        <span class="font-body-sm text-body-sm text-surface-variant">Độc Giả Đa Kênh CLM</span>
                    </div>"""

stats_new = """                    <div class="flex flex-col items-center text-center p-2 gap-1.5">
                        <span class="material-symbols-outlined text-[32px] md:text-[36px] text-primary-fixed">handshake</span>
                        <span class="font-body-sm text-body-sm text-surface-variant font-medium">Đối Tác Tin Cậy Đa Ngành</span>
                    </div>
                    <div class="flex flex-col items-center text-center p-2 gap-1.5">
                        <span class="material-symbols-outlined text-[32px] md:text-[36px] text-primary-fixed">security</span>
                        <span class="font-body-sm text-body-sm text-surface-variant font-medium">Vận Hành Hệ Thống 24/7</span>
                    </div>
                    <div class="flex flex-col items-center text-center p-2 gap-1.5">
                        <span class="font-headline-lg text-headline-md md:text-headline-lg text-primary-fixed">850+</span>
                        <span class="font-body-sm text-body-sm text-surface-variant font-medium">Dự Án Đã Hoàn Thiện</span>
                    </div>
                    <div class="flex flex-col items-center text-center p-2 gap-1.5">
                        <span class="material-symbols-outlined text-[32px] md:text-[36px] text-primary-fixed">hub</span>
                        <span class="font-body-sm text-body-sm text-surface-variant font-medium">Sản Xuất Media Đa Điểm</span>
                    </div>"""
content = content.replace(stats_old, stats_new)

# 4. Fix Studio Hub Image (Issue 2)
content = content.replace(
    '<img alt="Không gian phòng làm việc Truyền Thông Cửu Long" class="w-full h-64 md:h-72 object-cover transition-transform duration-500 group-hover:scale-105" src="{{ asset(\'images/showreel-cinematic-poster.jpg\') }}"/>',
    '<img alt="Không gian phòng làm việc Truyền Thông Cửu Long" class="w-full h-64 md:h-72 object-cover transition-transform duration-500 group-hover:scale-105" src="{{ asset(\'images/color-grade-master-after.webp\') }}"/>'
)

# 5. Fix Badge overlap in projects (Issue 5)
# We will replace `font-label-sm text-label-sm backdrop-blur-sm` with `text-[10px] sm:text-xs font-medium uppercase tracking-wide whitespace-nowrap backdrop-blur-sm`
# The class occurs exactly in those span tags.
content = content.replace(
    'font-label-sm text-label-sm backdrop-blur-sm',
    'text-[10px] sm:text-[11px] font-medium uppercase tracking-wider whitespace-nowrap backdrop-blur-sm'
)

with open("resources/views/profile.blade.php", "w", encoding="utf-8") as f:
    f.write(content)

print("Applied 5 fixes successfully.")
