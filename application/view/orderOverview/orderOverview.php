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
    font-size: 1.5em;
  }
  p{
    font-size: 2em;
  }
      </style>
  </head>
  <body>


<div class="container" style="z-index: -2;">
    <h1> </h1>
    <div class="box">

        <!-- echo out the system feedback (error and success messages) -->
        <?php $this->renderFeedbackMessages(); ?>
  	    <?php $fullPrice = 0;?>
        <table>
              <tr>
                <th></th>
                <th>Product Name</th>
                <th>Size</th>
                <th>Quantity</th>
                <th>Price per Item</th>
              </tr>
              <?php foreach($this->order as $product) {?>
              <tr>
              <td><div>
                <img class="card-img-top rounded" src="<?= Config::get('URL') . "/public/productImages/". $product->image ?>" style="width:100px;">
                        </div></td>
                <td><?=$product->name;?></td>
                <td><?=$product->size_name;?></td>
                <td><?=$product->quantity;?></td>
                <td><?=$product->price;?> €</td>
              </tr>
              <?php
                $fullPrice += $product->price;  }
              ?>
              <tr>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th><b>Full Price</b></th>
              </tr>
              <tr>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th><?=$fullPrice?> €</th>
              </tr>
          </table>
            <div class="box" style="text-align:center">
              </br><h3><b>Delivery Address</b></h3>
                <?php foreach($this->orderAddress as $address) {
                  $zip = $address['zip'];
                  $city = $address['city'];
                  $street = $address['street'];
                  $house_number = $address['house_number'];
                  $paymentType = $address['paymentType'];
                  ?>
                  <p><b>ZIP: </b><?=$zip; ?></p> 
                  <p><b>City: </b><?=$city; ?></p> 
                  <p><b>Street: </b><?=$street; ?></p> 
                  <p><b>House Number: </b><?=$house_number; ?></p>
                  <p><b>Payment Type: </b><?=$paymentType; ?></p>
                  <?php }?>
            </div>
    </div>
</div>