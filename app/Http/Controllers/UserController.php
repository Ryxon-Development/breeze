<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
class UserController extends Controller
{
    public function generateApiToken(User $user)
    {
        $user->api_token = $user->createToken('api_token')->plainTextToken;;
        $user->save();
        return response()->json([
            'token' => $user->api_token,
        ], 200);
    }

    public function revokeApiToken(User $user)
    {
        //remove token from personal_access_tokens table
        $user->tokens()->delete();
        $user->api_token = null;
        $user->save();
        return response()->json([
            'message' => 'Token revoked!',
        ], 200);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //get all users and pass them to the view
        $users = User::all();
        return view('users.index', ['users' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //save the new user
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = $request->password;
        $user->save();

        return redirect()->route('users.index')->with('message', 'User created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //get current users and pass them to the view
        $user = User::find($id);
        return view('users.edit', ['user' => $user]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {



        //update the user
        $user = User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;

        //if password is not empty and password_confirmation is the same as password, then update the password
        if (!empty($request->password)) {
            if($request->password == $request->password_confirmation) {
                $user->password = $request->password;
            }else{
                //redirect to current page with error message
                return redirect()->back()->with('error', 'Passwords do not match!');
            }
        }

        $user->save();

        return redirect()->route('users.index')->with('message', 'User updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if ($id == 1) {
            return redirect()->route('users.index')->with('error', __('You cannot delete the admin user!'));
        }

        //Catch exception if user has assigned tasks
        try{
            $user = User::find($id);
            $user->delete();
        } catch (\Exception $e) {
            return redirect()->route('users.index')->with('error', __('You cannot delete a user with assigned tasks!'));
        }

        return redirect()->route('users.index')->with('message', __('User deleted successfully!'));
    }
}
