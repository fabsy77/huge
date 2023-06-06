<?php
class OrderChatModel
{
    public static function sendMessage($to_user_id, $message, $order_number)
    {
        $dateTimeNow = date("Y-m-d H:i:s");
        $database = DatabaseFactory::getFactory()->getConnection();

        $sql = "INSERT INTO chat (from_user_id, to_user_id, message, is_read, message_sent_at, order_number)
                VALUES 
                (:from_user_id, :to_user_id, :message, :is_read, :message_sent_at, :order_number)";

        $query = $database->prepare($sql);

        $query->execute([
            ':from_user_id' => Session::get('user_id'),
            ':to_user_id' => $to_user_id,
            ':message' => $message,
            ':is_read' => 0,
            ':message_sent_at' => $dateTimeNow,
            ':order_number' => $order_number
        ]);
    }

    public static function readAll($from_user_id)
    {
        $database = DatabaseFactory::getFactory()->getConnection();

        $sql = "UPDATE chat SET is_read = 1 WHERE 
        to_user_id = :to_user_id AND from_user_id = :from_user_id 
        AND is_read = 0";

        $query = $database->prepare($sql);

        $query->execute([
            ':from_user_id' => $from_user_id,
            ':to_user_id' => Session::get('user_id')
        ]);

        return ($query->rowCount() > 0);
    }

   
    public static function showMessage($order_number, $to_user_id, $from_user_id)
    {
        $database = DatabaseFactory::getFactory()->getConnection();

        $sql = "SELECT
        chat.message,
        chat.order_number,
        chat.from_user_id,
        chat.to_user_id,
        chat.message_sent_at,
        chat.is_read,
        orders.buyer_id
        FROM chat
        INNER JOIN orders ON orders.order_number = chat.order_number
        WHERE
    (chat.to_user_id = :to_user_id AND chat.from_user_id = :from_user_id AND chat.order_number = :order_number)
    OR
    (chat.to_user_id = :from_user_id AND chat.from_user_id = :to_user_id AND chat.order_number = :order_number)";


        $query = $database->prepare($sql);

        $query->execute([
            ':from_user_id' => $from_user_id,
            ':to_user_id' => $to_user_id,
            ':order_number' => $order_number 
        ]);

        return $query->fetchAll(PDO::FETCH_ASSOC);
    } 


    public Static function unreadMessages($to_user_id)
    {
        $database = DatabaseFactory::getFactory()->getConnection();

        $sql = "CALL UpdateUnreadMessages(:to_user_id, :from_user_id)";

        $query = $database->prepare($sql);

        $query->execute([
            ':to_user_id' => $to_user_id,
            ':from_user_id' => Session::get('user_id')
        ]);

        return $query->rowCount();
    }

    /* public static function getUserIdFromOrder($buyer_id)
    {
        $database = DatabaseFactory::getFactory()->getConnection();

        $sql = "SELECT buyer_id FROM orders WHERE buyer_id = :buyer_id";

        $query = $database->prepare($sql);

        $query->execute([
            ':buyer_id' => $buyer_id
        ]);
        return $query->rowCount();
    } */
}
?>