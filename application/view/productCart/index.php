<div class="container">
    <h1>Warenkorb</h1>
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
                    <td>Id</td>
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
                        <td><?= $product->id; ?></td>
                         <td class="avatar">
                            <?php if (isset($product->image)) { ?>
                                <img src="<?= Config::get('URL') . "/public/productImages/". $product->image?>" style="width:100%">

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
                        <th scope="row">Totals</th>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td><b><?php {echo $this->totalQuantity;} ?></td>
                        <td><b><?php {echo $this->totalValue;} ?></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
    <div class="box">
    <ul class="navigation" style="z-index: 20;" >
    <li>
                    <a type="button" class="notification" href="<?php echo Config::get('URL'); ?>order/index">
                        <span>next</span>
                    </a>
    </li>
    </ul>
    </div>
</div>


