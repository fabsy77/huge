<head>
<link rel="stylesheet" href="<?php echo Config::get('URL'); ?>public/css/style.css" />
</head>
<div class="container">
    <?php ?>
    <h1></h1>
    <div class="box">
        <?php $this->renderFeedbackMessages(); ?>
        <section class="discussion">
                        <?php 
                        $last_sender = null;
                        foreach ($this->messages as $message) {
                            $msg = $message['message'];
                            $from_user_id = $message['from_user_id'];
                            $to_user_id = $message['to_user_id'];
                            $send_at = $message['message_sent_at'];
                            if($from_user_id == $this->to_user->user_id){
                                $class = ($from_user_id == $last_sender) ? 'last' : 'first';
                                $last_sender = $from_user_id;
                                ?>
                                <div class="bubble sender <?=$class ?>">
                            <?= $msg; ?>
                            <p class="small me-3 mb-3 rounded-3 text-muted d-flex justify-content-end"><?= DateTime::createFromFormat("Y-m-d H:i:s",$send_at)->format("H:i");?></p>
                        </div>  
                <?php }else{
                    $class = ($from_user_id == $last_sender) ? 'last' : 'first';
                    $last_sender = $from_user_id;
                    ?>
                    <div class="bubble recipient <?=$class ?>">
                    <?= $msg; ?>
                    <p class="small me-3 mb-3 rounded-3 text-muted d-flex justify-content-end"><?= DateTime::createFromFormat("Y-m-d H:i:s",$send_at)->format("H:i");?></p>
                    </div>  
              <?php   } 
            } ?>  
                <div>
                    <form action="<?= config::get('URL');?> chat/sendMessage" method="post">
                        <td>
                            <input type="hidden" name="to_user_id" value="<?= $this->to_user->user_id;?>" />
                            <div class="form-group">
                                <div class="form-group">
                                    <label for="formGroupExampleInput">Message</label>
                                    <input type="text" class="form-control" id="formGroupExampleInput" name="message">
                                </div>
                                <button type="submit" class="btn btn-primary" >Senden</button>
                            </div>
                        </td>
                    </form>
                </div>      
        </section>
    </div>
</div>
