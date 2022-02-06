<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\User;
use PhpParser\Node\Expr\AssignOp\Concat;

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

    public function dashboard($id)
    {

        $user = auth()->user($id);

        $search_name = request('search_name');
        $search_email = request('search_email');


        if ($search_name || $search_email) {
            $contacts = Contact::where([
                ['name', 'like', '%'.$search_name.'%'],
                ['email', 'like', '%'.$search_email.'%'],
                ['user_id','like', $user->id],
            ])->paginate(4)->withQueryString();//paginate https://www.youtube.com/watch?v=RiOJzEGD1Vk
        } else {
            $contacts = Contact::where([
                ['user_id','like', $user->id],
            ])->paginate(4);
            //paginate https://www.youtube.com/watch?v=RiOJzEGD1Vk
            //$contacts = Contact->user::where()
            //$contacts_user = $user->contacts;
            //$contacts = $user->contacts;
           //$contacts = Contact::orderBy('name')->paginate(2);
        }
        return view('contacts.dashboard', ['contacts' => $contacts,'search_name' => $search_name]);

    }

    //Mostrar um contato em especifico
    public function show($id)
    {
        $user = auth()->user($id);

        $contact = Contact::findOrFail($id);

        return view('contacts.show', ['contact' => $contact, 'user' => $user]);
    }

    public function destroy($id) {

        $contact = Contact::findOrFail($id);
        $image = public_path().'/img/contacts/'.$contact->image;
        unlink($image);
        $contact->delete();

        return redirect('/contacts/dashboard/list')->with('msg', 'Contato excluido com sucesso!');
    }

    public function edit($id) {
        $contact = Contact::findOrFail($id);
        return view('contacts.edit', ['contact' => $contact]);
    }


    public function update(Request $request) {
        $contact = Contact::findOrFail($request->id);
        //var_dump($contact->image);

        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            if($contact->image) {
                $image = public_path().'/img/contacts/'.$contact->image;
                unlink($image);
            }

            $requestImage = $request->image;
            $extension = $requestImage->extension();
            $imageName = md5($requestImage->getClientOriginalName() . strtotime('now')) . "." . $extension;
            $requestImage->move(public_path('img/contacts'), $imageName);
            $request->image = $imageName;


        } else {
            $request->image = $contact->image;
        }
        //    var_dump($request->image);
          //  exit();
        Contact::findOrFail($request->id)->update($request->all());
        Contact::findOrFail($request->id)->update(['image'=>$request->image]);

        return redirect('/contacts/dashboard/list')->with('msg', 'Contato editado com sucesso!');
    }
    /*$contact = Contact::findOrFail($id);
        $contactOwner = User::where('id',$contact->user_id)->first()->toArray();
        return view('contacts.dashboard', ['contact' =>$contact,'contactOwner' =>$contactOwner]); */
}
