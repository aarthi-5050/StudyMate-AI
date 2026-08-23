@extends('Admin.layout')
@php
use Illuminate\Support\Str;
@endphp

@section('content')

<div class="container mt-4">

    <div class="card shadow">

        <div class="card-header bg-dark text-white">

            <h3>Chat History</h3>

        </div>

        <div class="card-body">

            <form action="{{ route('chat.history') }}" method="GET">

                <div class="row mb-3">

                    <div class="col-md-6">

                        <input
                            type="text"
                            name="search"
                            class="form-control"
                            placeholder="Search Question"
                            value="{{ request('search') }}">

                    </div>

                    <div class="col-md-2">

                        <button
                            class="btn btn-primary">

                            Search

                        </button>

                    </div>

                    <div class="col-md-2">

                        <a
                            href="{{ route('chat.history') }}"
                            class="btn btn-secondary">

                            Reset

                        </a>

                    </div>

                </div>

            </form>
            <!-- Download PDF Button -->

<div class="mb-3">

    <a href="{{ route('chat.download') }}"
       class="btn btn-danger">

        <i class="bi bi-file-earmark-pdf"></i>

        Download PDF

    </a>

</div>

            <table class="table table-bordered table-hover">

                <thead class="table-primary">

                    <tr>

                        <th>ID</th>

                        <th>Question</th>

                        <th>Answer</th>

                        <th>Date</th>

                        <th>Action</th>

                    </tr>

                </thead>

                <tbody>

                    @foreach($messages as $message)

                    <tr>

                        <td>{{ $message->id }}</td>

                        <td>{{ $message->question }}</td>

                        <td>{{ Str::limit($message->answer,100) }}</td>

                        <td>{{ $message->created_at->format('d-m-Y H:i') }}</td>

                        <td>

                            <a
                                href="{{ route('chat.delete',$message->id) }}"
                                class="btn btn-danger btn-sm">

                                Delete

                            </a>

                        </td>

                    </tr>

                    @endforeach

                </tbody>

            </table>

            <div class="d-flex justify-content-center">

                {{ $messages->appends(['search'=>request('search')])->links() }}

            </div>

        </div>

    </div>

</div>

@if(session('success'))

<script>

toastr.success("{{ session('success') }}");

</script>

@endif

@endsection