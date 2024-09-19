<?php

namespace Signifyd\Core;

class LoggerProtection
{
    /**
     * A general function that handles all requests and returns an array containing protected data.
     *
     * @param array $data
     * @param string|null $listOfFiesdsToPrivate
     * @return array
     */
    public function __invoke(array $data, $listOfFiesdsToPrivate = null)
    {
        if (is_array($data) === false) {
            return $data;
        }

        $fiesdsToPrivate = $this->validateFieldsToPrivate($listOfFiesdsToPrivate);

        if (empty($fiesdsToPrivate)) {
            return $data;
        }

        foreach ($data as $firsKey => &$firstLayer) {
            if (is_array($firstLayer) || is_object($firstLayer)) {
                $firstLayer = (array) $firstLayer;
                foreach ($firstLayer as $secondKey => &$secondLayer) {
                    if (is_array($secondLayer) || is_object($secondLayer)) {
                        $secondLayer = (array) $secondLayer;
                        foreach ($secondLayer as $thirdKey => &$thirdLayer) {
                            if (is_array($thirdLayer) || is_object($thirdLayer)) {
                                $thirdLayer = (array) $thirdLayer;
                                foreach ($thirdLayer as $fourthKey => &$fourthLayer) {
                                    if (is_array($fourthLayer) || is_object($fourthLayer)) {
                                        $fourthLayer = (array) $fourthLayer;
                                        foreach ($fourthLayer as $fifthKey => &$fifthLayer) {
                                            if (is_array($fifthLayer) || is_object($fifthLayer)) {
                                                $fifthLayer = (array) $fifthLayer;
                                                foreach ($fifthLayer as $sixthKey => &$sixthLayer) {
                                                    if (is_string($sixthLayer) && in_array($sixthKey, $fiesdsToPrivate))
                                                    {
                                                        $sixthLayer = $this->privateField($sixthLayer);
                                                    }
                                                }
                                            } else {
                                                if (in_array($fifthKey, $fiesdsToPrivate)) {
                                                    $fifthLayer = $this->privateField($fifthLayer);
                                                }
                                            }
                                        }
                                    } else {
                                        if (in_array($fourthKey, $fiesdsToPrivate)) {
                                            $fourthLayer = $this->privateField($fourthLayer);
                                        }
                                    }
                                }
                            } else {
                                if (in_array($thirdKey, $fiesdsToPrivate)) {
                                    $thirdLayer = $this->privateField($thirdLayer);
                                }
                            }
                        }
                    } else {
                        if (in_array($secondKey, $fiesdsToPrivate)) {
                            $secondLayer = $this->privateField($secondLayer);
                        }
                    }
                }
            } else {
                if (in_array($firsKey, $fiesdsToPrivate)) {
                    $firstLayer = $this->privateField($firstLayer);
                }
            }
        }

        return $data;
    }

    /**
     * Private fields based on their lenght
     *
     * @param $fieldToPrivate
     * @return string
     */
    protected function privateField($fieldToPrivate)
    {
        if (isset($fieldToPrivate) === false) {
            return '***';
        }

        if (strlen($fieldToPrivate) >= 12) {
            return substr($fieldToPrivate, 0, 3) . '***' . substr($fieldToPrivate, -3);
        } elseif (strlen($fieldToPrivate) >= 7 && strlen($fieldToPrivate) <= 11) {
            return '***' . substr($fieldToPrivate, -3);
        } else {
            return '***';
        }
    }

    /**
     * Return fields that must be privated
     *
     * @param string|null $listOfFiesdsToPrivate
     * @return array
     */
    protected function validateFieldsToPrivate($listOfFiesdsToPrivate)
    {
        if (isset($listOfFiesdsToPrivate) === false) {
            return [];
        }

        $name = ['accountHolderName','fullName','username'];
        $phone = ['phone','confirmationPhone',];
        $email = ['confirmationEmail','email'];
        $address = ['streetAddress','unit','postalCode','city','provinceCode','countryCode'];
        $fiesdsToPrivate = explode(',', $listOfFiesdsToPrivate);

        if (empty($fiesdsToPrivate) === true || $fiesdsToPrivate === false) {
            return [];
        }

        $formatedFieldsToPrivate = [];

        foreach ($fiesdsToPrivate as $field) {
            if ($field === 'name') {
                $formatedFieldsToPrivate = array_merge($formatedFieldsToPrivate, $name);
            }

            if ($field === 'phone') {
                $formatedFieldsToPrivate = array_merge($formatedFieldsToPrivate, $phone);
            }

            if ($field === 'email') {
                $formatedFieldsToPrivate = array_merge($formatedFieldsToPrivate, $email);
            }

            if (in_array($field, $address)) {
                $formatedFieldsToPrivate[] = $field;
            }
        }

        return $formatedFieldsToPrivate;
    }
}
