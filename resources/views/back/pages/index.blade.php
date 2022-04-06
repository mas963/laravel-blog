@extends('back.layouts.master')
@section('title','Tüm sayfalar')
@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">
            <strong>{{$pages->count()}}</strong> sayfa bulundu
            <span class="float-right"><a href="{{route('admin.trashed.page')}}" class="btn btn-warning btn-sm"><i class="fa fa-trash"></i> Geri dönüşüm</a></span>
        </h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Görsel</th>
                        <th>Başlık</th>
                        <th>Durum</th>
                        <th>İşlemler</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pages as $page)
                    <tr>
                        <td><img src="{{$page->image}}" width="200" alt=""></td>
                        <td>{{$page->title}}</td>
                        <td>
                            <input class="switch" page-id="{{$page->id}}" type="checkbox" data-on="Aktif" data-off="Pasif" data-offstyle="danger" @if($page->status==1) checked @endif data-toggle="toggle">
                        </td>
                        <td>
                            <a target="_blank" href="{{route('page',$page->slug)}}" title="Görüntüle" class="btn btn-sm btn-success"><li class="fa fa-eye"></li></a>
                            <a href="{{route('admin.pages.edit',$page->id)}}" title="Düzenle" class="btn btn-sm btn-primary"><li class="fa fa-pen"></li></a>
                            <a href="{{route('admin.delete.page',$page->id)}}" title="Sil" class="btn btn-sm btn-warning"><li class="fa fa-trash"></li></a>
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
                id = $(this)[0].getAttribute('page-id');
                statu=$(this).prop('checked');
                $.get("{{route('admin.page.switch')}}", {id:id,statu:statu}, function(data, status){});
            })
        })
    </script>
@endsection