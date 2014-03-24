<?php 
if ( $_POST )
{
    // If email is not set, redirect
    if ( ! ($_POST['contactId']) ) header( 'Location: product_add.php?error=Need ContactId');
    else 
    {
        // Connect to infusion & set default
        include('includes/connect.php');
        $default = array(
            'contactId' => (int)$_POST['contactId'],
            'allowDup' =>false,
            'progId' => (int)$_POST['subscriptionIds'],
            'qty' => 1,
            'price' => 10.00,
            'allowTax' => false,
            'merchId' => 0,
            'ccId' => 0,
            'affId' => 0,
            'daysToCharge' => (int)$_POST['trialDays'],
            'promoCodes' => (array)$_POST['promoCodes'],
            );


        // Build API call
        extract($default);

        // Any promo codes or vouchers provided?
        if ( count($promoCodes) ) 
        {
            foreach ( $promoCodes as $code )
                $app->grpAssign($contactId, $code);
        }

        $orderId = $app->addRecurringAdv($contactId, $allowDup, $progId, $qty, $price, $allowTax, $merchId, $ccId, $affId, $daysToCharge);

        // If trial days is zero, then create a bill immediately
        if ( $daysToCharge == 0 ) $result = $app->recurringInvoice($orderId);

        // Redirect to the contact page
        if ( ! $result ) header( 'Location: product_add.php?error=something went wrong');
        else header( 'Location: product_add.php?success=Subscription added with id of ' . $orderId);
        
    }
}