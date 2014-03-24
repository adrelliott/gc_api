<?php namespace Api;
 
// introduces an array of all data as $data
include ( 'data/registration_data.php' );
include ( '../classes/Contact.php' );
include ( '../classes/Subscription.php' );



// Get the right data for this step - mocks $_POST
if ( ! isset( $_GET['step_no'] ) ) die('You need to pass a URL param step_no=X, where X =1 or 2 or 3');
else
{
    $step_no = (int)$_GET['step_no'];
    $data = $data['step_' . $step_no];
}

// Now fake submmitting it to the CRM
switch ( $step_no )
{
    // Step 1
    case 1:
        # Create new contact
        $contact = new Contact( $data );
        $result = $contact->updateContact();
        break;
    
    // Step 2
    case 2:
        # 1. Update contact reocrd with the new data
        $contact = new Contact( $data );
        $result['Contact'] = $contact->updateContact( $data['crmId'] );

        # 2. Now update the subscriptions
        $subscription = new Subscription( $data );
        $result['Subscription'] = $subscription->updateSubscription();
        break;
    
    // Step 3
    case 3:
        # 1. Update contact
        $contact = new Contact( $data );
        $result = $contact->updateContact( $data['crmId'] );
        break;

    default:
         die('You need to pass a URL param step_no=X, where X =1 or 2 or 3');
}

// Debug:
$contact->dump($result, 'Result of API calls');



