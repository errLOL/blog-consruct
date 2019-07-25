<div class="col-sm-12 col-md-6 col-lg-6 offset-lg-1">
    <div class="form__block">
        <em><?=$post['dt'];?></em>
        <h2 class="form__title"><?=$post['title'];?></h2>
        <div><?= nl2br($post['text']);?></div>
    </div>
    <a href="<?= ROOT?>">Назад</a>
</div>
