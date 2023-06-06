<?php

/**
 * ProductModel
 * This is basically a simple CRUD (Create/Read/Update/Delete) demonstration.
 */
class ProductAdmModel
{

    /**
     * Get all products (products are just example data that the user has created)
     * @return array an array with several objects (the results)
     */
    public static function getAllProducts()
    {
        $database = DatabaseFactory::getFactory()->getConnection();

        $sql = "SELECT p.id, p.name, p.price, p.in_stock, c.name AS category, p.description, p.image FROM products p
        LEFT JOIN category c ON c.id = p.category
        WHERE p.dt_deleted is null";
        $query = $database->prepare($sql);
        $query->execute(array());

        // fetchAll() is the PDO method that gets all result rows

        return $query->fetchAll();
    }

    /**
     * Get a single product
     * @param int $product_id id of the specific product
     * @return object a single object (the result)
     */
    public static function getProduct($product_id)
    {
        $database = DatabaseFactory::getFactory()->getConnection();

        $sql = "SELECT id, name, price, in_stock, category, description, image, dt_created, dt_updated, dt_deleted FROM products WHERE dt_deleted is null AND id = :product_id LIMIT 1";
        $query = $database->prepare($sql);
        $query->execute(array(':product_id' => $product_id));

        // fetch() is the PDO method that gets a single result
        return $query->fetch();
    }

    /**
     * Set a product (create a new one)
     * @param string $name product name that will be created
     * @param string $description product description that will be created
     * @param string $price product price that will be created
     * @return bool feedback (was the product created properly ?)
     */
    public static function createProduct($product)
    {
        $database = DatabaseFactory::getFactory()->getConnection();

        $sql = "INSERT INTO products (name, description, category, price, in_stock, image) VALUES (:uname, :udescription, :ucategory, :uprice, :uin_stock, :uimage)";
        $query = $database->prepare($sql);
        
        $query->execute(array(':uname' => $product->name, 
                              ':udescription' => $product->description, 
                              ':ucategory' => $product->category,
                              ':uprice' => $product->price,
                              ':uin_stock'=>100,
                              ':uimage' => $product->image));
        
        if ($query->rowCount() == 1) {
            return true;
        }

        // default return
        Session::add('feedback_negative', Text::get('FEEDBACK_PRODUCT_CREATION_FAILED').$query->getMessage());
        return false;
    }

    /**
     * Update an existing product
     * @param int $product_id id of the specific product
     * @param string $name new name of the specific product
     * @param string $description new description of the specific product
     * @param string $price new price of the specific product
     * @return bool feedback (was the update successful ?)
     */
    //To update an existing product based on the product ID, and if the product fails to update, provide negative feedback.
    public static function updateProduct($product)
    {
        $database = DatabaseFactory::getFactory()->getConnection();

        $sql = "UPDATE products 
                SET name = :uname, description = :udescription, price = :uprice, in_stock = :uin_stock, category = :ucategory, dt_updated = now()
                WHERE id = :uproduct_id LIMIT 1";
        $query = $database->prepare($sql);
        $query->execute(array(':uproduct_id' => $product->id, 
                              ':uname' => $product->name,
                              ':udescription' => $product->description, 
                              ':uprice' => $product->price, 
                              ':uin_stock' => $product->in_stock,
                              ':ucategory' => $product->category
                              ));

        if ($query->rowCount() == 1) {
            return true;
        }

        Session::add('feedback_negative', Text::get('FEEDBACK_PRODUCT_EDITING_FAILED').$query->getMessage());
        return false;
    }

    /**
     * Delete a specific product
     * @param int $product_id id of the product
     * @return bool feedback (was the product deleted properly ?)
     */
    public static function deleteProduct($product_id)
    {
        if (!$product_id) {
            return false;
        }

        $database = DatabaseFactory::getFactory()->getConnection();

        // $sql = "DELETE FROM products WHERE id = :uproduct_id AND seller_id = :useller_id LIMIT 1";
        //$sql = "DELETE FROM products WHERE id = :uproduct_id LIMIT 1";
        $sql = "UPDATE products SET dt_deleted = now() WHERE id = :uproduct_id LIMIT 1";

        $query = $database->prepare($sql);
        $query->execute(array(':uproduct_id' => $product_id));

        if ($query->rowCount() == 1) {
            return true;
        }

        // default return
        Session::add('feedback_negative', Text::get('FEEDBACK_PRODUCT_DELETION_FAILED'));
        return false;
    }

    public static function getAllCategories()
    {
        $database = DatabaseFactory::getFactory()->getConnection();

        $sql = "SELECT id, name FROM category";
        $query = $database->prepare($sql);
        $query->execute(array());

        // fetchAll() is the PDO method that gets all result rows

        return $query->fetchAll();
    }
}
?>