<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class TeamController extends Controller
{
    public function index(Request $request)
    {
        $roleFilter = $request->query('role');
        $query = User::whereIn('role', ['rm', 'delivery']);

        if ($roleFilter && in_array($roleFilter, ['rm', 'delivery'])) {
            $query->where('role', $roleFilter);
        }

        $members = $query->latest()->paginate(10);

        return view('manager.team.index', compact('members', 'roleFilter'));
    }

    public function create()
    {
        return view('manager.team.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email',
            'phone' => 'nullable|string|max:20',
            'role' => 'required|in:rm,delivery',
            'password' => 'required|string|min:6',
        ]);

        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'] ?? null,
            'role' => $validated['role'],
            'password' => Hash::make($validated['password']),
            'profile_completed' => true,
        ]);

        $roleLabel = $validated['role'] === 'rm' ? 'Sales RM' : 'Delivery Driver';

        return redirect()->route('manager.team.index')->with('success', "Anggota tim ($roleLabel) berhasil ditambahkan!");
    }

    public function destroy(User $user)
    {
        if (! in_array($user->role, ['rm', 'delivery'])) {
            return redirect()->back()->with('error', 'Hanya anggota Sales RM atau Delivery Driver yang bisa dihapus.');
        }

        $user->delete();

        return redirect()->route('manager.team.index')->with('success', 'Anggota tim berhasil dihapus.');
    }
}
