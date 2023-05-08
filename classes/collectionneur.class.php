<?php
class Collectionneur extends Utilisateur
{
    private $_credit;

    public function __construct(array $donnees)
    {
        if (isset($donnees['IdCollectionneur'])) {
            parent::__construct(['IdCollectionneur' => $donnees['IdCollectionneur']]);
        }
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

    public function getCredit()
    {
        return $this->_credit;
    }


    public function setCredit($credit)
    {
        $this->_credit = $credit;

        return $this;
    }
}
