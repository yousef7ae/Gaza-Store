<?php

namespace App\Http\Controllers\V2;

use App\Http\Controllers\Controller;
use App\Models\Contact;

class ContactController extends Controller
{
    public function create()
    {
        $contact = Contact::create([
            'email' => request('email'),
            'message' => request('message'),
        ]);

        return response()->json(['status' => true, 'message' => "success", 'data' => $contact]);

    }

}
