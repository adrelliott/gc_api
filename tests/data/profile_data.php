<?php

// mocks PimCore Profile 

// Data to add - EDIT THIS DATA FOR THE TEST
$data = array(
     // My Details
    'tab_1' => array( 
        'firstName' => 'Al6', //its just this and the email that needs to change to create a new contact record
        'surname' => 'Elliott6',
        'emailAddress' => 'al6@dallasmatthews.co.uk',
        'dob' => '',
        'gender' => 'female',
        'facebookUid' => 'xfxfxfx_1',
        'addressLine1' => '1 Pretend Street',
        'addressLine2' => 'Pretendton',
        'city' => 'Makebelieveville',
        'region' => 'Fictionshire',
        'postcode' => 'NO7 R3AL',
        'country' => 'Magikestan2',
        'receiveThirdParty' => 1, //Yes',
        'receiveNewsletter'=> 0, //'No',
        'crmId' => 35,

        // Tags
    ),

    // My Fitness
    'tab_2' => array(
        'fitnessLevel' => '1. Beginner2',
        'primaryGoal' => 'Balance2',
        'secondaryGoal' => 'Definition2',
        'crmId' => 35,

        // Tags
        // 'tag_trial' => 1,
    ),

    // My Subscription
    'tab_3' => array(
        // The only option is to remove subscription
        'crmId' => 35,

        // Tags
        // 'tag_trial' => 1,
        
    ),

    // My Favourites
    'tab_4' => array(
        // Ancillary info
        'crmId' => 35,
        'dob' => '1977-05-25', //how is this stored?
        'gender' => 'female', //lowercase
        'fitnessLevel' => '1. Beginner',
        'primaryGoal' => 'Balance',
        'secondaryGoal' => 'Definition'
    ),

    // My progress
    'tab_5' => array(
        // Ancillary info
        'crmId' => 35,
        'dob' => '1977-05-25', //how is this stored?
        'gender' => 'female', //lowercase
        'fitnessLevel' => '1. Beginner',
        'primaryGoal' => 'Balance',
        'secondaryGoal' => 'Definition'
    ),
);

// Submit this to 












