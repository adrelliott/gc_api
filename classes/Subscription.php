<?php namespace Api;

require_once('Api.php');

class Subscription extends Api {

   
    // Removes all existing subscriptions and adds new ones
    public function updateSubscription( $cId = FALSE )
    {
        # 1. Set up ContactId for infusionosoft
        if ( $cId ) $this->data['Subscription']['ContactId'] = $cId;

        # 2. Work out what subscription we are applying
        $subscriptionName = $this->data['Subscription']['ProductName'] . ' ' . $this->data['Subscription']['BillingPeriod'];
        // $id = $this->subscription_map[$subscriptionName];
        $this->data['Subscription']['ProgId'] = $this->subscription_map[$subscriptionName];

        # 2. Remove all existing subscriptions
        $this->result['MarkOrdersAsInactive'] = $this->markAllAsInactive();

        # 3. Add new subscription
        $this->result['Create Subscription'] = $this->createSubscription();

        # 4. return the API results
        return $this->result;
    }


    // mark all as complete
    public function markAllAsInactive( $cId = FALSE )
    {
        # 1. Set up the initial vars
        $subscriptions = array();
        if ( ! $cId ) $cId = $this->data['Subscription']['ContactId'];
        $retval = 'no Subscriptions found';

        # 2. Find all orders where ContactId = cId, and Status = 1 (usually there's just one)
        $subscriptions = $this->app->dsQuery(
            'RecurringOrder', 1000, 0, 
            array('ContactId' => $cId, 'Status' => 'Active'), 
            // array('Id', 'ProgramId', 'SubscriptionPlanId', 'ProductId', 'EndDate', 'NextBillDate', 'Status')
            array('Id')
            );

        # 3. Loop through each change status to 0
        if ( count($subscriptions) >= 1 ) 
            $retval = array();
            foreach ( $subscriptions as $k => $array )
            {
                $subscriptionId = $array['Id'];
                $newData = array(
                    'Status' => 'Inactive',
                    'EndDate' => date('Y-m-d\TH:i:s'),  //Infusionsoft's data format
                );
                $retval[$subscriptionId] = $this->app->dsUpdate('RecurringOrder', $subscriptionId, $newData);
            }

        # 4. report back
        return $retval;
    }

    public function createSubscription()
    {
        $default = array(
            'ContactId' => (int)$this->data['Subscription']['ContactId'],
            'AllowDup' => (bool)false,
            'ProgId' => (int)$this->data['Subscription']['ProgId'],
            'Qty' => 1,
            'Price' => (float)$this->data['Subscription']['Price'],
            'AllowTax' => (bool)false,
            'MerchId' => 0,
            'CcId' => 0,
            'AffId' => 0,
            'DaysToCharge' => (int)$this->data['Subscription']['DaysToCharge'],
            // 'PromoCodes' => 0,   //Not being used just now
            );

        // Add the subscription
        extract($default);
        return $this->app->addRecurringAdv($ContactId, $AllowDup, $ProgId, $Qty, $Price, $AllowTax, $MerchId, $CcId, $AffId, $DaysToCharge);
    }

}

