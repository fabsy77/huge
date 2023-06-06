<?php

class ProductStatisticController extends Controller {
    public function index()
    {
        if (Session::get("user_account_type") == 7)
        {
        $this->View->render('productStatistic/index',array());
        }
        else
        {
            $this->View->render('error/403');
        }
    }
}