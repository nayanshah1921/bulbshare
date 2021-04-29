<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Procelle | Registration</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href=" {{ asset('assets/plugins/fontawesome-free/css/all.min.css') }}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href=" {{ asset('assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href=" {{ asset('assets/dist/css/adminlte.min.css') }}">
  <meta name="_token" content="{{ csrf_token() }}">
</head>
<body class="hold-transition register-page">
<div class="register-box">
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <a href="#" class="h1"><b>Pro</b>celle</a>
    </div>
    <div class="card-body">
      <p class="login-box-msg">Registration</p>
      <x-alert />
      <form id="form_registration" name="form_registration" method="post" action="{{ route('registration.store')}}" autocomplete="off" enctype="multipart/form-data">
        @csrf
        <div class="input-group mb-3">
        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="Name">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
          @error('name')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
          @enderror
        </div>
        <div class="input-group mb-3">
        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Email">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
          @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
          @enderror
        </div>
        <div class="input-group mb-3">
        <select id="company_id" class="form-control @error('company_id') is-invalid @enderror" name="company_id" required onchange="getCompanyDepartment(this.value);">
            <option value="">Select Company</option>
            @foreach($data['company'] as $v)
                <option value="{{ $v->id }}">{{ $v->company_name }}</option>
            @endforeach
        </select>
        <input type="hidden" id="company_id_url" value="{{ route('getcompanydepartments')}}" />
          @error('company_id')
            <span class="invalid-feedback" role="alert"> 
                <strong>{{ $message }}</strong>
            </span>
        @enderror
        </div>
        <div class="input-group mb-3">
        <select id="department_id" class="form-control @error('department_id') is-invalid @enderror" name="department_id[]" required multiple="multiple">
            <option value="">Select Department</option>
        </select>
        </div>
        <div class="row">
          <div class="col-8">
            <a href="{{ route('login') }}" class="text-center">Login Here</a>
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block">{{ __('Register') }}</button>
          </div>
          <!-- /.col -->
        </div>
      </form>
    </div>
    <!-- /.form-box -->
  </div><!-- /.card -->
</div>
<!-- /.register-box -->

<!-- jQuery -->
<script src=" {{ asset('assets/plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src=" {{ asset('assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- AdminLTE App -->
<script src=" {{ asset('assets/dist/js/adminlte.min.js') }}"></script>

<script src=" {{ asset('assets/dist/js/common.js') }}"></script>
</body>
</html>

