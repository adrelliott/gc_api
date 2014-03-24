<?php
    // Define the fields
    $cols = array('contactId' => '', 'productIds' => '', 'subscriptionIds' => '', 'processSpecials' => '', 'promoCodes' => '');

    // Set up connection
    include('includes/header.php');

    // Deal with the form
    include ('includes/add_product.php');

    // Load contact
    $r = array_merge($cols, $_GET);
?>

<h3>Add a Product</h3>

<?php include ('includes/messages.php'); ?>

<form action="" method="post">
    
    <p>contactId<input type="text" name="contactId"></p>
    <p>subscriptionIds (csv)<select name="subscriptionIds"><?php foreach ($config['subscriptions'] as $v => $l) echo '<option value="' . $v . '">' . $l . '</option>'; ?></select></p>
    
    <p>trialDays<input type="text" name="trialDays"></p>
    <p>promoCodes<input type="text" name="promoCodes"></p>

    <input type="submit" >Submit</input>
</form>