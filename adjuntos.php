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


set_time_limit(3000000000);


/* connect to gmail with your credentials */
/*$hostname = '{imap.gmail.com:993/imap/ssl}[Gmail]/Enviados';
$username = 'bancodesangre@fhospitalsanpedro.org'; # e.g somebody@gmail.com
$password = 'BSHSP2021';*/


$hostname = '{imap.gmail.com:993/imap/ssl}[Gmail]/Enviados';
$username = 'facturacionelectronica@fhospitalsanpedro.org'; # e.g somebody@gmail.com
$password = 'fe891200209';


$facturasMario = ['FE137932', 'FE178388', 'FE179893', 'FE179903', 'FE180243', 'FE180244', 'FE180428', 'FE189031', 'FE189262', 'FE189425', 'FE189426', 'FE189428', 'FE189430', 'FE189431', 'FE189434', 'FE189435', 'FE189436', 'FE189486', 'FE189487', 'FE189488', 'FE189490', 'FE189491', 'FE189492', 'FE189498', 'FE189511', 'FE189513', 'FE189515', 'FE189538', 'FE189622', 'FE189627', 'FE189633', 'FE189637', 'FE189645', 'FE189648', 'FE189649', 'FE189650', 'FE189656', 'FE189659', 'FE189664', 'FE189666', 'FE189669', 'FE189674', 'FE189680', 'FE189688', 'FE189689', 'FE189694', 'FE189696', 'FE189699', 'FE189703', 'FE189705', 'FE189712', 'FE189714', 'FE189721', 'FE189733', 'FE189738', 'FE189742', 'FE189746', 'FE189747', 'FE189748', 'FE189750', 'FE189753', 'FE189760', 'FE189761', 'FE189763', 'FE189767', 'FE189768', 'FE189773', 'FE189774', 'FE189775', 'FE189778', 'FE189832', 'FE189838', 'FE189844', 'FE189847', 'FE189853', 'FE189859', 'FE189875', 'FE189908', 'FE189909', 'FE189911', 'FE189912', 'FE189915', 'FE189917', 'FE189919', 'FE189921', 'FE189927', 'FE189928', 'FE189930', 'FE190002', 'FE190003', 'FE190008', 'FE190015', 'FE190017', 'FE190021', 'FE190024', 'FE190027', 'FE190083', 'FE190085', 'FE190099', 'FE190100', 'FE190101', 'FE190104', 'FE190112', 'FE190116', 'FE190119', 'FE190120', 'FE190122', 'FE190123', 'FE190124', 'FE190125', 'FE190127', 'FE190129', 'FE190132', 'FE190134', 'FE190138', 'FE190139', 'FE190140', 'FE190141', 'FE190142', 'FE190144', 'FE190146', 'FE190148', 'FE190149', 'FE190150', 'FE190152', 'FE190153', 'FE190154', 'FE190156', 'FE190158', 'FE190160', 'FE190164', 'FE190199', 'FE190549', 'FE190550', 'FE190553', 'FE190556', 'FE190557', 'FE190558', 'FE190559', 'FE190560', 'FE190561', 'FE190562', 'FE190564', 'FE190640', 'FE190643', 'FE190645', 'FE190646', 'FE190647', 'FE190652', 'FE190653', 'FE190654', 'FE190655', 'FE190656', 'FE190732', 'FE190736', 'FE190739', 'FE190742', 'FE190744', 'FE190752', 'FE190753', 'FE190755', 'FE190759', 'FE190760', 'FE190762', 'FE190763', 'FE190765', 'FE190766', 'FE190767', 'FE190769', 'FE190771', 'FE190772', 'FE190773', 'FE190774', 'FE190777', 'FE190778', 'FE190780', 'FE190781', 'FE190784', 'FE190787', 'FE190789', 'FE190792', 'FE190793', 'FE190796', 'FE190797', 'FE190801', 'FE190802', 'FE190816', 'FE190819', 'FE190823', 'FE190824', 'FE190827', 'FE190829', 'FE190833', 'FE190834', 'FE190974', 'FE190993', 'FE191181', 'FE191664', 'FE191665', 'FE191667', 'FE191670', 'FE191671', 'FE191674', 'FE191676', 'FE191677', 'FE191679', 'FE191681', 'FE191683', 'FE191685', 'FE191687', 'FE191688', 'FE191695', 'FE191696', 'FE191699', 'FE191700', 'FE191706', 'FE191715', 'FE191716', 'FE191718', 'FE191720', 'FE191721', 'FE191723', 'FE191724', 'FE191725', 'FE191729', 'FE191735', 'FE191736', 'FE191993', 'FE192069', 'FE192161', 'FE192300', 'FE192392', 'FE192426', 'FE192430', 'FE192436', 'FE192490', 'FE192495', 'FE192499', 'FE192533', 'FE192543', 'FE192552', 'FE192554', 'FE192556', 'FE192558', 'FE192560', 'FE192564', 'FE192568', 'FE192576', 'FE192577', 'FE192618', 'FE192620', 'FE192621', 'FE192622', 'FE192623', 'FE192624', 'FE192626', 'FE192627', 'FE192628', 'FE192629', 'FE192631', 'FE192632', 'FE192714', 'FE192715', 'FE192716', 'FE192717', 'FE192718', 'FE192721', 'FE192722', 'FE192813', 'FE192814', 'FE192822', 'FE192824', 'FE192825', 'FE192829', 'FE192843', 'FE192845', 'FE192846', 'FE192847', 'FE192848', 'FE192850', 'FE192851', 'FE192852', 'FE192853', 'FE192855', 'FE192858', 'FE192862', 'FE192863', 'FE192865', 'FE192890', 'FE192891', 'FE193040', 'FE193042', 'FE193048', 'FE193049', 'FE193052', 'FE193053', 'FE193054', 'FE193622', 'FE193652', 'FE193843', 'FE193846', 'FE193850', 'FE193858', 'FE193860', 'FE193861', 'FE193863', 'FE193865', 'FE193867', 'FE193869', 'FE193871', 'FE193873', 'FE193874', 'FE193881', 'FE193882', 'FE193885', 'FE193886', 'FE193890', 'FE193892', 'FE193893', 'FE193900', 'FE193903', 'FE193913', 'FE193919', 'FE193923', 'FE193924', 'FE194056', 'FE194060', 'FE194066', 'FE194068', 'FE194069', 'FE194076', 'FE194077', 'FE194079', 'FE194081', 'FE194082', 'FE194088', 'FE194089', 'FE194090', 'FE194091', 'FE194093', 'FE194096', 'FE194097', 'FE194101', 'FE194102', 'FE194103', 'FE194105', 'FE194106', 'FE194111', 'FE194141', 'FE194143', 'FE194146', 'FE194148', 'FE194183', 'FE194184', 'FE194185', 'FE194186', 'FE194213', 'FE194215', 'FE194217', 'FE194218', 'FE194219', 'FE194221', 'FE194222', 'FE194223', 'FE194224', 'FE194225', 'FE194226', 'FE194227', 'FE194228', 'FE194229', 'FE194230', 'FE194231', 'FE194246', 'FE194247', 'FE194248', 'FE194561', 'FE194587', 'FE194594', 'FE194595', 'FE194598', 'FE194600', 'FE194603', 'FE194604', 'FE194605', 'FE194612', 'FE194613', 'FE194615', 'FE194619', 'FE194622', 'FE194625', 'FE194628', 'FE194631', 'FE194637', 'FE194642', 'FE194643', 'FE194646', 'FE194648', 'FE194649', 'FE194655', 'FE194670', 'FE194672', 'FE194674', 'FE194675', 'FE194688', 'FE194728', 'FE194729', 'FE194730', 'FE194732', 'FE194733', 'FE194735', 'FE194738', 'FE194913', 'FE194942', 'FE195001', 'FE195003', 'FE195006', 'FE195008', 'FE195009', 'FE195012', 'FE195013', 'FE195016', 'FE195019', 'FE195023', 'FE195024', 'FE195026', 'FE195028', 'FE195030', 'FE195429', 'FE195430', 'FE195960', 'FE195962', 'FE195963', 'FE195964', 'FE195980', 'FE195987', 'FE195988', 'FE195989', 'FE196002', 'FE196113', 'FE196147', 'FE196148', 'FE196151', 'FE196152', 'FE196153', 'FE196156', 'FE196157', 'FE196158', 'FE196160', 'FE196161', 'FE196163', 'FE196164', 'FE196165', 'FE196167', 'FE196170', 'FE196171', 'FE196173', 'FE196174', 'FE196175', 'FE196176', 'FE196178', 'FE196180', 'FE196184', 'FE196187', 'FE196188', 'FE196189', 'FE196191', 'FE196193', 'FE196194', 'FE196196', 'FE196198', 'FE196199', 'FE196201', 'FE196203', 'FE196207', 'FE196215', 'FE196216', 'FE196220', 'FE196221', 'FE196222', 'FE196224', 'FE196225', 'FE196231', 'FE196232', 'FE196234', 'FE196236', 'FE196238', 'FE196240', 'FE196243', 'FE196244', 'FE196245', 'FE196253', 'FE196266', 'FE196270', 'FE196273', 'FE196278', 'FE196594', 'FE196596', 'FE196628', 'FE196631', 'FE196632', 'FE196636', 'FE196644', 'FE196656', 'FE196657', 'FE196658', 'FE196660', 'FE196661', 'FE196817', 'FE196820', 'FE196822', 'FE196823', 'FE196825', 'FE196828', 'FE196829', 'FE196833', 'FE196834', 'FE196836', 'FE196839', 'FE196844', 'FE196848', 'FE196850', 'FE196852', 'FE196855', 'FE196856', 'FE196857', 'FE196858', 'FE196860', 'FE196861', 'FE196862', 'FE196863', 'FE196865', 'FE196866', 'FE196870', 'FE196874', 'FE196877', 'FE196896', 'FE196897', 'FE196898', 'FE196899', 'FE196901', 'FE196902', 'FE196903', 'FE196904', 'FE196905', 'FE196906', 'FE196907', 'FE196909', 'FE196911', 'FE196913', 'FE196915', 'FE196917', 'FE196928', 'FE196932', 'FE196935', 'FE196939', 'FE196942', 'FE196943', 'FE196949', 'FE196952', 'FE196954', 'FE196957', 'FE196967', 'FE196969', 'FE196976', 'FE196977', 'FE196979', 'FE196980', 'FE196982', 'FE196984', 'FE196993', 'FE196995', 'FE196998', 'FE197000', 'FE197011', 'FE197012', 'FE197013', 'FE197018', 'FE197019', 'FE197021', 'FE197059', 'FE197060', 'FE197075', 'FE197077', 'FE197079', 'FE197080', 'FE197082', 'FE197086', 'FE197089', 'FE197090', 'FE197094', 'FE197095', 'FE197097', 'FE197098', 'FE197099', 'FE197100', 'FE197101', 'FE197104', 'FE197107', 'FE197110', 'FE197205', 'FE197206', 'FE197207', 'FE197208', 'FE197209', 'FE197210', 'FE197211', 'FE197212', 'FE197213', 'FE197215', 'FE197217', 'FE197218', 'FE197219', 'FE197220', 'FE197221', 'FE197222', 'FE197223', 'FE197224', 'FE197225', 'FE197229', 'FE197230', 'FE197232', 'FE197233', 'FE197234', 'FE197235', 'FE197237', 'FE197238', 'FE197240', 'FE197241', 'FE197242', 'FE197243', 'FE197244', 'FE197247', 'FE197249', 'FE197251', 'FE197253', 'FE197257', 'FE197261', 'FE197263', 'FE197266', 'FE197279', 'FE197282', 'FE197444', 'FE197445', 'FE197451', 'FE197452', 'FE197467', 'FE197469', 'FE197470', 'FE197473', 'FE197474', 'FE197476', 'FE197477', 'FE197480', 'FE197481', 'FE197484', 'FE197485', 'FE197491', 'FE197492', 'FE197493', 'FE197496', 'FE197506', 'FE197507', 'FE197512', 'FE197514', 'FE197516', 'FE197517', 'FE197520', 'FE197525', 'FE197526', 'FE197528', 'FE197530', 'FE197533', 'FE197534', 'FE197535', 'FE197537', 'FE197539', 'FE197540', 'FE197542', 'FE197547', 'FE197554', 'FE197555', 'FE197556', 'FE197557', 'FE197559', 'FE197560', 'FE197561', 'FE197562', 'FE197564', 'FE197567', 'FE197568', 'FE197569', 'FE197570', 'FE197574', 'FE197917', 'FE197919', 'FE197921', 'FE197952', 'FE197955', 'FE197956', 'FE197960', 'FE197962', 'FE197965', 'FE197967', 'FE197997', 'FE197998', 'FE198000', 'FE198007', 'FE198009', 'FE198010', 'FE198011', 'FE198012', 'FE198013', 'FE198015', 'FE198016', 'FE198017', 'FE198045', 'FE198047', 'FE198049', 'FE198099', 'FE198100', 'FE198102', 'FE198106', 'FE198107', 'FE198110', 'FE198112', 'FE198118', 'FE198119', 'FE198123', 'FE198125', 'FE198127', 'FE198129', 'FE198130', 'FE198134', 'FE198138', 'FE198143', 'FE198144', 'FE198146', 'FE198148', 'FE198149', 'FE198151', 'FE198153', 'FE198155', 'FE198156', 'FE198159', 'FE198161', 'FE198162', 'FE198163', 'FE198165', 'FE198166', 'FE198167', 'FE198171', 'FE198173', 'FE198175', 'FE198181', 'FE198182', 'FE198188', 'FE198190', 'FE198195', 'FE198200', 'FE198208', 'FE198212', 'FE198214', 'FE198216', 'FE198221', 'FE198245', 'FE198253', 'FE198255', 'FE198262', 'FE198266', 'FE199543', 'FE199544', 'FE199776', 'FE200459', 'FE200462', 'FE200466', 'FE200488', 'FE200490', 'FE201136', 'FE201137', 'FE201138', 'FE201139', 'FE201141', 'FE201144', 'FE201149', 'FE201798', 'FE201799', 'FE201812', 'FE201814', 'FE201817', 'FE201819', 'FE201822', 'FE201860', 'FE201861', 'FE201864', 'FE201865', 'FE201866', 'FE201868', 'FE201869', 'FE201872', 'FE201875', 'FE201881', 'FE201886', 'FE201887', 'FE201890', 'FE201892', 'FE201893', 'FE201896', 'FE201897', 'FE201898', 'FE201899', 'FE201905', 'FE201906', 'FE201908', 'FE201911', 'FE201912', 'FE201916', 'FE201920', 'FE201969', 'FE202008', 'FE202014', 'FE202018', 'FE202041', 'FE202042', 'FE202043', 'FE202049', 'FE202146', 'FE202740', 'FE203079', 'FE203082', 'FE203084', 'FE203085', 'FE203087', 'FE203091', 'FE203095', 'FE203096', 'FE203100', 'FE203102', 'FE203107', 'FE203108', 'FE203110', 'FE203118', 'FE203128', 'FE203129', 'FE203130', 'FE203131', 'FE203135', 'FE203138', 'FE203141', 'FE203143', 'FE203145', 'FE203151', 'FE203157', 'FE203165', 'FE203166', 'FE203167', 'FE203169', 'FE203178', 'FE203202', 'FE203206', 'FE203208', 'FE203209', 'FE203210', 'FE203211', 'FE203212', 'FE203213', 'FE203214', 'FE203215', 'FE203316', 'FE203317', 'FE203318', 'FE203319', 'FE203503', 'FE203634', 'FE203676', 'FE203778', 'FE203823', 'FE203828', 'FE203829', 'FE203830', 'FE203831', 'FE203832', 'FE203833', 'FE203835', 'FE203836', 'FE203837', 'FE203840', 'FE203841', 'FE203842', 'FE203843', 'FE203844', 'FE203845', 'FE203846', 'FE203847', 'FE203849', 'FE203851', 'FE203852', 'FE203853', 'FE203855', 'FE203856', 'FE203857', 'FE203858', 'FE203859', 'FE203860', 'FE203861', 'FE203862', 'FE203863', 'FE203864', 'FE203865', 'FE203866', 'FE203867', 'FE203870', 'FE203872', 'FE203875', 'FE203879', 'FE203885', 'FE203886', 'FE203887', 'FE203888', 'FE203890', 'FE203892', 'FE203893', 'FE203894', 'FE203895', 'FE203897', 'FE203898', 'FE203899', 'FE203900', 'FE203901', 'FE203903', 'FE203905', 'FE203906', 'FE203907', 'FE203908', 'FE203909', 'FE203910', 'FE203911', 'FE203912', 'FE203916', 'FE203919', 'FE203921', 'FE203924', 'FE204024', 'FE204093', 'FE204570', 'FE204692', 'FE204712', 'FE204963', 'FE204990', 'FE205009', 'FE205012', 'FE205042', 'FE205082', 'FE205086', 'FE205096', 'FE205100', 'FE205102', 'FE205103', 'FE205107', 'FE205113', 'FE205114', 'FE205115', 'FE205142', 'FE205189', 'FE205247', 'FE205253', 'FE205376', 'FE205699', 'FE205701', 'FE205702', 'FE205704', 'FE205715', 'FE205716', 'FE205717', 'FE205718', 'FE205721', 'FE205722', 'FE205723', 'FE205730', 'FE205734', 'FE205750', 'FE205751', 'FE205752', 'FE205753', 'FE205755', 'FE205756', 'FE205757', 'FE205758', 'FE206571', 'FE206580', 'FE206581', 'FE206591', 'FE206592', 'FE206593', 'FE206594', 'FE206596', 'FE206598', 'FE206599', 'FE206604', 'FE206613', 'FE206619', 'FE206621', 'FE206623', 'FE206625', 'FE206633', 'FE206640', 'FE206646', 'FE206648', 'FE206660', 'FE206667', 'FE206761', 'FE206762', 'FE206766', 'FE206767', 'FE206768', 'FE206770', 'FE206771', 'FE206776', 'FE206782', 'FE206788', 'FE206793', 'FE206795'];

/* try to connect */
$inbox = imap_open($hostname, $username, $password) or die('Cannot connect to Gmail: ' . imap_last_error());


/* get all new emails. If set to 'ALL' instead 
 * of 'NEW' retrieves all the emails, but can be 
 * resource intensive, so the following variable, 
 * $max_emails, puts the limit on the number of emails downloaded.
 * 
 */
//$emails = imap_search($inbox,'ALL');
$emails = imap_search($inbox, 'TO "facturacionelectronicasalud@emssanar.org.co" SINCE "17 September 2021" BEFORE "30 October 2021"');

/* useful only if the above search is set to 'ALL' */
$max_emails = 100000;


/* if any emails found, iterate through each email */
if ($emails) {

    $count = 1;


    /* put the newest emails on top */
    rsort($emails);

    /* for every email... */
    $archivotxt = fopen("registros.txt", "a+");
    foreach ($emails as $email_number) {
        $arrasunto = [];
        //print_r($email_number);
        /* get information specific to this email */
        $overview = imap_fetch_overview($inbox, $email_number, 0);
        //print_r($overview);
        foreach ($overview as $correo) {
            //echo $correo->date."|".$correo->subject."<br>";

            $arrasunto = explode(";", $correo->subject);
            fwrite($archivotxt, $correo->date . "|" . $arrasunto[2] . "\n");
            echo "El Numero de Factura es " . $arrasunto[2];
        }
        if (array_search($arrasunto[2], $facturasMario) >= 0) {
            /* get mail message */
            $message = imap_fetchbody($inbox, $email_number, 2);

            /* get mail structure */
            $structure = imap_fetchstructure($inbox, $email_number);


            $attachments = array();

            /* if any attachments found... */
            if (isset($structure->parts) && count($structure->parts)) {
                for ($i = 0; $i < count($structure->parts); $i++) {
                    $attachments[$i] = array(
                        'is_attachment' => false,
                        'filename' => '',
                        'name' => '',
                        'attachment' => ''
                    );

                    if ($structure->parts[$i]->ifdparameters) {
                        foreach ($structure->parts[$i]->dparameters as $object) {
                            if (strtolower($object->attribute) == 'filename') {
                                $attachments[$i]['is_attachment'] = true;
                                $attachments[$i]['filename'] = $object->value;
                            }
                        }
                    }

                    if ($structure->parts[$i]->ifparameters) {
                        foreach ($structure->parts[$i]->parameters as $object) {
                            if (strtolower($object->attribute) == 'name') {
                                $attachments[$i]['is_attachment'] = true;
                                $attachments[$i]['name'] = $object->value;
                            }
                        }
                    }

                    if ($attachments[$i]['is_attachment']) {
                        $attachments[$i]['attachment'] = imap_fetchbody($inbox, $email_number, $i + 1);

                        /* 4 = QUOTED-PRINTABLE encoding */
                        if ($structure->parts[$i]->encoding == 3) {
                            $attachments[$i]['attachment'] = base64_decode($attachments[$i]['attachment']);
                        }
                        /* 3 = BASE64 encoding */ elseif ($structure->parts[$i]->encoding == 4) {
                            $attachments[$i]['attachment'] = quoted_printable_decode($attachments[$i]['attachment']);
                        }
                    }
                }
            }

            /* iterate through each attachment and save it */
            foreach ($attachments as $attachment) {
                if ($attachment['is_attachment'] == 1) {
                    $filename = $attachment['name'];
                    if (empty($filename)) $filename = $attachment['filename'];

                    if (empty($filename)) $filename = time() . ".dat";

                    /* prefix the email number to the filename in case two emails
         * have the attachment with the same file name.
         */
                    //$fp = fopen($email_number . "-" . $filename, "w+");
                    $fp = fopen($filename, "w+");
                    fwrite($fp, $attachment['attachment']);
                    fclose($fp);
                }
            }
        }


        if ($count++ >= $max_emails) break;
    }
    fclose($archivotxt);
}

/* close the connection */
imap_close($inbox);

echo "Terminado";
