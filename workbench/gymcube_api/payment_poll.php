<?php
    
    // Set up connection
    include('includes/header.php');
    include ( 'includes/connect.php' );

?>

<h3>Simulate polling</h3>

<p>1. Get all current outstanding invoices</p>
<?php 
    $fields = array('Id', 'ContactId', 'DateCreated', 'InvoiceTotal', 'TotalPaid', 'TotalDue', 'PromoCode', 'ProductSold');
    $query = array(
        'PayStatus' => 0
        );    
    $orderby = 'DateCreated';
    $limit = 1000;
    $offset = 0;
    $invoices = array();

    // Do query... NOTE: Need some batching here
    $invoices = $app->dsQuery('Invoice', $limit, $offset, $query, $fields, $orderby);

?>
<pre><?php print_r($invoices); ?></pre>

<p>2. Sort into contacts</p>
<?php 
    $r = array();
    foreach ($invoices as $i => $a)
    {
        $invoices['sorted'][$a['ContactId']][$a['Id']] = $a;
    }
?>
<pre><?php print_r($invoices['sorted']); ?></pre>



<?php include ('includes/messages.php'); ?>
