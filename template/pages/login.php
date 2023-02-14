<div class="page_heading">
    Авторизация
</div>
<div class="content loginpage container">
    <div class="errorbox"><? echo @$_SESSION['loginerror']; $_SESSION['loginerror'] = ""; ?></div>
    <form class="loginform" method="post">
        <div class="form">
            <div class="row">
                <input type="text" name="email" id="email_input" placeholder=" " required>
                <label for="email_input" class="caption">E-mail</label>
            </div>
            <div class="row">
                <input type="password" name="password" id="password_input" placeholder=" " required>
                <label for="password_input" class="caption">Пароль</label>
            </div>
            <div style="text-align: right;">
                <input type="submit" name="login_request" value="Войти">
            </div>
        </div>
    </form>
    <div class="linktoregister">Не зарегистрированы? <a href="/signup">Регистрация →</a></div>
</div>