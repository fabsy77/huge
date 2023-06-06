<?php

/**
 * This is the "base controller class". All other "real" controllers extend this class.
 * Whenever a controller is created, we also
 * 1. initialize a session
 * 2. check if the user is not logged in anymore (session timeout) but has a cookie
 */
class Controller
{
    /** @var View View The view object */
    public $View;

    /**
     * Construct the (base) controller. This happens when a real controller is constructed, like in
     * the constructor of IndexController when it says: parent::__construct();
     */
    public function __construct()
    {
        // always initialize a session
        Session::init();

        // check session concurrency
        Auth::checkSessionConcurrency();

        // user is not logged in but has remember-me-cookie ? then try to login with cookie ("remember me" feature)
        if (!Session::userIsLoggedIn() AND Request::cookie('remember_me')) {
            header('location: ' . Config::get('URL') . 'login/loginWithCookie');
        }

        // create a view object to be able to use it inside a controller, like $this->View->render();
        $this->View = new View();
    }
    //???

    // function to validate every post's field from frontend 
    //must be inherited in the child controller implict depends on extends Controller you can find it in your controller file
    public static function IsValidPost($postData){

       // for each field sent in the post array
       foreach (get_object_vars($postData) as $var => $val) {
        // if the following field is null , or empty by func or empty by comparing to empty string, it add the feedback message to emitter and return false, otherwise return true
        if(is_null($val) || empty($val) || $val == ""){
            Session::add('feedback_negative', Text::get('FEEDBACK_MISSING_DATA_FAILED'));
            return false;
        }
       }
       return  true;
    }
}
