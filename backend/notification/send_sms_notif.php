<?php
    $ch = curl_init();
    $parameters = array(
        'apikey' => 'aaa9b8eaeccc90902e6d299bac9c645a', 
        'number' => $user['contact_num'],
        'message' => $message,
        'sendername' => 'E-Learning: '.$user['subject_group_name']
    );
    curl_setopt( $ch, CURLOPT_URL,'https://semaphore.co/api/v4/messages' );
    curl_setopt( $ch, CURLOPT_POST, 1 );
    
    //Send the parameters set above with the request
    curl_setopt( $ch, CURLOPT_POSTFIELDS, http_build_query( $parameters ) );
    
    // Receive response from server
    curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
    $output = curl_exec( $ch );
    curl_close ($ch);
    
    //Show the server response
    echo $output;
?>