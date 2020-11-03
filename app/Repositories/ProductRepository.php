<?php

namespace App\Repositories;

use App\Models\Product;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ProductRepository
 *
 * @author sakshi.garg
 */
class ProductRepository 
{
  
    protected $product;

    public function __construct(Product $product)
    {
        $this->product = $product;
    }
    
    /**
     * This function is to get all the active categories
     * 
     * @return array
     */
    public function getActiveProducts($limit, $category, $minPrice = 0, $maxPrice = 0)
    {
        $productQuery = $this->product->where('is_active', 1);
        if ($category) {
            $productQuery->where('category_id', $category);
        }
        if ($minPrice) {
            $productQuery->where('price', '>=', $minPrice);
        }
        if ($maxPrice) {
            $productQuery->where('price', '<', $maxPrice);
        }
        return $productQuery->latest()->paginate($limit);
    }
    
    /**
     * This function is to get the product by slug
     * 
     * 
     * @param string $slug
     * @return object
     */
    public function getBySlug($slug)
    {
      return $this->product->where('is_active', 1)->where('slug', $slug)->first();
    }
    
    public function paginateList($limit)
    {
        return $this->product->latest()->paginate($limit);
    }
    
    
    /**
     * Fetch all categories for admin user
     * 
     * @return array
     */
    public function all()
    {
        return $this->product->all();
    }
    
    /**
     * Create the product
     * 
     * @param array $attributes
     * @return array
     */
    public function create($attributes)
    {
        return $this->product->create($attributes);
    }
    
    /**
     * Fetch the product using Id
     * 
     * @param int $id
     * @return object
     */
    public function find($id)
    {
        return $this->product->find($id);
    }

    /**
     * Update the product using Id
     * 
     * @param int $id
     * @return object
     */
    public function update($id, array $attributes)
    {
        return $this->product->find($id)->update($attributes);
    }


    /**
     * Delete the product using Id
     * 
     * @param int $id
     * @return object
     */
    public function delete($id)
    {
        return $this->product->find($id)->delete();
    }
}
