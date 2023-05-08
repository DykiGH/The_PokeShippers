<?php
class DresseurManager
{
    private $_db;

    public function __construct($db)
    {
        $this->setDB($db);
    }


    public function selectAllTrainers($seriePaquet)
    {

        $sqlSelectAllTrainers = 'SELECT IdDresseur, NomDresseur, IdGenerationCarte, Rareté, D.SeriePaquet
                                FROM dresseur D, carte C 
                                WHERE D.idDresseur=C.idcarte
                                AND D.Seriepaquet=:seriePaquet';

        $req = $this->_db->prepare($sqlSelectAllTrainers);
        $req->bindValue(':seriePaquet', $seriePaquet);
        $req->execute();
        $allTrainers = $req->fetchAll(PDO::FETCH_ASSOC);

        $trainers = array();
        foreach ($allTrainers as $trainersData) {
            $trainers[] = new Dresseur($trainersData);
        }

        $tabTrainers = array();

        $num = array_rand($trainers);
        array_push($tabTrainers, $trainers[$num]);

        return $tabTrainers;
    }

    public function getLstCarteDresseurUser(Collectionneur $user)
    {
        $IdCollectionneur = $user->getIdCollectionneur();

        $sqlLstCarteDresseurUser = 'SELECT IdDresseur, D.SeriePaquet, NomDresseur FROM dresseur D, carte Ca, posséder P, Collectionneur Co
                                WHERE P.IdCollectionneur=6
                                AND D.IdDresseur=Ca.IdCarte AND Ca.IdCarte=P.IdCarte AND P.IdCollectionneur=Co.IdCollectionneur';

        $req = $this->_db->prepare($sqlLstCarteDresseurUser);
        $req->bindValue(':IdCollectionneur', $IdCollectionneur);

        $req->execute();

        $dresseur = $req->fetchAll(PDO::FETCH_ASSOC);

        $dresseurs = array();

        foreach ($dresseur as $dresseurData) {
            $dresseurs[] = new Energie($dresseurData);
        }

        return $dresseurs;
    }

    public function setDb(PDO $db)
    {
        $this->_db = $db;
    }
}
