<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Tag;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Repositories\Interfaces\PostRepositoryInterface;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    protected $postRepository;
    public function __construct(PostRepositoryInterface $PostRepositoryInterface){
        $this->postRepository = $PostRepositoryInterface;
    }
    
    public function index()
    {
        $posts = $this->postRepository->getall();
        return view('post.index', compact('posts'));
    }
    public function create()
    { 
        $tags = Tag::all();
        $categories = Category::all();
        return view('post.create',compact('tags','categories'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'tittle'=> 'required|string',
            'description'=> 'required|string',
            'thumbnail'=> 'required|mimes:jpeg,jpg,png',
            'category'=> 'required|exists:categories,id',
            'tags'=> 'required|array',
        ]);
        if($request->hasFile('thumbnail')){
            $thumb = $request->file('thumbnail');
            $thumbnailPath = $thumb->store('thumbnail','public');
        }
        $data['tittle'] = $request->tittle;
        $data['slug'] = Str::slug($data['tittle']);
        $data['description'] = $request->description;
        $data['thumbnail'] = $thumbnailPath;
        $data['category_id'] = $request->category;
        $data['user_id'] = auth()->user()->id;
        $post = $this->postRepository->store($data);
        $post->tag()->attach($request->tags);
        return redirect('/posts');

    }
    public function show(post $post)
    {
    }
    public function edit(post $post)
    {
        $tags = Tag::all();
        $categories = Category::all();
        return view('post.edit',compact('tags','categories','post'));
    }
    
    public function update(Request $request, $id)
    {
        $request->validate([
            'tittle' => 'required|string|max:255',
            'description' => 'required|string',
            'thumbnail' => 'nullable|mimes:jpeg,jpg,png|max:2048',
            'category' => 'required|exists:categories,id',
            'tags' => 'required|array',
            'tags.*' => 'exists:tags,id'
        ]);
        $post = Post::findOrFail($id);
        $post->tittle = $request->input('tittle');
        $post->description = $request->input('description');
        $post->category_id = $request->input('category');
        $post->user_id = auth()->id(); 
        if ($request->hasFile('thumbnail')) {
            if ($post->thumbnail && Storage::exists($post->thumbnail)) {
                Storage::delete($post->thumbnail);
            }
            $thumb = $request->file('thumbnail');
            $thumbnailPath = $thumb->store('thumbnail','public');
            $post->thumbnail = $thumbnailPath;
        }
        $post->save();
        $post->tag()->sync($request->input('tags'));
        return redirect()->route('posts.index')->with('success', 'Post updated successfully!');
    }
    public function destroy(post $post)
    {
    }
}
