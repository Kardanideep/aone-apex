<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\UserRepositoryInterface;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function index()
    {
        return response()->json([
            'success' => true,
            'data' => $this->userRepository->getAllUsers()
        ]);
    }

    public function show($id)
    {
        $user = $this->userRepository->getUserById($id);
        
        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'User not found'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $user
        ]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|max:150|unique:users',
            'mobile' => 'nullable|string|max:20|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'referral_code' => 'nullable|string'
        ]);

        $sponsorId = null;
        if (!empty($validatedData['referral_code'])) {
            $sponsor = \App\Models\User::where('user_id', $validatedData['referral_code'])->first();
            if ($sponsor) {
                $sponsorId = $sponsor->id;
            }
        }
        unset($validatedData['referral_code']);

        $validatedData['password'] = bcrypt($validatedData['password']);
        
        // Generate unique user_id
        do {
            $userId = 'AONE' . str_pad(mt_rand(1, 999999), 6, '0', STR_PAD_LEFT);
        } while (\App\Models\User::where('user_id', $userId)->exists());
        
        $validatedData['user_id'] = $userId;
        $validatedData['status'] = 'pending'; // Start as pending
        $validatedData['sponsor_id'] = $sponsorId;

        $user = $this->userRepository->createUser($validatedData);

        // Generate and Cache OTP
        $otp = str_pad(mt_rand(1, 999999), 6, '0', STR_PAD_LEFT);
        \Illuminate\Support\Facades\Cache::put("otp_{$user->user_id}", $otp, now()->addMinutes(10));

        // Send OTP Email
        \Illuminate\Support\Facades\Mail::to($user->email)->send(new \App\Mail\OtpVerificationMail($otp, $user->name));

        return response()->json([
            'success' => true,
            'message' => 'Registration successful. OTP sent to your email.',
            'user_id' => $user->user_id
        ], 201);
    }

    public function verifyOtp(Request $request)
    {
        $request->validate([
            'user_id' => 'required|string',
            'otp' => 'required|string|size:6'
        ]);

        $cachedOtp = \Illuminate\Support\Facades\Cache::get("otp_{$request->user_id}");

        if (!$cachedOtp || $cachedOtp !== $request->otp) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid or expired OTP.'
            ], 400);
        }

        $user = \App\Models\User::where('user_id', $request->user_id)->first();
        if ($user) {
            $user->update([
                'status' => 'pending', // Keep as pending until further steps (e.g., plan purchase or KYC)
                'email_verified_at' => now()
            ]);
            \Illuminate\Support\Facades\Cache::forget("otp_{$request->user_id}");

            // Automatically log the user in
            \Illuminate\Support\Facades\Auth::login($user);
            $request->session()->regenerate();

            return response()->json([
                'success' => true,
                'message' => 'OTP verified successfully. Your account is now active and you are logged in.'
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'User not found.'
        ], 404);
    }
}
