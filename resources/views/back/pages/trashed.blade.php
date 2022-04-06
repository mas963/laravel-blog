@extends('back.layouts.master')
@section('title','Geri dönüşümdeki sayfalar')
@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">
            <strong>{{$pages->count()}}</strong> sayfa bulundu
            <span class="float-right"><a href="{{route('admin.pages.index')}}" class="btn btn-primary btn-sm">Tüm sayfalar</a></span>
        </h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Görsel</th>
                        <th>Başlık</th>
                        <th>İşlemler</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pages as $page)
                    <tr>
                        <td><img src="{{$page->image}}" width="200" alt=""></td>
                        <td>{{$page->title}}</td>
                        <td>
                            <a href="{{route('admin.recover.page',$page->id)}}" title="Kurtar" class="btn btn-sm btn-success"><li class="fa fa-undo"></li></a>
                            <a href="{{route('admin.hard.delete.page',$page->id)}}" title="Sil" class="btn btn-sm btn-danger"><li class="fa fa-times"></li></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection