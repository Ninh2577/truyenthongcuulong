<x-filament-widgets::widget>
    <style>
        .animate-fade-in-up {
            opacity: 0;
            transform: translateY(15px);
            animation: fade-in-up 0.5s ease-out forwards;
        }
        @keyframes fade-in-up {
            to { opacity: 1; transform: translateY(0); }
        }
        .stagger-1 { animation-delay: 60ms; }
        .stagger-2 { animation-delay: 120ms; }
        .stagger-3 { animation-delay: 180ms; }
        .stagger-4 { animation-delay: 240ms; }
        .stagger-5 { animation-delay: 300ms; }
        .stagger-6 { animation-delay: 360ms; }
    </style>
    
    <div class="flex flex-wrap gap-3 mt-[-1rem] mb-2">
        <x-filament::button tag="a" href="/admin/posts/create" color="warning" outlined icon="heroicon-o-plus" class="hover:-translate-y-1 transition-transform">
            Bài viết mới
        </x-filament::button>
        <x-filament::button tag="a" href="/admin/case-studies/create" color="danger" outlined icon="heroicon-o-plus" class="hover:-translate-y-1 transition-transform">
            Dự án mới
        </x-filament::button>
        <x-filament::button tag="a" href="/admin/partners/create" color="primary" outlined icon="heroicon-o-plus" class="hover:-translate-y-1 transition-transform">
            Đối tác mới
        </x-filament::button>
    </div>
</x-filament-widgets::widget>
