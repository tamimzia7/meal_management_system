@extends('layouts.app')

@section('title', 'Edit Daily Meal')
@section('page-title', 'Edit Daily Meal')

@section('content')
    <div class="fade-in">
        <div class="page-header">
            <div>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}" class="text-decoration-none">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('daily-meals.index') }}" class="text-decoration-none">Daily Meals</a></li>
                        <li class="breadcrumb-item active">Edit</li>
                    </ol>
                </nav>
                <h4>Edit Daily Meal Record</h4>
            </div>
        </div>

        <div class="content-card">
            <div class="card-header">
                <span><i class="bi bi-pencil-square me-2"></i>Edit Meal for {{ $dailyMeal->company->company_name }}</span>
            </div>
            <div class="card-body">
                <form action="{{ route('daily-meals.update', $dailyMeal) }}" method="POST">
                    @csrf
                    @method('PUT')

                    @php
                        $isCompanyPerson = Auth::user()->role === 'company_person';
                        $currentRate = $mealRate?->rate ?? 0;
                    @endphp

                    @if ($isCompanyPerson)
                        <input type="hidden" name="company_id" value="{{ $dailyMeal->company_id }}">
                        <input type="hidden" name="meal_date" value="{{ $dailyMeal->meal_date->format('Y-m-d') }}">

                        <div class="row g-4 mb-4">
                            <div class="col-md-4">
                                <label class="form-label text-muted small">Company</label>
                                <div class="p-2 fw-semibold">{{ $dailyMeal->company->company_name }}</div>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label text-muted small">Meal Date</label>
                                <div class="p-2 fw-semibold">{{ $dailyMeal->meal_date->format('d M, Y') }}</div>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label text-muted small">Meal Rate</label>
                                <div class="p-2 fw-semibold">BDT {{ number_format($currentRate, 2) }}</div>
                            </div>
                        </div>
                    @endif

                    <div class="row g-4">
                        @if (!$isCompanyPerson)
                            <div class="col-md-6">
                                <label for="company_id" class="form-label">Company <span class="text-danger">*</span></label>
                                <select id="company_id" name="company_id"
                                        class="form-select @error('company_id') is-invalid @enderror">
                                    <option value="">Select Company</option>
                                    @foreach ($companies as $company)
                                        <option value="{{ $company->id }}" {{ old('company_id', $dailyMeal->company_id) == $company->id ? 'selected' : '' }}>
                                            {{ $company->company_name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('company_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="meal_date" class="form-label">Meal Date <span class="text-danger">*</span></label>
                                <input type="date" id="meal_date" name="meal_date"
                                       class="form-control @error('meal_date') is-invalid @enderror"
                                       value="{{ old('meal_date', $dailyMeal->meal_date->format('Y-m-d')) }}">
                                @error('meal_date')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        @endif

                        <div class="col-md-4">
                            <label for="breakfast_meal" class="form-label">
                                <i class="bi bi-sunrise text-warning me-1"></i>Breakfast <span class="text-danger">*</span>
                            </label>
                            <input type="number" id="breakfast_meal" name="breakfast_meal" min="0"
                                   class="form-control @error('breakfast_meal') is-invalid @enderror"
                                   value="{{ old('breakfast_meal', $dailyMeal->breakfast_meal) }}" placeholder="0"
                                   oninput="calculateTotals()">
                            @error('breakfast_meal')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-4">
                            <label for="lunch_meal" class="form-label">
                                <i class="bi bi-sun text-danger me-1"></i>Lunch <span class="text-danger">*</span>
                            </label>
                            <input type="number" id="lunch_meal" name="lunch_meal" min="0"
                                   class="form-control @error('lunch_meal') is-invalid @enderror"
                                   value="{{ old('lunch_meal', $dailyMeal->lunch_meal) }}" placeholder="0"
                                   oninput="calculateTotals()">
                            @error('lunch_meal')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-4">
                            <label for="dinner_meal" class="form-label">
                                <i class="bi bi-moon text-primary me-1"></i>Dinner <span class="text-danger">*</span>
                            </label>
                            <input type="number" id="dinner_meal" name="dinner_meal" min="0"
                                   class="form-control @error('dinner_meal') is-invalid @enderror"
                                   value="{{ old('dinner_meal', $dailyMeal->dinner_meal) }}" placeholder="0"
                                   oninput="calculateTotals()">
                            @error('dinner_meal')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-4">
                            <label class="form-label"><i class="bi bi-calculator me-1"></i>Total Meal</label>
                            <div class="p-3 bg-light rounded-3 text-center">
                                <span class="fs-4 fw-bold" id="totalMealDisplay">{{ $dailyMeal->total_meal }}</span>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label"><i class="bi bi-cash-coin me-1"></i>Total Cost</label>
                            <div class="p-3 bg-light rounded-3 text-center">
                                <span class="fs-5 fw-bold" id="totalCostDisplay" style="color: #2d3748;">BDT {{ number_format($dailyMeal->total_meal * $currentRate, 2) }}</span>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="p-3 rounded-3 text-center" style="background: var(--primary-gradient);">
                                <small class="text-white opacity-75 d-block">Meal Rate</small>
                                <span class="fs-5 fw-bold text-white">BDT {{ number_format($currentRate, 2) }}</span>
                                <small class="text-white opacity-75 d-block">/ per meal</small>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <label for="remarks" class="form-label">Remarks</label>
                            <textarea id="remarks" name="remarks" rows="2"
                                      class="form-control @error('remarks') is-invalid @enderror"
                                      placeholder="Any notes or remarks...">{{ old('remarks', $dailyMeal->remarks) }}</textarea>
                            @error('remarks')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mt-4 d-flex gap-2">
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-check-lg me-1"></i> Update Meal Record
                        </button>
                        <a href="{{ route('daily-meals.index') }}" class="btn btn-outline-secondary">
                            <i class="bi bi-x-lg me-1"></i> Cancel
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        const mealRate = {{ $currentRate }};

        function calculateTotals() {
            const breakfast = parseInt(document.getElementById('breakfast_meal').value) || 0;
            const lunch = parseInt(document.getElementById('lunch_meal').value) || 0;
            const dinner = parseInt(document.getElementById('dinner_meal').value) || 0;

            const total = breakfast + lunch + dinner;
            const cost = total * mealRate;

            document.getElementById('totalMealDisplay').textContent = total;
            document.getElementById('totalCostDisplay').textContent = 'BDT ' + cost.toFixed(2);
        }
    </script>
    @endpush
@endsection
