<?php

namespace App\Http\Controllers\UsersAdm;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;


class UsersAdmController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::get();
        //dd($users);
        return view('UsersAdm/usersAdm', ['users' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

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
        $userToChange = User::where('id', '=', $id)->get();
        //dd($userToChange);
        return view('UsersAdm/userChangeSingle', ['userToChange' => $userToChange]);
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
        $this->validate($request, User::rulesMain(), [], User::attributesMain()); 

        if ($request->email != $request->emailInitial) {
            $this->validate($request, User::rulesAdditional(), [], User::attributesMain()); 
        }

        $user = User::where('id', '=', $id)->get();
        if ($user->count() == 1) {
            $user = $user[0];
            $user->name = $request->userName;
            $user->email = $request->email;
            $user->is_admin = $request->is_admin;
            //dd($user);
            $user->save();
        }
        return redirect('/usersadm');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::where('id', '=', $id);
        if ($user->count() == 1) {
            User::destroy($id);
        }
        return redirect('/usersadm');
    }
}
