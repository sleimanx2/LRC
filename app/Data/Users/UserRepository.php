<?php


namespace LRC\Data\Users;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use LRC\Data\Users\User;

/**
 * Class UserRepository
 * @package LRC\Data\Users
 */
class UserRepository {

    /**
     * Variable containing User model
     * @var User
     */
    private $userModel;

    /**
     * @param User $userModel
     */
    function __construct(User $userModel)
    {
        $this->userModel = $userModel;
    }

    /**
     * It paginate users with name search
     * @param int $limit
     * @return mixed
     */
    public function findByPage($limit = 25)
    {
        $query = Input::get('search');
        if ( !$query )
        {
            $pagination = $this->userModel->paginate($limit);
        } else
        {
            $query = str_replace(" ", "%", '%' . $query . '%');

            $pagination = $this->userModel
                ->select('*')
                ->where(DB::raw('concat_ws(" ",first_Name,last_Name)'), 'like', $query)
                ->paginate($limit);
        }

        return $pagination;
    }
}