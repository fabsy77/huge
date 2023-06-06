<?php 
class ChatController extends Controller
{
    public function index()
    {
        if (Session::get("user_account_type") == 7)
        {
        $this->View->render('chat/index',array(
            'orders' => OrderOverviewModel::getAllOrders(),
            'unreadMessages' => $unreadMessages,
            'messages' => $messages
        ));
        }
    }

    public function sendMessage()
    {
        $to_user_id = request::post('to_user_id');
        $message = request::post('message');
        $order_number = request::post('order_number');
        MessageModel::sendMessage($to_user_id, $message, $order_number);
    }



    public function showChat($order_number)
    {
        if(isset($order_number))
        {
            $this->View->render('chat/showChat',array(
                'order' => OrderOverviewModel::getOrderAddress($order_number),
                'messages' => MessageModel::showMessage($order_number)
            ));
        }

    }
}
?>