@extends('Admin.layout')

@section('content')

<!-- Smart Chat content -->

<div class="container mt-5">

    <div class="card shadow">

        <div class="card-header bg-primary text-white">

            <h3>🤖 StudyMate AI Chat</h3>

        </div>

        <div class="card-body">

            <!-- Chat Messages -->

            <div style="height:400px; overflow-y:auto; border:1px solid #ddd; padding:15px;">

              @forelse($messages as $message)

    <!-- User Message -->
    <div class="text-end mb-3">

        <div class="alert alert-primary d-inline-block">

            {{ $message->question }}

        </div>

    </div>

    <!-- AI Reply -->
    <div class="text-start mb-3">

        <div class="alert alert-success d-inline-block">

            {{ $message->answer }}

        </div>

    </div>

@empty

    <p class="text-center text-muted">

        No messages yet.

    </p>

@endforelse

            </div>

            <br>

            <!-- Chat Form -->

            <form action="{{ route('smart.chat.send') }}" method="POST">

                @csrf

                <div class="input-group">

                    <input
                        type="text"
                        name="question"
                        class="form-control"
                        placeholder="Ask anything..."
                        required>

                    <button class="btn btn-primary">

                        Send

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>
@endsection