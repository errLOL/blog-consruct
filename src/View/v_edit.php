<div class="col-sm-12 col-md-6 col-lg-6 offset-lg-1">
    <div class="form__block">
        <h2 class="form__title">Редактировать статью</h2>
        <div class="form__form">
            <form  class="contact-form" <?=$form->method();?>>   
                <? echo $form->inputSign();
                foreach ($form->fields() as $input) {
                    echo $input;
                }
                ?>
            </form>
            <a href="<?= ROOT?>">Назад</a>
        </div> 
    </div>
</div>