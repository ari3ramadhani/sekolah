<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Elegant Dashboard | Sign In</title>
  <!-- Favicon -->
  <link rel="shortcut icon" href="./img/svg/logo.svg" type="image/x-icon">
  <!-- Custom styles -->
  <link rel="stylesheet" href="{{asset('backend/css/style.min.css')}}">
</head>

<body>
  <div class="layer"></div>
<main class="page-center">
  <article class="sign-up">
    <h1 class="sign-up__title">Welcome back!</h1>
    <p class="sign-up__subtitle">Sign in to your account to continue</p>

     <form class="sign-up-form form" method="POST" action="{{ route('login') }}">
            @csrf
      <label class="form-label-wrapper">
        <p class="form-label">Email</p>
        <input class="form-input"  type="email" name="email" :value="old('email')" required autofocus>
      </label>
      <label class="form-label-wrapper">
        <p class="form-label">Password</p>
        <input class="form-input" type="password" name="password" required autocomplete="current-password" />
      </label>
      <label for="">
        <a class="link-info forget-link" href="{{ route('password.request') }}" style="float: right; margin-top:-5px;">Forgot password?</a>
        <label class="form-checkbox-wrapper" style="float: left">
            <input class="form-checkbox" type="checkbox" required>
            <span class="form-checkbox-label">Remember</span>
        </label>
      </label>
      <button class="form-btn primary-default-btn transparent-btn">Sign in</button><br>
      <center><span class="form-checkbox-label">Dont have account? </span><a class="link-info forget-link" href="{{ route('register') }}">Sign Up</a></center>
    </form>
  </article>
</main>
<!-- Chart library -->
<script src="./plugins/chart.min.js"></script>
<!-- Icons library -->
<script src="plugins/feather.min.js"></script>
<!-- Custom scripts -->
<script src="js/script.js"></script>
</body>

</html>