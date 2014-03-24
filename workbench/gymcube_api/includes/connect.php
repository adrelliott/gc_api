<?php 

// include the iSDK & Instantiate
require_once('infusionsoft/isdk.php');
$app = new iSDK();

// Initiate a connection and test it
if ( ! $result = $app->cfgcon('gymcube') )
{
    echo '<small class="error">API Connection failed!</small><br/>';
    var_dump($result);    
}

include('includes/config.php');
