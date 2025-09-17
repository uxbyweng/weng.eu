<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/includes/helpers.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/includes/head.php';

$meta = [
  'title' => 'WENG.EU - Testgetriebene Entwicklung (TDD)',
  'desc'  => 'Ein Crashkurs in testgetriebener Entwicklung (TDD).',
  'og_image' => '',
];
$cspNonce = $_SERVER['CSP_NONCE'] ?? null;

echo render_head($meta, $cspNonce);
?>

<body>

    <?php include $_SERVER['DOCUMENT_ROOT'].'/includes/header_neu.php'; ?>

    <main class="page-wrapper" id="startMainContent">

    <!-- ### BREADCRUMB ### -->  
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/breadcrumb.php'; ?>

    <!-- ### STAGE ### -->    
    <section class="px-3 px-md-0 py-2 py-md-5">
        <div class="container">
            <div class="row">

                <div class="col-12 col-md-7 order-1">
                    <h1>
                        <span class="font-accent">Crashkurs</span> in testgetriebener <br>
                        Entwicklung (TDD)</span>
                    </h1>
                </div>

                <div class="col-12 col-md-5 text-center order-2 order-md-3 p-4 mt-150-md">
                    <img src="/assets/img/test/tdd-cycle-edited.webp" alt="TDD">
                </div>

                <div class="col-12 col-md-7 order-3 order-md-2"> 
                    <p class="fs-20 lh-1-5 my-3">
                        <em>TDD (Test-Driven Development) ist ein Vorgehen, bei dem du erst den Test schreibst und dann den Code, der ihn erfüllt. Das Motto: Red → Green → Refactor</em>
                    </p>
                    <p><strong>Ablauf:</strong></p>
                    <ul>
                        <li>
                            <i class="fa-solid fa-check"></i> 
                            <strong>Red:</strong> Schreibe einen Test, der fehlschlägt.
                        </li>
                        <li>
                            <i class="fa-solid fa-check"></i> 
                            <strong>Green:</strong> Schreibe den minimalen Code, um den Test zu bestehen.
                        </li>
                        <li>
                            <i class="fa-solid fa-check"></i> 
                            <strong>Refactor:</strong> Optimiere den Code, ohne die Tests zu brechen.
                        </li>
                    </ul>
                </div>

            </div>
        </div>
    </section>

    <section class="px-3 px-md-0 py-2 py-md-5">
        <div class="container">
            <div class="row">

                <div class="col-12 col-md-7 order-1">
                    <h2>
                        Beispiel (JavaScript / JUnit-artig):
                    </h2>  
                    <code><pre class="language-js">
                        // 1. Test (Fehlschlag erwartet)
                        function add(a, b) {
                            return a - b; // Falscher Code
                        }
                        test(&#x27;addiert zwei Zahlen&#x27;, () =&#x3E; {
                            expect(add(2, 3)).toBe(5);
                        });
                    </pre></code>
                </div>

            </div>
        </div>
    </section> 
    <span class="star-rating" style="--rating: 3;"></span>

    <style>
        .star-rating::after {
            content: '★ ★ ★ ★ ★';
            --rating-percent: calc(var(--rating) / 5 * 100%);
            background: linear-gradient(90deg,
            red var(--rating-percent),
            grey var(--rating-percent));
            background-clip: text;
            white-space: nowrap;
            color: transparent;
        }
    </style>





</main>

<script>
function test(description, fn) {
    try {
        fn();
        console.log('✔️ ' + description);
    } catch (error) {
        console.error('❌ ' + description);
        console.error(error);
    }
}
function expect(actual) {
    return {
        toBe(expected) {
            if (actual !== expected) {
                throw new Error(`Expected ${actual} to be ${expected}`);
            }
        }
    };
}

// Beispiel
function add(a, b) {
    return a + b;
}


test('addiert zwei Zahlen', () => {
    expect(add(2, 3)).toBe(5);
});
</script>

<?php
include( $_SERVER[ "DOCUMENT_ROOT" ] . "/includes/footer.php" );
?>

