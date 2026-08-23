<!DOCTYPE html>
<html>
<head>
    <title>Forgot Password</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">

    <div class="row justify-content-center">

        <div class="col-md-5">

            <div class="card">

                <div class="card-header text-center">
                    <h3>Forgot Password</h3>
                </div>

                <div class="card-body">

                    @if(session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif

                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form action="{{ route('forgot.password.save') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label>New Password</label>
                            <input type="password"
                                   name="new_password"
                                   class="form-control">
                        </div>

                        <div class="mb-3">
                            <label>Confirm Password</label>
                            <input type="password"
                                   name="confirm_password"
                                   class="form-control">
                        </div>

                        <button type="submit"
                                class="btn btn-success w-100">
                            Save
                        </button>

                    </form>

                    <a href="{{ route('login') }}"
                       class="btn btn-secondary w-100 mt-2">
                        Back To Login
                    </a>

                </div>

            </div>

        </div>

    </div>

</div>

</body>
</html>