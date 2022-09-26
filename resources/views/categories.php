<?php include_once 'menu.php'; ?>
<h2>Новости:</h2>

<ul>
<?php foreach ($categories as $category): ?>
    <li style="margin-bottom: 10px">
        <a href="<?=route('category', $category['id'])?>"><?=$category['title']?></a>
    </li>
<?php endforeach; ?>
</ul>
