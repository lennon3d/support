<?php
if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
	// admin main
class Admin extends AdminController {
	function __construct() {
		parent::__construct ();
		$this->mfunctions->deleteGuests ();
	}
	
	// log out when user name press logout
	public function do_logout() {
		$this->session->sess_destroy ();
		redirect ( base_url () . 'admin/login' );
	}
	public function index() {
		$data["contactus"] = $this->mfunctions->getUnseenContactus();
		$data ["target"] = "dashboard";
		$this->load->view ( 'admin/index', $data );
	}
	
	// get site settings
	public function getSiteSettings() {
		return $this->mfunctions->getSiteSettings ();
	}
	
	// set site settings
	public function setSiteSettings() {
		if ($this->permissions->sitesettings ["modify"] != "1")
			$this->mfunctions->noPermission();
		if ($_POST) {
			$site_open = (isset ( $_POST ["site_open"] ) ? "1" : "0");
		$query = $this->mfunctions->setSiteSettings ( array (
					"facebook_link" => ($_POST ["facebook_link"] != "" ? $_POST ["facebook_link"] : "#"),
					"twitter_link" => ($_POST ["twitter_link"] != "" ? $_POST ["twitter_link"] : "#"),
					"youtube_link" => ($_POST ["youtube_link"] != "" ? $_POST ["youtube_link"] : "#"),
					"linkedin_link" => ($_POST ["linkedin_link"] != "" ? $_POST ["linkedin_link"] : "#"),
					"wiki_link" => ($_POST ["wiki_link"] != "" ? $_POST ["wiki_link"] : "#"),
					"instgram_link" => ($_POST ["instgram_link"] != "" ? $_POST ["instgram_link"] : "#"),
					"googleplus_link" => ($_POST ["googleplus_link"] != "" ? $_POST ["googleplus_link"] : "#"),
					"googleanalist_id" => $_POST ["googleanalist_id"],
					"alexa_id" => $_POST ["alexa_id"],
					"meta_tag" => $_POST ["meta_tag"],
					"meta_key" => $_POST ["meta_key"],
					"site_url" => $_POST ["site_url"],
					"admin_mobiles" => $_POST ["admin_mobiles"],
					"admin_emails" => $_POST ["admin_emails"],
					"site_open" => $site_open 
			) );
			
			$count = 0;
			$data ["message"] = "";
			foreach ( $_POST as $key => $value ) {
				$name_array = explode ( "_", $key );
				if (count ( $name_array ) == 3) {
					$name = $name_array [0] . "_" . $name_array [1];
					$lang_code = $name_array [2];
					$this->mfunctions->updateTitles ( $lang_code, $name, $value );
				}
			}
		$this->session->set_userdata ( array (
				"msg" => "1"
		) );
			redirect ( base_url () . "admin/siteSettings", "refresh" );
		}
	}
	
	// show site settings
	public function siteSettings() {
		if ($this->permissions->sitesettings ["see"] != "1")
			$this->mfunctions->noPermission();
		$settings = $this->mfunctions->getSiteSettings ();
		$data ["langs"] = $this->mfunctions->getAllLangs ();
		$data ["titles"] = $this->mfunctions->getSetTitles ();
		$data ["settings"] = $settings;
		$data ["target"] = "site_settings";
		$this->load->view ( "admin/index", $data );
	}
	
	// javascript output to put in site
	public function js() {
		header ( 'Content-Type: application/javascript' );
		$query = $this->db->get ( "sitesettings" );
		$settings = $query->row ();
		$url = $settings->site_url;
		$content = "var site_url = '" . $url . "'";
		exit ( $content );
	}
	
	// show browser
	public function browser() {
		if ($this->permissions->browser ["see"] != "1")
			$this->mfunctions->noPermission();
		$data ["target"] = "browser";
		$this->load->view ( "admin/index", $data );
	}
	
	// export to pdf
	public function exportPdf($body) {
		$this->load->library ( "MPDF56/mpdf.php", "UTF-8" );
		$this->mpdf=new mPDF('ar');
		$this->mpdf->SetDirectionality ( 'rtl' );
		$html = $body;
		$html = str_replace ( "\\\"", "\"", $html );
		$this->mpdf->useLang = true;
		$this->mpdf->WriteHTML ( $html );
		$this->mpdf->Output ();
		exit ();
	}
	
	// export table to pdf or excel
	public function exportTable() {
			$table = $this->mfunctions->getTableForFile($_POST["tbody"],$_POST["thead"]);
		$this->load->library('excel');
		$this->excel->setActiveSheetIndex(0);
		$this->excel->getActiveSheet()->getDefaultColumnDimension()->setWidth(12);
		$this->excel->getActiveSheet()->getDefaultRowDimension()->setRowHeight(20);
		$this->excel->getActiveSheet()->setTitle($_POST["table"]);
		$this->excel->getActiveSheet()->setCellValueByColumnAndRow(0, 1, lang("table"))->getStyle('A1')->getFont()->setBold(true)->getColor()->setARGB("00007A");
		$this->excel->getActiveSheet()->setCellValueByColumnAndRow(0, 1, lang("table"))->getStyle('B1')->getFont()->setBold(true)->getColor()->setARGB("00007A");
		$this->excel->getActiveSheet()->getStyle('A2:Z2')->getFont()->setBold(true)->getColor()->setARGB('8B6914');
		$this->excel->getActiveSheet()->setCellValueByColumnAndRow(1, 1, $_POST["table"]);
		$this->excel->getActiveSheet()->getRowDimension('1')->setRowHeight(20);
		$this->excel->getActiveSheet()->getRowDimension('2')->setRowHeight(20);
		for($i=1;$i<count($table["thead"]);$i++){
			$this->excel->getActiveSheet()->setCellValueByColumnAndRow($i, 2, $table["thead"][$i]);
		}
		for($i=1;$i<count($table["tbody"]);$i++){
			for($j=0;$j<count($table["thead"]);$j++)
				$this->excel->getActiveSheet()->setCellValueByColumnAndRow($j, $i+2, $table["tbody"][$i][$j]);
		}

		if($_POST["method"]=="excel2003"){
			$filename=$_POST["table"].".xls"; //save our workbook as this file name
			header("Content-Type: application/vnd.ms-excel");
			$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
		}elseif($_POST["method"]=="excel2007"){
			$filename=$_POST["table"].".xlsx"; //save our workbook as this file name
			header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
			$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel2007');
		}elseif($_POST["method"]=="pdf"){
			$html = "<div style='width:100%; padding:20px; text-align:center; background-color:#eee; color:#344275; font-weight:bold;'>".lang("table")." :: ".$_POST["table"]."</div>";
			if(isset($_POST["talent"])){
				$src = $_POST["src"];
				$html = "<div style='height: 200px; left: 20px; position: absolute; width: 150px; top:20px; border:1px solid black;'><img src='".$src."'/></div>";
			}
			$html.="<table colspan=3 style=' width:100%;border:1px solid black;'><thead><tr style='background-color:#BCBFEF'>";
			foreach($table["thead"] as $field){
				$html.="<th style='height:30px;'><span lang='ar'>".$field."</span></th>";
			}
			$html.="</tr></thead>";
			$html.="<tbody>";
			foreach($table["tbody"] as $tr){
				$html.="<tr>";
				foreach($tr as $td){
					$html.="<td style='border:1px solid black;padding:10px;'><span lang='ar'>".$td."</span></td>";
				}
				$html.="</tr>";
			}
			$html.="</tbody></table>";
			$this->exportPdf($html);
		}


		if($_POST["method"]!="pdf"){
			header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
			header('Cache-Control: max-age=0'); //no cache
			$objWriter->save('php://output');
		}
	}
}
