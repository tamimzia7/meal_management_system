@extends('layouts.app')

@section('title', 'Daily Meals')
@section('page-title', 'Meal Management')

@section('content')
    <div class="fade-in">
        <div class="page-header">
            <div>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}" class="text-decoration-none">Dashboard</a></li>
                        <li class="breadcrumb-item active">Daily Meals</li>
                    </ol>
                </nav>
                <h4>Daily Meal Records</h4>
            </div>
            <a href="{{ route('daily-meals.create') }}" class="btn btn-primary">
                <i class="bi bi-plus-circle me-1"></i> Add Daily Meal
            </a>
        </div>

        <div class="content-card">
            <div class="card-header">
                <span><i class="bi bi-table me-2"></i>All Meal Records</span>
                <span class="text-muted small">{{ $dailyMeals->total() }} records</span>
            </div>
            <div class="card-body">
                <div class="row mb-4">
                    <div class="col-md-6">
                        <form action="{{ route('daily-meals.index') }}" method="GET">
                            <div class="search-box">
                                <i class="bi bi-search search-icon"></i>
                                <input type="text" name="search" class="form-control"
                                       placeholder="Search by company name or date..."
                                       value="{{ $search }}">
                            </div>
                        </form>
                    </div>
                </div>

                <div class="table-container">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Company</th>
                                <th>Date</th>
                                <th>Breakfast</th>
                                <th>Lunch</th>
                                <th>Dinner</th>
                                <th>Total</th>
                                <th>Remarks</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($dailyMeals as $meal)
                                <tr>
                                    <td>{{ $loop->iteration + ($dailyMeals->currentPage() - 1) * $dailyMeals->perPage() }}</td>
                                    <td>
                                        <span class="fw-semibold">{{ $meal->company->company_name }}</span>
                                    </td>
                                    <td>{{ $meal->meal_date->format('M d, Y') }}</td>
                                    <td>
                                        <div class="d-flex align-items-center gap-2">
                                            <i class="bi bi-sunrise text-warning"></i>
                                            <span>{{ $meal->breakfast_meal }}</span>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center gap-2">
                                            <i class="bi bi-sun text-danger"></i>
                                            <span>{{ $meal->lunch_meal }}</span>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center gap-2">
                                            <i class="bi bi-moon text-primary"></i>
                                            <span>{{ $meal->dinner_meal }}</span>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="badge bg-info fs-6">{{ $meal->total_meal }}</span>
                                    </td>
                                    <td>
                                        <span class="text-muted small">{{ Str::limit($meal->remarks, 20) ?: 'N/A' }}</span>
                                    </td>
                                    <td>
                                        <div class="action-btns">
                                            <a href="{{ route('daily-meals.edit', $meal) }}" class="btn btn-sm btn-warning" title="Edit">
                                                <i class="bi bi-pencil-fill"></i>
                                            </a>
                                            <form action="{{ route('daily-meals.destroy', $meal) }}" method="POST"
                                                  onsubmit="return confirm('Are you sure you want to delete this meal record?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger" title="Delete">
                                                    <i class="bi bi-trash-fill"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="9" class="text-center text-muted py-4">
                                        <i class="bi bi-basket fs-2 d-block mb-2"></i>
                                        No meal records found
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="d-flex justify-content-center mt-4">
                    {{ $dailyMeals->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
