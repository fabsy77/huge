<!DOCTYPE html>
<html>
  <head>
  <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    
  </head>
  <body>


<div class="container" style="z-index: -2;">
    <h1 style="text-align:center;"><b>Products</b></h1>
    <div class="box">
    <?php 
        foreach($this->category as $category){
     
         ?>
      <a type="button" class="btn btn-outline-info" href="<?= Config::get('URL') . 'product/showProductByCategory/' . $category->id; ?>"><?=$category->name; ?></a>
      <?php } ?>
      <a type="button" class="btn btn-outline-info" href="<?= Config::get('URL') . 'product/index/' ?>">All</a>
    </div>
    <form class="form-inline my-2 my-lg-0" method="GET" action="<?php echo Config::get('URL');?>product/search">
      <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" name="searchTerm">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
    </form>
    <div class="box">
    

        <!-- echo out the system feedback (error and success messages) -->
        <?php $this->renderFeedbackMessages(); ?>

        <?php 
    
       
        // create a row for each product
        if (count($this->products) > 0) {
        foreach($this->products as $product){
     
         ?>

          <div class="col-sm-3">
              <div class="card" style="width: 90%; height: auto;">
                        </br>
                        <div class="text-center" style=" border: 5px solid #555; height:150px">
            <div class="text-center">
            <img class="card-img-top rounded" src="<?= Config::get('URL') . "/public/productImages/". $product->image ?>" style="width:90%; height:auto">
                    </div>
                    </div>
                <div class="card-body">
                  <h5 class="card-title">Produkt: <?= $product->name; ?></h5>
                  <p class="card-text">Kategorie: <?= $product->catName;?></p>
                  <p class="card-text">Preis: <?= $product->price;?> €</p>
                </div>
                 <div class="card-footer">
                  <a type="button" class="btn btn-outline-info" href="<?= Config::get('URL') . 'product/showProduct/' . $product->id; ?>">Product Info</a>
                </div>
               
              </div>
          </div>
          <?php } ?>
         
          <?php } 
          else
          { ?>
            
          <?php } ?>
    </div>
</div>
<?php

?>