<?php 
include_once 'includes/header.php';
include_once 'app/database/database.php';
function get_prevotes()
{
    $db = get_connection();

    $query = "SELECT * FROM prevote";

    $st = $db->prepare($query);
    $st->execute();
    $result = $st->fetchAll(PDO::FETCH_OBJ);

    return $result;
}
function get_nb_participants($prevote_id)
{
    $db = get_connection();

    $query = "SELECT * FROM lignedevote WHERE prevote_id=:i";
    $st = $db->prepare($query);
    $st->execute(["i" => $prevote_id]);
    $result = $st->fetch(PDO::FETCH_ASSOC);

    return count($result);
}

$results = get_prevotes();

?>
<div class="my-5">

    <div class="container">
        <div class="my-0 mx-auto login-form border p-4 rounded">
            <div class="d-flex flex-column py-2">
                <div class="label-group p-3 border rounded bg-light">
                    <h4>nom - php</h4>
                    <i>
                        <div>Groupe / organisation : nom - php</div>
                        <div>Electeurs inscrits : nom - php</div>
                    </i>
                    <hr>
                    <p>description - nom php</p>
                </div>

                <div class="label-group mt-3 p-3 border rounded bg-light">
                    <h4>nom - php</h4>
                    <i>
                        <div>Crochez l'objectifs que vous approuvez</div>
                        <div>Vous pouvez faire un (1) seul choix</div>
                    </i>
                    <hr>

                    <div><!-- nom - php -->
                        <input type="radio" name="choix_objectif" id="">
                        <label for="">Gustave James</label><br>

                        <input type="radio" name="choix_objectif" id="">
                        <label for="">Rickendy Presume</label><br>

                        <input type="radio" name="choix_objectif" id="">
                        <label for="">Elso Point-du-jour</label><br>
                    </div>

                </div>

            </div>

        </div>
    </div>

</div>

<?php include_once 'includes/footer.php' ?>