<?php

/**
 * The Product controller: Just an example of simple create, read, update and delete (CRUD) actions.
 */
class ProductCartController extends Controller
{
    /**
     * Construct this object by extending the basic Controller class
     */

    public $TotalValue = 0.00;
    public $TotalQuantity = 0;
    public $Sizes = array();

    public function __construct()
    {
        parent::__construct();

        // VERY IMPORTANT: All controllers/areas that should only be usable by logged-in users
        // need this line! Otherwise not-logged in users could do actions. If all of your pages should only
        // be usable by logged-in users: Put this line into libs/Controller->__construct
        Auth::checkAuthentication();

        $this->Sizes = ProductCartModel::getSizes();
    }

    /**
     * This method controls what happens when you move to /product/index in your app.
     * Gets all products (of the seller).
     */

    public function index()
    {
        $products = ProductCartModel::getAllProducts();

        // if you have at least one item into your card, the cart list items is shown, else you'll be redirected to products
        if(sizeof($products) > 0 ){

            $this->View->render('productCart/index', array('products' => $products, 
                                                           'totalValue' => $this->getTotalAmount($products),
                                                           'totalQuantity'=>$this->TotalQuantity));
                                                                                                        
        }
        else
        {
            Redirect::to('product/index');
        }
    }


    /**
     * This method controls what happens when you move to /dashboard/create in your app.
     * Creates a new product. This is usually the target of form submit actions.
     * POST request.
     */
    public function create()
    {

        $selectedProduct = (object)array("id" => Request::post('product_id'), 
                                 "quantity" => Request::post('product_quantity'),
                                 "size" => Request::post('product_size_id'), 
                                 "price" => 0.00, 
                                 "total_item_price" => 0.00);

        $product = ProductCartModel::getProduct($selectedProduct->id, __function__);

        $selectedProduct->price = $product->unit_price;

        ProductCartModel::createProduct($selectedProduct);

        Redirect::to('productCart/index');
    }

    /**
     * This method controls what happens when you move to /product/edit(/XX) in your app.
     * Shows the current content of the product and an editing form.
     * @param $product_id int id of the product
     */

    // edits the product in the shopping cart based on the product ID
    public function edit($product_id)
    {
        $this->View->render('productCart/edit', array(
            'product' => ProductCartModel::getProduct($product_id, __function__),
            'sizes' => $this->Sizes
        ));

    }

    // Function that show the product based on the ID
    public function show($product_id)
    {
        $this->View->render('productCart/show', array(
            'product' => ProductCartModel::getProduct($product_id, __function__)
        ));
    }

    /**
     * This method controls what happens when you move to /product/editSave in your app.
     * Edits a product (performs the editing after form submit).
     * POST request.
     */

     // edits and saves the product that is in the HTML form
    public function editSave()
    {

        $product = (object)array("item_id" => Request::post('product_id'),
                                 "size_id" => Request::post('product_size_id'), 
                                 "quantity" => Request::post('product_quantity'));

        if(Controller::IsValidPost($product)){

            ProductCartModel::updateProduct($product);
        }

        Redirect::to('productCart');
    }

    /**
     * This method controls what happens when you move to /product/delete(/XX) in your app.
     * Deletes a product. In a real application a deletion via GET/URL is not recommended, but for demo purposes it's
     * totally okay.
     * @param int $product_id id of the product
     */

    // Deletes the product based on the product ID
    public function delete($product_id)
    {
        ProductCartModel::deleteProduct($product_id);

        Redirect::to('productCart/index');
    }

         /**Function with two tasks:
        Counts the total number of products in the order
        Calculates the total value of the order*/
    private function getTotalAmount($products)
    {
        $TotalValue = 0.00;
        foreach ($products as $product) {
            $TotalValue += ($product->unit_price * $product->quantity);
            $this->TotalQuantity+=($product->quantity);
        }
        return $TotalValue;
    }

}
