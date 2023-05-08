<?php
class Contenir
{
    private int $_IdCarte;
    private string $_SeriePaquet;
    private int $_IdLivraison;

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

    //getters
    public function getIdCarte()
    {
        return $this->_IdCarte;
    }

    public function getSeriePaquet()
    {
        return $this->_SeriePaquet;
    }

    public function getIdLivraison()
    {
        return $this->_IdLivraison;
    }

    //setters
    public function setIdCarte($IdCarte)
    {
        $this->_IdCarte = $IdCarte;

        return $this;
    }

    public function setSeriePaquet($SeriePaquet)
    {
        $this->_SeriePaquet = $SeriePaquet;

        return $this;
    }

    public function setIdLivraison($IdLivraison)
    {
        $this->_IdLivraison = $IdLivraison;

        return $this;
    }
}
