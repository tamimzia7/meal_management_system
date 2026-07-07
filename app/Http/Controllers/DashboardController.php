<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\DailyMeal;
use App\Models\MealRate;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $today = now()->toDateString();
        $user = Auth::user();

        $dailyMealQuery = DailyMeal::where('meal_date', $today);

        if ($user->role === 'company_person') {
            $dailyMealQuery->where('company_id', $user->company_id);
        }

        $todaysTotalMeal = (clone $dailyMealQuery)
            ->selectRaw('COALESCE(SUM(breakfast_meal + lunch_meal + dinner_meal), 0) as total')
            ->value('total');

        $totalCompanies = $user->role === 'company_person'
            ? 1
            : Company::count();

        $totalUsers = $user->role === 'super_admin'
            ? User::count()
            : 0;

        $currentMealRate = MealRate::current();
        $mealRateValue = $currentMealRate?->rate ?? 0;
        $todaysEstimatedCost = $todaysTotalMeal * $mealRateValue;

        $recentMealsQuery = DailyMeal::with('company');

        if ($user->role === 'company_person') {
            $recentMealsQuery->where('company_id', $user->company_id);
        }

        $recentMeals = $recentMealsQuery->latest()->take(5)->get();

        $companyIds = $recentMeals->pluck('company_id')->unique();

        if ($companyIds->isNotEmpty()) {
            $companyTodayTotals = DailyMeal::where('meal_date', $today)
                ->whereIn('company_id', $companyIds)
                ->selectRaw('company_id, COALESCE(SUM(breakfast_meal + lunch_meal + dinner_meal), 0) as total')
                ->groupBy('company_id')
                ->pluck('total', 'company_id');

            $monthStart = now()->startOfMonth()->toDateString();
            $companyMonthlyTotals = DailyMeal::whereBetween('meal_date', [$monthStart, $today])
                ->whereIn('company_id', $companyIds)
                ->selectRaw('company_id, COALESCE(SUM(breakfast_meal + lunch_meal + dinner_meal), 0) as total')
                ->groupBy('company_id')
                ->pluck('total', 'company_id');
        } else {
            $companyTodayTotals = collect();
            $companyMonthlyTotals = collect();
        }

        return view('dashboard.index', compact(
            'todaysTotalMeal',
            'totalCompanies',
            'totalUsers',
            'todaysEstimatedCost',
            'currentMealRate',
            'mealRateValue',
            'recentMeals',
            'companyTodayTotals',
            'companyMonthlyTotals'
        ));
    }
}
