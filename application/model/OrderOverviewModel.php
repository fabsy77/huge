<?php
class OrderOverviewModel
{
    public static function getOrderSummary($order_id)
    {
        $database = DatabaseFactory::getFactory()->getConnection();

            $sql = "SELECT   
            products.id,
            products.name,
            products.price,
            products.description,
            products.image,
            products.category,
            products_ordered.quantity,
            products_ordered.size,
            products_ordered.order_id,
            products_ordered.product_id,
            size.name as size_name
            FROM 
            products
            INNER JOIN products_ordered ON products.id = products_ordered.product_id
            INNER JOIN size ON size.id = products_ordered.id
            WHERE products_ordered.order_id = :order_number
            GROUP BY products_ordered.id";
            

        $query = $database->prepare($sql);

        $query->execute([
            ':order_number' => $order_id
        ]);
        return $query->fetchAll();
    }

    public static function getOrderAddress($orderNumber)
    {
        $database = DatabaseFactory::getFactory()->getConnection();
        
        $sql = "SELECT 
                orders.address_id,
                orders.payment_type,
                orders.buyer_id,
                orders.order_number,
                addresses.city,
                addresses.house_number,
                addresses.zip,
                addresses.street,
                addresses.id,
                payment_types.id,
                payment_types.name AS paymentType
                FROM orders
                INNER JOIN addresses ON orders.address_id = addresses.id
                INNER JOIN payment_types ON orders.payment_type = payment_types.id 
                WHERE orders.order_number = :orderNumber LIMIT 1";

        $query = $database->prepare($sql);

        $query->execute([
            ':orderNumber' => $orderNumber
        ]);
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }


    public static function getCustomerOrders()
    {
        $database = DatabaseFactory::getFactory()->getConnection();

        $sql = "SELECT 
        REPLACE(CAST(order_placed_at AS DATE), '-', '') AS order_date, 
        order_number,
        buyer_id, 
        DATE_FORMAT(order_placed_at, '%D, %M, %Y') as order_date_only 
        FROM orders 
        WHERE buyer_id = :user_id";

        $query = $database->prepare($sql);

        $query->execute([
            ':user_id' => Session::get('user_id')
        ]);

        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function checkPermissionToOrder($userId, $order_number)
    {
        $database = DatabaseFactory::getFactory()->getConnection();
        $query = $database->prepare("SELECT * FROM orders WHERE buyer_id = :buyer_id and order_number = :order_number;");
        $query->execute(array(
            ':buyer_id' => $userId,
            ':order_number' => $order_number
        ));
        return $query->rowCount() == 1;
    }

    public static function getAllOrders()
    {
        $database = DatabaseFactory::getFactory()->getConnection();

        $sql = "SELECT 
        REPLACE(CAST(order_placed_at AS DATE), '-', '') AS order_date, 
        order_number, 
        buyer_id, 
        DATE_FORMAT(order_placed_at, '%D, %M, %Y') as order_date_only
        FROM 
        orders";

        $query = $database->prepare($sql);

        $query->execute();

        return $query->fetchAll(PDO::FETCH_ASSOC);
    }
}

?>