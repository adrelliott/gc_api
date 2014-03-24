<?php

if ( isset($_GET['ID']) )
{
    // Connect to infusion
    include('includes/connect.php');

    $record = $app->loadCon( $_GET['ID'], array_keys($cols) );
    die($record);
    $r = array_merge($_GET, $record);
}
else $r = array_merge($cols, $_GET);