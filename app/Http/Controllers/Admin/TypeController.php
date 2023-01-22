<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $types = Type::all();
        return view('admin.types.index', compact('types'));
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());    
        $data = $request->validate([
            'name' => ['required', 'unique:types']
        ]);
        $data['slug'] = Str::slug($data['name'], '-');
        $type = Type::create($data);

        return redirect()->back()->with('message', "$type->name was added");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Type $type)
    {

        $types = Type::all();
        return view('admin.types.show', compact('type', 'types'));
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Type $type)
    {
        $data = $request->validate([
            'name' => ['required', 'unique:types']
        ]);
        $data['slug'] = Str::slug($data['name'], '-');
        $type->update($data);

        return redirect()->back()->with('message', "$type->name was updated");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Type $type)
    {
        // var_dump('type');
        // dd($type->name);
        $type->delete();
        return redirect()->back()->with('message', "$type->name was deleted");
    }
}
