<?php

function debug($tableau) {
    echo '<pre style="height:100px;overflow-y: scroll;font-size:.5rem;padding: .6rem; font-family: Consolas, Monospace;background-color: #000;color:#fff;">';
    print_r($tableau);
    echo '</pre>';
}
function getValueInput($key) {
    if(!empty($_POST[$key])) { 
        echo $_POST[$key]; 
    }
}
function Validpseudo($errors, $value,$key, $min, $max) {
    if(!empty($value)) {
        if(mb_strlen($value) < $min) {
            $errors[$key] = 'Veuillez entrer au moins ' . $min . ' caractères';
        } elseif(mb_strlen($value) > $max) {
            $errors[$key] = 'Veuillez entrer moins de ' . $max . ' caractères';
        }
    } else {
        $errors[$key] = 'Veuillez entrer du texte';
    }
    return $errors;
}
function validEmail($errors, $value, $key ){
    if(!empty($value)) {
        if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
            $errors[$key] = 'Veuillez renseigner un email valide';
        }
    } else {
        $errors[$key] = 'Veuillez renseigner un email';
    }
    return $errors;
}
function ValidPassword($errors, $value1,$key1, $min, $value2, $key2) {
    if(!empty($value1)) {
        if(mb_strlen($value1) < $min) {
            $errors[$key1] = 'Veuillez entrer au moins ' . $min . ' caractères';
        } elseif($value1 != $value2) {
            $errors[$key2] = 'Les mots de passe ne sont pas identiques';
        }
    } else {
        $errors[$key1] = 'Veuillez entrer du texte';
    }
    return $errors;
}

// function ValidConfirmPassword($value1,$value2) {
//     if(!empty($value1)) {
//                 if($value1 != $value2) {
//                     echo 'Les mots de passe ne sont pas identiques';
//                 }
//             }
// }

function validationId_user($errors,$value,$key)
{
    if(!empty($value)) {
        if (!filter_var($value, FILTER_VALIDATE_INT)) {
            $errors[$key] = 'Veuillez renseigner un nombre entier';
        } 
    } else {
        $errors[$key] = 'Veuillez renseigner un id_user';
    }
    return $errors;
}

function validationStatus($errors,$value,$key,$lesStatus)
{
    if(!empty($value)) {
        if(!in_array($value,$lesStatus)) {
            $errors[$key] = 'Erreur';
        }
    } else {
        $errors[$key] = 'Veuillez renseigner un statut';
    }
    return $errors;
}

function spanErrors($errors,$key){
    if(!empty($errors[$key])) {
        echo $errors[$key];
    }
}
function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}
// function isLoggedAdmin() {
//     if(isLogged()) {
//         if($_SESSION['user']['role'] === 'Admin') {
//             return true;
//         }
//     }
//     return false;
// }
function isLogged() {
    $allowedRoles = array('abonne', 'admin');
    if(!empty($_SESSION['user'])) {
        if(!empty($_SESSION['user']['id']) && is_numeric($_SESSION['user']['id'])) {
            if(!empty($_SESSION['user']['pseudo'])) {
                if(!empty($_SESSION['user']['email'])) {
                    if(!empty($_SESSION['user']['role'])  && in_array($_SESSION['user']['role'],$allowedRoles)) {
                        if(!empty($_SESSION['user']['ip'])) {
                            if($_SESSION['user']['ip'] === $_SERVER['REMOTE_ADDR']) {
                                return true;
                            }
                        }
                    }
                }
            }
        }
    }
    return false;
}
function isLoggedAdmin(){
    if(isLogged()) {
        if($_SESSION['user']['role'] === 'admin') {
            return true;
        }
    }
    return false;
}
function urlRemovelast($url) {
    $url = explode('/', $url);
    array_pop($url);
    return implode('/', $url);
}
function formatDate($value) {
    return date('d/m/Y H:i', strtotime($value));
}

function pagination($page,$num,$count) {
    echo '<ul class="pagination">';
        if($page > 1) {
            echo '<li><a href="index.php?page='. ($page - 1 ) . '">Précédent</a></li>';
        }
        if($page*$num < $count) {
            echo '<li><a href="index.php?page='. ($page + 1 ) . '">Suivant</a></li>';
        }
    echo '</ul>';
}

// function create_form() {
//     '<form class="wrap_article">

//     <label for="comment"><strong>Donnez votre avis :</strong></label>
//     <textarea class="comment_txt" name="comment" id="" cols="100" rows="5" value="">Écrivez votre commentaire ici...</textarea>

//     <input class="comment_btn" type="submit" name="submitted">

//     </form>';
// }
function validComment($errors,$value,$key) { 
    if(empty($value)) {
    $errors[$key] = 'Veuillez entrer un commentaire';
    }

}