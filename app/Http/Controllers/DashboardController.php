<?php

namespace App\Http\Controllers;

use App\Services\CategoryService;
use App\Services\ProductService;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     *
     * @var CategoryService 
     */
    protected $categoryService;

    /**
     *
     * @var ProductService 
     */
    protected $productService;
    
    public function __construct(CategoryService $categoryService, ProductService $productService) 
    {
        $this->categoryService = $categoryService;
        $this->productService = $productService;
    }
    
    /**
     * This function is to show the landing page of an application
     * This will be accessible by non-logged in users 
     * 
     */
    public function home()
    {
        $categories = $this->categoryService->getActiveCategories();
        $products = $this->productService->getActiveProducts([]);
        return view('welcome', compact('categories', 'products'));
    }
    
    /**
     * This function is to show the landing page of an application
     * This will be accessible by non-logged in users 
     * 
     */
    public function dashboard()
    {
        return view('dashboard');
    }
    
    /**
     * This function is to show the landing page of an application
     * This will be accessible by non-logged in users 
     * 
     */
    public function productList(Request $request, string $slug)
    {
        $categories = $this->categoryService->getActiveCategories();
        $products = $this->productService->getActiveProducts(['category_id' => $slug]);
        return view('welcome', compact('categories', 'products', 'slug'));
    }
}