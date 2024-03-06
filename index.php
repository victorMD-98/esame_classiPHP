<?php
    require_once "db.php";
    require_once "config.php";
    require_once "registrazione.php";
  session_start();
  if(!isset($_SESSION['userLogin']) && isset($_COOKIE["useremail"]) && isset($_COOKIE["userpassword"])) {
    header('Location: http://localhost/esame_classiPHP/logica.php?email='.$_COOKIE["useremail"].'&password='.$_COOKIE["userpassword"]);
  } else if(!isset($_SESSION['userLogin'])) {
    header('Location:http://localhost/esame_classiPHP/login.php');
  } 
  use db\DB_Pdo;
  use Registrazione\User;
  $PDOConn = DB_Pdo::getInstance($config);
  $conn = $PDOConn->getConnection();
    $user = new User($conn);
    $res = $user->getAllUsers();
    //var_dump($res); 
?>

<?php require_once "header.php" ?>
<?php require_once "navbar.php" ?>
<main>
<div class="container">
            <div class="my-3">
                <table class="table table-dark table-striped table-hover">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Image</th>
                            <th scope="col">Firstname</th>
                            <th scope="col">Lastname</th>
                            <th scope="col">City</th>
                            <th scope="col">Phone</th>
                            <th scope="col">Email</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        if($res){
                        foreach ($res as $key => $contact) { 
                        ?>
                            <tr>
                                <th scope="row"><?= $key+1 ?></th>
                                <td><img src=<?= $contact["image"] ?> width="50" ></td>
                                <td><?= $contact["name"]?></td>
                                <td><?= $contact["surname"] ?></td>
                                <td><?= $contact["city"] ?></td>
                                <td><?= $contact["tel"] ?></td>
                                <td><?= $contact["email"] ?></td>
                                <td>
                                <a class="btn btn-danger" href="logica.php?action=delete&id=<?=$contact["id"]?> " role="button">Elimina</a>
                                <a class="btn btn-warning" href="modifica.php?&id=<?=$contact["id"]?>" role="button">Update</a>
                                </td>
                            </tr>
                        <?php } }?>
                    </tbody>
                </table>
            </div>
        </div>
    </main>
</main>
<?php require_once "footer.php" ?>