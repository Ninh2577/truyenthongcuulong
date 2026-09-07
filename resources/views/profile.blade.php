@extends('layouts.app')

@section('title', 'Hồ Sơ Năng Lực (E-Profile) - Truyền Thông Cửu Long')
@section('meta_description', 'Khám phá hồ sơ năng lực tương tác dạng lật sách trực tuyến của Công ty Truyền Thông Cửu Long.')

@push('styles')
<link rel="stylesheet" href="{{ asset('style-bookslider.css') }}">
<style>
    .book-wrapper {
        box-shadow: 0 20px 50px rgba(0, 0, 0, 0.5);
        border-radius: 12px;
        overflow: hidden;
    }
</style>
@endpush

@section('content')
<div class="pt-28 pb-20">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-3xl mx-auto mb-10">
            <span class="text-xs font-bold text-cyan-400 uppercase tracking-widest block mb-2">Company Profile</span>
            <h1 class="text-3xl sm:text-5xl font-extrabold text-white mb-4">Hồ Sơ Năng Lực Trực Tuyến</h1>
            <p class="text-slate-400 text-sm sm:text-base">Lật sách tương tác để tìm hiểu năng lực, trang thiết bị và các dự án tiêu biểu của chúng tôi.</p>
        </div>

        <!-- Flipbook Container -->
        <div class="glass-panel p-4 sm:p-8 rounded-3xl border border-white/10 shadow-glow mb-10 overflow-hidden flex flex-col items-center">
            <div id="container-book-slider" class="w-full max-w-4xl book-wrapper">
                <div id="htmlBook">
                    <div class="flip-book html-book stf__wrapper --landscape" id="htmlBookExample" style="min-width: 320px; min-height: 450px; width: 100%; display: block; padding-bottom: 66.6%;">
                        <div class="stf__block">
                            <div class="page stf__item">
                                <div class="page-content">
                                    <div class="page-image" style="background-image: url('{{ asset('storage/uploads/2022/08/ho-so-nang-luc-hinh-1-1-scaled.jpg') }}'); background-size: cover; height: 100%;"></div>
                                </div>
                            </div>
                            <div class="page stf__item">
                                <div class="page-content">
                                    <div class="page-image" style="background-image: url('{{ asset('storage/uploads/2022/08/ho-so-nang-luc-hinh-1-2-scaled.jpg') }}'); background-size: cover; height: 100%;"></div>
                                </div>
                            </div>
                            <div class="page stf__item">
                                <div class="page-content">
                                    <div class="page-image" style="background-image: url('{{ asset('storage/uploads/2022/08/ho-so-nang-luc-hinh-2-1-scaled.jpg') }}'); background-size: cover; height: 100%;"></div>
                                </div>
                            </div>
                            <div class="page stf__item">
                                <div class="page-content">
                                    <div class="page-image" style="background-image: url('{{ asset('storage/uploads/2022/08/ho-so-nang-luc-hinh-2-2-scaled.jpg') }}'); background-size: cover; height: 100%;"></div>
                                </div>
                            </div>
                            <div class="page stf__item">
                                <div class="page-content">
                                    <div class="page-image" style="background-image: url('{{ asset('storage/uploads/2022/08/ho-so-nang-luc-hinh-3-1-scaled.jpg') }}'); background-size: cover; height: 100%;"></div>
                                </div>
                            </div>
                            <div class="page stf__item">
                                <div class="page-content">
                                    <div class="page-image" style="background-image: url('{{ asset('storage/uploads/2022/08/ho-so-nang-luc-hinh-3-2-scaled.jpg') }}'); background-size: cover; height: 100%;"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Download Button -->
            <div class="mt-8 flex flex-col sm:flex-row items-center gap-4">
                <a href="{{ route('contact') }}" class="px-6 py-3 rounded-xl bg-gradient-to-r from-cyan-500 to-blue-600 text-white font-bold text-sm shadow-glow">
                    Liên Hệ Hợp Tác Ngay ⚡
                </a>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="{{ asset('js-bookslider.js') }}"></script>
@endpush