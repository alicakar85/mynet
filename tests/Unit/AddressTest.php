<?php

namespace Tests\Unit;

use App\Models\Address;
use App\Repositories\AddressRepository;
use Tests\TestCase;

class AddressTest extends TestCase
{
    /**
     * @var AddressRepository $addressRepository
     */
    protected $addressRepository;

    /**
     * @var Address
     */
    public $address;

    public function setUp(): void
    {
        parent::setUp();

        $this->addressRepository = new AddressRepository();
    }

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testCreate()
    {
        $this->createAddress();
        $this->updateAddress();
        $this->deleteAddress();
    }

    /**
     * Testing create address
     * @return void
     */
    public function createAddress()
    {
        $data = [
            'person_id' => '2',
            'address' => 'test adresi',
            'zip_code' => '11111',
            'city_name' => 'İstanbul',
            'country_name' => 'Türkiye',
        ];

        $this->address = $this->addressRepository->create($data);

        $this->assertEquals($data['person_id'], $this->address->person_id);
        $this->assertEquals($data['address'], $this->address->address);
        $this->assertEquals($data['zip_code'], $this->address->zip_code);
        $this->assertEquals($data['city_name'], $this->address->city_name);
        $this->assertEquals($data['country_name'], $this->address->country_name);
    }

    /**
     * Testing update address
     * @return void
     */
    public function updateAddress()
    {
        $data = [
            'person_id' => '2',
            'address' => 'test adresi',
            'zip_code' => '22222',
            'city_name' => 'Ankara',
            'country_name' => 'Türkiye',
        ];

        $this->addressRepository->update($this->address->id, $data);
        $this->address = $this->addressRepository->getById($this->address->id);
        $this->assertEquals($data['city_name'], $this->address->city_name);
        $this->assertEquals($data['zip_code'], $this->address->zip_code);
    }

    /**
     * Testing delete address
     * @return void
     */
    public function deleteAddress()
    {
        $result = $this->addressRepository->delete($this->address->person_id,array(1,3));

        $this->assertEquals(true, $result);
    }
}
