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
    <title>login</title>
    <link rel="stylesheet" href="{{ asset("css/verifyEmail.css") }}">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <script>
        var csrfToken = "{{ csrf_token() }}";
        var dataResponse = "{{ $data }}";
        var message = "{{ $message }}";
    </script>
</head>

<body>
    @csrf
    <div class="bg-img">
        <div class="content">
            <header>Login Form</header>
            <form action="<?php echo $link."/users/login"; ?>" method="post">
                <div class="field">
                    <span class="fa fa-user fa-2x"></span>
                    <input type="text" required name="verify">
                </div>
                {{-- <div class="field space">
                    <input type="submit" value="LOGIN">
                </div> --}}
                <div class="login">Or Login with </div>
                <a href="<?php echo $link."/login"; ?>">Halaman Login</a><br>
                <div class="signup">Don't have account ?
                    <a href="/register">Signup Now</a>
                </div>
            </form>
        </div>
    </div>
    <button id="Verify">Verify</button>
    <script src="{{ asset("js/verifyEmail.js") }}"></script>
</body>

</html>