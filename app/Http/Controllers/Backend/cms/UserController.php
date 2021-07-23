<?php

namespace App\Http\Controllers\Backend\cms;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::orderBy('type_user','asc')->withTrashed()->paginate(25);

        return response()->json([
            'message' => 'success',
            'data' => $users,
            'pagination' => [
                'total' => $users->total(),
                'per_page' => $users->perPage(),
                'current_page' => $users->currentPage(),
                'last_page' => $users->lastPage(),
                'from' => $users->firstItem(),
                'to' => $users->lastItem()
            ],
        ], 200);
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
            'name' => 'required',
            'email' => 'required|unique:users|email',
            'type_user' => 'required',
            'password' => 'required', //confirmed
        ]);

        $request['rol_id'] = 1;
        $request['password'] = Hash::make($request->password);
        $user = User::create($request->all());

        return response()->json([
            'message' => 'success',
            'data' => $user,
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return response()->json([
            'message' => 'success',
            'data' => $user
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        if(isset($request->password) != ""){
            $request['password'] = Hash::make($request->password);
        }else{
            $request['password'] = $user->password;
        }
        
        $user->fill($request->all());
        $message = 'change';

        if($user->isDirty()){
            $message = 'success';
            $user->save();
        }

        return response()->json([
            'message' => $message,
            'data' => $user
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();

        return response()->json([
            'message' => 'success',
            'data' => $user,
        ], 200);
    }
}
