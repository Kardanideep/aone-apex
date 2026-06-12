<?php

namespace App\Http\Controllers\Admin\Api;

use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\UserInvestmentRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UserInvestmentController extends Controller
{
    protected $investmentRepository;

    public function __construct(UserInvestmentRepositoryInterface $investmentRepository)
    {
        $this->investmentRepository = $investmentRepository;
    }

    public function index()
    {
        $investments = $this->investmentRepository->getAllInvestments();
        return response()->json([
            'status' => 'success',
            'data' => $investments
        ]);
    }

    public function show($id)
    {
        $investment = $this->investmentRepository->getInvestmentById($id);
        if (!$investment) {
            return response()->json(['status' => 'error', 'message' => 'Investment not found'], 404);
        }
        return response()->json(['status' => 'success', 'data' => $investment]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_name' => 'required|string|max:255',
            'user_img' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'investment_amount' => 'required|numeric|min:0',
        ]);

        if ($request->hasFile('user_img')) {
            $path = $request->file('user_img')->store('user_investments', 'public');
            $validated['user_img'] = $path;
        }

        $investment = $this->investmentRepository->createInvestment($validated);

        return response()->json([
            'status' => 'success',
            'message' => 'Investment created successfully',
            'data' => $investment
        ], 201);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'user_name' => 'sometimes|required|string|max:255',
            'user_img' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'investment_amount' => 'sometimes|required|numeric|min:0',
        ]);

        if ($request->hasFile('user_img')) {
            $investment = $this->investmentRepository->getInvestmentById($id);
            if ($investment && $investment->user_img) {
                Storage::disk('public')->delete($investment->user_img);
            }
            $path = $request->file('user_img')->store('user_investments', 'public');
            $validated['user_img'] = $path;
        }

        $investment = $this->investmentRepository->updateInvestment($id, $validated);

        if (!$investment) {
            return response()->json(['status' => 'error', 'message' => 'Investment not found'], 404);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Investment updated successfully',
            'data' => $investment
        ]);
    }

    public function destroy($id)
    {
        $investment = $this->investmentRepository->getInvestmentById($id);
        
        if (!$investment) {
            return response()->json(['status' => 'error', 'message' => 'Investment not found'], 404);
        }

        if ($investment->user_img) {
            Storage::disk('public')->delete($investment->user_img);
        }

        $this->investmentRepository->deleteInvestment($id);

        return response()->json([
            'status' => 'success',
            'message' => 'Investment deleted successfully'
        ]);
    }
}
