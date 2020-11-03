<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Services\ProductService;
use App\Services\CategoryService;
use App\Http\Requests\ProductRequest;

class ProductController extends Controller
{
    /**
     * @var CategoryService 
     */
    protected $categoryService;
    
    /**
     *
     * @var ProductService 
     */
    protected $productservice;

    public function __construct(ProductService $productservice, CategoryService $categoryService)
    {
        $this->productservice = $productservice;
        $this->categoryService = $categoryService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = $this->productservice->index();
     
        return view('products.index', compact('products'));
    }
    
    public function create()
    {
        $categories = $this->categoryService->getActiveCategories();
        if (!count($categories)) {
            $error = 'Please create the category first to add any product.';
            return redirect(route('categories.create'), compact('error'));
        }
        return view('products.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\ProductRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        try {
            $this->productservice->create($request);

            return redirect('/products')->with(['status'=>'Product created successfully']);
        } catch (\Exception $e) {
            return back()->withInput($request->all())->with(['error'=>'Some error while creating the product']);
        }
    }
    
    public function show(string $slug)
    {
        $product = $this->productservice->getBySlug($slug);
        if (!$product) {
            return back()->with(['error' => 'Product no longer exists']);
        }
        return view('products.show', compact('product'));
    }
    
    public function edit(Product $product)
    {
        $categories = $this->categoryService->getActiveCategories();
        return view('products.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\ProductRequest  $request
     * @param  \App\Models\Product $product
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, Product $product)
    {
        try {
            $this->productservice->update($request, $product->id);

            return redirect('/products')->with(['status'=>'Product updated successfully']);
        } catch (\Exception $e) {
            return back()->withInput($request->all())->with(['error'=>'Some error while creating the product']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $this->productservice->delete($product->id);

        return back()->with(['status'=>'Product deleted successfully']);
    }
}
