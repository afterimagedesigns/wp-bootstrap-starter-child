<?php

	// Add shortcodes here

	// Array helper
	function print_array( $array ){
		if( !empty( $array ) ){
			echo '<pre>';
				print_r($array);
			echo '</pre>';
		}
	}

?>