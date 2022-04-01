<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use \Illuminate\Validation\Validator;

// Models
use App\Models\Article;
use App\Models\Category;
use App\Models\Page;
use App\Models\Contact;

;

class Homepage extends Controller
{
    public function __construct()
    {
        view()->share("pages",Page::orderBy("order","ASC")->get());
        view()->share("categories", Category::inRandomOrder()->get());
    }
    public function index()
    
    {
        $data['articles'] = Article::orderBy('created_at','DESC')->paginate(2);
        $data['articles'] -> withPath(url('sayfa'));
        return view('front.homepage', $data);
    }

    public function single($category,$slug){
        $category = Category::whereSlug($category)->first() ?? abort(404);
        $article=Article::whereSlug($slug)->whereCategoryId($category->id)->first() ?? abort(404);
        $article->increment('hit');
        $data['article']=$article;
        return view('front.single', $data);
    }

    public function category($slug){
        $category = Category::whereSlug($slug)->first() ?? abort(404);
        $data['category'] = $category;
        $data['articles'] = Article::whereCategoryId($category->id)->orderBy('created_at','DESC')->paginate(1);
        return view('front.category', $data);
    }

    public function page($slug){
        $page = Page::whereSlug($slug)->first() ?? abort(403,'böyle bir sayfa bulunamadı');
        $data['page'] = $page;
        return view('front.page',$data);
    }

    public function contact(){
        return view("front.contact");
    }

    public function contactpost(Request $request){
        $request->validate([
            "name"=>"required|min:5",
            "email"=>"required|email",
            "topic"=>"required",
            "message"=>"required|min:10"
        ]);
        
        $contact = new Contact;
        $contact->name=$request->name;
        $contact->email=$request->email;
        $contact->topic=$request->topic;
        $contact->message=$request->message;
        $contact->save();
        return redirect()->route("contact")->with("success","mesajınız bize iletildi. teşekkür ederiz.");
    }
}
