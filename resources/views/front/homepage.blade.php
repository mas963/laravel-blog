@extends('front.layouts.master')
@section('title', 'Anasayfa')
@section('content')

<!-- Main Content-->
        <div class="col-md-9 col-xl-7">
            <!-- Post preview-->
            @foreach($articles as $article)
            <div class="post-preview">
                <a href="{{route('single', [$article->getCategory->slug, $article->slug])}}">
                    <h2 class="post-title">{{$article->title}}</h2>
                    <img style="width: 100%" src="{{$article->image}}" alt="">
                    <h3 class="post-subtitle">{!!\Illuminate\Support\Str::limit($article->content, 250)!!}</h3>
                </a>
                <p class="post-meta">
                    <a href="#!">{{$article->getCategory->name}}</a>
                    <span class="float-end">{{$article->created_at->diffForHumans()}}</span>
                </p>
            </div>
            <!-- Divider-->
            @if(!$loop->last) <!-- sonuncu ise çalışmasın -->
            <hr class="my-4" />
            @endif
            @endforeach
            <!-- Pager-->
            <div class="d-flex justify-content-end mb-4"><a class="btn btn-primary text-uppercase" href="#!">Older Posts →</a></div>
        </div>
    @include('front.widgets.categoryWidget')
@endsection


