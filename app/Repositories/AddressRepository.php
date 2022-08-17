<?php

namespace App\Repositories;

use App\Interfaces\AddressRepositoryInterface;
use App\Models\Address;
use Illuminate\Database\Eloquent\Model;

class AddressRepository implements AddressRepositoryInterface
{
    /**
     * @return int
     */
    public function getCount(): int
    {
        return Address::count();
    }

    /**
     * @param int $id
     */
    public function getById($id)
    {
        return Address::findOrFail($id);
    }

    /**
     * @param array $details
     * @return Model
     */
    public function create(array $details)
    {
        return Address::create($details);
    }

    /**
     * @param int $id
     * @param array $newDetails
     * @return void
     */
    public function update($id, array $newDetails)
    {
        if (! empty($newDetails['birthday'])) {
            $newDetails['birthday'] = date('Y-m-d', strtotime($newDetails['birthday']));
        }

        return Address::whereId($id)->update($newDetails);
    }

    /**
     * @param $personId
     * @param array $ids
     * @return bool
     */
    public function delete($personId, array $ids)
    {
        return Address::where('person_id', $personId)
            ->when($ids, function ($query) use ($ids) {
                $query->whereNotIn('id', $ids);
            })->delete();
    }
}
