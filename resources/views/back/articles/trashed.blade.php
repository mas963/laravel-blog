@extends('back.layouts.master')
@section('title','Geri dönüşümdeki makaleler')
@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">
            <strong>{{$articles->count()}}</strong> makale bulundu
            <span class="float-right"><a href="{{route('admin.makaleler.index')}}" class="btn btn-primary btn-sm">Tüm makaleler</a></span>
        </h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Görsel</th>
                        <th>Başlık</th>
                        <th>Kategori</th>
                        <th>Görüntülenme</th>
                        <th>Oluşturulma Tarihi</th>
                        <th>İşlemler</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($articles as $article)
                    <tr>
                        <td><img src="{{$article->image}}" width="200" alt=""></td>
                        <td>{{$article->title}}</td>
                        <td>{{$article->getCategory->name}}</td>
                        <td>{{$article->hit}}</td>
                        <td>{{$article->created_at->diffForHumans()}}</td>
                        <td>
                            <a href="{{route('admin.recover.article',$article->id)}}" title="Kurtar" class="btn btn-sm btn-success"><li class="fa fa-undo"></li></a>
                            <a href="{{route('admin.hard.delete.article',$article->id)}}" title="Sil" class="btn btn-sm btn-danger"><li class="fa fa-times"></li></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection