@extends('Admin.layout')

@section('content')

<div class="container mt-4">

    <div class="card shadow">

        <div class="card-header bg-primary text-white">

            <h3>My Profile</h3>

        </div>

        <div class="card-body">

            @if($errors->any())

                <div class="alert alert-danger">

                    <ul class="mb-0">

                        @foreach($errors->all() as $error)

                            <li>{{ $error }}</li>

                        @endforeach

                    </ul>

                </div>

            @endif

            <form action="{{ route('profile.update') }}"
                  method="POST"
                  enctype="multipart/form-data">

                @csrf

                <div class="text-center mb-4">

                    @if($profile->image)

                        <img src="{{ asset('uploads/profile/'.$profile->image) }}"
                             width="150"
                             height="150"
                             class="rounded-circle border">

                    @else

                        <img src="https://via.placeholder.com/150"
                             class="rounded-circle border">

                    @endif

                </div>

                <div class="mb-3">

                    <label>Name</label>

                    <input
                        type="text"
                        name="name"
                        value="{{ $profile->name }}"
                        class="form-control">

                </div>

                <div class="mb-3">

                    <label>Email</label>

                    <input
                        type="email"
                        name="email"
                        value="{{ $profile->email }}"
                        class="form-control">

                </div>

                <div class="mb-3">

                    <label>Phone</label>

                    <input
                        type="text"
                        name="phone"
                        value="{{ $profile->phone }}"
                        class="form-control">

                </div>

                <div class="mb-3">

                    <label>Profile Image</label>

                    <input
                        type="file"
                        name="image"
                        class="form-control">

                </div>

                <button class="btn btn-success">

                    Update Profile

                </button>

            </form>

        </div>

    </div>

</div>

@if(session('success'))

<script>

toastr.success("{{ session('success') }}");

</script>

@endif

@endsection