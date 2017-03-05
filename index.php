<?php
require("fbindex.php");

$loader = new Twig_Loader_Filesystem('tpl');
$twig = new Twig_Environment($loader, array(
    'cache' => 'cache',
));

echo $twig->render(
    'home_page.tpl'
);