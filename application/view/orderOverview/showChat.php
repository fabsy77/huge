<head>
<style>
.discussion {
	max-width: 600px;
	margin: 0 auto;
	
	display: flex;
	flex-flow: column wrap;
}

.discussion > .bubble {
	border-radius: 1em;
	padding: 0.25em 0.75em;
	margin: 0.0625em;
	max-width: 50%;
}

.discussion > .bubble.sender {
	align-self: flex-start;
	background-color: cornflowerblue;
	color: #fff;
}
.discussion > .bubble.recipient {
	align-self: flex-end;
	background-color: #EEC591;
}

.discussion > .bubble.sender.first { border-bottom-left-radius: 0.1em; }
.discussion > .bubble.sender.last { border-top-left-radius: 0.1em; }
.discussion > .bubble.sender.middle {
	border-bottom-left-radius: 0.1em;
 	border-top-left-radius: 0.1em;
}

.discussion > .bubble.recipient.first { border-bottom-right-radius: 0.1em; }
.discussion > .bubble.recipient.last { border-top-right-radius: 0.1em; }
.discussion > .bubble.recipient.middle {
	border-bottom-right-radius: 0.1em;
	border-top-right-radius: 0.1em;
}
</style>
<script>
    $(document).ready(function(){
        window.scrollTo(0,document.body.scrollHeight);
    })
</script>
</head>
<div class="container">
    <?php $orderNumber = $this->messages[0]["order_number"];?>
    <h1 style="text-align: center;">Chat with <?=$this->to_user->user_name?> for Order: <?=$orderNumber?></h3>
    <div class="box">

        <!-- echo out the system feedback (error and success messages) -->
        <?php $this->renderFeedbackMessages(); ?>
        </br>
        <?php if ($this->messages) { ?>
            <section class="discussion">
                <?php 
                $lastId = 0; 
                
                $toUserId = $this->to_user->user_id;
                $last_sender = null;
                ?>
                <?php foreach($this->messages as $msg) {
                    $from_user_id = $msg['from_user_id'];
                    $to_user_id = $msg['to_user_id'];
                    $send_at = $msg['message_sent_at'];
                    $message = $msg['message'];
                    if($from_user_id == $this->to_user->user_id){
                        $class = ($from_user_id == $last_sender) ? 'last' : 'first';
                        $last_sender = $from_user_id;
                        ?>
                        <div class="bubble sender <?=$class ?>">
                    <?= $message; ?>
                    <p class="small me-3 mb-3 rounded-3 text-muted d-flex justify-content-end"><?= DateTime::createFromFormat("Y-m-d H:i:s",$send_at)->format("H:i");?></p>
                </div>  
        <?php }else{
            $class = ($from_user_id == $last_sender) ? 'last' : 'first';
            $last_sender = $from_user_id;
            ?>
            <div class="bubble recipient <?=$class ?>">
            <?= $message; ?>
            <p class="small me-3 mb-3 rounded-3 text-muted d-flex justify-content-end"><?= DateTime::createFromFormat("Y-m-d H:i:s",$send_at)->format("H:i");?></p>
            </div>  
                <?php  } } }?>
                <p>
                <form method="post" action="<?php echo Config::get('URL');?>orderOverview/sendMessage">
                    <input type="hidden" name="to_user_id" value="<?= $toUserId?>"/>
                    <input type="hidden" name="order_number" value="<?=$orderNumber?>"/>
                    <div class="form-group">
                                <div class="form-group">
                                    <label for="formGroupExampleInput">Message</label>
                                    <input type="text" class="form-control" id="formGroupExampleInput" name="message">
                                </div>
                            <button type="submit" class="btn btn-primary" autocomplete="off">Send</button>
                    </div>
                </form>
                </p>
            </div>
            </section>
    </div>
</div>
