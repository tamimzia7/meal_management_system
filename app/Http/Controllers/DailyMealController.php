<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDailyMealRequest;
use App\Http\Requests\UpdateDailyMealRequest;
use App\Models\Company;
use App\Models\DailyMeal;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DailyMealController extends Controller
{
    public function index(Request $request): View
    {
        $search = $request->input('search');
        $dailyMeals = DailyMeal::with('company')
            ->when($search, function ($query, $search) {
                $query->whereHas('company', function ($q) use ($search) {
                    $q->where('company_name', 'like', "%{$search}%");
                })->orWhere('meal_date', 'like', "%{$search}%");
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('daily-meals.index', compact('dailyMeals', 'search'));
    }

    public function create(): View
    {
        $companies = Company::where('status', true)->get();

        return view('daily-meals.create', compact('companies'));
    }

    public function store(StoreDailyMealRequest $request): RedirectResponse
    {
        DailyMeal::create($request->validated());

        return redirect()->route('daily-meals.index')
            ->with('success', 'Daily meal record created successfully.');
    }

    public function edit(DailyMeal $dailyMeal): View
    {
        $companies = Company::where('status', true)->get();

        return view('daily-meals.edit', compact('dailyMeal', 'companies'));
    }

    public function update(UpdateDailyMealRequest $request, DailyMeal $dailyMeal): RedirectResponse
    {
        $dailyMeal->update($request->validated());

        return redirect()->route('daily-meals.index')
            ->with('success', 'Daily meal record updated successfully.');
    }

    public function destroy(DailyMeal $dailyMeal): RedirectResponse
    {
        $dailyMeal->delete();

        return redirect()->route('daily-meals.index')
            ->with('success', 'Daily meal record deleted successfully.');
    }
}
