<?php
namespace App\Repositories\Impliments;

use App\Models\Category;
use App\Repositories\Interfaces\CategoryRepositoryInterface;

class CategoryRepository implements CategoryRepositoryInterface{
    public function getall(){
        return Category::all();
    }
    public function show($id){
        
    }
    public function store($data){
        return Category::create($data);
    }
    public function update($id, $data){
        $updatedCategory = Category::findOrFail($id);
        return $updatedCategory->update($data);
    }
    public function delete($id){
        $deleteCategory = Category::findOrFail($id);
        return $deleteCategory->delete();
    }
}