<?php
/**
 * Base Test Class.
 *
 * @package    WP_CMS_Settings
 * @subpackage WP_CMS_Settings\Tests
 * @author     Jason Witt <contact@jawittdesigns.com>
 * @copyright  Copyright (c) 2017, Jason Witt
 * @license    GNU General Public License v2 or later
 * @version    0.0.1
 */

/**
 * Base
 */
abstract class Base_UnitTestCase extends \WP_UnitTestCase {

	/**
	 * File.
	 *
	 * @since NEXT
	 *
	 * @var strinf
	 */
	protected $file = '';

	/**
	 * Class Object.
	 *
	 * @since NEXT
	 *
	 * @var obnject
	 */
	protected $class = '';

	/**
	 * Class name.
	 *
	 * @since NEXT
	 *
	 * @var string
	 */
	protected $class_name = '';

	/**
	 * Methods.
	 *
	 * @since NEXT
	 *
	 * @var array
	 */
	protected $methods = array();

	/**
	 * Properties.
	 *
	 * @since NEXT
	 *
	 * @var array
	 */
	protected $properties = array();

	/**
	 * Options.
	 *
	 * @author Jason Witt
	 * @since  0.0.1
	 *
	 * @var array
	 */
	protected $options = array();

	/**
	 * Properties.
	 *
	 * @since NEXT
	 *
	 * @var array
	 */
	protected $dirname;

	/**
	 * Set the options.
	 *
	 * @author Jason Witt
	 * @since  0.0.1
	 *
	 * @return void
	 */
	public function set_the_options() {

		// Run activation.
		WP_CMS_Settings\wp_cms_settings()->_activate();

		// Get the options.
		$this->options = ( is_multisite() ) ? get_site_option( 'wp_cms_settings' ) : get_option( 'wp_cms_settings' );

		// Set settings property.
		$this->set_property( $this->class, 'settings', $this->options );
	}

	/**
	 * Initialize the class
	 *
	 * @since  NEXT
	 *
	 * @return string
	 */
	public function dirname() {
		return trailingslashit( plugin_dir_path( __DIR__ ) );
	}

	/**
	 * Test if file file exists.
	 *
	 * @since NEXT
	 *
	 * @return void
	 */
	public function test_file_exists() {

		// Is String sanity check.
		if ( $this->file && is_string( $this->file ) || $this->file && ! empty( $this->file ) ) {
			$this->assertFileExists( $this->file );
		}
	}

	/**
	 * Test if class exists.
	 *
	 * @since NEXT
	 */
	public function test_class_exists() {

		// Is String sanity check.
		if ( $this->class_name && is_string( $this->class_name ) || $this->class_name && ! empty( $this->class_name ) ) {
			$this->assertTrue( class_exists( $this->class_name ), 'The class "' . $this->class_name . '()" doesn\'t exist!' );
		}
	}

	/**
	 * Test if methods exist.
	 *
	 * @since NEXT
	 *
	 * @return void
	 */
	public function test_methods_exist() {

		// Is Array sanity check.
		if ( $this->methods && ( is_array( $this->methods ) && ! empty( $this->methods ) ) ) {
			foreach ( $this->methods as $method ) {
				$this->assertTrue( method_exists( $this->class_name, $method ), 'The method "' . $method . '()" doesn\'t exist!' );
			}
		}
	}

	/**
	 * Test if wp_roles property exists.
	 *
	 * @since NEXT
	 *
	 * @return void
	 */
	public function test_property_exists() {

		// Is Array sanity check.
		if ( $this->properties && ( is_array( $this->properties ) && ! empty( $this->properties ) ) ) {
			foreach ( $this->properties as $property ) {
				$this->assertTrue( property_exists( $this->class_name, $property ), 'The property "$' . $property . '" doesn\'t exist!' );
			}
		}
	}

	/**
	 * Test add hooks.
	 *
	 * @author Jason Witt
	 * @since  0.0.1
	 *
	 * @param array $args {
	 *     The Arguments.
	 *
	 *     @type string  $hook_name The hook's name.
	 *     @type string  $type      The type of hook.
	 *     @type string  $method    The name of the method to hook.
	 *     @type integer $priority  The priority of the hook execution.
	 * }
	 *
	 * @return void
	 */
	public function assertAddHooks( $args ) {

		// Loop through the hooks.
		foreach ( $args as $hook ) {

			// Bail if parameters are not set.
			if ( ! isset( $hook['hook_name'] ) || ! isset( $hook['method'] ) || ! isset( $hook['type'] ) ) {
				return;
			}

			// Defualts.
			$defaults = array(
				'hook_name' => '',
				'type'      => '',
				'method'    => '',
				'priority'  => 10,
			);

			// Arguments.
			$hook = wp_parse_args( $hook, $defaults );

			// Error message.
			$error = $hook['method'] . '() is not attached to ' . $hook['hook_name'] . '!';

			// Get the funtion to test.
			switch ( $hook['type'] ) {
				case 'add_action':
					$type = has_action( $hook['hook_name'], array( $this->class, $hook['method'] ) );
					break;
				case 'add_filter':
					$type = has_filter( $hook['hook_name'], array( $this->class, $hook['method'] ) );
					break;
			}

			// Test.
			$this->assertEquals( $hook['priority'], $type, $error );
		}
	}

	/**
	 * Set Property.
	 *
	 * @since NEXT
	 *
	 * @param object $object   The class object.
	 * @param string $property The name of the property to set.
	 * @param mixed  $value    The value to set the property to.
	 *
	 * @return void
	 */
	public function set_property( $object, $property, $value ) {
		$reflection = new ReflectionClass( $object );
		$reflection_property = $reflection->getProperty( $property );
		$reflection_property->setAccessible( true );
		$reflection_property->setValue( $object, $value );
	}

	/**
	 * Invoke Private Method.
	 *
	 * @since  NEXT
	 *
	 * @param object $object      The class object.
	 * @param string $method_name The name of the method to invoke.
	 * @param mixed  $parameters  The parameters of the method.
	 *
	 * @return mixed Method return.
	 */
	public function invoke_private_method( &$object, $method_name, $parameters = array() ) {
		$reflection = new \ReflectionClass( get_class( $object ) );
		$reflection_method = $reflection->getMethod( $method_name );
		$reflection_method->setAccessible( true );

		return $reflection_method->invokeArgs( $object, $parameters );
	}
}
