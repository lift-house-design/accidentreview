<?php

/**
   * Lightbox module definition
   *
   * @package activeCollab.modules.lightbox
   * @subpackage models
   */
class LightboxModule extends Module {


	/**
     * Plain module name
     *
     * @var string
     */
	var $name = 'lightbox';

	/**
     * Is system module flag
     *
     * @var boolean
     */
	var $is_system = false;

	/**
     * Module version
     *
     * @var string
     */
	var $version = '1.0';
	
	/**
     * Install module
     *
     * @param void
     * @return boolean
     */
	function install() {
		return parent::install();
	} // install

	/**
     * Uninstall this module
     *
     * @param void
     * @return boolean
     */
	function uninstall() {
		return parent::uninstall();
	} // uninstall


	/**
     * Get module display name
     *
     * @return string
     */
	function getDisplayName() {
		return lang('Lightbox');
	} // getDisplayName

	/**
     * Return module description
     *
     * @param void
     * @return string
     */
	function getDescription() {
		return lang('Adds lightbox for images');
	} // getDescription

	/**
     * Return module uninstallation message
     *
     * @param void
     * @return string
     */
	function getUninstallMessage() {
		return lang('Module will be deactivated. Images will open in new window');
	} // getUninstallMessage
}

?>