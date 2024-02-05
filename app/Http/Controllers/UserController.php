<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Testing\Fluent\Concerns\Has;

class UserController extends Controller
{
    public function __construct(){
        $this->user = new User();
    }

    public function index(Request $request) {
        return view('Auth.users')->with('listUser', $this->user->getAll());
    }

    public function add() {
        return view('Auth.add');
    }

    //Validation
    public function addStore(PostRequest $request) {
        $this->user->insertUser($request->name, $request->password);

        return redirect()->route('users')->with('status', "Success Tambah User");
    }

    public function edit(String $id) {
        return view('Auth.edit')->with('profile', $this->user->getUser($id));
    }

    public function editStore(PostRequest $request, String $id) {
        $this->user->updateUser($id, $request);

        return redirect()->route('users')->with('status', "Success Edit User");
    }

    public function destroy(String $id) {
        $this->user->deleteUser($id);

        return redirect()->route('users')->with('status', "Success Delete User");
    }
}
