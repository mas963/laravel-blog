@if(count($articles) > 0)
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
@else
    <h2 class="post-title">
        <p>{{$category->name}} kategorisine ait makale bulunmamaktadır.</p>
    </h2>
@endif
{{$articles->links('pagination::bootstrap-4')}}
