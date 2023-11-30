<?php

require './vendor/autoload.php';

use Dompdf\Dompdf;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

$loader = new FilesystemLoader('templates');

$twig = new Environment($loader);

$template = $twig->load('./pdf_template.twig');

$data = [
    "title" => "Tableur PDF",
    "headers" => ['id', 'firstname', 'lastname'],
    "content" => [
        ['1', 'Jean', 'Jean'],
        ['2', 'Paul', 'Jean'],
        ['3', 'John', 'Wick'] 
    ]
];

$html = $template->render(['data' => $data]);

$dompdf = new Dompdf();
$dompdf->loadHtml($html);
$dompdf->render();
$dompdf->stream('document.pdf');
