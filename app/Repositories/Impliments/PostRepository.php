<?php
namespace App\Repositories\Impliments;

use App\Models\Post;
use App\Repositories\Interfaces\PostRepositoryInterface;

class PostRepository implements PostRepositoryInterface{
    public function getall(){
        return Post::all();
    }
    public function show($id){
        
    }
    public function store($data){
        return Post::create($data);
    }
    public function update($id, $data){
        $updatedtag = Post::findOrFail($id);
        return $updatedtag->update($data);
    }
    public function delete($id){
        $deletetag = Post::findOrFail($id);
        return $deletetag->delete();
    }
}