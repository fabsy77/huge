<?php
class OrderOverviewController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        if (Session::get("user_account_type") == 7)
        {
            $this->View->render('orderOverview/index',array(
                'orders' => OrderOverviewModel::getAllOrders()
            ));
        }
        else 
        {
            $this->View->render('orderOverview/index', array(
                'orders' => OrderOverviewModel::getCustomerOrders()
            ));
        }
    }

    public function orderOverview($order_id)
    {
        if (Session::get("user_account_type") == 7)
        {
            $this->View->render('orderOverview/orderOverview',array(
                'order' => OrderOverviewModel::getOrderSummary($order_id),
                'orderAddress' => OrderOverviewModel::getOrderAddress($order_id)
            ));
        }
        else 
        {
            if (OrderOverviewModel::checkPermissionToOrder(Session::get('user_id'), $order_id) === true)
            {
                $this->View->render('orderOverview/orderOverview', array(
                    'order' => OrderOverviewModel::getOrderSummary($order_id),
                    'orderAddress' => OrderOverviewModel::getOrderAddress($order_id)
                ));
            }
            else
            {
                $this->View->render('error/403');
            }
            
        }
    }
    public function sendMessage()
    {
        $to_user_id = request::post('to_user_id');
        $message = request::post('message');
        $orderNumber = request::post('order_number');
        OrderChatModel::sendMessage($to_user_id, $message, $orderNumber);
        Redirect::to('orderOverview/showChat/'. $orderNumber ."/". $to_user_id);
    } 

    public function showChat($order_id, $to_user_id)
    {
            if(isset($order_id))
            {
                $this->View->render('orderOverview/showChat',array(
                    'order' => OrderOverviewModel::getOrderAddress($order_id),
                    'to_user' => UserModel::getPublicProfileOfUser($to_user_id),
                    'from_user' => UserModel::getPublicProfileOfUser(Session::get('user_id')),
                    'messages' => OrderChatModel::showMessage($order_id, $to_user_id, Session::get('user_id')),
                    'unreadMessages' => OrderChatModel::readAll($to_user_id)
                ));
            }
    }
}
?>