<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\ProductResource;
use App\Models\Category;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

define('CATEGORIES_PER_PAGE', 20);

class CategoryController extends Controller
{

    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('auth:api', ['except' => ['index', 'show','meta', 'products']]);
    }


    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     */
    public function index(): AnonymousResourceCollection
    {
        $categories = Category::paginate(CATEGORIES_PER_PAGE);
        return CategoryResource::collection($categories);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreCategoryRequest $request
     * @return CategoryResource
     */
    public function store(StoreCategoryRequest $request): CategoryResource
    {
        $validated = $request->validated();
        $category = Category::create($validated);
        return new CategoryResource($category);
    }

    /**
     * Display the specified resource.
     *
     * @param Category $category
     * @return CategoryResource
     */
    public function show(Category $category): CategoryResource
    {
        return new CategoryResource($category);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateCategoryRequest $request
     * @param Category $category
     * @return CategoryResource
     */
    public function update(UpdateCategoryRequest $request, Category $category): CategoryResource
    {
        $validated = $request->validated();
        $category->update($validated);
        return new CategoryResource($category);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Category $category
     * @return CategoryResource
     * @throws Exception
     */
    public function destroy(Category $category): CategoryResource
    {
        $category->delete();
        return new CategoryResource($category);
    }


    /**
     * Display a listing of the products of this category.
     *
     * @param Category $category
     * @return ProductResource
     */
    public function products(Category $category): ProductResource
    {
        return new ProductResource($category->products);
    }


    /**
     * Get meta information of products
     *
     * @return JsonResponse
     */
    public function meta(): JsonResponse
    {
        $categories = Category::all();
        $latestCategory = $categories->last();
        return response()->json([
            "count" => count($categories),
            "last_added_product" => [
                "name" => $latestCategory->name,
                "name_ar" => $latestCategory->name_ar,
                "created_at" => $latestCategory->created_at,
                "updated_at" => $latestCategory->updated_at
            ]
        ]);

    }
}
