<?php

namespace App\Entity;

class Demande
{

    private $langue;

    private $limite;

    private $profondeur;

    /**
     * @return array
     */
    public function getMots(): array
    {
        return $this->mots;
    }

    private $mots = [];

    private $nbMots;

    public function setLangue($langue): self
    {
        $this->langue = $langue;

        return $this;
    }

    public function getLimite(): ?int
    {
        return $this->limite;
    }

    public function setLimite(int $limite): self
    {
        $this->limite = $limite;

        return $this;
    }

    public function getProfondeur(): ?int
    {
        return $this->profondeur;
    }

    public function setProfondeur(int $profondeur): self
    {
        $this->profondeur = $profondeur;

        return $this;
    }

    public function setMots(array $mots): self
    {
        $this->mots = $mots;

        return $this;
    }

    public function getNbMots(): ?int
    {
        return $this->nbMots;
    }

    public function setNbMots(int $nbMots): self
    {
        $this->nbMots = $nbMots;

        return $this;
    }
}
