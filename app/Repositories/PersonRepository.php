<?php

namespace App\Repositories;

use App\Interfaces\PersonRepositoryInterface;
use App\Models\Person;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class PersonRepository implements PersonRepositoryInterface
{
    /**
     * @return Collection|Person[]
     */
    public function getAll()
    {
        return Person::all();
    }

    /**
     * @return int
     */
    public function getCount(): int
    {
        return Person::count();
    }

    /**
     * @return Collection
     */
    public function getAllWithPaginate()
    {
        return Person::latest()->paginate(5);
    }

    /**
     * @param array $details
     * @return Model|$this
     */
    public function create(array $details)
    {
        if (! empty($details['birthday'])) {
            $details['birthday'] = date('Y-m-d', strtotime($details['birthday']));
        }

        return Person::create($details);
    }

    /**
     * @param int $id
     * @return Collection
     * @throws ModelNotFoundException
     */
    public function getById($id)
    {
        return Person::findOrFail($id);
    }

    /**
     * @param int $id
     * @param array $newDetails
     * @return Model|$this
     */
    public function update($id, array $newDetails)
    {
        if (! empty($newDetails['birthday'])) {
            $newDetails['birthday'] = date('Y-m-d', strtotime($newDetails['birthday']));
        }

        Person::whereId($id)->update($newDetails);

        return Person::find($id);
    }

    /**
     * @param int $id
     * @return bool
     */
    public function delete($id)
    {
        return Person::destroy($id);
    }
}
