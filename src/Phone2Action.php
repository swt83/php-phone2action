<?php

namespace Travis;

class Phone2Action
{
    /**
     * Make an API request.
     *
     * @param   string  $api_app_id
     * @param   string  $api_app_key
     * @param   string  $method
     * @param   string  $type
     * @param   array   $arguments
     * @param   int     $timeout
     * @return  array
     */
    public static function run($api_app_id, $api_app_key, $method, $type, $arguments = [], $timeout = 30)
    {
        // set endpoint
        $url = 'https://api.phone2action.com/2.0/'.$method.'?'.http_build_query($arguments);

        // build auth string
        $auth = $api_app_id.':'.$api_app_key;

        // make curl request
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_TIMEOUT, $timeout);
        curl_setopt($ch, CURLOPT_USERPWD, $auth);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
        if (in_array(strtoupper($type), ['POST', 'PUT']))
        {
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($arguments));
        }
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, strtoupper($type));
        $response = curl_exec($ch);
        $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        // catch errors...
        if (curl_errno($ch))
        {
            #$errors = curl_error($ch);

            $result = false;
        }

        // else if NO errors...
        else
        {
            // decode
            $result = json_decode($response);
        }

        // close
        curl_close($ch);

        // return
        return $result;
    }
}