<?php
include_once 'C:/wamp64/www/Vivote/config.php';
require_once DATABASE_PATH . '/database.php';

function register($nom, $prenom, $email, $password)
{
    if (!searche_accounts_by_email(trim($email))) {
        $db = get_connection();

        $data = [
            "nom" => $nom,
            "prenom" => $prenom,
            "email" => trim($email),
            "pass" => password_hash(trim($password), PASSWORD_BCRYPT)
        ];

        $query = 'INSERT INTO users(nom, prenom, email, pass) VALUES (:nom, :prenom, :email, :pass)';

        $st = $db->prepare($query);
        $st->execute($data);

        return $db->lastInsertId();
    }

    return FALSE;
}

function get_accounts($users_id)
{
    $db = get_connection();

    $query = "SELECT * FROM users WHERE id=:i";
    $st = $db->prepare($query);
    $st->execute(["i" => $users_id]);

    $result = $st->fetch(PDO::FETCH_OBJ);
    return $result;
}

function update_accounts($nom, $prenom, $email, $users_id)
{
    $db = get_connection();

    $data = [
        "nom" => $nom,
        "prenom" => $prenom,
        "email" => trim($email),
        "i" => $users_id
    ];

    $query = 'UPDATE users SET nom=:nom, prenom=:prenom, email=:email WHERE id=:i';

    $st = $db->prepare($query);
    $st->execute($data);

    return 1;
}

function update_accounts_pass($nom, $prenom, $email, $password, $users_id)
{
    $db = get_connection();

    $data = [
        "nom" => $nom,
        "prenom" => $prenom,
        "email" => trim($email),
        "pass" => password_hash(trim($password), PASSWORD_BCRYPT),
        "i" => $users_id
    ];

    $query = 'UPDATE users SET nom=:nom, prenom=:prenom, email=:email, pass=:pass WHERE id=:i';

    $st = $db->prepare($query);
    $st->execute($data);

    return 1;
}

function delete_accounts($users_id)
{

    $prevote = get_prevotes_id($users_id);

    if ($prevote) {
        foreach ($prevote as $pre) {
            $prevote_id = $pre->id;
            $pre_del = delete_all_for_users($prevote_id);
        }

        if ($pre_del) {
            if (delete_users($users_id)) {
                return 1;
            }
        }
    }

    //si l'users n'a pas encore de vote ni electeurs ni objectifs
    if (delete_users($users_id)) {
        return 1;
    }

    return FALSE;
}

function delete_users($users_id)
{
    $db = get_connection();

    $query = "DELETE FROM users WHERE id=:i";
    $st = $db->prepare($query);
    $res = $st->execute(["i" => $users_id]);

    return $res;
}

function login($email, $pass)
{

    $db = get_connection();
    $query = "SELECT * FROM users WHERE email=:e";

    $st = $db->prepare($query);
    $st->execute(["e" => $email]);
    $result = $st->fetch(PDO::FETCH_OBJ);

    if ($result) {
        if (password_verify(trim($pass), $result->pass)) {
            return $result;
        }
    }

    return FALSE;
}

function searche_accounts_by_email($email)
{
    $db = get_connection();

    $query = "SELECT * FROM users WHERE email=:e";
    $st = $db->prepare($query);
    $st->execute(["e" => $email]);
    $result = $st->fetch(PDO::FETCH_OBJ);

    if ($result) {
        return 1;
    }

    return FALSE;
}

function searche_accounts_by_name($name) {}
