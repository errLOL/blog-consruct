<div class="col-sm-12 col-md-6 col-lg-6 offset-lg-1">
    <div class="form__block">
        <h2 class="form__title">Добавить статью</h2>
        <div class="form__form">
            <form  class="contact-form" method="POST">
                <input type="text" class="form__input" placeholder="Название статьи" name="title" value="<?= $title;?>">
                <? if ($titleErr != '') :
                   foreach ($titleErr as $key => $value) : ?>
                       <div class="error"><?=$value?></div>
                   <?endforeach;
                endif;?>

                <div class="form__bg-pencil">
                    <textarea class="form__textarea" name="text" placeholder="Ваше сообщение"><?= $text;?></textarea>
                </div>
                <? if ($textErr != '') :
                   foreach ($textErr as $key => $value) : ?>
                       <div class="error"><?=$value?></div>
                   <?endforeach;
                endif;?>
                <input type="submit" class="form__submit"  value="Добавить">
            </form>
            <a href="<?= ROOT?>">Назад</a>
            
        </div> 
    </div>
</div>
