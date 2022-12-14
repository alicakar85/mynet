<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Interfaces\AddressRepositoryInterface;
use App\Interfaces\PersonRepositoryInterface;
use App\Services\AddressService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;

class PersonController extends Controller
{
    /**
     * @var PersonRepositoryInterface $personRepository
     */
    private $personRepository;

    /**
     * @var AddressRepositoryInterface $personAddressRepositoryy
     */
    private $personAddressRepository;

    /**
     * @var PersonRepositoryInterface $personRepository
     * @var AddressRepositoryInterface $personAddressRepository
     */
    public function __construct(PersonRepositoryInterface  $personRepository,
                                AddressRepositoryInterface $personAddressRepository)
    {
        $this->personRepository = $personRepository;
        $this->personAddressRepository = $personAddressRepository;
    }

    /**
    * @return View
    */
    public function index(Request $request)
    {
        $list = $this->personRepository->getAllWithPaginate();

        return view('web.person.index', compact('list'));
    }

    /**
     * @return View
     */
    public function create()
    {
        return view('web.person.create');
    }

    /**
     * @param Request $request
     * @param AddressService $addressService
     * @return Response
     */
    public function store(Request $request, AddressService $addressService)
    {
        $request->validate([
            'name' => 'required|max:255',
            'birthday' => 'required|date_format:d.m.Y',
            'gender' => 'required',
        ]);

        try {
            $person = $this->personRepository->create($request->only([
                'name',
                'birthday',
                'gender'
            ]));

            $addressService->attach($request->only([
                'person_address'
            ]), $person->id);

            session()->flash('form.success', collect([
                'Yeni ki??i ba??ar??yla eklendi',
            ]));

            return redirect()->route('web.person.index');
        } catch (Exception $e) {
            session()->flash('form.errors', collect([
                'Ki??i ekleme i??leminde hata olu??tu',
            ]));

            return redirect()->route('web.person.create')
                ->withInput();
        }
    }

    /**
    * @param int $id
    * @return View
    */
    public function edit($id)
    {
        $person = $this->personRepository->getById($id);

        return view('web.person.edit', compact('person'));
    }

    /**
    * @param Request $request
    * @param AddressService $addressService
    * @param int $id
    * @return Response
    */
    public function update(Request $request, AddressService $addressService, $id)
    {
        $request->validate([
            'name' => 'required|max:255',
            'birthday' => 'required|date_format:d.m.Y',
            'gender' => 'required',
        ]);

        if (! $this->personRepository->getById($id)) {
            session()->flash('form.errors', collect([
                '????lem yapt??????n??z ki??i bilgisi bulunamad??',
            ]));

            return redirect()->route('web.person.index');
        }

        try {
            $this->personRepository->update($id, $request->only([
                'name',
                'birthday',
                'gender'
            ]));

            $addressService->attach($request->only([
                'person_address'
            ]), $id);

            session()->flash('form.success', collect([
                'Ki??i d??zenlemesi ba??ar??yla ger??ekle??ti',
            ]));

            return redirect()->route('web.person.index');
        } catch (Exception $e) {
            session()->flash('form.errors', collect([
                'Ki??i d??zenleme i??leminde hata olu??tu',
            ]));

            return redirect()->route('web.person.edit', [
                    'id' => $id
                ])
                ->withInput();
        }
    }

    /**
    * @param  int  $id
    * @return Response
    */
    public function destroy($id)
    {
        try {
            $this->personAddressRepository->delete($id, []);
            $this->personRepository->delete($id);

            session()->flash('form.success', collect([
                'Ki??i silme i??lemi ba??ar??yla ger??ekle??ti',
            ]));
        } catch (Exception $e) {
            session()->flash('form.errors', collect([
                'Ki??i silme i??leminde hata olu??tu',
            ]));
        }

        return redirect()->route('web.person.index');
    }
}
