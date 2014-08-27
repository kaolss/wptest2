<?php

// Exit if accessed directly
if( !defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Main Widget Template
 *
 *
 * @file           sidebar.php
 * @package        Responsive
 * @author         Emil Uzelac
 * @copyright      2003 - 2014 CyberChimps
 * @license        license.txt
 * @version        Release: 1.0
 * @filesource     wp-content/themes/responsive/sidebar.php
 * @link           http://codex.wordpress.org/Theme_Development#Widgets_.28sidebar.php.29
 * @since          available since Release 1.0
 */

/*
 * Load the correct sidebar according to the page layout
 */
   dynamic_sidebar( 'home_right_1' ); 

