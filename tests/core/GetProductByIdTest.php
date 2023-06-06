<?php 

class GetProductByIdTest extends PHPUnit_Framework_TestCase
{
    public function testGetProductById()
    {
        // Mocking the database connection
        $databaseMock = $this->getMockBuilder(Database::class)
            ->disableOriginalConstructor()
            ->getMock();

        // Creating a mock query object
        $queryMock = $this->getMockBuilder(PDOStatement::class)
            ->getMock();

        // Creating a mock product object
        $productMock = [
            'id' => 1,
            'name' => 'Example Product',
            'price' => 9.99,
        ];

        // Setting up the query mock to return the product mock
        $queryMock->expects($this->once())
            ->method('execute')
            ->with([':productId' => 1]);
        $queryMock->expects($this->once())
            ->method('fetch')
            ->willReturn($productMock);

        // Setting up the database mock to return the query mock
        $databaseMock->expects($this->once())
            ->method('prepare')
            ->with('SELECT * FROM products WHERE id = :productId AND dt_deleted is null')
            ->willReturn($queryMock);

        // Mocking the DatabaseFactory
        $databaseFactoryMock = $this->getMockBuilder(DatabaseFactory::class)
            ->getMock();
        $databaseFactoryMock->method('getFactory')
            ->willReturn($databaseMock);

        // Replace the actual DatabaseFactory with the mock
        $originalFactory = DatabaseFactory::getFactory();
        DatabaseFactory::setFactory($databaseFactoryMock);

        // Calling the method to test
        $product = Product::getProductById(1);

        // Restoring the original DatabaseFactory
        DatabaseFactory::setFactory($originalFactory);

        // Assertions
        $this->assertEquals($productMock, $product);
    }
}
?>
