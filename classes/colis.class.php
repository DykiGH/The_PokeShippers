<?php
//le fait que la classe ne soit pas abstract est voulu
class Colis
{
    private int $_IdLivraison;
    private int $_IdCollectionneur;
    private string $_DateEnvoiColis;
    private string $_LieuLivraison;

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
    public function getIdCollectionneur()
    {
        return $this->_IdCollectionneur;
    }

    public function getIdLivraison()
    {
        return $this->_IdLivraison;
    }

    public function getDateEnvoiColis()
    {
        return $this->_DateEnvoiColis;
    }

    public function getLieuLivraison()
    {
        return $this->_LieuLivraison;
    }

    //setters
    public function setIdLivraison($IdLivraison)
    {
        $this->_IdLivraison = $IdLivraison;

        return $this;
    }

    public function setIdCollectionneur($IdCollectionneur)
    {
        $this->_IdCollectionneur = $IdCollectionneur;

        return $this;
    }

    public function setDateEnvoiColis($DateEnvoiColis)
    {
        $this->_DateEnvoiColis = $DateEnvoiColis;

        return $this;
    }

    public function setLieuLivraison($LieuLivraison)
    {
        $this->_LieuLivraison = $LieuLivraison;

        return $this;
    }
}
