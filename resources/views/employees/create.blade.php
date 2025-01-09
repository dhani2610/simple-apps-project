@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Create New Employee') }}</div>

                <div class="card-body">
                    <form action="{{ route('employees.store') }}" method="POST">
                        @csrf

                        <!-- First Name Field -->
                        <div class="form-group mt-3">
                            <label for="firstname">First Name</label>
                            <input type="text" class="form-control @error('firstname') is-invalid @enderror" id="firstname" name="firstname" value="{{ old('firstname') }}" required>
                            @error('firstname')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Last Name Field -->
                        <div class="form-group mt-3">
                            <label for="lastname">Last Name</label>
                            <input type="text" class="form-control @error('lastname') is-invalid @enderror" id="lastname" name="lastname" value="{{ old('lastname') }}" required>
                            @error('lastname')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Company Field -->
                        <div class="form-group mt-3">
                            <label for="company_id">Company</label>
                            <select class="form-control @error('company_id') is-invalid @enderror" id="company_id" name="company_id" required>
                                @foreach($companies as $company)
                                    <option value="{{ $company->id }}" {{ old('company_id') == $company->id ? 'selected' : '' }}>{{ $company->name }}</option>
                                @endforeach
                            </select>
                            @error('company_id')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Email Field -->
                        <div class="form-group mt-3">
                            <label for="email">Email</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}">
                            @error('email')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Phone Field -->
                        <div class="form-group mt-3">
                            <label for="phone">Phone</label>
                            <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" value="{{ old('phone') }}">
                            @error('phone')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Submit Button -->
                        <button type="submit" class="btn btn-success mt-3">Create</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
