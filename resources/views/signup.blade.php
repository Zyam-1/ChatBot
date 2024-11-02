<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
        integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous">
    </script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://code.jquery.com/jquery-3.7.1.js"
        integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <title>Sign Up</title>
</head>

<body class="vh-100 d-flex justify-content-center align-items-center">
    <div class="w-25">
        <form class="border p-4" action = "{{route('home')}}">
            <h1>Sign Up</h1>
            <div class="form-group">
                <label for="txtName">Name</label>
                <input type="text" class="form-control" id="txtName" aria-describedby="NameHelp"
                    placeholder="Enter Name">
            </div>
            <div class="form-group mt-2">
                <label for="txtEmail">Email address</label>
                <input type="email" class="form-control" id="txtEmail" aria-describedby="emailHelp"
                    placeholder="Enter email">
            </div>
            <div class="form-group mt-2">
                <label for="txtPwd">Password</label>
                <input type="password" class="form-control" id="txtPwd" placeholder="Password">
            </div>
            <div class="d-flex justify-content-between form-group mt-2">
                <a href="{{route('login')}}">Already a member?</a>
                <div>
                    <label for="showpwd">Show Password</label>
                    <input type="checkbox" name="showpwd" id="showpwd">
                </div>
            </div>
            <button type="submit" class="btn btn-primary mt-2 mb-2">Submit</button>
        </form>
    </div>
</body>

</html>

<script>
    $(document).ready(function () {
        $("#showpwd").change(function () {
            if (this.checked) {
                $("#txtPwd").prop("type", "text");
            } else {
                $("#txtPwd").prop("type", "password");
            }
        });
    })

</script>
