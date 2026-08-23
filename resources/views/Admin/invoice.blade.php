@extends('Admin.layout')

@section('content')

<div class="container mt-5">

<div class="card shadow">

<div class="card-header bg-primary text-white">

<h3>

StudyMate AI Invoice

</h3>

</div>

<div class="card-body">

<h4>

Invoice Number

</h4>

<p>

{{ $invoice->invoice_no }}

</p>

<hr>

<h4>

Customer

</h4>

<p>

{{ $invoice->customer_name }}

</p>

<hr>

<h4>

Plan

</h4>

<p>

{{ $invoice->plan }}

</p>

<hr>

<h4>

Subscription Amount

</h4>

<p>

₹ {{ $invoice->amount }}

</p>

<hr>

<h4>

GST

</h4>

<p>

₹ {{ $invoice->gst }}

</p>

<hr>

<h4>

Total

</h4>

<h3 class="text-success">

₹ {{ $invoice->total }}

</h3>

<hr>

<h4>

Status

</h4>

<span class="badge bg-success">

{{ $invoice->status }}

</span>

</div>

</div>

</div>

@endsection