<?php
class Admin_Model extends Model{
	function __construct(){	
		parent::__construct();		
	}
	function parse_yturl() 
	{
		$pattern = '#^(?:https?://)?(?:www\.)?(?:youtu\.be/|youtube\.com(?:/embed/|/v/|/watch\?v=|/watch\?.+&v=))([\w-]{11})(?:.+)?$#x';
		preg_match($pattern, $_POST['youtube'], $matches);
		return (isset($matches[1])) ? $matches[1] : false;
	}	
	function deleteFloorPlan(){				
		// Initialize Delete
		$cwd = getcwd();
		chdir($cwd.'/views/admin/server');
		require('UploadHandler.php');	
		chdir($cwd);			
		
		// Manually change the request method to DELETE
		$_SERVER['REQUEST_METHOD'] = 'DELETE';
		// Delete handler need a filename from $_GET['file']
		$_GET['file'] = $_POST['filename'];
		// Instantiate UploadHandler will start Delete immediately
		$upload_handler = new UploadHandler();
		
		// Remove from table
		$sth = $this->db->prepare('DELETE FROM condos_files WHERE fid=:fid');
		$sth->bindParam(':fid', $_POST['fid']);		
		return $sth->execute();		
	}
	function deleteCoverImage(){
		$image = $this->getCoverImage($_POST['cid']);
		
		// Initialize Delete
		$cwd = getcwd();
		chdir($cwd.'/views/admin/server');
		require('UploadHandler.php');	
		chdir($cwd);			
		
		// Manually change the request method to DELETE
		$_SERVER['REQUEST_METHOD'] = 'DELETE';
		// Delete handler need a filename from $_GET['file']
		$_GET['file'] = $image['filename'];
		// Instantiate UploadHandler will start Delete immediately
		$upload_handler = new UploadHandler();
		
		// Remove from table
		$sth = $this->db->prepare('DELETE FROM condos_files WHERE fid=:fid');
		$sth->bindParam(':fid', $image['fid']);		
		return $sth->execute();	
	}
	function getFloorPlan($cid){
		$sth = $this->db->prepare("SELECT * FROM condos_files WHERE cid=:cid AND condo_cover IS NULL ORDER BY filename");			
		$sth->bindParam(':cid', $cid);		
		$sth->setFetchMode(PDO::FETCH_ASSOC);
		$sth->execute();
		return $sth->fetchAll();			
	}
	function getCoverImage($cid){
		$sth = $this->db->prepare("SELECT * FROM condos_files WHERE cid=:cid AND condo_cover='Yes'");			
		$sth->bindParam(':cid', $cid);		
		$sth->setFetchMode(PDO::FETCH_ASSOC);
		$sth->execute();
		return $sth->fetch();			
	}
	function getCondo($cid){
		$sth = $this->db->prepare("SELECT * FROM condos WHERE cid=:cid");			
		$sth->bindParam(':cid', $cid);		
		$sth->setFetchMode(PDO::FETCH_ASSOC);
		$sth->execute();
		return $sth->fetch();		
	}
	function getCondos(){
		$sth = $this->db->prepare("SELECT * FROM condos ORDER BY created_date DESC");			
		$sth->setFetchMode(PDO::FETCH_ASSOC);
		$sth->execute();
		return $sth->fetchAll();	
	}
	function deleteCondo(){		
		$sth = $this->db->prepare('DELETE FROM condos WHERE cid=:cid');
		$sth->bindParam(':cid', $_POST['cid']);		
		return $sth->execute();	
	}		
	function addCondo(){		
		if (isset($_POST['ammenities'])){
			// Trim ammenities
			$ammenities = array_map('trim',$_POST['ammenities']);
			// Rebuild ammenities
			$newAmm = '';
			for ($i = 0; $i < count($ammenities); $i++){
				$newAmm .= $ammenities[$i].';';
			}
			$newAmm = rtrim($newAmm, ';');
			// Remove ammenities from $_POST
			unset($_POST['ammenities']);
		}
		// Trim all the $_POST variables
		$_POST = array_map('trim', $_POST);	

		$sth = $this->db->prepare('INSERT INTO condos(address, city, postal_zip, condo_name, builder, website, price, pre_construction, closing_date, number_of_buildings, number_of_units, number_of_storeys, ceiling_height_from, ceiling_height_to, ceiling_unit, maintenance_fee, electrical_includes, ammenities, other_ammenities, description, created_date) VALUES(:address, :city, UCASE(:postal_zip), :condo_name, :builder, :website, :price, :pre_construction, :closing_date, :number_of_buildings, :number_of_units, :number_of_storeys, :ceiling_height_from, :ceiling_height_to, :ceiling_unit, :maintenance_fee, :electrical_includes, :ammenities, :other_ammenities, :description, CURDATE())');
		$sth->bindParam(':address', $_POST['address']);
		$sth->bindParam(':city', $_POST['city']);
		$sth->bindParam(':postal_zip', $_POST['postal_zip']);
		$sth->bindParam(':condo_name', $_POST['condo_name']);
		$sth->bindParam(':builder', $_POST['builder']);
		$sth->bindParam(':website', $_POST['website']);
		$sth->bindParam(':price', $_POST['price']);
		$sth->bindParam(':pre_construction', $_POST['pre_construction']);
		$sth->bindParam(':closing_date', $_POST['closing_date']);
		$sth->bindParam(':number_of_buildings', $_POST['number_of_buildings']);
		$sth->bindParam(':number_of_units', $_POST['number_of_units']);
		$sth->bindParam(':number_of_storeys', $_POST['number_of_storeys']);
		$sth->bindParam(':ceiling_height_from', $_POST['ceiling_height_from']);
		$sth->bindParam(':ceiling_height_to', $_POST['ceiling_height_to']);
		$sth->bindParam(':ceiling_unit', $_POST['ceiling_unit']);
		$sth->bindParam(':maintenance_fee', $_POST['maintenance_fee']); 
		$sth->bindParam(':electrical_includes', $_POST['electrical_includes']); 
		$sth->bindParam(':ammenities', $newAmm);
		$sth->bindParam(':other_ammenities', $_POST['other_ammenities']);
		$sth->bindParam(':description', $_POST['description']);	
		$sth->setFetchMode(PDO::FETCH_ASSOC);		
		$sth->execute();		
		$current_id = $this->db->lastInsertId();
		return $current_id;			
	}	
	function saveCondo(){
		if (isset($_POST['ammenities'])){
			// Trim ammenities
			$ammenities = array_map('trim',$_POST['ammenities']);
			// Rebuild ammenities
			$newAmm = '';
			for ($i = 0; $i < count($ammenities); $i++){
				$newAmm .= $ammenities[$i].';';
			}
			$newAmm = rtrim($newAmm, ';');
			// Remove ammenities from $_POST
			unset($_POST['ammenities']);
		}	
		// Trim all the $_POST variables
		$_POST = array_map('trim', $_POST);
		
		$this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sth = $this->db->prepare('UPDATE condos SET address=:address, city=:city, postal_zip=UCASE(:postal_zip), condo_name=:condo_name, builder=:builder, website=:website, price=:price, pre_construction=:pre_construction, closing_date=:closing_date, number_of_buildings=:number_of_buildings, number_of_units=:number_of_units, number_of_storeys=:number_of_storeys, ceiling_height_from=:ceiling_height_from, ceiling_height_to=:ceiling_height_to, ceiling_unit=:ceiling_unit, maintenance_fee=:maintenance_fee, electrical_includes=:electrical_includes, ammenities=:ammenities, other_ammenities=:other_ammenities, description=:description, created_date=:created_date WHERE cid=:cid');				
		$sth->bindParam(':address', $_POST['address']);
		$sth->bindParam(':city', $_POST['city']);
		$sth->bindParam(':postal_zip', $_POST['postal_zip']);
		$sth->bindParam(':condo_name', $_POST['condo_name']);
		$sth->bindParam(':builder', $_POST['builder']);
		$sth->bindParam(':website', $_POST['website']);
		$sth->bindParam(':price', $_POST['price']);
		$sth->bindParam(':pre_construction', $_POST['pre_construction']);
		$sth->bindParam(':closing_date', $_POST['closing_date']);
		$sth->bindParam(':number_of_buildings', $_POST['number_of_buildings']);
		$sth->bindParam(':number_of_units', $_POST['number_of_units']);
		$sth->bindParam(':number_of_storeys', $_POST['number_of_storeys']);
		$sth->bindParam(':ceiling_height_from', $_POST['ceiling_height_from']);
		$sth->bindParam(':ceiling_height_to', $_POST['ceiling_height_to']);
		$sth->bindParam(':ceiling_unit', $_POST['ceiling_unit']);
		$sth->bindParam(':maintenance_fee', $_POST['maintenance_fee']); 
		$sth->bindParam(':electrical_includes', $_POST['electrical_includes']); 
		$sth->bindParam(':ammenities', $newAmm);
		$sth->bindParam(':other_ammenities', $_POST['other_ammenities']);
		$sth->bindParam(':description', $_POST['description']);	
		$sth->bindParam(':created_date', $_POST['created_date']);
		$sth->bindParam(':cid', $_POST['cid']);
		$sth->setFetchMode(PDO::FETCH_ASSOC);		
		return $sth->execute();	
	}
	function saveYoutube(){
		// Trim all the $_POST variables
		$_POST = array_map('trim', $_POST);
		
		// Delete Youtube URL		
		if ($_POST['deleteYoutube'] == "true"){						
			$_POST['youtube'] = null;
			
			if (isset($_POST['lid'])){	// Listings Table
				$sth = $this->db->prepare('UPDATE listings SET youtube=:youtube WHERE lid=:lid');
				$sth->bindParam(':youtube', $_POST['youtube']);
				$sth->bindParam(':lid', $_POST['lid']);	
			}elseif (isset($_POST['cid'])){	// Condos Table
				$sth = $this->db->prepare('UPDATE condos SET youtube=:youtube WHERE cid=:cid');
				$sth->bindParam(':youtube', $_POST['youtube']);
				$sth->bindParam(':cid', $_POST['cid']);				
			}
			$sth->setFetchMode(PDO::FETCH_ASSOC);		
			return $sth->execute();					
		}else{
			// Is it a valid URL?
			$isYoutube = $this->parse_yturl();				

			// Save Youtube URL				
			if ($isYoutube){				
				if (isset($_POST['lid'])){	// Listings Table
					$sth = $this->db->prepare('UPDATE listings SET youtube=:youtube WHERE lid=:lid');
					$sth->bindParam(':youtube', $_POST['youtube']);
					$sth->bindParam(':lid', $_POST['lid']);					
				}elseif (isset($_POST['cid'])){	// Condos Table
					$sth = $this->db->prepare('UPDATE condos SET youtube=:youtube WHERE cid=:cid');
					$sth->bindParam(':youtube', $_POST['youtube']);
					$sth->bindParam(':cid', $_POST['cid']);					
				}
				$sth->setFetchMode(PDO::FETCH_ASSOC);		
				$sth->execute();			
				return $isYoutube;
			}else{
				return 0;
			}			
		}
	}
	function saveGallery(){	
		// Trim all the $_POST variables
		$_POST = array_map('trim', $_POST);
		
		// Decode JSON into array.  For delete list
		$deleteList = json_decode($_POST['deleteList'], true);
		
		// Decode JSON into array.  For image description.
		$arr = json_decode($_POST['gallery'], true);		
		
		// Loop through Array. Update description and album cover
		for ($i = 0; $i < count($arr); $i++){
			if (strpos($arr[$i]['name'], 'description') === 0) {					// Find description		
				// Save Description
				$sth = $this->db->prepare('UPDATE gallery SET description=:description WHERE gid=:gid');
				$sth->bindParam(':description', $arr[$i]['value']);
				$gid = substr($arr[$i]['name'], 11);
				$sth->bindParam(':gid', $gid);
				$sth->setFetchMode(PDO::FETCH_ASSOC);
				$sth->execute();
			}elseif (strpos($arr[$i]['name'], 'album_cover') === 0) {				// Find album cover
				if (isset($_POST['lid'])){	// Listings Table
					// Reset Album Cover
					$sth = $this->db->prepare('UPDATE gallery SET album_cover=NULL WHERE lid=:lid');
					$sth->bindParam(':lid', $_POST['lid']);
					$sth->setFetchMode(PDO::FETCH_ASSOC);
					$sth->execute();				
				}elseif (isset($_POST['cid'])){	// Condos Table
					// Reset Album Cover
					$sth = $this->db->prepare('UPDATE gallery SET album_cover=NULL WHERE cid=:cid');
					$sth->bindParam(':cid', $_POST['cid']);
					$sth->setFetchMode(PDO::FETCH_ASSOC);
					$sth->execute();
				}			
				// Save Album Cover
				$sth = $this->db->prepare('UPDATE gallery SET album_cover="Yes" WHERE gid=:gid');
				$sth->bindParam(':gid', $arr[$i]['value']);
				$sth->setFetchMode(PDO::FETCH_ASSOC);
				$sth->execute();
			}			
		}				

		if (count($deleteList) > 0){
			// Initialize Delete
			$cwd = getcwd();
			chdir($cwd.'/views/admin/server');
			require('UploadHandler.php');	
			chdir($cwd);
			
			// Loop through Array. Delete binary files
			for ($i = 0; $i < count($deleteList); $i++){		
				// Manually change the request method to DELETE
				$_SERVER['REQUEST_METHOD'] = 'DELETE';
				// Delete handler need a filename from $_GET['file']
				$_GET['file'] = $deleteList[$i]['filename'];
				// Instantiate UploadHandler will start Delete immediately
				$upload_handler = new UploadHandler();
				
				// Delete image(s) from gallery table
				$sth = $this->db->prepare('DELETE FROM gallery WHERE gid=:gid');
				$sth->bindParam(':gid', $deleteList[$i]['gid']);	
				$success = $sth->execute();					
			}		
		}
		ob_get_clean();
		return true;
	}
	function addImage(){		
		if (isset($_POST['lid'])){	// Listings Table
			$sth = $this->db->prepare('INSERT INTO gallery(filename, size, lid) VALUES(:filename, :size, :lid)');				
			$sth->bindParam(':filename', $_POST['filename']);
			$sth->bindParam(':size', $_POST['size']);
			$sth->bindParam(':lid', $_POST['lid']);			
		}elseif (isset($_POST['cid'])){	// Condos Table
			$sth = $this->db->prepare('INSERT INTO gallery(filename, size, cid) VALUES(:filename, :size, :cid)');				
			$sth->bindParam(':filename', $_POST['filename']);
			$sth->bindParam(':size', $_POST['size']);
			$sth->bindParam(':cid', $_POST['cid']);			
		}elseif (isset($_POST['tid'])){	// Condos_files Table						
			$old_cover_image = $this->getCoverImage($_POST['tid']);
			
			// Delete Old Cover Image
			if ($old_cover_image){
				// Initialize Delete
				$cwd = getcwd();
				chdir($cwd.'/views/admin/server');
				require('UploadHandler.php');	
				chdir($cwd);			
				
				// Manually change the request method to DELETE
				$_SERVER['REQUEST_METHOD'] = 'DELETE';
				// Delete handler need a filename from $_GET['file']
				$_GET['file'] = $old_cover_image['filename'];
				// Instantiate UploadHandler will start Delete immediately
				$upload_handler = new UploadHandler();
				
				// Remove from table
				$sth = $this->db->prepare('DELETE FROM condos_files WHERE fid=:fid');
				$sth->bindParam(':fid', $old_cover_image['fid']);		
				$sth->execute();									
			}
			
			// Add New Cover Image
			$sth = $this->db->prepare('INSERT INTO condos_files(filename, size, cid, condo_cover) VALUES(:filename, :size, :cid, "Yes")');				
			$sth->bindParam(':filename', $_POST['filename']);
			$sth->bindParam(':size', $_POST['size']);
			$sth->bindParam(':cid', $_POST['tid']);					
		}elseif (isset($_POST['sid'])){	// Condos_files Table			
			$sth = $this->db->prepare('INSERT INTO condos_files(filename, size, cid) VALUES(:filename, :size, :cid)');				
			$sth->bindParam(':filename', $_POST['filename']);
			$sth->bindParam(':size', $_POST['size']);
			$sth->bindParam(':cid', $_POST['sid']);					
		}	
		$sth->setFetchMode(PDO::FETCH_ASSOC);		
		$sth->execute();		
		$current_id = $this->db->lastInsertId();
		return $current_id;
	}	
	function getGallery($id, $table){
		if ($table == "listings"){
			$sth = $this->db->prepare("SELECT * FROM gallery WHERE lid=:lid ORDER BY ISNULL(description), CAST(description as SIGNED INTEGER) ASC;");			
			$sth->bindParam(':lid', $id);				
		}elseif ($table == "condos"){
			$sth = $this->db->prepare("SELECT * FROM gallery WHERE cid=:cid ORDER BY ISNULL(description), CAST(description as SIGNED INTEGER) ASC;");			
			$sth->bindParam(':cid', $id);						
		}
		$sth->setFetchMode(PDO::FETCH_ASSOC);
		$sth->execute();
		return $sth->fetchAll();	
	}
	function getListing($lid){		
		$sth = $this->db->prepare("SELECT * FROM listings WHERE lid=:lid");			
		$sth->bindParam(':lid', $lid);		
		$sth->setFetchMode(PDO::FETCH_ASSOC);
		$sth->execute();
		return $sth->fetch();			
	}
	function getListings($listing_type){
		if ($listing_type == "active"){
			$sth = $this->db->prepare("SELECT * FROM listings WHERE status <> 'Archived' OR status IS NULL");			
		}elseif ($listing_type == "archived"){
			$sth = $this->db->prepare("SELECT * FROM listings WHERE status = 'Archived'");			
		}
		$sth->setFetchMode(PDO::FETCH_ASSOC);
		$sth->execute();
		return $sth->fetchAll();		
	}	
	function deleteListing(){		
		$sth = $this->db->prepare('DELETE FROM listings WHERE lid=:lid');
		$sth->bindParam(':lid', $_POST['lid']);		
		return $sth->execute();	
	}	
	function addListing(){		
		// Trim all the $_POST variables
		$_POST = array_map('trim', $_POST);	

		$sth = $this->db->prepare('INSERT INTO listings(address, suite_number, neighborhood, city, postal_zip, mls_location, status, listed_date, expiry_date, price, rent_lease, rent_lease_length, price_highlight, general_highlight, mls_number, development_level, development_type, has_suite, style, year_built, size, size_unit, bedrooms, plus, bathrooms, garage, garage_type, garage_note, basement, basement_type, basement_note, virtual_tour_url, lot_legal, lot_type, lot_size, lot_size_unit, dimensions_w, dimensions_l, dimensions_unit, amount, amount_for_year, condo_fee, description) VALUES(:address, :suite_number, :neighborhood, :city, UCASE(:postal_zip), :mls_location, :status, :listed_date, :expiry_date, :price, :rent_lease, :rent_lease_length, :price_highlight, :general_highlight, :mls_number, :development_level, :development_type, :has_suite, :style, :year_built, :size, :size_unit, :bedrooms, :plus, :bathrooms, :garage, :garage_type, :garage_note, :basement, :basement_type, :basement_note, :virtual_tour_url, :lot_legal, :lot_type, :lot_size, :lot_size_unit, :dimensions_w, :dimensions_l, :dimensions_unit, :amount, :amount_for_year, :condo_fee, :description)');
		$sth->bindParam(':address', $_POST['address']);
		$sth->bindParam(':suite_number', $_POST['suite_number']);
		$sth->bindParam(':neighborhood', $_POST['neighborhood']);
		$sth->bindParam(':city', $_POST['city']);
		$sth->bindParam(':postal_zip', $_POST['postal_zip']);
		$sth->bindParam(':mls_location', $_POST['mls_location']);
		$sth->bindParam(':status', $_POST['status']);
		$sth->bindParam(':listed_date', $_POST['listed_date']);
		$sth->bindParam(':expiry_date', $_POST['expiry_date']);
		$sth->bindParam(':price', $_POST['price']);
		$sth->bindParam(':rent_lease', $_POST['rent_lease']);
		$sth->bindParam(':rent_lease_length', $_POST['rent_lease_length']);
		$sth->bindParam(':price_highlight', $_POST['price_highlight']);
		$sth->bindParam(':general_highlight', $_POST['general_highlight']);
		$sth->bindParam(':mls_number', $_POST['mls_number']);
		$sth->bindParam(':development_level', $_POST['development_level']);
		$sth->bindParam(':development_type', $_POST['development_type']);
		$sth->bindParam(':has_suite', $_POST['has_suite']);
		$sth->bindParam(':style', $_POST['style']);
		$sth->bindParam(':year_built', $_POST['year_built']);
		$sth->bindParam(':size', $_POST['d_size']);
		$sth->bindParam(':size_unit', $_POST['size_unit']);
		$sth->bindParam(':bedrooms', $_POST['bedrooms']);
		$sth->bindParam(':plus', $_POST['plus']);
		$sth->bindParam(':bathrooms', $_POST['bathrooms']);
		$sth->bindParam(':garage', $_POST['garage']);
		$sth->bindParam(':garage_type', $_POST['garage_type']);
		$sth->bindParam(':garage_note', $_POST['garage_note']);
		$sth->bindParam(':basement', $_POST['basement']);
		$sth->bindParam(':basement_type', $_POST['basement_type']);
		$sth->bindParam(':basement_note', $_POST['basement_note']);
		$sth->bindParam(':virtual_tour_url', $_POST['virtual_tour_url']);		
		$sth->bindParam(':lot_legal', $_POST['lot_legal']);
		$sth->bindParam(':lot_type', $_POST['lot_type']);
		$sth->bindParam(':lot_size', $_POST['lot_size']);
		$sth->bindParam(':lot_size_unit', $_POST['lot_size_unit']);		
		$sth->bindParam(':dimensions_w', $_POST['dimensions_w']);
		$sth->bindParam(':dimensions_l', $_POST['dimensions_l']);
		$sth->bindParam(':dimensions_unit', $_POST['dimensions_unit']);		
		$sth->bindParam(':amount', $_POST['amount']);
		$sth->bindParam(':amount_for_year', $_POST['amount_for_year']);
		$sth->bindParam(':condo_fee', $_POST['condo_fee']);
		$sth->bindParam(':description', $_POST['description']);
		$sth->setFetchMode(PDO::FETCH_ASSOC);		
		$sth->execute();		
		$current_id = $this->db->lastInsertId();
		return $current_id;			
	}
	function saveListing(){
		// Trim all the $_POST variables
		$_POST = array_map('trim', $_POST);
		
		$sth = $this->db->prepare('UPDATE listings SET address=:address, suite_number=:suite_number, neighborhood=:neighborhood, city=:city, postal_zip=UCASE(:postal_zip), mls_location=:mls_location, status=:status, listed_date=:listed_date, expiry_date=:expiry_date, price=:price, rent_lease=:rent_lease, rent_lease_length=:rent_lease_length, price_highlight=:price_highlight, general_highlight=:general_highlight, mls_number=:mls_number, development_level=:development_level, development_type=:development_type, has_suite=:has_suite, style=:style, year_built=:year_built, size=:size, size_unit=:size_unit, bedrooms=:bedrooms, plus=:plus, bathrooms=:bathrooms, garage=:garage, garage_type=:garage_type, garage_note=:garage_note, basement=:basement, basement_type=:basement_type, basement_note=:basement_note, virtual_tour_url=:virtual_tour_url, lot_legal=:lot_legal, lot_type=:lot_type, lot_size=:lot_size, lot_size_unit=:lot_size_unit, dimensions_w=:dimensions_w, dimensions_l=:dimensions_l, dimensions_unit=:dimensions_unit, amount=:amount, amount_for_year=:amount_for_year, condo_fee=:condo_fee, description=:description WHERE lid=:lid');				
		$sth->bindParam(':address', $_POST['address']);
		$sth->bindParam(':suite_number', $_POST['suite_number']);
		$sth->bindParam(':neighborhood', $_POST['neighborhood']);
		$sth->bindParam(':city', $_POST['city']);
		$sth->bindParam(':postal_zip', $_POST['postal_zip']);
		$sth->bindParam(':mls_location', $_POST['mls_location']);
		$sth->bindParam(':status', $_POST['status']);
		$sth->bindParam(':listed_date', $_POST['listed_date']);
		$sth->bindParam(':expiry_date', $_POST['expiry_date']);
		$sth->bindParam(':price', $_POST['price']);
		$sth->bindParam(':rent_lease', $_POST['rent_lease']);
		$sth->bindParam(':rent_lease_length', $_POST['rent_lease_length']);
		$sth->bindParam(':price_highlight', $_POST['price_highlight']);
		$sth->bindParam(':general_highlight', $_POST['general_highlight']);
		$sth->bindParam(':mls_number', $_POST['mls_number']);
		$sth->bindParam(':development_level', $_POST['development_level']);
		$sth->bindParam(':development_type', $_POST['development_type']);
		$sth->bindParam(':has_suite', $_POST['has_suite']);
		$sth->bindParam(':style', $_POST['style']);
		$sth->bindParam(':year_built', $_POST['year_built']);
		$sth->bindParam(':size', $_POST['d_size']);
		$sth->bindParam(':size_unit', $_POST['size_unit']);
		$sth->bindParam(':bedrooms', $_POST['bedrooms']);
		$sth->bindParam(':plus', $_POST['plus']);
		$sth->bindParam(':bathrooms', $_POST['bathrooms']);
		$sth->bindParam(':garage', $_POST['garage']);
		$sth->bindParam(':garage_type', $_POST['garage_type']);
		$sth->bindParam(':garage_note', $_POST['garage_note']);
		$sth->bindParam(':basement', $_POST['basement']);
		$sth->bindParam(':basement_type', $_POST['basement_type']);
		$sth->bindParam(':basement_note', $_POST['basement_note']);
		$sth->bindParam(':virtual_tour_url', $_POST['virtual_tour_url']);	
		$sth->bindParam(':lot_legal', $_POST['lot_legal']);
		$sth->bindParam(':lot_type', $_POST['lot_type']);
		$sth->bindParam(':lot_size', $_POST['lot_size']);
		$sth->bindParam(':lot_size_unit', $_POST['lot_size_unit']);		
		$sth->bindParam(':dimensions_w', $_POST['dimensions_w']);
		$sth->bindParam(':dimensions_l', $_POST['dimensions_l']);
		$sth->bindParam(':dimensions_unit', $_POST['dimensions_unit']);		
		$sth->bindParam(':amount', $_POST['amount']);
		$sth->bindParam(':amount_for_year', $_POST['amount_for_year']);
		$sth->bindParam(':condo_fee', $_POST['condo_fee']);
		$sth->bindParam(':description', $_POST['description']);
		$sth->bindParam(':lid', $_POST['lid']);
		$sth->setFetchMode(PDO::FETCH_ASSOC);		
		return $sth->execute();
	}
	function changePassword(){
		// Make sure Old Password is correct
		$sth = $this->db->prepare('SELECT salt FROM users WHERE email = :email');		
		$sth->bindParam(':email', $_SESSION['email']);
		$sth->setFetchMode(PDO::FETCH_ASSOC);
		$sth->execute();	
		
		$salt = $sth->fetchColumn();
		
		$saltedPW = $_POST['password'] . $salt;
		
		$hashedPW = hash('sha256', $saltedPW);
		
		$sth = $this->db->prepare('SELECT access_type FROM users WHERE email = :email AND password = :password');		
		$sth->bindParam(':email', $_SESSION['email']);
		$sth->bindParam(':password', $hashedPW);		
		$sth->setFetchMode(PDO::FETCH_ASSOC);
		$sth->execute();			
				
		if ($sth->rowCount() > 0){			
			// Old Password is correct.  Now changing to new password.
			$pass = $_POST['new_password'];
			
			$salt = bin2hex(mcrypt_create_iv(32, MCRYPT_DEV_URANDOM));
			
			$saltedPW =  $pass . $salt;
			
			$hashedPW = hash('sha256', $saltedPW);	
						
			$sth = $this->db->prepare('UPDATE users SET password=:password, salt=:salt WHERE email=:email');				
			$sth->bindParam(':password', $hashedPW);
			$sth->bindParam(':salt', $salt);
			$sth->bindParam(':email', $_SESSION['email']);
			$sth->setFetchMode(PDO::FETCH_ASSOC);
			return $sth->execute();
		}else{
			return false;
		}
	}
	function checkPassword(){	
		$sth = $this->db->prepare('SELECT salt FROM users WHERE email = :email');				
		$sth->bindParam(':email', $_SESSION['email']);
		$sth->setFetchMode(PDO::FETCH_ASSOC);
		$sth->execute();	
		
		$salt = $sth->fetchColumn();
		
		$saltedPW = $_POST['password'] . $salt;
		
		$hashedPW = hash('sha256', $saltedPW);
		
		$sth = $this->db->prepare('SELECT access_type FROM users WHERE email = :email AND password = :password');		
		$sth->bindParam(':email', $_SESSION['email']);
		$sth->bindParam(':password', $hashedPW);		
		$sth->setFetchMode(PDO::FETCH_ASSOC);
		$sth->execute();			
		
		$access_type = $sth->fetchColumn();
				
		if ($sth->rowCount() > 0){		
			return 'true';
		}else{
			return 'false';
		}
	}	
}
?>