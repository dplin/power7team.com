<?php 
	class Bootstrap{
		function __construct(){
			/* Distinguish between URL, Function & Parameter(s) */
			$uriArray = preg_split('/\//', $_SERVER['REQUEST_URI'], -1, PREG_SPLIT_NO_EMPTY);		
			
			// Handling Empty URL
			if (empty($uriArray[1])){
				require 'controllers/index.php';				
				$controller = new Index();
				$controller->loadModel('index');
				// Load Home Page
				$controller->index();				
				return false;										// Stop further execution.
			}
			
			// Handling Non-Empty URL
			$file = 'controllers/' . $uriArray[1] . '.php';
			if (file_exists($file)){				
				require $file;
			}else{				
				// Load Error Page
				return $this->error();
			}					
			
			// Initialize URL
			$controller = new $uriArray[1];
			$controller->loadModel($uriArray[1]);
			
			// OPTIONAL: Check for optional Function & Parameters
			if (isset($uriArray[3])){
				if (method_exists($controller, $uriArray[2])){
					// Call URL with Function & Parameters
					if (isset($uriArray[5])){
						$controller->{$uriArray[2]}($uriArray[3], $uriArray[4], $uriArray[5]);		
					}elseif (isset($uriArray[4])){
						$controller->{$uriArray[2]}($uriArray[3], $uriArray[4]);		
					}else{
						$controller->{$uriArray[2]}($uriArray[3]);		
					}
				}else{
					$this->error();
				}				
			}else{
				if (isset($uriArray[2])){
					if (method_exists($controller, $uriArray[2])){
						// Call URL with Function				
						$controller->{$uriArray[2]}();									
					}else{						
						return $this->error();
					}					
				}else{
					// Render
					$controller->index();				
				}
			}				
		}
		
		function error(){
			/* 404 ERROR (page doesn't exists) */
			require 'controllers/error.php';
			$controller = new Error();
			$controller->index();
			return false;
		}
	}
?>