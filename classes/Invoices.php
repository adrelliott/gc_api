<?php namespace Api\Invoices;

// Manipulates the Invoices table


class Invoices {

    // Constructor: set up infusionsoft connection


    // Finds the invoice ID to add the payment to
    public function findInvoiceDue( $cId )
    {
        # Queries to find all invoices for this contact that are unpaid, ordered by due date ASC
        # return id of first record (The oldest one) or FALSE if unsuccessful
    }

     // marks an invoice as paid
    public function addPayment( $invoiceId, $data = array() )
    {
        # Update the invoice record with supplied data
        # ensure it is marked as paid
        # return the invoice ID or FALSE if unsuccessful
    }

    public function destroyAllUnpaid( $cId )
    {
        # Queries to find all invoices for this contact that are unpaid, ordered by due date ASC
        # cycles throguh each id and destroys it 
        # returns array of invoices destryed if successful and false if not
    }

    public function findAllOpenInvoices( $cId )
    {
        # Queries to find all invoices for this contact that are unpaid, ordered by due date ASC
        # return array of id's
    }

}

