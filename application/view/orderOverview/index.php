<!DOCTYPE html>
<html>
  <head>
  <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <style>
      table {
    border-collapse: collapse;
    width: 100%;
  }
  
  th, td {
    text-align: left;
    padding: 8px;
  }
      </style>
  </head>
  <body>


<div class="container" style="z-index: -2;">
    <h1>My Orders</h1>
    <div class="box">

        <!-- echo out the system feedback (error and success messages) -->
        <?php $this->renderFeedbackMessages(); ?>

        <table>
              <tr>
                <th>Ordernumber</th>
                <th>Bestelldatum</th>
                <th></th>
                <th></th>
              </tr>
        <?php foreach($this->orders as $order){
          $comOrderNumber = $order['order_number'] ."-". $order['order_date'];
          ?> 
              <tr>
                <td><?=str_pad((string)$comOrderNumber, 12 ,"0",STR_PAD_LEFT)?></td>
                <td><?=$order['order_date_only']; ?></td>
                <td><a type="button" class="btn btn-outline-info" href="<?= Config::get('URL') . 'orderOverview/orderOverview/' . $order['order_number']; ?>">Show Order</a></td>
              <?php if(Session::get('user_account_type') == 7) {?>
                <td><a type="button" class="btn-lg btn-outline-info" href="<?= Config::get('URL') . 'orderOverview/showChat/' . $order['order_number'] .'/'. $order['buyer_id'] ; ?>">Chat</a></td>
              <?php } 
              else
              {?>    
              <td><a type="button" class="btn-lg btn-outline-info" href="<?= Config::get('URL') . 'orderOverview/showChat/' . $order['order_number'] .'/1' ; ?>">Chat</a></td>
              <?php } ?>
              </tr>
          <?php } ?> 

          </table>
    </div>
</div>
<?php

?>