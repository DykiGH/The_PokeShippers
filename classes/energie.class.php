<?php
class Energie extends Carte
{

    public int $_IdEnergie;
    public string $_NomEnergie;


    public function __construct(array $donnees)
    {
        parent::__construct(['rarete' => $donnees['Rareté'], 'idCarte' => $donnees['IdEnergie']]);
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

    //getters
    public function getIdEnergie()
    {
        return $this->_IdEnergie;
    }

    public function getNomEnergie()
    {
        return $this->_NomEnergie;
    }

    //setters
    public function setIdEnergie($IdEnergie)
    {
        $this->_IdEnergie = $IdEnergie;

        return $this;
    }

    public function setNomEnergie($NomEnergie)
    {
        $this->_NomEnergie = $NomEnergie;

        return $this;
    }
}
