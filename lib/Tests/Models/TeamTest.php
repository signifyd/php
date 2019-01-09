<?php
/**
 * TeamTest Test class for the Signifyd SDK
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
 * Class TeamTest
 *
 * @category Signifyd_Fraud_Protection
 * @package  Signifyd\Core
 * @author   Signifyd <info@signifyd.com>
 * @license  See LICENSE.txt for license details.
 * @link     https://www.signifyd.com/
 */
class TeamTest extends TestCase
{
    /**
     * @var \PhpUnit\Framework\String
     */
    public $className = 'Signifyd\Models\Team';

    /**
     * Testing team with no argument passed
     *
     * @return void
     */
    public function testInitTeamWithoutParams()
    {
        $team = new \Signifyd\Models\Team();
        $this->assertInstanceOf($this->className, $team);
    }

    /**
     * Testing team with sting params passed
     *
     * @return void
     */
    public function testInitTeamWithStringParam()
    {
        $team = new \Signifyd\Models\Team('signifyd');
        $this->assertInstanceOf($this->className, $team);
    }

    /**
     * Testing team with an empty team array passed
     *
     * @return void
     */
    public function testInitTeamWithEmptyArrayParam()
    {
        $team = new \Signifyd\Models\Team([]);
        $this->assertInstanceOf($this->className, $team);
    }

    /**
     * Testing team with an unknown properties passed
     *
     * @return void
     */
    public function testInitTeamWithUnknownProperties()
    {
        $teamData = [
            'wow' => 'test',
            'foo' => 'bar'
        ];
        $team = new \Signifyd\Models\Team($teamData);
        $this->assertInstanceOf($this->className, $team);
        $jsonTeam = $team->toJson();
        $emptyJsonTeam = json_encode([
            "teamId" => null,
            "teamName" => null
        ]);

        $this->assertEquals($jsonTeam, $emptyJsonTeam);
    }

    /**
     * Testing team with an empty team array passed
     *
     * @return void
     */
    public function testInitTeamWithCorrectParams()
    {
        $teamData = [
            "teamId" => 12345,
            "teamName" => "Signifyd Unit Test"
        ];
        $team = new \Signifyd\Models\Team($teamData);
        $this->assertInstanceOf($this->className, $team);
    }

    /**
     * Testing team with an empty team array passed
     *
     * @return void
     */
    public function testExpectedJsonWithCorrectParams()
    {
        $teamData = [
            "teamId" => 12345,
            "teamName" => "Signifyd Unit Test"
        ];
        $team = new \Signifyd\Models\Team($teamData);

        $jsonTeamData = json_encode($teamData);
        $jsonTeam = $team->toJson();

        $this->assertEquals($jsonTeamData, $jsonTeam);
    }

    /**
     * Testing team with an empty team array passed
     *
     * @return void
     */
    public function testValidateTeamWithCorrectParams()
    {
        $teamData = [
            "teamId" => 12345,
            "teamName" => "Signifyd Unit Test"
        ];
        $team = new \Signifyd\Models\Team($teamData);
        $valid = $team->validate();

        $this->assertTrue($valid);
    }

    /* Disable until there is a real validation for Team */
    /**
     * Testing team with an empty team array passed
     *
     * @return void
     */
//    public function testValidateTeamWithWrongParams()
//    {
//        $teamData = [];
//        $team = new \Signifyd\Models\Team($teamData);
//        $valid = $team->validate();
//
//        $this->assertNotTrue($valid);
//    }
    /* End disable until there is a real validation for Team */

}