<?php declare(strict_types=1); ?>
<h1>
    <?php eh($data['title']); ?>: list
</h1>
<?php view('example/parts/search', $data); ?>
<?php view('example/parts/table', $data); ?>
<?php view('example/parts/register', $data); ?>