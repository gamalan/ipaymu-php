<?php
/**
 * User: gamalan
 * Date: 5/10/14
 * Time: 3:31 PM
 */

namespace Ipaymu;


class Params {
    /**
     * @var array
     */
    private $params = array();

    /**
     * Constructor
     */
    public function __construct(){
        $this->params = array();
        $this->params['format'] = 'json';
    }

    /**
     * add key parameter
     * @param string $value
     * @return $this
     */
    public function setKey($value){
        $this->params['key'] = $value;
        return $this;
    }

    /**
     * change format result, default is json
     * @param string $value
     * @return $this
     */
    public function setFormatResult($value="json"){
        $this->params['format'] = $value;
        return $this;
    }

    /**
     * set transaction to be checked
     * @param string $value
     * @return $this
     */
    public function setTransactionID($value){
        $this->params['id'] = $value;
        return $this;
    }

    /**
     * set user to be checked
     * @param string $value
     * @return $this
     */
    public function setUser($value){
        $this->params['user'] = $value;
        return $this;
    }

    /**
     * set action to do, default is 'payment'
     * @param string $value
     * @return $this
     */
    public function setAction($value='payment'){
        $this->params['action'] = $value;
        return $this;
    }

    /**
     * set product name
     * @param string $product
     * @return $this
     */
    public function setProductName($product){
        $this->params['product'] = $product;
        return $this;
    }

    /**
     * set product price (using Indonesia Rp value)
     * @param $value
     * @return $this
     */
    public function setProductPrice($value){
        $this->params['price'] = $value;
        return $this;
    }

    /**
     * set product quantity
     * @param int $value
     * @return $this
     */
    public function setQuantity($value=1){
        $this->params['quantity'] = $value;
        return $this;
    }

    /**
     * set transaction comments
     * @param $value
     * @return $this
     */
    public function setComments($value){
        $this->params['comments'] = $value;
        return $this;
    }

    /**
     * set notify url
     * @param string $value
     * @return $this
     */
    public function setNotifyURI($value){
        $this->params['unotify'] = $value;
        return $this;
    }

    /**
     * set return uri
     * @param string $value
     * @return $this
     */
    public function setReturnURI($value){
        $this->params['ureturn'] = $value;
        return $this;
    }

    /**
     * set cancel uri
     * @param string $value
     * @return $this
     */
    public function setCancelURI($value){
        $this->params['ucancel'] = $value;
        return $this;
    }

    /**
     * set invoice number, if paypal is enabled
     * @param string $value
     * @return $this
     */
    public function setInvoiceNumber($value){
        $this->params['invoice_number'] = $value;
        return $this;
    }

    /**
     * set email used in paypal integration
     * @param string $value
     * @return $this
     */
    public function setPaypalAddress($value){
        $this->params['paypal_email'] = $value;
        return $this;
    }

    /**
     * set price used in paypal integration(using USD value)
     * @param $value
     * @return $this
     */
    public function setPaypalPrice($value){
        $this->params['paypal_price'] = $value;
        return $this;
    }

    /**
     * build as get string (key=yourkey&format=json&....)
     * @return string
     */
    public function buildAsGetString(){
        $result = "";
        $i = 0;
        $length = count($this->params);
        foreach($this->params as $key => $values){
            $result .= $key."=".$values;
            if($i+1<$length){
                $result .= "&";
                $i++;
            }
        }
        return $result;
    }

    /**
     * build as http params
     * @return string
     */
    public function buildAsHTTPParams(){
        return http_build_query($this->params);
    }

    /**
     * get params count
     * @return int
     */
    public function getParamsCount(){
        return count($this->params);
    }
} 