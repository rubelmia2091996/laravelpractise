<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Repositories\Interfaces\TagRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TagController extends Controller
{
    protected $tagRepository;

    public function __construct(TagRepositoryInterface $tagRepositoryInterface) {
        $this->tagRepository = $tagRepositoryInterface;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tags = $this->tagRepository->getall();
        return view('tag.index', compact('tags'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
        return view('tag.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'tittle'=>'required',
        ]);
        $data['tittle'] = $request->tittle;
        $data['slug'] = Str::slug($data['tittle']);
        $tagcreation = $this->tagRepository->store($data);
        return redirect('/tags');
    }

    /**
     * Display the specified resource.
     */
    public function show(tag $tag)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(tag $tag)
    {
        return view('tag.edit', compact('tag'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, tag $tag)
    {
        $request->validate([
            'tittle'=>'required',
        ]);
        $data['tittle'] = $request->tittle;
        $data['slug'] = Str::slug($data['tittle']);
        $tagcreation = $this->tagRepository->update($tag->id, $data);
        return redirect('/tags');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(tag $tag)
    {
        $this->tagRepository->delete($tag->id);
        return redirect('/tags');
    }
}
