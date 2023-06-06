<?php
    $order = Session::get('purchase_order');

?>

<div class="container">
    
    <h1>Shopping cart</h1>

    <h3>Client name:<?php echo $order[0]['username']; ?></h3>
    <div class="box">

        <!-- echo out the system feedback (error and success messages) -->
        <?php $this->renderFeedbackMessages(); ?>

        <!--         <h3>What happens here ?</h3>
        <div>
            This controller/action/view shows a list of all products in the system. You could use the underlying code to
            build things that use profile information of one or multiple/all products.
        </div>

        <p>
            This is just a simple CRUD implementation. Creating, reading, updating and deleting things.
        </p> -->
        <p>

        </p>
        <div>
            <table class="overview-table">
                <thead>
                    <tr>
                        <td>Photo</td>
                        <td>Name</td>
                        <td>Description</td>
                        <td>Size</td>
                        <td>Unit Price</td>
                        <td>Quantity</td>
                        <td>Total Price</td>
                        <td>EDIT</td>
                        <td>DELETE</td>
                    </tr>
                </thead>
                <?php foreach ($this->products as $product) { ?>
                    <tr class="<?= (!empty($product->dt_deleted) ? 'inactive' : 'active'); ?>">
                        <td class="avatar">
                            <?php if (isset($product->image)) { ?>
                                <img src="<?= Config::get('URL') . "/public/productImages/" . $product->image ?>" style="width:100%">

                            <?php } ?>
                        </td>

                        <td><?= $product->name; ?></td>
                        <td><?= $product->description; ?></td>
                        <td><?= $product->size_name; ?></td>
                        <td><?= $product->unit_price; ?></td>
                        <td><?= $product->quantity; ?></td>
                        <td><?= $product->total_item_price; ?></td>
                        <td>
                            <a href="<?= Config::get('URL') . 'productCart/edit/' . $product->id; ?>">Edit</a>
                        </td>
                        <td>
                            <a href="<?= Config::get('URL') . 'productCart/delete/' . $product->id; ?>">Delete</a>
                        </td>

                    </tr>
                <?php } ?>

                <tfoot>
                    <tr>
                        <th scope="row">Total Price</th>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td><b style="font-size: 22px;"><?php {
                                    echo $this->totalQuantity;
                                } ?></td>
                        <td><b style="font-size: 22px;" ><?php {
                                    echo $this->totalValue;
                                } ?></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
    
    <h1>Delivery address</h1>
    <table class="overview-table">
        <thead>
            <tr>
                <td>Street</td>
                <td>House number</td>
                <td>ZIP</td>
                <td>City</td>
            </tr>
        </thead>
        <tr>
            <td><?php echo $order[0]['delivery-street'] ?></td>
            <td><?php echo $order[0]['delivery-housenumber'] ?></td>
            <td><?php echo $order[0]['delivery-postalcode'] ?></td>
            <td><?php echo $order[0]['delivery-city'] ?></td>
        </tr>
    </table>
    <h1>Payment option</h1>
    <table class="overview-table">
        <thead>
            <tr>
                <td>Payment form</td>
            </tr>
        </thead>
        <tr>
            <td><?php echo $order[0]['payment-name']?></td>
        </tr>
    </table>
    <div class="box">
        <ul class="navigation" style="z-index: 20; ">
            <li>
                <?php 
                    
                    $customerEmail = "renedubb@yahoo.de";
                    $orderNumber = "1";
                ?>
                <a type="button" class="notification" href="<?php echo Config::get('URL'); ?>Order/saveOrder">
                    <span>Finish</span>
                </a>
            </li>
        </ul>
    </div>
</div>