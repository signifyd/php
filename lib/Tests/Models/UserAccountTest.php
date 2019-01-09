<?php
/**
 * UserAccountTest Test class for the Signifyd SDK
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
 * Class UserAccountTest
 *
 * @category Signifyd_Fraud_Protection
 * @package  Signifyd\Core
 * @author   Signifyd <info@signifyd.com>
 * @license  See LICENSE.txt for license details.
 * @link     https://www.signifyd.com/
 */
class UserAccountTest extends TestCase
{
    /**
     * @var \PhpUnit\Framework\String
     */
    public $className = 'Signifyd\Models\UserAccount';

    /**
     * Testing user account with no argument passed
     *
     * @return void
     */
    public function testInitUserAccountWithoutParams()
    {
        $userAccount = new \Signifyd\Models\UserAccount();
        $this->assertInstanceOf($this->className, $userAccount);
    }

    /**
     * Testing user account with sting params passed
     *
     * @return void
     */
    public function testInitUserAccountWithStringParam()
    {
        $userAccount = new \Signifyd\Models\UserAccount('signifyd');
        $this->assertInstanceOf($this->className, $userAccount);
    }

    /**
     * Testing user account with an empty user account array passed
     *
     * @return void
     */
    public function testInitUserAccountWithEmptyArrayParam()
    {
        $userAccount = new \Signifyd\Models\UserAccount([]);
        $this->assertInstanceOf($this->className, $userAccount);
    }

    /**
     * Testing user account with an unknown properties passed
     *
     * @return void
     */
    public function testInitUserAccountWithUnknownProperties()
    {
        $userAccountData = [
            'wow' => 'test',
            'foo' => 'bar'
        ];
        $userAccount = new \Signifyd\Models\UserAccount($userAccountData);
        $this->assertInstanceOf($this->className, $userAccount);
        $jsonUserAccount = $userAccount->toJson();
        $emptyJsonUserAccount = json_encode([
            "email" => null,
            "username" => null,
            "phone" => null,
            "createdDate" => null,
            "accountNumber" => null,
            "lastOrderId" => null,
            "aggregateOrderCount" => null,
            "aggregateOrderDollars" => null,
            "lastUpdateDate" => null
        ]);

        $this->assertEquals($jsonUserAccount, $emptyJsonUserAccount);
    }

    /**
     * Testing user account with an empty user account array passed
     *
     * @return void
     */
    public function testInitUserAccountWithCorrectParams()
    {
        $userAccountData = [
            "email" => "bob@gmail.com",
            "username" => "bobbo",
            "phone" => "5555551212",
            "createdDate" => date(DATE_ATOM),
            "accountNumber" => "54321",
            "lastOrderId" => "4321",
            "aggregateOrderCount" => 40,
            "aggregateOrderDollars" => 5000,
            "lastUpdateDate" => date(DATE_ATOM)
        ];
        $userAccount = new \Signifyd\Models\UserAccount($userAccountData);
        $this->assertInstanceOf($this->className, $userAccount);
    }

    /**
     * Testing user account with an empty user account array passed
     *
     * @return void
     */
    public function testExpectedJsonWithCorrectParams()
    {
        $userAccountData = [
            "email" => "bob@gmail.com",
            "username" => "bobbo",
            "phone" => "5555551212",
            "createdDate" => date(DATE_ATOM),
            "accountNumber" => "54321",
            "lastOrderId" => "4321",
            "aggregateOrderCount" => 40,
            "aggregateOrderDollars" => 5000,
            "lastUpdateDate" => date(DATE_ATOM)
        ];
        $userAccount = new \Signifyd\Models\UserAccount($userAccountData);

        $jsonUserAccountData = json_encode($userAccountData);
        $jsonUserAccount = $userAccount->toJson();

        $this->assertEquals($jsonUserAccountData, $jsonUserAccount);
    }

    /**
     * Testing user account with an empty user account array passed
     *
     * @return void
     */
    public function testValidateUserAccountWithCorrectParams()
    {
        $userAccountData = [
            "email" => "bob@gmail.com",
            "username" => "bobbo",
            "phone" => "5555551212",
            "createdDate" => date(DATE_ATOM),
            "accountNumber" => "54321",
            "lastOrderId" => "4321",
            "aggregateOrderCount" => 40,
            "aggregateOrderDollars" => 5000,
            "lastUpdateDate" => date(DATE_ATOM)
        ];
        $userAccount = new \Signifyd\Models\UserAccount($userAccountData);
        $valid = $userAccount->validate();

        $this->assertTrue($valid);
    }

    /* Disable until there is a real validation for UserAccount */
    /**
     * Testing user account with an empty user account array passed
     *
     * @return void
     */
//    public function testValidateUserAccountWithWrongParams()
//    {
//        $userAccountData = [];
//        $userAccount = new \Signifyd\Models\UserAccount($userAccountData);
//        $valid = $userAccount->validate();
//
//        $this->assertNotTrue($valid);
//    }
    /* End disable until there is a real validation for UserAccount */


}