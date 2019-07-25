<div class="col-sm-12 col-md-6 col-lg-6 offset-lg-1">
    <div class="form__block">
        <h2 class="form__title">Зарегестрироваться</h2>
        <div class="form__form">
            <form  class="contact-form" method="POST">
                <input type="text" class="form__input" placeholder="Имя" value="<?= $name;?>" name="name">
                <? if ($nameErr != '') :
                   foreach ($nameErr as $key => $value) : ?>
                       <div class="error"><?=$value?></div>
                   <?endforeach;
                endif;?>
                <input type="text" class="form__input" placeholder="Фамилия" value="<?= $surname;?>" name="surname">
                <? if ($surnameErr != '') :
                   foreach ($surnameErr as $key => $value) : ?>
                       <div class="error"><?=$value?></div>
                   <?endforeach;
                endif;?>
                <input type="text" class="form__input" placeholder="Логин" value="<?= $login;?>" name="login">
                <? if ($loginErr != '') :
                   foreach ($loginErr as $key => $value) : ?>
                       <div class="error"><?=$value?></div>
                   <?endforeach;
                endif;?>
                <input type="password" class="form__input" placeholder="Пароль" name="password">
                <? if ($passwordErr != '') :
                   foreach ($passwordErr as $key => $value) : ?>
                       <div class="error"><?=$value?></div>
                   <?endforeach;
                endif;?>
                <input type="submit" class="form__submit"  value="Зарегистрироваться">
            </form>
            <a href="<?= ROOT?>">Назад</a>
        </div> 
    </div>
</div>