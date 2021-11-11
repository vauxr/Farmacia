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
 
 
set_time_limit(13000); 
 
 
/* connect to gmail with your credentials */
$hostname = '{imap.gmail.com:993/imap/ssl}[Gmail]/Enviados';
$username = 'facturacionelectronica@fhospitalsanpedro.org'; # e.g somebody@gmail.com
$password = 'fe891200209';
 
 
/* try to connect */
$inbox = imap_open($hostname,$username,$password) or die('Cannot connect to Gmail: ' . imap_last_error());
 
 
/* get all new emails. If set to 'ALL' instead 
 * of 'NEW' retrieves all the emails, but can be 
 * resource intensive, so the following variable, 
 * $max_emails, puts the limit on the number of emails downloaded.
 * 
 */
//$emails = imap_search($inbox,'ALL');
$emails = imap_search($inbox,'TO "facturacionelectronicasalud@emssanar.org.co" SINCE "1 September 2021" BEFORE "1 October 2021"');
 
/* useful only if the above search is set to 'ALL' */
$max_emails = 10000;
 
 
/* if any emails found, iterate through each email */
if($emails) {
 
    $count = 1;
 
    /* put the newest emails on top */
    rsort($emails);
 
    /* for every email... */
    $archivotxt=fopen("registros.txt","a+") ;      
    foreach($emails as $email_number) 
    {
        //print_r($email_number);
        /* get information specific to this email */
        $overview = imap_fetch_overview($inbox,$email_number,0);
        //print_r($overview);
        /* get mail message */
        //$message = imap_fetchbody($inbox,$email_number,2);
 
        /* get mail structure */
        //$structure = imap_fetchstructure($inbox, $email_number);         
        /* if any attachments found... */        
        foreach ($overview as $correo) {
            echo $correo->date."|".$correo->subject."<br>";
            fwrite($archivotxt,$correo->date."|".$correo->subject."\n");
        }
        //if($count++ >= $max_emails) break;
    }
    fclose($archivotxt);
 
} 
 
/* close the connection */
imap_close($inbox);
 
echo "Done";
 
?>