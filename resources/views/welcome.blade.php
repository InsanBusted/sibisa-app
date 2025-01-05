@extends('admin.layouts.app')

@section('konten-beranda')
<div class="container">
   <div class="row justify-content-center align-items-center">
         <div class="col-md-8 d-flex flex-column justify-content-center align-items-center">
            <h1 class="font-monospace text-white">AYO MULAI BIMBINGAN KAMU !</h1>
            <button type="button" class="btn btn-outline-primary"><a href="{{route('login')}}" class="text-white text-decoration-none">Login</a></button>
         </div>
         <div class="col-md-4">
            <img src="{{asset('murid1.png')}}" alt="" width="500">
         </div>
      </div>
</div>
      

@endsection