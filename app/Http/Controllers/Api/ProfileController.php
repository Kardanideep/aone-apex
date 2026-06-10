<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    /**
     * Update the user's profile information.
     */
    public function update(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'mobile' => 'nullable|string|max:20',
            // Add other fields as needed if there are more in the future like 'wallet_address', 'country'
        ]);

        $user->update([
            'name' => $validated['name'],
            'mobile' => $validated['mobile'] ?? $user->mobile,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Profile updated successfully.',
            'data' => [
                'name' => $user->name,
                'mobile' => $user->mobile,
            ]
        ]);
    }
}
