<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMealRateRequest;
use App\Models\MealRate;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class MealRateController extends Controller
{
    public function index(): View
    {
        $mealRate = MealRate::current();

        return view('settings.meal-rate', compact('mealRate'));
    }

    public function update(StoreMealRateRequest $request): RedirectResponse
    {
        $existing = MealRate::current();

        if ($existing) {
            $existing->update([
                'rate' => $request->rate,
                'created_by' => Auth::id(),
            ]);
        } else {
            MealRate::create([
                'rate' => $request->rate,
                'created_by' => Auth::id(),
            ]);
        }

        return redirect()->route('settings.meal-rate')
            ->with('success', 'Meal rate updated successfully.');
    }
}
