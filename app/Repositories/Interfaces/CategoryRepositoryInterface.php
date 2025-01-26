<?php
namespace App\Repositories\Interfaces;

interface CategoryRepositoryInterface{
    public function getall();
    public function show($id);
    public function store($data);
    public function update($id, $data);
    public function delete($id);
}