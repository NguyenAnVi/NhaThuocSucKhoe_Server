<?php
namespace App\Http\Services;
use App\Models\Category;

class CategoryService
{
    public function getParent($n = 0)
    {
        return Category::where('parent_id', $n)->get();
    }
    
}