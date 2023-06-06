<?php 
class ProductController extends Controller
{
    public function index()
    {
            $this->View->render('product/index',array(
                'products' => ProductsModel::getAllProducts(),
                'category' => ProductsModel::getAllCategorys()
            ));
    }

    public function showProduct($imageId)
    {
        if (isset($imageId))
        {
            $this->View->render('product/showProduct', array(
                'product' => ProductsModel::getProductById($imageId),
                'sizes' => ProductsModel::getSize()
            ));
        }
        else{
            Redirect::home();
        }
    }

    //function to add the choosen product to cart
    public function addProduct($product_id)
    {
        $product = (object)array("id" => Request::post('product_name'), 
                                 "size" => Request::post('product_description'));

        Redirect::to('productCart/index');
    }

    public function showProductByCategory($category)
    {
            $this->View->render('product/index', array(
                'products' => ProductsModel::chooseCategory($category),
                'category' => ProductsModel::getAllCategorys()
            ));
    }

    public function search()
    {
        if (isset($_GET['searchTerm'])) {
            $searchTerm = $_GET['searchTerm'];
            $this->View->render('product/index',array(
            'products' => ProductsModel::searchProducts($searchTerm),
            'category' => ProductsModel::getAllCategorys()
            ));
        }
    }
}
?>