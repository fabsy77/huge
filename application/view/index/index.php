<!DOCTYPE html>
<html>
  <head>
  <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    
  </head>
  <body>

  <div class="container">

  <div class="container" style="text-align:center;">
<h1><b>Welcome to DeRoupas - your exclusive fashion retailer!</b></h1>
       </br>
    <h2>
        At DeRoupas, we understand that fashion is an expression of personality that knows no boundaries. We take pride in offering you a curated selection of high-quality unisex clothing that will enhance your individual style and make you shine.
    </h2>
    </br>
    <h2>
      Our range includes a diverse array of clothing for women, men, and anyone who embraces unisex fashion. From timeless classics to the latest trends, DeRoupas has everything you need to elevate your wardrobe and express your personal style.   
    </h2>
    </br>
    <h2>
      Our team of fashion experts travels the world to discover and handpick the best designers and brands exclusively for you. Each piece undergoes meticulous scrutiny to ensure it meets our high standards of quality. At DeRoupas, we value materials, craftsmanship, and fit, so you can feel comfortable and confident in our products.
    </h2>
    </br>
    <h2>
      Our aim is to provide you with a premier shopping experience. Our user-friendly online store allows you to conveniently shop from the comfort of your home. Browse our selection and choose the clothing items that perfectly complement your personal style.
    </h2>
    </br>
    <h2>
      Step into the world of DeRoupas and explore fashion that knows no boundaries. Be inspired by our collection and indulge in the unique shopping experience we offer. We look forward to welcoming you to DeRoupas!
    </h2>
</div>


<div class="container">
    <h1 style="text-align:center;"><b>Random Products</b></h1>
    <div class="box">
        <div>
        <!-- echo out the system feedback (error and success messages) -->
        <?php $this->renderFeedbackMessages(); ?>
        </div>
       <?php foreach($this->products as $product){    ?>
      <div class="col-sm-3">
          <div class="card" style="width: 90%; height: 300px;">
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
    </div>
</div>
<div class="container">
<h1 style="text-align:center;"><b>Most Sold Products</b></h1>
    <div class="box">
       <?php foreach($this->mostSold as $soldProduct){    ?>
      <div class="col-sm-3">
          <div class="card" style="width: 90%; height: 300px;">
                    </br>
          <div class="text-center" style=" border: 5px solid #555; height:150px">
            <div class="text-center">
            <img class="card-img-top rounded" src="<?= Config::get('URL') . "/public/productImages/". $soldProduct->image ?>" style="width:90%; height:auto">
                    </div>
                    </div>
            <div class="card-body">
              <h5 class="card-title">Produkt: <?= $soldProduct->name; ?></h5>
              <p class="card-text">Kategorie: <?= $soldProduct->catName;?></p>
              <p class="card-text">Preis: <?= $soldProduct->price;?> €</p>
            </div>
             <div class="card-footer">
              <a type="button" class="btn btn-outline-info" href="<?= Config::get('URL') . 'product/showProduct/' . $soldProduct->id; ?>">Product Info</a>
            </div>
          </div>
      </div>
      <?php } ?>
    </div>
</div>
  </div>