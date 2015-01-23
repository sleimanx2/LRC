<?php namespace LRC\Http\Controllers\Auth;

use LRC\Http\Controllers\Controller;
use Illuminate\Auth\Guard;
use Illuminate\Contracts\Auth\Registrar;
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
     * Create a new authentication controller instance.
     *
     * @param \Illuminate\Contracts\Auth\Guard|Guard $auth
     * @param \Illuminate\Contracts\Auth\Registrar|Registrar $registrar
     */
    public function __construct(Guard $auth, Registrar $registrar)
    {
        $this->auth      = $auth;
        $this->registrar = $registrar;

        $this->middleware('auth', ['only' => ['postRegister','getRegister','getLogout']]);

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

        return redirect(route('users-list'))->with('success', 'First Aider Registered Successfully.');;
    }


}
