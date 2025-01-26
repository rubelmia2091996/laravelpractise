<?php
namespace App\Repositories\Impliments;

use App\Models\Tag;
use App\Repositories\Interfaces\TagRepositoryInterface;

class TagRepository implements TagRepositoryInterface{
    // protected $tag;
    // public function __constructor(Tag $tags){
    //     $this->tag = $tags;
    // }
    public function getall(){
        return Tag::all();
    }
    public function show($id){
        
    }
    public function store($data){
        return Tag::create($data);
    }
    public function update($id, $data){
        $updatedtag = Tag::findOrFail($id);
        return $updatedtag->update($data);
    }
    public function delete($id){
        $deletetag = Tag::findOrFail($id);
        return $deletetag->delete();
    }
}