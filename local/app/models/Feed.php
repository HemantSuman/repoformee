<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Feed extends Model
{
    /**
     * The Feed that belong to the Feed Category.
     */
    public function feed_category() {
        return $this->belongsTo('App\models\FeedCategory');
    }

    public function get_feeds($feed_url = null) {
        $curl = curl_init();

        curl_setopt_array($curl, array(
          CURLOPT_URL => $feed_url,
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 30,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "GET",
          CURLOPT_POSTFIELDS => "-----011000010111000001101001\r\nContent-Disposition: form-data; name=\"user_id\"\r\n\r\n5\r\n-----011000010111000001101001\r\nContent-Disposition: form-data; name=\"type\"\r\n\r\nyou2\r\n-----011000010111000001101001--",
          CURLOPT_HTTPHEADER => array(
            "cache-control: no-cache",
            "content-type: multipart/form-data; boundary=---011000010111000001101001",
            "postman-token: b1e39ff0-8a10-dee0-2a3b-84abcf18b0cf"
          ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
          return "cURL Error #:" . $err;
        } else {
          return $response;
        }
    }
}
