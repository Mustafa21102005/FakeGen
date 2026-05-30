<?php
$title = 'Generate';
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
                                Copy Result
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

        form.addEventListener('submit', async (e) => {
            e.preventDefault();

            const type = form.querySelector('[name="type"]').value;
            const quantity = form.querySelector('[name="quantity"]').value;

            results.innerHTML = `
                <div class="flex items-center justify-center h-full">
                    <span>Loading...</span>
                </div>
            `;

            try {
                const response = await fetch('api/generate.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: new URLSearchParams({
                        type,
                        quantity
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

                results.innerHTML = `
                    <div class="space-y-2 font-mono text-sm">
                        ${data.map(item => `
                            <div class="bg-base-100/10 rounded-lg px-4 py-3 border border-white/5">
                                ${item}
                            </div>
                        `).join('')}
                    </div>
                `;

                copyBtn.classList.remove('hidden');
                downloadBtn.classList.remove('hidden');

                copyBtn.onclick = async () => {
                    await navigator.clipboard.writeText(data.join('\n'));
                    copyBtn.innerText = 'Copied!';
                    setTimeout(() => {
                        copyBtn.innerText = 'Copy Result';
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
                results.innerHTML = `
                    <div class="alert alert-error">
                        <span>${error.message}</span>
                    </div>
                `;
            }
        });
    </script>
</body>

</html>