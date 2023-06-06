<div class="container">
    <h1>ProductController/show/:id</h1>
    <div class="box">

        <!-- echo out the system feedback (error and success messages) -->
        <?php $this->renderFeedbackMessages(); ?>

        <h3>What happens here ?</h3>
        <div>This controller/action/view shows all public information about a certain product.</div>

        <?php if ($this->product) { ?>
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
                        <td><b>Activated ?</td>
                        <td><b>Created At</td>
                        <td><b>Updated At</td>
                        <td><b>Deleted At</td>
                    </tr>
                    </thead>
                    <tbody>
                        <tr class="<?= (!empty($this->product->dt_deleted) ? 'inactive' : 'active'); ?>">
                            <td><?= $this->product->id; ?></td>
                            <td class="avatar">
                                <?php if (isset($this->product->image)) { ?>
                                    <img src="<?= $this->product->image; ?>" />
                                <?php } ?>
                            </td>
                            <td><?= $this->product->name; ?></td>
                            <td><?= $this->product->description; ?></td>
                            <td><?= $this->product->category; ?></td>
                            <td><?= $this->product->price; ?></td>
                            <td><?= $this->product->in_stock; ?></td>
                            <td><?= (!empty($this->product->dt_deleted) ? 'No' : 'Yes'); ?></td>
                            <td><?= $this->product->dt_created; ?></td>
                            <td><?= (empty($this->product->dt_updated) ? 'No' : $this->product->dt_updated); ?></td>
                            <td><?= (empty($this->product->dt_deleted) ? 'No' : $this->product->dt_deleted); ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        <?php } ?>

    </div>
</div>
