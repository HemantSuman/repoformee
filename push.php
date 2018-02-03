<?php
    
    
    $deviceToken = 'fd2d289a9083509d80a6120456d92bb32b1301be5eec24b296400aefd3fdba56';

    $passphrase = '12345';

    $message = 'A push notification has been sent!';
    ////////////////////////////////////////////////////////////////////////////////
    $ctx = stream_context_create();
    stream_context_set_option($ctx, 'ssl', 'local_cert', 'Certificates.pem');
    stream_context_set_option($ctx, 'ssl', 'passphrase', $passphrase);

    $fp = stream_socket_client('ssl://gateway.sandbox.push.apple.com:2195', $err, $errstr, 60, STREAM_CLIENT_CONNECT|STREAM_CLIENT_PERSISTENT, $ctx);
    if (!$fp)
    exit("Failed to connect: $err $errstr" . PHP_EOL);
    echo 'Connected to APNS' . PHP_EOL;

    $body['aps'] = array(
                         'alert' =>  $message,
                         'badge' => 0,
                         'sound' => 'default',
                         );

    $payload = json_encode($body);
    $msg = chr(0) . pack('n', 32) . pack('H*', $deviceToken) . pack('n', strlen($payload)) . $payload;
    $result = fwrite($fp, $msg, strlen($msg));
    if (!$result)
    echo 'Message not delivered' . PHP_EOL;
    else
    echo 'Message successfully delivered' . PHP_EOL;

    fclose($fp);
    
    
    
    /*// Replace with the real server API key from Google APIs
    $apiKey = "AIzaSyBL87KlyQObBJWy8g8gFh2pEcKVLEFGwNM";

    // Replace with the real client registration IDs
    $registrationIDs = array( "dRKPQ4z90hI:APA91bGLH7oii-7LBtCy6oaeWnL5S2i-s4Ga_0mR4wnffEv5eHUTzIqFwNHWqaPTIsBioqPyme4O_gpuGK6ro-OSuQAAF71E5NUW-RdzNknBsP7-y2o5ut-gPztDCp7bOL2FWlTuPlpH");

    // Message to be sent
    $message = "I am sending test messages.";

    // Set POST variables
    $url = 'https://android.googleapis.com/gcm/send';

    $fields = array(
        'registration_ids' => $registrationIDs,
        'data' => array( "message" => $message ),
    );
    $headers = array(
        'Authorization: key=' . $apiKey,
        'Content-Type: application/json'
    );

    // Open connection
    $ch = curl_init();

    // Set the URL, number of POST vars, POST data
    curl_setopt( $ch, CURLOPT_URL, $url);
    curl_setopt( $ch, CURLOPT_POST, true);
    curl_setopt( $ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true);
    //curl_setopt( $ch, CURLOPT_POSTFIELDS, json_encode( $fields));

    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    // curl_setopt($ch, CURLOPT_POST, true);
    // curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode( $fields));

    // Execute post
    $result = curl_exec($ch);

    // Close connection
    curl_close($ch);
    // print the result if you really need to print else neglate thi
    echo $result;
    //print_r($result);
    //var_dump($result);*/
?>
