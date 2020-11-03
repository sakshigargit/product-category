<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'slug', 'is_active'];
    
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
