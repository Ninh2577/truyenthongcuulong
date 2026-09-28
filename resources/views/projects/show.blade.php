@extends('layouts.app')

@section('title', $caseStudy->title . ' - Case Study Thực Tế | Truyền Thông Cửu Long')
@section('meta_description', $caseStudy->summary ?: 'Hồ sơ năng lực và giải pháp triển khai thực tế của dự án ' . $caseStudy->title . ' tại Truyền Thông Cửu Long.')
@section('canonical', route('projects.show', $caseStudy->slug))

@section('content')
    @if($caseStudy->slug === 'ung-dung-quan-ly-phong-kham')
        @include('projects.partials.tech_gia_phuoc')
    @elseif($caseStudy->slug === 'website-phong-kham-da-khoa')
        @include('projects.partials.tech_nu_cuoi')
    @else
        @include('projects.partials.media_show')
    @endif
@endsection
