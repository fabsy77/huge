<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <style>
        .discussion {
	max-width: 600px !important;
	margin: 0 auto !important;
	
	display: flex !important;
	flex-flow: column wrap !important;
}

.discussion > .bubble {
	border-radius: 1em !important;
	padding: 0.25em 0.75em !important;
	margin: 0.0625em !important;
	max-width: 50% !important;
}

.discussion > .bubble.sender {
	align-self: flex-start !important;
	background-color: cornflowerblue !important;
	color: #fff !important;
}
.discussion > .bubble.recipient {
	align-self: flex-end !important;
	background-color: #efefef !important;
}

.discussion > .bubble.sender.first { border-bottom-left-radius: 0.1em !important; }
.discussion > .bubble.sender.last { border-top-left-radius: 0.1em !important; }
.discussion > .bubble.sender.middle {
	border-bottom-left-radius: 0.1em !important;
 	border-top-left-radius: 0.1em !important;
}

.discussion > .bubble.recipient.first { border-bottom-right-radius: 0.1em !important; }
.discussion > .bubble.recipient.last { border-top-right-radius: 0.1em !important; }
.discussion > .bubble.recipient.middle {
	border-bottom-right-radius: 0.1em !important;
	border-top-right-radius: 0.1em !important;
}
    </style>
    </head>
  </body>
</html>


<div class="container">
    <h1>chat/index</h1>
    <div class="box">

        <!-- echo out the system feedback (error and success messages) -->
        <?php $this->renderFeedbackMessages(); ?>

        <div>
        </div>
        <div>
            <table class="overview-table" id="query_table">
                <thead>
                <tr>
                    <td>Ordernumber</td>
                    <td>Order Date</td>
                    <td>Message</td>
                </tr>
                </thead>
                <?php foreach ($this->orders as $order) {
                    $comOrderNumber = $order['order_number'] ."-". $order['order_date'];
                    ?>
                    <tr>
                        <td><?=str_pad((string)$comOrderNumber, 12 ,"0",STR_PAD_LEFT);?></td>
                        <td><?=$order['order_date_only']; ?></td>
                        <td>
                            <a href="<?= Config::get('URL') . 'chat/showChat/' . $order['order_number'];?>">Chat</a>
                        </td>    
                    </tr>
                <?php } ?>
            </table>
        </div>
    </div>
</div>
      
      