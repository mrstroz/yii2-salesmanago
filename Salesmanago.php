<?php

namespace magicalella\salesmanago;

use yii\base\Component;
use yii\base\InvalidConfigException;

/**
 * Class Salesmanago
 * Salesmanago component
 * @package mrstroz\salesmanago
 *
 * @author Mariusz Stróż <info@inwave.pl>
 */
class Salesmanago extends Component
{

    /**
     * @var string Can be found under „Integration” menu of „Settings” section
     */
    public $clientId;

    /**
     * @var string Random pice of string
     */
    public $apiKey;

    /**
     * @var string Can be found under „Integration” section in application menu
     */
    public $apiSecret;

    /**
     * @var string
     */
    public $endpoint;


    /**
     * @throws InvalidConfigException
     */
    public function init()
    {
        if (!$this->clientId) {
            throw new InvalidConfigException('$clientId not set');
        }

        if (!$this->apiKey) {
            throw new InvalidConfigException('$apiKey not set');
        }

        if (!$this->apiSecret) {
            throw new InvalidConfigException('$apiSecret not set');
        }

        if (!$this->endpoint) {
            throw new InvalidConfigException('$endpoint not set');
        }

        parent::init();
    }

    /**
     * Call SALESmanago function
     * @param string $call Name of API function to call
     * @param array $data
     * @return \stdClass Salesmanago response
     */
    public function call($call, $data)
    {
        $data = array_merge(
            array(
                'clientId' => $this->clientId,
                'apiKey' => $this->apiKey,
                'requestTime' => time(),
                'sha' => sha1($this->apiKey . $this->clientId . $this->apiSecret),
            ),
            $data
        );

        $json = json_encode($data);
        $result = $this->curl('http://' . $this->endpoint . '/api/' . $call, $json);
        return json_decode($result);
    }

    /**
     * Do request by CURL
     * @param $url
     * @param $data
     * @return mixed
     */
    private function curl($url, $data)
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen($data)
            )
        );

        return curl_exec($ch);
    }


}
