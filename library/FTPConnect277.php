<?php

// +-----------------------------------------------------------------------------+
//
// Author:   Nilesh Hake <nbhbiotech.hake@gmail.com>
//
// +------------------------------------------------------------------------------+


require_once(dirname(__FILE__)."/../interface/globals.php");
require("../../vendor/autoload.php");
///var/www/html/nbh_openemr/vendor/phpseclib/phpseclib/phpseclib/Net/SFTP
use phpseclib3\Net\SFTP;

class SFTPConnect277 {

    // This have the remote directory
    private $remoteDir = '/import/';

   // This have the connect 
    private $sftpconn_id = '';

    private $eraFileDir;



    // Create connection for remote server
    public function __construct($ftp_server){
        $sftp = new SFTP($ftp_server);
        $this->sftpconn_id = $sftp;
        $this->eraFileDir = dirname(__FILE__) . "/../sites/default/documents/edi/";
    }

    // Login to FTP server
    public function sftpLogin($ftp_user_name, $ftp_user_pass,$ftp_server_dir){
        $sftp = $this->sftpconn_id;
        if (!$sftp->login($ftp_user_name, $ftp_user_pass)) {
            die("Not able to establish connection to SFTP at time of login");
        } else {
            $this->remoteDir = $ftp_server_dir;
            $this->sftpconn_id = $sftp;
            return $sftp;
        }
    }

    //Copy file to local server
	public function copy277FromClearingHosue(){
        $sftp = $this->sftpconn_id;
        $file_list = $sftp->nlist($this->remoteDir);
        $download_filename = array();
        foreach ($file_list as $key => $value) {
        	if(strpos($value,'.277')>-1){
            	if($sftp->get($this->remoteDir.$value,$this->eraFileDir."/".$value)) {
            		if($sftp->delete($this->remoteDir.$value)){
            			$download_filename[$value] = 'downloaded_deleted';
            		} else {
            			$download_filename[$value] = 'downloaded';
            		}
					//$this->retrieveDataFrom277($value);
            	} else {
            		$download_filename[$value] = 'not_able_to_download';
            	}
            }
        }
        return $download_filename;
	}

	public function retrieveDataFrom277($filePath277) {
			$filePath277 = dirname(__FILE__) . "/../sites/default/documents/edi/$filePath277";
			$file277 = fopen($filePath277, "r") or die("Unable to open file!");
			$fileCont = fread($file277,filesize($filePath277));
			$arr277File = explode("~", $fileCont);

			$segmentSTStatusStart = "";
			$segmentHLcount = 0;
			$segSTCount = 0;
			$currentHLNum = "";
			$data277arr = array();
			/*A0(Claim Status code):16(Claim Status Category code):PR*/
			/*NM1*41(Entity Identifier code)*2*ACCORDIUS HEALTH AT WILSON*****46*463356260~*/
			foreach ($arr277File as $line) {
				if(str_starts_with($line,'ST*')){
					$segmentSTStatusStart = "true";
					$segmentHLcount = $segmentHLcount+1;
				} elseif (str_starts_with($line,'SE*')) {
					$segmentSTStatusStart = "false";
					$segmentHLcount = 0;
					//$segSTCount = $segSTCount+1;
				} else {
					if ($segmentHLcount>=1 && $segmentSTStatusStart=="true") {
						if (str_starts_with($line,'HL*')) {
							$segHL = explode("*", $line);
							$currentHLNum = $segHL[1];
						} elseif (str_starts_with($line,'NM1*') && $currentHLNum=="4") {
							$segNM1 = explode("*", $line);
							$entityIdentifierCode = $segNM1[1];
						} elseif (str_starts_with($line,'TRN*') && $currentHLNum=="4") {
							$segTRN = explode("*", $line);
							$ptDetails = explode("-", $segTRN[2]);
						} elseif (str_starts_with($line,'STC*') && $currentHLNum=="4") {
							/*($currentHLNum=="2" || $currentHLNum=="3" || $currentHLNum=="4")*/
							$segSTC = explode("*", $line);
							$data277 = explode(":", $segSTC[1]);
							$data277arr[$segSTCount]['claimStatusCategoryCode'] = $data277[0];
							$data277arr[$segSTCount]['claimStatusCode'] = $data277[1];
							$data277arr[$segSTCount]['entityIdentifierCode'] = $data277[2];
							$data277arr[$segSTCount]['statusReasonCode'] = $segSTC[3];
							$data277arr[$segSTCount]['patientId'] = $ptDetails[0];
							$data277arr[$segSTCount]['encounterId'] = $ptDetails[1];

							if($segSTC[3]=="WQ") {
								$data277arr[$segSTCount]['status'] = "Accepted";
							} elseif ($segSTC[3]=="U") {
								$data277arr[$segSTCount]['status'] = "Rejected";
							}
							$segSTCount = $segSTCount+1;
						} elseif (str_starts_with($line,'QTY*')) {

						}
					} elseif ($segmentHLcount==0 && $segmentSTStatusStart=="false") {

					}
				}
			}
			fclose($file277);
			return $data277arr;
	}

    // Close FTP connection here
    public function disconnectFTP(){
        unset($this->sftpconn_id);
    }
}
