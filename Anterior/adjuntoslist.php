<?php
 
 
/**
 * 
 *	Gmail attachment extractor.
 *
 *	Downloads attachments from Gmail and saves it to a file.
 *	Uses PHP IMAP extension, so make sure it is enabled in your php.ini,
 *	extension=php_imap.dll
 *
 *  Credits:  Sameer Borate email: metapix[at]gmail.com
 */
 
 
set_time_limit(3000); 
 
 
/* connect to gmail with your credentials */
$hostname = '{imap.gmail.com:993/imap/ssl}';
$username = 'vauxrevelo@gmail.com'; # e.g somebody@gmail.com
$password = '2580*$123';

 
/* try to connect */
$inbox = imap_open($hostname,$username,$password) or die('Cannot connect to Gmail: ' . imap_last_error());

$mailboxes = imap_list($inbox, $hostname, '*');
print_r($mailboxes);
 /* close the connection */
imap_close($inbox);
 
echo "Done";
 
?>