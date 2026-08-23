<!DOCTYPE html>
<html>
<head>

    <title>StudyMateAI Login</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

</head>

<body style="background:#f4f6f9;">

<div class="container mt-5">

<div class="row justify-content-center">

<div class="col-md-5">

<div class="card shadow">

<div class="card-header bg-primary text-white text-center">

<h3>StudyMateAI Login</h3>

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

<form action="{{ route('loginCheck') }}" method="POST">

@csrf

<div class="mb-3">

<label>Email</label>

<input type="email"
name="email"
class="form-control"
required>

</div>

<div class="mb-3">

<label>Password</label>

<div class="input-group">

<input
type="password"
id="password"
name="password"
class="form-control"
required>

<span
class="input-group-text"
onclick="togglePassword()"
style="cursor:pointer;">

<i
class="bi bi-eye"
id="eyeIcon"></i>

</span>

</div>

</div>

<div class="mb-3">

<button
type="button"
class="btn btn-warning"
onclick="sendOtp()">

Get OTP

</button>

</div>

<div
class="mb-3"
id="otpSection"
style="display:none;">

<label>Enter OTP</label>

<input
type="text"
id="otp"
name="otp"
class="form-control">

</div>

<button
type="submit"
class="btn btn-primary w-100">

Login

</button>

<div class="text-center mt-3">
    <a href="{{ route('forgot.password') }}">
        Forgot Password?
    </a>
</div>

<div class="text-center mt-2">
    <a href="{{ route('reset.password') }}">
        Reset Password
    </a>
</div>

</form>

</div>

</div>

</div>

</div>

</div>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<script>

function sendOtp()
{
    let email = $('input[name="email"]').val();

    if(email=='')
    {
        toastr.error('Enter Email First');

        return;
    }

    $.ajax({

        url:"{{ route('sendOtp') }}",

        type:"POST",

        data:{
            _token:"{{ csrf_token() }}",
            email:email
        },

        success:function(response)
        {
            $('#otpSection').show();

            toastr.success('OTP Sent Successfully');
        }

    });

}

function togglePassword()
{
    let password=document.getElementById("password");

    let eye=document.getElementById("eyeIcon");

    if(password.type=="password")
    {
        password.type="text";

        eye.classList.remove("bi-eye");

        eye.classList.add("bi-eye-slash");
    }
    else
    {
        password.type="password";

        eye.classList.remove("bi-eye-slash");

        eye.classList.add("bi-eye");
    }
}

</script>

</body>
</html>