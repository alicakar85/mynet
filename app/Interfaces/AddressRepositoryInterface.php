<?php

namespace App\Interfaces;

interface AddressRepositoryInterface
{
    public function getCount();
    public function create(array $details);
    public function update($id, array $newDetails);
    public function delete($personId, array $ids);
}
