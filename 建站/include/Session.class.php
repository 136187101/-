<?php

	class Session {
		
		public function __construct() {
			session_start();
		}
		
		public function setValue($key, $value) {
			$_SESSION[$key] = $value;
		}
		
		public function getValue($key) {
			return $_SESSION[$key];	
		}
		
		public function destroySession() {
			session_unset();
			session_destroy();
		}
			
	}

?>