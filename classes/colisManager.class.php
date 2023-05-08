<?php
class ColisManager
{
    private $_db;

    public function __construct($db)
    {
        $this->setDB($db);
    }

    public function addColis(Colis $colis)
    {
        $q = $this->_db->prepare('INSERT INTO colis(IdCollectionneur,DateEnvoiColis,LieuLivraison) VALUES(:IdCollectionneur,:DateEnvoiColis,:LieuLivraison)');
        $q->bindValue(':IdCollectionneur', $colis->getIdCollectionneur());
        $q->bindValue(':DateEnvoiColis', $colis->getDateEnvoiColis());
        $q->bindValue(':LieuLivraison', $colis->getLieuLivraison());

        $q->execute();

        $colis->hydrate([
            //lastInsertId — Retourne l'identifiant de la dernière ligne insérée ou la valeur d'une séquence
            'IdLivraison' => $this->_db->lastInsertId(),
        ]);
    }

    public function setDb(PDO $db)
    {
        $this->_db = $db;
    }
}
