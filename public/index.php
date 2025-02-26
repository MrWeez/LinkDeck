<?php
$cards = include '../config/cards.php';
$siteConfig = include '../config/config.php';
?>
<!DOCTYPE html>
<html lang="ru">

<head>
    <!-- Base head -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($siteConfig['site_title']) ?></title>
<?php if (!empty($siteConfig['head_tags'])): ?>
<?php foreach ($siteConfig['head_tags'] as $tag): ?>
    <?= $tag . "\n" ?>
<?php endforeach; ?>
<?php endif; ?>
    <!-- CSS -->
    <link href="./assets/build.css" rel="stylesheet">
</head>

<body class="bg-zinc-900 text-zinc-100 min-h-screen p-4">
    <div class="container mx-auto">
        <h1 class="text-4xl font-bold mb-6 mt-2 text-zinc-50">LinkDeck</h1>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
<?php foreach ($cards as $card): ?>
            <!-- Card -->
            <a href="<?= htmlspecialchars($card['url']) ?>" class="block group">
                <div class="bg-zinc-800 rounded-lg p-6 shadow-lg transition-all duration-300 transform hover:-translate-y-1 hover:shadow-xl h-full flex flex-col">
                    <div class="mb-4 text-left">
                        <img src="<?= htmlspecialchars($card['image']) ?>" alt="<?= htmlspecialchars($card['title']) ?>" class="<?= $card['invert'] ? 'mx-auto h-16 invert' : 'mx-auto h-16' ?>" />
                    </div>
                    <h2 class="text-xl font-bold mb-3 text-zinc-50 group-hover:text-indigo-400 transition-colors"><?= htmlspecialchars($card['title']) ?></h2>
                    <p class="text-zinc-300 mb-6 flex-grow"><?= htmlspecialchars($card['description']) ?></p>
                    <div class="text-sm text-zinc-400 mt-auto">
                        <span class="bg-zinc-700 px-2 py-1 rounded text-indigo-300"><?= htmlspecialchars($card['service']) ?></span>
                    </div>
                </div>
            </a>
<?php endforeach; ?>
        </div>
    </div>
</body>

</html>