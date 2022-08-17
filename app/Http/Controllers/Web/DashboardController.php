<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Interfaces\AddressRepositoryInterface;
use App\Interfaces\PersonRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class DashboardController extends Controller
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
     * @param Request $request
     * @return View
     */
    public function index(Request $request)
    {
        $personCount = $this->personRepository->getCount();
        $personAddressCount = $this->personAddressRepository->getCount();

        return view('web.member.index', compact('personCount', 'personAddressCount'));
    }

    /**
     * @param Request $request
     * @return View|Response
     */
    public function login(Request $request)
    {
        if ($request->isMethod('POST')) {
            $auth = Auth::attempt([
                'email' => $request->input('email'),
                'password' => $request->input('password'),
            ]);

            if ($auth) {
                return redirect()->route('web.member.index');
            }

            session()->flash('form.errors', collect([
                'Hatalı e-posta veya şifre girdiniz',
            ]));
        }

        return view('web.member.login');
    }

    /**
     * @return Response
     */
    public function logout()
    {
        Auth::logout();

        return redirect(route('web.member.index'));
    }
}
