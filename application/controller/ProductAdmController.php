<?php

/**
 * The Product controller: Just an example of simple create, read, update and delete (CRUD) actions.
 */
class ProductAdmController extends Controller
{

    /**
     * Construct this object by extending the basic Controller class
     */

    public $defaultImgDir = "";
    public $TotalValue = 0.00;
    public $productCategory = array();


    public function __construct()
    {
        parent::__construct();

        // VERY IMPORTANT: All controllers/areas that should only be usable by logged-in users
        // need this line! Otherwise not-logged in users could do actions. If all of your pages should only
        // be usable by logged-in users: Put this line into libs/Controller->__construct
        Auth::checkAuthentication();

        $this->defaultImgDir = str_replace("application\controller", "public/productImages/", __DIR__);
        $this->productCategory = ProductAdmModel::getAllCategories();
    }

    // Function that lists all products that are manageable and returns their value
    public function index()
    {
        $products = ProductAdmModel::getAllProducts();

        $this->View->render('productAdm/index', array('products' => $products, 'totalValue' => $this->getTotalPrice($products)));
    }


    // Function that creates a new product in the store
    public function create()
    {
        
         $file_name = isset($_FILES['file']['name']) ? $_FILES['file']['name'] : 'default.jpg';  
         
        if(sizeof($_FILES) > 0){

            $tmp_name = $_FILES["file"]["tmp_name"];

            move_uploaded_file($tmp_name, $this->defaultImgDir.$file_name);
            
        }

       $product = (object)array("name" => Request::post('product_name'), 
                                 "description" => Request::post('product_description'), 
                                 "price" => Request::post('product_price'),
                                 "in_stock"=>Request::post('product_in_stock'),
                                 "category" => Request::post('category-option'),
                                 "image" =>$file_name
                                );

        ProductAdmModel::createProduct($product);
   
        Redirect::to('productAdm');
    }

    /**
     * This method controls what happens when you move to /product/edit(/XX) in your app.
     * Shows the current content of the product and an editing form.
     * @param $product_id int id of the product
     */

     //searches for the product to edit
    public function edit($product_id)
    {
        $this->View->render('productAdm/edit', array(
            'product' => ProductAdmModel::getProduct($product_id),
            'categories' => $this->productCategory
        ));

    }

    //show the product
    public function show($product_id)
    {
        $this->View->render('productAdm/show', array(
            'product' => ProductAdmModel::getProduct($product_id),
            'categories' => $this->productCategory
        ));
    }

    /**
     * This method controls what happens when you move to /product/editSave in your app.
     * Edits a product (performs the editing after form submit).
     * POST request.
     */

    // edits and saves the product
    public function editSave()
    {
        $product = (object)array("id" => Request::post('product_id'),
                                 "name" => Request::post('product_name'), 
                                 "description" => Request::post('product_description'), 
                                 "price" => Request::post('product_price'),
                                 "in_stock" => Request::post('product_in_stock'),
                                 "category" => Request::post('category-option')
                                );

        if(Controller::IsValidPost($product)){

            ProductAdmModel::updateProduct($product);
        }

        Redirect::to('productAdm');
    }

    /**
     * This method controls what happens when you move to /product/delete(/XX) in your app.
     * Deletes a product. In a real application a deletion via GET/URL is not recommended, but for demo purposes it's
     * totally okay.
     * @param int $product_id id of the product
     */
    // Function that deletes the product based on the product ID
    public function delete($product_id)
    {
        ProductAdmModel::deleteProduct($product_id);

        Redirect::to('productAdm');
    }

    //returns the total value of the product
    private static function getTotalPrice($products)
    {
        $TotalValue = 0.00;
        foreach ($products as $product) {
            $TotalValue += $product->price;
        }
        return $TotalValue;
    }
}


