<!DOCTYPE html>
<head>
    <link rel="stylesheet" type="text/css" href="public/css/style.css">
    <title>SIGN IN PAGE</title>
</head>
<body>
    <div class="container">
        <div class="logo">
            <img src="public/img/logo.svg">
        </div>
        <div class="login-container">
            <form class="form_all" action="register" method="POST">
                <div class="register">
                    <div class="messages">
                        <?php if(isset($messages)){
                            foreach ($messages as $message) {
                                echo $message;
                            }
                        }
                        ?>
                    </div>
                    <input name="email" type="text" placeholder="email@email.com">
                    <input name="password" type="password" placeholder="password">
                    <input name="confirmedPassword" type="password" placeholder="confirm password">
                    <input name="name" type="text" placeholder="name">
                    <input name="surname" type="text" placeholder="surname">
                    <input name="phone" type="text" placeholder="phone">
                    <button type="submit">Sign in</button>
                </div>
                
            </form>
        </div>
    </div>
</body>