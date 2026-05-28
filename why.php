<?php
$title = 'Why?';
require_once 'layout/head.php';
?>

<body class="min-h-screen flex flex-col">
    <?php require_once 'layout/navbar.php'; ?>

    <main class="flex-1">
        <section class="hero bg-base-200 py-20">
            <div class="hero-content text-center max-w-4xl">
                <div>
                    <h1 class="text-5xl font-bold">
                        Why FakeGen exists
                    </h1>

                    <p class="py-6 text-xl text-base-content/80">
                        Developers constantly need realistic test data.
                        Most tools are bloated, locked behind paywalls,
                        or collect unnecessary user data.
                    </p>

                    <p class="text-lg">
                        FakeGen was built to be fast, simple, privacy-friendly,
                        and actually useful.
                    </p>
                </div>
            </div>
        </section>

        <section class="max-w-6xl mx-auto px-4 py-16">
            <div class="grid gap-6 md:grid-cols-3">
                <div class="card bg-base-200 shadow-lg border-2 border-dashed hover:border-solid">
                    <div class="card-body">
                        <div class="text-4xl">⚡</div>
                        <h2 class="card-title">
                            Fast workflow
                        </h2>
                        <p>
                            Generate realistic fake names, emails,
                            phones, and other test data instantly
                            without wasting time configuring tools.
                        </p>
                    </div>
                </div>

                <div class="card bg-base-200 shadow-lg border-2 border-dashed hover:border-solid">
                    <div class="card-body">
                        <div class="text-4xl">🔒</div>
                        <h2 class="card-title">
                            Privacy first
                        </h2>
                        <p>
                            No accounts. No analytics obsession.
                            No selling user data.
                            Just generate what you need and leave.
                        </p>
                    </div>
                </div>

                <div class="card bg-base-200 shadow-lg border-2 border-dashed hover:border-solid">
                    <div class="card-body">
                        <div class="text-4xl">🧪</div>
                        <h2 class="card-title">
                            Built for developers
                        </h2>
                        <p>
                            Useful for testing forms, databases,
                            demos, UI states, authentication flows,
                            and development environments.
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <section class="bg-base-200 py-20">
            <div class="max-w-4xl mx-auto px-4 text-center">
                <h2 class="text-4xl font-bold mb-6">
                    Simple tools are better tools
                </h2>

                <p class="text-lg leading-relaxed text-base-content/80">
                    FakeGen is intentionally lightweight.
                    It is not trying to become a giant platform,
                    collect user profiles, or trap features behind subscriptions.
                </p>

                <p class="mt-6 text-lg leading-relaxed text-base-content/80">
                    The goal is straightforward:
                    help developers generate useful fake data quickly,
                    safely, and without friction.
                </p>
            </div>
        </section>
    </main>

    <?php require_once 'layout/footer.php'; ?>
</body>

</html>