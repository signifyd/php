<?php
/**
 * Team model for the Signifyd SDK
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
namespace Signifyd\Models;

use Signifyd\Core\Model;

/**
 * Class Team
 * Info for the account that placed the order. May not be the recipient
 *
 * @category Signifyd_Fraud_Protection
 * @package  Signifyd\Core
 * @author   Signifyd <info@signifyd.com>
 * @license  See LICENSE.txt for license details.
 * @link     https://www.signifyd.com/
 */
class Team extends Model
{
    /**
     * Id of the team
     *
     * @var int $teamId
     */
    public $teamId;

    /**
     * Name of the team
     *
     * @var string $teamName
     */
    public $teamName;

    /**
     * The class attributes
     *
     * @var array $fields The list of class fields
     */
    protected $fields = [
        'teamId',
        'teamName'
    ];

    /**
     * The validation rules
     *
     * @var array $fieldsValidation List of rules
     */
    protected $fieldsValidation = [
        'teamId' => [],
        'teamName' => []
    ];

    /**
     * Team constructor.
     *
     * @param array $data The team data
     */
    public function __construct($data = [])
    {
        if (!empty($data) && is_array($data)) {
            foreach ($data as $field => $value) {
                if (!in_array($field, $this->fields)) {
                    continue;
                }

                $this->{'set' . ucfirst($field)}($value);
            }
        }
    }

    /**
     * Validate the team
     *
     * @return bool
     */
    public function validate()
    {
        $valid = [];

        //TODO add code to validate the team
        return (!isset($valid[0]))? true : false;
    }

    /**
     * Get the Team Id
     *
     * @return int
     */
    public function getTeamId()
    {
        return $this->teamId;
    }

    /**
     * Set the team id
     *
     * @param int $teamId The id of the team
     *
     * @return void
     */
    public function setTeamId($teamId)
    {
        $this->teamId = $teamId;
    }

    /**
     * Get the team name
     *
     * @return string
     */
    public function getTeamName()
    {
        return $this->teamName;
    }

    /**
     * Set the team name
     *
     * @param string $teamName The team name
     *
     * @return void
     */
    public function setTeamName($teamName)
    {
        $this->teamName = $teamName;
    }

}
