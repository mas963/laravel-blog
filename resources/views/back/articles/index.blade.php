@extends('back.layouts.master')
@section('title','Tüm makaleler')
@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">
            <strong>{{$articles->count()}}</strong> makale bulundu
            <span class="float-right"><a href="{{route('admin.trashed.article')}}" class="btn btn-warning btn-sm"><i class="fa fa-trash"></i> Geri dönüşüm</a></span>
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
                        <th>Durum</th>
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
                            <input class="switch" article-id="{{$article->id}}" type="checkbox" data-on="Aktif" data-off="Pasif" data-offstyle="danger" @if($article->status==1) checked @endif data-toggle="toggle">
                        </td>
                        <td>
                            <a target="_blank" href="{{route('single',[$article->getCategory->slug,$article->slug])}}" title="Görüntüle" class="btn btn-sm btn-success"><li class="fa fa-eye"></li></a>
                            <a href="{{route('admin.makaleler.edit',$article->id)}}" title="Düzenle" class="btn btn-sm btn-primary"><li class="fa fa-pen"></li></a>
                            <a href="{{route('admin.delete.article',$article->id)}}" title="Sil" class="btn btn-sm btn-warning"><li class="fa fa-trash"></li></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
@section('css')
    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
@endsection
@section('js')
    <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
    <script>
        $(function(){
            $('.switch').change(function(){
                id = $(this)[0].getAttribute('article-id');
                statu=$(this).prop('checked');
                $.get("{{route('admin.switch')}}", {id:id,statu:statu}, function(data, status){
                    console.log(data);
                })
            })
        })
    </script>
@endsection