<?php
/**
 * ProductTest Test class for the Signifyd SDK
 *
 * PHP version 5.6
 *
 * @category  Signifyd_Fraud_Protection
 * @package   Signifyd\Core
 * @author    Signifyd <info@signifyd.com>
 * @copyright 2018 SIGNIFYD Inc. All rights reserved.
 * @license   See LICENSE.txt for license details.
 * @link      https://www.signifyd.com/
 */
namespace Signifyd\Tests\Core;

use PHPUnit\Framework\TestCase;

/**
 * Class ProductTest
 *
 * @category Signifyd_Fraud_Protection
 * @package  Signifyd\Core
 * @author   Signifyd <info@signifyd.com>
 * @license  See LICENSE.txt for license details.
 * @link     https://www.signifyd.com/
 */
class ProductTest extends TestCase
{
    /**
     * The class name tested class
     *
     * @var \PhpUnit\Framework\String
     */
    public $className = 'Signifyd\Models\Product';

    /**
     * Testing product with no argument passed
     *
     * @return void
     */
    public function testInitProductWithoutParams()
    {
        $product = new \Signifyd\Models\Product();
        $this->assertInstanceOf($this->className, $product);
    }

    /**
     * Testing product with sting params passed
     *
     * @return void
     */
    public function testInitProductWithStringParam()
    {
        $product = new \Signifyd\Models\Product('signifyd');
        $this->assertInstanceOf($this->className, $product);
    }

    /**
     * Testing product with an empty product array passed
     *
     * @return void
     */
    public function testInitProductWithEmptyArrayParam()
    {
        $product = new \Signifyd\Models\Product([]);
        $this->assertInstanceOf($this->className, $product);
    }

    /**
     * Testing product with an unknown properties passed
     *
     * @return void
     */
    public function testInitProductWithUnknownProperties()
    {
        $productData = [
            'wow' => 'test',
            'foo' => 'bar'
        ];
        $product = new \Signifyd\Models\Product($productData);
        $this->assertInstanceOf($this->className, $product);
        $jsonProduct = $product->toJson();
        $emptyJsonProduct = json_encode(
            [
                'itemId' => null,
                'itemName' => null,
                'itemUrl' => null,
                'itemImage' => null,
                'itemQuantity' => null,
                'itemPrice' => null,
                'itemWeight' => null,
                'itemIsDigital' => null,
                'itemCategory' => null,
                'itemSubCategory' => null
            ]
        );

        $this->assertEquals($jsonProduct, $emptyJsonProduct);
    }

    /**
     * Testing product with an empty product array passed
     *
     * @return void
     */
    public function testInitProductWithCorrectParams()
    {
        $productData = [
            'itemId' => "1",
            'itemName' => "Sparkly sandals",
            'itemUrl' => "http://mydomain.com/sparkly-sandals",
            'itemImage' => "http://mydomain.com/images/sparkly-sandals.jpeg",
            'itemQuantity' => 1,
            'itemPrice' => 59.99,
            'itemWeight' => 5,
            'itemIsDigital' => false,
            'itemCategory' => "apparel",
            'itemSubCategory' => "footwear"
        ];
        $product = new \Signifyd\Models\Product($productData);
        $this->assertInstanceOf($this->className, $product);
    }

    /**
     * Testing product with an empty product array passed
     *
     * @return void
     */
    public function testExpectedJsonWithCorrectParams()
    {
        $productData = [
            'itemId' => "1",
            'itemName' => "Sparkly sandals",
            'itemUrl' => "http://mydomain.com/sparkly-sandals",
            'itemImage' => "http://mydomain.com/images/sparkly-sandals.jpeg",
            'itemQuantity' => 1,
            'itemPrice' => 59.99,
            'itemWeight' => 5,
            'itemIsDigital' => false,
            'itemCategory' => "apparel",
            'itemSubCategory' => "footwear"
        ];
        $product = new \Signifyd\Models\Product($productData);

        $jsonProductData = json_encode($productData);
        $jsonProduct = $product->toJson();

        $this->assertEquals($jsonProductData, $jsonProduct);
    }

    /**
     * Testing product with an empty product array passed
     *
     * @return void
     */
    public function testValidateProductWithCorrectParams()
    {
        $productData = [
            'itemId' => "1",
            'itemName' => "Sparkly sandals",
            'itemUrl' => "http://mydomain.com/sparkly-sandals",
            'itemImage' => "http://mydomain.com/images/sparkly-sandals.jpeg",
            'itemQuantity' => 1,
            'itemPrice' => 59.99,
            'itemWeight' => 5,
            'itemIsDigital' => false,
            'itemCategory' => "apparel",
            'itemSubCategory' => "footwear"
        ];
        $product = new \Signifyd\Models\Product($productData);
        $valid = $product->validate();

        $this->assertTrue($valid);
    }

    /* Disable until there is a real validation for Product */
    /**
     * Testing product with an empty product array passed
     *
     * @return void
     */
    //public function testValidateProductWithWrongParams()
    //{
        //$productData = [];
        //$product = new \Signifyd\Models\Product($productData);
        //$valid = $product->validate();

        //$this->assertNotTrue($valid);
    //}
    /* End disable until there is a real validation for Product */

}