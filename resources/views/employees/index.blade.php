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
                    <div class="card-header">{{ __('Employees') }}</div>

                    <div class="card-body">
                        <a href="{{ route('employees.create') }}" class="btn btn-primary float-end">Create New Employee</a>

                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Company</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($employees as $employee)
                                    <tr>
                                        <td>{{ $employee->firstname }} {{ $employee->lastname }}</td>
                                        <td>{{ $employee->company->name }}</td>
                                        <td>{{ $employee->email }}</td>
                                        <td>{{ $employee->phone }}</td>
                                        <td>
                                            <a href="{{ route('employees.edit', $employee->id) }}"
                                                class="btn btn-warning">Edit</a>
                                            <form action="{{ route('employees.destroy', $employee->id) }}" method="POST"
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

                        {{ $employees->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
