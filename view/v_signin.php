<div class="col-sm-12 col-md-6 col-lg-6 offset-lg-1">
    <div class="form__block">
        <h2 class="form__title">Зарегестрироваться</h2>
        <div class="form__form">
            <form  class="contact-form" method="POST">
                <input type="text" class="form__input" placeholder="Имя" name="name">
                <input type="text" class="form__input" placeholder="Фамилия" name="surname">
                <input type="text" class="form__input" placeholder="Логин" name="login">
                <input type="password" class="form__input" placeholder="Пароль" name="password">
                <input type="submit" class="form__submit"  value="Зарегистрироваться">
            </form>
            <a href="<?= ROOT?>">Назад</a>
            <?= $error;?>
        </div> 
    </div>
</div>