<div class="page_heading">
    Регистрация
</div>
<div class="content regpage container">
    <div class="errorbox"><? echo @$_SESSION['regerror']; $_SESSION['regerror'] = ""; ?></div>
    <form class="regform" method="post">
        <div class="form">
            <div class="row">
                <input type="text" name="email" id="email_input" placeholder=" " required>
                <label for="email_input" class="caption">E-mail</label>
            </div>
            <div class="row">
                <input type="password" name="password" id="password_input" placeholder=" " required>
                <label for="password_input" class="caption">Пароль</label>
            </div>
            <div class="row">
                <input type="text" name="name" id="name_input" placeholder=" " required>
                <label for="name_input" class="caption">Ваше имя</label>
            </div>
            <div class="row">
                <input type="date" name="birthday" id="birthday_input" placeholder=" " required>
                <label for="birthday_input" class="caption static">День рождения</label>
            </div>
            <div style="text-align: right;">
                <input type="submit" name="register_request" value="Зарегистрироваться">
            </div>
        </div>
    </form>
    <div class="linktologin">Уже зарегистрированы? <a href="/login">Войти →</a></div>
</div>