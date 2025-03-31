<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('edit-user', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'idKaryawan' => ['required', 'number', 'max:5', 'unique:users,idKaryawan,' . $id],
            'role' => ['required', 'in:admin,user'],
        ]);

        $user = User::findOrFail($id);
        $user->update([
            'name' => $validated['name'],
            'idKaryawan' => $validated['idKaryawan'],
            'role' => $validated['role'],
        ]);

        return redirect()->route('dashboard')->with('success', 'User berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('dashboard')->with('success', 'User berhasil dihapus.');
    }
}
