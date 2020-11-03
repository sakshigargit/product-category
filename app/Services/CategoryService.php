<?php

namespace App\Services;

use App\Repositories\CategoryRepository;
use Illuminate\Foundation\Http\FormRequest;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CategoryService
 *
 * @author sakshi.garg
 */
class CategoryService 
{
    /**
     *
     * @var CategoryRepository 
     */
    protected $category;
    
    public function __construct(CategoryRepository $category)
    {
        $this->category = $category;
    }

    /**
     * This function is to retrieve the active category list from repository
     * 
     * @return array
     */
    public function getActiveCategories()
    {
        return $this->category->getActiveCategories();
    }
    
    /**
     * This function is used to get all the categories from repository
     * 
     * @return object
     */
    public function index()
    {
        return $this->category->paginateList(env('PAGINATION_LIMIT') ?? 10);
    }


    /**
     * This function is used to create new the category row through repository in the table
     * 
     * @return object
     */
    public function create(FormRequest $request)
    {
        return $this->category->create($request->all());
    }

    /**
     * This function is used to update the category row through repository in the table
     * 
     * @param int $id
     * @return object
     */
    public function update(FormRequest $request, $id)
    {
        return $this->category->update($id, $request->all());
    }

    /**
     * This function is used to delete the category row through repository from the table
     * 
     * @param int $id
     * @return object
     */
    public function delete($id)
    {
        return $this->category->delete($id);
    }
}
