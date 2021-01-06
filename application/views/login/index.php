<div class="mt-5">
    <form action="" method="post" class="form-signin text-center needs-validation <?= $data["was_validated"]; ?>" novalidate>
        <h1 class="h5 mb-3 font-weight-normal">Кабинет администратора</h1>
        <label for="username" class="sr-only">Имя пользователя</label>
        <input type="text" id="username" name="username" class="form-control" placeholder="Имя пользователя" required autofocus>
        <label for="password" class="sr-only">Password</label>
        <input type="password" id="password" name="password" class="form-control" placeholder="Пароль" required>

        <div class="mt-3 mb-3">
            <?php if(isset($data["validation_errors"])){
                foreach ($data["validation_errors"] as $error) {
                    echo "<small class='text-danger'>".$error."</small><br>";
                }
            } ?>
        </div>
        <button class="btn btn-lg btn-primary btn-block" type="submit" name="login">Вход</button>
    </form>
</div>