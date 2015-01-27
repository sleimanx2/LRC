<?php


namespace LRC\Data\Contacts;


/**
 * Class ContactRepository
 * @package LRC\Data\Contacts
 */
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
        $pagination = $this->contact->paginate($limit);

        return $pagination;
    }

    /**
     * Returns all contacts category
     */
    public function getCategoriesList()
    {
        return $this->contactCategory->all()->lists('name','id');
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

        $contacts = $pagination->paginate($limit);

        return $contacts;
    }


    public function store($data)
    {
        return $this->contact->create([
            'name'            => $data['name'],
            'category_id'     => $data['category_id'],
            'phone_primary'   => $data['phone_primary'],
            'phone_secondary' => $data['phone_secondary'],
            'location'        => $data['location'],
            'latitude'        => $data['latitude'],
            'longitude'       => $data['longitude']
        ]);
    }

    public function update($data, Contact $contact)
    {
        $attributes = [
            'name'            => $data['name'],
            'category_id'     => $data['category_id'],
            'phone_primary'   => $data['phone_primary'],
            'phone_secondary' => $data['phone_secondary'],
            'location'        => $data['location'],
            'latitude'        => $data['latitude'],
            'longitude'       => $data['longitude']
        ];

        $contact->fill($attributes);

        return $contact->save();

    }

    public function destroy($id)
    {
        return $this->contact->destroy($id);
    }


}