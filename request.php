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

session_start();

$request = new Demande(); // je crée ma demande

$request->setLangue('fr'); // j'assigne sa langue
$request->setLimite($_POST['limite']); // j'assigne la limite
$request->setNbMots($_POST['nbmots']); // je spécifie le nombre de mot
$request->setProfondeur($_POST['profondeur']); // et la profondeur

for ($i = 0; $i < $request->getNbMots(); $i++) { //pour chaque mot
    $_SESSION['query'] = [];
    $_SESSION['entity'] = [];
    $mot[$i] = new Mot(strtolower($_POST['mot_' . $i]), $request->getLimite(), 0, $request->getProfondeur()); //je crée un nouveau mot, (mot, limite, profondeur actuelle )
    $request->setMots($mot); // j'assigne la couche -1 des mots a ma demande
    $tab[$i]['query'] = array_count_values($_SESSION['query']);
    $tab[$i]['entity'] = array_count_values($_SESSION['entity']);
    $tab[$i]['mot'] = $mot[$i]->getMot();
    unset($tab[$i]['query'][$tab[$i]['mot']]);
    unset($tab[$i]['entity'][$tab[$i]['mot']]);
    unset($tab[$i]['query'][$tab[$i]['mot'] . "s"]);
    unset($tab[$i]['entity'][$tab[$i]['mot'] . "s"]);
    array_multisort($tab[$i]['query'], SORT_DESC);
    array_multisort($tab[$i]['entity'], SORT_DESC);
}

session_destroy();
echo $twig->render('home.html.twig', ['results' => $tab]);

