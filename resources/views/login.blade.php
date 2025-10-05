<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <!-- Using same Bootstrap as Create Student view -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2 class="mb-4">Login</h2>

        <!-- Success Message -->
        @if(session()->has('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="form-group">
                <label for="useremail">Email address</label>
                <input type="email" class="form-control @error('email') is-invalid @enderror"
                       id="email" name="email" value="{{ old('email') }}" required autofocus>
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="userpassword">Password</label>
                <input type="password" class="form-control @error('password') is-invalid @enderror"
                       id="password" name="password" required>
                @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary" onclick="this.disabled=true; this.form.submit();">Login</button>
        </form>

        <div class="mt-3">
            @guest
                <p>Don't have an account? <a href="{{ route('register') }}">Register here</a>.</p>
            @else
                <p>Already logged in? <a href="{{ route('dashboard') }}">Go to dashboard</a>.</p>
            @endguest
        </div>
    </div>
</body>
</html>
