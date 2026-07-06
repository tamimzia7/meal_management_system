@extends('layouts.app')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')

@section('content')
    <div class="fade-in">
        <div class="row g-4 mb-4">
            <div class="col-xl-3 col-md-6">
                <div class="stat-card card-primary">
                    <i class="bi bi-basket-fill card-icon"></i>
                    <div class="card-value">{{ number_format($todaysTotalMeal) }}</div>
                    <div class="card-label">Today's Total Meal</div>
                    <small class="opacity-75"><i class="bi bi-calendar-check me-1"></i>{{ now()->format('F d, Y') }}</small>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="stat-card card-success">
                    <i class="bi bi-building-fill card-icon"></i>
                    <div class="card-value">{{ number_format($totalCompanies) }}</div>
                    <div class="card-label">Total Companies</div>
                    <small class="opacity-75"><i class="bi bi-arrow-up me-1"></i>Active companies</small>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="stat-card card-warning">
                    <i class="bi bi-people-fill card-icon"></i>
                    <div class="card-value">{{ number_format($totalUsers) }}</div>
                    <div class="card-label">Total Users</div>
                    <small class="opacity-75"><i class="bi bi-person-check me-1"></i>Registered users</small>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="stat-card card-secondary">
                    <i class="bi bi-cash-stack card-icon"></i>
                    <div class="card-value">BDT {{ number_format($todaysEstimatedCost, 2) }}</div>
                    <div class="card-label">Today's Estimated Cost</div>
                    <small class="opacity-75"><i class="bi bi-calculator me-1"></i>{{ number_format($mealRateValue, 2) }} BDT/meal</small>
                </div>
            </div>
        </div>

        <div class="row g-4 mb-4">
            <div class="col-12">
                <div class="content-card">
                    <div class="card-header">
                        <span><i class="bi bi-cash-coin me-2"></i>Current Meal Rate</span>
                        <a href="{{ route('settings.meal-rate') }}" class="btn btn-sm btn-outline-primary">
                            <i class="bi bi-gear me-1"></i> Manage
                        </a>
                    </div>
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between flex-wrap gap-3">
                            <div class="d-flex align-items-center gap-3">
                                <div class="avatar" style="width: 55px; height: 55px; font-size: 24px; background: var(--primary-gradient);">
                                    <i class="bi bi-cash-coin text-white"></i>
                                </div>
                                <div>
                                    <div class="fs-3 fw-bold" style="color: #2d3748;">
                                        BDT {{ number_format($mealRateValue, 2) }}
                                    </div>
                                    <div class="text-muted small">Per Meal</div>
                                </div>
                            </div>
                            @if ($currentMealRate)
                                <div class="text-end text-muted small">
                                    <div><i class="bi bi-clock me-1"></i>Updated {{ $currentMealRate->updated_at->diffForHumans() }}</div>
                                    <div><i class="bi bi-person me-1"></i>by {{ $currentMealRate->updatedBy?->name ?? 'N/A' }}</div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row g-4">
            <div class="col-lg-7">
                <div class="content-card">
                    <div class="card-header">
                        <span><i class="bi bi-clock-history me-2"></i>Recent Activities</span>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-container">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Company</th>
                                        <th>Date</th>
                                        <th>Breakfast</th>
                                        <th>Lunch</th>
                                        <th>Dinner</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($recentMeals as $meal)
                                        <tr>
                                            <td>
                                                <span class="fw-semibold">{{ $meal->company->company_name }}</span>
                                            </td>
                                            <td>{{ $meal->meal_date->format('M d, Y') }}</td>
                                            <td><span class="badge bg-info">{{ $meal->breakfast_meal }}</span></td>
                                            <td><span class="badge bg-success">{{ $meal->lunch_meal }}</span></td>
                                            <td><span class="badge bg-warning">{{ $meal->dinner_meal }}</span></td>
                                            <td><strong>{{ $meal->total_meal }}</strong></td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="text-center text-muted py-4">
                                                <i class="bi bi-inbox fs-3 d-block mb-2"></i>
                                                No meal records yet
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-5">
                <div class="content-card h-100">
                    <div class="card-header">
                        <span><i class="bi bi-info-circle me-2"></i>Overview</span>
                    </div>
                    <div class="card-body d-flex flex-column align-items-center justify-content-center text-center">
                        <div class="illustration-container w-100 mb-3">
                            <div>
                                <i class="bi bi-cup-hot-fill"></i>
                                <h4>Meal Management System</h4>
                                <p>Track and manage daily meal distribution across all companies efficiently.</p>
                            </div>
                        </div>
                        <div class="stats-mini justify-content-center w-100 mt-2">
                            <div class="stat-item">
                                <i class="bi bi-calendar-week"></i>
                                <div class="stat-info">
                                    <small>This Month</small>
                                    <span>{{ number_format($todaysTotalMeal) }} Meals</span>
                                </div>
                            </div>
                            <div class="stat-item">
                                <i class="bi bi-building"></i>
                                <div class="stat-info">
                                    <small>Active Companies</small>
                                    <span>{{ number_format($totalCompanies) }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
