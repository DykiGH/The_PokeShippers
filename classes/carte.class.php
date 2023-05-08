<?php
//le fait que la classe ne soit pas abstract est voulu
class Carte
{

    protected int $_IdCarte;
    protected string $_SeriePaquet;
    protected string $_Rareté;


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
    public function getRareté()
    {
        return $this->_Rareté;
    }

    public function getIdCarte()
    {
        return $this->_IdCarte;
    }

    public function getSeriePaquet()
    {
        return $this->_SeriePaquet;
    }

    // public function getIdGenerationCarte()
    // {
    //     return $this->_idGenerationCarte;
    // }

    //setters
    public function setRareté($Rareté)
    {
        $this->_Rareté = $Rareté;

        return $this;
    }

    public function setSeriePaquet($SeriePaquet)
    {
        $this->_SeriePaquet = $SeriePaquet;

        return $this;
    }

    public function setIdCarte($IdCarte)
    {
        $this->_IdCarte = $IdCarte;

        return $this;
    }

    // public function setIdGenerationCarte($idGenerationCarte)
    // {
    //     $this->_idGenerationCarte = $idGenerationCarte;

    //     return $this;
    // }
}
