<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Http\Resources\ProductResource;
use App\Models\Category;
use App\Models\Product;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

define('PRODUCTS_PER_PAGE', 200);

class ProductController extends Controller
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
        $products = Product::paginate(PRODUCTS_PER_PAGE);
        return ProductResource::collection($products);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreProductRequest $request
     * @return ProductResource
     */
    public function store(StoreProductRequest $request): ProductResource
    {
        $validated = $request->validated();
        $product = Product::create($validated);
        $category = Category::find($validated['categories']);
        $product->categories()->attach($category);
        return new ProductResource($product->getCategories());
    }

    /**
     * Display the specified resource.
     *
     * @param Product $product
     * @return ProductResource
     */
    public function show(Product $product): ProductResource
    {
        return new ProductResource($product->getCategories());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateProductRequest $request
     * @param Product $product
     * @return ProductResource
     */
    public function update(UpdateProductRequest $request, Product $product): ProductResource
    {
        $validated = $request->validated();
        $product->update($validated);
    //    dd($validated-);
        // if($validated['categories']) {
        //     $categories = Category::find($validated['categories']);
        //     $product->categories()->detach();
        //     $product->categories()->attach($categories);
        // }
        return new ProductResource($product->getCategories());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Product $product
     * @return ProductResource
     * @throws Exception
     */
    public function destroy(Product $product): ProductResource
    {
        $product->delete();
        return new ProductResource($product);
    }


    /**
     * Get meta information of products
     *
     * @return JsonResponse
     */
    public function meta(): JsonResponse
    {
        $products = Product::all();
        $latestProduct = $products->last();
        return response()->json([
            "count" => count($products),
            "last_added_product" => [
                "name" => $latestProduct->name,
                "name_ar" => $latestProduct->name_ar,
                "created_at" => $latestProduct->created_at,
                "updated_at" => $latestProduct->updated_at
            ]
        ]);

    }
}
