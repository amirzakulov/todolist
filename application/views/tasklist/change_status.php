<div class="row">
    <div class="col-md-6 offset-3">
        <div><strong>Имя пользователя:</strong> <span><?= $data["task"]->user_name; ?></span></div>
        <div><strong>Email пользователья:</strong> <span><?= $data["task"]->user_email; ?></span></div>
        <form action="" method="post" class="mt-5">
            <div class="mb-2 font-weight-bold">Статус задачи:</div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="1" id="status" name="status" <?= $data['task']->status ? "checked='checked'":""; ?>>
                <label class="form-check-label" for="status">
                    Выполнено
                </label>
            </div>
            <div class="mt-5">
                <button type="submit" class="btn btn-primary" name="submit_task">Сохранить</button>
                <a href="<?= URLROOT; ?>/tasklist" class="btn btn-secondary">Отменить</a>
            </div>
        </form>
    </div>
</div>
