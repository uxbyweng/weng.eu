<style>
    .pg-nav-list {
        list-style: none;
        margin: 0;
        padding: 0;
        display: flex;
        flex-direction: column;
        gap: 0.25rem;
    }
    .pg-nav a {
        display: block;
        padding: 0.5rem 0.4rem;
        border-radius: 8px;
        text-decoration: none;
    }
    .pg-nav a:hover {
        text-decoration: underline;
    }
    .pg-nav a.active {
        font-weight: 600;
        background: rgba(0, 0, 0, 0.06);
    }
    [data-bs-theme="dark"] .pg-nav a.active {
        background: rgba(255, 255, 255, 0.08);
    }
    .pg-version-list {
        list-style: none;
        padding: 0;
        margin: 0;
        display: flex;
        flex-direction: column;
        gap: 0.25rem;
    }
    .pg-version-list li a {
        display: flex;
        justify-content: space-between;
        gap: 8px;
        padding: 0.35rem 0.5rem;
        border-radius: 6px;
        text-decoration: none;
    }
    .pg-version-list li a:hover {
        background: rgba(0, 0, 0, 0.06);
        text-decoration: underline;
    }
    [data-bs-theme="dark"] .pg-version-list li a:hover {
        background: rgba(255, 255, 255, 0.08);
    }
    .pg-version-list .time {
        opacity: 0.7;
        font-variant-numeric: tabular-nums;
    }
</style>
<section class="my-5">
    <?php
        $items = [
        ['path' => '/playground/canvas/',   'de' => 'Canvas',       'en' => 'Canvas'],
        ['path' => '/playground/console/',  'de' => 'JS Console',   'en' => 'JS Console'],
        ['path' => '/playground/library/',  'de' => 'Library',      'en' => 'Library'],
        ['path' => '/playground/tdd/',      'de' => 'TDD',          'en' => 'TDD'],
        ];
        $currentPath = rtrim(parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH) ?? '/', '/') . '/';
        $en = is_en();
    ?>
    <nav class="pg-nav" aria-label="<?= $en ? 'Playground navigation' : 'Playground-Navigation' ?>">
        <h2 class="fs-20 text-uppercase">
            <strong><?= $en ? 'Playground' : 'Playground' ?></strong>
        </h2>
        <ul class="pg-nav-list">
            <?php foreach ($items as $it):
                $active = ($currentPath === $it['path']);
            ?>
            <li>
                <a href="<?= e($it['path']) ?>"
                    class="<?= $active ? 'active' : '' ?>"
                    aria-current="<?= $active ? 'page' : 'false' ?>">
                    <?= e($en ? $it['en'] : $it['de']) ?>
                </a>
            </li>
            <?php endforeach; ?>
        </ul>
    </nav>
</section>