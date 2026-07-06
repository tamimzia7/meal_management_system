@extends('layouts.app')

@section('title', 'Submit Daily Meal')
@section('page-title', 'Submit Daily Meal Requirement')

@section('content')
    <div class="fade-in">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="content-card">
                    <div class="card-header">
                        <span><i class="bi bi-basket-fill me-2"></i>Today's Meal Requirement</span>
                        <small class="text-muted">{{ now()->format('l, F d, Y') }}</small>
                    </div>
                    <div class="card-body">
                        @if (session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <i class="bi bi-check-circle-fill me-1"></i> {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @endif

                        <form action="{{ route('daily-meals.company.submit') }}" method="POST">
                            @csrf

                            <div class="mb-4">
                                <label for="breakfast_meal" class="form-label">
                                    <i class="bi bi-sunrise-fill text-warning me-1"></i>Breakfast Meal <span class="text-danger">*</span>
                                </label>
                                <input type="number" id="breakfast_meal" name="breakfast_meal" min="0"
                                       class="form-control form-control-lg @error('breakfast_meal') is-invalid @enderror"
                                       value="{{ old('breakfast_meal', $dailyMeal->breakfast_meal) }}"
                                       placeholder="Enter number of breakfasts">
                                @error('breakfast_meal')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="lunch_meal" class="form-label">
                                    <i class="bi bi-sun-fill text-danger me-1"></i>Lunch Meal <span class="text-danger">*</span>
                                </label>
                                <input type="number" id="lunch_meal" name="lunch_meal" min="0"
                                       class="form-control form-control-lg @error('lunch_meal') is-invalid @enderror"
                                       value="{{ old('lunch_meal', $dailyMeal->lunch_meal) }}"
                                       placeholder="Enter number of lunches">
                                @error('lunch_meal')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="dinner_meal" class="form-label">
                                    <i class="bi bi-moon-fill text-primary me-1"></i>Dinner Meal <span class="text-danger">*</span>
                                </label>
                                <input type="number" id="dinner_meal" name="dinner_meal" min="0"
                                       class="form-control form-control-lg @error('dinner_meal') is-invalid @enderror"
                                       value="{{ old('dinner_meal', $dailyMeal->dinner_meal) }}"
                                       placeholder="Enter number of dinners">
                                @error('dinner_meal')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="remarks" class="form-label">
                                    <i class="bi bi-chat-dots-fill me-1"></i>Remarks
                                </label>
                                <textarea id="remarks" name="remarks" rows="3"
                                          class="form-control @error('remarks') is-invalid @enderror"
                                          placeholder="Any special notes or remarks...">{{ old('remarks', $dailyMeal->remarks) }}</textarea>
                                @error('remarks')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-primary btn-lg w-100">
                                <i class="bi bi-check2-square me-1"></i> Submit Meal Requirement
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
