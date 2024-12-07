<?php
include_once 'C:/wamp64/www/Vivote/config.php';
require_once DATABASE_PATH.'/database.php';

function create_participants($email){

    if(!empty($email)){
        $db = get_connection();
        $array_id[0] = 0;

        $query = 'INSERT INTO electeurs(email) VALUES (:e)';
        $st = $db->prepare($query);

        foreach($email as $mail){
            $st->execute(["e"=>$mail] );
            array_push($array_id, $db->lastInsertId());
        }
        if($db->lastInsertId()){
            return $array_id;
        }else{
            return FALSE;
        }
    }
    return FALSE;
}

function update_participants($electeurs){
    if(!empty($electeurs)){
        $db = get_connection();
        $array_id[0] = 0;

        $query = 'UPDATE electeurs SET email=:e WHERE id =:i';
        $st = $db->prepare($query);

        for($i = 0; $i < count($electeurs); $i++){
            $st->execute(["i"=> $electeurs[$i][0], "e"=>$electeurs[$i][1]] );
            array_push($array_id, $electeurs[$i][0]);
        }
        return $array_id;
    }
    return FALSE;
}

function get_electeurs_id($electeurs){
    $db = get_connection();
    $query = "SELECT * FROM electeurs";

    $st = $db->prepare($query);
    $st->execute();
    $result = $st->fetchAll(PDO::FETCH_OBJ);

    $elec_id [] = null;

    for($i = 0; $i < count($electeurs); $i++){
        $trouver = FALSE;
        foreach($result as $res){
            if(trim($res->email) == trim($electeurs[$i])){
                array_push($elec_id, $res->id);
                $trouver  = TRUE;
            }
        }
        if(!$trouver){
            array_push($elec_id,null);
        }    
    }
    array_shift($elec_id);
    return $elec_id;
}

function delete_ligne_de_vote_electeurs($electeurs_id){
    $db = get_connection();

    $query = "DELETE FROM lignedevote WHERE electeurs_id=:i";

    for($i = 0; $i < count($electeurs_id); $i++){
        $st = $db->prepare($query);
        $st->execute(["i" => $electeurs_id[$i]]);
    }
    return 1;
}

function verifier_electeurs_a_supprimer($electeurs,$prevote_id){
    $electeurs_db = get_electeurs_election($prevote_id);
    $elec_del [] = null;

    $trouver = FALSE;
    foreach($electeurs_db as $elec_db){
        for($i=0; $i < count($electeurs); $i++){
            if($elec_db->email == $electeurs[$i]){
                $trouver = TRUE;
                break;
            }
        }
        if(!$trouver){
            array_push($elec_del, $elec_db->electeurs_id);
        }
        $trouver = FALSE;
    }
    array_shift($elec_del);

    return $elec_del;
}

function get_electeurs_update($electeurs,$prevote_id){
    $electeurs_db = get_electeurs_election($prevote_id);

    $elec_upd [] = null;

    $trouver = FALSE;
    foreach($electeurs as $elec_user){
        foreach($electeurs_db as $elec_db){
            if($elec_user == $elec_db->email){
                $trouver = TRUE;
                break;
            }
        }
        if(!$trouver){
            array_push($elec_upd,$elec_user);
        }
        $trouver = FALSE;
    }

    array_shift($elec_upd);

    $electeurs_a_update = get_electeurs_id($elec_upd);
    return $electeurs_a_update;
}

function update_participants_email_verify($email){
    $db = get_connection();
    $query = "SELECT * FROM electeurs";
    $st = $db->prepare($query);
    $st->execute();
    $result = $st->fetch(PDO::FETCH_ASSOC);
    
    foreach($result as $res){
        if($res-> email == $email){
            return TRUE;
        }
    }
    return FALSE;
}   

function update_participants_id_verify($id){
    $db = get_connection();
    $query = "SELECT * FROM electeurs";
    $st = $db->prepare($query);
    $st->execute();
    $result = $st->fetch(PDO::FETCH_ASSOC);
    
    foreach($result as $res){
        if($res-> id == $id){
            return TRUE;
        }
    }
    return FALSE;
}

function get_nb_participants($prevote_id){
    $db = get_connection();

    $query = "SELECT * FROM lignedevote WHERE prevote_id=:i";
    $st = $db->prepare($query);
    $st->execute(["i" => $prevote_id]);
    $result = $st->fetchAll(PDO::FETCH_OBJ);

    return count($result);
}

function delete_electeurs($electeurs_id){
    $db = get_connection();

    $query = "DELETE FROM electeurs WHERE id=:i";
    $st = $db->prepare($query);
    $res = $st->execute(["i"=>$electeurs_id]);

    return $res;
}

function get_participants(){
    $db = get_connection();

    $query = "SELECT * FROM electeurs";

    $st = $db->prepare($query);
    $st->execute();
    $result = $st->fetchAll(PDO::FETCH_OBJ);
    
    return $result;
}

function get_electeurs_election($prevote_id){
    $db = get_connection();

    $query = "SELECT * FROM electeurs INNER JOIN lignedevote ON electeurs.id = lignedevote.electeurs_id WHERE prevote_id=:i";

    $st = $db->prepare($query);
    $st->execute(["i"=>$prevote_id]);
    $result = $st->fetchAll(PDO::FETCH_OBJ);

    return $result;
}

function get_prevotes_election($prevote_id)
{
    $db = get_connection();

    $query = "SELECT * FROM prevote WHERE id=:i";

    $st = $db->prepare($query);
    $st->execute(["i" => $prevote_id]);
    $result = $st->fetchAll(PDO::FETCH_OBJ);

    return $result;
}

function participants_verify($email,$choix_vote)
{
    $result = get_electeurs_election($choix_vote);
    $trouver = FALSE;
    
    foreach ($result as $participant) {
        if ($participant->email == $email) {
            $trouver = TRUE;
            header("Location: election.php?par_id=$participant->electeurs_id&pre_id=$choix_vote");
            exit;
        }
    }

    if (!$trouver) {
        return "<br><br><b class='mb-3 text-center text-danger' style='font-size:15px;'>Vous n'etes pas autorises a voter a ce vote!</b>";
    }

}

function participants_verify_result($email,$choix_vote)
{
    $result = get_electeurs_election($choix_vote);
    $trouver = FALSE;
    
    foreach ($result as $participant) {
        if ($participant->email == $email) {
            $trouver = TRUE;
        }
    }

    if (!$trouver) {
        return "<br><br><b class='mb-3 text-center text-danger' style='font-size:15px;'>Vous n'etes pas autorises a voir les resultats du vote choisit!</b>";
    }

}

function participants_verify_election($prevote_id, $participant_id)
{
    $db = get_connection();

    $query = "SELECT * FROM vote WHERE prevote_id=:i";

    $st = $db->prepare($query);
    $st->execute(["i" => $prevote_id]);
    $result = $st->fetchAll(PDO::FETCH_OBJ);

    $trouver = FALSE;
    if ($result) {

        foreach ($result as $lines) {
            if ($lines->electeurs_id == $participant_id) {
                return TRUE;
            }
        }
        return $trouver;
    } else {
        return $trouver;
    }
}

function send_mail($participants_mail){
    $to = "chelbe.xdesign@gmail.com"; 
    $subject = "Test d'envoi d'e-mail";
    $message = "Ceci est un test d'envoi d'e-mail depuis le serveur local.";
    $headers = "From: Kendythe.c@gmail.com";

    if(mail($to, $subject, $message, $headers)) {
        echo "E-mail envoyé avec succès.";
    } else {
        echo "Échec de l'envoi de l'e-mail.";
    }
}

function searche_participants_by_id($id){
    
}
function searche_participants_by_name($name){

}
?>