<?php

/**
 * RegisterController
 * Register new user
 */
class RegisterController extends Controller
{
    /**
     * Construct this object by extending the basic Controller class. The parent::__construct thing is necessary to
     * put checkAuthentication in here to make an entire controller only usable for logged-in users (for sure not
     * needed in the RegisterController).
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Register page
     * Show the register form, but redirect to main-page if user is already logged-in
     */
    public function index()
    {
        if (LoginModel::isUserLoggedIn()) {
            Redirect::home();
        } else {
            $this->View->render('register/index');
        }
    }

    /**
     * Register page action
     * POST-request after form submit
     */
    public function register_action()
    {
        $registration_successful = RegistrationModel::registerNewUser();

        if ($registration_successful) {
            Redirect::to('login/index');
        } else {
            Redirect::to('register/index');
        }
    }

    /**
     * Verify user after activation mail link opened
     * @param int $user_id user's id
     * @param string $user_activation_verification_code user's verification token
     */
    public function verify($user_id, $user_activation_verification_code)
    {
        if (isset($user_id) && isset($user_activation_verification_code)) {
            RegistrationModel::verifyNewUser($user_id, $user_activation_verification_code);
            $this->View->render('register/verify');
        } else {
            Redirect::to('login/index');
        }
    }

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
   
    public function register_adress()
    {
        
        $user_name = strip_tags(Request::post('username'));
        $delivery_street = strip_tags(Request::post('delivery-street'));
        $delivery_housenumber = strip_tags(Request::post('delivery-housenumber'));
        $delivery_postalcode = Request::post('delivery-postalcode');
        $delivery_city = Request::post('delivery-city');
        $pay_type = Request::post('payment-option');


        Session::add('ordem_de_compra', array('username'=>$user_name,
                                             'delivery-street'=>$delivery_street,
                                             'delivery-housenumber'=>$delivery_housenumber,
                                              'delivery-postalcode' =>$delivery_postalcode,
                                              'delivery-city'=>$delivery_city,
                                              'payment-option'=> $pay_type
                                            ));



         $address_number=RegistrationModel::readLastAddress();
        

        
         $address_number->last_address = $address_number->last_address == intVal(0) ? intVal(1) :  intVal($address_number->last_address);

        $registration_bool= RegistrationModel::writeNewAdress($address_number->last_address, $delivery_street,  $delivery_housenumber, $delivery_postalcode, $delivery_city, $pay_type );
        






        if ($registration_bool) {

            $order_number=RegistrationModel::readLastOrder();
            

            $order_number->last_order =  $order_number->last_order == intVal(0) ? intVal(1) :  intVal($order_number->last_order);
            $address_number->last_address = $address_number->last_address == intVal(0) ? intVal(1) :  intVal($address_number->last_address);

            $order_bool=RegistrationModel::writeNewOrder($order_number->last_order,intVal($pay_type),  $address_number->last_address);

            if($order_bool){
                Redirect::to('order/Detail');
            }
            else{
                Redirect::to('order/index');
            }
            
        } else {
            Redirect::to('order/index');
        }
    }
}

