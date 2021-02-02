<?php

namespace Signifyd\Models\Payment\Response;

use Signifyd\Models\Payment\Response\ResponseInterface;

class DefaultResponse implements ResponseInterface
{
    /**
     * The full name on the credit card that was charged
     *
     * @var string
     */
    protected $cardholder;

    /**
     * The last four digits of the card number.
     *
     * @var int
     */
    protected $last4;

    /**
     * The first six digits of the credit card, the bank identification number, which uniquely identifies the issuer.
     *
     * @var string
     */
    protected $bin;

    /**
     * MM representation of the expiration month of the card.
     *
     * @var int
     */
    protected $expiryMonth;

    /**
     * The yyyy representation of the expiration year of the card.
     *
     * @var int
     */
    protected $expiryYear;

    /**
     * The CVV code
     *
     * @var string The hash for the card
     */
    protected $cvv;

    /**
     * The AVS code
     *
     * @var string The hash for the card
     */
    protected $avs;

    /**
     * @return string
     */
    public function getCardholder()
    {
        return $this->cardholder;
    }

    /**
     * @param mixed $cardholder
     * @return $this
     */
    public function setCardholder($cardholder)
    {
        if (preg_match("/^([a-zA-Z' ]+)$/", $cardholder)) {
            $this->cardholder = $cardholder;
        } else {
            $this->cardholder = null;
        }

        return $this;
    }

    /**
     * @return int|mixed
     */
    public function getLast4()
    {
        return $this->last4;
    }

    /**
     * @param mixed $last4
     * @return $this
     */
    public function setLast4($last4)
    {
        if (strlen($last4) !== 4) {
           $this->last4 = null;
        }

        $this->last4 = $last4;

        return $this;
    }

    /**
     * @return mixed|string
     */
    public function getBin()
    {
        return $this->bin;
    }

    /**
     * @param mixed $bin
     * @return $this
     */
    public function setBin($bin)
    {
        if (strlen($bin) !== 6) {
            $this->last4 = null;
        }
        
        $this->bin = $bin;
        
        return $this;
    }

    /**
     * @return string
     */
    public function getCvv()
    {
        return $this->cvv;
    }

    /**
     * @param string $cvv
     * @return $this|void
     */
    public function setCvv($cvv)
    {
        $validCvvResponseCodes = ['M', 'N', 'P', 'S', 'U'];
        
        if (in_array($cvv, $validCvvResponseCodes)) {
            $this->cvv = $cvv;
        } else {
            $this->cvv = null;
        }
        
        return $this;
    }

    /**
     * @return string
     */
    public function getAvs()
    {
        return $this->avs;
    }

    /**
     * @param string $avs
     * @return $this
     */
    public function setAvs($avs)
    {
        $validAvsResponseCodes = [
            'X', 'Y', 'A', 'W', 'Z', 'N', 'U', 'R',
            'E', 'S', 'D', 'M', 'B', 'P', 'C', 'I', 'G'
        ];
        
        if (in_array($avs, $validAvsResponseCodes)) {
            $this->avs = $avs;
        } else {
            $this->avs = null;
        }
        
        return $this;
    }

    /**
     * @return int|mixed
     */
    public function getExpiryYear()
    {
        return $this->expiryYear;
    }

    /**
     * @param mixed $expiryYear
     * @return $this
     */
    public function setExpiryYear($expiryYear)
    {
        if ($expiryYear === null){
            $this->expiryYear = null;
        } else {
            $this->expiryYear = $expiryYear;
        }

        return $this;
    }

    /**
     * @return int
     */
    public function getExpiryMonth()
    {
        return $this->expiryMonth;
    }

    /**
     * @param int $expiryMonth
     * @return $this|void
     */
    public function setExpiryMonth($expiryMonth)
    {
        if ($expiryMonth === null){
            $this->expiryMonth = null;
        } else {
            $this->expiryMonth = $expiryMonth;
        }

        return $this;
    }
}
