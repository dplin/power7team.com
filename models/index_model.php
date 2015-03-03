<?php
class Index_Model extends Model{
	function __construct(){	
		parent::__construct();				
	}		

	function getRecords($table){
		if ($table == "listings"){
			$sth = $this->db->prepare("SELECT listings.*, (SELECT gallery.filename FROM gallery WHERE gallery.lid = listings.lid AND gallery.album_cover='Yes') AS filename FROM listings WHERE listings.status <> 'Archived' OR listings.status IS NULL ORDER BY listed_date DESC LIMIT 0, 12");
			$sth->setFetchMode(PDO::FETCH_ASSOC);
			$sth->execute();
			return $sth->fetchAll();	
		}else{
			$sth = $this->db->prepare("SELECT condos.*, (SELECT condos_files.filename FROM condos_files WHERE condos_files.cid = condos.cid AND condos_files.condo_cover='Yes') AS filename FROM condos WHERE condos.created_date IS NOT NULL ORDER BY created_date DESC LIMIT 0, 6");
			$sth->setFetchMode(PDO::FETCH_ASSOC);
			$sth->execute();
			return $sth->fetchAll();	
		}
		
	}	
}
?>