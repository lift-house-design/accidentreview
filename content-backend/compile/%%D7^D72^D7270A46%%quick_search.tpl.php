<?php /* Smarty version 2.6.16, created on 2012-08-29 20:16:26
         compiled from /var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/system/views/dashboard/quick_search.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'form', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/system/views/dashboard/quick_search.tpl', 1, false),array('block', 'lang', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/system/views/dashboard/quick_search.tpl', 5, false),array('function', 'image_url', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/system/views/dashboard/quick_search.tpl', 2, false),)), $this); ?>
<?php $this->_tag_stack[] = array('form', array('action' => "?route=quick_search",'method' => 'post','id' => 'quick_search_form')); $_block_repeat=true;smarty_block_form($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
  <input type="text" name="search_for" id="quick_search_input" /> <input type="image" src="<?php echo smarty_function_image_url(array('name' => "search_small.gif"), $this);?>
" id="quick_search_button" class="auto" /> <img src="<?php echo smarty_function_image_url(array('name' => "indicator.gif"), $this);?>
" alt="Working" id="quick_search_indicator" style="display: none" />
  <input type="hidden" name="search_type" value="in_projects" id="quick_search_type" />
  <ul>
    <li id="search_in_projects" class="selected"><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>In Projects<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></li>
    <li id="search_for_people"><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>For Users<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></li>
    <li id="search_for_projects"><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>For Projects<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></li>
  </ul>
  <div id="quick_search_results"></div>
<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_form($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
<script type="text/javascript">
  App.QuickSearch.init();
</script>