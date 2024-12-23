<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\User_model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    public function register(Request $request)
    {

        if ($request->isMethod("get")) {
            return view('user.register');
        }

        $request->validate([
            'name' => 'required|max:20',
            'email' => 'email|required|unique:users,email',
            'password' => 'required|min:8',
            'confirm-password' => 'required|same:password',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        if ($request->ajax()) {
            return response()->json(['success' => true, 'message' => 'Registration successfully!']);
        }

    }

    public function login(Request $request)
    {

        if ($request->isMethod('get')) {
            return view('user.login');
        }

        $request->validate([
            'email' => 'required',
            'email',
            'password' => 'required',
        ]);

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            Session::put('user_id', Auth::user()->id);
            return response()->json(['success' => true, 'message' => 'Login successfully!']);
        }

        return redirect()->route('user.login')->with('error', 'Invalid credintials');

    }

    public function index()
    {
        return view('user.users');
    }

    public function allUsers()
    {
        $users = User::orderBy('created_at', 'desc')->simplePaginate(5);
        return view('user.users', compact('users'));
    }

    public function create()
    {
        return view('user.add-user');
    }

    public function storeUser(Request $request)
    {

        $request->validate([
            'name' => 'required|max:40',
            'email' => 'email|required|unique:users,email',
            'password' => 'required|min:8',
            'confirm-pssword' => 'required|same:password',
        ]);

        $user = User::create($request->all());
        if ($user) {
            return redirect()->route('employee-panel.users.all-users')->with('success', 'User added successfully!');
        } else {
            return redirect()->route('user.add-user')->with('error', 'Failed to add user');
        }
    }

    public function checkEmail(Request $request)
    {
        $emailExists = User::where('email', $request->email)->exists();
        return response()->json(['exists' => $emailExists]);
    }

    function deleteUser($id)
    {
        $user = User::find($id);
        if ($user) {
            $user->delete();
            return redirect()->route('employee-panel.users.all-users')->with('success', 'User deleted successfully!');
        } else {
            return redirect()->route('user.users')->with('error', 'Failed to delete user');
        }
    }

    function edit_user($id)
    {
        $user = User::findOrFail($id);
        if ($user) {
            return view('user.edit-user', compact('user'));
        } else {
            return redirect()->route('user.users')->with('error', 'User not found');
        }
    }
    public function update_user(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|max:40',
            'email' => 'email|required|unique:users,email,' . $id,
            'password' => 'nullable|min:8',
            'confirm-password' => 'nullable|same:password',
        ]);

        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->email = $request->email;

        if ($request->filled('password')) {
            $user->password = bcrypt($request->password);
        }

        $user->update();

        return redirect()->route('employee-panel.users.all-users')->with('success', 'User updated successfully!');
    }

}
