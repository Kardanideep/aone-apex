<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\UserKycRepositoryInterface;
use Illuminate\Http\Request;

class UserKycController extends Controller
{
    protected $kycRepository;

    public function __construct(UserKycRepositoryInterface $kycRepository)
    {
        $this->kycRepository = $kycRepository;
    }

    public function show($userId)
    {
        $kyc = $this->kycRepository->getKycByUserId($userId);

        if (!$kyc) {
            return response()->json([
                'success' => false,
                'message' => 'KYC not found for this user'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $kyc
        ]);
    }

    public function store(Request $request)
    {
        $validator = \Illuminate\Support\Facades\Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id',
            'document_type' => 'required|in:aadhaar,passport,driving_license',
            'document_number' => 'required|string|max:100',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()->first(),
                'errors' => $validator->errors()
            ], 422);
        }

        $validatedData = $validator->validated();

        $frontPath = null;
        $backPath = null;

        // Helper to handle both UploadedFile and Base64 string
        $processImage = function($inputName) use ($request) {
            if ($request->hasFile($inputName)) {
                return $request->file($inputName)->store('uploads/kyc', 'public');
            } elseif ($request->has($inputName) && is_string($request->input($inputName))) {
                $base64 = $request->input($inputName);
                if (preg_match('/^data:image\/(\w+);base64,/', $base64, $type)) {
                    $base64 = substr($base64, strpos($base64, ',') + 1);
                    $type = strtolower($type[1]); // jpg, png, etc
                    if (!in_array($type, ['jpg', 'jpeg', 'png', 'webp'])) {
                        throw new \Exception("Invalid image type");
                    }
                    $base64 = str_replace(' ', '+', $base64);
                    $imageName = 'uploads/kyc/' . uniqid() . '.' . $type;
                    \Illuminate\Support\Facades\Storage::disk('public')->put($imageName, base64_decode($base64));
                    return $imageName;
                }
            }
            throw new \Exception("The $inputName field must be a valid image.");
        };

        try {
            $frontPath = $processImage('front_image');
            $backPath = $processImage('back_image');
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 422);
        }

        $kycData = [
            'user_id' => $validatedData['user_id'],
            'document_type' => $validatedData['document_type'],
            'document_number' => $validatedData['document_number'],
            'front_image' => $frontPath,
            'back_image' => $backPath,
        ];

        $kyc = $this->kycRepository->submitKyc($validatedData['user_id'], $kycData);

        return response()->json([
            'success' => true,
            'message' => 'KYC submitted successfully',
            'data' => $kyc
        ], 201);
    }
}
