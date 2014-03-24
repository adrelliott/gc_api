<?php 

$col_map = array(
    'firstName' => array(
        'table_name' => 'Contact',
        'col_name' => 'FirstName'
    ), 
    'surname' => array(
        'table_name' => 'Contact', 
        'col_name' => 'LastName'
    ),
    'emailAddress' => array(
        'table_name' => 'Contact', 
        'col_name' => 'Email'
    ),
    'ContactNumber' => array(
        'table_name' => 'Contact', 
        'col_name' => 'Phone1'
    ),
    'facebookUid' => array(
        'table_name' => 'Contact', 
        'col_name' => '_FacebookUid'
    ),
    'addressLine1' => array(
        'table_name' => 'Contact', 
        'col_name' => 'StreetAddress1'
    ),
    'addressLine2' => array(
        'table_name' => 'Contact', 
        'col_name' => 'StreetAddress2'
    ),
    'city' => array(
        'table_name' => 'Contact', 
        'col_name' => 'City'
    ),
    'region' => array(
        'table_name' => 'Contact', 
        'col_name' => 'State'
    ),
    'postcode' => array(
        'table_name' => 'Contact', 
        'col_name' => 'PostalCode'
    ),
    'country' => array(
        'table_name' => 'Contact', 
        'col_name' => 'Country'
    ),
    'dob' => array(
        'table_name' => 'Contact', 
        'col_name' => 'Birthday'
    ),
    'gender' => array(
        'table_name' => 'Contact', 
        'col_name' => '_Gender'
    ),
    'subscriptionType' => array(
        'table_name' => 'Contact',
        'col_name' => '_SubscriptionType',
    ),
    'fitnessLevel' => array(
        'table_name' => 'Contact', 
        'col_name' => '_FitnessLevel'
    ),
    'primaryGoal' => array(
        'table_name' => 'Contact', 
        'col_name' => '_PrimaryGoal'
    ),
    'secondaryGoal' => array(
        'table_name' => 'Contact', 
        'col_name' => '_SecondaryGoal'
    ),
    'receiveNewsletter' => array(
        'table_name' => 'Contact', 
        'col_name' => '_ReceiveNewsletter'
    ),
    'receiveThirdParty' => array(
        'table_name' => 'Contact', 
        'col_name' => '_ReceiveThirdParty'
    ),
    
    // Tags
    'tag_newmember' => array(
        'table_name' => 'ContactGroupAssign', 
        'col_name' => 'groupId',
        'tag_id' => 129,    // Applies a tag for 'New contact'
    ),
    'tag_trial' => array(
        'table_name' => 'ContactGroupAssign', 
        'col_name' => 'groupId',
        'tag_id' => 145,    // Applies a tag with 'Trial'
    ),

    // Orders
    'trialPeriod' => array(
        'table_name' => 'Order', 
        'col_name' => 'groupId',
        'date' => true,
    ),
    'subscriptionPeriod' => array(
        'table_name' => 'Order', 
        'col_name' => 'groupId',
    ),
    'subscriptionProduct' => array(
        'table_name' => 'Order', 
        'col_name' => 'groupId',
    ),

    // what about subcsription etc !!!!!!!!!!!!!!!!!!!!! need ot add these to infusionsoft
);