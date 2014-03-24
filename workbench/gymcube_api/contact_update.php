<?php 

    // Define the fields
    $cols = array('ID' => '', 'FirstName' => '', 'LastName' => '', 'Email' => '');

    // Set up connection
    include('includes/header.php');

    // Deal with the form
    include ('includes/update_contact.php');

    // Load contact
    include ('includes/find_contact.php');
?>

<h3>Update a contact</h3>

<?php include ('includes/messages.php'); ?>

<form action="" method="post">
    
    <?php 
        foreach ( array_keys($cols) as $col ) 
            echo '<p>' . $col . '<input type="text" name="' . $col . '" value="' . $r[$col] . '"></p>'; 
    ?>
     
    <input type="submit" >Submit</input>
</form>