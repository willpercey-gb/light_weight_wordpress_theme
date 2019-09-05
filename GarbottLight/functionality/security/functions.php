<?php

if ( ! defined( 'ABSPATH' ) ) { 
    exit;
}

function isSecure() {
  return(!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off');
}

function http_security_issues_count() {
	$count = 0;

	if ( ! ( isSecure() ) ) {
		$count++;
	}
	if ( username_exists( 'admin' ) ) {
		$count++;
	}
	return $count;
}