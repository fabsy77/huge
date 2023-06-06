<?php


/**
 * RegisterController
 * Register new user
 */
class OrderController extends Controller
{

    public $TotalValue = 0.00;
    public $TotalQuantity = 0;
    public $paymentsType = array();
    /**
     * Construct this object by extending the basic Controller class. The parent::__construct thing is necessary to
     * put checkAuthentication in here to make an entire controller only usable for logged-in users (for sure not
     * needed in the RegisterController).
     */
    public function __construct()
    {
        parent::__construct();

        $this->paymentsType=OrderModel::getAllPaymentsType();
    }

    /**
     * Register page
     * Show the register form, but redirect to main-page if user is already logged-in
     */
    public function index()
    {
        if (LoginModel::isUserLoggedIn()) {
            //Redirect::home();
            $this->View->render('order/index', array('paymentTypes'=> $this->paymentsType));
        } else {
            $this->View->render('register/index');
        }
    }
    
    public function detail()
    {
        if (LoginModel::isUserLoggedIn()) {
            //Redirect::home();
            $products = ProductCartModel::getAllProducts();

        // if you have at least one item into your card, the cart list items is shown, else you'll be redirected to products
        if(sizeof($products) > 0 ){

            $this->View->render('order/detail', array('products' => $products, 
                                                        'totalValue' =>$this->getTotalAmount($products),
                                                        'totalQuantity'=>$this->TotalQuantity,
                                                        'paymentTypes'=> $this->paymentsType)
                                                    );
                                                                                                      
        }
        else
        {
            Redirect::to('product/index');
        }
       }
            
    }

    

    /**
     * Verify user after activation mail link opened
     * @param int $user_id user's id
     * @param string $user_activation_verification_code user's verification token
     */
   

    /**
     * Generate a captcha, write the characters into $_SESSION['captcha'] and returns a real image which will be used
     * like this: <img src="......./login/showCaptcha" />
     * IMPORTANT: As this action is called via <img ...> AFTER the real application has finished executing (!), the
     * SESSION["captcha"] has no content when the application is loaded. The SESSION["captcha"] gets filled at the
     * moment the end-user requests the <img .. >
     * Maybe refactor this sometime.
     */
    public function showCaptcha()
    {
        CaptchaModel::generateAndShowCaptcha();
    }
    // Redirects to the thank you page
    public static function thankyou()
    {
        Redirect::to('Order/thankyou');
        
    }
    // Function that has 2 functions:
    // Counts the total number of products in the order and calculates the total value of the order
    private function getTotalAmount($products)
    {
        $TotalValue = 0.00;
        foreach ($products as $product) {
            $TotalValue += ($product->unit_price * $product->quantity);
            $this->TotalQuantity+=($product->quantity);
        }
        return $TotalValue;
    }

    public function register_address()
    {
        $user_name = strip_tags(Request::post('username'));
        $delivery_street = strip_tags(Request::post('delivery-street'));
        $delivery_housenumber = strip_tags(Request::post('delivery-housenumber'));
        $delivery_postalcode = Request::post('delivery-postalcode');
        $delivery_city = Request::post('delivery-city');
        $pay_type = Request::post('payment-option');
        $pay_name = $this->paymentsType[$pay_type -1]->name;
        

        Session::add('purchase_order', array('username'=>$user_name,
                                             'delivery-street'=>$delivery_street,
                                             'delivery-housenumber'=>$delivery_housenumber,
                                              'delivery-postalcode' =>$delivery_postalcode,
                                              'delivery-city'=>$delivery_city,
                                              'payment-option'=> $pay_type,
                                              'payment-name'=> $pay_name,

                                            ));

        Redirect::to('order/Detail'); 
    }

    public static function saveOrder(){


        $address_number=OrderModel:: readLastAddressOrder();
        
        $address_number->last_address = $address_number->last_address == intVal(0) ? intVal(1) :  intVal($address_number->last_address);

        $PurchaseOrder= Session::get('purchase_order');


        $registration_bool= OrderModel::writeNewOrderAddress($address_number->last_address, $PurchaseOrder[0]['delivery-street'], $PurchaseOrder[0]['delivery-housenumber'], $PurchaseOrder[0]['delivery-postalcode'], $PurchaseOrder[0]['delivery-city'], $PurchaseOrder[0]['payment-option']);
                                            
        if ($registration_bool) {

            $order_number=OrderModel::readLastOrder();
            
            $order_number->last_order =  $order_number->last_order == intVal(0) ? intVal(1) :  intVal($order_number->last_order);

            $address_number->last_address = $address_number->last_address == intVal(0) ? intVal(1) :  intVal($address_number->last_address);

            $order_bool=OrderModel::writeNewOrder($order_number->last_order, intVal($PurchaseOrder[0]['payment-option']),  $address_number->last_address);

            if($order_bool){
                session_destroy();
                self::thankyou();
            }
            else{
                Redirect::to('order/index');
            }
            
        } else {
            Redirect::to('order/index');
        }

    }


}