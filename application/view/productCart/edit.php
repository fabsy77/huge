<head>
<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<div class="container">
    <h1><?= $this->product->name ?></h1>
    <div class="box">

        <!-- echo out the system feedback (error and success messages) -->
        <?php $this->renderFeedbackMessages(); ?>


        <?php if ($this->product) { ?>
            <div style= "display: flex;">
                <div>
                <img src="<?= Config::get('URL') . "/public/productImages/". $this->product->image?>" style="width:50%">

                </div>
            </div>
            <div style="margin: 20px auto auto 20px;">
                <b style="font-size: 22px;">Product Name: </b><span style="font-size:22px;"><?= $this->product->name ?></span> <br><br>
                <b style="font-size: 22px;">Price: </b><span style="font-size:22px;"> <?= $this->product->unit_price . " €"?> </span> <br><br>
                <span style="font-size:22px;"><?= $this->product->description ?> </span><br><br>

                <form method="post" action="<?php echo Config::get('URL');?>productCart/editSave">
                <input type="hidden" name="product_id" value="<?php echo $this->product->id; ?>" />
                <br>
                <label>Size</label><br>
                <select style="font-size: 1.7rem;" name="product_size_id">
                        <?php $selected = "";
                           foreach ($this->sizes as $size) {
                               $selected = $size->id == $this->product->size ? "selected" : "";
                            ?>
                                <option <?= $selected;?> value="<?= $size->id;?>">
                                    <?= $size->name; ?>
                                </option>
                        <?php } ?>
                </select>
                <br>
                <br>
                <label>Quantity</label><br><input type="number" name="product_quantity" value="<?php echo $this->product->quantity ?>" min="1" max="100" required/>
                <br>
                <br>
                <input type="submit" class="btn btn-outline-info" value='Save' autocomplete="off" />
                </form>

                <td>
                    
                </td>
                <br>
                <br>

            </div>
        <?php } ?>

    </div>
</div>


