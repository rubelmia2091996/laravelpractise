<?php
namespace App\Repositories\Interfaces;

interface TagRepositoryInterface{
    public function getall();
    public function show($id);
    public function store($data);
    public function update($id, $data);
    public function delete($id);
}