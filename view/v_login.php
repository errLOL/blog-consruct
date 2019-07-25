<div class="col-sm-12 col-md-6 col-lg-6 offset-lg-1">
    <div class="form__block">
        <h2 class="form__title">Войти</h2>
        <div class="form__form">
            <form  class="contact-form" method="POST">
                <input type="text" class="form__input" placeholder="Login" name="name">
                <input type="password" class="form__input" placeholder="Password" name="password">
                <input type="checkbox" name="remember">Запомнить
                <input type="submit" class="form__submit"  value="Войти">
            </form>
            <a href="<?= ROOT?>">Назад</a>
            <?= $msg;?>
        </div> 
    </div>
</div>