<?php namespace LRC\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use LRC\Data\Users\UserRepository;
use LRC\Http\Requests;
use LRC\Http\Controllers\Controller;

use Illuminate\Http\Request;
use LRC\Services\Registrar;

class UsersController extends Controller {

    private $userRepository;

    private $registrar;

    function __construct(UserRepository $userRepository, Registrar $registrar)
    {
        $this->userRepository = $userRepository;
        $this->registrar      = $registrar;
    }


    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {

        $searchQuery = Input::get('search');


        if ( !$searchQuery )
        {
            $users = $this->userRepository->getPaginated(10);
        } else
        {
            $users = $this->userRepository->searchPaginated($searchQuery, 10);
        }

        return view('users.index', ['users' => $users]);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function edit($id)
    {
        $user = $this->userRepository->findOrFail($id);

        $roles = $this->userRepository->rolesList();

        return view('users.edit', ['user' => $user,'roles'=>$roles]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int $id
     * @param Request $request
     * @return Response
     */
    public function update($id, Request $request)
    {
        $user = $this->userRepository->findOrFail($id);

        $validator = $this->registrar->validator($request->all(), ['withoutPassword' => true, 'userId' => $id]);

        if ( $validator->fails() )
        {
            $this->throwValidationException(
                $request, $validator
            );
        }

        $this->registrar->update($request->all(),$user);

        return redirect(route('users-list'))->with('success', 'First Aider '.$user->first_name.' '.$user->last_name.' updated Successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return Response
     */
    public function destroy($id)
    {

        $currentUserId = Auth::user()->id;

        $user = $this->userRepository->findOrFail($id);

        $this->registrar->destroy($id);

        if($id == $currentUserId)
        {
            return Auth::logout();
        }

        return redirect(route('users-list'))->with('success', 'First Aider '.$user->first_name.' '.$user->last_name.' deleted Successfully.');
    }

}
