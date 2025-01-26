<?php

namespace App\Models;
use App\Models\Tag;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = ['tittle','slug','description','thumbnail','user_id','category_id'];

    public function tag(){
        return $this->belongsToMany(Tag::class, 'post_tag'); // Pivot table: post_tag
    }
    public function category(){
        return $this->belongsTo(Category::class); // Pivot table: post_tag
    }
}
