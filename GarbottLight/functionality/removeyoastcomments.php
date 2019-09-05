<?php

/*
Will Percey @ Riweb
will@Garbott.com

 */



if ( ! defined( 'ABSPATH' ) ) { exit; }



class RYSC {

	private $version = '5.1';

	private $debug_marker_removed = false;

	private $head_marker_removed = false;

	private $backup_plan_active = false;

	

	public function __construct() {

		add_action( 'init', array( $this, 'bundle' ), 1);

	}

	

	public function bundle() {

		if(defined( 'WPSEO_VERSION' )) {

			$debug_marker = ( version_compare( WPSEO_VERSION, '4.4', '>=' ) ) ? 'debug_mark' : 'debug_marker';



			// main function to unhook the debug msg

			if(class_exists( 'WPSEO_Frontend' ) && method_exists( 'WPSEO_Frontend', $debug_marker )) {

				remove_action( 'wpseo_head', array( WPSEO_Frontend::get_instance(), $debug_marker ) , 2);

				

				$this->debug_marker_removed = true;

				

				// also removes the end debug msg as of 5.9

				if(version_compare( WPSEO_VERSION, '5.9', '>=' )) $this->head_marker_removed = true;

			}

			

			// compatible solution for everything below 5.8

			if(class_exists( 'WPSEO_Frontend' ) && method_exists( 'WPSEO_Frontend', 'head' ) && version_compare( WPSEO_VERSION, '5.8', '<' )) {

				remove_action( 'wp_head', array( WPSEO_Frontend::get_instance(), 'head' ) , 1);

				add_action( 'wp_head', array($this, 'rewrite'), 1);

				$this->head_marker_removed = true;

			}

			

			// temp solution for all installations on 5.8

			if(version_compare( WPSEO_VERSION, '5.8', '==' )) {

				add_action('get_header', array( $this, 'buffer_header' ));

				add_action('wp_head', array( $this, 'buffer_head' ), 999);

				$this->head_marker_removed = true;

			}

			

			// backup solution

			if($this->operating_status() == 2) {

				add_action('get_header', array( $this, 'buffer_header' ));

				add_action('wp_head', array( $this, 'buffer_head' ), 999);

			}

			

			if(current_user_can('manage_options')) add_action( 'wp_dashboard_setup', array( $this, 'dash_widget' ) );

		}

		

		add_filter( 'plugin_action_links_' . plugin_basename( __FILE__ ), array( $this, 'plugin_links' ) );

	}

	

	public function operating_status() {

		if($this->debug_marker_removed && $this->head_marker_removed) {

			return 1;

		} elseif(!$this->debug_marker_removed && $this->head_marker_removed || $this->debug_marker_removed && !$this->head_marker_removed) {

			return 2;

		} else {

			return 3;

		}

	}

	

	public function dash_widget() {

		wp_add_dashboard_widget( 'dashboard_widget', 'Garbotts Remove Yoast SEO Comments <span></span><script>/*
		
	  var str = document.querySelector(".wrap").innerHTML; 
  var res = str.replace("<h1>Dashboard</h1>", "<h1>Garbott 2.0</h1>");
  document.querySelector(".wrap").innerHTML = res;
*/
</script>', array( $this, 'dash_widget_content' ) );

	}

	

	public function dash_widget_content() {

		if($this->operating_status() == 1) {

			$status = '<span style="color:#04B404;font-weight:bold">Fully supported</span>';

			$content = '<p>Version ' . WPSEO_VERSION . ' of Yoast SEO is fully supported by Garbott ' . $this->version . '. Frontend Comments have been removed.</p>';

		} elseif($this->operating_status() == 2) {

			$status = '<span style="color:#FF8000;font-weight:bold">Partially supported</span>';

			$content = '<p>Version ' . WPSEO_VERSION . ' of Yoast SEO is not properly supported by Garbott ' . $this->version . '. Some functions are not working. A backup solution has been enabled to keep the HTML comments removed.</p>';

		} elseif($this->operating_status() == 3) {

			$status = '<span style="color:#DF0101;font-weight:bold">Not supported</span>';

			$content = '<p>Version ' . WPSEO_VERSION . ' of Yoast SEO is not supported by Garbott ' . $this->version . '. A backup solution has been enabled to keep the HTML comments removed.</p>';

		}

		

		echo '<div class="activity-block"><h3><span class="dashicons dashicons-admin-plugins"></span> Yoast SEO ' . WPSEO_VERSION . ' Compatibility Status: ' . $status . '</h3></div>';

		echo $content;

	}

	

	// compatible solution for everything below 5.8

	public function rewrite() {

		$rewrite = new ReflectionMethod( 'WPSEO_Frontend', 'head' );

		

		$filename = $rewrite->getFileName();

		$start_line = $rewrite->getStartLine();

		$end_line = $rewrite->getEndLine()-1;



		$length = $end_line - $start_line;

		$source = file( $filename );

		$body = implode( '', array_slice($source, $start_line, $length) );

		$body = preg_replace( '/echo \'\<\!(.*?)\n/', '', $body);



		eval($body);

	}

	

	// temp solution for all installations on 5.8, and also the backup solution in the future

	public function buffer_header() {

		ob_start(function ($o) {

			return preg_replace('/\n?<.*?yoast.*?>/mi','',$o);

		});

	}

	

	public function buffer_head() {

		ob_end_flush();

	}

}



new RYSC;