<?php namespace Api;
 
// introduces an array of all data as $data
include ( 'data/profile_data.php' );
include ( '../classes/Api.php' );

// Get the right data for this step - mocks $_POST
if ( ! isset( $_GET['tab_no'] ) ) die('You need to pass a tab_no, either 1, 2, 3, 4 or 5 (where 1 is MY Details and 5 is My Progress');
else
{
    $tab_no = $_GET['tab_no'];
    $data = $data['tab_' . $tab_no];
    // print_r($data);
    
    $api = new Api( $data );
}

// Now fake submmitting it to the CRM
switch ( $tab_no )
{
    // My Details
    case 1:
        # 1. Update contact reocrd with the new data
        $result['Contact'] = $api->updateContact( $data['crmId'] );

            // Feedback
        echo 'Contact ' . $result['Contact']['Id'] . ' updated, <a href="?tab_no=2&crmId=' . $result['Contact']['Id'] . '">Go to Tab 2 (My Fitness)</a>';
        break;
    
    // My Fitness & goals
    case 2:
        # 1. Update contact record with the new data
        $result['Contact'] = $api->updateContact( $data['crmId'] );

            // Feedback
        echo 'Contact ' . $result['Contact']['Id'] . ' updated, <a href="?tab_no=3&crmId=' . $result['Contact']['Id'] . '">Go to Tab 3 (this is where we cancel the subscription)</a>';
        break;
    
    // My Subscription
    case 3:
        # 1. Remove all subscriptions
        $result = $api->markAllAsInactive();

            // Feedback
        echo 'Subscription set to "inactive"';
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
$api->dump($result, 'Result of API calls');



