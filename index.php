<?php

require_once 'Entity/Demande.php';
require_once 'Entity/Mot.php';
use App\Entity\Demande;
use App\Entity\Mot;
use Twig\Environment as EnvironmentAlias;
use Twig\Loader\FilesystemLoader as FilesystemLoaderAlias;

require_once('vendor/autoload.php');
$loader = new FilesystemLoaderAlias('./templates');
$twig = new EnvironmentAlias($loader);
echo $twig->render('home.html.twig');

