<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
</head>
<body>
    <section class="bg-image" style="height: 100vh; background-image: url('{{ asset('images/bg1.jpg') }}'); background-size: cover; background-position: center; background-repeat: no-repeat;">
    <div class="mask d-flex align-items-center h-100 gradient-custom-3">
        <div class="container h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-12 col-md-9 col-lg-7 col-xl-6">
                    <div class="card" style="border-radius: 15px; max-height: 600px; overflow-y: auto;"> <!-- Max height added -->
                        <div class="card-body p-5">
                            <h2 class="text-uppercase text-center mb-5">Create an account</h2>

                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul class="mb-0">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <form action="{{ route('register') }}" method="POST">
                                @csrf
                                <div class="form-outline mb-4">
                                    <input type="text" name="name" class="form-control" value="{{ old('name') }}" required />
                                    <label class="form-label">Your Name</label>
                                    @error('name')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-outline mb-4">
                                    <input type="email" name="email" class="form-control" value="{{ old('email') }}" required />
                                    <label class="form-label">Your Email</label>
                                    @error('email')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-outline mb-4">
                                    <input type="password" name="password" class="form-control" required />
                                    <label class="form-label">Password</label>
                                    @error('password')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-outline mb-4">
                                    <input type="password" name="password_confirmation" class="form-control" required />
                                    <label class="form-label">Repeat your password</label>
                                </div>

                                <!-- Select input untuk role, otomatis customer -->
                                <div class="form-outline mb-4">
                                <label class="form-label">Role</label>
                                <select name="role" class="form-control" readonly>
                                <option value="customer" selected>Customer</option>
                                </select>
                                </div>

                                <button type="submit" class="btn btn-primary btn-lg btn-block">Register</button>
                                <p class="text-center text-muted mt-5 mb-0">Have already an account? <a href="{{ route('login') }}" class="fw-bold text-body"><u>Login here</u></a></p>
                                <p class="text-center text-muted mt-5 mb-0">Forgot password? <a href="{{ route('password.reset') }}" class="fw-bold text-body"><u>reset password</u></a></p>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script src="{{ asset('js/bootstrap.min.js') }}"></script>
</body>
</html>
