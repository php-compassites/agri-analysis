<?php

namespace App\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\ConnectException;
use GuzzleHttp\Exception\RequestException;

abstract class AbstractService
{
    /**
     * @var
     */
    protected $host;

    /**
     * Set the Host
     * @return mixed
     */
    public function getHost()
    {
        return $this->host;
    }

    /**
     * Get the Host
     *
     * @param mixed $host
     */
    public function setHost($host)
    {
        $this->host = $host;

        return $this;
    }

    /**
     * Performs a Guzzle GET Call
     *
     * @param $url
     *
     * @return mixed|string
     */
    protected function getGuzzleRequest($url, $token = null)
    {
        try {
            if (!$this->host) {
                throw new \Exception('Set Base Host name');
            }

            $client = new Client([
                'base_uri' => $this->host,
            ]);

            if ($token) {
                $response = $client->request('GET', $url, [
                    'headers' => [
                        'Content-Type' => 'application/json',
                        'Authorization' => 'Bearer ' . $token
                    ]
                ]);
            } else {
                $response = $client->request('GET', $url);
            }


            $data = $response->getBody()->getContents();
            $data = json_decode($data, true);

            return $data;
        } catch (ClientException $e) {
            dd($e->getResponse()->getBody()->getContents());
            return [];
            // dd($e->getMessage());
        } catch (ConnectException $e) {
            dd($e->getResponse()->getBody()->getContents());
            return [];
            // dd($e->getMessage());
        } catch (RequestException $e) {
            dd($e->getResponse()->getBody()->getContents());
            return [];
            // dd($e->getMessage());
        } catch (\Exception $e) {
            dd($e->getResponse()->getBody()->getContents());
            return [];
            // dd($e->getMessage());
        }
    }

    /**
     * Performs a Guzzle POST Call
     *
     * @param $url
     * @param $postData
     *
     * @return mixed|string
     */
    protected function postGuzzleRequest($url, $postData, $token = null)
    {
        try {
            if (!$this->host) {
                throw new \Exception('Set Base Host name');
            }

            $client = new Client([
                'base_uri' => $this->host,
            ]);

            if ($token) {
                $response = $client->request('POST', $url, [
                    'headers' => [
                        'Authorization' => 'Bearer ' . $token
                    ],
                    'form_params' => $postData,
                ]);
            } else {
                $response = $client->request('POST', $url, [
                    'form_params' => $postData,
                ]);
            }



            $data = $response->getBody()->getContents();
            $data = json_decode($data, true);

            return $data;
        } catch (ClientException $e) {
            // return [];
            dd($e->getResponse()->getBody()->getContents());
            // dd(get_class_methods($e->getResponse()));
            // dd(get_class_methods($e));
            // dd($e->getTrace());
        } catch (ConnectException $e) {
            // return [];
            dd($e->getResponse()->getBody()->getContents());
            // dd($e->getTrace());

            // dd($e->getMessage());
        } catch (RequestException $e) {
            // return [];
            dd($e->getResponse()->getBody()->getContents());
            // dd($e->getTrace());

            // dd($e->getMessage());
        } catch (\Exception $e) {
            // return [];
            // dd($e->getResponse()->getBody()->getContents());
            // dd($e->getTrace());

            dd($e->getMessage());
        }
    }
}
