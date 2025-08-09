@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Add Post</h5>

                        <form method="POST" action="{{ route('users.store') }}">
                            @csrf

                            <!-- Name Field -->
                            <div class="row mb-3">
                                <label class="col-sm-1 col-form-label">Name</label>
                                <div class="col-sm-11">
                                    <input type="text" name="name" class="form-control" value="{{ old('name') }}">
                                    @error('name')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Email Field -->
                            <div class="row mb-3">
                                <label class="col-sm-1 col-form-label">Email</label>
                                <div class="col-sm-11">
                                    <input type="text" name="email" class="form-control" value="{{ old('email') }}">
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
                                        value="{{ old('phone_number') }}">
                                    @error('phone_number')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Password Field -->
                            <div class="row mb-3">
                                <label class="col-sm-1 col-form-label">Password</label>
                                <div class="col-sm-11">
                                    <input type="password" name="password" class="form-control"
                                        value="{{ old('password') }}">
                                    @error('password')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- User Type Field -->
                            <div class="row mb-3">
                                <label class="col-sm-1 col-form-label">Type</label>
                                <div class="col-sm-11">
                                    <select name="type" class="form-control">
                                        <option value="">-- User Type --</option>
                                        <option value="1" {{ old('type') == 'admin' ? 'selected' : '' }}>Admin</option>
                                        <option value="0" {{ old('type') == 'user' ? 'selected' : '' }}>User</option>
                                    </select>
                                    @error('type')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

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
