<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class IncomePlanController extends Controller
{
    public function index()
    {
        $settings = Setting::whereIn('key', [
            'direct_commission_percent',
            'daily_investment_percent',
            'level_1_percent',
            'level_2_percent',
            'level_3_percent',
            'level_4_percent',
            'level_5_percent',
        ])->pluck('value', 'key')->toArray();

        return view('admin.income-plan.index', compact('settings'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'direct_commission_percent' => 'required|numeric|min:0|max:100',
            'daily_investment_percent' => 'required|numeric|min:0|max:100',
            'level_1_percent' => 'required|numeric|min:0|max:100',
            'level_2_percent' => 'required|numeric|min:0|max:100',
            'level_3_percent' => 'required|numeric|min:0|max:100',
            'level_4_percent' => 'required|numeric|min:0|max:100',
            'level_5_percent' => 'required|numeric|min:0|max:100',
        ]);

        $keys = [
            'direct_commission_percent',
            'daily_investment_percent',
            'level_1_percent',
            'level_2_percent',
            'level_3_percent',
            'level_4_percent',
            'level_5_percent',
        ];

        foreach ($keys as $key) {
            Setting::updateOrCreate(
                ['key' => $key],
                ['value' => $request->$key]
            );
        }

        return redirect()->route('admin.income-plan.index')->with('success', 'Income plan percentages updated successfully.');
    }
}
