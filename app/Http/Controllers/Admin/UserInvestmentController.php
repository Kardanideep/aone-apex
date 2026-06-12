<?php

namespace App\Http\Controllers\Admin;

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
        return view('admin.user-investments.index', compact('investments'));
    }

    public function create()
    {
        return view('admin.user-investments.create');
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

        $this->investmentRepository->createInvestment($validated);

        return redirect()->route('admin.user-investments.index')->with('success', 'User Investment created successfully.');
    }

    public function edit($id)
    {
        $investment = $this->investmentRepository->getInvestmentById($id);
        if (!$investment) {
            return redirect()->route('admin.user-investments.index')->with('error', 'Investment not found.');
        }
        return view('admin.user-investments.edit', compact('investment'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'user_name' => 'required|string|max:255',
            'user_img' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'investment_amount' => 'required|numeric|min:0',
        ]);

        if ($request->hasFile('user_img')) {
            $investment = $this->investmentRepository->getInvestmentById($id);
            if ($investment && $investment->user_img) {
                Storage::disk('public')->delete($investment->user_img);
            }
            $path = $request->file('user_img')->store('user_investments', 'public');
            $validated['user_img'] = $path;
        }

        $this->investmentRepository->updateInvestment($id, $validated);

        return redirect()->route('admin.user-investments.index')->with('success', 'User Investment updated successfully.');
    }

    public function destroy($id)
    {
        $investment = $this->investmentRepository->getInvestmentById($id);
        if ($investment) {
            if ($investment->user_img) {
                Storage::disk('public')->delete($investment->user_img);
            }
            $this->investmentRepository->deleteInvestment($id);
        }
        return redirect()->route('admin.user-investments.index')->with('success', 'User Investment deleted successfully.');
    }
}
