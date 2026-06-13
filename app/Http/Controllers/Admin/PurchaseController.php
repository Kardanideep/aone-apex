<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Purchase;
use App\Http\Controllers\Api\PurchaseController as ApiPurchaseController;
use Illuminate\Http\Request;

class PurchaseController extends Controller
{
    /**
     * Display a listing of the purchase requests.
     */
    public function index(Request $request)
    {
        $status = $request->query('status');

        $query = Purchase::with(['user', 'package'])->latest();

        if (in_array($status, ['pending', 'completed', 'failed'])) {
            $query->where('status', $status);
        }

        $purchases = $query->paginate(15)->withQueryString();

        return view('admin.purchases.index', compact('purchases', 'status'));
    }

    /**
     * Display the specified purchase request.
     */
    public function show(Purchase $purchase)
    {
        $purchase->load(['user', 'package', 'sponsor']);
        return view('admin.purchases.show', compact('purchase'));
    }

    /**
     * Approve the specified purchase request and activate the plan.
     */
    public function approve(Purchase $purchase)
    {
        if ($purchase->status !== 'pending') {
            return redirect()->back()->with('error', 'Only pending purchases can be approved.');
        }

        $apiController = new ApiPurchaseController();
        $success = $apiController->executePurchaseAndCommissions($purchase);

        if ($success) {
            return redirect()->route('admin.purchases.show', $purchase->id)
                ->with('success', 'Purchase approved successfully! Plan activated and commissions distributed.');
        }

        return redirect()->back()->with('error', 'An error occurred while activating the purchase plan.');
    }

    /**
     * Reject the specified purchase request.
     */
    public function reject(Purchase $purchase)
    {
        if ($purchase->status !== 'pending') {
            return redirect()->back()->with('error', 'Only pending purchases can be rejected.');
        }

        $purchase->update(['status' => 'failed']);

        return redirect()->route('admin.purchases.show', $purchase->id)
            ->with('success', 'Purchase request rejected successfully.');
    }
}
