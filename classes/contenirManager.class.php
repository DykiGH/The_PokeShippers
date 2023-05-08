<?php
class ContenirManager
{
    private $_db;

    public function __construct($db)
    {
        $this->setDB($db);
    }

    public function addContenir(Contenir $contenir)
    {
        $q = $this->_db->prepare('INSERT INTO contenir(IdCarte,SeriePaquet,IdLivraison) VALUES(:IdCarte,:SeriePaquet,:IdLivraison)');
        $q->bindValue(':IdCarte', $contenir->getIdCarte());
        $q->bindValue(':SeriePaquet', $contenir->getSeriePaquet());
        $q->bindValue(':IdLivraison', $contenir->getIdLivraison());

        $q->execute();
    }

    public function setDb(PDO $db)
    {
        $this->_db = $db;
    }
}
