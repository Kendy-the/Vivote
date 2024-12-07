<?php
include_once 'C:/wamp64/www/Vivote/config.php';
include_once FUNCTION_PATH . '/back.php';

session_start();
if (isset($_POST['sb'])) {
    $prevote_id = $_GET['id'];

    $titre = htmlspecialchars(strtolower($_POST['titre']));
    $organisme = htmlspecialchars(strtolower($_POST['organisme']));
    $description = htmlspecialchars(strtolower($_POST['description']));
    $objectifs = get_listes(htmlspecialchars(strtolower($_POST['liste_objectifs'])));
    $electeurs = get_listes(htmlspecialchars(strtolower($_POST['liste_participants'])));

    //on enleve les lignes vides
    array_pop($objectifs);
    array_pop($electeurs);

    //on va chercher les id pour objectifs et electeurs s'il existe
    $obj_id = get_objectifs_id($objectifs);
    $elec_id = get_electeurs_id($electeurs);

    $objectifs_create_nom_id[0] = null;

    //on prend les nom des objectifs a creer
    $i = 0;
    $k = 0;
    foreach($obj_id as $id){
        if($id == null){
            $objectifs_create_nom_id[$k] = $objectifs[$i];
            $k++;
        }
        $i++;
        
    }

    if($objectifs_create_nom_id[0] == null){
        array_shift($objectifs_create_nom_id);
    }

    $electeurs_create_nom_id[0] = null;

    //on prend les email des electeur a creer
    $i = 0;
    $k = 0;

    foreach($elec_id as $id){
        if($id == null){
            $electeurs_create_nom_id[$k] = $electeurs[$i];
            $k++;
        }
        $i++;   
    }

    if($electeurs_create_nom_id[0] == null){
        array_shift($electeurs_create_nom_id);
    }

    //update - prevote
    $update_votes = update_vote($titre, $organisme, $description, $prevote_id);

    //les valeurs a ajouter - electeur
    $electeurs_create = create_participants($electeurs_create_nom_id);

    //les valeurs a ajouter a objectifs
    $objectifs_create = create_objectifs($objectifs_create_nom_id);

    //insertion pour table ligne de vvote
    
    $ldv = 0;
    if ($electeurs_create) {
        for ($i = 0; $i < count($electeurs_create); $i++) {
            if ($i != 0) {
                $ldv = create_ligne_de_vote($electeurs_create[$i], $prevote_id);
                var_dump($ldv);
            }
        }
    }

    //on prend les electeurs a update
    $electeurs_upd = get_electeurs_update($electeurs,$prevote_id);
    
    if($electeurs_upd){
        for ($i = 0; $i < count($electeurs_upd); $i++) {
            if($electeurs_upd[$i] != null){
                $ldv = create_ligne_de_vote($electeurs_upd[$i], $prevote_id);
            }
        }
    }

    //insertion pour table prevote objectifs
    if ($objectifs_create) {
        $po = 0;
        for ($i = 0; $i < count($objectifs_create); $i++) {
            if ($i != 0) {
                $po = create_prevote_objectifs($objectifs_create[$i], $prevote_id);
            }
        }
    }

    //on prend les objectifs a update
    $objectifs_upd = get_objectifs_update($objectifs,$prevote_id);

    if ($objectifs_upd) {
        for ($i = 0; $i < count($objectifs_upd); $i++) {
            if($objectifs_upd[$i] != null){
                $po = create_prevote_objectifs($objectifs_upd[$i], $prevote_id);
            }
        }
    }

    //on cherche les objectifs supprimer du vote et on les supprime
    $objectifs_id_delete = verifier_objectifs_a_supprimer($objectifs,$prevote_id);
    $obj_del = delete_prevote_objectifs_objectifs($objectifs_id_delete);
    if(!$obj_del){
        echo("<br>Erreur de suppression objectifs</br></b>");
    }

    //on cherche les electeurs supprimer du vote et on les supprime
    $electeurs_id_delete = verifier_electeurs_a_supprimer($electeurs,$prevote_id);
    $elec_del = delete_ligne_de_vote_electeurs($electeurs_id_delete);
    if(!$elec_del){
        echo("<br>Erreur de suppression electeurs</br></b>");
    }

    //redirection
    if($update_votes){
        header("Location: ../../");
    }else {
        die("<br>Une erreur est survenue</br> veuillez reassayer plutaard !<b>");
    }

} else {
    echo "veillez saisir les champs";
}