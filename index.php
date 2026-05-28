<?php
$title = 'Welcome';
require_once 'layout/head.php';
?>

<body class="min-h-screen flex flex-col">
    <?php require_once 'layout/navbar.php'; ?>

    <div class="hero bg-base-200 min-h-110">
        <div class="hero-content text-center">
            <div class="max-w-5xl">
                <h1 class="text-6xl font-bold">Generate realistic test data in seconds.</h1>
                <p class="py-5 text-2xl">
                    Realistic fake data for your next project, ready in one click.
                </p>
                <a href="generate.php" class="btn btn-primary btn-lg">Start Now!</a>
            </div>
        </div>
    </div>

    <div class="flex flex-wrap gap-5 justify-center pb-10">
        <div class="min-w-sm card bg-base-200 shadow-lg transition">
            <div class="card-body border-2 border-dashed rounded-2xl items-center text-center hover:border-solid">
                <span class="text-4xl">🔒</span>
                <h2 class="card-title">Safe</h2>
                <p>No signups. No tracking. No nonsense.</p>
            </div>
        </div>
        <div class="min-w-sm card bg-base-200 shadow-lg transition">
            <div class="card-body items-center border-2 border-dashed rounded-2xl text-center hover:border-solid">
                <span class="text-4xl">💵</span>
                <h2 class="card-title">Free</h2>
                <p>100% free, forever.</p>
            </div>
        </div>
        <div class="min-w-sm card bg-base-200 shadow-lg transition">
            <div class="card-body items-center border-2 border-dashed rounded-2xl text-center hover:border-solid">
                <span class="text-4xl">📊</span>
                <h2 class="card-title">No data collection</h2>
                <p>Your data stays yours. Actually, there is no data.</p>
            </div>
        </div>
    </div>

    <?php require_once 'layout/footer.php'; ?>
</body>

</html>