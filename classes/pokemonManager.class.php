<?php
class PokemonManager
{
    private $_db;

    public function __construct($db)
    {
        $this->setDB($db);
    }


    public function selectAllPkmByPacket($seriePaquet)
    {
        $sqlSelectPaquetPkm = 'SELECT IdPokemon, NomPokemon, Type, Rareté, IdGenerationCarte, P.seriePaquet
                                    FROM pokemon P, carte C 
                                    WHERE P.idpokemon=C.idcarte 
                                    AND P.Seriepaquet=:seriePaquet ';

        $req = $this->_db->prepare($sqlSelectPaquetPkm);
        $req->bindValue(':seriePaquet', $seriePaquet);

        $req->execute();
        $allPoke = $req->fetchAll(PDO::FETCH_ASSOC);

        $pokemons = array();

        foreach ($allPoke as $pokemonData) {
            $pokemons[] = new Pokemon($pokemonData);
        }

        $nbrCommon = 4;
        $nbrUncommon = 3;

        $tabCommon = array();
        $tabUncommon = array();
        $tabRare = array();
        $tabEX = array();
        $tabPkm = array();

        foreach ($pokemons as $value) {

            if ($value->getRareté() == "commun") {
                array_push($tabCommon, $value);
            }
            if ($value->getRareté() == "peu_commun") {
                array_push($tabUncommon, $value);
            }

            if ($value->getRareté() == "rare") {
                array_push($tabRare, $value);
            }

            if ($value->getRareté() == "EX") {
                array_push($tabEX, $value);
            }
        }

        //choisit 4 cartes communes
        for ($i1 = 0; $i1 < $nbrCommon; $i1++) {
            $num = array_rand($tabCommon);
            array_push($tabPkm, $tabCommon[$num]);
        }

        //choisit 3 cartes peu-communes
        for ($i2 = 0; $i2 < $nbrUncommon; $i2++) {
            $num = array_rand($tabUncommon);
            array_push($tabPkm, $tabUncommon[$num]);
        }

        //accès à la méthode de la classe Carte
        $rarete = getRandomRarete();
        if ($rarete == "rare") {

            // Choisir une carte rare 19/20
            $num = array_rand($tabRare);
            array_push($tabPkm, $tabRare[$num]);
        } else {

            // Choisir une carte EX 1/20
            $num = array_rand($tabEX);
            array_push($tabPkm, $tabEX[$num]);
        }

        return $tabPkm;
    }


    public function getLstCartePkmUser(Collectionneur $user)
    {
        $IdCollectionneur = $user->getIdCollectionneur();

        $sqlLstCartePkmUser = 'SELECT IdPokemon, PKM.SeriePaquet, NomPokemon, Type FROM pokemon PKM, carte Ca, posséder P, Collectionneur Co
                                WHERE P.IdCollectionneur=6
                                AND PKM.IdPokemon=Ca.IdCarte AND Ca.IdCarte=P.IdCarte AND P.IdCollectionneur=Co.IdCollectionneur';

        $req = $this->_db->prepare($sqlLstCartePkmUser);
        $req->bindValue(':IdCollectionneur', $IdCollectionneur);

        $req->execute();

        $pkm = $req->fetchAll(PDO::FETCH_ASSOC);

        $pokemons = array();

        foreach ($pkm as $pokeData) {
            $pokemons[] = new Pokemon($pokeData);
        }

        return $pokemons;
    }

    // public function countPokemon()
    // {
    //     return $this->_db->query("SELECT COUNT(*) FROM pokemon")->fetchColumn();
    // }

    public function setDb(PDO $db)
    {
        $this->_db = $db;
    }
}
