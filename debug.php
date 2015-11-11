<?php

include ('config.php');

function build_table($array){
    // start table
    $html = '<table>';
    // header row
    $html .= '<tr>';
    foreach($array[0] as $key=>$value){
        $html .= '<th>' . $key . '</th>';
    }
    $html .= '</tr>';
    // data rows
    foreach( $array as $key=>$value){
        $html .= '<tr>';
        foreach($value as $key2=>$value2){
            $html .= '<td>' . $value2 . '</td>';
        }
        $html .= '</tr>';
    }
    // finish table and return it
    $html .= '</table>';
    return $html;
}

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
    /*$next = "";*/
    sleep(1);
    
    /*$next = socket_read($socket, 4096);*/
	
	while(0 != socket_recv($socket, $out, 4096, MSG_DONTWAIT)){ 
	if($out != null) 
		$mess .= $out; 
	}; 
	
    /*$mess .= $next;*/
    
    socket_close($socket);
    return $mess;
}

function GetLocations($addr, $port)
{
    $in = json_encode(array(
    'cmd' => 'listlocations'
    ));

    $message = sendcmd($in,$addr, $port);
    $obj = json_decode ($message);
    $dat = $obj->{'data'}; 

    return $dat;

}

function GetActions($addr, $port)
{
    $in = json_encode(array(
    'cmd' => 'listactions'
    ));

    $message = sendcmd($in,$addr, $port);
    $obj = json_decode ($message);
    $dat = $obj->{'data'}; 

    return $dat;

}



$NHCLoc = GetLocations($address, $service_port);
$aff = build_table($NHCLoc);
echo $aff."<br>";

$NHCAct = GetActions($address, $service_port);
$aff = build_table($NHCAct);
echo $aff;


?>