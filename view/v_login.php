<div class="col-sm-12 col-md-6 col-lg-6 offset-lg-1">
    <div class="form__block">
        <h2 class="form__title">Войти</h2>
        <div class="form__form">
            <form  class="contact-form" method="POST">
                <input type="text" class="form__input" placeholder="Login" value="<?=$login?>" name="login">
                <div class="error"><?=$loginErr?></div>

                <input type="password" class="form__input" placeholder="Password" name="password">
                <div class="error"><?=$passwordErr?></div>
                <input type="checkbox" name="remember">Запомнить
                <input type="submit" class="form__submit"  value="Войти">
            </form>
            <a href="<?= ROOT?>">Назад</a>
        </div> 
    </div>
</div>