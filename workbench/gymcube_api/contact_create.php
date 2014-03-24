<?php 

    // Define the fields
    $cols = array('FirstName' => '', 'LastName' => '', 'Email' => '');

    // Set up connection
    include('includes/header.php');

    // Deal with the form
    include ('includes/create_contact.php');

    // Load contact
    include ('includes/find_contact.php');
?>

<h3>Add a contact</h3>

<?php include ('includes/messages.php'); ?>

<form action="" method="post">
    <?php 
        if ( isset($r['ID']) ) echo '<p>ID<input type="text" disabled="true" value="' . $r['ID'] . '"></p>'; 
    ?>
    
    <?php 
        foreach ( array_keys($cols) as $col ) 
            echo '<p>' . $col . '<input type="text" name="' . $col . '" value="' . $r[$col] . '"></p>'; 
    ?>
     
    <input type="submit" >Submit</input>
</form>