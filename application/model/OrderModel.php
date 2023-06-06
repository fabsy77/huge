<?php

/**
 * Class RegistrationModel
 *
 * Everything registration-related happens here.
 */
class OrderModel
{
// Inserts a new order with the previously created address
public static function writeNewOrder($order_number, $payment_type, $address_id  )
{
    $database = DatabaseFactory::getFactory()->getConnection();

    // write new users data into database
    $sql = "INSERT INTO orders ( order_number, payment_type, buyer_id, address_id )
                VALUES ( :uorder_number, :upayment_type, :ubuyer_id, :uaddress_id)";
    $query = $database->prepare($sql);
    $query->execute(array(
                         ':uorder_number' => $order_number,
                         ':upayment_type' => $payment_type,
                          ':ubuyer_id'=> Session::get('user_id'),
                          ':uaddress_id' => $address_id));

    //perguntar para comentar
    if ($query->rowCount() == 1) {
        Session::add('feedback_positive', 'Order added successfully');
            return true;
    }      
    // default return
    Session::add('feedback_negative', 'fail'.$query->getMessage());
    return false;
}

 //function that get the last item number of the order and increment it by 1
 public static function readLastOrder(){

    $database = DatabaseFactory::getFactory()->getConnection();

    $sql = "SELECT max(order_number) +1 AS last_order FROM orders";
    $query = $database->prepare($sql);
    $query->execute();

    if ($query->rowCount() > 0) {

        return $query->fetch();
    } 
    else{
        return 1;
    }
}

    // Get the last generated address and increment it by 1
    public  static function readLastAddressOrder($user_id = null){
        $database = DatabaseFactory::getFactory()->getConnection();

        $sql_where= "SELECT max(id) + 1 AS last_address FROM addresses WHERE user_id = :user_id";
        $sql_nowhere = "SELECT max(id) + 1 AS last_address FROM addresses ";
        $sql = is_null($user_id) ?  $sql_nowhere : $sql_where;

        $query = $database->prepare($sql);
        if(is_null($user_id)){
            $query->execute();
        }
        else{
            $query->execute(array(':user_id' => Session::get('user_id')));
        }
     
        if ($query->rowCount() > 0) {
            return $query->fetch();
        } 
        else{
            return 1;
        }
    }

    public static function writeNewOrderAddress($id, $delivery_street, $delivery_housenumber, $delivery_postalcode, $delivery_city )
    {
        $database = DatabaseFactory::getFactory()->getConnection();

        /* $address_number= self::readLastAddress();//rene
        $address_number->last_address = $address_number->last_address == intVal(0) ? intVal(1) :  intVal($address_number->last_address);
 */
        // write new users data into database
        $sql = "INSERT INTO addresses ( id, city, house_number, zip, street, user_id)
                    VALUES ( :uid, :ucity, :uhouse_number, :uzip, :ustreet, :user_id)";
        $query = $database->prepare($sql);
        $query->execute(array(
                             ':uid'=>$id,
                             ':ucity' => $delivery_street,
                              ':uhouse_number' => $delivery_housenumber,
                              ':uzip' => $delivery_postalcode,
                              ':ustreet' => $delivery_city,
                              ':user_id' => Session::get('user_id')));
        //perguntar para comentar
        if ($query->rowCount() == 1) {
            Session::add('feedback_positive', 'Address added successfully');
                return true;
        }      
        // default return
        Session::add('feedback_negative','fail'.$query->getMessage());
        return false;
    }
    public static function getAllPaymentsType(){

        $database = DatabaseFactory::getFactory()->getConnection();
    
        $sql = "SELECT id, name FROM payment_types";
        $query = $database->prepare($sql);
        $query->execute();
    
        return $query->fetchAll();
        
    }
}
?>