<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

define('RESULTS_PER_PAGE', 20);


class SearchController extends Controller
{
    /**
     * Search products by search term
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function products(Request $request): JsonResponse
    {
        $products = Product::query()
            ->where('name', 'LIKE', "%{$request['searchTerm']}%")
            ->orWhere('name_ar', 'LIKE', "%{$request['searchTerm']}%")
            ->orWhere('description', 'LIKE', "%{$request['searchTerm']}%")
            ->orWhere('description_ar', 'LIKE', "%{$request['searchTerm']}%")
            ->paginate(RESULTS_PER_PAGE);

        return response()->json($products);
    }


    /**
     * Search categories by search term
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function categories(Request $request): JsonResponse
    {
        $categories = Category::query()
            ->where('name', 'LIKE', "%{$request['searchTerm']}%")
            ->orWhere('name_ar', 'LIKE', "%{$request['searchTerm']}%")
            ->orWhere('description', 'LIKE', "%{$request['searchTerm']}%")
            ->orWhere('description_ar', 'LIKE', "%{$request['searchTerm']}%")
            ->paginate(RESULTS_PER_PAGE);

        return response()->json($categories);
    }


    /**
     *
     * Search articles by search term
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function articles(Request $request): JsonResponse
    {
        $articles = Article::query()
            ->where('title', 'LIKE', "%{$request['searchTerm']}%")
            ->orWhere('title_ar', 'LIKE', "%{$request['searchTerm']}%")
            ->orWhere('content', 'LIKE', "%{$request['searchTerm']}%")
            ->orWhere('content_ar', 'LIKE', "%{$request['searchTerm']}%")
            ->paginate(RESULTS_PER_PAGE);

        return response()->json($articles);
    }

}
