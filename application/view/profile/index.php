<div class="container">
    <h1>ProfileController/index</h1>
    <div class="box">

        <!-- echo out the system feedback (error and success messages) -->
        <?php $this->renderFeedbackMessages(); ?>

        <h3>What happens here ?</h3>
        <div>
            This controller/action/view shows a list of all users in the system. You could use the underlying code to
            build things that use profile information of one or multiple/all users.
        </div>
        <div>
            <table class="overview-table" id="query_table">
                <thead>
                <tr>
                    <td>Id</td>
                    <td>Avatar</td>
                    <td>Username</td>
                    <td>User's email</td>
                    <td>Activated ?</td>
                    <td>Account Type</td> <!-- Der Tabellen Header wird gesetz -->
                    <td>Message</td>
                    <td>Link to user's profile</td>
                </tr>
                </thead>
                <?php foreach ($this->user as $user) { 
                    if (Session::get('user_id') == $user->user_id)                                    
                    {                                                         
                        continue;   
                    }
                    else  
                    {
                    ?>
                    <tr class="<?= ($user->user_active == 0 ? 'inactive' : 'active'); ?>">
                        <td><?= $user->user_id; ?></td>
                        <td class="avatar">
                            <?php if (isset($user->user_avatar_link)) { ?>
                                <img src="<?= $user->user_avatar_link; ?>" />
                            <?php } ?>
                        </td>
                        <td><?= $user->user_name; ?></td>
                        <td><?= $user->user_email; ?></td>
                        <td><?= ($user->user_active == 0 ? 'No' : 'Yes'); ?></td>
                        <td><?= UserModel::getAccountType($user->user_account_type);?></td> <!-- Aufruf der Funktion  -->
                        <td>
                            <a type="button" class="btn btn-primary" href="<?= Config::get('URL') . 'chat/showChat/' . $user->user_id; ?>">Chat</a>
                            <span class="badge rounded-pill badge-notification bg-danger"><?= MessageModel::unreadMessages($user->user_id)?></span>
                        </td>
                        <td>
                            <a href="<?= Config::get('URL') . 'profile/showProfile/' . $user->user_id; ?>">Profile</a>
                        </td>
                        
                    </tr>
                    <?php }?>
                <?php } ?>
            </table>
        </div>
    </div>
</div>

