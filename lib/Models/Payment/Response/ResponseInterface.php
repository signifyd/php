<?php

namespace Signifyd\Models\Payment\Response;

interface ResponseInterface {

    /**
     * Get the name
     *
     * @return mixed
     */
    public function getCardholder();

    /**
     * Set the name
     *
     * @param mixed $cardholder The card holder name
     *
     * @return void
     */
    public function setCardholder($cardholder);

    /**
     * Retrieve Card number last four digits
     *
     * @return mixed
     */
    public function getLast4();

    /**
     * Set the last 4 digits
     *
     * @param mixed $last4 The 4 digits
     *
     * @return void
     */
    public function setLast4($last4);

    /**
     * Retrieve Card number bin (first 6 digits of the card)
     *
     * @return mixed
     */
    public function getBin();

    /**
     * Set the bin (first 6 digits of the card)
     *
     * @param mixed $bin The bin value
     *
     * @return void
     */
    public function setBin($bin);

    /**
     * Get the expiration year of the card
     *
     * @return mixed
     */
    public function getExpiryYear();

    /**
     * Set the expiration year of the card
     *
     * @param mixed $expiryYear The expiration year
     *
     * @return void
     */
    public function setExpiryYear($expiryYear);

    /**
     * Get the expiration month of the card
     *
     * @return int
     */
    public function getExpiryMonth();

    /**
    * Set the expiration month of the card
    *
    * @param int $expiryMonth The expiration month of the card
    *
    * @return void
    */
    public function setExpiryMonth($expiryMonth);

    /**
     * Retrieve Card CVV code
     *
     * @return string
     */
    public function getCvv();

    /**
     * Set CVV code. Expect to receive a single char containing one of these values:
     * 'M', 'N', 'P', 'S', 'U'
     *
     * @param $cvv string
     *
     * @return void
     */
    public function setCvv($cvv);

    /**
     * Retrieve Card AVS code
     *
     * @return string
     */
    public function getAvs();

    /**
     * Set AVS code. Expect to receive a single char containing one of these values:
     *  'X', 'Y', 'A', 'W', 'Z', 'N', 'U', 'R', 'E', 'S', 'D', 'M', 'B', 'P', 'C', 'I', 'G'
     *
     * @param $avs string
     *
     * @return void
     */
    public function setAvs($avs);

}