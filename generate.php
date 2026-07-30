<?php
$title = 'Generate';
$description = 'Generate realistic fake names, emails, and phone numbers in one click. Copy to clipboard or download as JSON — fast, free, and private.';
$keywords = 'generate fake names, fake emails, fake phone numbers, dummy data, JSON test data';
$canonical = 'https://fakegen.infinityfreeapp.com/generate.php';
require_once 'layout/head.php';
?>

<body class="min-h-screen flex flex-col">
    <?php require_once 'layout/navbar.php'; ?>

    <main class="flex-1">
        <section class="bg-gradient-to-b from-base-200 to-base-100 border-b border-base-300">
            <div class="max-w-7xl mx-auto px-4 py-20">
                <div class="text-center max-w-3xl mx-auto">
                    <div class="badge badge-primary brightness-90 badge-outline mb-5">
                        Fast • Free • Privacy Friendly
                    </div>
                    <h1 class="text-5xl md:text-6xl font-bold leading-tight">
                        Generate realistic
                        <span class="text-primary brightness-90">fake data</span>
                        instantly
                    </h1>
                    <p class="py-6 text-xl text-base-content/70">
                        Create fake names, emails, and phone numbers for testing, demos, development, and prototypes.
                    </p>
                </div>
            </div>
        </section>

        <section class="max-w-7xl mx-auto px-4 py-16">
            <div class="grid lg:grid-cols-5 gap-8">
                <div class="lg:col-span-2">
                    <div class="card bg-base-200 shadow-2xl border border-base-300 sticky top-6">
                        <div class="card-body">
                            <div class="mb-4">
                                <h2 class="card-title text-3xl">
                                    Generator
                                </h2>

                                <p class="text-base-content/70 mt-2">
                                    Configure your fake data output.
                                </p>
                            </div>

                            <form id="generatorForm" class="space-y-6">
                                <!-- Type -->
                                <div>
                                    <label class="label">
                                        <span class="label-text font-medium">
                                            Data Type
                                        </span>
                                    </label>
                                    <select name="type" class="select w-full select-lg" required>
                                        <option disabled selected>
                                            Select a type
                                        </option>

                                        <option value="name"
                                            <?= isset($_GET['type']) && $_GET['type'] == 'name' ? 'selected' : '' ?>>
                                            Fake Names
                                        </option>

                                        <option value="email"
                                            <?= isset($_GET['type']) && $_GET['type'] == 'email' ? 'selected' : '' ?>>
                                            Fake Emails
                                        </option>

                                        <option value="phone"
                                            <?= isset($_GET['type']) && $_GET['type'] == 'phone' ? 'selected' : '' ?>>
                                            Fake Phones
                                        </option>

                                        <option value="color"
                                            <?= isset($_GET['type']) && $_GET['type'] == 'color' ? 'selected' : '' ?>>
                                            Fake Colors
                                        </option>

                                        <option value="password"
                                            <?= isset($_GET['type']) && $_GET['type'] == 'password' ? 'selected' : '' ?>>
                                            Fake Passwords
                                        </option>
                                    </select>
                                </div>

                                <!-- Quantity -->
                                <div>
                                    <label class="label">
                                        <span class="label-text font-medium">
                                            Quantity
                                        </span>
                                    </label>

                                    <input type="number" name="quantity" min="1" placeholder="Max is 10,000 😁" max="10000" class="input input-lg w-full" required>
                                </div>

                                <div id="passwordOptions" class="hidden space-y-4">
                                    <div>
                                        <label class="label">
                                            <span class="label-text font-medium">
                                                Password Length
                                            </span>
                                        </label>

                                        <input
                                            type="number"
                                            name="length"
                                            min="4"
                                            max="256"
                                            value="16"
                                            class="input input-lg w-full">
                                    </div>

                                    <div class="space-y-2">
                                        <label class="cursor-pointer label justify-start gap-3">
                                            <input type="checkbox" name="uppercase" class="checkbox" checked>
                                            <span class="label-text">Uppercase Letters</span>
                                        </label>

                                        <label class="cursor-pointer label justify-start gap-3">
                                            <input type="checkbox" name="lowercase" class="checkbox" checked>
                                            <span class="label-text">Lowercase Letters</span>
                                        </label>

                                        <label class="cursor-pointer label justify-start gap-3">
                                            <input type="checkbox" name="numbers" class="checkbox" checked>
                                            <span class="label-text">Numbers</span>
                                        </label>

                                        <label class="cursor-pointer label justify-start gap-3">
                                            <input type="checkbox" name="symbols" class="checkbox" checked>
                                            <span class="label-text">Symbols</span>
                                        </label>
                                    </div>
                                </div>

                                <!-- Submit -->
                                <button type="submit" class="btn btn-primary btn-lg w-full">
                                    Generate Data
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="lg:col-span-3">
                    <div class="flex items-center justify-between mb-5">
                        <div>
                            <h2 class="text-3xl font-bold">
                                Results
                            </h2>
                            <p class="text-base-content/70 mt-1">
                                Generated data will appear here.
                            </p>
                        </div>
                        <div class="flex flex-wrap gap-2 justify-end me-2">
                            <button id="downloadBtn" class="btn btn-accent hidden">
                                Download JSON
                            </button>

                            <button id="copyBtn" class="btn btn-secondary hidden">
                                Copy JSON
                            </button>
                        </div>
                    </div>
                    <div id="results" class="bg-neutral text-neutral-content rounded-2xl shadow-2xl p-6 min-h-[28rem] overflow-auto border border-neutral/50">
                        <div class="flex items-center justify-center h-full">
                            <div class="text-center">
                                <div class="text-6xl mb-4">
                                    ⚡
                                </div>
                                <h3 class="text-2xl font-semibold mb-2">
                                    Ready to generate
                                </h3>
                                <p>
                                    Your fake data will appear here.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <?php require_once 'layout/footer.php'; ?>

    <script>
        const form = document.getElementById('generatorForm');
        const results = document.getElementById('results');
        const copyBtn = document.getElementById('copyBtn');
        const downloadBtn = document.getElementById('downloadBtn');
        const typeSelect = form.querySelector('[name="type"]');
        const passwordOptions = document.getElementById('passwordOptions');
        const generateBtn = form.querySelector('button[type="submit"]');
        const uppercase = form.querySelector('[name="uppercase"]');
        const lowercase = form.querySelector('[name="lowercase"]');
        const numbers = form.querySelector('[name="numbers"]');
        const symbols = form.querySelector('[name="symbols"]');

        function togglePasswordOptions() {
            if (typeSelect.value === 'password') {
                passwordOptions.classList.remove('hidden');

                requestAnimationFrame(() => {
                    passwordOptions.classList.add('show');
                });
            } else {
                passwordOptions.classList.remove('show');

                setTimeout(() => {
                    passwordOptions.classList.add('hidden');
                }, 350);
            }
        }

        function validatePasswordOptions() {
            if (typeSelect.value !== 'password') {
                generateBtn.disabled = false;
                return;
            }

            const enabled =
                uppercase.checked ||
                lowercase.checked ||
                numbers.checked ||
                symbols.checked;

            generateBtn.disabled = !enabled;
        }

        typeSelect.addEventListener('change', togglePasswordOptions);

        togglePasswordOptions();

        uppercase.addEventListener('change', validatePasswordOptions);
        lowercase.addEventListener('change', validatePasswordOptions);
        numbers.addEventListener('change', validatePasswordOptions);
        symbols.addEventListener('change', validatePasswordOptions);

        typeSelect.addEventListener('change', validatePasswordOptions);

        validatePasswordOptions();

        function renderStrings(data) {
            return `
                <div class="space-y-2 font-mono text-sm">
                    ${data.map(item => `
                        <div class="bg-base-100/10 rounded-lg px-4 py-3 border border-white/5">
                            ${item}
                        </div>
                    `).join('')}
                </div>
            `;
        }

        function toJson(type, data) {
            if (type === 'color') {
                return data;
            }

            const keyMap = {
                name: 'name',
                email: 'email',
                phone: 'phone',
                password: 'password'
            };

            const key = keyMap[type] || 'value';

            return data.map(item => ({
                [key]: item
            }));
        }

        function renderColors(data) {
            return `
                <div class="grid sm:grid-cols-2 gap-4">
                    ${data.map((color, index) => `
                        <div
                            class="color-card text-black rounded-xl overflow-hidden border border-base-300 bg-base-100 shadow-lg"
                            style="animation-delay:${index * 50}ms">

                            <div
                                class="h-28 border-b border-base-300"
                                style="background:${color.hex}">
                            </div>

                            <div class="p-4 font-mono space-y-2">

                                <div class="flex justify-between">
                                    <span class="font-semibold">HEX</span>
                                    <span>${color.hex}</span>
                                </div>

                                <div class="flex justify-between">
                                    <span class="font-semibold">RGB</span>
                                    <span>${color.rgb}</span>
                                </div>

                                <div class="flex justify-between">
                                    <span class="font-semibold">HSL</span>
                                    <span>${color.hsl}</span>
                                </div>

                            </div>

                        </div>
                    `).join('')}
                </div>
            `;
        }

        async function updateResults(html) {
            results.classList.add('is-changing');

            await new Promise(resolve => setTimeout(resolve, 200));

            results.innerHTML = html;

            results.classList.remove('is-changing');
        }

        form.addEventListener('submit', async (e) => {
            e.preventDefault();

            const type = form.querySelector('[name="type"]').value;
            const quantity = form.querySelector('[name="quantity"]').value;

            const length = form.querySelector('[name="length"]').value;

            const uppercaseValue = uppercase.checked;
            const lowercaseValue = lowercase.checked;
            const numbersValue = numbers.checked;
            const symbolsValue = symbols.checked;

            await updateResults(`
                <div class="flex items-center justify-center h-full">
                    <span class="loading loading-spinner loading-lg"></span>
                </div>
            `);

            try {
                const response = await fetch('api/generate.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: new URLSearchParams({
                        type,
                        quantity,
                        length,
                        uppercase: uppercaseValue,
                        lowercase: lowercaseValue,
                        numbers: numbersValue,
                        symbols: symbolsValue
                    })
                });

                const data = await response.json();

                if (!response.ok) {
                    throw new Error(data.message || 'Request failed.');
                }

                if (!Array.isArray(data)) {
                    results.innerHTML = `<pre><code>Error generating data.</code></pre>`;
                    return;
                }

                await updateResults(
                    type === 'color' ?
                    renderColors(data) :
                    renderStrings(data)
                );

                if (type === 'color') {
                    const cards = results.querySelectorAll('.color-card');

                    cards.forEach((card, index) => {
                        setTimeout(() => {
                            card.classList.add('show');
                        }, index * 60);
                    });
                }

                copyBtn.classList.remove('hidden');
                downloadBtn.classList.remove('hidden');

                copyBtn.onclick = async () => {
                    const json = toJson(type, data);

                    await navigator.clipboard.writeText(
                        JSON.stringify(json, null, 2)
                    );

                    copyBtn.textContent = 'Copied!';

                    setTimeout(() => {
                        copyBtn.textContent = 'Copy Result';
                    }, 2000);
                };

                downloadBtn.onclick = () => {
                    const blob = new Blob([JSON.stringify(data, null, 2)], {
                        type: 'application/json'
                    });

                    const url = URL.createObjectURL(blob);
                    const a = document.createElement('a');

                    a.href = url;
                    a.download = `fakegen-${type}.json`;

                    document.body.appendChild(a);
                    a.click();

                    document.body.removeChild(a);
                    URL.revokeObjectURL(url);
                };

            } catch (error) {
                await updateResults(`
                    <div class="alert alert-error">
                        <span>${error.message}</span>
                    </div>
                `);
            }
        });
    </script>
</body>

</html>