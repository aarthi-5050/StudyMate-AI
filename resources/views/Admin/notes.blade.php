@extends('Admin.layout')

@section('content')

<div class="container mt-5">

    <div class="card shadow">

        <div class="card-header bg-primary text-white">

            <h3>Study Notes</h3>

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

            <form action="{{ route('notes.store') }}"
                  method="POST"
                  enctype="multipart/form-data">

                @csrf

                <div class="row">

                    <div class="col-md-6">

                        <label class="form-label">
                            Title
                        </label>

                        <input
                            type="text"
                            name="title"
                            class="form-control"
                            required>

                    </div>

                    <div class="col-md-6">

                        <label class="form-label">
                            Subject
                        </label>

                        <input
                            type="text"
                            name="subject"
                            class="form-control"
                            required>

                    </div>

                </div>

                <br>

                <label class="form-label">
                    Description
                </label>

                <textarea
                    name="description"
                    rows="4"
                    class="form-control"
                    required></textarea>

                <br>

                <label class="form-label">
                    Upload PDF
                </label>

                <input
                    type="file"
                    name="pdf"
                    class="form-control">

                <br>

                <button class="btn btn-success">

                    Save Note

                </button>

            </form>

        </div>

    </div>

    <br>

    <div class="card shadow">

        <div class="card-header bg-dark text-white">

            <h4>All Notes</h4>

        </div>

        <div class="card-body">
              <!-- Search Form Starts Here -->

        <form action="{{ route('notes') }}" method="GET">

            <div class="row mb-3">

                <div class="col-md-6">

                    <input
                        type="text"
                        name="search"
                        class="form-control"
                        placeholder="Search by Title or Subject"
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

                    <a href="{{ route('notes') }}"
                       class="btn btn-secondary">

                        Reset

                    </a>

                </div>

            </div>

        </form>

        <!-- Search Form Ends Here -->

            <table class="table table-bordered table-hover">

                <thead class="table-primary">

                <tr>

                    <th>ID</th>

                    <th>Title</th>

                    <th>Subject</th>

                    <th>Description</th>

                    <th>PDF</th>

                    <th>Action</th>

                </tr>

                </thead>

                <tbody>

                @foreach($notes as $note)

                    <tr>

                        <td>{{ $note->id }}</td>

                        <td>{{ $note->title }}</td>

                        <td>{{ $note->subject }}</td>

                        <td>{{ $note->description }}</td>

                        <td>

                            @if($note->pdf)

                                <a href="{{ asset('uploads/'.$note->pdf) }}"
                                   target="_blank">

                                    View PDF

                                </a>

                            @else

                                -

                            @endif

                        </td>

                        <td>

                           <button
    class="btn btn-warning btn-sm"
    data-bs-toggle="modal"
    data-bs-target="#editModal{{ $note->id }}">

    Edit

</button>

                            <a href="{{ route('notes.delete',$note->id) }}"
                               class="btn btn-danger btn-sm">

                                Delete

                            </a>

                        </td>

                    </tr>
                    <!-- ================= EDIT MODAL START ================= -->

<div class="modal fade"
     id="editModal{{ $note->id }}"
     tabindex="-1">

    <div class="modal-dialog">

        <div class="modal-content">

            <form action="{{ route('notes.update',$note->id) }}"
                  method="POST"
                  enctype="multipart/form-data">

                @csrf

                <div class="modal-header">

                    <h5>Edit Note</h5>

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
                        value="{{ $note->title }}"
                        class="form-control">

                    <br>

                    <label>Subject</label>

                    <input
                        type="text"
                        name="subject"
                        value="{{ $note->subject }}"
                        class="form-control">

                    <br>

                    <label>Description</label>

                    <textarea
                        name="description"
                        rows="4"
                        class="form-control">{{ $note->description }}</textarea>

                    <br>

                    <label>Upload New PDF</label>

                    <input
                        type="file"
                        name="pdf"
                        class="form-control">

                </div>

                <div class="modal-footer">

                    <button
                        type="submit"
                        class="btn btn-success">

                        Update

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

<!-- ================= EDIT MODAL END ================= -->


                @endforeach

                </tbody>

            </table>
            <div class="d-flex justify-content-center mt-3">

    {{ $notes->appends(['search' => request('search')])->links() }}

</div>

        </div>

    </div>

</div>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
@if(session('success'))

<script>

toastr.success("{{ session('success') }}");

</script>

@endif
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
@endsection
