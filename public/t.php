<?php
//taken from ilovejackdaniels.com

function check_email_address($email) {
  // First, we check that there's one @ symbol, 
  // and that the lengths are right.
  if (!ereg("^[^@]{1,64}@[^@]{1,255}$", $email)) {
    // Email invalid because wrong number of characters 
    // in one section or wrong number of @ symbols.
    return false;
  }
  echo "1";
  // Split it into sections to make life easier
  $email_array = explode("@", $email);
  $local_array = explode(".", $email_array[0]);
  for ($i = 0; $i < sizeof($local_array); $i++) {
    if(!ereg("^(([A-Za-z0-9!#$%&'*+/=?^_`{|}~-][A-Za-z0-9!#$%&?'*+/=?^_`{|}~\.-]{0,63})|(\"[^(\\|\")]{0,62}\"))$",$local_array[$i])) {
      return false;
    }
  }
  echo "2";
  // Check if domain is IP. If not, 
  // it should be valid domain name
  if (!ereg("^\[?[0-9\.]+\]?$", $email_array[1])) {
    $domain_array = explode(".", $email_array[1]);
    if (sizeof($domain_array) < 2) {
	echo "2.5";
        return false; // Not enough parts to domain
    }
    for ($i = 0; $i < sizeof($domain_array); $i++) {
      if (!ereg("^(([A-Za-z0-9][A-Za-z0-9-]{0,61}[A-Za-z0-9])|?([A-Za-z0-9]+))$",$domain_array[$i])) {
	  //x`echo "2.$6:".domain_array[$i];
        return false;
      }
    }
	echo "3";
  }
  return true;
}

$to = "info@ngvetspecialists.com";
$message = nl2br($_POST['message']);
$subject = "New Email List Subscription!";

// To send HTML mail, the Content-type header must be set
$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
$headers .= 'From: info@ngvetspecialists.com' . "\r\n";
$headers .= "BCC: leadcheckerlaunchmark.com\r\n";

$message = '
<table width="392" height="45">
  <tr>
    <td width="82" height="26">Name:</td>
    <td width="298"><label>
       ' . $_POST['name2']. '
   </label></td>
  </tr>
  <tr>
    <td height="11">Email: </td>
    <td><label>
      ' . $_POST['email2']. '
   </label></td>
  </tr>
</table>
';


// BUILD EMAIL MESSAGE

$sendmail = false;

if (check_email_address('angel.icusca@gmail.com')) $sendmail = true;
// Mail it

if ($sendmail) 
	mail( $to, $subject, $message, $headers );

//header("Location: http://www.ngvetspecialists.com/thanks.html"); /* Redirect browser */



/* Make sure that code below does not get executed when we redirect. */

exit;

?> 