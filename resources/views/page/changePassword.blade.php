<?php
    if(app()->environment('local')){
    $tPath = '';
}else{
    $tPath = '/public/';
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ganti Password</title>
    <link rel="stylesheet" href="{{ asset($tPath."../css/page/changePassword.css") }}">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</head>
<body>
    <script>
        var nama,username;
        var csrfToken = "{{ csrf_token() }}";
        var email = "{{$email}}";
        var div = "{{$div}}";
        var desc = "{{$description}}";
        var code = "{{$code}}";
        var link = "{{$link}}";
        console.log(div);
        console.log(div == 'register');
        console.log(div == 'verify');
        console.log(div === 'register');
        console.log(div === 'verify');
        // Get the "verify" div element by its ID
        var verifyDiv = document.getElementById('verify');
        var registerDiv = document.getElementById('register');
        if(div == 'register'){
            verifyDiv.style.display = 'none';
            registerDiv.style.display = 'block';
        }else if(div == 'verify'){
            verifyDiv.style.display = 'block';
            registerDiv.style.display = 'none';
        }
    </script>
    
    @csrf
    <div class="bg-img">
        <div class="content" id="verify">
            <header>Ganti Password</header>
            <form id="verifyChange" method="POST">
                <div class="field">
                    <span class="fa fa-lock fa-1x"></span>
                    <input type="password" class="password" required placeholder="Password" name="pass">
                    <span class="show">SHOW</span>
                </div>
                <div class="field">
                    <span class="fa fa-lock fa-1x"></span>
                    <input type="password" class="password" required placeholder="Password" name="pass_new">
                    <span class="show">SHOW</span>
                </div>
                <div class="field space">
                    <input type="submit" value="Reset Password">
                </div>
                <div class="link">
                    <a href="/login">Signin Now</a>
                    <a href="/register">Signup Now</a>
                </div>
            </form>
        </div>
        <div class="content" id="register">
            <header>Register Password</header>
            <form id="RegisterPass" method="POST">
                <div class="field">
                    <span class="fa fa-lock fa-1x"></span>
                    <input type="password" class="password" required placeholder="Password" name="pass">
                    <span class="show">SHOW</span>
                </div>
                <div class="field">
                    <span class="fa fa-lock fa-1x"></span>
                    <input type="password" class="password" required placeholder="Password" name="pass_new">
                    <span class="show">SHOW</span>
                </div>
                <div class="field space">
                    <input type="submit" value="Reset Password">
                </div>
                <div class="link">
                    <a href="/login">Signin Now</a>
                    <a href="/register">Signup Now</a>
                </div>
            </form>
        </div>
    </div>
    <script src="{{ asset($tPath."js/page/changePassword.js") }}"></script>
</body>
</html>