<?php
class CollectionneurManager
{
    private $_db;

    public function __construct($db)
    {
        $this->setDB($db);
    }

    public function addCollectionneur(Collectionneur $user)
    {
        $q = $this->_db->prepare('INSERT INTO collectionneur(pseudo,mail,mdp,role,credit) VALUES(:pseudo, :mail, :mdp, :role, :credit)');
        $q->bindValue(':pseudo', $user->getPseudo());
        $q->bindValue(':mail', $user->getMail());
        $q->bindValue(':mdp', $user->getMdp());
        $q->bindValue(':role', $user->getRole());
        $q->bindValue(':credit', 0);

        $q->execute();

        $user->hydrate([
            //lastInsertId — Retourne l'identifiant de la dernière ligne insérée ou la valeur d'une séquence
            'IdCollectionneur' => $this->_db->lastInsertId(),
        ]);
    }

    public function getConnexionCollectionneur($sonMail)
    {
        $sqlUserInfo = 'SELECT IdCollectionneur, Pseudo, Mail, Mdp, Role, Credit FROM collectionneur WHERE Mail =:Mail ';
        $req = $this->_db->prepare($sqlUserInfo);
        $req->bindValue(':Mail', $sonMail);
        $req->execute();
        $userInfo = $req->fetch(PDO::FETCH_ASSOC);
        if ($userInfo) {
            return new Collectionneur($userInfo);
        } else {
            // header('Location: ./index.php?err=1010');
            return $userInfo;
        }
    }

    //on a besoin de cette methode pour des $_GET et ne pas stocker un mot de passe (ce que fait getConnexionCollectionneur)
    public function getCollectionneur($sonId)
    {
        $sqlInfoColl = 'SELECT IdCollectionneur, Pseudo, Mail, Role, Credit FROM collectionneur WHERE IdCollectionneur=:sonId ';
        $req = $this->_db->prepare($sqlInfoColl);
        $req->bindParam(':sonId', $sonId);
        $req->execute();
        $res = $req->fetch(PDO::FETCH_ASSOC);
        if ($res) {
            return new Collectionneur($res);
        } else {
            header('Location: ./index.php?err=1010');
        }
    }

    public function updateCreditCollectionneur(Collectionneur $user)
    {
        $q = $this->_db->prepare('UPDATE collectionneur SET credit=:credit WHERE idCollectionneur=:idCollectionneur');

        $idCollectionneur = $user->getIdCollectionneur();
        $credit = $user->getCredit();

        $q->bindValue(':idCollectionneur', $idCollectionneur);
        $q->bindValue(':credit', $credit);
        $q->execute();
    }

    public function getLstCollectionneur($IdCollectionneur)
    {
        $sqlLstCollectionneur = 'SELECT IdCollectionneur, Pseudo FROM collectionneur WHERE IdCollectionneur !=:IdCollectionneur ORDER BY Pseudo';

        $req = $this->_db->prepare($sqlLstCollectionneur);
        $req->bindValue(':IdCollectionneur', $IdCollectionneur);
        $req->execute();

        $coll = $req->fetchAll(PDO::FETCH_ASSOC);

        $collectionneurs = array();

        foreach ($coll as $collData) {
            $collectionneurs[] = new Collectionneur($collData);
        }

        return $collectionneurs;
    }

    public function exists($mailUser, $mdpUser)
    {
        $q = $this->_db->prepare('SELECT COUNT(*) FROM collectionneur WHERE mail = :mail AND mdp = :mdp');
        $q->execute([':mail' => $mailUser, ':mdp' => $mdpUser]);
        return (bool) $q->fetchColumn();
    }

    public function setDb(PDO $db)
    {
        $this->_db = $db;
    }
}
