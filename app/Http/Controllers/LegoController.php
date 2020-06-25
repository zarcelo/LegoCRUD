<?php

namespace App\Http\Controllers;

use App\Lego;
use Illuminate\Http\Request;
use App\Http\Requests\LegoRequest;

class LegoController extends Controller
{
    public function index()
    {
        $legos = Lego::get();

        return $legos;
    }

    public function create()
    {
        //
    }

    public function store(LegoRequest $request)
    {
        $lego = new Lego();
        $lego->name = $request->name;
        $lego->description = $request->description;
        $lego->url = $request->url;
        $lego->type = $request->type;
        $lego->save();

        return $lego;
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(LegoRequest $request, $id)
    {
        $lego = Lego::find($id);
        $lego->name = $request->name;
        $lego->description = $request->description;
        $lego->url = $request->url;
        $lego->type = $request->type;
        $lego->save();

        return $lego;
    }

    public function destroy($id)
    {
        Lego::find($id)->delete();
    }
}
