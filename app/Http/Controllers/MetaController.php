<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Models\Meta;
use App\Models\Article;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactEmail;


class MetaController extends Controller
{

    /**
     * Create a new ImagesController instance.
     *
     * @return void
     */
    // public function __construct() {
    //     $this->middleware('auth:api')->except(['index']);
    // }
    public function all()
    {
        return Meta::all();
    }
    public function allinpage($page)
    {
        return Meta::where("page", $page)->get();
    }
    public function text()
    {
        return Meta::where("type", "text")->get();
    }
    public function texta($id)
    {
        return Meta::where("id", $id)->where("type", "text")->get();
    }
    public function imagea($id)
    {
        return Meta::where("id", $id)->where("type", "image")->get();
    }
    public function imagep($page)
    {
        return Meta::where("page", $page)->where("type", "image")->get();
    }
    public function textp($page)
    {
        return Meta::where("page", $page)->where("type", "text")->get();
    }
    public function imgs()
    {
        return Meta::where("type", "image")->get();
    }

    public function store(Request $request): JsonResponse
    {
        $request->validate([
            'name' => 'required|string|min:3',
            'content' => 'required|string|min:3',
            'content_ar' => 'required|string|min:3',
            'type' => 'required|string|in:image,text'
        ]);

        $meta = Meta::firstOrNew([
            'name' => $request['name'],
        ]);

        $meta->content  = $request['content'];
        $meta->content_ar  = $request['content_ar'];
        $meta->type = $request['type'];
        $meta->save();

        return response()->json([
            "success" => true,
            "data" => $meta
        ]);
    }
    public function collected()
    {
        $artcles = Article::all()->Count();
        $products = Product::all()->Count();
        $Category = Category::all()->Count();
        $arr = array($artcles, $products, $Category);
        return $arr;
    }


    public function sendEmail(Request $request)
    {
        $data = $request->validate([
            'email' => 'required|min:3|email|string',
            'body' => 'required|min:3|string',
            'from' => 'required|min:3|string',
            'subject' => 'required|min:3|string'
        ]);

        Mail::to('info@lifecheme.com')->send(new ContactEmail($data));

        return response()->json([
            'success' => true,
            'data' => "Thanks for contacting us!"
        ]);
    }
}
