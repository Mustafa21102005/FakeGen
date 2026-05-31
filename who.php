<?php
$title = 'Who Built FakeGen';
$description = 'FakeGen was built by Mustafa Azmi, a developer passionate about useful, privacy-first tools. Learn more about the author and the project.';
$keywords = 'FakeGen author, Mustafa Azmi, about FakeGen, who made FakeGen';
$canonical = 'https://fakegen.infinityfreeapp.com/who.php';
require_once 'layout/head.php';
?>

<body class="min-h-screen flex flex-col">
    <?php require_once 'layout/navbar.php'; ?>

    <section class="relative overflow-hidden px-6 pt-24 pb-20 max-w-5xl mx-auto w-full">
        <div class="flex flex-col md:flex-row items-center gap-12">
            <div class="relative shrink-0">
                <div class="w-48 h-48 rounded-3xl overflow-hidden border shadow-2xl">
                    <img src="/public/mustafa.png" alt="Mustafa" class="w-full h-full object-cover" />
                </div>
                <div class="absolute -bottom-3 -right-3 shadow-lg border-0 badge badge-secondary badge-lg">
                    Full Stack Developer
                </div>
            </div>

            <div class="flex-1 text-center md:text-left">
                <p class="tracking-[0.2em] uppercase font-medium mb-3">Who? Me?</p>
                <h1 class="text-5xl md:text-6xl mb-6">
                    I'm <span class="text-secondary">Mustafa.</span>
                </h1>
                <p class="text-lg max-w-lg">
                    A developer, a learner, and someone who thinks dummy data should actually look real.
                    FakeGen is one of many projects I build to sharpen my skills and solve real problems.
                </p>
                <div class="flex gap-3 mt-5 justify-center md:justify-start flex-wrap">
                    <a href="https://mustafa-azmi.netlify.app/" target="_blank" rel="noopener noreferrer" class="btn btn-secondary">
                        See my portfolio
                    </a>
                    <a href="https://github.com/Mustafa21102005" target="_blank" rel="noopener noreferrer" class="btn btn-outline">
                        See my GitHub
                    </a>
                </div>
            </div>
        </div>
    </section>

    <div class="max-w-5xl mx-auto px-6 pb-24 space-y-6 w-full">
        <div class="grid grid-cols-3 gap-4">
            <div class="border-2 border-dashed rounded-2xl p-5 text-center hover:border-solid">
                <p class="text-3xl font-black text-secondary">12+</p>
                <p class="text-sm mt-1">Projects built</p>
            </div>
            <div class="border-2 border-dashed rounded-2xl p-5 text-center hover:border-solid">
                <p class="text-3xl font-black text-secondary">∞</p>
                <p class="text-sm mt-1">Things to learn</p>
            </div>
            <div class="border-2 border-dashed rounded-2xl p-5 text-center hover:border-solid">
                <p class="text-3xl font-black text-secondary">1</p>
                <p class="text-sm mt-1">Obsession: Quality</p>
            </div>
        </div>
    </div>

    <?php require_once 'layout/footer.php'; ?>
</body>

</html>