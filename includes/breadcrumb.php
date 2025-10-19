<section class="breadcrumb pt-3 px-3 px-md-0">
    <div class="container">
        <nav aria-label="Brotkrumen">
            <ol class="breadcrumbs list-unstyled d-flex flex-wrap m-0 p-0">
                <?php
                $path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
                $segments = array_values(array_filter(explode('/', trim($path, '/'))));
                $segmentCount = count($segments);

                // Home
                $isHomeActive = ($segmentCount === 0);
                echo '<li' . ($isHomeActive ? ' class="active"' : '') . '>';

                if ($isHomeActive) {
                    echo '<span aria-current="page">'
                        . '<i class="bi bi-house-door-fill" aria-hidden="true"></i>'
                        . '<span class="visually-hidden">Startseite</span>'
                        . '</span>';
                } else {
                    echo '<a href="/" aria-label="Startseite">'
                        . '<i class="bi bi-house-door-fill" aria-hidden="true"></i>'
                        . '<span class="visually-hidden">Startseite</span>'
                        . '</a>';
                }
                echo '</li>';

                // Trail
                $url = '';
                foreach ($segments as $index => $segment) {
                    $url .= '/' . $segment;
                    $isLast = ($index === array_key_last($segments));
                    $label = htmlspecialchars($segment, ENT_QUOTES, 'UTF-8');
                    $href  = $url . '/';

                    if ($isLast) {
                        echo '<li class="active"><span aria-current="page">' . $label . '</span></li>';
                    } else {
                        echo '<li><a href="' . $href . '">' . $label . '</a></li>';
                    }
                }
                ?>
            </ol>
        </nav>
    </div>
</section>