<?php

  /**
   * Update activeCollab 2.3.1 to activeCollab 2.3.2
   *
   * @package activeCollab.upgrade
   * @subpackage scripts
   */
  class Upgrade_0020 extends UpgradeScript {
    
    /**
     * Initial system version
     *
     * @var string
     */
    var $from_version = '2.3.1';
    
    /**
     * Final system version
     *
     * @var string
     */
    var $to_version = '2.3.2';
    
    /**
     * Return script actions
     *
     * @return array
     */
    function getActions() {
    	return array(
    	  'updateExistingTables' => 'Update existing tables', 
    	  'endUpgrade' => 'Finish upgrade',
    	);
    } // getActions
    
    /**
     * Update length of MIME type fields
     *
     * @return boolean
     */
    function updateExistingTables() {
      $existing_tables = $this->utility->db->listTables(TABLE_PREFIX);
      
      $this->utility->db->execute("alter table " . TABLE_PREFIX . "attachments change mime_type mime_type varchar(255) not null default 'application/octet-stream'");
      $this->utility->db->execute('alter table ' . TABLE_PREFIX . 'project_objects change text_field_1 text_field_1 longtext');
      $this->utility->db->execute('alter table ' . TABLE_PREFIX . 'project_objects change text_field_2 text_field_2 longtext');
      
      if(in_array(TABLE_PREFIX . 'documents', $existing_tables)) {
        $this->utility->db->execute("alter table " . TABLE_PREFIX . "documents change mime_type mime_type varchar(255) null default null");
      } // if
      
      if(in_array(TABLE_PREFIX . 'incoming_mailboxes')) {
        $this->utility->db->execute('alter table ' . TABLE_PREFIX . 'incoming_mailboxes change id id int unsigned not null auto_increment');
      } // if
      
      return true;
    } // updateExistingTables
    
  }

?>