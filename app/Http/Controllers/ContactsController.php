<?php namespace LRC\Http\Controllers;

use Auth;
use Illuminate\Support\Facades\Input;
use LRC\Data\Contacts\ContactRepository;
use LRC\Http\Requests;
use LRC\Http\Controllers\Controller;

use Illuminate\Http\Request;
use LRC\Http\Requests\SaveContactRequest;

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
        if(!Auth::user()->can_access_admin)
            return redirect()->route('home-dashboard');

        $searchQuery   = Input::get('search');
        $categoryQuery = Input::get('category');

        if ( !$searchQuery and !$categoryQuery )
        {
            $contacts = $this->contactRepository->getPaginated(15);
        } else
        {
            $contacts = $this->contactRepository->searchPaginated(['search' => $searchQuery, 'category' => $categoryQuery], 15);
        }

        $categories = $this->contactRepository->getCategoriesList();

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
        if(!Auth::user()->can_access_admin)
            return redirect()->route('home-dashboard');

        $categories = $this->contactRepository->getCategoriesList();

        return view('contacts.create', ['categories' => $categories]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param SaveContactRequest $request
     * @return Response
     */
    public function store(SaveContactRequest $request)
    {
        if(!Auth::user()->can_access_admin)
            return redirect()->route('home-dashboard');

        $this->contactRepository->store($request->all());

        return redirect()->intended(route('contacts-list'))->with('success', 'A new contact was added successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function edit($id)
    {
        if(!Auth::user()->can_access_admin)
            return redirect()->route('home-dashboard');

        $contact = $this->contactRepository->findOrFail($id);

        $categories = $this->contactRepository->getCategoriesList();

        return view('contacts.edit', ['contact' => $contact, 'categories' => $categories]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int $id
     * @param SaveContactRequest $request
     * @return Response
     */
    public function update($id, SaveContactRequest $request)
    {
        if(!Auth::user()->can_access_admin)
            return redirect()->route('home-dashboard');

        $contact = $this->contactRepository->findOrFail($id);

        $data = $request->all();

        $this->contactRepository->update($data, $contact);

        return redirect()->intended(route('contacts-list'))->with('success', 'Contact was successfully updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return Response
     */
    public function destroy($id)
    {
        if(!Auth::user()->can_access_admin)
            return redirect()->route('home-dashboard');
        
        $contact = $this->contactRepository->findOrFail($id);

        $this->contactRepository->destroy($id);

        return redirect()->intended(route('contacts-list'))->with('success', 'Contact has been deleted.');


    }

}
