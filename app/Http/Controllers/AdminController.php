<?php

namespace App\Http\Controllers;

use App\Http\Requests\AdminRequest;
use App\Models\Admin;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $admins = User::where('type', "0")->get();
        return view('administrador.index', compact('admins'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $admin = new User();
        return view('administrador.create', compact('admin'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $admin = new User();
        $admin->type = "0";
        $admin->name = Crypt::encryptString($request->name);
        $admin->email = $request->email;
        $admin->password = Hash::make($request->password);

        if($request->hasFile('picture') && $request->file('picture')->isValid()){

            $requestImg = $request->picture;
            $extension = $requestImg->extension();

            $imgName = md5($requestImg->getClientOriginalName() . strtotime("now") . "." . $extension);

            $requestImg->move(public_path('img/profilePic'), $imgName);
            $admin->picture = $imgName;
        }

        $admin->save();
        return redirect()->route('admin.index')->with('success', true);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $admin)
    {
        $admin->name = $admin->getDecrypted($admin->name);

        return view('administrador.show', compact('admin'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $admin)
    {
        $admin->name = $admin->getDecrypted($admin->name);

        return view('administrador.edit', compact('admin'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $admin)
    {
        $data = $request->all();

        if($request->hasFile('picture') && $request->file('picture')->isValid()){

            $requestImg = $request->picture;
            $extension = $requestImg->extension();

            $imgName = md5($requestImg->getClientOriginalName() . strtotime("now") . "." . $extension);

            $requestImg->move(public_path('img/profilePic'), $imgName);
            $data['picture'] = $imgName;
        }

        $data['name'] = Crypt::encryptString($request->name);
        $admin->update($data);
        return redirect()->route('admin.index')->with('success', true);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $admin)
    {
        $admin->delete();
        return redirect('admin/');
    }
}
