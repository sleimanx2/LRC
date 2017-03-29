<?php
namespace LRC\Http\Controllers\Auth;

use Illuminate\Http\Request;
use LRC\Data\Users\UserRepository;
use LRC\Services\Registrar;
use LRC\Users\User;
use LRC\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */
    use RegistersUsers;
    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';
    /**
     * @var UserRepository
     */
    private $userRepository;
    /**
     * @var Registrar
     */
    private $registrar;

    /**
     * Create a new controller instance.
     *
     * @param Registrar $registrar
     * @param UserRepository $userRepository
     */
    public function __construct(Registrar $registrar ,UserRepository $userRepository)
    {
        $this->middleware('auth');
        $this->userRepository = $userRepository;
        $this->registrar = $registrar;
    }

    /**
     * Show the application registration form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showRegistrationForm()
    {
        $roles = $this->userRepository->rolesList();

        return view('auth.register',['roles'=>$roles]);
    }


    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
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

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);
    }
}
