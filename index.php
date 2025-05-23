<?php
require_once 'vendor/autoload.php';

$loader = new \Twig\Loader\FilesystemLoader(__DIR__);
$twig = new \Twig\Environment($loader, [
    'debug' => true,
]);
$twig->addExtension(new \Twig\Extension\DebugExtension());


// Render the template
echo $twig->render('index.html', [
    'title' => 'Horaires',
    'schedule_title' => 'LUNDI AU VENDREDI - Monday to Friday',
    'schedule' => [
        5 => [],
        6 => [],
        7 => ['01', '26', '49'],
        8 => ['08', '29', '56'],
        9 => ['22', '49'],
        10 => ['19', '46'],
        11 => ['13', '40'],
        12 => ['01', '25', '50'],
        13 => ['15', '38', '58'],
        14 => ['25', '49'],
        15 => ['11', '37'],
        16 => ['00', '23', '50'],
        17 => ['14', '40'],
        18 => ['05', '29'],
        19 => ['21', '44', '55'],
        20 => ['04', '29'],
        21 => [],
        22 => [],
    ],
]);