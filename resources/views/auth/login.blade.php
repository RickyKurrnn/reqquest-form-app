<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Login | Request System</title>

    {{-- Bootstrap 5 CDN --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    {{-- Font Awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>

<body class="bg-light">

    <div class="container vh-100 d-flex align-items-center justify-content-center">
        <div class="col-md-4">

            <div class="card shadow-sm border-0">
                <div class="card-body p-4">

                    <div class="text-center mb-4">
                        <h4 class="fw-bold mb-0">SCM Form Request</h4>
                        <small class="text-muted">Please login to continue</small>
                    </div>

                    {{-- ERROR MESSAGE --}}
                    @if ($errors->any())
                        <div class="alert alert-danger py-2">
                            {{ $errors->first() }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('login.process') }}">
                        @csrf

                        {{-- EMAIL --}}
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="fa-solid fa-envelope"></i>
                                </span>
                                <input type="email" name="email" class="form-control" value="{{ old('email') }}"
                                    placeholder="Enter your email" required>
                            </div>
                        </div>

                        {{-- PASSWORD --}}
                        <div class="mb-3">
                            <label class="form-label">Password</label>
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="fa-solid fa-lock"></i>
                                </span>
                                <input type="password" name="password" class="form-control"
                                    placeholder="Enter your password" required>
                            </div>
                        </div>

                        {{-- REMEMBER --}}
                        <div class="form-check mb-3">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember">
                            <label class="form-check-label" for="remember">
                                Remember Me
                            </label>
                        </div>

                        {{-- SUBMIT --}}
                        <button type="submit" class="btn btn-primary w-100">
                            <i class="fa-solid fa-right-to-bracket me-1"></i>
                            Login
                        </button>
                    </form>

                    <div class="text-center mt-3">
                        <small class="text-muted">
                            Don't have an account?
                            {{-- <a href="{{ route('register') }}" class="text-decoration-none fw-semibold">
                                Register here
                            </a> --}}
                            <a href="{{ route('register') }}" class="text-decoration-none">
                                Register here
                            </a>
                        </small>
                    </div>


                </div>
            </div>

            {{-- <div class="text-center mt-3">
            <small class="text-muted">
                © {{ date('Y') }} Request System
            </small>
        </div> --}}

        </div>
    </div>

</body>

</html>
