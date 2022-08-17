<?php

namespace App\Interfaces;

interface PersonRepositoryInterface 
{
    public function getAll();
    public function getCount();
    public function getAllWithPaginate();
    public function getById($id);
    public function delete($id);
    public function create(array $details);
    public function update($id, array $newDetails);
}