@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Edit Post</h5>
                        <form method="POST" action="{{ route('posts.update', $post->id) }}">
                            @csrf
                            @method('PUT')

                            <!-- Title Field -->
                            <div class="row mb-3">
                                <label class="col-sm-1 col-form-label">Title</label>
                                <div class="col-sm-11">
                                    <input type="text" name="title" class="form-control"
                                        value="{{ old('title', $post->title) }}">
                                    @error('title')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                            </div>

                            <!-- Description Field -->
                            <div class="row mb-3">
                                <label class="col-sm-1 col-form-label">Description</label>
                                <div class="col-sm-11">
                                    <textarea name="description" class="form-control">{{ old('description', $post->description) }}</textarea>
                                    @error('description')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Phone Number Field -->
                            <div class="row mb-3">
                                <label class="col-sm-1 col-form-label">Phone</label>
                                <div class="col-sm-11">
                                    <input type="text" name="phone_number" class="form-control"
                                        value="{{ old('phone_number', $post->phone_number) }}">
                                    @error('phone_number')
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
