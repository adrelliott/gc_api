<?php namespace Api;


require_once('../infusionsoft/isdk.php');
use iSDK as Infusionsoft;
use DateInterval;


class Api {


    protected $app;

    protected $data;

    protected $result;

    protected $col_map = array(
        'firstName' => array(
            'table_name' => 'Contact',
            'col_name' => 'FirstName'
        ), 
        'surname' => array(
            'table_name' => 'Contact', 
            'col_name' => 'LastName'
        ),
        'emailAddress' => array(
            'table_name' => 'Contact', 
            'col_name' => 'Email'
        ),
        'ContactNumber' => array(
            'table_name' => 'Contact', 
            'col_name' => 'Phone1'
        ),
        'facebookUid' => array(
            'table_name' => 'Contact', 
            'col_name' => '_FacebookUid'
        ),
        'addressLine1' => array(
            'table_name' => 'Contact', 
            'col_name' => 'StreetAddress1'
        ),
        'addressLine2' => array(
            'table_name' => 'Contact', 
            'col_name' => 'StreetAddress2'
        ),
        'city' => array(
            'table_name' => 'Contact', 
            'col_name' => 'City'
        ),
        'region' => array(
            'table_name' => 'Contact', 
            'col_name' => 'State'
        ),
        'postcode' => array(
            'table_name' => 'Contact', 
            'col_name' => 'PostalCode'
        ),
        'country' => array(
            'table_name' => 'Contact', 
            'col_name' => 'Country'
        ),
        'dob' => array(
            'table_name' => 'Contact', 
            'col_name' => 'Birthday'
        ),
        'gender' => array(
            'table_name' => 'Contact', 
            'col_name' => '_Gender'
        ),
        'fitnessLevel' => array(
            'table_name' => 'Contact', 
            'col_name' => '_FitnessLevel'
        ),
        'primaryGoal' => array(
            'table_name' => 'Contact', 
            'col_name' => '_PrimaryGoal'
        ),
        'secondaryGoal' => array(
            'table_name' => 'Contact', 
            'col_name' => '_SecondaryGoal'
        ),
        'receiveNewsletter' => array(
            'table_name' => 'Contact', 
            'col_name' => '_ReceiveNewsletter2'
        ),
        'receiveThirdParty' => array(
            'table_name' => 'Contact', 
            'col_name' => '_ReceiveThirdParty2'
        ),
        'promoCode' => array(
            'table_name' => 'Contact',
            'col_name' => '_InitialPromoCode',
        ),
        
        // Tags
        'tag_newmember' => array(
            'table_name' => 'ContactGroupAssign', 
            'col_name' => 'groupId',
            'tag_id' => 129,    // Applies a tag for 'New contact'
        ),
        'tag_trial' => array(
            'table_name' => 'ContactGroupAssign', 
            'col_name' => 'groupId',
            'tag_id' => 145,    // Applies a tag with 'Trial'
        ),

        // Orders
        'subscriptionType' => array(
            'table_name' => 'Subscription',
            'col_name' => 'ProductName',
        ),
        'trialPeriod' => array(
            'table_name' => 'Subscription', 
            'col_name' => 'DaysToCharge',
            'date_format' => 'toDays',
        ),
        'subscriptionPeriod' => array(
            'table_name' => 'Subscription', 
            'col_name' => 'BillingPeriod',
            'date_format' => 'MonthlyOrAnnually',
        ),
        'subscriptionFee' => array(
            'table_name' => 'Subscription', 
            'col_name' => 'Price',
        ),
        'subscriptionProduct' => array(
            'table_name' => 'Subscription', 
            'col_name' => 'ProgId',
        ),
        'crmId' => array(
            'table_name' => 'Subscription', 
            'col_name' => 'ContactId',
        ),
    );

    protected $subscription_map = array(
        'Anytime Monthly' => 3, 
        'Anytime Plus Monthly' => 7, 
        'Anytime Annually' => 9, 
        'Anytime Plus Annually' => 11, 
    );



    
    public function __construct( $data = array() )
    {
        // Instatiate and set up connection
        $this->app = new Infusionsoft();
        $result = $this->app->cfgcon('gymcube');

        // Verify the data passed:
        $this->verifyData( $data );
        $this->dump($this->data, 'The data to be submitted');

        // Set up the timezone
        date_default_timezone_set('Europe/London'); //do we need this on Pimcore server?
    }


    // Create a contact
    public function updateContact( $cId = FALSE )
    {
        # 1. Findorcreate the contact
        if ( $cId )
        {
             $this->result['Id'] = $this->update( $cId, $this->data['Contact'] );
        }
        else $this->result['Id'] = $this->findOrCreate( $this->data['Contact'] );

        # 2. Optin the email
        if ( isset($this->data['Contact']['Email']) )
        {
            $this->result['Optin'] = $this->optInEmail( $this->data['Contact']['Email'] );
        }
        
        # 3. Apply the tags (promo code, plus 'new registrant', 'no trial')
        if ( isset($this->data['ContactGroupAssign']) )
        {
            foreach ( $this->data['ContactGroupAssign'] as $tag_id )
            {
                $this->result['ApplyTag'][$tag_id] = $this->applyTag( $this->result['Id'], $tag_id);
            }  
        }

        # 4. return the API results
        return $this->result;
    }

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


    // mark all as Subscriptions as inactive
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


    protected function verifyData( $data = array() )
    {
        $this->data = array();

        foreach ( $data as $k => $v )
        {
            if ( isset($this->col_map[$k]) )
            {
                // get the new col name & table
                $col = $this->col_map[$k]['col_name'];
                $table = $this->col_map[$k]['table_name'];

                // Is it a date?
                if ( isset($this->col_map[$k]['date_format']) )
                {
                    // do some date business here
                    $date = new DateInterval($v);

                    // Process the vale
                    switch ( $this->col_map[$k]['date_format'] )
                    {
                        case 'toDays':  //Convert to days
                            $v = $date->d;
                            break;
                        
                        case 'toMonths':    // Convert to Months
                            $v = $date->m;
                            break;
                        
                        case 'MonthlyOrAnnually': // is it monthly or annually
                            if ( $date->m > 0 ) $v = 'Monthly';
                            else $v = 'Annually';
                            break;
                    }
                }

                // Is it a tag?
                if ( isset($this->col_map[$k]['tag_id']) )
                    $v = $this->col_map[$k]['tag_id'];

                // Add to $this->data
                $this->data[$table][$col] = $v;
            }
        }
    }
    



    // Contact Methods
    public function update( $contactId, $data )
    {
        return $this->app->updateCon($contactId, $data);
        
    }

    public function findOrCreate( $data, $searchType = 'EmailAndName')
    {
        return $this->app->addWithDupCheck($data, $searchType);
    }

    public function optInEmail( $email, $reason = 'You signed up on GymCube website' )
    {
        return $this->app->optIn($email, $reason);
    }

    // Optout email
    public function optOutEmail( $email, $reason = 'You opted out of emails on GymCube website' )
    {
        return $this->app->optOut( $email, $reason );
    }

    public function applyTag( $contactId, $tagId )
    {
        return $this->app->grpAssign( $contactId, $tagId );
    }
    
    public function removeTag( $contactId, $tagId )
    {
        return $this->app->grpRemove( $contactId, $tagId );
    }



    // Order Methods






    public function dump($var, $label = 'Output:', $die = false )
    {
        ob_start();
        var_dump($var);
        $output = ob_get_clean();
        
        // Add formatting
        $output = preg_replace("/\]\=\>\n(\s+)/m", "] => ", $output);
        $output = '<pre style="background: #FFFEEF; color: #000; border: 1px dotted #000; padding: 10px; margin: 10px 0; text-align: left;">' . $label . ' => ' . $output . '</pre>';
        
        // Output
        if ($die) 
        {
            die($output);
        }
        else 
        {
             echo $output;
         }
    }
}