<?php
    class MessageModel
    {
        public static function sendMessage($to_user_id, $message)
        {
            $dateTimeNow = date("Y-m-d H:i:s");
            $database = DatabaseFactory::getFactory()->getConnection();

            $sql = "INSERT INTO chat (from_user_id, to_user_id, message, is_read, message_sent_at)
                    VALUES 
                    (:from_user_id, :to_user_id, :message, :is_read, :message_sent_at)";

            $query = $database->prepare($sql);

            $query->execute([
                ':from_user_id' => Session::get('user_id'),
                ':to_user_id' => $to_user_id,
                ':message' => $message,
                'is_read' => false,
                'message_sent_at' => $dateTimeNow
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

        public static function showMessage($to_user_id,$from_user_id)
        {
            $database = DatabaseFactory::getFactory()->getConnection();

            $sql = "CALL GetChatMessages(:from_user_id,:to_user_id)";

            $query = $database->prepare($sql);

            $query->execute([
                ':from_user_id' => $from_user_id,
                ':to_user_id' => $to_user_id
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
    }

?>