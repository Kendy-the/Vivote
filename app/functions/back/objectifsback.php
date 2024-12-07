<?php
include_once 'C:/wamp64/www/Vivote/config.php';
require_once DATABASE_PATH.'/database.php';

function create_objectifs($nom){

    if(!empty($nom)){
        $array_id[0] = 0;
        $db = get_connection();

        $query = 'INSERT INTO objectifs(nom) VALUES (:nom)';
        $st = $db->prepare($query);
        
        foreach($nom as $n){
            if(!empty($n)){
                $st->execute(["nom"=>$n] );
                array_push($array_id, $db->lastInsertId());
            }
        }

        if($db->lastInsertId()){
            return $array_id;
        }else{
            return FALSE;
        }
    }
    return FALSE;
}

function update_objectifs($objectifs){
    if(!empty($objectifs)){
        $db = get_connection();
        $array_id[0] = 0;
    
        $query = 'UPDATE objectifs SET nom=:n WHERE id =:i';
        $st = $db->prepare($query);
    
        for($i = 0; $i < count($objectifs); $i++){
            if(!empty($objectifs[$i][1])){
                $st->execute(["i"=> $objectifs[$i][0], "n"=>$objectifs[$i][1]] );
                array_push($array_id, $objectifs[$i][0]);
            }
        }
        return $array_id;
    }
    return FALSE;
}

function delete_objectifs($objectifs_id){
    $db = get_connection();

    $query = "DELETE FROM objectifs WHERE id=:i";
    $st = $db->prepare($query);
    $res = $st->execute(["i"=>$objectifs_id]);
    
    return $res;
}


function get_objectifs_id($objectifs){
    $db = get_connection();
    $query = "SELECT * FROM objectifs";

    $st = $db->prepare($query);
    $st->execute();
    $result = $st->fetchAll(PDO::FETCH_OBJ);

    $obj_id [] = null;

    for($i = 0; $i < count($objectifs); $i++){
        $trouver = FALSE;
        foreach($result as $res){
            if(trim($res->nom) == trim($objectifs[$i])){
                array_push($obj_id, $res->id);
                $trouver  = TRUE;
            }
        }
        if(!$trouver){
            array_push($obj_id,null);
        }    
    }
    array_shift($obj_id);
    return $obj_id;
}

function delete_prevote_objectifs_objectifs($objectifs_id){
    $db = get_connection();

    $query = "DELETE FROM prevote_objectifs WHERE objectifs_id=:i";

    for($i = 0; $i < count($objectifs_id); $i++){
        $st = $db->prepare($query);
        $st->execute(["i" => $objectifs_id[$i]]);
    }
    return 1;
}

function get_participants_election($prevote_id)
{
    $db = get_connection();

    $query = "SELECT * FROM objectifs INNER JOIN prevote_objectifs ON prevote_objectifs.objectifs_id = objectifs.id WHERE prevote_objectifs.prevote_id=:i";

    $st = $db->prepare($query);
    $st->execute(["i" => $prevote_id]);
    $result = $st->fetchAll(PDO::FETCH_OBJ);

    return $result;
}

function verifier_objectifs_a_supprimer($objectifs,$prevote_id){
     
    $objectifs_db = get_participants_election($prevote_id);
    $obj_del [] = null;

    $trouver = FALSE;
    foreach($objectifs_db as $obj_db){
        for($i=0; $i < count($objectifs); $i++){
            if($obj_db->nom == $objectifs[$i]){
                $trouver = TRUE;
                break;
            }
        }
        if(!$trouver){
            array_push($obj_del, $obj_db->objectifs_id);
        }
        $trouver = FALSE;
    }
    array_shift($obj_del);

    return $obj_del;
}

function get_objectifs_update($objectifs,$prevote_id){

    $objectifs_db = get_participants_election($prevote_id);
    $obj_upd [] = null;

    $trouver = FALSE;
    
    foreach($objectifs as $obj_user){
        foreach($objectifs_db as $obj_db){
            if($obj_user == $obj_db->nom){
                $trouver = TRUE;
                break;
            }
        }
        if(!$trouver){
            array_push($obj_upd,$obj_user);
        }
        $trouver = FALSE;
    }
    array_shift($obj_upd);

    $objectifs_a_update = get_objectifs_id($obj_upd);
    return $objectifs_a_update;
}

function searche_objectifs_by_id($id){
    
}
function searche_objectifs_by_name($name){

}
?>