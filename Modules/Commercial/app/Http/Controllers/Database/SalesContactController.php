<?php

namespace Modules\Commercial\Http\Controllers\Database;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SalesContactController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('commercial::database.salescontact.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('commercial::create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) {}

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        return view('commercial::show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('commercial::edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id) {}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id) {}


    /**
     * Search the specified resource.
     */
    public function getSearch(Request $request)
    {
        $search = $request->input('search');
        
        return $search;
    }
}
