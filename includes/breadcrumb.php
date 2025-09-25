<section class="breadcrumb pt-3 px-3 px-md-0">
            <div class="container">
                <p>
                    <code>/ 
                    <?php
                    $path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
                    $segments = array_filter(explode('/', trim($path, '/')));
                    $segmentCount = count($segments);

                    // Startseite
                    echo '<a href="/" class="' . (empty($segments) ? ' active' : '') . '">home</a>';

                    // Breadcrumb generieren
                    $url = '';
                    foreach ($segments as $index => $segment) {
                        $url .= '/' . $segment;
                        $isLast = ($index === array_key_last($segments));
                        $class = ($isLast ? ' active' : '');

                        // Wenn letzter Pfad → kein Link mehr
                        if ($isLast) {
                            echo ' / <span class="' . $class . '">' . htmlspecialchars($segment) . '</span>';
                        } else {
                            echo ' / <a href="' . $url . '/" class="' . $class . '">' . htmlspecialchars($segment) . '</a>';
                        }
                    }

                    echo ' /';
                    ?>
                    </code>
                </p>
            </div>
        </section>
