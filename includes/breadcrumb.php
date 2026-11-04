<?php
// Brotkrumen (nicht auf der Startseite). Pfad: breadcrumb_trail() – aus der URL oder per $meta['trail'].
$crumbs = breadcrumb_trail();
if ($crumbs): ?>
    <nav class="breadcrumb wrap" aria-label="<?= e(t('breadcrumb.label')) ?>">
        <ol class="breadcrumb__list">
            <?php foreach ($crumbs as $crumb): ?>
                <li>
                    <?php if ($crumb['href'] !== null): ?>
                        <a href="<?= e($crumb['href']) ?>"><?= e($crumb['label']) ?></a>
                        <span class="breadcrumb__sep" aria-hidden="true">/</span>
                    <?php else: ?>
                        <span aria-current="page"><?= e($crumb['label']) ?></span>
                    <?php endif; ?>
                </li>
            <?php endforeach; ?>
        </ol>
    </nav>
<?php endif; ?>
