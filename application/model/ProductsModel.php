<?php
Class ProductsModel
{
    public static function getAllProducts()
    {
        $database = DatabaseFactory::getFactory()->getConnection();

        $sql = "SELECT 
        products.id as id, 
        products.name as name, 
        products.description as description,
        products.image as image,
        products.price as price, 
        products.category as category, 
        products.in_stock as stock,
        category.name as catName
        FROM products
        JOIN category ON products.category = category.id
        WHERE products.dt_deleted is null
        AND products.in_stock != 0";
        $query = $database->prepare($sql);
        $query->execute();

        $all_products = array();

        foreach ($query->fetchAll() as $product) {

            // all elements of array passed to Filter::XSSFilter for XSS sanitation, have a look into
            // application/core/Filter.php for more info on how to use. Removes (possibly bad) JavaScript etc from
            // the user's values

            $all_products[$product->id] = new stdClass();
            $all_products[$product->id]->id = $product->id;
            $all_products[$product->id]->name = $product->name;
            $all_products[$product->id]->description = $product->description;
            $all_products[$product->id]->image = $product->image;
            $all_products[$product->id]->price = $product->price;
            $all_products[$product->id]->catName = $product->catName;
            $all_products[$product->id]->category = isset($product->category) ? $product->category : $product->{'category'} = 'undefined';
        }

        return $all_products;
    }

    public static function getFourMostSoldProducts()
    {
        $database = DatabaseFactory::getFactory()->getConnection();

        $sql = "SELECT 
        products.id as id, 
        products.name as name, 
        products.description as description,
        products.image as image,
        products.price as price, 
        products.category as category, 
        category.name as catName,
        products_ordered.quantity as quantity,
        products.dt_deleted
        FROM products
        JOIN category ON products.category = category.id
        JOIN products_ordered
        ON products.id = products_ordered.product_id
        WHERE products.dt_deleted is null
        AND products.in_stock != 0
        ORDER BY quantity DESC
        LIMIT 4";

        $query = $database->prepare($sql);
        $query->execute();

        $most_sold_products = array();

        foreach ($query->fetchAll() as $sold_product) {

            // all elements of array passed to Filter::XSSFilter for XSS sanitation, have a look into
            // application/core/Filter.php for more info on how to use. Removes (possibly bad) JavaScript etc from
            // the user's values

            $most_sold_products[$sold_product->id] = new stdClass();
            $most_sold_products[$sold_product->id]->id = $sold_product->id;
            $most_sold_products[$sold_product->id]->name = $sold_product->name;
            $most_sold_products[$sold_product->id]->description = $sold_product->description;
            $most_sold_products[$sold_product->id]->image = $sold_product->image;
            $most_sold_products[$sold_product->id]->price = $sold_product->price;
            $most_sold_products[$sold_product->id]->catName = $sold_product->catName;
            $most_sold_products[$sold_product->id]->category = isset($sold_product->category) ? $sold_product->category : $sold_product->{'category'} = 'undefined';
        }

        return $most_sold_products;
    }

    public static function getFourRndProducts()
    {
        $database = DatabaseFactory::getFactory()->getConnection();

        $sql = "SELECT DISTINCT
        products.id as id, 
        products.name as name, 
        products.description as description,
        products.image as image,
        products.price as price, 
        products.category as category, 
        category.name as catName,
        products.dt_deleted
        FROM products
        JOIN category ON products.category = category.id
        WHERE products.dt_deleted is null
        AND products.in_stock != 0
        ORDER BY RAND()
        LIMIT 4";
        $query = $database->prepare($sql);
        $query->execute();

        $rnd_products = array();

        foreach ($query->fetchAll() as $product) {

            // all elements of array passed to Filter::XSSFilter for XSS sanitation, have a look into
            // application/core/Filter.php for more info on how to use. Removes (possibly bad) JavaScript etc from
            // the user's values

            $rnd_products[$product->id] = new stdClass();
            $rnd_products[$product->id]->id = $product->id;
            $rnd_products[$product->id]->name = $product->name;
            $rnd_products[$product->id]->description = $product->description;
            $rnd_products[$product->id]->image = $product->image;
            $rnd_products[$product->id]->price = $product->price;
            $rnd_products[$product->id]->catName = $product->catName;
            $rnd_products[$product->id]->category = isset($product->category) ? $product->category : $product->{'category'} = 'undefined';
        }

        return $rnd_products;
    }



    public static function getProductById($productId)
    {
        $database = DatabaseFactory::getFactory()->getConnection();

        $sql = "SELECT * FROM products WHERE id = :productId AND dt_deleted is null";
        $query = $database->prepare($sql);
        $query->execute(array(':productId' => $productId));

        $product = $query->fetch();

        return $product;
    }

    public static function getSize()
    {
        $database = DatabaseFactory::getFactory()->getConnection();

        $sql = "SELECT * FROM size";
        $query = $database->prepare($sql);
        $query->execute();

        $sizes = array();

        foreach ($query->fetchAll() as $size)
        {
            $sizes[$size->id] = new stdClass();
            $sizes[$size->id]->id = $size->id;
            $sizes[$size->id]->name = $size->name;
        }

        return $sizes;
    }

    public static function chooseCategory($catId)
    {
        $database = DatabaseFactory::getFactory()->getConnection();

        $sql = "SELECT 
        products.id as id, 
        products.name as name, 
        products.description as description,
        products.image as image,
        products.price as price, 
        products.category as category, 
        category.name as catName,
        products.dt_deleted
        FROM products
        JOIN category ON products.category = category.id
        WHERE products.category = :catId AND products.dt_deleted is null
        AND products.in_stock != 0";
        $query = $database->prepare($sql);
        $query->execute(array(
            'catId' => $catId
        ));

        $all_products = array();

        foreach ($query->fetchAll() as $product) {

            // all elements of array passed to Filter::XSSFilter for XSS sanitation, have a look into
            // application/core/Filter.php for more info on how to use. Removes (possibly bad) JavaScript etc from
            // the user's values

            $all_products[$product->id] = new stdClass();
            $all_products[$product->id]->id = $product->id;
            $all_products[$product->id]->name = $product->name;
            $all_products[$product->id]->description = $product->description;
            $all_products[$product->id]->image = $product->image;
            $all_products[$product->id]->price = $product->price;
            $all_products[$product->id]->catName = $product->catName;
            $all_products[$product->id]->category = isset($product->category) ? $product->category : $product->{'category'} = 'undefined';
        }

        return $all_products;
    }

    public static function getAllCategorys()
    {
        $database = DatabaseFactory::getFactory()->getConnection();

        $sql = "SELECT name, id FROM category";
        $query = $database->prepare($sql);
        $query->execute();

        $categorys = $query->fetchAll();

        return $categorys;
    }

    public static function searchProducts($searchTerm)
    {
    $database = DatabaseFactory::getFactory()->getConnection();

    $sql = "SELECT 
            products.id as id, 
            products.name as name, 
            products.description as description,
            products.image as image,
            products.price as price, 
            products.category as category, 
            category.name as catName,
            products.dt_deleted
            FROM products
            JOIN category ON products.category = category.id
            WHERE products.name LIKE :searchTerm AND products.dt_deleted IS NULL
            AND products.in_stock != 0";

    $query = $database->prepare($sql);
    $query->execute(array(
        'searchTerm' => '%' . $searchTerm . '%'
    ));

    $matched_products = array();

    foreach ($query->fetchAll() as $product) {
        $matched_products[$product->id] = new stdClass();
        $matched_products[$product->id]->id = $product->id;
        $matched_products[$product->id]->name = $product->name;
        $matched_products[$product->id]->description = $product->description;
        $matched_products[$product->id]->image = $product->image;
        $matched_products[$product->id]->price = $product->price;
        $matched_products[$product->id]->catName = $product->catName;
        $matched_products[$product->id]->category = isset($product->category) ? $product->category : $product->{'category'} = 'undefined';
    }

    return $matched_products;
    }
}
?>