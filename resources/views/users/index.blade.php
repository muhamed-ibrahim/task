@extends('layouts.app')
@php
    use App\Constants\PermissionConstants;
@endphp

@section('content')
    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6">
                                <h5 class="card-title">Users</h5>
                            </div>
                            <div class="col-6 text-end mt-3">

                                <a class=" btn btn-primary" href="{{ route('users.create') }}">Add New</a>
                            </div>

                        </div>


                        <!-- Default Table -->
                        <div class="table-responsive">
                            <table class="table table-bordered align-middle text-center">
                                @include('message')
                                <thead>
                                    <tr class="table-light text-center">
                                        <th scope="col">#</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Phone Number</th>
                                        <th scope="col">User Type</th>
                                        <th scope="col">Joined At</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($users as $user)
                                        <tr>
                                            <th>{{ $user->id }}</th>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>{{ $user->phone_number }}</td>
                                            <td>{{ $user->is_admin ? 'Admin' : 'User' }}</td>
                                            <td>{!! $user->created_at->format('Y-m-d') . ' || ' . $user->created_at->format('h:i A') !!}</td>
                                            <td>
                                                <div class="d-flex gap-2 justify-content-center flex-wrap">
                                                    <a class="btn btn-primary"
                                                        href="{{ route('users.edit', $user->id) }}">Edit</a>
                                                    @if (auth()->user()->id !== $user->id)
                                                        <form method="POST"
                                                            action="{{ route('users.destroy', $user->id) }}">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger">Delete</button>
                                                        </form>
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7" class="text-center">No Users found.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        @if ($users->hasPages())
                            <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-3">
                                <div class="me-2 text-muted small">
                                    Showing {{ $users->firstItem() }} to {{ $users->lastItem() }} of {{ $users->total() }}
                                    results
                                </div>
                                <div>
                                    {{ $users->links('pagination::bootstrap-4') }}
                                </div>
                            </div>
                        @endif

                        <!-- End Default Table Example -->
                    </div>
                </div>
            </div>
    </section>
@endsection
