<?php require_once "header.php" ?>
<?php require_once "navbar.php" ?>

        <div class="container border border-black bg-dark text-white my-5">
            <h2>Registrazione</h2>
            <form class="m-3 " method="POST" action="logica.php?action=register" enctype="multipart/form-data" >
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Nome</label>
                    <input type="text" class="form-control " name="name" >
                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Cognome</label>
                    <input type="text" class="form-control" name="surname" >
                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Tel</label>
                    <input type="tel" class="form-control" name="tel">
                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Città</label>
                    <input type="text" class="form-control" name="city" >
                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Img</label>
                    <input type="file" class="form-control" name="file">
                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Email</label>
                    <input type="email" class="form-control" name="email">
                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Password</label>
                    <input type="password" class="form-control" name="password" id="exampleInputPassword1">
                </div>
                <div class="mb-3 form-check">
                    <input type="checkbox" class="form-check-input" id="exampleCheck1">
                    <label class="form-check-label" for="exampleCheck1">Check me out</label>
                </div>
                <button type="submit" class="btn btn-primary">Register</button>
            </form>
        </div>

<?php require_once "footer.php" ?>