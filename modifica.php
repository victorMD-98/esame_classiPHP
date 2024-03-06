<?php
session_start();
    require_once "db.php";
    require_once "config.php";
    require_once "registrazione.php";
    use db\DB_Pdo;
    use Registrazione\User;
    $PDOConn = DB_Pdo::getInstance($config);
    $conn = $PDOConn->getConnection();
    $user = new User($conn);
    $res = $user->getUserById($_REQUEST['id']);
    //print_r($res[0]);
?>

<?php require_once "header.php" ?>
<?php require_once "navbar.php" ?>

        <div class="container border border-black bg-dark text-white my-5">
            <h2>Registrazione</h2>
            <form class="m-3 " method="POST" action="logica.php?action=modifica&id=<?= $_REQUEST['id'] ?>" enctype="multipart/form-data" >
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Nome</label>
                    <input type="text" value="<?php echo $res[0]['name'] ?>" class="form-control " name="name" >
                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Cognome</label>
                    <input type="text" value="<?php echo $res[0]['surname'] ?>" class="form-control" name="surname" >
                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Città</label>
                    <input type="text" value="<?php echo $res[0]['city'] ?>" class="form-control" name="city" >
                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Tel</label>
                    <input type="tel" class="form-control" value="<?php echo $res[0]['tel'] ?>" name="tel">
                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Img</label>
                    <input type="file" class="form-control" value="<?php echo $res[0]['image'] ?>" name="file">
                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Email</label>
                    <input type="email" class="form-control" value="<?php echo $res[0]['email'] ?>" name="email">
                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Password</label>
                    <input type="password" value="<?php echo $res[0]['password'] ?>" class="form-control" name="password" id="exampleInputPassword1">
                </div>
                <div class="mb-3 form-check">
                    <input type="checkbox" class="form-check-input" id="exampleCheck1">
                    <label class="form-check-label" for="exampleCheck1">Check me out</label>
                </div>
                <button type="submit" class="btn btn-primary">Modifica</button>
            </form>
        </div>

<?php require_once "footer.php" ?>