<div class="row">
    <div class="col-md-6 offset-3">
        <h3 class="mb-4">Заполните следующий поля</h3>
        <form action="" method="post" class="needs-validation <?= $data["was_validated"]; ?>" novalidate>
            <input type="hidden" name="status" value="0">
            <input type="hidden" name="updated" value="0">
            <div class="form-group">
                <label for="user_name">Имя пользователя: <span class="text-danger">*</span> </label>
                <input type="text" class="form-control" id="user_name" name="user_name" value="<?= isset($_POST["user_name"]) ? $_POST["user_name"]:""; ?>" required>
                <div class="invalid-feedback d-block">
                    <?= isset($data["validation_errors"]["user_name"]) ? $data["validation_errors"]["user_name"]:""; ?>
                </div>
            </div>
            <div class="form-group">
                <label for="user_email">Email пользователья: <span class="text-danger">*</span> </label>
                <input type="email" class="form-control" id="user_email" name="user_email" value="<?= isset($_POST["user_email"]) ? $_POST["user_email"]:""; ?>" required>
                <div class="invalid-feedback d-block">
                    <?= isset($data["validation_errors"]["user_email"]) ? $data["validation_errors"]["user_email"]:""; ?>
                </div>
            </div>
            <div class="form-group">
                <label for="task">Текст задачи: <span class="text-danger">*</span> </label>
                <textarea class="form-control" id="task" rows="3" name="task" required><?= isset($_POST["task"]) ? $_POST["task"]:""; ?></textarea>
                <div class="invalid-feedback d-block">
                    <?= isset($data["validation_errors"]["task"]) ? $data["validation_errors"]["task"]:""; ?>
                </div>
            </div>
            
            <button type="submit" class="btn btn-primary" name="submit_task">Сохранить</button>
            <a href="<?= URLROOT; ?>/tasklist" class="btn btn-secondary">Отменить</a>
        </form>
    </div>
</div>
