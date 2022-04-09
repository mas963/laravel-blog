<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use \Illuminate\Validation\Validator;
use Illuminate\Support\Facades\Mail;

// Models
use App\Models\Article;
use App\Models\Category;
use App\Models\Page;
use App\Models\Contact;
use App\Models\Config;

class Homepage extends Controller
{
    public function __construct(){
        if (Config::find(1)->active == 0) {
            return redirect()->to('aktif-degil')->send();
        }
        view()->share("pages",Page::where('status',1)->orderBy("order","ASC")->get());
        view()->share("categories", Category::where('status',1)->inRandomOrder()->get());
        view()->share('config',Config::find(1));
    }

    public function index(){
        $data['articles'] = Article::with('getCategory')->where('status',1)->whereHas('getCategory',function($query){
            $query->where('status',1);
        })->orderBy('created_at','DESC')->paginate(3);
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
        $data['articles'] = Article::where('category_id',$category->id)->where('status',1)->orderBy('created_at','DESC')->paginate(1);
        return view('front.category', $data);
    }

    public function page($slug){
        $page = Page::where('status',1)->whereSlug($slug)->first() ?? abort(403,'böyle bir sayfa bulunamadı');
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

        Mail::send([],[], function($message) use($request){
            $message->from('iletisim@blogsitesi.com','Blog sitesi');
            $message->to('masendgj7@gmail.com');
            $message->setBody('Mesajı gönderen: '.$request->name.'<br>
            Mesajı gönderen mail: '.$request->email.'<br>
            Mesaj konusu: '.$request->topic.'<br>
            Mesaj: '.$request->message.'<br><br>
            Mesaj gönderilme tarihi: '.now(),'text/html');
            $message->subject($request->name. ' iletişimden mesaj gönderildi');
        });
        
        $contact = new Contact;
        $contact->name=$request->name;
        $contact->email=$request->email;
        $contact->topic=$request->topic;
        $contact->message=$request->message;
        $contact->save();
        return redirect()->route("contact")->with("success","mesajınız bize iletildi. teşekkür ederiz.");
    }
}
