<?php

// Pass crmId - in URL
if ( isset($_GET['crmId']) ) $crmId = $_GET['crmId'];
else $crmId = rand(100, 1000);

// mocks PimCore Profile 

// Data to add - EDIT THIS DATA FOR THE TEST
$data = array(
     // My Details
    'tab_1' => array( 
        'firstName' => 'Al' . $crmId, //its just this and the email that needs to change to create a new contact record
        'surname' => 'Elliott' . $crmId,
        'emailAddress' => 'al' . $crmId . '@dallasmatthews.co.uk',
        'dob' => '',
        'gender' => 'female',
        'facebookUid' => 'xfxfxfx_1',
        'addressLine1' => 'Updated via API',
        'addressLine2' => 'Updated via API',
        'city' => 'Makebelieveville',
        'region' => 'Fictionshire',
        'postcode' => 'NO' . $crmId . 'R3AL',
        'country' => 'Magikestan2',
        'receiveThirdParty' => 1, //Yes',
        'receiveNewsletter'=> 0, //'No',
        'crmId' => $crmId,

        // Tags
    ),

    // My Fitness
    'tab_2' => array(
        'fitnessLevel' => '1. Beginner' . $crmId,
        'primaryGoal' => 'Balance' . $crmId,
        'secondaryGoal' => 'Definition' . $crmId,
        'crmId' => $crmId,

        // Tags
        // 'tag_trial' => 1,
    ),

    // My Subscription
    'tab_3' => array(
        // The only option is to remove subscription
        'crmId' => $crmId,

        // Tags
        // 'tag_trial' => 1,
        
    ),

    // My Favourites
    'tab_4' => array(
        // Ancillary info
        'crmId' => $crmId,
        
    ),

    // My progress
    'tab_5' => array(
        // Ancillary info
        'crmId' => $crmId,
        
    ),
);

// Submit this to 












