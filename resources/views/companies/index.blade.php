@extends('layouts.app')

@section('title', 'Companies')
@section('page-title', 'Company Management')

@section('content')
    <div class="fade-in">
        <div class="page-header">
            <div>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}" class="text-decoration-none">Dashboard</a></li>
                        <li class="breadcrumb-item active">Companies</li>
                    </ol>
                </nav>
                <h4>Company Management</h4>
            </div>
            <a href="{{ route('companies.create') }}" class="btn btn-primary">
                <i class="bi bi-building-add me-1"></i> Create New Company
            </a>
        </div>

        <div class="content-card">
            <div class="card-header">
                <span><i class="bi bi-building-fill me-2"></i>All Companies</span>
                <span class="text-muted small">{{ $companies->total() }} records</span>
            </div>
            <div class="card-body">
                <div class="row mb-4">
                    <div class="col-md-6">
                        <form action="{{ route('companies.index') }}" method="GET">
                            <div class="search-box">
                                <i class="bi bi-search search-icon"></i>
                                <input type="text" name="search" class="form-control"
                                       placeholder="Search by company name, contact person or email..."
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
                                <th>Company Name</th>
                                <th>Contact Person</th>
                                <th>Phone</th>
                                <th>Email</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($companies as $company)
                                <tr>
                                    <td>{{ $loop->iteration + ($companies->currentPage() - 1) * $companies->perPage() }}</td>
                                    <td>
                                        <div class="d-flex align-items-center gap-2">
                                            <div class="avatar" style="width: 35px; height: 35px; font-size: 12px; background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);">
                                                {{ strtoupper(substr($company->company_name, 0, 1)) }}
                                            </div>
                                            <span class="fw-semibold">{{ $company->company_name }}</span>
                                        </div>
                                    </td>
                                    <td>{{ $company->contact_person ?? 'N/A' }}</td>
                                    <td>{{ $company->phone_number ?? 'N/A' }}</td>
                                    <td>{{ $company->email ?? 'N/A' }}</td>
                                    <td>
                                        @if ($company->status)
                                            <span class="badge bg-success">Active</span>
                                        @else
                                            <span class="badge bg-danger">Inactive</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="action-btns">
                                            <a href="{{ route('companies.edit', $company) }}" class="btn btn-sm btn-warning" title="Edit">
                                                <i class="bi bi-pencil-fill"></i>
                                            </a>
                                            <form action="{{ route('companies.destroy', $company) }}" method="POST"
                                                  onsubmit="return confirm('Are you sure you want to delete this company?')">
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
                                    <td colspan="7" class="text-center text-muted py-4">
                                        <i class="bi bi-building fs-2 d-block mb-2"></i>
                                        No companies found
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="d-flex justify-content-center mt-4">
                    {{ $companies->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
