<?php


namespace LRC\Data\Contacts;


/**
 * Class ContactRepository
 * @package LRC\Data\Contacts
 */
use Illuminate\Support\Facades\DB;

/**
 * Class ContactRepository
 * @package LRC\Data\Contacts
 */
class ContactRepository {

    /**
     * @var Contact
     */
    private $contact;
    /**
     * @var ContactCategory
     */
    private $contactCategory;

    /**
     * @param Contact $contact
     * @param ContactCategory $contactCategory
     */
    function __construct(Contact $contact, ContactCategory $contactCategory)
    {
        $this->contact = $contact;

        $this->contactCategory = $contactCategory;
    }


    /**
     * Function to find user by id
     * @param $id
     * @return \Illuminate\Support\Collection|static
     */
    public function findOrFail($id)
    {
        return $this->contact->findOrFail($id);
    }

    /**
     * It paginate contacts
     * @param int $limit
     * @return mixed
     */
    public function getPaginated($limit = 25)
    {
        $pagination = $this->contact->with('category')->paginate($limit);

        return $pagination;
    }

    /**
     * Returns all contacts category
     */
    public function getCategoriesList()
    {
        return $this->contactCategory->all()->pluck('name','id');
    }

    /**
     * Returns all contacts category
     */
    public function getBloodBanksList()
    {

        $list = $this->contact->whereHas('category',function($q){

            $q->where('serves_blood','=',1);

        })->orderBy('name')->pluck('name','id');

        return $list;
    }

    /**
     * get the list of all hospitals
     *
     * @return array
     */
    public function getHospitalsList()
    {

        $list = $this->contact->whereHas('category',function($q){

            $q->where('is_hospital','=',1);

        })->orderBy('name')->pluck('name','id');

        return $list;
    }

    /**
     * find the nearest hospital based on the original location
     *
     */
    public function findBestMatch(array $options = ['latitude' => null, 'logitude' => null, 'limit' => 25])
    {
        $contacts = $this->contact
            ->select('*', DB::raw('
            ( 6371 * acos( cos( radians(' . $options['latitude'] . ') ) * cos( radians(latitude) ) * cos( radians(longitude) - radians(' . $options['longitude'] . ')) + sin( radians(' . $options['latitude'] . ') ) * sin( radians(latitude) ) )) AS distance
            '))
            ->whereHas('category',function($q){

                $q->where('is_hospital','=',1);

            })
            ->orderBy('distance')
            ->limit($options['limit'])
            ->get();

        return $contacts;

    }


    /**
     * Search for contact by name and category id / Paginated
     * @param array $query
     * @param int $limit
     * @return mixed
     */
    public function searchPaginated(array $query = ['search' => null, 'category' => null], $limit = 25)
    {
        $pagination = $this->contact->select('*');

        if ( $query['search'] )
        {
            $nameQuery = str_replace(" ", "%", '%' . $query['search'] . '%');

            $pagination->where('name', 'like', $nameQuery);
        }

        if ( $query['category'] )
        {
            $categoryQuery = $query['category'];

            $pagination->where('category_id', '=', $categoryQuery);

        }

        $pagination->with('category');

        $contacts = $pagination->paginate($limit);

        return $contacts;
    }


    public function store($data)
    {
        return $this->contact->create([
            'name'            => $data['name'],
            'nickname'        => $data['nickname'],
            'phone_numbers'   => $data['phone_numbers'],
            'ambulances'      => $data['ambulances'],
            'sector'          => $data['sector'],
            'favorite'        => isset($data['favorite']) ? $data['favorite'] : 0,
            'location'        => $data['location'],
            'latitude'        => $data['latitude'],
            'longitude'       => $data['longitude'],
            'category_id'     => $data['category_id']
        ]);
    }

    public function update($data, Contact $contact)
    {
        $attributes = [
            'name'            => $data['name'],
            'nickname'        => $data['nickname'],
            'phone_numbers'   => $data['phone_numbers'],
            'ambulances'      => $data['ambulances'],
            'sector'          => $data['sector'],
            'favorite'        => isset($data['favorite']) ? $data['favorite'] : 0,
            'location'        => $data['location'],
            'latitude'        => $data['latitude'],
            'longitude'       => $data['longitude'],
            'category_id'     => $data['category_id']
        ];

        $contact->fill($attributes);

        return $contact->save();

    }

    public function destroy($id)
    {
        return $this->contact->destroy($id);
    }


}
