<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\CompanyInfo;
use Illuminate\Http\Request;

class CompanyInfoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return CompanyInfo::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'street' => 'required|string',
            'district' => 'required|string',
            'zipCode' => 'required|string',
            'city' => 'required|string',
            'state' => 'required|string',
            'OfficeHours' => 'required|string',
            'numberPhone' => 'required|string',
            'whatsapp' => 'required|string',
            'whatsappLink' => 'required|string',
            'mapsLink' => 'required|string',
        ]);
        $CompanyInfo = CompanyInfo::create($request->all());
        return response() -> json($CompanyInfo);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return CompanyInfo::find($id);
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
