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

    $NHCLoc = GetLocations($address, $service_port);
    $NHCAct = GetActions($address, $service_port);
		
    include ('design.php');

    headHTML();

    topHTML();

    //menu
    echo '<li><a href="index.php">Home</a></li>';
    echo '<li><a href="allume.php">allume</a></li>';
	
	foreach ($NHCLoc as $locMenu)
    {
        if ($locMenu['name'] != '')
        {
            echo '<li><a href="#z'.$locMenu['id'].'" class="more scrolly">'.$locMenu['name'].'</a></li>';
        }
    }
	
	
	echo '<li><a href="debug.php">debug</a></li>';
	
    topHTML2();
    

    //locations

    echo '<section id="locations" class="wrapper alt style2">';
	

    Foreach ( $NHCLoc as $location)
	{
        if ($location['name'] != '')
        {
                echo '<section id="z'.$location['id'].'"class="spotlight">';
		        echo '<div class="image"><img src="images/z'.$location['id'].'.jpg" alt="" /></div><div class="content">';
                echo '<div class="box alt">
                      <div class="row center uniform 50%">
                      <div class="12u"><h2>'.$location['name'].'</h2></div>';
                
                $locID = $location['id'];
                Foreach ( $NHCAct as $action)
		        {
			        If ($action['location'] == $locID && ($action['type']==1 or $action['type']==0) )
			        {

                        $v = "";
                        if ($action['type']==1 && $action['value1'] == 100)
                        {    $v = 0;
                        	 $bt = ' special">On';
                        }
						elseif ($action['type']==1 && $action['value1'] == 0) 
                        {	 $v = 100;
                        	 $bt = '">Off';
                        }
						elseif ($action['type']==0)
						{	 $v = 100;
						 	 $bt = ' special">On';
						}

                        if (strlen($action['name'])>=18)
                        {
                            $actnam = substr ($action['name'],0,15) ."...";
                        }else{ 
                            $actnam = $action['name'];
                        }
				        echo '<div class="3u">'.$actnam;
                        echo '<a href="index.php?actid='.$action['id'].'&value='.$v.'" class="button fit small'.$bt;
                        echo '</a></div>';                
			        }
		        }
                echo '                                             </div>
                                                  </div>

							        </div>
						        </section>';
        }
	}


    footerHTML();




}

?>