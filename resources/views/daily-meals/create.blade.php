@extends('layouts.app')

@section('title', 'Add Daily Meal')
@section('page-title', 'Add Daily Meal')

@section('content')
    <div class="fade-in">
        <div class="page-header">
            <div>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}" class="text-decoration-none">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('daily-meals.index') }}" class="text-decoration-none">Daily Meals</a></li>
                        <li class="breadcrumb-item active">Add</li>
                    </ol>
                </nav>
                <h4>Add Daily Meal Record</h4>
            </div>
        </div>

        <div class="content-card">
            <div class="card-header">
                <span><i class="bi bi-plus-circle me-2"></i>Meal Information</span>
            </div>
            <div class="card-body">
                <form action="{{ route('daily-meals.store') }}" method="POST">
                    @csrf

                    <div class="row g-4">
                        <div class="col-md-6">
                            <label for="company_id" class="form-label">Company <span class="text-danger">*</span></label>
                            <select id="company_id" name="company_id"
                                    class="form-select @error('company_id') is-invalid @enderror">
                                <option value="">Select Company</option>
                                @foreach ($companies as $company)
                                    <option value="{{ $company->id }}" {{ old('company_id') == $company->id ? 'selected' : '' }}>
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
                                   value="{{ old('meal_date', now()->format('Y-m-d')) }}">
                            @error('meal_date')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-4">
                            <label for="breakfast_meal" class="form-label">
                                <i class="bi bi-sunrise text-warning me-1"></i>Breakfast <span class="text-danger">*</span>
                            </label>
                            <input type="number" id="breakfast_meal" name="breakfast_meal" min="0"
                                   class="form-control @error('breakfast_meal') is-invalid @enderror"
                                   value="{{ old('breakfast_meal', 0) }}" placeholder="0">
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
                                   value="{{ old('lunch_meal', 0) }}" placeholder="0">
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
                                   value="{{ old('dinner_meal', 0) }}" placeholder="0">
                            @error('dinner_meal')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-4">
                            <div class="p-3 bg-light rounded-3">
                                <small class="text-muted d-block mb-1">Current Meal Rate</small>
                                <span class="fs-5 fw-bold" style="color: #2d3748;">BDT {{ number_format($mealRate?->rate ?? 0, 2) }}</span>
                                <small class="text-muted d-block">/ per meal</small>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <label for="remarks" class="form-label">Remarks</label>
                            <textarea id="remarks" name="remarks" rows="3"
                                      class="form-control @error('remarks') is-invalid @enderror"
                                      placeholder="Any notes or remarks...">{{ old('remarks') }}</textarea>
                            @error('remarks')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mt-4 d-flex gap-2">
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-check-lg me-1"></i> Save Meal Record
                        </button>
                        <a href="{{ route('daily-meals.index') }}" class="btn btn-outline-secondary">
                            <i class="bi bi-x-lg me-1"></i> Cancel
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
