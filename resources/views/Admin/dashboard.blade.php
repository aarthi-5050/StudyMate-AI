@extends('Admin.layout')

@section('content')

<div class="container-fluid">

    <h2 class="mb-4">
        Dashboard
    </h2>

    <div class="row g-4">

        <!-- Study Notes -->
        <div class="col-md-4">
            <div class="card shadow border-0 h-100">
                <div class="card-body text-center">

                    <h1>📚</h1>

                    <h4>{{ $notesCount }}</h4>

                    <p class="text-muted mb-0">
                        Study Notes
                    </p>

                </div>
            </div>
        </div>

        <!-- Documents -->
        <div class="col-md-4">
            <div class="card shadow border-0 h-100">
                <div class="card-body text-center">

                    <h1>📄</h1>

                    <h4>{{ $documentsCount }}</h4>

                    <p class="text-muted mb-0">
                        Documents
                    </p>

                </div>
            </div>
        </div>

        <!-- Smart Chat -->
        <div class="col-md-4">
            <div class="card shadow border-0 h-100">
                <div class="card-body text-center">

                    <h1>🤖</h1>

                    <h4>{{ $chatCount }}</h4>

                    <p class="text-muted mb-0">
                        Smart Chats
                    </p>

                </div>
            </div>
        </div>

    </div>

</div>

@endsection