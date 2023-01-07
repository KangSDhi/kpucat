<?php

namespace App\Http\Controllers;

use App\Models\materiPokok;
use Illuminate\Http\Request;

class MateriPokokController extends Controller {

    public function __construct()
    {
        $this->middleware(['auth','statusKelasTesPpk','statusAdminCat']);
    }

    public function index() {

        $materiPokok = materiPokok::paginate(10);
        return view('ppk.materiPokok.index',[
            'materiPokok' => $materiPokok,
            'totalmateriPokok' => count(materiPokok::all())
        ]);
    }


    public function create() {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\materiPokok  $materiPokok
     * @return \Illuminate\Http\Response
     */
    public function show(materiPokok $materiPokok)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\materiPokok  $materiPokok
     * @return \Illuminate\Http\Response
     */
    public function edit(materiPokok $materiPokok)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\materiPokok  $materiPokok
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, materiPokok $materiPokok)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\materiPokok  $materiPokok
     * @return \Illuminate\Http\Response
     */
    public function destroy(materiPokok $materiPokok)
    {
        //
    }
}
