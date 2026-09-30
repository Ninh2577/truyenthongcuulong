<!-- ==================== ECOMMERCE GROCERY SUPERMARKET (FO1 BACOLA FOOD) ==================== -->
<div class="w-full bg-[#f7f8fd] text-slate-800 font-sans" x-data="{
    cartTotal: 185000,
    cartItems: 3,
    activeCategory: 'fruits',
    addToCart(name, price) {
        this.cartItems++;
        this.cartTotal += price;
        alert('Đã thêm \"' + name + '\" vào giỏ hàng thành công!');
    }
}">

    <!-- Top strip -->
    <div class="bg-[#2bbef9] text-slate-950 text-xs py-1.5 px-4 sm:px-8 flex items-center justify-between font-medium">
        <div class="flex items-center gap-2">
            <span>🎉 Giảm ngay 20% cho đơn hàng nông sản tươi sạch đầu tiên với mã: <strong>BACOLA20</strong></span>
        </div>
        <div class="hidden sm:flex items-center gap-4 text-[11px]">
            <span>Giao siêu tốc 1H nội thành</span>
            <span>Hotline: 0939.363.262</span>
        </div>
    </div>

    <!-- Main Header -->
    <header class="bg-white border-b border-slate-200 sticky top-0 z-30 shadow-xs">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-20 flex items-center justify-between gap-4">
            <!-- Brand Logo -->
            <div class="flex items-center gap-2 shrink-0">
                <div class="w-10 h-10 rounded-2xl bg-[#2bbef9] flex items-center justify-center text-white font-black text-xl shadow-xs">
                    🛒
                </div>
                <div class="flex flex-col">
                    <span class="text-2xl font-black text-[#233a95] tracking-tight">bacola</span>
                    <span class="text-[9px] font-bold text-slate-400 uppercase tracking-widest">ONLINE GROCERY SHOPPING</span>
                </div>
            </div>

            <!-- Location dropdown -->
            <div class="hidden xl:flex items-center gap-1.5 px-3 py-1.5 rounded-xl border border-slate-200 text-xs text-slate-600 bg-slate-50">
                <span class="material-symbols-outlined text-[16px] text-[#2bbef9]">location_on</span>
                <span>Giao hàng tại: <strong class="text-slate-900">TP. Cần Thơ</strong></span>
            </div>

            <!-- Search input bar -->
            <div class="hidden md:flex flex-1 max-w-lg mx-2">
                <div class="relative w-full flex items-center">
                    <input type="text" placeholder="Tìm kiếm rau củ sạch, thịt cá tươi, trái cây nhập khẩu..." class="w-full pl-4 pr-12 py-2.5 rounded-xl bg-slate-100 border border-slate-200 text-xs focus:bg-white focus:outline-none focus:border-[#2bbef9]">
                    <button type="button" class="absolute right-1 w-9 h-8 bg-[#2bbef9] text-white flex items-center justify-center rounded-lg">
                        <span class="material-symbols-outlined text-[18px]">search</span>
                    </button>
                </div>
            </div>

            <!-- Cart button -->
            <div class="flex items-center gap-4 shrink-0">
                <div class="flex items-center gap-3">
                    <div class="relative p-2.5 rounded-full bg-rose-50 text-rose-600 cursor-pointer">
                        <span class="material-symbols-outlined text-[22px]">shopping_basket</span>
                        <span class="absolute -top-1 -right-1 w-5 h-5 rounded-full bg-rose-500 text-white text-[10px] font-black flex items-center justify-center" x-text="cartItems"></span>
                    </div>
                    <div class="hidden sm:flex flex-col text-right">
                        <span class="text-[10px] text-slate-400 font-bold uppercase">Giỏ hàng</span>
                        <span class="text-xs font-black text-rose-600 font-mono" x-text="cartTotal.toLocaleString() + ' đ'"></span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Subnav Category Bar -->
        <div class="bg-white border-t border-slate-100 hidden md:block">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-12 flex items-center justify-between text-xs font-bold text-slate-700">
                <div class="flex items-center gap-6">
                    <span class="flex items-center gap-1.5 text-[#233a95] font-black">
                        <span class="material-symbols-outlined text-[18px]">menu</span>
                        <span>TẤT CẢ DANH MỤC</span>
                    </span>
                    <a href="#products" class="hover:text-[#2bbef9]">Rau Củ Hữu Cơ</a>
                    <a href="#products" class="hover:text-[#2bbef9]">Thịt & Hải Sản Tươi</a>
                    <a href="#products" class="hover:text-[#2bbef9]">Trái Cây Nhập Khẩu</a>
                    <a href="#products" class="hover:text-[#2bbef9]">Sữa & Bánh Ngọt</a>
                    <a href="#products" class="hover:text-[#2bbef9]">Đồ Uống & Trà</a>
                </div>
                <div class="text-rose-600 font-bold flex items-center gap-1">
                    <span class="material-symbols-outlined text-[16px]">local_fire_department</span>
                    <span>GIẢM GIÁ ĐẶC BIỆT THÁNG 10</span>
                </div>
            </div>
        </div>
    </header>

    <!-- Supermarket Hero Section (Satek Bacola Mockup) -->
    <section class="py-6 sm:py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">
                <!-- Left Categories Sidebar -->
                <div class="hidden lg:block lg:col-span-3 bg-white p-4 rounded-2xl border border-slate-200 shadow-2xs space-y-2">
                    <span class="text-xs font-black text-slate-400 uppercase tracking-wider block mb-3">NHÓM NÔNG SẢN</span>
                    <a href="#products" class="flex items-center justify-between p-2 rounded-xl hover:bg-slate-50 text-xs font-bold text-slate-700">
                        <span>🍎 Trái cây Đà Lạt & Nhập khẩu</span>
                        <span class="text-slate-400">&gt;</span>
                    </a>
                    <a href="#products" class="flex items-center justify-between p-2 rounded-xl hover:bg-slate-50 text-xs font-bold text-slate-700">
                        <span>🥬 Rau củ chuẩn VietGAP</span>
                        <span class="text-slate-400">&gt;</span>
                    </a>
                    <a href="#products" class="flex items-center justify-between p-2 rounded-xl hover:bg-slate-50 text-xs font-bold text-slate-700">
                        <span>🥩 Thịt bò mát & Heo hữu cơ</span>
                        <span class="text-slate-400">&gt;</span>
                    </a>
                    <a href="#products" class="flex items-center justify-between p-2 rounded-xl hover:bg-slate-50 text-xs font-bold text-slate-700">
                        <span>🐟 Hải sản sống đánh bắt trong ngày</span>
                        <span class="text-slate-400">&gt;</span>
                    </a>
                    <a href="#products" class="flex items-center justify-between p-2 rounded-xl hover:bg-slate-50 text-xs font-bold text-slate-700">
                        <span>🥛 Sữa tươi thanh trùng & Sữa chua</span>
                        <span class="text-slate-400">&gt;</span>
                    </a>
                    <a href="#products" class="flex items-center justify-between p-2 rounded-xl hover:bg-slate-50 text-xs font-bold text-slate-700">
                        <span>🥖 Bánh mì & Ngũ cốc yến mạch</span>
                        <span class="text-slate-400">&gt;</span>
                    </a>
                </div>

                <!-- Right Big Promotional Carousel / Banner -->
                <div class="lg:col-span-9 bg-gradient-to-r from-amber-100 via-orange-50 to-amber-200 rounded-3xl p-8 sm:p-12 relative overflow-hidden flex flex-col justify-center border border-amber-300/40">
                    <div class="max-w-md space-y-4 relative z-10">
                        <span class="px-3 py-1 rounded-full bg-rose-500 text-white font-black text-xs uppercase tracking-wider">
                            WEEKEND SUPER DISCOUNT!
                        </span>
                        <h1 class="text-3xl sm:text-4xl font-black text-[#233a95] leading-tight">
                            Specialist in the <br>grocery store
                        </h1>
                        <p class="text-xs sm:text-sm text-slate-600">
                            Chuyên cung cấp thực phẩm sạch, an toàn cho sức khỏe gia đình bạn với giá niêm yết bình ổn tốt nhất thị trường.
                        </p>
                        <div class="flex items-center gap-3 pt-2">
                            <span class="text-2xl font-black text-rose-600 font-mono">Chỉ từ 25.000đ</span>
                            <a href="#products" class="px-6 py-2.5 rounded-full bg-[#233a95] hover:bg-[#1a2c75] text-white font-extrabold text-xs uppercase tracking-wider transition-all">
                                Mua Sắm Ngay
                            </a>
                        </div>
                    </div>

                    <!-- Visual Food Graphic -->
                    <div class="absolute right-0 bottom-0 top-0 w-1/2 hidden md:block">
                        <img src="https://images.unsplash.com/photo-1542838132-92c53300491e?auto=format&fit=crop&w=800&q=80" alt="Fresh Groceries" class="w-full h-full object-cover rounded-l-full opacity-90 shadow-2xl">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Best Seller Product Grid -->
    <section id="products" class="py-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between border-b border-slate-200 pb-3 mb-6">
                <div>
                    <h2 class="text-xl font-black text-[#233a95]">SẢN PHẨM BÁN CHẠY NHẤT HÔM NAY</h2>
                    <p class="text-xs text-slate-400">Các mặt hàng tươi mới nhập về lúc 05:00 sáng</p>
                </div>
                <a href="#products" class="text-xs font-bold text-[#2bbef9] hover:underline">Xem tất cả &rarr;</a>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                <!-- Item 1 -->
                <div class="bg-white rounded-2xl border border-slate-200 p-4 flex flex-col justify-between hover:shadow-lg transition-all group">
                    <div>
                        <div class="relative aspect-square rounded-xl overflow-hidden bg-slate-50 mb-3">
                            <img src="https://images.unsplash.com/photo-1519996529931-28324d5a630e?auto=format&fit=crop&w=500&q=80" alt="Dâu tây" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                            <span class="absolute top-2 left-2 bg-rose-500 text-white text-[10px] font-black px-2 py-0.5 rounded-md">-25%</span>
                        </div>
                        <span class="text-[10px] text-slate-400 font-bold uppercase">Trái Cây Đà Lạt</span>
                        <h3 class="text-xs font-bold text-slate-900 line-clamp-2 mt-1">Dâu Tây Giống Nhật Cao Cấp Hộp 500g</h3>
                        <div class="flex items-center gap-1 text-amber-400 text-xs my-1">★★★★★ <span class="text-[10px] text-slate-400">(48)</span></div>
                    </div>
                    <div class="pt-3 border-t border-slate-100 flex items-center justify-between mt-2">
                        <div>
                            <span class="text-xs font-black text-rose-600 font-mono block">120.000đ</span>
                            <span class="text-[10px] text-slate-400 line-through">160.000đ</span>
                        </div>
                        <button type="button" @click="addToCart('Dâu Tây Giống Nhật', 120000)" class="p-2 rounded-xl bg-amber-400 hover:bg-amber-500 text-slate-950 font-bold transition-all" title="Thêm vào giỏ">
                            <span class="material-symbols-outlined text-[18px]">add_shopping_cart</span>
                        </button>
                    </div>
                </div>

                <!-- Item 2 -->
                <div class="bg-white rounded-2xl border border-slate-200 p-4 flex flex-col justify-between hover:shadow-lg transition-all group">
                    <div>
                        <div class="relative aspect-square rounded-xl overflow-hidden bg-slate-50 mb-3">
                            <img src="https://images.unsplash.com/photo-1540420773420-3366772f4999?auto=format&fit=crop&w=500&q=80" alt="Rau xà lách" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                            <span class="absolute top-2 left-2 bg-emerald-500 text-white text-[10px] font-black px-2 py-0.5 rounded-md">ORGANIC</span>
                        </div>
                        <span class="text-[10px] text-slate-400 font-bold uppercase">Rau Sạch VietGAP</span>
                        <h3 class="text-xs font-bold text-slate-900 line-clamp-2 mt-1">Xà Lách Thủy Canh Mỡ Giòn Túi 500g</h3>
                        <div class="flex items-center gap-1 text-amber-400 text-xs my-1">★★★★★ <span class="text-[10px] text-slate-400">(92)</span></div>
                    </div>
                    <div class="pt-3 border-t border-slate-100 flex items-center justify-between mt-2">
                        <div>
                            <span class="text-xs font-black text-rose-600 font-mono block">28.000đ</span>
                            <span class="text-[10px] text-slate-400 line-through">35.000đ</span>
                        </div>
                        <button type="button" @click="addToCart('Xà Lách Thủy Canh', 28000)" class="p-2 rounded-xl bg-amber-400 hover:bg-amber-500 text-slate-950 font-bold transition-all" title="Thêm vào giỏ">
                            <span class="material-symbols-outlined text-[18px]">add_shopping_cart</span>
                        </button>
                    </div>
                </div>

                <!-- Item 3 -->
                <div class="bg-white rounded-2xl border border-slate-200 p-4 flex flex-col justify-between hover:shadow-lg transition-all group">
                    <div>
                        <div class="relative aspect-square rounded-xl overflow-hidden bg-slate-50 mb-3">
                            <img src="https://images.unsplash.com/photo-1588347818036-558601350947?auto=format&fit=crop&w=500&q=80" alt="Thịt bò" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                            <span class="absolute top-2 left-2 bg-rose-500 text-white text-[10px] font-black px-2 py-0.5 rounded-md">-15%</span>
                        </div>
                        <span class="text-[10px] text-slate-400 font-bold uppercase">Thịt Tươi Sống</span>
                        <h3 class="text-xs font-bold text-slate-900 line-clamp-2 mt-1">Thăn Bò Úc Tươi Nhập Khẩu Khay 500g</h3>
                        <div class="flex items-center gap-1 text-amber-400 text-xs my-1">★★★★★ <span class="text-[10px] text-slate-400">(64)</span></div>
                    </div>
                    <div class="pt-3 border-t border-slate-100 flex items-center justify-between mt-2">
                        <div>
                            <span class="text-xs font-black text-rose-600 font-mono block">175.000đ</span>
                            <span class="text-[10px] text-slate-400 line-through">210.000đ</span>
                        </div>
                        <button type="button" @click="addToCart('Thăn Bò Úc Tươi', 175000)" class="p-2 rounded-xl bg-amber-400 hover:bg-amber-500 text-slate-950 font-bold transition-all" title="Thêm vào giỏ">
                            <span class="material-symbols-outlined text-[18px]">add_shopping_cart</span>
                        </button>
                    </div>
                </div>

                <!-- Item 4 -->
                <div class="bg-white rounded-2xl border border-slate-200 p-4 flex flex-col justify-between hover:shadow-lg transition-all group">
                    <div>
                        <div class="relative aspect-square rounded-xl overflow-hidden bg-slate-50 mb-3">
                            <img src="https://images.unsplash.com/photo-1550583724-b2692b85b150?auto=format&fit=crop&w=500&q=80" alt="Sữa tươi" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                            <span class="absolute top-2 left-2 bg-[#2bbef9] text-white text-[10px] font-black px-2 py-0.5 rounded-md">MỚI</span>
                        </div>
                        <span class="text-[10px] text-slate-400 font-bold uppercase">Sữa & Bơ Sạch</span>
                        <h3 class="text-xs font-bold text-slate-900 line-clamp-2 mt-1">Sữa Tươi Thanh Trùng Nguyên Chất 950ml</h3>
                        <div class="flex items-center gap-1 text-amber-400 text-xs my-1">★★★★★ <span class="text-[10px] text-slate-400">(115)</span></div>
                    </div>
                    <div class="pt-3 border-t border-slate-100 flex items-center justify-between mt-2">
                        <div>
                            <span class="text-xs font-black text-rose-600 font-mono block">38.000đ</span>
                            <span class="text-[10px] text-slate-400 line-through">42.000đ</span>
                        </div>
                        <button type="button" @click="addToCart('Sữa Tươi Thanh Trùng', 38000)" class="p-2 rounded-xl bg-amber-400 hover:bg-amber-500 text-slate-950 font-bold transition-all" title="Thêm vào giỏ">
                            <span class="material-symbols-outlined text-[18px]">add_shopping_cart</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-[#233a95] text-slate-300 py-8 text-xs border-t border-blue-900">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col sm:flex-row items-center justify-between gap-4">
            <span>© 2026 Fo1 Bacola Food Online Supermarket. Designed by Truyền Thông Cửu Long.</span>
            <span>Hotline Giao Hàng Siêu Tốc: 0939.363.262</span>
        </div>
    </footer>

</div>
