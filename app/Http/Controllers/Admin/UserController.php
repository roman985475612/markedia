<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.user.index', [
            'model' => User::paginate(20),
            'title' => 'Пользователи',
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
        $request->validate([
            'name'      => 'required',
            'email'     => 'required|email|unique:users',
            'password'  => 'required|confirmed',
        ]);

        $user = User::create([
            'name'  => $request->name,
            'email' => $request->email,
        ]);

        $user->generatePassword( $request->password );

        if ($request->hasFile('thumbnail')) {
            $user->uploadFile($request->file('thumbnail'));
        }

        return redirect()->back()->with('success', 'Вы успешно добавели нового пользователя!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'email' => [
                'email',
                Rule::unique('users')->ignore($user->id),
            ],
            'thumbnail' => 'nullable|image',
        ]);

        if ( $request->name && $request->name != $user->name ) {
            $user->name = $request->name;
            $user->save();
        }

        if ( $request->email && $request->email != $user->email ) {
            $user->name = $request->email;
            $user->save();
        }

        $user->generatePassword( $request->password );

        if ( $request->hasFile('thumbnail') ) {
            $user->uploadFile($request->file('thumbnail'));
        }

        return redirect()->back()->with('success', 'Пользователь ' . $user->name . ' обновлен!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        if ($user->remove()) {
            return redirect()->back()->with('success', 'Пользователь удален!');
        }
        return redirect()->back()->with('error', 'При удалении пользователя возникла ошибка!');
    }
}
