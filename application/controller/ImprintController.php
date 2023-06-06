<?php
//Redirect to the index page page of the imprint controller
    class ImprintController extends Controller{
        public function index()
        {
            $this->View->render('imprint/index');
        }
    }

?>
