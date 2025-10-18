@extends('layouts.app')
@section('content')
@include('partial.slider',["categories" => App\Models\Category::all()])
<hr/>
<div class="about-section margin-top">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h1>About Shop</h1>
                <p>Discover quality products at competitive prices with secure payments and fast delivery.</p>
            </div>
            <div class="col-md-6" align="center">
                <img style="border-radius:50%;" src="image/logo.jpg" width="50%"/>
                <h1 class="logotext">Moin's_Online_Marketing</h1>
            </div>
        </div>
    </div>
</div>
@endsection