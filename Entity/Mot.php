<?php

namespace App\Entity;

class Mot
{

    private $mot;

    private $queryTab = [];

    private $entityTab = [];

    private $limite;

    private $incr;

    private $profondeur;

    public function __construct($mot, $limite, $incr, $profondeur)
    {
        $this->profondeur = $profondeur;
        $this->mot = $mot;
        $this->limite = $limite;
        $this->incr = $incr;
        $this->setQueryTab();
        $this->setEntityTab();
    }

    public function getMot(): ?string
    {
        return $this->mot;
    }



    public function setQueryTab(): self
    {
        set_time_limit (60);
        if ($this->getIncr() < $this->getProfondeur()) { // si il faut encore incrémenter
            $a = 200;
            $httpcode = 0;
            $nbessai = 0;

            while ($httpcode !== $a) {

                $nbessai++;
                usleep(500000);



                $postRequest = [
                    'content' => $this->getMot(),
                    'lang' => 'fr',
                    'limit' => $this->getLimite(),
                    'key' => "Cb88oGt7QDtbKaAvwNVPFtHZ2SCIZtfwya5vDvyqsVC7tkqEDQloWBx7do8CPSPygSIzvgnq7dNMtqGnpQ6yC36N4g3s7P3WdqCPFIeqnmbCpmOR2rC52mXPH1acZdDSmlWh5fp5X79zNfA4848I0xyDDO9LIeUmpQ24UodNkz6CzLNBUMsWpOEqCNy8s2wFguh4X2gPklYWX01AtVASLRMnVeuZ48tMwNJQbekNVZw6CK084say6rtspdKo09U"
                ];
                $cURLConnection = curl_init('https://api.keywords.gg/query');
                curl_setopt($cURLConnection, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
                curl_setopt($cURLConnection, CURLOPT_POSTFIELDS, json_encode($postRequest));
                curl_setopt($cURLConnection, CURLOPT_RETURNTRANSFER, true);
                $apiResponse = curl_exec($cURLConnection);
                $httpcode = curl_getinfo($cURLConnection, CURLINFO_HTTP_CODE);
                file_put_contents('logs.txt', date("G:i:s"). "essai numéro  ".$nbessai. "pour une requette de query pour le mot : ". $this->getMot() . "\n" . "réponse : $httpcode \n", FILE_APPEND);
                curl_close($cURLConnection);
            }
            $results = json_decode($apiResponse);
            foreach ($results as $item => $prediction) {
                $i = 0;
                foreach ($prediction as $word) {
                    $queryWord[$i] = new Mot($word, $this->getLimite(), $this->getIncr() + 1, $this->getProfondeur());
                    array_push($_SESSION['query'], $word);
                    $i++;

                }
            }
            $this->queryTab = $queryWord;
            return $this;
        }
        return $this;

//        if ($this->getIncr() < $this->getProfondeur()) {
//            $a = 200;
//            $httpcode = 0;
//            $i = 0;
//            while ($httpcode !== $a) {
//                usleep(600);
//                $postRequest = [
//                    'content' => $this->getMot(),
//                    'lang' => 'fr',
//                    'limit' => $this->getLimite(),
//                    'key' => "Cb88oGt7QDtbKaAvwNVPFtHZ2SCIZtfwya5vDvyqsVC7tkqEDQloWBx7do8CPSPygSIzvgnq7dNMtqGnpQ6yC36N4g3s7P3WdqCPFIeqnmbCpmOR2rC52mXPH1acZdDSmlWh5fp5X79zNfA4848I0xyDDO9LIeUmpQ24UodNkz6CzLNBUMsWpOEqCNy8s2wFguh4X2gPklYWX01AtVASLRMnVeuZ48tMwNJQbekNVZw6CK084say6rtspdKo09U"
//                ];
//                $cURLConnection = curl_init('https://api.keywords.gg/query');
//                curl_setopt($cURLConnection, CURLOPT_HTTPHEADER,
//                    ['Content-Type: application/json']);
//                curl_setopt($cURLConnection, CURLOPT_POSTFIELDS, json_encode($postRequest));
//                curl_setopt($cURLConnection, CURLOPT_RETURNTRANSFER, true);
//                $apiResponse = curl_exec($cURLConnection);
//                $httpcode = curl_getinfo($cURLConnection, CURLINFO_HTTP_CODE);
//                curl_close($cURLConnection);
//                echo $httpcode;
//
//            }
//            $fp = fopen('results.json', 'r');
//            $results = json_decode($apiResponse);
//            fclose($fp);
//            foreach ($results as $item => $prediction) {
//                $i = 0;
//                foreach ($prediction as $word) {
//                    $queryWord[$i] = new Mot($word, $this->getLimite(), $this->getIncr() + 1, $this->getProfondeur());
//                    array_push($_SESSION['query'], $word);
//                    $i++;
//
//                }
//            }
//
//            $this->queryTab = $queryWord;
//            return $this;
//        }
//        return $this;
    }

    public
    function setEntityTab(): self
    {
        set_time_limit (60);
        if ($this->getIncr() < $this->getProfondeur()) { // si il faut encore incrémenter
            $a = 200;
            $httpcode = 0;
            $nbessai = 0;

            while ($httpcode !== $a) {

                $nbessai++;
                usleep(500000);

                $postRequest = [
                    'content' => $this->getMot(),
                    'lang' => 'fr',
                    'limit' => $this->getLimite(),
                    'key' => "Cb88oGt7QDtbKaAvwNVPFtHZ2SCIZtfwya5vDvyqsVC7tkqEDQloWBx7do8CPSPygSIzvgnq7dNMtqGnpQ6yC36N4g3s7P3WdqCPFIeqnmbCpmOR2rC52mXPH1acZdDSmlWh5fp5X79zNfA4848I0xyDDO9LIeUmpQ24UodNkz6CzLNBUMsWpOEqCNy8s2wFguh4X2gPklYWX01AtVASLRMnVeuZ48tMwNJQbekNVZw6CK084say6rtspdKo09U"
                ];
                $cURLConnection = curl_init('https://api.keywords.gg/entities');
                curl_setopt($cURLConnection, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
                curl_setopt($cURLConnection, CURLOPT_POSTFIELDS, json_encode($postRequest));
                curl_setopt($cURLConnection, CURLOPT_RETURNTRANSFER, true);
                $apiResponse = curl_exec($cURLConnection);
                $httpcode = curl_getinfo($cURLConnection, CURLINFO_HTTP_CODE);
                file_put_contents('logs.txt', date("G:i:s"). "essai numéro  ".$nbessai. "pour une requette d'entity pour le mot ".$this->getMot() . "\n" . "réponse : $httpcode \n", FILE_APPEND);
                curl_close($cURLConnection);

            }
            $results = json_decode($apiResponse);
            foreach ($results as $item => $prediction) {
                $i = 0;
                foreach ($prediction as $word) {
                    $entityWord[$i] = new Mot($word, $this->getLimite(), $this->getIncr() + 1, $this->getProfondeur());
                    array_push($_SESSION['entity'], $word);
                    $i++;

                }
            }
            $this->entityTab = $entityWord;
            return $this;
        }
        return $this;
    }

    /**
     * @return array
     */
    public function getQueryTab(): array
    {
        return $this->queryTab;
    }

    /**
     * @return array
     */
    public function getEntityTab(): array
    {
        return $this->entityTab;
    }

    public
    function getLimite(): ?int
    {
        return $this->limite;
    }

    public
    function getIncr(): ?int
    {
        return $this->incr;
    }

    public
    function getProfondeur(): ?int
    {
        return $this->profondeur;
    }

}
