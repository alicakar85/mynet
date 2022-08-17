<?php

namespace App\Services;

use App\Interfaces\AddressRepositoryInterface;

class AddressService
{
    /**
     * @var AddressRepositoryInterface $personAddressRepository
     */
    private $personAddressRepository;

    /**
     * @var AddressRepositoryInterface $personAddressRepository
     */
    public function __construct(AddressRepositoryInterface $personAddressRepository)
    {
        $this->personAddressRepository = $personAddressRepository;
    }

    /**
     * Process data into person address
     * @param array $data
     * @param int $id
     * @return void
     */
    public function attach(array $data, int $id)
    {
        $exists_data = [];

        if (isset($data['person_address']['address']) && count($data['person_address']['address'])) {
            for ($i=0; $i < count($data['person_address']['address']); $i++) {
                $address = [];

                $address['id'] = $data['person_address']['id'][$i] ?? null;
                $address['address'] = $data['person_address']['address'][$i] ?? null;
                $address['zip_code'] = $data['person_address']['zip_codes'][$i] ??  null;
                $address['city_name'] = $data['person_address']['city_names'][$i] ?? null;
                $address['country_name'] = $data['person_address']['country_names'][$i] ?? null;
                $address['person_id'] = $id;

                if (empty($address['id'])) {
                    if ($person_address = $this->personAddressRepository->create($address)) {
                        $exists_data[] = $person_address->id;
                    }
                } else {
                    if ($this->personAddressRepository->update($address['id'], $address)) {
                        $exists_data[] = $address['id'];
                    }
                }
            }
        }

        $this->personAddressRepository->delete($id, $exists_data);
    }
}
