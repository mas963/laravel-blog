@extends('front.layouts.master')
@section('title', 'Anasayfa')
@section('content')

<!-- Main Content-->
        <div class="col-md-9 col-xl-7">
            <!-- Post preview-->
            @include('front.widgets.articleList')
            <!-- Pager-->
        </div>
    @include('front.widgets.categoryWidget')
@endsection


