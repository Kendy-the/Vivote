<?php
include_once 'C:/wamp64/www/Vivote/config.php';
require_once DATABASE_PATH . '/database.php';

function create_vote($titre, $organisme, $description, $user_id)
{
    $db = get_connection();
    $url = create_url_vote();
    $statut = 0;

    $data = [
        "titre" => $titre,
        "organisme" => $organisme,
        "description" => $description,
        "users_id" => $user_id,
        "url" => $url,
        "statut" => $statut
    ];

    $query = 'INSERT INTO prevote(titre, organisme, description, url, statut, users_id) VALUES (:titre, :organisme, :description, :url, :statut, :users_id)';

    $st = $db->prepare($query);
    $st->execute($data);

    return $db->lastInsertId();
}

function update_vote($titre, $organisme, $description, $id)
{
    $db = get_connection();

    $data = [
        "titre" => $titre,
        "organisme" => $organisme,
        "description" => $description,
        "id" => $id
    ];

    $query = "UPDATE prevote SET titre=:titre, organisme=:organisme, description=:description WHERE id=:id";

    $st = $db->prepare($query);
    $st->execute($data);

    return 1;
}

function delete_vote($prevote_id)
{
    $db = get_connection();

    $query = "DELETE FROM vote WHERE prevote_id=:i";
    $st = $db->prepare($query);
    $res = $st->execute(["i" => $prevote_id]);

    return $res;
}

function delete_all_for_users($prevote_id)
{
    $db = get_connection();

    //chercher et supprimer les electeurs d'un users
    $selecteurs = get_electeurs_election($prevote_id);
    $elec_del = FALSE;
    foreach ($selecteurs as $eles_db) {
        $elec_del = delete_electeurs($eles_db->electeurs_id);
    }

    //chercher et supprimer les objectifs d'un users
    $objectifs = get_participants_election($prevote_id);
    $obj_del = FALSE;
    foreach ($objectifs as $obj_db) {
        $obj_del = delete_objectifs($obj_db->objectifs_id);
    }

    if (delete_vote($prevote_id)) {

        if ($elec_del && $obj_del) {

            if (delete_ligne_de_vote_prevote($prevote_id)) {

                if (delete_prevote_objectifs_prevote($prevote_id)) {

                    $query = "DELETE FROM prevote WHERE id=:i";
                    $st = $db->prepare($query);
                    $res = $st->execute(["i" => $prevote_id]);

                    return $res;
                }
            }
        }
    }

    return FALSE;
}

function delete_ligne_de_vote_prevote($prevote_id)
{
    $db = get_connection();

    $query = "DELETE FROM lignedevote WHERE prevote_id=:i";
    $st = $db->prepare($query);
    $res = $st->execute(["i" => $prevote_id]);

    return $res;
}

function delete_prevote_objectifs_prevote($prevote_id)
{
    $db = get_connection();

    $query = "DELETE FROM prevote_objectifs WHERE prevote_id=:i";
    $st = $db->prepare($query);
    $res = $st->execute(["i" => $prevote_id]);

    return $res;
}

function set_vote($prevote_id, $participant_id, $choix)
{
    $db = get_connection();

    $data = [
        "prevote" => $prevote_id,
        "participant" => $participant_id,
        "choix" => $choix
    ];

    $query = 'INSERT INTO vote(prevote_id, objectifs_id, electeurs_id) VALUES (:prevote, :participant, :choix)';

    $st = $db->prepare($query);
    $st->execute($data);

    return $db->lastInsertId();
}

function get_results($prevote_id, $user_id) {}

function auth_results($prevote_id) {}

function create_url_vote()
{
    $url = "http://localhost/vivote/v/e/";
    return $url;
}

function get_url()
{
    $db = get_connection();

    $query = "SELECT url FROM prevote LIMIT 1";

    $st = $db->prepare($query);
    $st->execute();
    $result = $st->fetchAll(PDO::FETCH_OBJ);

    return $result;
}

function create_ligne_de_vote($selecteurs_id, $prevote_id)
{
    if ($selecteurs_id != 0 && $prevote_id != 0) {
        $db = get_connection();

        $data = [
            "electeurs_id" => $selecteurs_id,
            "prevote_id" => $prevote_id
        ];

        $query = 'INSERT INTO lignedevote(electeurs_id, prevote_id) VALUES (:electeurs_id, :prevote_id)';

        $st = $db->prepare($query);
        $st->execute($data);

        return $db->lastInsertId();
    }
    return FALSE;
}

function update_ligne_de_vote($selecteurs_id, $prevote_id)
{
    $db = get_connection();

    $data = [
        "electeurs_id" => $selecteurs_id,
        "prevote_id" => $prevote_id
    ];

    $query = 'UPDATE lignedevote SET electeurs_id=:electeurs_id WHERE prevote_id=:prevote_id';

    $st = $db->prepare($query);
    $st->execute($data);

    return 1;
}

function create_prevote_objectifs($objectifs_id, $prevote_id)
{
    if($objectifs_id != 0 && $prevote_id != 0){
        $db = get_connection();

        $data = [
            "objectifs_id" => $objectifs_id,
            "prevote_id" => $prevote_id
        ];

        $query = 'INSERT INTO prevote_objectifs(objectifs_id, prevote_id) VALUES (:objectifs_id, :prevote_id)';

        $st = $db->prepare($query);
        $st->execute($data);

        return $db->lastInsertId();
    }
    return FALSE;
}

function update_prevote_objectifs($objectifs_id, $prevote_id)
{
    $db = get_connection();

    $data = [
        "objectifs_id" => $objectifs_id,
        "prevote_id" => $prevote_id
    ];

    $query = 'UPDATE prevote_objectifs SET objectifs_id=:objectifs_id WHERE prevote_id=:prevote_id';

    $st = $db->prepare($query);
    $st->execute($data);

    return 1;
}


function get_prevotes()
{
    $db = get_connection();

    $query = "SELECT * FROM prevote";

    $st = $db->prepare($query);
    $st->execute();
    $result = $st->fetchAll(PDO::FETCH_OBJ);

    return $result;
}

function get_prevotes_id($user_id)
{
    $db = get_connection();

    $query = "SELECT * FROM prevote WHERE users_id =:i";

    $st = $db->prepare($query);
    $st->execute(["i" => $user_id]);
    $result = $st->fetchAll(PDO::FETCH_OBJ);

    return $result;
}

function get_prevotes_invite()
{
    $db = get_connection();
    $statut = 2;

    $query = "SELECT * FROM prevote WHERE statut !=:s";

    $st = $db->prepare($query);
    $st->execute(["s" => $statut]);
    $result = $st->fetchAll(PDO::FETCH_OBJ);

    return $result;
}

function publier_prevotes($prevote_id)
{
    $db = get_connection();

    $query = "UPDATE prevote SET statut = 1 WHERE id=:i";

    $st = $db->prepare($query);
    $st->execute(["i" => $prevote_id]);
    return 1;
}

function terminer_prevotes($prevote_id)
{
    $db = get_connection();

    $query = "UPDATE prevote SET statut = 2 WHERE id=:i";

    $st = $db->prepare($query);
    $st->execute(["i" => $prevote_id]);
    return 1;
}

function get_vote_prevotes($prevote_id)
{
    $db = get_connection();

    $query = "SELECT * FROM vote WHERE prevote_id=:i";
    $st = $db->prepare($query);
    $st->execute(["i" => $prevote_id]);
    $result = $st->fetchAll(PDO::FETCH_OBJ);

    return $result;
}

function get_nb_voix_prevote_objectifs_id($prevote_id, $objectifs_id)
{
    $db = get_connection();

    $query = "SELECT * FROM vote WHERE prevote_id=:prevote_id AND objectifs_id=:objectifs_id";
    $st = $db->prepare($query);
    $st->execute(["prevote_id" => $prevote_id, "objectifs_id" => $objectifs_id]);
    $result = $st->fetchAll(PDO::FETCH_OBJ);

    return count($result);
}
function searche_by_id($table, $id)
{
    $db = get_connection();

    $query = "SELECT * FROM $table WHERE id=:i";
    $st = $db->prepare($query);
    $st->execute(["i" => $id]);
    $result = $st->fetchAll(PDO::FETCH_OBJ);

    return $result;
}

function searche_votes_by_name($name) {}
