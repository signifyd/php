<?php
/**
 * ModelTest Test class for the Signifyd SDK
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
 * Class ModelTest
 *
 * @category Signifyd_Fraud_Protection
 * @package  Signifyd\Core
 * @author   Signifyd <info@signifyd.com>
 * @license  See LICENSE.txt for license details.
 * @link     https://www.signifyd.com/
 */
class ModelTest extends TestCase
{
    public $className = 'Signifyd\Core\Model';

    /**
     * Testing to json method
     *
     * @covers \Signifyd\Core\Model::toJson()
     *
     * @return void
     */
    public function testToJson()
    {
        $model = new \Signifyd\Core\Model();
        $json = $model->toJson();
        $expectedJson = json_encode(new \StdClass());

        $this->assertEquals($expectedJson, $json);
    }

    /**
     * Testing validation with empty values
     *
     * @covers \Signifyd\Core\Model::enumValid()
     *
     * @return void
     */
    public function testEnumValidEmptyParams()
    {
        $model = new \Signifyd\Core\Model();
        $valid = $model->enumValid('', []);

        $this->assertTrue($valid);
    }

    /**
     * Testing validation with no argument passed
     *
     * @covers \Signifyd\Core\Model::enumValid()
     *
     * @expectedException \ArgumentCountError
     *
     * @return void
     */
    public function testEnumValidNoParams()
    {
        $model = new \Signifyd\Core\Model();
        $valid = $model->enumValid();
    }

    /**
     * Testing validation with value but empty array
     *
     * @covers \Signifyd\Core\Model::enumValid()
     *
     * @return void
     */
    public function testEnumValidNotValid()
    {
        $model = new \Signifyd\Core\Model();
        $valid = $model->enumValid('signifyd', []);

        $this->assertFalse($valid);
    }

    /**
     * Testing validation with value and array
     *
     * @covers \Signifyd\Core\Model::enumValid()
     *
     * @return void
     */
    public function testEnumValidNotValidWithArray()
    {
        $model = new \Signifyd\Core\Model();
        $valid = $model->enumValid('signifyd', ['error', 'no error']);

        $this->assertFalse($valid);
    }

    /**
     * Testing validation with correct value and correct array
     *
     * @covers \Signifyd\Core\Model::enumValid()
     *
     * @return void
     */
    public function testEnumValidValid()
    {
        $model = new \Signifyd\Core\Model();
        $valid = $model->enumValid('signifyd', ['error', 'no error', 'signifyd']);

        $this->assertTrue($valid);
    }

    /**
     * Testing validation with correct value and correct array
     *
     * @covers \Signifyd\Core\Model::avsCvvValidate()
     *
     * @return void
     */
    public function testAvsCvvValidateValid()
    {
        $model = new \Signifyd\Core\Model();
        $valid = $model->avsCvvValidate("Y");

        $this->assertTrue($valid);
    }

    /**
     * Testing validation with correct value and correct array
     *
     * @covers \Signifyd\Core\Model::avsCvvValidate()
     *
     * @return void
     */
    public function testAvsCvvValidateNotValid()
    {
        $model = new \Signifyd\Core\Model();
        $valid = $model->avsCvvValidate("j");

        $this->assertFalse($valid);
    }

    /**
     * Testing validation with correct value and correct array
     *
     * @covers \Signifyd\Core\Model::avsCvvValidate()
     *
     * @expectedException \ArgumentCountError
     *
     * @return void
     */
    public function testAvsCvvValidateEmpty()
    {
        $model = new \Signifyd\Core\Model();
        $valid = $model->avsCvvValidate();
    }
}