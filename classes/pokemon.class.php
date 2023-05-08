<?php

class Pokemon extends Carte
{

    private int $_IdPokemon;
    private string $_NomPokemon;
    private string $_Type;

    public function __construct(array $donnees)
    {
        parent::__construct(['rarete' => $donnees['Rareté'], 'idCarte' => $donnees['IdPokemon']]);
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
    public function getIdPokemon()
    {
        return $this->_IdPokemon;
    }

    public function getNomPokemon()
    {
        return $this->_NomPokemon;
    }

    public function getType()
    {
        return $this->_Type;
    }

    //setters
    public function setIdPokemon($IdPokemon)
    {
        $this->_IdPokemon = $IdPokemon;

        return $this;
    }

    public function setNomPokemon($NomPokemon)
    {
        $this->_NomPokemon = $NomPokemon;

        return $this;
    }

    public function setType($Type)
    {
        $this->_Type = $Type;

        return $this;
    }
}
