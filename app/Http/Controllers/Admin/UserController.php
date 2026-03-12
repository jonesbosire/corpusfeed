<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
class UserController extends Controller {
    public function index() { return view('admin.users.index', ['users' => User::latest()->get()]); }
    public function create() { return view('admin.users.form', ['user' => new User]); }
    public function store(Request $request) {
        $request->validate(['name' => 'required|max:100', 'email' => 'required|email|unique:users', 'password' => 'required|min:8|confirmed', 'role' => 'required|in:super_admin,editor']);
        User::create([...$request->only('name', 'email', 'role'), 'password' => bcrypt($request->password), 'email_verified_at' => now()]);
        return redirect()->route('admin.users.index')->with('success', 'User created.');
    }
    public function edit(User $user) { return view('admin.users.form', compact('user')); }
    public function update(Request $request, User $user) {
        $request->validate(['name' => 'required|max:100', 'email' => 'required|email|unique:users,email,' . $user->id, 'role' => 'required|in:super_admin,editor', 'password' => 'nullable|min:8|confirmed']);
        $data = $request->only('name', 'email', 'role');
        if ($request->filled('password')) $data['password'] = bcrypt($request->password);
        $user->update($data);
        return redirect()->route('admin.users.index')->with('success', 'User updated.');
    }
    public function destroy(User $user) {
        abort_if($user->id === auth()->id(), 403, 'Cannot delete yourself.');
        $user->delete();
        return back()->with('success', 'User deleted.');
    }
    public function show(User $user) { return redirect()->route('admin.users.index'); }
}
