<?php
/**
 * Disable Feeds Test.
 *
 * @package    WP_CMS_Settings
 * @subpackage WP_CMS_Settings\Tests\Includes\Classes
 * @author     Jason Witt <contact@jawittdesigns.com>
 * @copyright  Copyright (c) 2017, Jason Witt
 * @license    GNU General Public License v2 or later
 * @version    0.0.1
 */

 /**
  * Main Plugin File Test.
  *
  * @author Jason Witt
  * @since  1.0.0
  */
 class Disable_Feeds_Test extends Base_UnitTestCase {

	 /**
	  * Options.
	  *
	  * @author Jason Witt
	  * @since  0.0.1
	  *
	  * @var array
	  */
	 protected $options;

	 /**
	  * SetUp.
	  *
	  * @author Jason Witt
	  * @since  0.0.1
	  *
	  * @return void
	  */
	 public function setUp() {
		 $this->file       = $this->dirname() . 'includes/classes/class-disable-feeds.php';
		 $this->class_name = 'WP_CMS_Settings\\Includes\\Classes\\Disable_Feeds';
		 $this->class      = new WP_CMS_Settings\Includes\Classes\Disable_Feeds();
		 $this->methods    = array(
			 'init',
			 'disable_feeds',
			 'disable_feed_page',
		 );
		 $this->properties  = array(
			 'settings',
		 );
		 $this->set_the_options();
	 }

	 /**
	  * Test Init.
	  *
	  * @author Jason Witt
	  * @since  0.0.1
	  *
	  * @return void
	  */
	 public function test_init() {
		 $this->class->init();
		 $hooks = array(
			 array(
				 'hook_name' => 'init',
				 'type'      => 'add_action',
				 'method'    => 'disable_feeds',
			 ),
		 );
		 $this->assertAddHooks( $hooks );
	 }

	 /**
	  * Disable Emojis.
	  *
	  * @author Jason Witt
	  * @since  0.0.1
	  *
	  * @return void
	  */
	 public function test_disable_feeds() {
		 $this->class->disable_feeds();
		 $hooks = array();
		 $actions = array(
			'do_feed',
			'do_feed_rdf',
			'do_feed_rss',
			'do_feed_rss2',
			'do_feed_atom',
			'do_feed_rss2_comments',
			'do_feed_atom_comments',
		 );
		 foreach ( $actions as $action ) {
			 $hooks[] = array(
				 'hook_name' => $action,
				 'type'      => 'add_filter',
				 'method'    => 'disable_feed_page',
				 'priority'  => 1,
			 );
		 }
		 $this->assertAddHooks( $hooks );
	 }

	 /**
	  * Test Settings.
	  *
	  * @author Jason Witt
	  * @since  0.0.1
	  *
	  * @return void
	  */
	 public function test_settings() {
		$disable_feeds = ( isset( $this->options['disable_feeds'] ) ) ? $this->options['disable_feeds'] : 'false';
		$this->assertEquals( 'true', $disable_feeds );
	 }
 }
