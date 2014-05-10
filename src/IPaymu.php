<?php
/**
 * User: gamalan
 * Date: 5/10/14
 * Time: 5:09 PM
 */

namespace Ipaymu;


class IPaymu
{
    /**
     * @var string
     */
    protected $key = "";

    /**
     * Constructor
     * @param string $key
     * @throws \InvalidArgumentException
     */
    public function __construct($key)
    {
        if (!is_string($key) || !strlen($key) > 1) {
            throw new \InvalidArgumentException("api key is not provided");
        }
        $this->key = $key;
    }

    /**
     * CheckBalance
     * @param string $format
     * @return array|mixed|null
     * @throws \InvalidArgumentException
     * @throws \Exception
     */
    public function checkBalance($format = 'json')
    {
        if (strcmp($format, 'json') != 0 && strcmp($format, 'xml') != 0) {
            throw new \InvalidArgumentException("Support only json/xml format");
        }

        $params = new Params();
        $paramstring = $params->setKey($this->key)
            ->setFormatResult($format)->buildAsGetString();

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, Resource::$BALANCE . $paramstring);

        $resultraw = curl_exec($curl);
        if ($resultraw == false) {
            throw new \Exception("CURL error : " . curl_error($curl), curl_errno($curl));
        } else {
            $result = null;
            if (strcmp($format, 'json') == 0) {
                $result = json_decode($resultraw, true);
            } else {
                /**
                 * @var \SimpleXMLElement
                 */
                $resulttemp = simplexml_load_string($resultraw);
                $result = array();
                foreach ($resulttemp->children() as $child) {
                    /**
                     * @var \SimpleXMLElement $child
                     */
                    $result[$child->getName()] = (string)$child;
                }
            }
            return $result;
        }
    }

    /**
     * Check Other Balance
     * @param string $key
     * @param string $format
     * @return array|mixed|null
     * @throws \InvalidArgumentException
     * @throws \Exception
     */
    public function checkOtherBalance($key, $format = 'json')
    {
        if (strcmp($format, 'json') != 0 && strcmp($format, 'xml') != 0) {
            throw new \InvalidArgumentException("Support only json/xml format");
        }
        if (!is_string($key) || !strlen($key) > 1) {
            throw new \InvalidArgumentException("Key is not defined");
        }

        $params = new Params();
        $paramstring = $params->setKey($this->key)
            ->setFormatResult($format)->buildAsGetString();

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, Resource::$BALANCE . $paramstring);

        $resultraw = curl_exec($curl);
        if ($resultraw == false) {
            throw new \Exception("CURL error : " . curl_error($curl), curl_errno($curl));
        } else {
            $result = null;
            if (strcmp($format, 'json') == 0) {
                $result = json_decode($resultraw, true);
            } else {
                /**
                 * @var \SimpleXMLElement
                 */
                $resulttemp = simplexml_load_string($resultraw);
                $result = array();
                foreach ($resulttemp->children() as $child) {
                    /**
                     * @var \SimpleXMLElement $child
                     */
                    $result[$child->getName()] = (string)$child;
                }
            }
            return $result;
        }
    }

    /**
     * CheckTransaction
     * @param $trxid
     * @param string $format
     * @return array|mixed|null
     * @throws \InvalidArgumentException
     * @throws \Exception
     */
    public function checkTransaction($trxid, $format = 'json')
    {
        if (strcmp($format, 'json') != 0 && strcmp($format, 'xml') != 0) {
            throw new \InvalidArgumentException("Support only json/xml format");
        }
        if (!is_string($trxid) || !strlen($trxid) > 1) {
            throw new \InvalidArgumentException("Transaction id is not defined");
        }

        $params = new Params();
        $paramstring = $params->setKey($this->key)
            ->setTransactionID($trxid)
            ->setFormatResult($format)->buildAsGetString();

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, Resource::$TRANSACTION . $paramstring);

        $resultraw = curl_exec($curl);
        if ($resultraw == false) {
            throw new \Exception("CURL error : " . curl_error($curl), curl_errno($curl));
        } else {
            $result = null;
            if (strcmp($format, 'json') == 0) {
                $result = json_decode($resultraw, true);
            } else {
                /**
                 * @var \SimpleXMLElement
                 */
                $resulttemp = simplexml_load_string($resultraw);
                $result = array();
                foreach ($resulttemp->children() as $child) {
                    /**
                     * @var \SimpleXMLElement $child
                     */
                    $result[$child->getName()] = (string)$child;
                }
            }
            return $result;
        }
    }

    /**
     * Check user status
     * @param $user
     * @param string $format
     * @return array|mixed|null
     * @throws \InvalidArgumentException
     * @throws \Exception
     */
    public function checkStatus($user, $format = 'json')
    {
        if (strcmp($format, 'json') != 0 && strcmp($format, 'xml') != 0) {
            throw new \InvalidArgumentException("Support only json/xml format");
        }
        if (!is_string($user) || !strlen($user) > 1) {
            throw new \InvalidArgumentException("User is not defined");
        }

        $params = new Params();
        $paramstring = $params->setKey($this->key)
            ->setUser($user)
            ->setFormatResult($format)->buildAsGetString();

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, Resource::$STATUS . $paramstring);

        $resultraw = curl_exec($curl);
        if ($resultraw == false) {
            throw new \Exception("CURL error : " . curl_error($curl), curl_errno($curl));
        } else {
            $result = null;
            if (strcmp($format, 'json') == 0) {
                $result = json_decode($resultraw, true);
            } else {
                /**
                 * @var \SimpleXMLElement
                 */
                $resulttemp = simplexml_load_string($resultraw);
                $result = array();
                foreach ($resulttemp->children() as $child) {
                    /**
                     * @var \SimpleXMLElement $child
                     */
                    $result[$child->getName()] = (string)$child;
                }
            }
            return $result;
        }
    }

    /**
     * generate payment url without paypal integration
     * @param string $product
     * @param $price
     * @param string $ureturn
     * @param string $unotify
     * @param string $ucancel
     * @param int $quantity
     * @param string $comments
     * @param string $format
     * @param string $action
     * @return array|mixed|null
     * @throws \UnexpectedValueException
     * @throws \InvalidArgumentException
     * @throws \Exception
     */
    public function generatePaymentSessionWithoutPaypal($product, $price, $ureturn, $unotify, $ucancel, $quantity = 1, $comments = "No comments", $format = 'json', $action = 'payment')
    {
        if (strcmp($format, 'json') != 0 && strcmp($format, 'xml') != 0) {
            throw new \InvalidArgumentException("Support only json/xml format");
        }
        if (strcmp($action, 'payment') != 0) {
            throw new \UnexpectedValueException("Unsupported action");
        }
        if (!is_string($product) || !strlen($product) > 1) {
            throw new \InvalidArgumentException("Product is not defined");
        }
        if (!is_string($unotify) || !strlen($unotify) > 1) {
            throw new \InvalidArgumentException("Notify URI is not defined");
        }
        if (!is_string($ucancel) || !strlen($ucancel) > 1) {
            throw new \InvalidArgumentException("Cancel URI is not defined");
        }
        if (!is_string($ureturn) || !strlen($ureturn) > 1) {
            throw new \InvalidArgumentException("Return URI is not defined");
        }
        if (!is_numeric($price)) {
            throw new \InvalidArgumentException("Price is not defined");
        }
        if (!is_int($quantity)) {
            throw new \InvalidArgumentException("Quantity is not defined");
        }

        $params = new Params();
        $paramsbuild = $params->setKey($this->key)
            ->setProductName($product)
            ->setProductPrice($price)
            ->setQuantity($quantity)
            ->setAction($action)
            ->setNotifyURI($unotify)
            ->setReturnURI($ureturn)
            ->setCancelURI($ucancel)
            ->setComments($comments)
            ->setFormatResult($format)->buildAsHTTPParams();

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, Resource::$PAYMENT);
        curl_setopt($curl, CURLOPT_POST, $params->getParamsCount());
        curl_setopt($curl, CURLOPT_POSTFIELDS, $paramsbuild);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);

        $resultraw = curl_exec($curl);
        if ($resultraw == false) {
            throw new \Exception("CURL error : " . curl_error($curl), curl_errno($curl));
        } else {
            $result = null;
            if (strcmp($format, 'json') == 0) {
                $result = json_decode($resultraw, true);
            } else {
                /**
                 * @var \SimpleXMLElement
                 */
                $resulttemp = simplexml_load_string($resultraw);
                $result = array();
                foreach ($resulttemp->children() as $child) {
                    /**
                     * @var \SimpleXMLElement $child
                     */
                    $result[$child->getName()] = (string)$child;
                }
            }
            return $result;
        }
    }

    /**
     * generate payment url with paypal integration
     * @param $product
     * @param $price
     * @param $inv_number
     * @param $paypal_email
     * @param $paypal_price
     * @param $ureturn
     * @param $unotify
     * @param $ucancel
     * @param int $quantity
     * @param string $comments
     * @param string $format
     * @param string $action
     * @return array|mixed|null
     * @throws \UnexpectedValueException
     * @throws \InvalidArgumentException
     * @throws \Exception
     */
    public function generatePaymentSessionWithPaypal($product, $price, $inv_number, $paypal_email, $paypal_price, $ureturn, $unotify, $ucancel, $quantity = 1, $comments = "No comments", $format = 'json', $action = 'payment')
    {
        if (strcmp($format, 'json') != 0 && strcmp($format, 'xml') != 0) {
            throw new \InvalidArgumentException("Support only json/xml format");
        }
        if (strcmp($action, 'payment') != 0) {
            throw new \UnexpectedValueException("Unsupported action");
        }
        if (!is_string($product) || !strlen($product) > 1) {
            throw new \InvalidArgumentException("Product is not defined");
        }
        if (!is_string($unotify) || !strlen($unotify) > 1) {
            throw new \InvalidArgumentException("Notify URI is not defined");
        }
        if (!is_string($ucancel) || !strlen($ucancel) > 1) {
            throw new \InvalidArgumentException("Cancel URI is not defined");
        }
        if (!is_string($ureturn) || !strlen($ureturn) > 1) {
            throw new \InvalidArgumentException("Return URI is not defined");
        }
        if (!is_string($paypal_email) || !strlen($paypal_email) > 1) {
            throw new \InvalidArgumentException("Paypal Email is not defined");
        }
        if (!is_string($inv_number) || !strlen($inv_number) > 1) {
            throw new \InvalidArgumentException("Invoice Number is not defined");
        }
        if (!is_numeric($price)) {
            throw new \InvalidArgumentException("Price is not defined");
        }
        if (!is_numeric($paypal_price)) {
            throw new \InvalidArgumentException("Paypal Price is not defined");
        }
        if (!is_int($quantity)) {
            throw new \InvalidArgumentException("Quantity is not defined");
        }

        $params = new Params();
        $paramsbuild = $params->setKey($this->key)
            ->setProductName($product)
            ->setProductPrice($price)
            ->setQuantity($quantity)
            ->setAction($action)
            ->setNotifyURI($unotify)
            ->setReturnURI($ureturn)
            ->setCancelURI($ucancel)
            ->setComments($comments)
            ->setInvoiceNumber($inv_number)
            ->setPaypalAddress($paypal_email)
            ->setPaypalPrice($paypal_price)
            ->setFormatResult($format)->buildAsHTTPParams();

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, Resource::$PAYMENT);
        curl_setopt($curl, CURLOPT_POST, $params->getParamsCount());
        curl_setopt($curl, CURLOPT_POSTFIELDS, $paramsbuild);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);

        $resultraw = curl_exec($curl);
        if ($resultraw == false) {
            throw new \Exception("CURL error : " . curl_error($curl), curl_errno($curl));
        } else {
            $result = null;
            if (strcmp($format, 'json') == 0) {
                $result = json_decode($resultraw, true);
            } else {
                /**
                 * @var \SimpleXMLElement
                 */
                $resulttemp = simplexml_load_string($resultraw);
                $result = array();
                foreach ($resulttemp->children() as $child) {
                    /**
                     * @var \SimpleXMLElement $child
                     */
                    $result[$child->getName()] = (string)$child;
                }
            }
            return $result;
        }
    }
}