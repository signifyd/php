<?php
/**
 * GuaranteeApiTest Test class for the Signifyd SDK
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
namespace Signifyd\Tests\Core\Api;

use PHPUnit\Framework\TestCase;

/**
 * Class GuaranteeApiTest
 *
 * @category Signifyd_Fraud_Protection
 * @package  Signifyd\Core
 * @author   Signifyd <info@signifyd.com>
 * @license  See LICENSE.txt for license details.
 * @link     https://www.signifyd.com/
 */
class GuaranteeApiTest extends TestCase
{
    public $guaranteeData = [];


    /**
     * Setup guarantee data
     */
    public function setUp()
    {
        $this->guaranteeData = [
            'caseId' => 111111111111
        ];

    }

    /**
     * Testing settings with no argument passed
     *
     * @return void
     */
    public function testFail()
    {
        $this->fail('Guarantee api test is working');
    }

}