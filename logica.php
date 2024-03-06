<?php
require_once "db.php";
require_once "config.php";
require_once "registrazione.php";
require_once "class_user.php";
session_start();

$target_dir="images/";
$avatar = $target_dir."avatar.png";
if(!empty($_FILES['file'])) {
    if($_FILES['file']["type"] === 'image/png' || $_FILES['file']["type"] === 'image/jpg') {
        if($_FILES['file']["size"] < 400000) {
            if(is_uploaded_file($_FILES['file']["tmp_name"]) && $_FILES['file']["error"] === UPLOAD_ERR_OK) {
                if(move_uploaded_file($_FILES['file']["tmp_name"], $target_dir.$_REQUEST['name'].'-'.$_REQUEST['surname'])) {
                    echo 'Caricamento avvenuto con successo';
                    $avatar=''.$target_dir.$_REQUEST['name'].'-'.$_REQUEST['surname'];
                } else {
                    echo 'Errore!!!';
                }
            }
        } else {
            echo 'FileSize troppo grande';
        }
    } else {
        echo 'FileType non supportato';
    }
};
use db\DB_Pdo;
use Utenti\Utente;
use Registrazione\User;
$PDOConn = DB_Pdo::getInstance($config);
$conn = $PDOConn->getConnection();
//var_dump($conn);

//print_r($_REQUEST);
if(isset($_REQUEST["action"])&&$_REQUEST["action"]==="register"){
    $regexphone = '/(?:([+]\d{1,4})[-.\s]?)?(?:[(](\d{1,3})[)][-.\s]?)?(\d{1,4})[-.\s]?(\d{1,4})[-.\s]?(\d{1,9})/';
    preg_match_all($regexphone,htmlspecialchars($_REQUEST['tel']), $matches, PREG_SET_ORDER, 0);
    $regexmail = '/^((?!\.)[\w\-_.]*[^.])(@\w+)(\.\w+(\.\w+)?[^.\W])$/m';
    preg_match_all($regexmail,trim(htmlspecialchars($_REQUEST['email'])) , $matchesEmail, PREG_SET_ORDER, 0);
    $regexPAss = '/^((?=\S*?[A-Z])(?=\S*?[a-z])(?=\S*?[0-9]).{6,})\S$/';
    preg_match($regexPAss, trim(htmlspecialchars($_REQUEST['password'])), $matchesPass, PREG_OFFSET_CAPTURE, 0);


    $name=strlen(trim(htmlspecialchars($_REQUEST['name']))) > 2 ? trim(htmlspecialchars($_REQUEST['name'])) : exit();
    $surname=strlen(trim(htmlspecialchars($_REQUEST['surname']))) > 2 ? trim(htmlspecialchars($_REQUEST['surname'])) : exit();
    $city=strlen(trim(htmlspecialchars($_REQUEST['city']))) > 2 ? trim(htmlspecialchars($_REQUEST['city'])) : exit();

    $tel=$matches ? htmlspecialchars($_REQUEST['tel']) : exit() ;

    $email=$regexmail ? trim(htmlspecialchars($_REQUEST['email'])) : exit();

    $pass=$matchesPass ? trim(htmlspecialchars($_REQUEST['password'])) : exit();

    $password= password_hash($pass, PASSWORD_DEFAULT);

    $u = new Utente($name,$surname,$tel,$city,$email,$password, $GLOBALS['avatar']);

    $user = new User($conn);
    $user->saveUser($u);
    exit(header('Location:http://localhost/esame_classiPHP/index.php'));
} else if(isset($_REQUEST["action"])&&$_REQUEST["action"]==="login"){
    $regexemail = '/^((?!\.)[\w\-_.]*[^.])(@\w+)(\.\w+(\.\w+)?[^.\W])$/m';
    preg_match_all($regexemail, htmlspecialchars($_REQUEST['email']), $matchesEmail, PREG_SET_ORDER, 0);
    $email = $matchesEmail ? htmlspecialchars($_REQUEST['email']) : exit();
    $regexPass = '/^((?=\S*?[A-Z])(?=\S*?[a-z])(?=\S*?[0-9]).{6,})\S$/';
    preg_match_all($regexPass, htmlspecialchars($_REQUEST['password']), $matchesPass, PREG_SET_ORDER, 0);
    $pass = $matchesPass ? htmlspecialchars($_REQUEST['password']) : exit();
    $user = new User($conn);
    $res = $user->getUserByEmail($email);
    // print_r($res[0]['password']);
    // print_r($_REQUEST);
    
        if(password_verify($pass, $res[0]['password'])){ 
            $_SESSION['userLogin'] = $res[0];
            session_write_close();
            if(isset($_REQUEST['check'])) {
                setcookie("useremail", $res[0]['email'], time()+20*24*60*60);
                setcookie("userpassword", $res[0]['password'], time()+20*24*60*60);
            }
            header('Location:http://localhost/esame_classiPHP/index.php');
            exit;
        } else {
            $_SESSION['error'] = 'Password errata!!!';
            header('Location:http://localhost/esame_classiPHP/login.php');
        }
    
} else if(isset($_REQUEST["action"])&&$_REQUEST["action"]==="modifica"){
    $regexphone = '/(?:([+]\d{1,4})[-.\s]?)?(?:[(](\d{1,3})[)][-.\s]?)?(\d{1,4})[-.\s]?(\d{1,4})[-.\s]?(\d{1,9})/';
    preg_match_all($regexphone,htmlspecialchars($_REQUEST['tel']), $matches, PREG_SET_ORDER, 0);
    $regexmail = '/^((?!\.)[\w\-_.]*[^.])(@\w+)(\.\w+(\.\w+)?[^.\W])$/m';
    preg_match_all($regexmail,trim(htmlspecialchars($_REQUEST['email'])) , $matchesEmail, PREG_SET_ORDER, 0);
    $regexPAss = '/^((?=\S*?[A-Z])(?=\S*?[a-z])(?=\S*?[0-9]).{6,})\S$/';
    preg_match($regexPAss, trim(htmlspecialchars($_REQUEST['password'])), $matchesPass, PREG_OFFSET_CAPTURE, 0);

    $name=strlen(trim(htmlspecialchars($_REQUEST['name']))) > 2 ? trim(htmlspecialchars($_REQUEST['name'])) : exit();
    $surname=strlen(trim(htmlspecialchars($_REQUEST['surname']))) > 2 ? trim(htmlspecialchars($_REQUEST['surname'])) : exit();
    $city=strlen(trim(htmlspecialchars($_REQUEST['city']))) > 2 ? trim(htmlspecialchars($_REQUEST['city'])) : exit();
    $tel=$matches ? htmlspecialchars($_REQUEST['tel']) : exit() ;
    $email=$regexmail ? trim(htmlspecialchars($_REQUEST['email'])) : exit();
    $pass=$matchesPass ? trim(htmlspecialchars($_REQUEST['password'])) : exit();
    $password= password_hash($pass, PASSWORD_DEFAULT);
    $u = new Utente($name,$surname,$tel,$city,$email,$password, $GLOBALS['avatar']);

    $user = new User($conn);
    $user->updateUser($u,$_REQUEST['id']);
    exit(header('Location:http://localhost/esame_classiPHP/index.php'));
}else if(isset($_REQUEST["action"])&&$_REQUEST["action"]==="delete"){
    $user = new User($conn);
    $user->deleteUser($_REQUEST['id']);
    header('Location:http://localhost/esame_classiPHP/index.php');
            exit;
}

header('Location:http://localhost/esame_classiPHP/index.php');

