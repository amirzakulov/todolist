<!doctype html>
<html lang="en" class="h-100">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Jekyll v4.1.1">
    <title><?= $data["title"]; ?></title>
    <link href="<?= URLROOT; ?>/public/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?= URLROOT; ?>/public/css/sticky-footer-navbar.css" rel="stylesheet">
    <link href="<?= URLROOT; ?>/public/css/style.css?<?= time(); ?>" rel="stylesheet">
</head>
<body class="d-flex flex-column h-100">
<header>
    <!-- Fixed navbar -->
    <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
        <span class="navbar-brand">{To Do List}</span>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link text-info" href="<?= URLROOT; ?>">Список задач <span class="sr-only">(current)</span></a>
                </li>
            </ul>

            <?php if(isset($_SESSION["logged_in"])) { ?>
            <a href="<?= URLROOT."/logout"; ?>" class="my-2 my-sm-0 logout" title="Выход"></a>
            <?php } ?>
        </div>
    </nav>
</header>
<main role="main" class="flex-shrink-0">
    <div class="container mt-4 mb-4">