<?php include_once __DIR__ . '/../menu.php'; ?>
<h2>Новости:</h2>

<ul>
<?php foreach ($news as $article): ?>
    <?php if ($article['id'] !== '#'): ?>
        <li style="margin-bottom: 10px">
            <a href="<?=route('news')?>/<?=$article['id']?>"><?=$article['title']?></a>
        </li>
    <?php else: ?>
        <?=$article['title']?>
    <?php endif; ?>
<?php endforeach; ?>
</ul>
