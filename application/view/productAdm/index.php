<style>
    .gallery {
        display: inline-block; /* same size as image */
        position: relative;
    }
    .gallery a {
        color: white;
        text-decoration: none;
    }
    .gallery a:hover {
        text-decoration: underline;
    }
    .gallery .menu {
        opacity: 0.0;
        position: absolute;
        top: 0px;
        left: 0px;
        right: 0px;
        bottom: 3px; /* todo Way is gallery div 3px greater then image???? */
        padding: 20px 10px 10px 10px;
    }
    .gallery .menu:hover {
        opacity: 1.0;
        background: rgba(0, 0, 0, 0.5);
    }
    .login-box input[type="button"] {
    color: #777;
    background-color: transparent;
    border: 2px solid #777;
    padding: 15px 20px;
    margin-bottom: 10px;
    display: block;
    width: 100%;
    box-sizing: border-box; /* modern way to say width:100% without padding */
    text-transform: uppercase;
}
</style>


<div class="container">
    <h1>Product Adm</h1>
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
        <div class="login-box" style="width: 50%; display: block;">
            <form method="post" action="<?php echo Config::get('URL');?>productAdm/create" enctype="multipart/form-data">
                <label>Name: </label><input type="text" name="product_name" required /><br>
                <label>Description: </label><input type="text" name="product_description" required/><br>
                <label>Price: </label><input type="text" name="product_price" required/>
                <br>
                <label for="categories">Category </label>
                <select name="category-option" id="category-option" required>
                <option value="">Select...</option>
                <option value="1">Hosen</option>
                <option value="2">Jeans</option>
                <option value="3">T-Shirt</option>
                <option value="4">Hoodies</option>
            </select><br><br>
               
                <input type="file" id="selectedFile" name="file" value="" style="display:none" required />
                <input type="button" value='Select Photo' onclick="document.getElementById('selectedFile').click();" />
                <input type="submit" value='Create this Product' autocomplete="off" />
            </form>
        </div>
    </div>
        <div>
            <table class="overview-table">
                <thead>
                <tr>
                    <td>Id</td>
                    <td>Photo</td>
                    <td>Name</td>
                    <td>Description</td>
                    <td>Category</td>
                    <td>Price</td>
                    <td>In Stock</td>
                    <td>Activated ?</td>
                    <td>Link to products's profile</td>
                    <td>EDIT</td>
                    <td>DELETE</td>
                </tr>
                </thead>
                <?php foreach ($this->products as $product) { ?>
                    <tr class="<?= (!empty($product->dt_deleted) ? 'inactive' : 'active'); ?>">
                        <td><?= $product->id; ?></td>
                         <td class="avatar">
                            <?php if (isset($product->image)) { ?>
                              <img src="<?=  Config::get('URL') . "/public/productImages/". $product->image; ?>" />
                            <?php } ?>
                        </td>

                        <td><?= $product->name; ?></td>
                        <td><?= $product->description; ?></td>
                        <td><?= $product->category; ?></td>
                        <td><?= $product->price; ?></td>
                        <td><?= $product->in_stock; ?></td>
                        <td><?= (!empty($product->dt_deleted) ? 'No' : 'Yes'); ?></td>
                        <td>
                            <a href="<?= Config::get('URL') . 'productAdm/show/' . $product->id; ?>">Details</a>
                        </td>
                        <td>
                            <a href="<?= Config::get('URL') . 'productAdm/edit/' . $product->id; ?>">Edit</a>
                        </td>
                        <td>
                            <a href="<?= Config::get('URL') . 'productAdm/delete/' . $product->id; ?>">Delete</a>
                        </td>
                        
                    </tr>
                <?php } ?>
            </table>
        </div>
    </div>
</div>




