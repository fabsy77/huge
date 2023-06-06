<div class="container">
    <h1>Edit a Product</h1>

    <div class="box">
        <!-- echo out the system feedback (error and success messages) -->
        <?php $this->renderFeedbackMessages(); ?>

        <?php if ($this->product) { ?>
            <div class="login-box" style="width: 50%; display: block;">
            <form method="post" action="<?php echo Config::get('URL'); ?>productAdm/editSave">
                <!-- <label>Change text of note: </label>
                <!-- we use htmlentities() here to prevent user input with " etc. break the HTML -->
                <input type="hidden" name="product_id" value="<?php echo htmlentities($this->product->id); ?>" />
                <label>Name: </label><input type="text" name="product_name" value="<?php echo htmlentities($this->product->name);?>" required /><br>
                <label>Description: </label><input type="text" name="product_description"  value="<?php echo htmlentities($this->product->description); ?>" required/><br>
                
               <!--
                recupera os valores de categoria que foram criados no controle 
                Retrieve the values of categories that were created in the control.                                                               -->
                <label for="categories">Category </label>
                <select name="category-option" id="category-option" required>

                <?php
                    // For each category in the list, it should match the product's category ID and mark it as selected; otherwise, do nothing.
                    //para cada categoria da lista tem que ser igual ao id da categoria do produto coloca selecionado caso contrario nada-->
                    foreach ($this->categories as $key => $value) {
                    $selected = $this->product->category == $value->id ? 'selected' : '';
                    echo "<option ".$selected." value ='".$value->id."'>".$value->name."</option>";
                    }
                ?>
                </select><br><br>
                
                
                <label>Price: </label><input type="text" name="product_price" value="<?php echo htmlentities($this->product->price); ?>" required/>
                <label>In Stock: </label><input type="text" name="product_in_stock" value="<?php echo htmlentities($this->product->in_stock); ?>" required/>
                <br>
                <input type="submit" value='Save' />
            </form>
        <?php } else { ?>
            <p>This product does not exist.</p>
        <?php } ?>
    </div>
</div>
