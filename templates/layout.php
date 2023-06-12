<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Завдання та проекти | <?= $page_title ?></title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

    <?php if (isset($links['css'])): ?>
        <?php foreach ($links['css'] as $css): ?>
            <link rel="stylesheet" href="<?= $css ?>">
        <?php endforeach; ?>
    <?php endif; ?>
</head>

<body class="<?= isset($body_options) ? $body_options : '' ?>">
    <?= $body_content ?>

    <?php if (isset($links['js'])): ?>
        <?php foreach ($links['js'] as $key => $js): ?>
            <script type="application/javascript" src="<?= $js ?>"></script>
        <?php endforeach; ?>
    <?php endif; ?>
</body>
</html>
