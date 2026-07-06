<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\DailyMeal;
use App\Models\User;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $today = now()->toDateString();

        $todaysTotalMeal = DailyMeal::where('meal_date', $today)
            ->selectRaw('COALESCE(SUM(breakfast_meal + lunch_meal + dinner_meal), 0) as total')
            ->value('total');

        $totalCompanies = Company::count();
        $totalUsers = User::count();

        $avgCostPerMeal = 50;
        $todaysEstimatedCost = $todaysTotalMeal * $avgCostPerMeal;

        $recentMeals = DailyMeal::with('company')
            ->latest()
            ->take(5)
            ->get();

        return view('dashboard.index', compact(
            'todaysTotalMeal',
            'totalCompanies',
            'totalUsers',
            'todaysEstimatedCost',
            'recentMeals'
        ));
    }
}
