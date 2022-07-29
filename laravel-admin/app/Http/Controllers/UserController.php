<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Http\Requests\UpdateInfoRequest;
use App\Http\Requests\UpdatePasswordRequest;

class UserController extends Controller
{
    public function index()
    {
        return User::with('role')->paginate();
    }

    public function store(UserCreateRequest $request)
    {
        $user = User::create(
                    $request->only('first_name', 'last_name', 'email')
                    + ['password' => Hash::make(1234)],'role_id'
        );

        return response($user,Response::HTTP_CREATED);

    }

    public function show($id)
    {
        return User::with('role')->find($id);
    }

    public function update(UserUpdateRequest $request, $id)
    {
        $user = User::find($id);

        $user->update($request->only('first_name', 'last_name', 'email'));

        return response($user, Response::HTTP_ACCEPTED);
    }

    public function destroy($id)
    {
        User::destroy($id);

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function updateInfo(UpdateInfoRequest $request){
        $user = $request->user();

        $user->update($request->only('first_name', 'last_name', 'email'));

        return response($user, Response::HTTP_ACCEPTED);

    }

    public function updatePassword(UpdatePasswordRequest $request){
        $user = $request->user();

        $user->update([
            'password' => Hash::make($request->input('password'))
        ]);

        return response($user, Response::HTTP_ACCEPTED);

    }    

}
