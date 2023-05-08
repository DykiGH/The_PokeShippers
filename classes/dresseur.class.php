<?php
class Dresseur extends Carte
{

    private int $_IdDresseur;
    private string $_NomDresseur;

    public function __construct(array $donnees)
    {
        parent::__construct(['rarete' => $donnees['Rareté'], 'idCarte' => $donnees['IdDresseur']]);
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
    public function getIdDresseur()
    {
        return $this->_IdDresseur;
    }

    public function getNomDresseur()
    {
        return $this->_NomDresseur;
    }

    //setters
    public function setIdDresseur($IdDresseur)
    {
        $this->_IdDresseur = $IdDresseur;

        return $this;
    }

    public function setNomDresseur($NomDresseur)
    {
        $this->_NomDresseur = $NomDresseur;

        return $this;
    }
}
