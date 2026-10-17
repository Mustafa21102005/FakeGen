<?php $typeGroups = require __DIR__ . '/types.php'; ?>
<?php foreach ($typeGroups as $group => $types): ?>
    <li class="menu-title"><?= $group ?></li>
    <?php foreach ($types as $value => $label): ?>
        <li><a href="generate.php?type=<?= $value ?>"><?= $label ?></a></li>
    <?php endforeach; ?>
<?php endforeach; ?>