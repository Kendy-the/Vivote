<?php
function create_path_vote($electeurs_id)
{

    $db = get_connection();

    $query = "SELECT * FROM lignedevote WHERE electeurs_id=:i";
    $st = $db->prepare($query);
    $st->execute(["i" => $electeurs_id]);
    $result = $st->fetch(PDO::FETCH_OBJ);


    // Chemin du dossier à créer
    $long_url = $result->url;
    $fileName = "index.php";

    $a_url = explode("/", $long_url);
    $fvn = $a_url[5];
    $folder_vote_name = "http://localhost/vivote/v/" . $fvn;

    // Vérifier si le dossier existe
    if (!file_exists($folder_vote_name)) {
        // Créer le dossier avec les permissions 0755
        if (mkdir($folder_vote_name, 0755, true)) {
            echo "Dossier '$folder_vote_name' créé avec succès.<br>";
        } else {
            die("Erreur : Impossible de créer le dossier '$folder_vote_name'.<br>");
        }
    }

    $folder_user_name = $folder_vote_name . "/". $a_url[6]."/";
    // Chemin complet du fichier à créer dans le dossier
    $filePath = $folder_user_name . $fileName;

    // Créer le fichier à l'intérieur du dossier
    $fileHandle = fopen($filePath, "w");

    $content = "<?php include_once '../../includes/header.php' ?>" .
        '<link rel="stylesheet" href="../../assets/css/styles.css">

<form action="#" method="POST" class="my-5">

    <div class="container">
        <div class="my-0 mx-auto login-form border p-4 rounded">
            <div class="d-flex flex-column py-2">
                <div class="label-group p-3 border rounded bg-light">
                    <h4>nom - php</h4>
                    <i>
                        <div>Groupe / organisation : nom - php</div>
                        <div>Electeurs inscrits : nom - php</div>
                    </i><hr>
                    <p>description - nom php</p>
                </div>

                <div class="label-group mt-3 p-3 border rounded bg-light">
                    <h4>nom - php</h4>
                    <i>
                        <div>Crochez l\'objectifs que vous approuvez</div>
                        <div>Vous pouvez faire un (1) seul choix</div>
                    </i><hr>

                    <div><!-- nom - php -->
                        <input type="radio" name="choix_objectif" id="">
                        <label for="">Gustave James</label><br>

                        <input type="radio" name="choix_objectif" id="">
                        <label for="">Rickendy Presume</label><br>

                        <input type="radio" name="choix_objectif" id="">
                        <label for="">Elso Point-du-jour</label><br>
                    </div>
                </div>

                <div class="label-group mt-3">
                    <input type="submit" class="btn border primary-color sub-btn float-end" value="Je vote">
                </div>
            </div>

        </div>
    </div>

</form>

<?php include_once \'../../includes/footer.php\' ?>';

    if ($fileHandle) {

        fwrite($fileHandle, $content);
        fclose($fileHandle);
    } else {
        die("Erreur : Impossible de créer le fichier '$fileName'.<br>");
    }

    return 1;
}