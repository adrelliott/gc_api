<?php namespace Api;

require_once('Api.php');

class Contact extends Api {


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
    

}

