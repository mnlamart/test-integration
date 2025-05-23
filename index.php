<?php
require_once 'vendor/autoload.php';

$loader = new \Twig\Loader\FilesystemLoader(__DIR__);
$twig = new \Twig\Environment($loader, [
    'debug' => true,
]);
$twig->addExtension(new \Twig\Extension\DebugExtension());

function hasChildWithTerminus($station) {
    if (!isset($station['children']) || empty($station['children'])) {
        return false;
    }

    foreach ($station['children'] as $child) {
        if ($child['type'] === 'terminus') {
            return true;
        }

        // Recursively check for children of the child
        if (isset($child['children']) && !empty($child['children'])) {
            if (hasChildWithTerminus($child)) {
                return true;
            }
        }
    }

    return false;
}

$twig->addFunction(new \Twig\TwigFunction('hasChildWithTerminus', 'hasChildWithTerminus'));

$twig->addFunction(new \Twig\TwigFunction('isCurrentStation', function ($station, $currentStation) {
    return isset($station['name']) && $station['name'] === $currentStation;
}));

$twig->addFunction(new \Twig\TwigFunction('isTerminus', function ($station) {
    return isset($station['type']) && $station['type'] === 'terminus';
}));



// Render the template
echo $twig->render('index.html', [
    'title' => 'Test d’intégration',
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
    'line_data' => [
        'name' => 'M3',
        'color' => '#70007c',
        'current_station' => 'Olympia',
        'stations' => [
            ['name' => 'PISCINE YVES BLANC', 'type' => 'terminus'],
            ['name' => 'Cimetière St Pierre', 'type' => 'normal'],
            ['name' => 'Parking Carcassonne', 'type' => 'normal'],
            ['name' => 'Tour D\'Aygosi', 'type' => 'normal'],
            ['name' => 'Les Cigales', 'type' => 'normal'],
            ['name' => 'Bourget', 'type' => 'normal'],
            ['name' => 'Saint Pierre', 'type' => 'normal'],
            ['name' => 'Gambetta', 'type' => 'normal'],
            ['name' => 'Ganay', 'type' => 'normal'],
            ['name' => 'Bellegarde', 'type' => 'normal'],
            ['name' => 'Violette', 'type' => 'normal'],
            ['name' => 'Gianotti', 'type' => 'normal'],
            ['name' => 'Pasteur', 'type' => 'normal'],
            ['name' => 'Pasteur Notre-Dame', 'type' => 'normal'],
            ['name' => 'Solari', 'type' => 'normal'],
            ['name' => 'Nation', 'type' => 'normal'],
            ['name' => 'Hôpital', 'type' => 'normal'],
            ['name' => 'Hôpital Tamaris', 'type' => 'normal'],
            ['name' => 'Rocher Du Dragon', 'type' => 'normal'],
            ['name' => 'Parc Mozart', 'type' => 'normal'],
            [
                'name' => 'Pontier',
                'type' => 'normal',
                'children' => [
                    ['name' => 'Renoir', 'type' => 'normal'],
                    ['name' => 'Olympia', 'type' => 'normal'],
                    [
                        'name' => 'Fleury-Val', 
                        'type' => 'normal',
                        'children' => [
                            ['name' => 'Chalet', 'type' => 'normal'],
                            ['name' => 'Koenig', 'type' => 'normal'],
                            ['name' => 'Seigneurie', 'type' => 'normal']
                        ]
                    ],
                    ['name' => 'Lauriers', 'type' => 'normal'],
                    ['name' => 'Boutière', 'type' => 'normal'],
                    ['name' => 'BEAUVALLON', 'type' => 'terminus'],
                ]
            ],
            ['name' => 'Guyon', 'type' => 'normal'],
            ['name' => 'Verte Colline', 'type' => 'normal'],
            ['name' => 'LA CHEVALIERE', 'type' => 'terminus']
        ]
    ]
]);