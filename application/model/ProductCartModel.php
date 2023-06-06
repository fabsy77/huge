<?php

/**
 * ProductModel
 * This is basically a simple CRUD (Create/Read/Update/Delete) demonstration.
 */
class ProductCartModel
{
    /**
     * Get all products (products are just example data that the user has created)
     * @return array an array with several objects (the results)
     */

    //Get all products based on the logged-in user and session.
    public static function getAllProducts()
    {
        $database = DatabaseFactory::getFactory()->getConnection();

        $sql = "SELECT pic.id, p.image, p.name, p.description, p.price as unit_price, (pic.price * pic.quantity) as total_item_price, pic.quantity, pic.size, si.name as size_name
                FROM products_in_cart pic 
                LEFT JOIN products p ON p.id = pic.product_id
                LEFT JOIN size si ON si.id = pic.size 
                WHERE pic.dt_deleted is null AND (pic.user_id = :uuser_id AND pic.session_id = :usession_id)";
        $query = $database->prepare($sql);
        $query->execute(array(':uuser_id' => Session::get('user_id'), ':usession_id' => session_id()));

        // fetchAll() is the PDO method that gets all result rows

        return $query->fetchAll();
    }

    /**
     * Get a single product
     * @param int $product_id id of the specific product
     * @return object a single object (the result)
     */

        /**Get a specific product based on the logged-in user or session
            Performs two checks: if the function passed as a parameter is "create", the data source is the "products" table in the database
            or if the function is "edit", it means the user is editing a product in the shopping cart and the data source is "products_in_cart" table.*/
    public static function getProduct($product_id, $func)
    {
        $database = DatabaseFactory::getFactory()->getConnection();

        $sqls = array("create" => "SELECT p.id, p.image, p.name, p.description, p.price as unit_price
                FROM products p
                WHERE p.id = :uid AND p.dt_deleted is null", 
                      "edit" => "SELECT pic.id, p.image, p.name, p.description, p.price as unit_price, pic.quantity, pic.size
                FROM products_in_cart pic
                LEFT JOIN products p ON p.id = pic.product_id 
                WHERE pic.id = :uid AND pic.dt_deleted is null AND (pic.user_id = :uuser_id OR pic.session_id = :usession_id)");

        $params = array("create" => array(':uid' => $product_id), 
                        "edit" => array(':uid' => $product_id, ':uuser_id' => Session::get('user_id'), ':usession_id' => session_id()));

        // The variable `func` accesses the position of the SQL queries, retrieving the corresponding query, and accesses the variable `params` to retrieve the corresponding parameters (either "create" or "edit").
        $query = $database->prepare($sqls[$func]);
        $query->execute($params[$func]);

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

    // Creates a new product in the shopping cart
    public static function createProduct($product)
    {
        $database = DatabaseFactory::getFactory()->getConnection();

        $sql = "INSERT INTO products_in_cart (product_id, price, quantity, size, user_id, session_id) VALUES (:uid, :uprice, :uquantity, :usize, :uuserid, :usessionid)";
        $query = $database->prepare($sql);
        $query->execute(array(':uid' => $product->id, ':uprice' => $product->price, ':uquantity' => $product->quantity, ':usize' => $product->size, ':uuserid' => Session::get('user_id'), ':usessionid' => session_id()));

        if ($query->rowCount() == 1) {
            Session::add('feedback_positive', Text::get('FEEDBACK_PRODUCT_CREATION_SUCESSFUL'));
            return true;
        }

        // default return
        Session::add('feedback_negative', Text::get('FEEDBACK_PRODUCT_CREATION_FAILED'));
        //Session::add('feedback_negative', $query->getMessage());
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

     // Updates the shopping cart
    public static function updateProduct($product)
    {

        $database = DatabaseFactory::getFactory()->getConnection();

        $sql = "UPDATE products_in_cart pic
                SET pic.size = :usize, pic.quantity = :uquantity, pic.dt_updated = now()
                WHERE pic.id = :uitem_id AND pic.dt_deleted is null AND (pic.user_id = :uuser_id OR pic.session_id = :usession_id) LIMIT 1";
        $query = $database->prepare($sql);
        $query->execute(array(':uitem_id' => $product->item_id, 
                              ':usize' => $product->size_id,
                              ':uquantity' => $product->quantity, 
                              ':usession_id' => session_id(), 
                              ':uuser_id' => Session::get('user_id')));

        if ($query->rowCount() == 1) {
            return true;
        }

        Session::add('feedback_negative', Text::get('FEEDBACK_PRODUCT_EDITING_FAILED'));
        return false;
    }

    /**
     * Delete a specific product
     * @param int $product_id id of the product
     * @return bool feedback (was the product deleted properly ?)
     */

/*   Deletes a specific product from the shopping cart based on the session or user
     Executes an update command on the column `dt_deleted` setting it to the current timestamp (now()),
     making it invisible to the user but keeping it in the database for future queries or maintaining the history in the shopping cart.*/
    public static function deleteProduct($item_id)
    {   // if 
        if (!$item_id) {
            return false;
        }
        $database = DatabaseFactory::getFactory()->getConnection();

        $sql = "UPDATE products_in_cart 
                SET dt_deleted = now() 
                WHERE id = :uid AND (session_id = :usession_id OR user_id = :uuser_id )LIMIT 1";
        $query = $database->prepare($sql);
        $query->execute(array(':uid' => $item_id,':uuser_id' => Session::get('user_id'), ':usession_id' => session_id()));


        if ($query->rowCount() == 1) {
            return true;
        }

        // default return
        Session::add('feedback_negative', Text::get('FEEDBACK_PRODUCT_DELETION_FAILED'));
        return false;
    }

    // Get all sizes to count the number of sizes available (items in the shopping cart)
    public static function getSizes()
    {
        $database = DatabaseFactory::getFactory()->getConnection();

        $sql = "SELECT * FROM size";
        $query = $database->prepare($sql);
        $query->execute();

        return $query->fetchAll();
    }
}
