<!DOCTYPE html>
<head>
    <link rel="stylesheet" type="text/css" href="public/css/style.css">
    <title>LOGIN PAGE</title>
</head>
<body>
    <div class="container">
        <div class="logo">
            <img src="public/img/logo.svg">
        </div>
        <div class="login-container">
            <form class="form_all" action="login" method="POST">
                <div class="login">
                    <div class="messages">
                        <?php if(isset($messages)){
                            foreach ($messages as $message) {
                                echo $message;
                            }
                        }
                        ?>
                    </div>
                    <p class="login_p1">Username</p>
                    <input class="login_field" name="email" type="email" placeholder="__________" >
                    <p class="login_p">Password</p>
                    <input class="login_field" name="password" type="password" placeholder="__________">
                </div>
                
                <button type="submit" class="btn vertical-margin-127px margin-left-auto">LOGIN</button>
                
            </form>
            <a href="register"</a>
            <div class="login-create">
                <p class="login_question">Don't have an account?</p>
                <button class="btn btn-create">Sign in</button>
            </div>
        </div>
    </div>
</body>