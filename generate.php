<?php
$title = 'Generate';
$description = 'Generate realistic fake names, emails, phone numbers, and more in one click. Copy or download as JSON, CSV, SQL, or XML — fast, free, and private.';
$keywords = 'generate fake names, fake emails, fake phone numbers, dummy data, JSON test data, CSV, SQL';
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
                        Create fake names, emails, usernames, passwords, and more for testing, demos, development, and prototypes.
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

                            <?php

                            $typeGroups = require 'layout/partials/types.php';
                            $selectedType = $_GET['type'] ?? '';

                            ?>

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

                                        <?php foreach ($typeGroups as $group => $types): ?>
                                            <optgroup label="<?= $group ?>">
                                                <?php foreach ($types as $value => $label): ?>
                                                    <option value="<?= $value ?>" <?= $selectedType === $value ? 'selected' : '' ?>>
                                                        <?= $label ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            </optgroup>
                                        <?php endforeach; ?>

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
                    <div class="flex flex-wrap items-center justify-between gap-4 mb-5">
                        <div>
                            <h2 class="text-3xl font-bold">
                                Results
                            </h2>
                            <p class="text-base-content/70 mt-1">
                                Generated data will appear here.
                            </p>
                        </div>
                        <div id="exportBar" class="join hidden me-2">
                            <select id="formatSelect" class="select join-item" aria-label="Export format">
                                <option value="json">JSON</option>
                                <option value="csv">CSV</option>
                                <option value="sql">SQL</option>
                                <option value="xml">XML</option>
                            </select>

                            <button id="copyBtn" type="button" class="btn btn-secondary join-item gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5H6a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2v-1M8 5a2 2 0 002 2h2a2 2 0 002-2M8 5a2 2 0 012-2h2a2 2 0 012 2m0 0h2a2 2 0 012 2v3m2 4H10m0 0l3-3m-3 3l3 3" />
                                </svg>
                                <span id="copyLabel">Copy JSON</span>
                            </button>

                            <button id="downloadBtn" type="button" class="btn btn-accent join-item gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v2a2 2 0 002 2h12a2 2 0 002-2v-2M7 10l5 5m0 0l5-5m-5 5V4" />
                                </svg>
                                <span id="downloadLabel">Download JSON</span>
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
        // ---------------------------------------------------------------
        // 1. Element lookups (all in one place, before anything uses them)
        // ---------------------------------------------------------------
        const form = document.getElementById('generatorForm');
        const results = document.getElementById('results');
        const typeSelect = form.querySelector('[name="type"]');
        const passwordOptions = document.getElementById('passwordOptions');
        const generateBtn = form.querySelector('button[type="submit"]');
        const uppercase = form.querySelector('[name="uppercase"]');
        const lowercase = form.querySelector('[name="lowercase"]');
        const numbers = form.querySelector('[name="numbers"]');
        const symbols = form.querySelector('[name="symbols"]');

        const exportBar = document.getElementById('exportBar');
        const formatSelect = document.getElementById('formatSelect');
        const copyBtn = document.getElementById('copyBtn');
        const downloadBtn = document.getElementById('downloadBtn');
        const copyLabel = document.getElementById('copyLabel');
        const downloadLabel = document.getElementById('downloadLabel');

        // ---------------------------------------------------------------
        // 2. State
        // ---------------------------------------------------------------
        let lastResult = null;

        const PREVIEW_LIMIT = 50;

        // ---------------------------------------------------------------
        // 3. Password options
        // ---------------------------------------------------------------
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

        [uppercase, lowercase, numbers, symbols].forEach(box =>
            box.addEventListener('change', validatePasswordOptions)
        );

        typeSelect.addEventListener('change', () => {
            togglePasswordOptions();
            validatePasswordOptions();
        });

        togglePasswordOptions();
        validatePasswordOptions();

        // ---------------------------------------------------------------
        // 4. Rendering
        // ---------------------------------------------------------------
        function renderStrings(data) {
            return `
                <div class="space-y-2 font-mono text-sm">
                    ${data.map(item => `
                        <div class="bg-base-100/10 rounded-lg px-4 py-3 border border-white/5">
                            <pre>${JSON.stringify(item, null, 2)}</pre>
                        </div>
                    `).join('')}
                </div>
            `;
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

        function previewNotice(total) {
            if (total <= PREVIEW_LIMIT) return '';

            return `<p class="text-sm opacity-70 mb-4">
                Showing the first ${PREVIEW_LIMIT} of ${total.toLocaleString()} results.
                Copy and Download include all of them.
            </p>`;
        }

        async function updateResults(html) {
            results.classList.add('is-changing');

            await new Promise(resolve => setTimeout(resolve, 200));

            results.innerHTML = html;

            results.classList.remove('is-changing');
        }

        // ---------------------------------------------------------------
        // 5. Export formats
        // ---------------------------------------------------------------
        function toJson(type, data) {
            return data.map(item =>
                typeof item === 'string' ? {
                    [type]: item
                } : item
            );
        }

        function flatten(obj, prefix = '') {
            return Object.entries(obj).reduce((acc, [key, value]) => {
                const name = prefix ? `${prefix}_${key}` : key;

                if (value !== null && typeof value === 'object') {
                    Object.assign(acc, flatten(value, name));
                } else {
                    acc[name] = value;
                }

                return acc;
            }, {});
        }

        function toCsv(rows) {
            const flat = rows.map(row => flatten(row));
            const headers = Object.keys(flat[0]);

            const escape = value => {
                const text = String(value);
                return /[",\r\n]/.test(text) ?
                    `"${text.replace(/"/g, '""')}"` :
                    text;
            };

            return [
                headers.join(','),
                ...flat.map(row => headers.map(h => escape(row[h])).join(','))
            ].join('\r\n');
        }

        function toSql(type, rows) {
            const flat = rows.map(row => flatten(row));
            const columns = Object.keys(flat[0]);

            const quote = value => `'${String(value).replace(/'/g, "''")}'`;

            const values = flat.map(row =>
                `  (${columns.map(c => quote(row[c])).join(', ')})`
            );

            return `INSERT INTO fakegen_${type} (${columns.join(', ')}) VALUES\n${values.join(',\n')};`;
        }

        function toXml(rows) {
            const escape = text => String(text)
                .replace(/&/g, '&amp;')
                .replace(/</g, '&lt;')
                .replace(/>/g, '&gt;')
                .replace(/"/g, '&quot;')
                .replace(/'/g, '&apos;');

            const records = rows.map(row => {
                const fields = Object.entries(flatten(row))
                    .map(([key, value]) => `    <${key}>${escape(value)}</${key}>`)
                    .join('\n');

                return `  <record>\n${fields}\n  </record>`;
            });

            // \x3C is "<": written this way so PHP doesn't mistake it for a PHP tag
            return `\x3C?xml version="1.0" encoding="UTF-8"?>\n<records>\n${records.join('\n')}\n</records>`;
        }

        const formats = {
            json: {
                extension: 'json',
                mime: 'application/json',
                build: (type, rows) => JSON.stringify(rows, null, 2)
            },
            csv: {
                extension: 'csv',
                mime: 'text/csv',
                build: (type, rows) => toCsv(rows)
            },
            sql: {
                extension: 'sql',
                mime: 'application/sql',
                build: (type, rows) => toSql(type, rows)
            },
            xml: {
                extension: 'xml',
                mime: 'application/xml',
                build: (type, rows) => toXml(rows)
            }
        };

        // ---------------------------------------------------------------
        // 6. Export toolbar (copy / download)
        // ---------------------------------------------------------------
        const reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)');

        // Slides the old label up and fades it out, swaps the text,
        // then slides the new label in from below.
        function swapLabel(el, text) {
            el.dataset.target = text;

            if (el.textContent === text) return;

            if (reduceMotion.matches) {
                el.textContent = text;
                return;
            }

            // If a swap is already running (user changing formats quickly), restart it
            el.getAnimations().forEach(animation => animation.cancel());

            el.animate([{
                    opacity: 1,
                    transform: 'translateY(0)'
                },
                {
                    opacity: 0,
                    transform: 'translateY(-6px)'
                }
            ], {
                duration: 120,
                easing: 'ease-in'
            }).finished.then(() => {
                el.textContent = el.dataset.target;

                el.animate([{
                        opacity: 0,
                        transform: 'translateY(6px)'
                    },
                    {
                        opacity: 1,
                        transform: 'translateY(0)'
                    }
                ], {
                    duration: 160,
                    easing: 'ease-out'
                });
            }).catch(() => {});
        }

        // A quick "pop" on both buttons so the change is noticeable
        function popButtons() {
            if (reduceMotion.matches) return;

            [copyBtn, downloadBtn].forEach(btn =>
                btn.animate([{
                        transform: 'scale(1)'
                    },
                    {
                        transform: 'scale(1.06)'
                    },
                    {
                        transform: 'scale(1)'
                    }
                ], {
                    duration: 250,
                    easing: 'ease-out'
                })
            );
        }

        function updateExportLabels(pop = false) {
            const name = formatSelect.value.toUpperCase();

            swapLabel(copyLabel, `Copy ${name}`);
            swapLabel(downloadLabel, `Download ${name}`);

            if (pop === true) popButtons();
        }

        function buildExport() {
            const format = formats[formatSelect.value];
            const rows = toJson(lastResult.type, lastResult.data);

            return {
                format,
                text: format.build(lastResult.type, rows)
            };
        }

        formatSelect.addEventListener('change', () => updateExportLabels(true));

        copyBtn.addEventListener('click', async () => {
            if (!lastResult) return;

            try {
                await navigator.clipboard.writeText(buildExport().text);
                copyLabel.textContent = 'Copied!';
            } catch {
                copyLabel.textContent = 'Copy failed';
            }

            setTimeout(updateExportLabels, 2000);
        });

        downloadBtn.addEventListener('click', () => {
            if (!lastResult) return;

            const {
                format,
                text
            } = buildExport();

            const blob = new Blob([text], {
                type: `${format.mime};charset=utf-8`
            });
            const url = URL.createObjectURL(blob);
            const a = document.createElement('a');

            a.href = url;
            a.download = `fakegen-${lastResult.type}.${format.extension}`;

            document.body.appendChild(a);
            a.click();

            document.body.removeChild(a);
            URL.revokeObjectURL(url);
        });

        updateExportLabels();

        // ---------------------------------------------------------------
        // 7. Form submit
        // ---------------------------------------------------------------
        form.addEventListener('submit', async (e) => {
            e.preventDefault();

            lastResult = null;
            exportBar.classList.add('hidden');

            const type = typeSelect.value;
            const quantity = form.querySelector('[name="quantity"]').value;
            const length = form.querySelector('[name="length"]').value;

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
                        uppercase: uppercase.checked,
                        lowercase: lowercase.checked,
                        numbers: numbers.checked,
                        symbols: symbols.checked
                    })
                });

                const data = await response.json();

                if (!response.ok) {
                    throw new Error(data.message || 'Request failed.');
                }

                if (!Array.isArray(data)) {
                    throw new Error('Error generating data.');
                }

                const shown = data.slice(0, PREVIEW_LIMIT);

                await updateResults(
                    previewNotice(data.length) +
                    (type === 'color' ? renderColors(shown) : renderStrings(shown))
                );

                if (type === 'color') {
                    results.querySelectorAll('.color-card').forEach((card, index) => {
                        setTimeout(() => card.classList.add('show'), index * 60);
                    });
                }

                lastResult = {
                    type,
                    data
                };
                exportBar.classList.remove('hidden');

                if (!reduceMotion.matches) {
                    exportBar.animate([{
                            opacity: 0,
                            transform: 'translateY(-6px)'
                        },
                        {
                            opacity: 1,
                            transform: 'translateY(0)'
                        }
                    ], {
                        duration: 250,
                        easing: 'ease-out'
                    });
                }

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