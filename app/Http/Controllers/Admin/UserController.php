<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $query = User::with('kyc')->orderBy('created_at', 'desc');

        if ($request->has('status') && in_array($request->status, ['active', 'pending', 'blocked'])) {
            $query->where('status', $request->status);
        }

        $users = $query->paginate(15)->appends($request->query());
        return view('admin.users.index', compact('users'));
    }

    public function show(User $user)
    {
        $user->load(['kyc', 'nestedChildren']);
        return view('admin.users.show', compact('user'));
    }

    public function updateStatus(Request $request, User $user)
    {
        $validated = $request->validate([
            'status' => 'required|in:active,pending,blocked'
        ]);

        $user->update(['status' => $validated['status']]);

        return redirect()->back()->with('success', 'User status updated successfully.');
    }

   public function updateKycStatus(Request $request, User $user)
{
    $validated = $request->validate([
        'status' => 'required|in:approved,rejected'
    ]);

    if ($user->kyc) {
        $user->kyc->update([
            'status' => $validated['status']
        ]);

        // If KYC is approved, activate the user account
        if ($validated['status'] === 'approved') {
            $user->update([
                'status' => 'active'
            ]);
        }

        // Optional: if KYC is rejected, keep the account pending
        if ($validated['status'] === 'rejected') {
            $user->update([
                'status' => 'pending'
            ]);
        }

        $action = $validated['status'];

        return redirect()->back()->with(
            'success',
            "KYC document has been {$action} and user status updated successfully."
        );
    }

    return redirect()->back()->with('error', 'No KYC document found.');
}
}
