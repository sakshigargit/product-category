<?php

namespace App\Services;

use App\Repositories\ProductRepository;
use App\Repositories\CategoryRepository;
use Illuminate\Foundation\Http\FormRequest;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ProductService
 *
 * @author sakshi.garg
 */
class ProductService 
{
    /**
     * @var ProductRepository 
     */
    protected $product;
    
    /**
     * @var CategoryRepository 
     */
    protected $category;
    
    /**
     * @param ProductRepository $product
     * @param CategoryRepository $category
     */
    public function __construct(ProductRepository $product, CategoryRepository $category)
    {
        $this->product = $product;
        $this->category = $category;
    }
    
    /**
     * This function is to get all the active products
     * 
     * @param array $attributes
     * @return array
     */
    public function getActiveProducts($attributes)
    {
        $categoryId = 0;
        if (!empty($attributes['category_id'])) {
            $category = $this->category->getBySlug($attributes['category_id']);
            $categoryId = !empty($category) ? $category->id : 0;
        }
        $minPrice = (!empty($attributes['min_price']) && is_int($attributes['min_price'])) ? $attributes['min_price'] : 0;
        $maxPrice = (!empty($attributes['max_price']) && is_int($attributes['max_price'])) ? $attributes['max_price'] : 0;

        return $this->product->getActiveProducts(env('PAGINATION_LIMIT') ?? 10, $categoryId, $minPrice, $maxPrice);
    }
    
    /**
     * This function is used to get all the categories from repository
     * 
     * @return object
     */
    public function index()
    {
        return $this->product->paginateList(env('PAGINATION_LIMIT') ?? 10);
    }


    /**
     * This function is used to create new the product row through repository in the table
     * 
     * @return object
     */
    public function create(FormRequest $request)
    {
        $attributes = $request->all();
        $imageName = time().'.'.$request->image->extension();  
     
        $request->image->move(storage_path('images'), $imageName);
        $attributes['photo'] = $imageName;
        unset($attributes['image']);
        $attributes['created_by'] = auth()->user()->id;
        $attributes['updated_by'] = auth()->user()->id;
        return $this->product->create($attributes);
    }
    
    /**
     * This function is used to update the product row through repository in the table
     * 
     * @param int $id
     * @return object
     */
    public function update(FormRequest $request, $id)
    {
	$attributes = $request->all();
        if ($request->has('image')) {
            
            $imageName = time().'.'.$request->image->extension();  

            $request->image->move(storage_path('images'), $imageName);
            $attributes['photo'] = $imageName;
            unset($attributes['image']);
        }
        $attributes['updated_by'] = auth()->user()->id;
        return $this->product->update($id, $attributes);
    }
    
    public function getBySlug($slug)
    {
        return $this->product->getBySlug($slug);
    }

    /**
     * This function is used to delete the product row through repository from the table
     * 
     * @param int $id
     * @return object
     */
    public function delete($id)
    {
        return $this->product->delete($id);
    }
}
