<?php
/**
 * UserAccount model for the Signifyd SDK
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
use Signifyd\Models\Policies;

/**
 * Class Decision
 *
 * @category Signifyd_Fraud_Protection
 * @package  Signifyd\Core
 * @author   Signifyd <info@signifyd.com>
 * @license  See LICENSE.txt for license details.
 * @link     https://www.signifyd.com/
 */
class Decision extends Model
{
    /**
     * The date and time when the event was created.
     *
     * @var string
     */
    public $createdAt;

    /**
     * The suggested action that should be taken for the event.
     *
     * @var string
     */
    public $checkpointAction;

    /**
     * The reason that the checkpointAction was taken.
     *
     * @var string
     */
    public $checkpointActionReason;

    /**
     * Policy associated with the checkpointAction.
     * If you are using Decision Center and a policy determined the checkpointAction,
     * then this will be the name of that policy.
     *
     * @var string
     */
    public $checkpointActionPolicy;

    /**
     * Policies configured at the Checkpoint in Decision Center.
     *
     * @var Policies
     */
    public $policies;

    /**
     * A value from 0-1000 indicating the likelihood that the order is fraud.
     * 0 indicates the highest risk, 1000 inidicates the lowest risk.
     *
     * @var float
     */
    public $score;

    /**
     * The class attributes
     *
     * @var array $fields The list of class fields
     */
    protected $fields = [
        'createdAt',
        'checkpointAction',
        'checkpointActionReason',
        'checkpointActionPolicy',
        'policies',
        'score'
    ];

    /**
     * The validation rules
     *
     * @var array $fieldsValidation List of rules
     */
    protected $fieldsValidation = [
        'createdAt' => [],
        'checkpointAction' => [],
        'checkpointActionReason' => [],
        'checkpointActionPolicy' => [],
        'policies' => [],
        'score' => [],
    ];

    /**
     * UserAccount constructor.
     *
     * @param array $data The user account data
     */
    public function __construct($data = [])
    {
        if (!empty($data) && is_array($data)) {
            foreach ($data as $field => $value) {
                if (!in_array($field, $this->fields)) {
                    continue;
                }

                if ($field == 'policies') {
                    if (isset($data['policies'])) {
                        if ($data['policies'] instanceof Policies) {
                            $this->setPolicies($data['policies']);
                        } else {
                            $policies = new Policies($data['policies']);
                            $this->setPolicies($policies);
                        }
                    }
                    continue;
                }

                $this->{'set' . ucfirst($field)}($value);
            }
        }
    }

    /**
     * Validate the user account
     *
     * @return bool
     */
    public function validate()
    {
        $valid = [];

        //TODO add code to validate the user account
        return (!isset($valid[0]))? true : false;
    }

    /**
     * @return string
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @param $createdAt
     * @return void
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
    }

    /**
     * @return string
     */
    public function getCheckpointAction()
    {
        return $this->checkpointAction;
    }

    /**
     * @param $checkpointAction
     * @return void
     */
    public function setCheckpointAction($checkpointAction)
    {
        $this->checkpointAction = $checkpointAction;
    }

    /**
     * @return string
     */
    public function getCheckpointActionReason()
    {
        return $this->checkpointActionReason;
    }

    /**
     * @param $checkpointActionReason
     * @return void
     */
    public function setCheckpointActionReason($checkpointActionReason)
    {
        $this->checkpointActionReason = $checkpointActionReason;
    }

    /**
     * @return string
     */
    public function getCheckpointActionPolicy()
    {
        return $this->checkpointActionPolicy;
    }

    /**
     * @param $checkpointActionPolicy
     * @return void
     */
    public function setCheckpointActionPolicy($checkpointActionPolicy)
    {
        $this->checkpointActionPolicy = $checkpointActionPolicy;
    }

    /**
     * @return \Signifyd\Models\Policies
     */
    public function getPolicies()
    {
        return $this->policies;
    }

    /**
     * @param $policies
     * @return void
     */
    public function setPolicies($policies)
    {
        $this->policies = $policies;
    }

    /**
     * @return float
     */
    public function getScore()
    {
        return $this->score;
    }

    /**
     * @param $score
     * @return void
     */
    public function setScore($score)
    {
        $this->score = $score;
    }
}