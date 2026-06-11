<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="dashboard.css">
    <link rel="shortcut icon" href="img/favicon.png" type="image/x-icon">
</head>

<body>

<div class="container d-flex flex-column justify-content-center align-items-center vh-100">
    <img src="img/ngf_logo.png" alt="" class="header_logo mb-4">
    <div class="card shadow_bg p-4" style="width: 100%; max-width: 500px;">
        <h3 class="text-center mb-4">Login</h3>
        <form>
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" class="form-control" id="username" placeholder="Enter username" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" placeholder="Enter password" required>
            </div>
            <div class="form-group custom-radio">
                <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" id="remember" name="remember" class="custom-control-input">
                    <label class="custom-control-label" for="remember">Remember me</label>
                </div>
            </div>
            <button type="submit" class="btn btn-success btn-block">Login</button>
        </form>
    </div>
</div>

<style>
    label{
        font-size: 14px;
    }
</style>

</body>

</html>