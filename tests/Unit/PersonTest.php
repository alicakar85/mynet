<?php

namespace Tests\Unit;

use App\Repositories\PersonRepository;
use Tests\TestCase;

class PersonTest extends TestCase
{
    /**
     * @var PersonRepository $personRepository
     */
    protected $personRepository;

    /**
     * @var App\Models\Person
     */
    public $person;

    public function setUp(): void
    {
        parent::setUp();

        $this->personRepository = new PersonRepository;
    }

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testCreate()
    {
        $this->createPerson();
        $this->updatePerson();
        $this->deletePerson();
    }

    /**
     * Testing create person
     *
     * @return void
     */
    public function createPerson()
    {
        $data = [
            'name' => 'Mynet Test Data',
            'birthday' => '1985-06-03',
            'gender' => '1',
        ];

        $this->person = $this->personRepository->create($data);

        $this->assertEquals($data['name'], $this->person->name);
        $this->assertEquals($data['birthday'], $this->person->birthday->format('Y-m-d'));
        $this->assertEquals($data['gender'], $this->person->gender);
    }

    /**
     * Testing update person
     *
     * @return void
     */
    public function updatePerson()
    {
        $newDetails = [
            'name' => 'My Net Test Data',
            'gender' => '2',
        ];

        $this->person = $this->personRepository->update($this->person->id, $newDetails);

        $this->assertEquals($newDetails['name'], $this->person->name);
        $this->assertEquals($newDetails['gender'], $this->person->gender);
    }

    /**
     * Testing delete person
     *
     * @return void
     */
    public function deletePerson()
    {
        $result = $this->personRepository->delete($this->person->id);

        $this->assertEquals(true, $result);
    }
}
