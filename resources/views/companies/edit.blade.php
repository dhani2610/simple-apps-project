@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Edit Company') }}</div>

                <div class="card-body">
                    <form action="{{ route('companies.update', $company->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                
                        <div class="form-group mt-3">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $company->name) }}" required>
                        </div>
                        <div class="form-group mt-3">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $company->email) }}">
                        </div>
                        <div class="form-group mt-3">
                            <label for="logo">Logo</label>
                            <input type="file" class="form-control" id="logo" name="logo">
                            @if($company->logo)
                                <div class="mt-2">
                                    <img src="{{ asset('storage/' . $company->logo) }}" alt="Logo" width="100">
                                </div>
                            @endif
                        </div>
                        <div class="form-group mt-3">
                            <label for="website">Website</label>
                            <input type="url" class="form-control" id="website" name="website" value="{{ old('website', $company->website) }}">
                        </div>
                        <button type="submit" class="btn btn-success mt-3">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
