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
                                <h5 class="card-title">Posts</h5>
                            </div>
                            <div class="col-6 text-end mt-3">

                                <a class=" btn btn-primary" href="{{ route('posts.create') }}">Add New</a>
                            </div>

                        </div>


                        <!-- Default Table -->
                        <div class="table-responsive">

                            <table class="table table-bordered align-middle text-center">
                                @include('message')
                                <thead>
                                    <tr class="table-light text-center">
                                        <th scope="col">#</th>
                                        <th scope="col">Title</th>
                                        <th scope="col">Phone Number</th>
                                        <th scope="col">created By</th>
                                        <th scope="col">created At</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($posts as $post)
                                        <tr class="text-center">
                                            <th>{{ $post->id }}</th>
                                            <td>{{ $post->title }}</td>
                                            <td>{{ $post->phone_number }}</td>
                                            <td>{{ $post->user->name }}</td>

                                            <td>{!! $post->created_at->format('Y-m-d') . ' || ' . $post->created_at->format('h:i A') !!}</td>
                                            <td>
                                                <div class="d-flex gap-2 justify-content-center flex-wrap">
                                                    <a class="btn btn-secondary"
                                                        href="{{ route('posts.show', $post->id) }}">Show</a>
                                                </div>
                                            </td>

                                        </tr>
                                    @empty
                                        <div class="alert alert-info text-center">
                                            No posts found.
                                        </div>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        @if ($posts->hasPages())
                            <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-3">
                                <div class="me-2 text-muted small">
                                    Showing {{ $posts->firstItem() }} to {{ $posts->lastItem() }} of {{ $posts->total() }}
                                    results
                                </div>
                                <div>
                                    {{ $posts->links('pagination::bootstrap-4') }}
                                </div>
                            </div>
                        @endif
                        <!-- End Default Table Example -->
                    </div>
                </div>
            </div>
    </section>
@endsection
