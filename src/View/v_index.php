<div class="posts-wrapper">
    <ul>
        <? foreach($posts as $post) : ?>

            <li>
                <strong style="margin-bottom: 15px"><a href="<?= ROOT?>post/<?=$post['id_news']?>"><?=$post['title']?></a></strong>

                <?php if($is_admin):?>

                    <a class="edit-post" href="<?= ROOT?>post/edit/<?=$post['id_news']?>"><i class="fas fa-edit"></i></a>
                    <a class="delete-post" href="<?= ROOT?>post/delete/<?=$post['id_news']?>"><i class="fas fa-trash-alt"></i></a>

                <?php endif; ?>
            </li>   
        <? endforeach; ?>
    </ul>
</div>
<? if($is_admin) :?>
    
    <a href="<?= ROOT?>post/add">Добавить</a><br>

<? endif; ?>



