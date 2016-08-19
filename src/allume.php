<?php

include ('config.php');
include ('functions.php');

if (isset($_GET['actid']) AND isset($_GET['value'])) // action a faire
{
    $page = $_SERVER['PHP_SELF'];
	$page2 = $_SERVER["HTTP_REFERER"];
	
	$sec = "1";
    header("Refresh: $sec; url=$page2");

	$actID =  $_GET['actid'];
	$value =  $_GET['value'];
	$retour = LaunchActionOnOff($actID, $value, $address, $service_port);
	if ($retour != 0){
    echo "ERROR :".$retour."<br><br>";	}
} else{

    $page = $_SERVER['PHP_SELF'];
	$sec = "600";
    header("Refresh: $sec; url=$page");

    $NHCLoc = GetLocations($address, $service_port);
    $NHCAct = GetActions($address, $service_port);
    include ('design.php');

    headHTML();


    echo '<section id="locations" class="wrapper alt style2">';
	echo '<section id="allume"class="spotlight">';
	echo '<div class="image"><img src="images/z0.jpg" alt="" /></div><div class="content">';
    echo '<div class="box alt">
          <div class="row center uniform 50%">
          <div class="12u"><h2>allumé</h2></div>';
                
    Foreach ( $NHCAct as $action)
		        {
			        If ($action['value1'] == 100 && $action['type']==1 )
			        {

                        $v = "";
                        if ($action['type']==1 && $action['value1'] == 100)
                        {    $v = 0;}
						elseif ($action['type']==1 && $action['value1'] == 0) 
                        {	 $v = 100;}
						elseif ($action['type']==0)
						{	 $v = 100;}

                        if (strlen($action['name'])>=18)
                        {
                            $actnam = substr ($action['name'],0,15) ."...";
                        }else{ 
                            $actnam = $action['name'];
                        }
                        $actloc = '';
						Foreach ( $NHCLoc as $location)
						{
							if ($location['id'] == $action['location'])
							{
							$actloc = $location['name'];
							}
							
						}
    

				        echo '<div class="3u">'.$actnam.' ('.$actloc.')' ;
                        echo '<a href="index.php?actid='.$action['id'].'&value='.$v.'" class="button fit small';
                
                        if ($v==0)
                        {
                            echo ' special">On';
                    
                        }elseif ($v==100)
                        {
                            echo '">Off';
                        }

                
                        echo '</a></div>';
    
    		        }
		        }
                echo '                                             </div>
                                                  </div>

							        </div>
						        </section>';
    
    footerHTML();

}

?>