<?php 
if ( $_POST )
{
    // If email is not set, redirect
    if ( ! ($_POST['Email']) || ! ($_POST['FirstName']) ) header( 'Location: contact_create.php?error=Email and FirstName are mandatory');
    else 
    {
        // Connect to infusion
        include('includes/connect.php');

        // Find or create contact
        $id = $app->addWithDupCheck($_POST, 'EmailAndName');
        $optIn = $app->optIn($_POST['Email'], $config['optIn']['create']);
        $tag = $app->grpAssign($id, $config['tags']['newContact']);

        // Redirect to the contact page
        header( 'Location: contact_create.php?success=Contact added or updated&ID=' . $id);
    }
}