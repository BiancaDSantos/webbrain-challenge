<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $contacts = Contact::query();
      
        if ($request->has('options')) {

            $optionIds = $request->input('options');

            $contacts->whereHas('options', function($query) use ($optionIds) {
                $query->whereIn('contact_options.id', $optionIds);
            });
        }
      
        if ($request->has('name')) {
            $contacts->where('name', $request->input('name'));
        }

        return response()->json(
            $contacts->with('options')->paginate(
                request()->input('per_page', 15),
                ['*'],
                'page',
                request()->input('page', 1)
            )
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'birth_date' => 'required|date',
            'email' => 'required|string',
            'whatsApp' => 'required|string',
            'phone' => 'required|string',
            'message' => 'required|string'
        ]);

        $contact = Contact::create($request->only([
            'name',
            'birth_date',
            'email',
            'whatsApp',
            'phone',
            'message'
        ]));

        $contact->options()->attach($request->input('options'));

        return response() -> json($contact->load('options'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
