<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::paginate(5);
        return view('users.index', [
            'users' => $users,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
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
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
            'is_admin' => 'required',
        ]);

        if ($request->password == $request->confirm_password) {
            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => password_hash($request->password, PASSWORD_DEFAULT),
                'is_admin' => $request->is_admin,
            ]);
        } else {
            return redirect()->back()->with('error', 'Sorry! password do not match');
        }

        return redirect()->route('users.index')->with('success', 'User created successfully ): ');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = User::find($id);
        if ($data != NULL) {
            $this->validate($request, [
                'name' => 'required',
                'email' => 'required',
                'is_admin' => 'required',
            ]);

            $data->name = $request->name;
            $data->email = $request->email;
            $data->is_admin = $request->is_admin;
            $data->update();

            return redirect()->route('users.index')->with('success', 'Date updated successfully ): ');
        } else {
            return redirect()->back()->with('error', 'Sorry! user do not found');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = User::find($id);
        if ($data != NULL) {
            $data->delete();
            return redirect()->back()->with('success', 'Data deleted successfully ): ');
        } else {
            return redirect()->back()->with('error', 'Sorry! user not found.');
        }
    }
}
