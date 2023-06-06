<?php
    $allAccTypes = UserModel::getAllAccountTypes();
?>
<td>
    <select name="account_type" id="account_type">
        <?php foreach ($allAccTypes as $accType) :
            $account_type_id = $accType['account_type_id'];
            $account_type_name = $accType['account_type_name'];
            ?>
            <?php if ($account_type_id === $user->user_account_type) : ?>
                <option value="<?= $account_type_id ?>" selected="selected">
                    <?= $account_type_name; ?>
                </option>
            <?php else : ?>
                <option value="<?= $account_type_id ?>">
                    <?= $account_type_name; ?>
                </option>
            <?php endif; ?>
        <?php endforeach; ?>
    </select>
</td>