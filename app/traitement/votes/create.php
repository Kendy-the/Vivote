<?php
include_once 'C:/wamp64/www/Vivote/config.php';
include_once FUNCTION_PATH.'/back.php';
session_start();
if(isset($_POST['sb'])){
    $user_id = $_SESSION['id'];

    $titre = trim(htmlspecialchars(strtolower($_POST['titre'])));
    $organisme = trim(htmlspecialchars(strtolower($_POST['organisme'])));
    $description = trim(htmlspecialchars(strtolower($_POST['description'])));
    $objectifs = get_listes(trim(htmlspecialchars(strtolower($_POST['liste_objectifs']))));
    $electeurs = get_listes(trim(htmlspecialchars(strtolower($_POST['liste_participants']))));

    //on va chercher les id pour objectifs et electeurs s'il existe
    $obj_id = get_objectifs_id($objectifs);
    $elec_id = get_electeurs_id($electeurs);

    //on repartit les objectifs a update et ceux a inserer
    $objectifs_update_nom_id[0][0] = 'i';
    $objectifs_update_nom_id[0][1] = 'e';
    $objectifs_create_nom_id[0] = null;

    $i = 0;
    foreach($obj_id as $id){
        if($id != null){
            $objectifs_update_nom_id[$i][0] = $id;
            $i++;
        }
    }

    //on prend les nom des objectifs a update
    $i = 0;
    $j = 0;
    $k = 0;
    foreach($obj_id as $id){
        if($id != null){
            $objectifs_update_nom_id[$j][1] = $objectifs[$i];
            $j++;
        }else{
            $objectifs_create_nom_id[$k] = $objectifs[$i];
            $k++;
        }
        $i++;
        
    }
    if($objectifs_create_nom_id[0] == null){
        array_shift($objectifs_create_nom_id);
    }

    //on repartit les elcteurs a update et ceux a inserer
    $electeurs_update_nom_id[0][0] = 'i';
    $electeurs_update_nom_id[0][1] = 'e';
    $electeurs_create_nom_id[0] = null;

    $i = 0;
    foreach($elec_id as $id){
        if($id != null){
            $electeurs_update_nom_id[$i][0] = $id;
            $i++;
        }
        
    }

    //on prend les email des electeur a update
    $i = 0;
    $j = 0;
    $k = 0;
    foreach($elec_id as $id){
        if($id != null){
            $electeurs_update_nom_id[$j][1] = $electeurs[$i];
            $j++;   
        }else{
            $electeurs_create_nom_id[$k] = $electeurs[$i];
            $k++;
        }
        $i++;   
    }

    if($electeurs_create_nom_id[0] == null){
        array_shift($electeurs_create_nom_id);
    }

    //create - prevote
    $vote = create_vote($titre,$organisme,$description,$user_id);

    //update - electeurs
    $electeurs_update = update_participants($electeurs_update_nom_id);

    //update - objectif
    $objectifs_update = update_objectifs($objectifs_update_nom_id);

    //les valeurs a ajouter - electeur
    $electeurs_create = create_participants($electeurs_create_nom_id);

    //les valeurs a ajouter a objectifs
    $objectifs_create = create_objectifs($objectifs_create_nom_id);

    //insertion pour table ligne de vvote
    $ldv = 0;
    if ($electeurs_create) {
        $ldv = 0;
        for ($i = 0; $i < count($electeurs_create); $i++) {
            if ($i != 0) {
                $ldv = create_ligne_de_vote($electeurs_create[$i], $vote);
            }
        }
    }

    if($electeurs_update){
        for ($i = 0; $i < count($electeurs_update); $i++) {
            if ($i != 0) {
                $ldv = create_ligne_de_vote($electeurs_update[$i], $vote);
            }
        }
    }

    //insertion pour table prevote objectifs
    $po = 0;
    if ($objectifs_create) {
        for ($i = 0; $i < count($objectifs_create); $i++) {
            if ($i != 0) {
                $po = create_prevote_objectifs($objectifs_create[$i], $vote);
            }
        }
    }

    if($objectifs_update){
        if ($objectifs_update) {
            for ($i = 0; $i < count($objectifs_update); $i++) {
                if ($i != 0) {
                    $po = create_prevote_objectifs($objectifs_update[$i], $vote);
                }
            }
        }
    }

    if($vote){
        header("Location: ../../");
    }else{
        die("<b>Prevote objectifs not inscrits !<br>Une erreur est survenue</b>");
    }

}else{
    echo "veillez saisir les champs";
}
?>