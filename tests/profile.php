<?php namespace Api;
 
// introduces an array of all data as $data
include ( 'data/profile_data.php' );
include ( '../classes/Contact.php' );
include ( '../classes/Subscription.php' );

$contact = new Contact( $data );

// Get the right data for this step - mocks $_POST
if ( ! isset( $_GET['tab_no'] ) ) die('You need to pass a tab_no, either 1, 2, 3, 4 or 5 (where 1 is MY Details and 5 is My Progress');
else
{
    $tab_no = $_GET['tab_no'];
    $data = $data['tab_' . $tab_no];
    // print_r($data);
}

// Now fake submmitting it to the CRM
switch ( $tab_no )
{
    // My Details
    case 1:
        # 1. Update contact reocrd with the new data
        $result = $contact->updateContact( $data['crmId'] );
        break;
    
    // My Fitness & goals
    case 2:
        # 1. Update contact reocrd with the new data
        $result = $contact->updateContact( $data['crmId'] );
        break;
    
    // My Subscription
    case 3:
        # 1. Remove all subscriptions
        $subscription = new Subscription( $data );
        $result = $subscription->markAllAsInactive();
        break;

    // My Favourites
    case 4:
        die('Ooops. Not set this one up yet');
        break;

    // My Progress
    case 5:
        die('Ooops. Not set this one up yet');
        break;

    default:
        die('You need to pass a tab_no, either 1, 2, 3, 4 or 5 (where 1 is MY Details and 5 is My Progress');
}

// Debug:
$contact->dump($result, 'Result of API calls');



