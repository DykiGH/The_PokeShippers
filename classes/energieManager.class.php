<?php
class EnergieManager
{
    private $_db;

    public function __construct($db)
    {
        $this->setDB($db);
    }


    public function selectAllEnergies($seriePaquet)
    {

        $sqlSelectAllEnergies = 'SELECT IdEnergie, NomEnergie, IdGenerationCarte, Rareté, E.SeriePaquet
                                FROM energie E, carte C 
                                WHERE E.IdEnergie=C.IdCarte
                                AND E.Seriepaquet=:seriePaquet';

        $req = $this->_db->prepare($sqlSelectAllEnergies);
        $req->bindValue(':seriePaquet', $seriePaquet);
        $req->execute();
        $allEnergies = $req->fetchAll(PDO::FETCH_ASSOC);

        $energies = array();
        foreach ($allEnergies as $energyData) {
            $energies[] = new Energie($energyData);
        }

        $tabEnergie = array();

        $num = array_rand($energies);
        array_push($tabEnergie, $energies[$num]);

        return $tabEnergie;
    }

    public function getLstCarteEnergieUser(Collectionneur $user)
    {
        $IdCollectionneur = $user->getIdCollectionneur();

        $sqlLstCarteEnergieUser = 'SELECT IdEnergie, E.SeriePaquet, NomEnergie FROM energie E, carte Ca, posséder P, Collectionneur Co
                                WHERE P.IdCollectionneur=6
                                AND E.IdEnergie=Ca.IdCarte AND Ca.IdCarte=P.IdCarte AND P.IdCollectionneur=Co.IdCollectionneur';

        $req = $this->_db->prepare($sqlLstCarteEnergieUser);
        $req->bindValue(':IdCollectionneur', $IdCollectionneur);

        $req->execute();

        $energie = $req->fetchAll(PDO::FETCH_ASSOC);

        $energies = array();

        foreach ($energie as $energieData) {
            $energies[] = new Energie($energieData);
        }

        return $energies;
    }

    public function setDb(PDO $db)
    {
        $this->_db = $db;
    }
}
