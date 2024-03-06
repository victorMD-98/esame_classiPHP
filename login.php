<?php
  session_start();
?>
<?php require_once "header.php" ?>
<?php require_once "navbar.php" ?>
<div class="">
    <div class="container position-absolute top-50 start-50 translate-middle bg-dark text-white">
        <form method="post" class="text-center" action="logica.php?action=login" >
        <div class="mb-3 w-50 m-auto">
            <label for="exampleInputEmail1" class="form-label">Email</label>
            <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="email">
        </div>
        <div class="mb-3 w-50 m-auto">
            <label for="exampleInputPassword1" class="form-label">Password</label>
            <input type="password" class="form-control" id="exampleInputPassword1" name="password">
        </div>
        <div class="mb-3 form-check w-50 m-auto">
            <input type="checkbox" name="check" class="form-check-input" id="exampleCheck1">
            <label class="form-check-label float-start" for="exampleCheck1">ricordami</label>
        </div>
        <button type="submit" class="btn btn-secondary">Accedi</button>
        <?php
          if(isset($_SESSION['error'])) {
            echo '<div class="alert alert-danger my-3" role="alert">'.$_SESSION['error'].'</div>';
          }
        ?>
        </form>
    </div>
</div>
<?php require_once "footer.php" ?>