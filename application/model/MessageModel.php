<?php
    class MessageModel
    {
        public static function sendMessage($to_user_id, $message,  $order_number)
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
                ':order_number' =>  $order_number
            ]);
        }

        public static function readAll($order_number)
        {
            $database = DatabaseFactory::getFactory()->getConnection();

            $sql = "UPDATE chat SET is_read = 1 
            WHERE 
            to_user_id = :to_user_id
            AND
            order_number = :order_number
            AND 
            is_read = 0";

            $query = $database->prepare($sql);

            $query->execute([
                ':to_user_id' => Session::get('user_id'),
                ':order_number' => $order_number
            ]);

            return ($query->rowCount() > 0);
        }

        public static function showMessage($order_number)
        {
            $database = DatabaseFactory::getFactory()->getConnection();

            $sql = "SELECT *
            FROM chat 
            WHERE order_number = :order_number";

            $query = $database->prepare($sql);

            $query->execute([
                ':order_number' => $order_number
            ]);

            return $query->fetchAll(PDO::FETCH_ASSOC);
        }

        public Static function unreadMessages($to_user_id,  $order_number)
        {
            $database = DatabaseFactory::getFactory()->getConnection();

            $sql = "SELECT is_read FROM chat WHERE to_user_id = :from_user_id AND from_user_id = :to_user_id AND order_number = :order_number AND is_read = 0";

            $query = $database->prepare($sql);

            $query->execute([
                ':to_user_id' => $to_user_id,
                ':from_user_id' => Session::get('user_id'),
                ':order_number' => $order_number
            ]);

            return $query->rowCount();
        }
    }

?>