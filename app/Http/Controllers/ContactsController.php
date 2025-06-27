<?php

namespace App\Http\Controllers;


use App\Models\contacts;
use Illuminate\Http\Request;

class ContactsController extends Controller
{
    public function index()
    {
        return contacts::all();
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'phone' => 'required|string|unique:contacts,phone',
            'email' => 'nullable|email',
            'group' => 'nullable|string',
        ]);

        $contact = Contacts::create($validated);
        return response()->json($contact, 201);
    }

    public function show($id)
    {
        $contact = Contacts::findOrFail($id);
        return response()->json($contact);
    }

    public function update(Request $request, $id)
    {
        $contact = Contacts::findOrFail($id);

        $validated = $request->validate([
            'name' => 'sometimes|required|string',
            'phone' => 'sometimes|required|string|unique:contacts,phone,' . $contact->id,
            'email' => 'nullable|email',
            'group' => 'nullable|string',
        ]);

        $contact->update($validated);
        return response()->json($contact);
    }

    public function destroy($id)
    {
        $contact = Contacts::findOrFail($id);
        $contact->delete();

        return response()->json(['message' => 'Contact supprimé']);
    }
}

