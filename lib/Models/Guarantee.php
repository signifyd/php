<?php
/**
 * Guarantee model for the Signifyd SDK
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
 * Class Guarantee
 *
 * @category Signifyd_Fraud_Protection
 * @package  Signifyd\Core
 * @author   Signifyd <info@signifyd.com>
 * @license  See LICENSE.txt for license details.
 * @link     https://www.signifyd.com/
 */
class Guarantee extends Model
{
    /**
     * Case id
     */
    public $caseId;

    protected $fields = [
        'caseId'
    ];

    protected $fieldsValidation = [
        'caseId' => []
    ];

    public function __construct()
    {

    }

    public function validate()
    {

    }

}