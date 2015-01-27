<?php namespace LRC\Http\Controllers;

use Illuminate\Support\Facades\Input;
use LRC\Data\Contacts\ContactRepository;
use LRC\Http\Requests;
use LRC\Http\Controllers\Controller;

use Illuminate\Http\Request;
use LRC\Http\Requests\SaveContact;

class ContactsController extends Controller {

    /**
     * @var ContactRepository
     */
    private $contactRepository;

    /**
     * @param ContactRepository $contactRepository
     */
    function __construct(ContactRepository $contactRepository)
    {

        $this->contactRepository = $contactRepository;
    }


    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $searchQuery   = Input::get('search');
        $categoryQuery = Input::get('category');

        if ( !$searchQuery and !$categoryQuery )
        {
            $contacts = $this->contactRepository->getPaginated(10);
        } else
        {
            $contacts = $this->contactRepository->searchPaginated(['search' => $searchQuery, 'category' => $categoryQuery], 10);
        }

        $categories = $this->contactRepository->getCategories()->lists('name', 'id');

        return view('contacts.index', [
            'contacts'   => $contacts,
            'categories' => $categories
        ]);
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     * @internal param SaveContact $request
     */
    public function create()
    {
        $categories = $this->contactRepository->getCategories()->lists('name', 'id');

        return view('contacts.create', ['categories' => $categories]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param SaveContact $request
     * @return Response
     */
    public function store(SaveContact $request)
    {
        $this->contactRepository->store($request->all());

        return redirect()->intended(route('contacts-list'))->with('success', 'A new contact was added successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function edit($id)
    {
        $contact = $this->contactRepository->findOrFail($id);

        $categories = $this->contactRepository->getCategories()->lists('name', 'id');

        return view('contacts.edit', ['contact' => $contact, 'categories' => $categories]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int $id
     * @param SaveContact $request
     * @return Response
     */
    public function update($id,SaveContact $request)
    {
        $contact = $this->contactRepository->findOrFail($id);

        $data = $request->all();

        $this->contactRepository->update($data,$contact);

        return redirect()->intended(route('contacts-list'))->with('success', 'Then contact '.$data['name'].' was successfully updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return Response
     */
    public function destroy($id)
    {
        $contact = $this->contactRepository->findOrFail($id);

        $this->contactRepository->destroy($id);

        return redirect()->intended(route('contacts-list'))->with('success', 'Then contact '.$contact->name.' has been deleted.');


    }

}
