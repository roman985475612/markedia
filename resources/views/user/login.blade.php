@extends('user.layout')

@section('content')
<div class="register-box">
    <div class="register-logo">Log in</div>
  
    <div class="card">
      <div class="card-body register-card-body">
        <p class="login-box-msg">Sign in to start your session</p>
  
        <form action="{{ route('login_store') }}" method="post">
            @csrf
          <div class="input-group mb-3">
            <input name="email" type="email" class="form-control" placeholder="Email">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-envelope"></span>
              </div>
            </div>
          </div>
          <div class="input-group mb-3">
            <input name="password" type="password" class="form-control" placeholder="Password">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>
          <div class="row mb-3">
            <div class="col-12">
                <button type="submit" class="btn btn-primary btn-block">Login</button>
            </div>
          </div>
          <div class="row">
            <div class="col-12">          
              <a href="{{ route('user.create') }}" class="text-center">Register a new membership</a>
            </div>
          </div>
        </form>
      </div>
      <!-- /.form-box -->
    </div><!-- /.card -->
  </div>
      
@endsection
