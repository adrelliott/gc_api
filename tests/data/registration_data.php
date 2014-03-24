<?php

// mocks PimCore adding a new contact

// Data to add - EDIT THIS DATA FOR THE TEST
$data = array(
    'step_1' => array(  
        'firstName' => 'Al6', //its just this and the email that needs to change to create a new contact record
        'surname' => 'Elliott6',
        'emailAddress' => 'al6@dallasmatthews.co.uk',
        'contactNumber' => '07703345633',
        'promoCode' => '',
        'facebookUid' => 'xfxfxfx',
        'tag_newmember' => 1,
        'subscriptionType'=> 'Free',
    ),
    'step_2' => array(
        // Billing address
        'addressLine1' => '1 Pretend Street',
        'addressLine2' => 'Pretendton',
        'city' => 'Makebelieveville',
        'region' => 'Fictionshire',
        'postcode' => 'NO7 R3AL',
        'country' => 'Magikestan2',
        'crmId' => 35,

        // Subscription details
        'subscriptionType' => 'Anytime',   // Is this the product name?
        'trialPeriod' => 'P10D',
        'subscriptionPeriod' => 'P1M', // or P1Y
        'subscriptionFee' => 5.95, // is this with the £?
        'subscriptionProduct' => 'Anytime Monthly',     //Can Ripple add this

        // Tags
        'tag_trial' => 1,
    ),
    'step_3' => array(
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












