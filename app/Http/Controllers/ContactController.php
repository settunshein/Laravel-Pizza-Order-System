<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    // Redirect Contact Message List Page
    public function index()
    {
        $contacts = Contact::orderBy('created_at', 'DESC')->paginate(3);

        $contacts->appends(request()->all());
        
        return view('admin.contact.index', compact('contacts'))
        ->with('i', (request()->input('page', 1) - 1) * 3);
    }


    // Delete Contact Message
    public function delete($id)
    {
        Contact::where('id', $id)->delete();

        return back()->with('success', 'Contact Deleted Successfully');
    }
}
