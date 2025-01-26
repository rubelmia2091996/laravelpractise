<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Repositories\Interfaces\CategoryRepositoryInterface;
use illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    protected $categoryRepository;
    public function __construct( CategoryRepositoryInterface $categoryRepositoryInterface){
        $this->categoryRepository = $categoryRepositoryInterface;
    }
    public function index()
    {
        $categories = $this->categoryRepository->getall();
        return view('category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            "name"=> 'required',
        ]);
        $data['name'] = $request->name;
        $data['slug'] = Str::slug($request->name);
        $this->categoryRepository->store($data);
        return redirect('/categories');
    }

    /**
     * Display the specified resource.
     */
    public function show(category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(category $category)
    {
        return view('category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, category $category)
    {
        $request->validate([
            "name"=> 'required',
        ]);
        $data['name'] = $request->name;
        $data['slug'] = Str::slug($request->name);
        $this->categoryRepository->update($category->id, $data);
        return redirect('/categories');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(category $category)
    {
        $this->categoryRepository->delete($category->id);
        return redirect('/categories');
    }
}
