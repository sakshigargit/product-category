<?php

namespace App\Repositories;

use App\Models\Category;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CategoryRepository
 *
 * @author sakshi.garg
 */
class CategoryRepository 
{
  
    protected $category;

    public function __construct(Category $category)
    {
      $this->category = $category;
    }
    
    /**
     * This function is to get all the active categories
     * 
     * @return array
     */
    public function getActiveCategories()
    {
      return $this->category->where('is_active', 1)->get();
    }
    
    /**
     * This function is to get the category by slug
     * 
     * 
     * @param string $slug
     * @return object
     */
    public function getBySlug($slug)
    {
      return $this->category->where('is_active', 1)->where('slug', $slug)->first();
    }
    
    public function paginateList($limit)
    {
        return $this->category->latest()->paginate($limit);
    }
    
    /**
     * Fetch all categories for admin user
     * 
     * @return array
     */
    public function all()
    {
        return $this->category->all();
    }
    
    
    /**
     * Create the category
     * 
     * @param array $attributes
     * @return array
     */
    public function create($attributes)
    {
        return $this->category->create($attributes);
    }
    
    /**
     * Fetch the category using Id
     * 
     * @param int $id
     * @return object
     */
    public function find($id)
    {
        return $this->category->find($id);
    }

    /**
     * Update the category using Id
     * 
     * @param int $id
     * @return object
     */
    public function update($id, array $attributes)
    {
        return $this->category->find($id)->update($attributes);
    }


    /**
     * Delete the category using Id
     * 
     * @param int $id
     * @return object
     */
    public function delete($id)
    {
        return $this->category->find($id)->delete();
    }
}
