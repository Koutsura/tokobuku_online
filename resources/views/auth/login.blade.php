<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <style>
        body {
            margin: 0;
            padding: 0;
            height: 100vh;
            background-color: #2b3133;
        }
        .logo {
            width: 200px;
            height: auto;
        }
    </style>
</head>
<body>
<section class="vh-100">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col col-xl-10">
        <div class="card" style="border-radius: 1rem;">
          <div class="row g-0">
            <div class="col-md-6 col-lg-5 d-none d-md-block">
              <img src="{{ asset('images/logo3.jpg') }}" alt="login form" class="img-fluid w-100 h-100" style="border-radius: 1rem 0 0 1rem; object-fit: cover;" />
            </div>
            <div class="col-md-6 col-lg-7 d-flex align-items-center">
              <div class="card-body p-4 p-lg-5 text-black">

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @if (session('error'))
                    <div class="alert alert-danger">{{ session('error') }}</div>
                @endif

                <form action="{{ route('login') }}" method="POST">
                    @csrf
                    <div class="d-flex align-items-center mb-3 pb-1">
                    </div>
                    <h5 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Sign into your account</h5>

                    <div class="form-outline mb-4">
                        <input type="email" name="email" class="form-control form-control-lg" required />
                        <label class="form-label">Email address</label>
                    </div>

                    <div class="form-outline mb-4">
                        <input type="password" name="password" class="form-control form-control-lg" required />
                        <label class="form-label">Password</label>
                    </div>

                    <div class="pt-1 mb-4">
                        <button class="btn btn-dark btn-lg btn-block" type="submit">Login</button>
                    </div>

                    <p class="mb-5 pb-lg-2" style="color: #393f81;">
                        Dont have an account? <a href="{{ route('register') }}" style="color: #393f81;">Register here</a>
                    </p>
                    <p class="mb-5 pb-lg-2" style="color: #393f81;">
                        forgot password? <a href="{{ route('password.reset') }}" style="color: #393f81;">reset password</a>
                    </p>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
</body>
</html>
