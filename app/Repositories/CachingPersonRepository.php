<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Cache;

class CachingPersonRepository extends PersonRepository
{
    protected $personRepository;

    /**
     * @param PersonRepository $personRepository
     */
    public function __construct(PersonRepository $personRepository)
    {
        $this->personRepository = $personRepository;
    }

    /**
     * @return Collection
     */
    public function getAllWithPaginate()
    {
        $page = request()->get('page', 1);

        return Cache::tags(['users', 'user'])->remember('users.all.' . $page, 60 * 10, function () {
            return $this->personRepository->getAllWithPaginate();
        });
    }

    /**
     * @param int $id
     *
     * @return Collection
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
     */
    public function getById($id)
    {
        return Cache::tags(['user'])->remember('user.' . $id, 60 * 10, function () use ($id) {
            return $this->personRepository->getById($id);
        });
    }

    /**
     * @param array $details
     * @return \Illuminate\Database\Eloquent\Model|$this
     */
    public function create(array $details)
    {
        Cache::tags(['users'])->flush();

        return $this->personRepository->create($details);
    }

    /**
     * @param int $id
     * @param array $newDetails
     * @return void
     */
    public function update($id, array $newDetails)
    {
        Cache::tags(['users'])->flush();
        Cache::tags(['user'])->forget('user.' . $id);

        return $this->personRepository->update($id, $newDetails);
    }

    /**
     * @param int $id
     * @return bool
     */
    public function delete($id)
    {
        Cache::tags(['users'])->flush();
        Cache::tags(['user'])->forget('user.' . $id);

        return $this->personRepository->delete($id);
    }
}
