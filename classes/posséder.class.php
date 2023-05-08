<?php

class Pokemon extends Carte
{

    private int $_nbrExemplaire;

    public function __construct(array $donnees)
    {
        $this->hydrate($donnees);
    }

    public function hydrate(array $donnees)
    {
        foreach ($donnees as $key => $value) {
            $method = 'set' . ucfirst($key);

            if (method_exists($this, $method)) {
                $this->$method($value);
            }
        }
    }

    public function getNbrExemplaire()
    {
        return $this->_nbrExemplaire;
    }

    public function set_nbrExemplaire($NbrExemplaire)
    {
        $this->_nbrExemplaire = $NbrExemplaire;

        return $this;
    }
}
