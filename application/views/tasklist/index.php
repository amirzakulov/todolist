<!-- Begin page content -->
<div>
    <?php if(isset($data["alert_message"])) { ?>
        <div class="alert alert-success" role="alert">
            <?= $data["alert_message"]; ?>
        </div>
    <?php } ?>
    <div class="buttons text-right mb-2">
        <a class="btn btn-danger" href="<?= URLROOT; ?>/tasklist/add" title="Добавить задачу" role="button">Создать новый</a>
        <?php if(!isLoggedIn()) { ?>
            <a class="btn btn-info" href="<?= URLROOT; ?>/login" role="button">Авторизаця</a>
        <?php }?>
    </div>
    <table class="table todo_table">
        <thead class="thead-light">
        <tr>
            <?php foreach ($data["cols"] as $col_name => $col) {?>
                <th width="<?= $col["width"] ?>">
                    <?php if($col["sortable"]) {?><a href="<?= $col["href"] ?>" class="sort_column <?= $col["class"] ?>"><?= $col["name"] ?></a><?php } else { echo $col["name"];} ?></th>
            <?php } ?>
            <?php if(isLoggedIn()) { ?>
                <th width="15%"></th>
            <?php } ?>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($data["tasks"] as $user) {?>
            <tr>
                <td><?= $user->user_name ?></td>
                <td><?= $user->user_email; ?></td>
                <td><?= $user->task; ?></td>
                <td>
                    <?= $user->status ? '<div><span class="badge badge-danger pb-1">выполнено</span></div>':''; ?>
                    <?php if(isLoggedIn()) { ?>
                        <?= $user->updated ? '<div><span class="badge badge-danger pb-1">отредактировано администратором</span></div>':''; ?>
                    <?php } ?>
                </td>
                <?php if(isLoggedIn()) { ?>
                    <td>
                        <a href="<?= URLROOT; ?>/tasklist/edit_task/<?= $user->id; ?>" class="d-block mb-2">Редактировать задачу</a>
                        <a href="<?= URLROOT; ?>/tasklist/change_status/<?= $user->id; ?>">Изменить статус</a>
                    </td>
                <?php } ?>
            </tr>
        <?php } ?>
        </tbody>
    </table>
    <nav>
        <?= $data["pagination"]; ?>
    </nav>
</div>
