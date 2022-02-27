@isset($categories)
<div class="col-md-3">
    <div class="list-group">
        @foreach($categories as $category)
            <a href="#" class="list-group-item">{{$category->name}} <span class="badge bg-danger float-end">{{$category->articleCount()}}</span></a>
        @endforeach
    </div>
</div>
    @endisset
