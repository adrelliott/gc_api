<?php 
if ( $_POST )
{
    // If email is not set, redirect
    if ( ! ($_POST['ID']) ) header( 'Location: contact_update.php?error=You need to set the ID of the record to update!');
    else 
    {
    // Connect to infusion
    include('includes/connect.php');

    // Find or create contact
    $id = $app->updateCon($_POST['ID'], $_POST);
    if ( ($_POST['Email']) ) $optIn = $app->optIn($_POST['Email'], $config['optIn']['update']);

    // Redirect to the contact page
    header( 'Location: contact_update.php?success=Contact updated&ID=' . $id);
    }
}