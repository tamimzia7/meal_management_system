<?php

namespace App\Http\Controllers;

use App\Http\Requests\CompanyMealRequest;
use App\Http\Requests\StoreDailyMealRequest;
use App\Http\Requests\UpdateDailyMealRequest;
use App\Models\Company;
use App\Models\DailyMeal;
use App\Models\MealRate;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class DailyMealController extends Controller
{
    public function index(Request $request): View
    {
        $search = $request->input('search');
        $user = Auth::user();

        $dailyMeals = DailyMeal::with('company')
            ->when($user->role === 'company_person', function ($query) use ($user) {
                $query->where('company_id', $user->company_id);
            })
            ->when($search, function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->whereHas('company', function ($sub) use ($search) {
                        $sub->where('company_name', 'like', "%{$search}%");
                    })->orWhere('meal_date', 'like', "%{$search}%");
                });
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        $mealRate = MealRate::current();

        return view('daily-meals.index', compact('dailyMeals', 'search', 'mealRate'));
    }

    public function create(): View
    {
        $companies = Company::where('status', true)->get();
        $mealRate = MealRate::current();

        return view('daily-meals.create', compact('companies', 'mealRate'));
    }

    public function store(StoreDailyMealRequest $request): RedirectResponse
    {
        DailyMeal::create($request->validated());

        return redirect()->route('daily-meals.index')
            ->with('success', 'Daily meal record created successfully.');
    }

    public function edit(DailyMeal $dailyMeal): View
    {
        $user = Auth::user();

        if ($user->role === 'company_person' && $dailyMeal->company_id !== $user->company_id) {
            abort(403, 'You can only edit meals for your own company.');
        }

        $companies = Company::where('status', true)->get();
        $mealRate = MealRate::current();

        return view('daily-meals.edit', compact('dailyMeal', 'companies', 'mealRate'));
    }

    public function update(UpdateDailyMealRequest $request, DailyMeal $dailyMeal): RedirectResponse
    {
        $user = Auth::user();

        if ($user->role === 'company_person' && $dailyMeal->company_id !== $user->company_id) {
            abort(403, 'You can only update meals for your own company.');
        }

        if ($user->role === 'company_person') {
            $dailyMeal->update($request->only(['breakfast_meal', 'lunch_meal', 'dinner_meal', 'remarks']));
        } else {
            $dailyMeal->update($request->validated());
        }

        return redirect()->route('daily-meals.index')
            ->with('success', 'Daily meal record updated successfully.');
    }

    public function companyForm(): View
    {
        $user = Auth::user();

        if ($user->role !== 'company_person') {
            abort(403);
        }

        $dailyMeal = DailyMeal::firstOrCreate(
            [
                'company_id' => $user->company_id,
                'meal_date' => today(),
            ],
            [
                'breakfast_meal' => 0,
                'lunch_meal' => 0,
                'dinner_meal' => 0,
            ]
        );

        return view('daily-meals.company-submit', compact('dailyMeal'));
    }

    public function companySubmit(CompanyMealRequest $request): RedirectResponse
    {
        $user = Auth::user();

        $dailyMeal = DailyMeal::where('company_id', $user->company_id)
            ->where('meal_date', today())
            ->first();

        if (! $dailyMeal) {
            abort(404, 'No meal record found for today.');
        }

        $dailyMeal->update($request->validated());

        return redirect()->route('daily-meals.company.form')
            ->with('success', 'Today\'s meal requirement has been submitted successfully.');
    }

    public function destroy(DailyMeal $dailyMeal): RedirectResponse
    {
        $dailyMeal->delete();

        return redirect()->route('daily-meals.index')
            ->with('success', 'Daily meal record deleted successfully.');
    }
}
