<?php
class Condos_Model extends Model{
	function __construct(){	
		parent::__construct();				
	}		
	
	function getGallery($cid){		
		$sth = $this->db->prepare("SELECT * FROM gallery WHERE cid=:cid ORDER BY CAST(description as SIGNED INTEGER) ASC");					
		$sth->bindParam(':cid', $cid);
		$sth->setFetchMode(PDO::FETCH_ASSOC);
		$sth->execute();
		return $sth->fetchAll();			
	}
	function getFloorPlans($cid){		
		$sth = $this->db->prepare("SELECT * FROM condos_files WHERE cid=:cid AND condo_cover IS NULL");					
		$sth->bindParam(':cid', $cid);
		$sth->setFetchMode(PDO::FETCH_ASSOC);
		$sth->execute();
		return $sth->fetchAll();		
	}	
	function getRecord($cid){		
		$sth = $this->db->prepare("SELECT * FROM condos WHERE cid=:cid");					
		$sth->bindParam(':cid', $cid);
		$sth->setFetchMode(PDO::FETCH_ASSOC);
		$sth->execute();
		return $sth->fetch();		
	}
	function getRecords(){
		$sth = $this->db->prepare("SELECT condos.*, (SELECT condos_files.filename FROM condos_files WHERE condos_files.cid = condos.cid AND condos_files.condo_cover='Yes') AS filename FROM condos WHERE condos.created_date IS NOT NULL ORDER BY created_date DESC");
		$sth->setFetchMode(PDO::FETCH_ASSOC);
		$sth->execute();
		return $sth->fetchAll();	
	}	
}
?>