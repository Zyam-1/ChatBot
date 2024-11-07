<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" 
          integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" 
          crossorigin="anonymous">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
          integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
          crossorigin="anonymous" referrerpolicy="no-referrer" />
    
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.1.js"
            integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" 
            crossorigin="anonymous"></script>
    
    <style>
        /* Custom Styles */
        body {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            background: #f4f6f9;
            font-family: Arial, sans-serif;
        }

        .signup-container {
            width: 100%;
            max-width: 360px;
            padding: 30px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            text-align: center;
        }

        .signup-container h2 {
            margin-bottom: 20px;
            font-size: 24px;
            font-weight: bold;
            color: #333;
        }

        .form-control {
            border-radius: 5px;
        }

        .form-check-label {
            font-size: 0.9rem;
        }

        .error-text {
            color: #d9534f;
            font-size: 0.85rem;
        }

        .btn-primary {
            width: 100%;
            border-radius: 5px;
            padding: 10px;
            background-color: #0069d9;
        }

        .footer-links {
            font-size: 0.9rem;
            color: #6c757d;
        }
    </style>
</head>

<body>
    <div class="signup-container">
        <h2>Create Account</h2>
        <form method="POST" action="{{ route('authenticate') }}">
            @csrf
            <div class="mb-3">
                <label for="txtName" class="form-label">Name</label>
                <input value="{{ old('name') }}" type="text" class="form-control" name="name" id="txtName" 
                       placeholder="Enter Name" required
                       style="@error('name') border-color:red; @enderror">
                @error("name")
                    <div class="error-text">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="txtEmail" class="form-label">Email address</label>
                <input value="{{ old('email') }}" type="email" class="form-control" name="email" id="txtEmail" 
                       placeholder="Enter email" required
                       style="@error('email') border-color:red; @enderror">
                @error("email")
                    <div class="error-text">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="txtPwd" class="form-label">Password</label>
                <input type="password" class="form-control" name="password" id="txtPwd" placeholder="Enter password" required
                       style="@error('password') border-color:red; @enderror">
                @error("password")
                    <div class="error-text">{{ $message }}</div>
                @enderror
            </div>

            <div class="d-flex justify-content-between align-items-center mb-3">
                <a href="{{ route('login') }}" class="footer-links">Already a member?</a>
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="showpwd">
                    <label class="form-check-label" for="showpwd">Show Password</label>
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Sign Up</button>
        </form>
    </div>

    <script>
        $(document).ready(function () {
            $("#showpwd").change(function () {
                $("#txtPwd").attr("type", this.checked ? "text" : "password");
            });
        });
    </script>
</body>

</html>