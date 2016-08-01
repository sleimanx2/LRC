<?php
namespace LRC\Http\Controllers\Auth;

use LRC\Data\Users\User;
use LRC\Data\Users\UserRepository;
use Validator;
use LRC\Services\Registrar;
use LRC\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

class AuthController extends Controller
{
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
    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
    * @var UserRepository
    */
    private $userRepository;

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */

    public function __construct(Registrar $registrar, UserRepository $userRepository)
    {
        $this->registrar = $registrar;
        $this->userRepository = $userRepository;

        $this->middleware($this->guestMiddleware(), ['except' => ['logout','showRegistrationForm','register']]);
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
}
