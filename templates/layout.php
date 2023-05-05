<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Завдання та проекти | <?= $page_title ?></title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="static/plugins/fontawesome-free/css/all.min.css">
    <!-- Ekko Lightbox -->
    <link rel="stylesheet" href="static/plugins/ekko-lightbox/ekko-lightbox.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="static/css/adminlte.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="static/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- custom kanban styles -->
    <link rel="stylesheet" href="static/css/kanban.css">

</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <?= renderTemplate($body_content, [
        'wrapper_content' => 'kanban.php',
        'user_name' => 'Daniil Ivanov',
        'user_photo' => 'https://en.gravatar.com/userimage/113651460/9f8c526466d42444c8a4d8d0b9bf1990.jpg?size=200'
    ]); ?>

<!-- jQuery -->
<script src="static/plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="static/plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Bootstrap -->
<script src="static/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- Ekko Lightbox -->
<script src="static/plugins/ekko-lightbox/ekko-lightbox.min.js"></script>
<!-- overlayScrollbars -->
<script src="static/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="static/js/adminlte.min.js"></script>
<!-- Filterizr-->
<script src="static/plugins/filterizr/jquery.filterizr.min.js"></script>
<!-- Page specific script -->
<script src="static/js/kanban.js"></script>
</body>
</html>
