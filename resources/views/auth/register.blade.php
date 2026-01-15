<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Register | Request System</title>

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
                        <small class="text-muted">Create your account</small>
                    </div>

                    {{-- ERROR MESSAGE --}}
                    @if ($errors->any())
                        <div class="alert alert-danger py-2">
                            {{ $errors->first() }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('register.process') }}">
                        @csrf

                        {{-- NAME --}}
                        <div class="mb-3">
                            <label class="form-label">Name</label>
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="fa-solid fa-user"></i>
                                </span>
                                <input type="text" name="name" class="form-control" value="{{ old('name') }}"
                                    placeholder="Enter your name" required>
                            </div>
                        </div>

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
                                    placeholder="Create a password" required>
                            </div>
                        </div>

                        {{-- CONFIRM PASSWORD --}}
                        <div class="mb-3">
                            <label class="form-label">Confirm Password</label>
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="fa-solid fa-lock"></i>
                                </span>
                                <input type="password" name="password_confirmation" class="form-control"
                                    placeholder="Confirm your password" required>
                            </div>
                        </div>

                        {{-- SUBMIT --}}
                        <button type="submit" class="btn btn-primary w-100">
                            <i class="fa-solid fa-user-plus me-1"></i>
                            Register
                        </button>
                    </form>

                    <div class="text-center mt-3">
                        <small class="text-muted">
                            Already have an account?
                            <a href="{{ route('login') }}" class="text-decoration-none">Login</a>
                        </small>
                    </div>

                </div>
            </div>

        </div>
    </div>

</body>

</html>
