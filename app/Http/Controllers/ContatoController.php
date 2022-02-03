<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\User;

class ContatoController extends Controller
{
    public function index()
    {

        //  return view('/welcome', ['contacts' => $contacts]);

        return view('/welcome');
    }

    public function create()
    {
        return view('contacts.create');
    }

    public function store(Request $request)
    {
        $contact = new Contact;

        $contact->name = $request->name;
        $contact->email = $request->email;
        $contact->user_id = $request->user_id;

        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $requestImage = $request->image;
            $extension = $requestImage->extension();

            $imageName = md5($requestImage->getClientOriginalName() . strtotime('now')) . "." . $extension;

            $requestImage->move(public_path('img/contacts'), $imageName);

            $contact->image = $imageName;
        }

        $user = auth()->user();
        $contact->user_id = $user->id;

        $contact->save();

        return redirect('/')->with('msg', 'Contato criado com sucesso!');
    }

    public function show($id)
    {
        $user = auth()->user($id);

        $contact = Contact::findOrFail($id);

        return view('contacts.show', ['contact' => $contact, 'user' => $user]);
    }

    public function dashboard($id)
    {

        $user = auth()->user($id);

        $search = request('search');
        if ($search) {
            $contacts = Contact::where([
                ['name', 'like', '%'.$search.'%'],
                ['user_id','like', $user->id],
            ])->get();
        } else {
            $contacts = $user->contacts;
        }
        return view('contacts.dashboard', ['contacts' => $contacts,'search' => $search]);

    }

    public function destroy($id) {

        $contact = Contact::findOrFail($id);
        $image = public_path().'/img/contacts/'.$contact->image;
        unlink($image);
        $contact->delete();

        return redirect('/contacts/dashboard/list')->with('msg', 'Contato excluido com sucesso!');
    }


    /*$contact = Contact::findOrFail($id);
        $contactOwner = User::where('id',$contact->user_id)->first()->toArray();
        return view('contacts.dashboard', ['contact' =>$contact,'contactOwner' =>$contactOwner]); */
}
