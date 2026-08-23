@extends('Admin.layout')

@section('content')

<div class="container mt-5">

    <div class="card shadow">

        <div class="card-header bg-primary text-white">

            <h3>Upload Document</h3>

        </div>

        <div class="card-body">

            @if($errors->any())

                <div class="alert alert-danger">

                    <ul>

                        @foreach($errors->all() as $error)

                            <li>{{ $error }}</li>

                        @endforeach

                    </ul>

                </div>

            @endif

            <form action="{{ route('documents.store') }}"
                  method="POST"
                  enctype="multipart/form-data">

                @csrf

                <label>Title</label>

                <input type="text"
                       name="title"
                       class="form-control">

                <br>

                <label>Category</label>

                <input type="text"
                       name="category"
                       class="form-control">

                <br>

                <label>Select Document</label>

                <input type="file"
                       name="document"
                       class="form-control">

                <br>

                <button class="btn btn-success">

                    Upload Document

                </button>

            </form>

        </div>

    </div>

</div>

<br>

<div class="card shadow">

    <div class="card-header bg-dark text-white">

        <h4>All Documents</h4>

    </div>

    <div class="card-body">

        <!-- Search Form goes here -->
         <form action="{{ route('documents') }}" method="GET">

    <div class="row mb-3">

        <div class="col-md-6">

            <input
                type="text"
                name="search"
                class="form-control"
                placeholder="Search by Title or Category"
                value="{{ request('search') }}">

        </div>

        <div class="col-md-2">

            <button
                type="submit"
                class="btn btn-primary">

                Search

            </button>

        </div>

        <div class="col-md-2">

            <a
                href="{{ route('documents') }}"
                class="btn btn-secondary">

                Reset

            </a>

        </div>

    </div>

</form>
<table class="table table-bordered table-hover">

    <thead class="table-primary">

        <tr>

            <th>ID</th>

            <th>Title</th>

            <th>Category</th>

            <th>Document</th>

            <th>Type</th>

            <th>Action</th>

        </tr>

    </thead>

    <tbody>

        @foreach($documents as $document)

        <tr>

            <td>{{ $document->id }}</td>

            <td>{{ $document->title }}</td>

            <td>{{ $document->category }}</td>

            <td>

                <a href="{{ asset('uploads/documents/'.$document->file_name) }}" target="_blank">

                    View

                </a>

            </td>

            <td>{{ strtoupper($document->file_type) }}</td>

            <td>

    <button
        class="btn btn-warning btn-sm"
        data-bs-toggle="modal"
        data-bs-target="#editModal{{ $document->id }}">

        Edit

    </button>

    <a href="{{ route('documents.delete',$document->id) }}"
       class="btn btn-danger btn-sm"
       onclick="return confirm('Are you sure you want to delete this document?')">

        Delete

    </a>

</td>
        </tr>
        <!-- Edit Modal -->

<div class="modal fade"
     id="editModal{{ $document->id }}"
     tabindex="-1">

    <div class="modal-dialog">

        <div class="modal-content">

            <form action="{{ route('documents.update',$document->id) }}"
                  method="POST">

                @csrf

                <div class="modal-header">

                    <h5>Edit Document</h5>

                    <button
                        type="button"
                        class="btn-close"
                        data-bs-dismiss="modal">
                    </button>

                </div>

                <div class="modal-body">

                    <label>Title</label>

                    <input
                        type="text"
                        name="title"
                        value="{{ $document->title }}"
                        class="form-control">

                    <br>

                    <label>Category</label>

                    <input
                        type="text"
                        name="category"
                        value="{{ $document->category }}"
                        class="form-control">

                </div>

                <div class="modal-footer">

                    <button
                        class="btn btn-success">

                        Update

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

        @endforeach

    </tbody>

</table>
<div class="d-flex justify-content-center">

{{ $documents->appends(['search'=>request('search')])->links() }}

</div>

    </div>

</div>
@if(session('success'))

<script>

toastr.success("{{ session('success') }}");

</script>

@endif

@endsection