@extends('layouts.app')

@section('title', 'Máº¡ng LÆ°á»›i Äá»‘i TÃ¡c Chiáº¿n LÆ°á»£c - Truyá»n ThÃ´ng Cá»­u Long')
@section('meta_description', 'Danh sÃ¡ch cÃ¡c Ä‘á»‘i tÃ¡c háº¡ táº§ng cÃ´ng nghá»‡ vÃ  du lá»‹ch lá»¯ hÃ nh Ä‘á»“ng hÃ nh bá»n vá»¯ng cÃ¹ng Truyá»n ThÃ´ng Cá»­u Long.')

@push('styles')
<style>
.partner-card-stagger { opacity:0; transform:translateY(24px); transition:opacity .5s ease,transform .5s ease; }
.partner-card-stagger.revealed { opacity:1; transform:translateY(0); }
.travel-partner-card { transition:transform .28s cubic-bezier(.34,1.56,.64,1),box-shadow .28s ease,border-color .28s ease; }
.travel-partner-card:hover { transform:translateY(-6px); box-shadow:0 0 0 1px rgba(251,191,36,.3),0 16px 40px rgba(0,0,0,.45),0 0 24px rgba(251,191,36,.12); border-color:rgba(251,191,36,.45)!important; }
.travel-partner-card.featured-gold { background:linear-gradient(135deg,#0F172A 0%,#1a1f35 50%,#0F172A 100%); border-color:rgba(251,191,36,.25)!important; }
.travel-partner-card.featured-gold:hover { border-color:rgba(251,191,36,.6)!important; box-shadow:0 0 0 1px rgba(251,191,36,.4),0 20px 48px rgba(0,0,0,.5),0 0 32px rgba(251,191,36,.2); }
</style>
@endpush

@section('content')
<div class="w-full">

    {{-- 1. Hero (NEN TOI) â€” overflow-hidden ngan gradient ro sang section sang --}}
    <section class="relative pt-32 pb-12 lg:pt-36 lg:pb-16 overflow-hidden border-b border-slate-800/80 bg-[#080C16] text-white bg-dot-grid-dark">
        <div class="absolute inset-0 bg-gradient-to-b from-transparent via-transparent to-[#080C16] pointer-events-none"></div>
        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[600px] h-[320px] rounded-full bg-amber-500/8 blur-[80px] pointer-events-none"></div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <nav class="flex items-center gap-2 text-xs font-mono text-slate-400 mb-6" aria-label="Breadcrumb">
                <a href="{{ route('home') }}" class="hover:text-amber-400 transition-colors">Trang chá»§</a>
                <span class="text-slate-600">/</span>
                <a href="{{ route('about') }}" class="hover:text-amber-400 transition-colors">Vá» chÃºng tÃ´i</a>
                <span class="text-slate-600">/</span>
                <span class="text-amber-400 font-bold">Äá»‘i tÃ¡c chiáº¿n lÆ°á»£c</span>
            </nav>
            <div class="text-center max-w-3xl mx-auto flex flex-col items-center gap-4">
                <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-amber-400/10 border border-amber-400/30 text-amber-400 font-mono text-xs font-bold w-fit">
                    <span class="w-2 h-2 rounded-full bg-amber-400 animate-pulse"></span>
                    <span>OFFICIAL PARTNERS</span>
                </div>
                <h1 class="font-headline text-3xl sm:text-4xl lg:text-5xl font-extrabold tracking-tight leading-tight">
                    Máº¡ng LÆ°á»›i Äá»‘i TÃ¡c <br class="hidden sm:inline" />
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-amber-400 via-orange-400 to-amber-200">Äá»“ng HÃ nh Bá»n Vá»¯ng</span> CÃ¹ng CLM
                </h1>
                <p class="font-body text-slate-300 text-sm sm:text-base leading-relaxed">
                    HÆ¡n 10 nÄƒm hoáº¡t Ä‘á»™ng, Truyá»n ThÃ´ng Cá»­u Long tá»± hÃ o xÃ¢y dá»±ng má»‘i liÃªn minh bá»n vá»¯ng cÃ¹ng cÃ¡c nhÃ  cung cáº¥p háº¡ táº§ng sá»‘ uy tÃ­n vÃ  cÃ¡c táº­p Ä‘oÃ n lá»¯ hÃ nh, sá»± kiá»‡n hÃ ng Ä‘áº§u.
                </p>
                <div class="grid grid-cols-3 gap-4 pt-4 w-full max-w-lg">
                    <div class="p-3.5 rounded-2xl bg-[#0F172A] border border-slate-800 text-center">
                        <span class="font-headline text-2xl font-black text-amber-400">17+</span>
                        <p class="text-[11px] font-mono text-slate-400 mt-0.5">Äá»‘i tÃ¡c chiáº¿n lÆ°á»£c</p>
                    </div>
                    <div class="p-3.5 rounded-2xl bg-[#0F172A] border border-slate-800 text-center">
                        <span class="font-headline text-2xl font-black text-white">10+</span>
                        <p class="text-[11px] font-mono text-slate-400 mt-0.5">NÄƒm gáº¯n káº¿t</p>
                    </div>
                    <div class="p-3.5 rounded-2xl bg-[#0F172A] border border-slate-800 text-center">
                        <span class="font-headline text-2xl font-black text-emerald-400">100%</span>
                        <p class="text-[11px] font-mono text-slate-400 mt-0.5">Chuáº©n SLA</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- 2. Ha Tang Cong Nghe (NEN SANG) --}}
    <section class="py-12 lg:py-16 bg-surface bg-dot-grid-subtle border-b border-slate-200/80">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-4 mb-8">
                <div>
                    <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-sky-100 border border-sky-300 text-sky-800 font-mono text-xs font-bold mb-2">
                        <span class="material-symbols-outlined text-[15px] text-sky-600">dns</span>
                        <span>CLOUD &amp; HOSTING INFRASTRUCTURE</span>
                    </div>
                    <h2 class="font-headline text-2xl sm:text-3xl font-extrabold text-navy-base tracking-tight">Äá»‘i TÃ¡c Háº¡ Táº§ng MÃ¡y Chá»§ &amp; TÃªn Miá»n</h2>
                </div>
                <p class="font-body text-xs text-slate-600 max-w-md">Ná»n táº£ng mÃ¡y chá»§ Ä‘Ã¡m mÃ¢y vá»¯ng cháº¯c báº£o Ä‘áº£m 99.9% uptime cho má»i website vÃ  á»©ng dá»¥ng cá»§a khÃ¡ch hÃ ng.</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="p-8 rounded-3xl bg-white border border-slate-200/90 shadow-sm hover:border-primary/40 hover:shadow-md transition-all duration-300 flex flex-col justify-between group">
                    <div>
                        <div class="flex items-center justify-between mb-4">
                            <span class="px-3 py-1 rounded-full bg-sky-50 text-sky-700 font-mono text-xs font-bold border border-sky-200">DOMAIN &amp; CLOUD HOSTING</span>
                            <span class="text-xs font-mono text-slate-500">Äá»‘i tÃ¡c lÃ¢u nÄƒm</span>
                        </div>
                        <h3 class="font-headline text-2xl font-bold text-navy-base group-hover:text-primary transition-colors">P.A Viá»‡t Nam</h3>
                        <p class="font-body text-xs sm:text-sm text-slate-600 mt-3 leading-relaxed">NhÃ  Ä‘Äƒng kÃ½ tÃªn miá»n vÃ  cung cáº¥p dá»‹ch vá»¥ mÃ¡y chá»§ lá»›n nháº¥t Viá»‡t Nam. Äá»‘i tÃ¡c chiáº¿n lÆ°á»£c Ä‘á»“ng hÃ nh cung cáº¥p giáº£i phÃ¡p trung tÃ¢m dá»¯ liá»‡u chuáº©n Tier 3, Cloud VPS vÃ  SSL cho cÃ¡c há»‡ thá»‘ng doanh nghiá»‡p do CLM xÃ¢y dá»±ng.</p>
                    </div>
                    <div class="pt-6 mt-6 border-t border-slate-100 flex items-center justify-between text-xs font-mono text-slate-500">
                        <span class="text-emerald-600 font-semibold flex items-center gap-1"><span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>Háº¡ táº§ng Tier 3</span>
                        <span>Domain .VN / Quá»‘c táº¿</span>
                    </div>
                </div>
                <div class="p-8 rounded-3xl bg-white border border-slate-200/90 shadow-sm hover:border-amber-400/40 hover:shadow-md transition-all duration-300 flex flex-col justify-between group">
                    <div>
                        <div class="flex items-center justify-between mb-4">
                            <span class="px-3 py-1 rounded-full bg-amber-50 text-amber-800 font-mono text-xs font-bold border border-amber-200">INTERNATIONAL CLOUD HOSTING</span>
                            <span class="text-xs font-mono text-slate-500">Äá»‘i tÃ¡c quá»‘c táº¿</span>
                        </div>
                        <h3 class="font-headline text-2xl font-bold text-navy-base group-hover:text-amber-600 transition-colors">Hawk Host</h3>
                        <p class="font-body text-xs sm:text-sm text-slate-600 mt-3 leading-relaxed">NhÃ  cung cáº¥p Ä‘iá»‡n toÃ¡n Ä‘Ã¡m mÃ¢y vÃ  Hosting hiá»‡u nÄƒng cao hÃ ng Ä‘áº§u Báº¯c Má»¹ vá»›i mÃ¡y chá»§ táº¡i Hong Kong vÃ  Singapore. Háº¡ táº§ng tá»‘c Ä‘á»™ cá»±c nhanh vÃ  chá»‘ng DDoS á»•n Ä‘á»‹nh cho cÃ¡c cá»•ng thÃ´ng tin quá»‘c táº¿.</p>
                    </div>
                    <div class="pt-6 mt-6 border-t border-slate-100 flex items-center justify-between text-xs font-mono text-slate-500">
                        <span class="text-emerald-600 font-semibold flex items-center gap-1"><span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>LiteSpeed Web Server</span>
                        <span>Multi-Datacenter Routing</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- 3. Du Lich & Su Kien (NEN TOI) â€”  dot-grid via inline style + overflow-hidden --}}
    <section id="travel-partners-section"
             class="relative py-14 lg:py-20 border-b border-slate-800 text-white overflow-hidden"
             style="background-color:#080C16;background-image:radial-gradient(rgba(255,255,255,0.07) 1.2px,transparent 1.2px);background-size:24px 24px;">
        <div class="absolute -top-32 right-8 w-[420px] h-[420px] rounded-full bg-indigo-500/12 blur-[90px] pointer-events-none"></div>
        <div class="absolute -bottom-32 left-8 w-[380px] h-[380px] rounded-full bg-amber-500/10 blur-[80px] pointer-events-none"></div>
        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[700px] h-[300px] rounded-full bg-primary/5 blur-[100px] pointer-events-none"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="text-center max-w-3xl mx-auto mb-12 lg:mb-16">
                <span class="font-mono text-xs text-amber-400 font-bold uppercase tracking-widest">TOURISM, TRAVEL &amp; EVENTS NETWORK</span>
                <h2 class="font-headline text-2xl sm:text-3xl lg:text-4xl font-extrabold mt-2">Äá»‘i TÃ¡c Du Lá»‹ch, Lá»¯ HÃ nh &amp; Tá»• Chá»©c Sá»± Kiá»‡n</h2>
                <p class="font-body text-slate-400 text-xs sm:text-sm mt-3">Máº¡ng lÆ°á»›i 15 Ä‘Æ¡n vá»‹ lá»¯ hÃ nh, nghá»‰ dÆ°á»¡ng sinh thÃ¡i vÃ  tá»• chá»©c sá»± kiá»‡n chuyÃªn nghiá»‡p â€” Ä‘á»‘i tÃ¡c thá»±c Ä‘á»‹a Ä‘á»“ng hÃ nh trong má»i chiáº¿n dá»‹ch quáº£ng bÃ¡ du lá»‹ch.</p>
            </div>

            @php
            $travelPartners = [
                ['name'=>'Long Trekking','cat'=>'Trekking & Du Lá»‹ch Máº¡o Hiá»ƒm','desc'=>'Tá»• chá»©c tour trekking khÃ¡m phÃ¡ thiÃªn nhiÃªn vÃ  tráº£i nghiá»‡m sinh tá»“n táº¡i cÃ¡c cung Ä‘Æ°á»ng hoang dÃ£ ÄBSCL vÃ  TÃ¢y NguyÃªn.','icon'=>'terrain','tier'=>'gold','accent'=>'emerald','tag'=>'Tour thá»±c Ä‘á»‹a Â· Sinh tá»“n rá»«ng'],
                ['name'=>'LÃ¡ng Sen','cat'=>'Khu Báº£o Tá»“n Sinh ThÃ¡i','desc'=>'Báº£o tá»“n Ä‘áº¥t ngáº­p nÆ°á»›c Ramsar, du lá»‹ch sinh thÃ¡i vÃ  nghiÃªn cá»©u thiÃªn nhiÃªn Ä‘á»“ng báº±ng. Äiá»ƒm Ä‘áº¿n xanh chuáº©n quá»‘c táº¿.','icon'=>'forest','tier'=>'gold','accent'=>'teal','tag'=>'Äáº¥t ngáº­p nÆ°á»›c Ramsar Â· Sinh thÃ¡i'],
                ['name'=>'Apollo Travel & Events','cat'=>'Tá»• Chá»©c Sá»± Kiá»‡n & Gala','desc'=>'Trung tÃ¢m tá»• chá»©c sá»± kiá»‡n, há»™i nghá»‹ khÃ¡ch hÃ ng vÃ  gala du lá»‹ch quy mÃ´ lá»›n. MC vÃ  production sá»± kiá»‡n chuyÃªn nghiá»‡p.','icon'=>'campaign','tier'=>'gold','accent'=>'orange','tag'=>'Gala Â· Há»™i nghá»‹ Â· MC Events'],
                ['name'=>'VNTravel','cat'=>'Máº¡ng LÆ°á»›i Du Lá»‹ch Viá»‡t','desc'=>'Há»‡ sinh thÃ¡i truyá»n thÃ´ng vÃ  dá»‹ch vá»¥ du lá»‹ch tráº£i nghiá»‡m lá»¯ hÃ nh, káº¿t ná»‘i Ä‘iá»ƒm Ä‘áº¿n ná»™i Ä‘á»‹a vÃ  outbound toÃ n cáº§u.','icon'=>'language','tier'=>'gold','accent'=>'blue','tag'=>'Ná»™i Ä‘á»‹a Â· Outbound Â· Media'],
                ['name'=>'Nam TÃ¢y NguyÃªn','cat'=>'KhÃ¡m PhÃ¡ Cao NguyÃªn','desc'=>'DÃ£ ngoáº¡i, cáº¯m tráº¡i vÃ  tour khÃ¡m phÃ¡ Ä‘áº¡i ngÃ n TÃ¢y NguyÃªn. ChuyÃªn tuyáº¿n du lá»‹ch bá»¥i vÃ  tráº£i nghiá»‡m báº£n Ä‘á»‹a.','icon'=>'hiking','tier'=>'strategic','accent'=>'lime','tag'=>'Camping Â· DÃ£ ngoáº¡i'],
                ['name'=>'MTC Travel','cat'=>'Lá»¯ HÃ nh & Sá»± Kiá»‡n','desc'=>'Tá»• chá»©c tour du lá»‹ch trá»n gÃ³i vÃ  sá»± kiá»‡n há»™i nghá»‹ khÃ¡ch hÃ ng táº¡i miá»n TÃ¢y vÃ  TP.HCM.','icon'=>'travel_explore','tier'=>'strategic','accent'=>'sky','tag'=>'Tour trá»n gÃ³i Â· MICE'],
                ['name'=>'Gonatour','cat'=>'Du Lá»‹ch Trong & NgoÃ i NÆ°á»›c','desc'=>'CÃ´ng ty thÆ°Æ¡ng máº¡i dá»‹ch vá»¥ du lá»‹ch Gonatour uy tÃ­n vá»›i cÃ¡c tuyáº¿n inbound vÃ  outbound cháº¥t lÆ°á»£ng cao.','icon'=>'flight_takeoff','tier'=>'strategic','accent'=>'indigo','tag'=>'Inbound Â· Outbound'],
                ['name'=>'HoÃ ng Anh Event','cat'=>'Ã‚m Thanh & SÃ¢n Kháº¥u Sá»± Kiá»‡n','desc'=>'Giáº£i phÃ¡p tá»• chá»©c sá»± kiá»‡n, Ã¢m thanh Ã¡nh sÃ¡ng sÃ¢n kháº¥u chuyÃªn nghiá»‡p. Cung cáº¥p thiáº¿t bá»‹ stage vÃ  Ä‘á»™i ngÅ© ká»¹ thuáº­t.','icon'=>'spatial_audio_off','tier'=>'strategic','accent'=>'purple','tag'=>'Ã‚m thanh Â· Ãnh sÃ¡ng Â· Stage'],
                ['name'=>'InterTravel','cat'=>'Lá»¯ HÃ nh Quá»‘c Táº¿','desc'=>'Dá»‹ch vá»¥ du lá»‹ch lá»¯ hÃ nh quá»‘c táº¿, lÃ m visa xuáº¥t nháº­p cáº£nh, Ä‘áº·t vÃ© mÃ¡y bay vÃ  khÃ¡ch sáº¡n quá»‘c táº¿.','icon'=>'luggage','tier'=>'strategic','accent'=>'cyan','tag'=>'Visa Â· VÃ© mÃ¡y bay Â· Quá»‘c táº¿'],
                ['name'=>'Hoangmai Travel','cat'=>'Váº­n Chuyá»ƒn & Lá»¯ HÃ nh','desc'=>'Dá»‹ch vá»¥ xe du lá»‹ch Ä‘á»i má»›i vÃ  Ä‘iá»u phá»‘i tuyáº¿n Ä‘iá»ƒm tham quan táº¡i miá»n TÃ¢y vÃ  TP.HCM.','icon'=>'directions_bus','tier'=>'strategic','accent'=>'amber','tag'=>'Xe du lá»‹ch Â· Äiá»u phá»‘i tuyáº¿n'],
                ['name'=>'SGStar (Sao SÃ i GÃ²n)','cat'=>'Team Building & Tour ÄoÃ n','desc'=>'Tá»• chá»©c tour du lá»‹ch khÃ¡ch Ä‘oÃ n vÃ  hoáº¡t Ä‘á»™ng team building ngoÃ i trá»i chuyÃªn nghiá»‡p cho doanh nghiá»‡p.','icon'=>'groups','tier'=>'strategic','accent'=>'rose','tag'=>'Team building Â· Tour Ä‘oÃ n'],
                ['name'=>'Travelife','cat'=>'Du Lá»‹ch Sinh ThÃ¡i Bá»n Vá»¯ng','desc'=>'Chuáº©n má»±c du lá»‹ch bá»n vá»¯ng vÃ  tráº£i nghiá»‡m vÄƒn hÃ³a báº£n Ä‘á»‹a, hÆ°á»›ng Ä‘áº¿n du khÃ¡ch cÃ³ Ã½ thá»©c báº£o tá»“n.','icon'=>'eco','tier'=>'strategic','accent'=>'green','tag'=>'Eco-tourism Â· Bá»n vá»¯ng'],
                ['name'=>'PhÃº Thá» (Phuthotourist)','cat'=>'Khu Vui ChÆ¡i & KhÃ¡ch Sáº¡n','desc'=>'CÃ´ng ty Cá»• pháº§n Dá»‹ch vá»¥ Du lá»‹ch PhÃº Thá» vá»›i chuá»—i dá»‹ch vá»¥ giáº£i trÃ­, khÃ¡ch sáº¡n vÃ  khu vui chÆ¡i lÃ¢u Ä‘á»i.','icon'=>'hotel','tier'=>'strategic','accent'=>'yellow','tag'=>'KhÃ¡ch sáº¡n Â· Khu vui chÆ¡i'],
                ['name'=>'Khu Nghá»‰ DÆ°á»¡ng Sinh ThÃ¡i Cá»­u Long','cat'=>'Nghá»‰ DÆ°á»¡ng & Camping','desc'=>'Há»‡ thá»‘ng Ä‘iá»ƒm Ä‘áº¿n cáº¯m tráº¡i sinh thÃ¡i ven sÃ´ng miá»n TÃ¢y, Ä‘iá»ƒm check-in ná»•i báº­t ÄBSCL.','icon'=>'water','tier'=>'strategic','accent'=>'teal','tag'=>'Camping Â· Ven sÃ´ng Â· Sinh thÃ¡i'],
                ['name'=>'LiÃªn Minh Du Lá»‹ch ÄBSCL','cat'=>'XÃºc Tiáº¿n Du Lá»‹ch VÃ¹ng','desc'=>'Máº¡ng lÆ°á»›i liÃªn káº¿t phÃ¡t triá»ƒn vÃ  quáº£ng bÃ¡ vÄƒn hÃ³a du lá»‹ch sÃ´ng nÆ°á»›c Ä‘á»“ng báº±ng sÃ´ng Cá»­u Long.','icon'=>'hub','tier'=>'strategic','accent'=>'orange','tag'=>'Quáº£ng bÃ¡ vÃ¹ng Â· SÃ´ng nÆ°á»›c'],
            ];
            $accentMap = [
                'emerald'=>['bg'=>'bg-emerald-500/15 border-emerald-500/25','text'=>'text-emerald-400'],
                'teal'   =>['bg'=>'bg-teal-500/15 border-teal-500/25',    'text'=>'text-teal-400'],
                'orange' =>['bg'=>'bg-orange-500/15 border-orange-500/25','text'=>'text-orange-400'],
                'blue'   =>['bg'=>'bg-blue-500/15 border-blue-500/25',    'text'=>'text-blue-400'],
                'lime'   =>['bg'=>'bg-lime-500/15 border-lime-500/25',    'text'=>'text-lime-400'],
                'sky'    =>['bg'=>'bg-sky-500/15 border-sky-500/25',      'text'=>'text-sky-400'],
                'indigo' =>['bg'=>'bg-indigo-500/15 border-indigo-500/25','text'=>'text-indigo-400'],
                'purple' =>['bg'=>'bg-purple-500/15 border-purple-500/25','text'=>'text-purple-400'],
                'cyan'   =>['bg'=>'bg-cyan-500/15 border-cyan-500/25',    'text'=>'text-cyan-400'],
                'amber'  =>['bg'=>'bg-amber-500/15 border-amber-500/25',  'text'=>'text-amber-400'],
                'rose'   =>['bg'=>'bg-rose-500/15 border-rose-500/25',    'text'=>'text-rose-400'],
                'green'  =>['bg'=>'bg-green-500/15 border-green-500/25',  'text'=>'text-green-400'],
                'yellow' =>['bg'=>'bg-yellow-500/15 border-yellow-500/25','text'=>'text-yellow-400'],
            ];
            @endphp

            {{-- GOLD TIER --}}
            <div class="mb-10">
                <div class="flex items-center gap-3 mb-5">
                    <span class="material-symbols-outlined text-[16px] text-amber-400">workspace_premium</span>
                    <span class="font-mono text-[11px] text-amber-400 font-bold uppercase tracking-widest">Äá»‘i TÃ¡c VÃ ng Â· Æ¯u TiÃªn</span>
                    <div class="flex-1 h-px bg-gradient-to-r from-amber-400/40 to-transparent"></div>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                    @foreach($travelPartners as $idx => $partner)
                    @if($partner['tier'] === 'gold')
                    @php $ac = $accentMap[$partner['accent']] ?? $accentMap['amber']; @endphp
                    <div class="partner-card-stagger travel-partner-card featured-gold p-6 rounded-3xl border flex flex-col justify-between group"
                         style="transition-delay:{{ ($idx % 4) * 80 }}ms">
                        <div>
                            <div class="flex items-start justify-between mb-4 gap-3">
                                <div class="w-11 h-11 rounded-2xl {{ $ac['bg'] }} border flex items-center justify-center flex-shrink-0">
                                    <span class="material-symbols-outlined text-[22px] {{ $ac['text'] }}">{{ $partner['icon'] }}</span>
                                </div>
                                <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full bg-amber-400/15 border border-amber-400/30 font-mono text-[10px] text-amber-300 font-bold flex-shrink-0">
                                    <span class="material-symbols-outlined text-[11px]">star</span>Äá»‘i TÃ¡c VÃ ng
                                </span>
                            </div>
                            <p class="font-mono text-[10px] text-slate-500 uppercase tracking-wider mb-1.5">{{ $partner['cat'] }}</p>
                            <h3 class="font-headline text-xl font-bold text-white group-hover:text-amber-300 transition-colors leading-tight">{{ $partner['name'] }}</h3>
                            <p class="font-body text-xs text-slate-400 mt-2.5 leading-relaxed">{{ $partner['desc'] }}</p>
                        </div>
                        <div class="pt-4 mt-5 border-t border-white/8 flex items-center justify-between text-[11px] font-mono">
                            <span class="text-slate-500 truncate pr-2">{{ $partner['tag'] }}</span>
                            <span class="flex items-center gap-1.5 text-emerald-400 font-semibold flex-shrink-0">
                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-400 animate-pulse"></span>Chiáº¿n lÆ°á»£c
                            </span>
                        </div>
                    </div>
                    @endif
                    @endforeach
                </div>
            </div>

            {{-- STRATEGIC TIER --}}
            <div>
                <div class="flex items-center gap-3 mb-5">
                    <span class="material-symbols-outlined text-[16px] text-slate-400">handshake</span>
                    <span class="font-mono text-[11px] text-slate-400 font-bold uppercase tracking-widest">Äá»‘i TÃ¡c Chiáº¿n LÆ°á»£c</span>
                    <div class="flex-1 h-px bg-gradient-to-r from-slate-700 to-transparent"></div>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">
                    @foreach($travelPartners as $idx => $partner)
                    @if($partner['tier'] === 'strategic')
                    @php $ac = $accentMap[$partner['accent']] ?? $accentMap['amber']; $delay = ($idx % 6)*80; @endphp
                    <div class="partner-card-stagger travel-partner-card p-5 rounded-3xl bg-[#0F172A] border border-slate-800 flex flex-col justify-between group"
                         style="transition-delay:{{ $delay }}ms">
                        <div>
                            <div class="flex items-start justify-between mb-3 gap-2">
                                <div class="w-9 h-9 rounded-xl {{ $ac['bg'] }} border flex items-center justify-center flex-shrink-0">
                                    <span class="material-symbols-outlined text-[18px] {{ $ac['text'] }}">{{ $partner['icon'] }}</span>
                                </div>
                                <span class="px-2 py-0.5 rounded-full bg-white/5 border border-white/10 font-mono text-[9px] text-slate-400 leading-tight text-right">{{ $partner['cat'] }}</span>
                            </div>
                            <h3 class="font-headline text-base font-bold text-white group-hover:text-amber-300 transition-colors leading-snug mt-1">{{ $partner['name'] }}</h3>
                            <p class="font-body text-[11px] text-slate-400 mt-2 leading-relaxed">{{ $partner['desc'] }}</p>
                        </div>
                        <div class="pt-3 mt-4 border-t border-slate-800/80 flex items-center justify-between text-[10px] font-mono">
                            <span class="text-slate-600 truncate pr-2">{{ $partner['tag'] }}</span>
                            <span class="text-emerald-400 flex-shrink-0">â— Äá»“ng hÃ nh</span>
                        </div>
                    </div>
                    @endif
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    {{-- 4. Collaboration Principles (NEN SANG) --}}
    <section class="py-12 lg:py-16 bg-surface bg-dot-grid-subtle border-b border-slate-200/80">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-2xl mx-auto mb-10 lg:mb-12">
                <div class="inline-flex items-center gap-2 px-3.5 py-1 rounded-full bg-amber-100 border border-amber-300 text-amber-800 font-mono text-xs font-bold mb-3">
                    <span class="material-symbols-outlined text-[15px] text-amber-600">handshake</span>
                    <span>PARTNERSHIP VALUES</span>
                </div>
                <h2 class="font-headline text-2xl sm:text-3xl lg:text-4xl font-extrabold text-navy-base tracking-tight">3 TiÃªu Chuáº©n Há»£p TÃ¡c Bá»n Vá»¯ng</h2>
                <p class="font-body text-slate-600 text-xs sm:text-sm mt-3">XÃ¢y dá»±ng ná»n táº£ng liÃªn káº¿t uy tÃ­n, minh báº¡ch vÃ  táº¡o ra giÃ¡ trá»‹ cá»™ng hÆ°á»Ÿng lÃ¢u dÃ i.</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="p-6 rounded-3xl bg-white border border-slate-200/90 shadow-sm flex flex-col gap-3 hover:-translate-y-1 hover:border-amber-400/50 hover:shadow-md transition-all duration-300">
                    <div class="w-10 h-10 rounded-xl bg-amber-50 text-amber-600 border border-amber-200 flex items-center justify-center font-headline font-bold text-base">01</div>
                    <h3 class="font-headline text-lg font-bold text-navy-base">TÃ´n Trá»ng Cam Káº¿t SLA</h3>
                    <p class="font-body text-xs text-slate-600 leading-relaxed">Má»i thá»a thuáº­n vá» cháº¥t lÆ°á»£ng dá»‹ch vá»¥, thá»i gian váº­n hÃ nh vÃ  báº£o máº­t dá»¯ liá»‡u Ä‘á»u Ä‘Æ°á»£c cam káº¿t cháº·t cháº½ báº±ng vÄƒn báº£n phÃ¡p lÃ½.</p>
                </div>
                <div class="p-6 rounded-3xl bg-white border border-slate-200/90 shadow-sm flex flex-col gap-3 hover:-translate-y-1 hover:border-amber-400/50 hover:shadow-md transition-all duration-300">
                    <div class="w-10 h-10 rounded-xl bg-amber-50 text-amber-600 border border-amber-200 flex items-center justify-center font-headline font-bold text-base">02</div>
                    <h3 class="font-headline text-lg font-bold text-navy-base">ÄÃ´i BÃªn CÃ¹ng PhÃ¡t Triá»ƒn (Win-Win)</h3>
                    <p class="font-body text-xs text-slate-600 leading-relaxed">Chia sáº» nguá»“n lá»±c, tá»‡p khÃ¡ch hÃ ng vÃ  kinh nghiá»‡m chuyÃªn mÃ´n Ä‘á»ƒ cÃ¹ng táº¡o ra sáº£n pháº©m dá»‹ch vá»¥ hoÃ n háº£o nháº¥t tá»›i tay ngÆ°á»i tiÃªu dÃ¹ng.</p>
                </div>
                <div class="p-6 rounded-3xl bg-white border border-slate-200/90 shadow-sm flex flex-col gap-3 hover:-translate-y-1 hover:border-amber-400/50 hover:shadow-md transition-all duration-300">
                    <div class="w-10 h-10 rounded-xl bg-amber-50 text-amber-600 border border-amber-200 flex items-center justify-center font-headline font-bold text-base">03</div>
                    <h3 class="font-headline text-lg font-bold text-navy-base">Äá»“ng HÃ nh DÃ i Háº¡n</h3>
                    <p class="font-body text-xs text-slate-600 leading-relaxed">ChÃºng tÃ´i hÆ°á»›ng Ä‘áº¿n má»‘i quan há»‡ há»£p tÃ¡c chiáº¿n lÆ°á»£c tÃ­nh báº±ng nhiá»u nÄƒm, khÃ´ng cháº¡y theo lá»£i nhuáº­n ngáº¯n háº¡n hay há»£p Ä‘á»“ng nháº¥t thá»i.</p>
                </div>
            </div>
        </div>
    </section>

</div>

<script type="application/ld+json">
{"@context":"https://schema.org","@type":"AboutPage","name":"Máº¡ng LÆ°á»›i Äá»‘i TÃ¡c Chiáº¿n LÆ°á»£c - Truyá»n ThÃ´ng Cá»­u Long","description":"Danh sÃ¡ch cÃ¡c Ä‘á»‘i tÃ¡c háº¡ táº§ng cÃ´ng nghá»‡ vÃ  du lá»‹ch lá»¯ hÃ nh Ä‘á»“ng hÃ nh bá»n vá»¯ng cÃ¹ng Truyá»n ThÃ´ng Cá»­u Long.","url":"{{ route('partners') }}"}
</script>

@push('scripts')
<script>
(function(){
    var cards=document.querySelectorAll('#travel-partners-section .partner-card-stagger');
    if(!cards.length)return;
    var obs=new IntersectionObserver(function(entries){
        entries.forEach(function(e){
            if(e.isIntersecting){
                var d=parseInt(e.target.style.transitionDelay)||0;
                setTimeout(function(){e.target.classList.add('revealed');},d);
                obs.unobserve(e.target);
            }
        });
    },{threshold:0.12,rootMargin:'0px 0px -40px 0px'});
    cards.forEach(function(c){obs.observe(c);});
})();
</script>
@endpush
@endsection
