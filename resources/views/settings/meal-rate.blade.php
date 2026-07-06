@extends('layouts.app')

@section('title', 'Meal Rate Settings')
@section('page-title', 'Meal Rate Settings')

@section('content')
    <div class="fade-in">
        <div class="page-header">
            <div>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}" class="text-decoration-none">Dashboard</a></li>
                        <li class="breadcrumb-item">Settings</li>
                        <li class="breadcrumb-item active">Meal Rate</li>
                    </ol>
                </nav>
                <h4>Meal Rate Settings</h4>
            </div>
        </div>

        <div class="row g-4">
            <div class="col-lg-5">
                <div class="content-card">
                    <div class="card-header">
                        <span><i class="bi bi-cash-stack me-2"></i>Current Meal Rate</span>
                    </div>
                    <div class="card-body text-center py-5">
                        <div class="display-1 fw-bold" style="color: var(--primary-gradient);">
                            <span style="background: var(--primary-gradient); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">
                                {{ number_format($mealRate?->rate ?? 0, 2) }}
                            </span>
                        </div>
                        <div class="fs-4 text-muted mb-1">BDT / Per Meal</div>

                        @if ($mealRate)
                            <hr class="my-4">
                            <div class="text-start">
                                <div class="d-flex justify-content-between mb-2">
                                    <span class="text-muted"><i class="bi bi-clock me-1"></i>Last Updated</span>
                                    <span class="fw-semibold">{{ $mealRate->updated_at->format('d M Y, h:i A') }}</span>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <span class="text-muted"><i class="bi bi-person me-1"></i>Updated By</span>
                                    <span class="fw-semibold">{{ $mealRate->updatedBy?->name ?? 'N/A' }}</span>
                                </div>
                            </div>
                        @else
                            <p class="text-muted mt-3">No rate set yet. Set the first rate below.</p>
                        @endif
                    </div>
                </div>
            </div>

            <div class="col-lg-7">
                <div class="content-card">
                    <div class="card-header">
                        <span><i class="bi bi-gear me-2"></i>Update Meal Rate</span>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('settings.meal-rate.update') }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="mb-4">
                                <label for="rate" class="form-label">Per Meal Rate <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <input type="number" step="0.01" min="0" id="rate" name="rate"
                                           class="form-control form-control-lg @error('rate') is-invalid @enderror"
                                           value="{{ old('rate', $mealRate?->rate ?? '') }}"
                                           placeholder="Enter meal rate">
                                    <span class="input-group-text bg-light fw-semibold">BDT</span>
                                    @error('rate')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-text">Set the cost per meal. This will be used to calculate total meal costs across all records.</div>
                            </div>

                            <button type="submit" class="btn btn-primary btn-lg">
                                <i class="bi bi-check-lg me-1"></i> Save Rate
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
