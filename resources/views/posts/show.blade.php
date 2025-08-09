@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="row justify-content-center">
            <div class="col-lg-8">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Post Details</h5>

                        <table class="table table-borderless table-responsive text-break">
                            <tbody>
                                <tr>
                                    <th style="width: 30%;">Title:</th>
                                    <td>{{ $post->title }}</td>
                                </tr>
                                <tr>
                                    <th>Description:</th>
                                    <td>{{ $post->description }}</td>
                                </tr>
                                <tr>
                                    <th>Phone Number:</th>
                                    <td>{{ $post->phone_number }}</td>
                                </tr>
                                <tr>
                                    <th>Created By:</th>
                                    <td>{{ $post->user->name }}</td>
                                </tr>
                                <tr>
                                    <th>Created At:</th>
                                    <td>
                                        {{ $post->created_at->format('Y-m-d') }} <br>
                                        {{ $post->created_at->format('h:i A') }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection
