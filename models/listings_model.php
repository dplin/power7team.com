<?php
class Listings_Model extends Model{
	function __construct(){	
		parent::__construct();				
	}	
	
	function getTotalPages($max = 10){
		$sth = $this->db->prepare("SELECT COUNT(*) FROM listings WHERE status <> 'Archived' OR status IS NULL");					
		$sth->setFetchMode(PDO::FETCH_ASSOC);
		$sth->execute();
		$numberRows = $sth->fetchColumn();		
		return ceil($numberRows/ $max);	
	}	
	function getGallery($lid){		
		$sth = $this->db->prepare("SELECT * FROM gallery WHERE lid=:lid ORDER BY CAST(description as SIGNED INTEGER) ASC");					
		$sth->bindParam(':lid', $lid);
		$sth->setFetchMode(PDO::FETCH_ASSOC);
		$sth->execute();
		return $sth->fetchAll();			
	}
	function getRecord($lid){		
		$sth = $this->db->prepare("SELECT * FROM listings WHERE lid=:lid");					
		$sth->bindParam(':lid', $lid);
		$sth->setFetchMode(PDO::FETCH_ASSOC);
		$sth->execute();
		return $sth->fetch();		
	}
	function getRecords($page = 0, $max = 10){
		$start = $page * $max;
		$sth = $this->db->prepare("SELECT listings.*, (SELECT gallery.filename FROM gallery WHERE gallery.lid = listings.lid AND gallery.album_cover='Yes') AS filename FROM listings WHERE listings.status <> 'Archived' OR listings.status IS NULL ORDER BY listed_date DESC LIMIT :start, :max");			
		$sth->bindValue(':start', (int) trim($start), PDO::PARAM_INT);
		$sth->bindValue(':max', $max, PDO::PARAM_INT);
		$sth->setFetchMode(PDO::FETCH_ASSOC);
		$sth->execute();
		return $sth->fetchAll();	
	}
	function renderNavigation($cntAround = 3, $page, $totalPages) {
		// Example: cntAround = 1, current = 5, cntPages = 9:
		// Output: [1] ... [4] 5 [6] ... [9]
		// Example: cntAround = 3, current = 5, cntPages = 11:
		// Output: [1] [2] [3] [4] 5 [6] [7] [8] ... [11]
		
		$out      = '';
		$isGap    = false; // A "gap" is the pages to skip
		$current  = $page; // Current page. 
		$cntPages = $totalPages; // Total number of pages

		for ($i = 0; $i < $cntPages; $i++) { // Run through pages
			$isGap = false;

			// Are we at a gap?
			if ($cntAround >= 0 && $i > 0 && $i < $cntPages - 1 && abs($i - $current) > $cntAround) { // If beyond "cntAround" and not first or last.
				$isGap    = true;

				// Skip to next linked item (or last if we've already run past the current page)
				$i = ($i < $current ? $current - $cntAround : $cntPages - 1) - 1;
			}

			$lnk = ($isGap ? '...' : ($i + 1)); // If gap, write ellipsis, else page number
			if ($i != $current && !$isGap) { // Do not link gaps and current
				$lnk = '<a href="'.URL.'listings/page/' . ($i + 1) . '">' . $lnk . '</a>';
			}else{
				if ($i == $current){
					$lnk = '<span>' . $lnk . '</span>';	// Wrap current page with <span> for styling.
				}
			}
			$out .= "\t<li>" . $lnk . "</li>\n"; // Wrap in list items
		}
		return "<ul>\n" . $out . '</ul>'; // Wrap in list
	}
	
	
}
?>