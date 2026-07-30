<!DOCTYPE html>
<html lang="en" data-theme="pastel">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>FakeGen | <?= $title ?></title>
    <meta name="description"
        content="<?= $description ?? 'FakeGen — Generate realistic fake data instantly. Free, private, no signups required.' ?>">
    <meta name="keywords" content="<?= $keywords ?? 'fake data generator, test data, dummy data, developer tools' ?>">
    <meta name="author" content="Mustafa Azmi">
    <meta name="robots" content="index, follow">
    <link rel="canonical" href="<?= $canonical ?>">

    <link rel="icon" type="image/png" href="../public/favicon-96x96.png" sizes="96x96" />
    <link rel="icon" type="image/svg+xml" href="../public/favicon.svg" />
    <link rel="shortcut icon" href="../public/favicon.ico" />
    <link rel="apple-touch-icon" sizes="180x180" href="../public/apple-touch-icon.png" />
    <meta name="apple-mobile-web-app-title" content="FakeGen" />
    <link rel="manifest" href="../public/site.webmanifest" />

    <link href="https://cdn.jsdelivr.net/npm/daisyui@5" rel="stylesheet" type="text/css" />
    <link href="https://cdn.jsdelivr.net/npm/daisyui@5/themes.css" rel="stylesheet" type="text/css" />
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>

    <style>
        #results {
            transition: opacity 200ms ease, transform 200ms ease;
        }

        #results.is-changing {
            opacity: 0;
            transform: translateY(8px);
        }

        @keyframes cardFadeIn {
            from {
                opacity: 0;
                transform: translateY(12px) scale(.98);
            }

            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }

        .color-card {
            opacity: 0;
        }

        .color-card.show {
            animation: cardFadeIn .45s cubic-bezier(.22, 1, .36, 1) forwards;
        }

        #passwordOptions {
            overflow: hidden;
            max-height: 0;
            opacity: 0;
            transform: translateY(-8px);
            transition:
                max-height .35s ease,
                opacity .25s ease,
                transform .35s cubic-bezier(.22, 1, .36, 1);
        }

        #passwordOptions.show {
            max-height: 500px;
            opacity: 1;
            transform: translateY(0);
        }
    </style>
</head>