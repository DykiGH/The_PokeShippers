<?php
class PosséderManager
{
    private $_db;

    public function __construct($db)
    {
        $this->setDB($db);
    }

    //permet la gestion de doublons de cartes //? (renvoi false si l'utilisateur n'a aucun exemplaire de la carte renseignée sinon true)
    public function verifMultipleCopies($IdCollectionneur, $valCarte): bool
    {
        $res = true;
        $idCarte = $valCarte->getIdCarte();
        $seriePaquet = $valCarte->getSeriePaquet();

        $sqlBooster = 'SELECT * FROM posséder WHERE IdCollectionneur=:IdCollectionneur AND idCarte=:idCarte AND seriePaquet=:seriePaquet';
        $req = $this->_db->prepare($sqlBooster);
        $req->bindParam(':IdCollectionneur', $IdCollectionneur);
        $req->bindParam(':idCarte', $idCarte);
        $req->bindParam(':seriePaquet', $seriePaquet);
        $req->execute();

        if ($req->rowCount() == 0) {
            $res = false;
        }

        return $res;
    }

    //permet la gestion de doublons de cartes //!POUR L ECHANGE
    public function verifMultipleCopiesEchange($IdCollectionneur, $IdCarte, $SeriePaquet): bool
    {
        $res = true;

        $sqlBooster = 'SELECT * FROM posséder WHERE IdCollectionneur=:IdCollectionneur AND IdCarte=:IdCarte AND SeriePaquet=:SeriePaquet';
        $req = $this->_db->prepare($sqlBooster);
        $req->bindParam(':IdCollectionneur', $IdCollectionneur);
        $req->bindParam(':IdCarte', $IdCarte);
        $req->bindParam(':SeriePaquet', $SeriePaquet);
        $req->execute();

        if ($req->rowCount() == 0) {
            $res = false;
        }

        return $res;
    }

    public function addCardsToUser($verif, $IdCollectionneur, $valCarte)
    {
        $idCarte = $valCarte->getIdCarte();
        $seriePaquet = $valCarte->getSeriePaquet();

        //si l'utilisateur n'a pas au moins un exemplaire de la carte en question
        if (!$verif) {
            $sqlAddCardsToUser = 'INSERT INTO posséder (IdCollectionneur, IdCarte , SeriePaquet) VALUES (:IdCollectionneur, :idCarte, :seriePaquet)';
            // Attribution des valeurs pour chaque paramètre
            $req = $this->_db->prepare($sqlAddCardsToUser);
            $req->bindParam(':IdCollectionneur', $IdCollectionneur);
            $req->bindParam(':idCarte', $idCarte);
            $req->bindParam(':seriePaquet', $seriePaquet);

            $req->execute();
        } else {
            //ajoute +1 au nbr d'exemplaires de la carte si nbrExemplaire est supérieur ou égal à 1
            $sqlAddIfDuplicate = 'UPDATE posséder SET nbrExemplaire = nbrExemplaire + 1 WHERE IdCollectionneur=:IdCollectionneur AND idCarte=:idCarte AND seriePaquet=:seriePaquet';
            $req = $this->_db->prepare($sqlAddIfDuplicate);
            $req->bindParam(':IdCollectionneur', $IdCollectionneur);
            $req->bindParam(':idCarte', $idCarte);
            $req->bindParam(':seriePaquet', $seriePaquet);

            $req->execute();
        }
    }

    //permet la gestion de doublons de cartes //? (renvoi false si l'utilisateur n'a aucun exemplaire de la carte renseignée sinon true)

    //ajouter le delete
    public function echangeCarteUtilisateur(bool $verifDoublonColl1, bool $verifDoublonColl2, bool $verifDoublonColl1WhenExchange, bool $verifDoublonColl2WhenExchange, $IdCollectionneur1, $IdCollectionneur2, $IdCarte1, $IdCarte2, $SeriePaquet1, $SeriePaquet2)
    {
        //si l'utilisateur1 n'a pas au moins un exemplaire de la carte en question
        if (!$verifDoublonColl1) {

            //le 1er collectionneur reçoit la carte du 2ème collectionneur
            $sqlTradeInsertUser1 = 'INSERT INTO posséder(IdCarte,SeriePaquet,IdCollectionneur) VALUES(:IdCarte2, :SeriePaquet2, :IdCollectionneur1)';
            $reqTradeInsertUser1 = $this->_db->prepare($sqlTradeInsertUser1);
            $reqTradeInsertUser1->bindParam(':IdCollectionneur1', $IdCollectionneur1);
            $reqTradeInsertUser1->bindParam(':IdCarte2', $IdCarte2);
            $reqTradeInsertUser1->bindParam(':SeriePaquet2', $SeriePaquet2);
            $reqTradeInsertUser1->execute();
        } else {

            //le 1er collectionneur reçoit la carte du 2ème collectionneur
            $sqlTradeUpdateUser1 = 'UPDATE posséder SET nbrExemplaire = nbrExemplaire + 1 WHERE IdCollectionneur=:IdCollectionneur1 AND IdCarte=:IdCarte2 AND SeriePaquet=:SeriePaquet2';
            $reqTradeUpdateUser1 = $this->_db->prepare($sqlTradeUpdateUser1);
            $reqTradeUpdateUser1->bindParam(':IdCollectionneur1', $IdCollectionneur1);
            $reqTradeUpdateUser1->bindParam(':IdCarte2', $IdCarte2);
            $reqTradeUpdateUser1->bindParam(':SeriePaquet2', $SeriePaquet2);
            $reqTradeUpdateUser1->execute();
        }
        //si l'utilisateur2 n'a pas au moins un exemplaire de la carte en question
        if (!$verifDoublonColl2) {

            //le 2eme collectionneur reçoit la carte du 1er collectionneur
            $sqlTradeInsertUser2 = 'INSERT INTO posséder(IdCarte,SeriePaquet,IdCollectionneur) VALUES(:IdCarte1, :SeriePaquet1, :IdCollectionneur2)';
            $reqTradeInsertUser2 = $this->_db->prepare($sqlTradeInsertUser2);
            $reqTradeInsertUser2->bindParam(':IdCollectionneur2', $IdCollectionneur2);
            $reqTradeInsertUser2->bindParam(':IdCarte1', $IdCarte1);
            $reqTradeInsertUser2->bindParam(':SeriePaquet1', $SeriePaquet1);
            $reqTradeInsertUser2->execute();
        } else {

            //le 2eme collectionneur reçoit la carte du 1er collectionneur
            $sqlTradeUpdateUser2 = 'UPDATE posséder SET nbrExemplaire = nbrExemplaire + 1 WHERE IdCollectionneur=:IdCollectionneur2 AND IdCarte=:IdCarte1 AND SeriePaquet=:SeriePaquet1';
            $reqTradeUpdateUser2 = $this->_db->prepare($sqlTradeUpdateUser2);
            $reqTradeUpdateUser2->bindParam(':IdCollectionneur2', $IdCollectionneur2);
            $reqTradeUpdateUser2->bindParam(':IdCarte1', $IdCarte1);
            $reqTradeUpdateUser2->bindParam(':SeriePaquet1', $SeriePaquet1);
            $reqTradeUpdateUser2->execute();
        }
        //vérifier que l'utilisateur n'a pas plusieurs exemplaires pour supprimer la carte
        if (!$verifDoublonColl1WhenExchange) {

            //On enleve 1 exemplaire de la carte échangée au premier collectionneur (s'il avait la carte en +ieurs exemplaires)
            $sqlWithdrawCardUser1 = 'UPDATE posséder SET nbrExemplaire = nbrExemplaire - 1 WHERE IdCollectionneur=:IdCollectionneur1 AND IdCarte=:IdCarte1 AND SeriePaquet=:SeriePaquet1';
            $reqWithdrawCardUser1 = $this->_db->prepare($sqlWithdrawCardUser1);
            $reqWithdrawCardUser1->bindParam(':IdCollectionneur1', $IdCollectionneur1);
            $reqWithdrawCardUser1->bindParam(':IdCarte1', $IdCarte1);
            $reqWithdrawCardUser1->bindParam(':SeriePaquet1', $SeriePaquet1);
            $reqWithdrawCardUser1->execute();
        } else {

            //S'il n'avait la carte qu'en 1 seul exemplaire on supprime la ligne de la table
            $sqlDeleteCardUser1 = 'DELETE FROM posséder WHERE IdCollectionneur=:IdCollectionneur1 AND IdCarte=:IdCarte1 AND SeriePaquet=:SeriePaquet1';
            $reqDeleteCardUser1 = $this->_db->prepare($sqlDeleteCardUser1);
            $reqDeleteCardUser1->bindParam(':IdCollectionneur1', $IdCollectionneur1);
            $reqDeleteCardUser1->bindParam(':IdCarte1', $IdCarte1);
            $reqDeleteCardUser1->bindParam(':SeriePaquet1', $SeriePaquet1);
            $reqDeleteCardUser1->execute();
        }
        //vérifier que l'utilisateur n'a pas plusieurs exemplaires pour supprimer la carte
        if (!$verifDoublonColl2WhenExchange) {

            //On enleve 1 exemplaire de la carte échangée au premier collectionneur (s'il avait la carte en +ieurs exemplaires)
            $sqlWithdrawCardUser2 = 'UPDATE posséder SET nbrExemplaire = nbrExemplaire - 1 WHERE IdCollectionneur=:IdCollectionneur2 AND IdCarte=:IdCarte2 AND SeriePaquet=:SeriePaquet2';
            $reqWithdrawCardUser2 = $this->_db->prepare($sqlWithdrawCardUser2);
            $reqWithdrawCardUser2->bindParam(':IdCollectionneur2', $IdCollectionneur2);
            $reqWithdrawCardUser2->bindParam(':IdCarte2', $IdCarte2);
            $reqWithdrawCardUser2->bindParam(':SeriePaquet2', $SeriePaquet2);
            $reqWithdrawCardUser2->execute();
        } else {

            //S'il n'avait la carte qu'en 1 seul exemplaire on supprime la ligne de la table
            $sqlDeleteCardUser2 = 'DELETE FROM posséder WHERE IdCollectionneur=:IdCollectionneur2 AND IdCarte=:IdCarte2 AND SeriePaquet=:SeriePaquet2';
            $reqDeleteCardUser2 = $this->_db->prepare($sqlDeleteCardUser2);
            $reqDeleteCardUser2->bindParam(':IdCollectionneur2', $IdCollectionneur2);
            $reqDeleteCardUser2->bindParam(':IdCarte2', $IdCarte2);
            $reqDeleteCardUser2->bindParam(':SeriePaquet2', $SeriePaquet2);
            $reqDeleteCardUser2->execute();
        }
    }

    public function getCarteUtilisateur($IdCollectionneur): array
    {
        $sqlAffCarteUtilisateur = 'SELECT C.IdCarte, C.SeriePaquet FROM posséder P, carte C WHERE IdCollectionneur=:IdCollectionneur AND P.IdCarte=C.IdCarte AND P.SeriePaquet=C.SeriePaquet';
        $reqAffCarteUtilisateur = $this->_db->prepare($sqlAffCarteUtilisateur);
        $reqAffCarteUtilisateur->bindParam(':IdCollectionneur', $IdCollectionneur);

        $reqAffCarteUtilisateur->execute();
        $allCarte = $reqAffCarteUtilisateur->fetchAll(PDO::FETCH_ASSOC);

        $cartes = array();

        foreach ($allCarte as $carteData) {
            $cartes[] = new Carte($carteData);
        }

        return $cartes;
    }

    public function setDb(PDO $db)
    {
        $this->_db = $db;
    }
}
