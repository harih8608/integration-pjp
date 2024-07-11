<?php

class checkemail {
  private $accepted_domains;
  public function __construct() {
    // Set the accepted domains property
    $this->accepted_domains = array(
      'nic.in'
    );
	$this->accepted_domains_2 = array(
      'nic.in', 'gov.in'
    );
  }
  

  public function validate_by_domain($email_address) {
    // Get the domain from the email address
    $domain = $this->get_domain( trim( $email_address ) );
    
    // Check if domain is accepted. Return return if so
    if ( in_array( $domain, $this->accepted_domains ) ) {
      return true;
    }
    
    return false;
  }
  public function validate_by_domains($email_address) {
    // Get the domain from the email address
    $domain = $this->get_domain( trim( $email_address ) );
    
    // Check if domain is accepted. Return return if so
    if ( in_array( $domain, $this->accepted_domains_2 ) ) {
      return true;
    }
    
    return false;
  }
  

  private function get_domain($email_address) {
    // Check if a valid email address was submitted
    if ( ! $this->is_email( $email_address ) ) {
      return false;
    }
    
    // Split the email address at the @ symbol
    $email_parts = explode( '@', $email_address );
    
    // Pop off everything after the @ symbol
    $domain = array_pop( $email_parts );
    
    return $domain;
  }
  

  private function is_email($email_address) {
    // Filter submitted value to see if it's a proper email address
    if ( filter_var ( $email_address, FILTER_VALIDATE_EMAIL ) ) {
      return true;
    }
    
    return false;
  }
}
if (! empty($_POST["addemail"])) {
    
    $ids= $_POST["addemail"];
	$checkemail_funcs =  new checkemail();
	$id_arr = explode( ',', $ids );
	$id_err_flag=false;
	foreach($id_arr as $id)
	{
		$checkres = $checkemail_funcs->validate_by_domain($id);
		if($checkres)
		{
			$id_err_flag = false; //No error in id
		}
		else
		{
			$id_err_flag = true; //Yes id is error
			break;
		}
    //$options = '<option value="0">Select Sub Category</option>';
	}
	if( $id_err_flag){
		echo 1;
	}
	else
	{
		echo 0;
	}
}
?>