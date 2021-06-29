<?php

namespace App\Http\Controllers\Api\V1;

use Validator;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Hash;
use App\Http\Resources\UserCollection;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('viewAny', User::class);

        return UserCollection::make(User::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('create', User::class);

        $validator = Validator::make($request->all(), [
            'name' => ['required','string','between:2,100'],
            'email' => ['required','string','email','max:100','unique:users'],
            'password' => ['required','string','min:6'],
            'role' => ['required','string','in:ADMINISTRATOR,SELLER'],
        ]);

        if($validator->fails()){
            return response()->json($validator->errors(), 400);
        }

        $user = User::create(array_merge(
            $validator->validated(),
            ['password' => bcrypt($request->password)]
        ));

        return response()->json([
            'message' => 'User successfully registered',
            'data' => $user
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        $this->authorize('view', $user);

        return UserResource::make($user);
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
        $this->authorize('update', $user);

        $validator = Validator::make($request->all(), [
            'name' => ['required','string','between:2,100'],
            'email' => ['required','string','email','max:100','unique:users,id,'.$user->id],
            'password' => ['required','string','min:6'],
            'role' => ['required','string','in:ADMINISTRATOR,SELLER'],
        ]);

        if($validator->fails()){
            return response()->json($validator->errors(), 400);
        }

        $user->fill(array_merge(
            $validator->validated(),
            ['password' => Hash::make($request->password)]
        ))->save();

        return response()->json([
            'message' => 'User successfully updated',
            'data' => $user
        ], 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $this->authorize('delete', $user);

        $user->delete();
        return response()->json(['message' => 'User successfully deleted'], 201);
    }
}
