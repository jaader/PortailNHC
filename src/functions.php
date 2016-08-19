<?php

    function sendcmd($in, $address, $service_port)
    {
        /* Create a TCP/IP socket. */
        $socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
        if ($socket === false) {
            return "socket_create() failed: reason: " . socket_strerror(socket_last_error()) . "\n";
        }

        $result = socket_connect($socket, $address, $service_port);
        if ($result === false) {
            return "socket_connect() failed.\nReason: ($result) " . socket_strerror(socket_last_error($socket)) . "\n";
        }
    
        socket_write($socket, $in, strlen($in));
        $mess = "";
        sleep(1);
    
		while(0 != socket_recv($socket, $out, 4096, MSG_DONTWAIT)){ 
		if($out != null) 
			$mess .= $out; 
		}; 
		
        socket_close($socket);
        return $mess;
    }

    function GetLocations($addr, $port)
    {
        $in = json_encode(array(
        'cmd' => 'listlocations'
        ));
        $message = sendcmd($in,$addr, $port);
        $obj = json_decode ($message, true);
        $dat = $obj['data']; 
        return $dat;
    }

    function GetActions($addr, $port)
    {
        $in = json_encode(array(
        'cmd' => 'listactions'
        ));
        $message = sendcmd($in,$addr, $port);
        $obj = json_decode ($message, true);
        $dat = $obj['data'];  
        return $dat;
    }

    function LaunchActionOnOff($actID, $value, $addr, $port)
    {
        $in = json_encode(array(
            'cmd' => 'executeactions',
            'id' => $actID,
            'value1' => $value
        ));
        $message = sendcmd($in, $addr, $port);
        $obj = json_decode ($message, true);
        $dat = $obj['data'];  
        return $dat['error'];
    }
?>