<?php
    include_once 'C:/wamp64/www/Vivote/config.php';
    include_once FUNCTION_PATH.'/back.php';
    
    $prevote_id = intval($_GET['id']);
    if(isset($_POST['sb'])){
        $v = terminer_prevotes($prevote_id);

        if($v){
            header("Location: ../../");
        }else{
            echo "Une erreur est survenue lors du fin du session du vote !";
        }
    }
    
?>