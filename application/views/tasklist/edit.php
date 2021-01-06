<div class="row">
    <div class="col-md-6 offset-3">
        <div><strong>Имя пользователя:</strong> <span><?= $data["task"]->user_name; ?></span></div>
        <div><strong>Email пользователья:</strong> <span><?= $data["task"]->user_email; ?></span></div>
        <form action="" method="post" class="mt-3 needs-validation <?= $data["was_validated"]; ?>" novalidate>
            <div class="form-group">
                <label for="task">Текст задачи: <span class="text-danger">*</span> </label>
                <textarea class="form-control" id="task" rows="6" name="task" required><?= $data["task"]->task; ?></textarea>
            </div>
            <button type="submit" class="btn btn-primary" name="submit_task">Сохранить</button>
            <a href="<?= URLROOT; ?>/tasklist" class="btn btn-secondary">Отменить</a>
        </form>
    </div>
</div>
