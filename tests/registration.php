<?php namespace Api;
 
// introduces an array of all data as $data
include ( 'data/registration_data.php' );
include ( '../classes/Api.php' );

// Get the right data for this step - mocks $_POST
if ( ! isset( $_GET['step_no'] ) ) echo '<a href="?step_no=1">Go to Step 1</a>';
else
{
    $step_no = (int)$_GET['step_no'];
    $data = $data['step_' . $step_no];

    $api = new Api( $data );


    // Now fake submmitting it to the CRM
    switch ( $step_no )
    {
        // Step 1
        case 1:
            # Create new contact
            $result['Contact'] = $api->updateContact();

            // Feedback
            echo 'New contact created with id of ' . $result['Contact']['Id'] . ', <a href="?step_no=2&crmId=' . $result['Contact']['Id'] . '">Go to Step 2</a>';
            break;
        
        // Step 2
        case 2:
            # 1. Update contact reocrd with the new data
            $result['Contact'] = $api->updateContact( $data['crmId'] );

            # 2. Now update the subscriptions
            $result['Subscription'] = $api->updateSubscription();

            // Feedback
            echo 'Contact ' . $result['Contact']['Id'] . ' updated, <a href="?step_no=3&crmId=' . $result['Contact']['Id'] . '">Go to Step 3</a>';
            break;
        
        // Step 3
        case 3:
            # 1. Update contact
            $result['Contact'] = $api->updateContact( $data['crmId'] );

            // Feedback
            echo 'Contact ' . $result['Contact']['Id'] . ' updated, <a href="profile/php?tab_no=1&crmId=' . $result['Contact']['Id'] . '">Go to Profile</a>';
            break;

        default:
             die('You need to pass a URL param step_no=X, where X =1 or 2 or 3');
    }

    // Debug:
    $api->dump($result, 'Result of API calls');

}