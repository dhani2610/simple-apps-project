@extends('layouts.app')

@section('content')
    <style>
        svg {
            width: 16px !important;
            height: 16px !important;
        }

        .pagination .flex {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 5px;
        }

        .pagination .hidden {
            display: none;
        }

        .pagination .relative {
            position: relative;
        }

        .pagination .inline-flex {
            display: inline-flex;
        }
    </style>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Companies') }}</div>

                    <div class="card-body">
                        <a href="{{ route('companies.create') }}" class="btn btn-primary float-end">Create New Company</a>

                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Website</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($companies as $company)
                                    <tr>
                                        <td>{{ $company->name }}</td>
                                        <td>{{ $company->email }}</td>
                                        <td>{{ $company->website }}</td>
                                        <td>
                                            <a href="{{ route('companies.edit', $company->id) }}"
                                                class="btn btn-warning">Edit</a>
                                            <form action="{{ route('companies.destroy', $company->id) }}" method="POST"
                                                style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        {{ $companies->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
