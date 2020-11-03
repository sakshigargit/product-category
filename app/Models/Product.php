<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'slug', 'description', 'qty', 'price', 'is_active', 'photo', 'category_id', 'created_by', 'updated_by'];
    
    /**
     * Get the category that product do have.
     */
    public function category()
    {
        return $this->belongsTo('App\Models\Category');
    }
    
    /**
     * Get the user that created the product.
     */
    public function createdBy()
    {
        return $this->belongsTo('App\Models\User', 'created_by');
    }
    
    /**
     * Get the user that updated the product.
     */
    public function updatedBy()
    {
        return $this->belongsTo('App\Models\User', 'updated_by');
    }
}
