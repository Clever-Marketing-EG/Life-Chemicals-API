<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ImagesController extends Controller
{
    /**
     * Create a new ImagesController instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('auth:api');
    }


    /**
     * Save product image
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function products(Request $request): JsonResponse
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'name' => 'required|string|min:3'
        ]);
        $imageName = $request->name.'_'.time().'.'.$request->image->extension();
        $request->image->storeAs('public/products_images', $imageName);
        return response()->json([
            "success" => true,
            'image_url' => asset('storage/products_images/'.$imageName)
        ]);
    }


    /**
     * Save category image
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function categories(Request $request): JsonResponse
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'name' => 'required|string|min:3'
        ]);
        $imageName = $request->name.'_'.time().'.'.$request->image->extension();
        $request->image->storeAs('public/categories_images', $imageName);
        return response()->json([
            "success" => true,
            'image_url' => asset('storage/categories_images/'.$imageName)
        ]);
    }


    /**
     * Save Article image
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function articles(Request $request): JsonResponse
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'name' => 'required|string|min:3'
        ]);
        $imageName = $request->name.'_'.time().'.'.$request->image->extension();
        $request->image->storeAs('public/articles_images', $imageName);
        return response()->json([
            "success" => true,
            'image_url' => asset('storage/articles_images/'.$imageName)
        ]);
    }
    /**
     * Save Meta image
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function Metas(Request $request): JsonResponse
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'name' => 'required|string|min:3'
        ]);
        $imageName = $request->name.'_'.time().'.'.$request->image->extension();
        $request->image->storeAs('public/metas_images', $imageName);
        return response()->json([
            "success" => true,
            'image_url' => asset('storage/metas_images/'.$imageName)
        ]);
    }

}
