<?php namespace LRC\Http\Controllers\Auth;

use LRC\Data\Users\UserRepository;
use LRC\Http\Controllers\Controller;
use Illuminate\Auth\Guard;
use LRC\Services\Registrar;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Http\Request;

class AuthController extends Controller {

    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers;
    /**
     * @var UserRepository
     */
    private $userRepository;


    /**
     * Create a new authentication controller instance.
     *
     * @param \Illuminate\Contracts\Auth\Guard|Guard $auth
     * @param \Illuminate\Contracts\Auth\Registrar|Registrar $registrar
     * @param UserRepository $userRepository
     */
    public function __construct(Guard $auth, Registrar $registrar,UserRepository $userRepository)
    {
        $this->auth      = $auth;
        $this->registrar = $registrar;
        $this->userRepository = $userRepository;

        $this->middleware('auth', ['only' => ['postRegister','getRegister','getLogout']]);

    }

    /**
     * Show the application registration form.
     *
     * @return \Illuminate\Http\Response
     */
    public function getRegister()
    {
        $roles = $this->userRepository->rolesList();

        return view('auth.register',['roles'=>$roles]);
    }

    /**
     * Handle a registration request for the application.
     *
     * @param \Illuminate\Foundation\Http\FormRequest|Request $request
     * @return \Illuminate\Http\Response
     */
    public function postRegister(Request $request)
    {

        $validator = $this->registrar->validator($request->all());

        if ($validator->fails())
        {
            $this->throwValidationException(
                $request, $validator
            );
        }

        $this->registrar->create($request->all());

        return redirect(route('users-list'))->with('success', 'First Aider Registered Successfully.');
    }


}
