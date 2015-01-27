<?php


namespace LRC\Data\Users;

use Illuminate\Support\Facades\DB;

/**
 * Class UserRepository
 * @package LRC\Data\Users
 */
class UserRepository {

    /**
     * Variable containing User model
     * @var User
     */
    private $user;

    /**
     * @param User $user
     */
    function __construct(User $user)
    {
       $this->user = $user;
    }

    /**
     * It paginate users
     * @param int $limit
     * @return mixed
     */
    public function getPaginated($limit = 25)
    {
        $users =$this->user->paginate($limit);

        return $users;
    }


    /**
     * It search for users by first name and last name paginated
     * @param $query
     * @param int $limit
     * @return mixed
     */
    public function searchPaginated($query, $limit = 25)
    {
        $query = str_replace(" ", "%", '%' . $query . '%');

        $users =$this->user
            ->select('*')
            ->where(DB::raw('concat_ws(" ",first_Name,last_Name)'), 'like', $query)
            ->paginate($limit);

        return $users;
    }


    /**
     * Function to find user by id
     * @param $id
     * @return \Illuminate\Support\Collection|static
     */
    public function findOrFail($id)
    {
        return$this->user->findOrFail($id);
    }
}