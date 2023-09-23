@extends('layout')

@section('header')
@php
    $seo_title = 'Prelhive';
    $seo_description = '';
    $seo_image = url('/').'/images/favicon.png';
@endphp

<title>{{ $seo_title }}</title>
<meta name="description" content="{{ $seo_description }}">

<!-- Google / Search Engine Tags -->
<meta itemprop="name" content="{{ $seo_title }}">
<meta itemprop="description" content="{{ $seo_description }}">
<meta itemprop="image" content="{{ $seo_image }}">

<!-- Facebook Meta Tags -->
<meta property="og:url" content="{{ url('/')}}">
<meta property="og:type" content="website">
<meta property="og:title" content="{{ $seo_title }}">
<meta property="og:description" content="{{ $seo_description }}">
<meta property="og:image" content="{{ $seo_image }}">

<!-- Twitter Meta Tags -->
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="{{ $seo_title }}">
<meta name="twitter:description" content="{{ $seo_description }}">
<meta name="twitter:image" content="{{ $seo_image }}">
@endsection

@section('content')

@endsection
