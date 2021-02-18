<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreArticleRequest;
use App\Http\Requests\UpdateArticleRequest;
use App\Http\Resources\ArticleResource;
use App\Models\Article;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

define('ARTICLES_PER_PAGE', 20);


class ArticleController extends Controller
{

    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('auth:api', ['except' => ['index', 'show', 'meta']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     */
    public function index(): AnonymousResourceCollection
    {
        $articles = Article::paginate(ARTICLES_PER_PAGE);
        return ArticleResource::collection($articles);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreArticleRequest $request
     * @return ArticleResource
     */
    public function store(StoreArticleRequest $request): ArticleResource
    {
        $validated = $request->validated();
        $article = Article::create($validated);
        return new ArticleResource($article);
    }

    /**
     * Display the specified resource.
     *
     * @param Article $article
     * @return ArticleResource
     */
    public function show(Article $article): ArticleResource
    {
        return new ArticleResource($article);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateArticleRequest $request
     * @param Article $article
     * @return ArticleResource
     */
    public function update(UpdateArticleRequest $request, Article $article): ArticleResource
    {
        $validated = $request->validated();
        $article->update($validated);
        return new ArticleResource($article);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Article $article
     * @return ArticleResource
     * @throws Exception
     */
    public function destroy(Article $article): ArticleResource
    {
        $article->delete();
        return new ArticleResource($article);
    }

    /**
     * Get meta information of products
     *
     * @return JsonResponse
     */
    public function meta(): JsonResponse
    {
        $articles = Article::all();
        $latestArticle = $articles->last();
        return response()->json([
            "count" => count($articles),
            "last_added_product" => [
                "title" => $latestArticle->title,
                "title_ar" => $latestArticle->title_ar,
                "created_at" => $latestArticle->created_at,
                "updated_at" => $latestArticle->updated_at
            ]
        ]);

    }
}
