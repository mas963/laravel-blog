<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Page;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class PageController extends Controller
{
    public function index(){
        $pages = Page::all();
        return view('back.pages.index',compact('pages'));
    }

    public function switch(Request $request){
        $page=Page::findOrFail($request->id);
        $page->status=$request->statu=="true" ? 1 : 0;
        $page->save();
    }

    public function trashed(){
        $pages = Page::onlyTrashed()->orderBy('deleted_at','desc')->get();
        return view('back.pages.trashed',compact('pages'));
    }

    public function delete($id){
        Page::find($id)->delete();
        toastr()->success('Sayfa geri dönüşüm kutuna taşındı');
        return redirect()->route('admin.pages.index');
    }

    public function recover($id){
        Page::onlyTrashed()->find($id)->restore();
        toastr()->success('Sayfa geri çağırıldı');
        return redirect()->back();
    }

    public function hardDelete($id){
        $page = Page::onlyTrashed()->find($id);
        $imgpath = ltrim($page->image,"/");
        if(File::exists($imgpath)){
            File::delete(public_path($imgpath));
        }
        $page->forceDelete();
        toastr()->success('Sayfa başarıyla silindi');
        return redirect()->back();
    }

    public function create(){
        return view('back.pages.create');
    }

    public function update($id){
        $page=Page::findOrFail($id);
        return view('back.pages.update',compact('page'));
    }

    public function post(Request $request){
        $request->validate([
            'title'=>'min:3',
            'image'=>'required|image|mimes:jpeg,png,jpg|max:3000' 
            ]);

            $last = Page::orderBy('order','desc')->first();
            $page = new Page;
            $page->title=$request->title;
            $page->content=$request->content;
            $page->order=$last->order+1;
            $page->slug=Str::slug($request->title);

            if($request->hasFile('image')){
                $imageName=Str::slug($request->title).'.'.$request->image->getClientOriginalExtension();
                $request->image->move(public_path('uploads'),$imageName);
                $page->image='/uploads/'.$imageName;
            }
            $page->save();
            toastr()->success('Sayfa başarıyla oluşturuldu');
            return redirect()->route('admin.pages.index');
    }

    public function updatePost(Request $request, $id)
    {
        $request->validate([
           'title'=>'min:3',
           'image'=>'image|mimes:jpeg,png,jpg|max:3000' 
        ]);

        $page = Page::findOrFail($id);
        $page->title=$request->title;
        $page->content=$request->content;
        $page->slug=Str::slug($request->title);

        if($request->hasFile('image')){
            $imageName=Str::slug($request->title).'.'.$request->image->getClientOriginalExtension();
            $request->image->move(public_path('uploads'),$imageName);
            $page->image='/uploads/'.$imageName;
        }
        $page->save();
        toastr()->success('Sayfa başarıyla düzenlendi');
        return redirect()->route('admin.pages.index');
    }

    public function orders(Request $request){
        foreach($request->get('page') as $key => $order){
            Page::where('id',$order)->update(['order'=>$key]);
        }
    }
}
