<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login &mdash; {{ config('app.name') }}</title>
    <link href="https://fonts.googleapis.com/css2?family=Bricolage+Grotesque:opsz,wght@12..96,400;600;700&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        body {
            font-family: 'Bricolage Grotesque', sans-serif;
            background: #091a0d;
            background-image: radial-gradient(ellipse at 20% 50%, rgba(13,64,28,0.8) 0%, transparent 60%),
                              radial-gradient(ellipse at 80% 20%, rgba(248,195,44,0.06) 0%, transparent 50%);
            display: flex; align-items: center; justify-content: center; min-height: 100vh;
        }
        .login-wrap { width: 100%; max-width: 420px; padding: 20px; }
        .login-brand { text-align: center; margin-bottom: 32px; }
        .login-brand .brand-icon {
            width: 56px; height: 56px; background: #f8c32c; border-radius: 14px;
            display: flex; align-items: center; justify-content: center;
            margin: 0 auto 12px; font-size: 24px; color: #0d401c;
        }
        .login-brand h1 { font-size: 26px; font-weight: 700; color: #fff; letter-spacing: -0.5px; }
        .login-brand p { color: #6b9c78; font-size: 14px; margin-top: 4px; }
        .login-card { background: #fff; border-radius: 16px; padding: 36px 36px 40px; box-shadow: 0 24px 80px rgba(0,0,0,0.4); }
        .form-group { margin-bottom: 18px; }
        .form-group label { display: block; font-size: 13px; font-weight: 600; color: #374151; margin-bottom: 6px; }
        .form-control {
            width: 100%; padding: 11px 14px;
            border: 1.5px solid #e2e8df; border-radius: 8px;
            font-size: 15px; font-family: inherit;
            transition: border-color .2s, box-shadow .2s; outline: none;
        }
        .form-control:focus { border-color: #0d401c; box-shadow: 0 0 0 3px rgba(13,64,28,0.1); }
        .form-control.is-invalid { border-color: #dc3545; }
        .invalid-feedback { color: #dc3545; font-size: 12px; margin-top: 4px; }
        .alert-danger { background: #fef2f2; border: 1px solid #fecaca; border-radius: 8px; padding: 12px 14px; color: #7f1d1d; font-size: 14px; margin-bottom: 18px; }
        .btn-login {
            width: 100%; padding: 13px;
            background: #0d401c; color: #fff;
            border: none; border-radius: 8px;
            font-size: 15px; font-weight: 600; font-family: inherit;
            cursor: pointer; transition: background .2s;
            display: flex; align-items: center; justify-content: center; gap: 8px;
        }
        .btn-login:hover { background: #155c28; }
        .btn-login .accent-dot { width: 8px; height: 8px; background: #f8c32c; border-radius: 50%; }
        .remember-row { display: flex; align-items: center; gap: 8px; margin-bottom: 20px; }
        .remember-row input[type="checkbox"] { width: 15px; height: 15px; accent-color: #0d401c; cursor: pointer; }
        .remember-row label { font-size: 14px; color: #555; cursor: pointer; }
    </style>
</head>
<body>
    <div class="login-wrap">
        <div class="login-brand">
            <div class="brand-icon">&#127807;</div>
            <h1>{{ config('app.name') }}</h1>
            <p>Admin Panel &mdash; Sign in to continue</p>
        </div>

        <div class="login-card">
            @if($errors->any())
            <div class="alert-danger">{{ $errors->first() }}</div>
            @endif

            <form method="POST" action="{{ route('admin.login.post') }}">
                @csrf
                <div class="form-group">
                    <label for="email">Email Address</label>
                    <input type="email" id="email" name="email"
                        class="form-control @error('email') is-invalid @enderror"
                        value="{{ old('email') }}" required autofocus>
                    @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password"
                        class="form-control @error('password') is-invalid @enderror" required>
                    @error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="remember-row">
                    <input type="checkbox" id="remember" name="remember">
                    <label for="remember">Keep me signed in</label>
                </div>
                <button type="submit" class="btn-login">
                    <span class="accent-dot"></span> Sign In
                </button>
            </form>
        </div>
    </div>
</body>
</html>
