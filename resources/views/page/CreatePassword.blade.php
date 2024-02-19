<?php
    $link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ganti Password</title>
</head>
<body>
    <div class="bg-img">
        <div class="content">
            <header>Ganti Password</header>
            <form action="<?php echo $link."/password/reset"; ?>" method="post">
                @csrf
                <div class="field">
                    <span class="fa fa-user fa-2x"></span>
                    <input type="password" placeholder="Email" required name="password">
                </div>
                <div class="field space">
                    <input type="submit" value="Send Reset Password Link">
                </div>
                <div class="link">
                    <a href="/login">Signin Now</a>
                    <a href="/register">Signup Now</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>