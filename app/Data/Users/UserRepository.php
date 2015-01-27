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
    private $userModel;

    /**
     * @param User $userModel
     */
    function __construct(User $userModel)
    {
        $this->userModel = $userModel;
    }

    /**
     * It paginate users
     * @param int $limit
     * @return mixed
     */
    public function getPaginated($limit = 25)
    {
        $pagination = $this->userModel->paginate($limit);

        return $pagination;
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

        $pagination = $this->userModel
            ->select('*')
            ->where(DB::raw('concat_ws(" ",first_Name,last_Name)'), 'like', $query)
            ->paginate($limit);

        return $pagination;
    }


    /**
     * Function to find user by id
     * @param $id
     * @return \Illuminate\Support\Collection|static
     */
    public function findOrFail($id)
    {
        return $this->userModel->findOrFail($id);
    }
}