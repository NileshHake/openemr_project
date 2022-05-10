<?php

require_once "../globals.php";

require("$srcdir/FTPConnect277.php");


/*$ftp_server = 'SFTP1.CLAIMSNET.COM';
$ftp_user_name = '115244';
$ftp_user_pass = '^}#Q|h1>';
$ftp_server_dir = '/test/';*/

$ftp_server = 'ftp10.officeally.com';
$ftp_user_name = 'kloutisuc';
$ftp_user_pass = 'Dls3oKgQly';
$ftp_server_dir = '../../sites/default/documents/edi';

$clearhousesql = sqlStatement("select * from globals where gl_name in('clearing_house_host_name','clearing_house_user_name','clearing_house_pass_name','clearing_house_277_imp_dir')");

while($rowclearhouse = sqlFetchArray($clearhousesql)){
    if($rowclearhouse['gl_name']=='clearing_house_host_name'){
        $ftp_server = $rowclearhouse['gl_value'];
    } elseif ($rowclearhouse['gl_name']=='clearing_house_user_name') {
        $ftp_user_name = $rowclearhouse['gl_value'];
    } elseif ($rowclearhouse['gl_name']=='clearing_house_pass_name') {
        $ftp_user_pass = $rowclearhouse['gl_value'];
    } elseif ($rowclearhouse['gl_name']=='clearing_house_277_imp_dir') {
        $ftp_server_dir = "/".trim($rowclearhouse['gl_value'])."/";
    }
}

$obj = new SFTPConnect277($ftp_server);
$loginDetail = $obj->sftpLogin($ftp_user_name,$ftp_user_pass,$ftp_server_dir);

$fileDownloadedSFTP = $obj->copy277FromClearingHosue();

$displayMessage = "";

foreach ($fileDownloadedSFTP as $key => $value) {
	$displayMessage ="277 File downloaded";
	if($value=="downloaded_deleted" || $value=="downloaded"){
		$data277 = $obj->retrieveDataFrom277($key);
		$sets = "claimid = ?,
	    claim_status_category_code = ?,
	    claim_status_code = ?,
	    entity_identifier_code = ?,
	    date_received = ?,
	    version = ?,
	    date_update = NOW(),
	    statusReasonCode = ?,
	    pid = ?,
	    encounter = ?,
	    status = ?";
	    $messageDetail ="";
		for ($i=0; $i < sizeof($data277); $i++) {
			$messageDetail =" and inserted data into OpenEMR";
			sqlInsert(
		        "INSERT INTO claims_status277 SET $sets",
		        [
		            "",
		            $data277[$i]['claimStatusCategoryCode'],
		            $data277[$i]['claimStatusCode'],
		            $data277[$i]["entityIdentifierCode"],
		            "",
		            "",
		            $data277[$i]["statusReasonCode"],
		            $data277[$i]["patientId"],
		            $data277[$i]["encounterId"],
		            $data277[$i]["status"]
		        ]
		    );
		}
	}
}
$displayMessage = $displayMessage.$messageDetail;
if($displayMessage!="") {
	echo $displayMessage;
} else {
	echo "277 is not available on SFTP server";
}
		
	


