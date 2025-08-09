@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Edit Post</h5>
                        <form method="POST" action="{{ route('users.update', $user->id) }}">
                            @csrf
                            @method('PUT')

                            <!-- Name Field -->
                            <div class="row mb-3">
                                <label class="col-sm-1 col-form-label">Name</label>
                                <div class="col-sm-11">
                                    <input type="text" name="name" class="form-control"
                                        value="{{ old('name', $user->name) }}">
                                    @error('name')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                            </div>

                            <!-- Email Field -->
                            <div class="row mb-3">
                                <label class="col-sm-1 col-form-label">Email</label>
                                <div class="col-sm-11">
                                    <input type="text" name="email" class="form-control"
                                        value="{{ old('email', $user->email) }}" disabled>
                                    @error('email')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Phone Number Field -->
                            <div class="row mb-3">
                                <label class="col-sm-1 col-form-label">Phone</label>
                                <div class="col-sm-11">
                                    <input type="text" name="phone_number" class="form-control"
                                        value="{{ old('phone_number', $user->phone_number) }}">
                                    @error('phone_number')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!--Password Field -->
                            {{-- <div class="row mb-3">
                                <label class="col-sm-1 col-form-label">Password</label>
                                <div class="col-sm-11">
                                    <input type="password" name="password" class="form-control"
                                        value="{{ old('password', $user->password) }}" disabled>
                                    @error('password')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div> --}}

                            <!-- Submit Button -->
                            <div class="row mb-3 text-center">
                                <div class="col-sm-12">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection
