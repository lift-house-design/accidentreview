<?php /* Smarty version 2.6.16, created on 2012-08-03 20:58:03
         compiled from /var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/system/views/users/edit_avatar.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'title', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/system/views/users/edit_avatar.tpl', 1, false),array('block', 'add_bread_crumb', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/system/views/users/edit_avatar.tpl', 2, false),array('block', 'assign_var', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/system/views/users/edit_avatar.tpl', 12, false),array('block', 'link', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/system/views/users/edit_avatar.tpl', 13, false),array('block', 'wrap', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/system/views/users/edit_avatar.tpl', 17, false),array('block', 'label', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/system/views/users/edit_avatar.tpl', 18, false),array('block', 'wrap_buttons', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/system/views/users/edit_avatar.tpl', 22, false),array('block', 'submit', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/system/views/users/edit_avatar.tpl', 23, false),array('function', 'file_field', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/system/views/users/edit_avatar.tpl', 19, false),)), $this); ?>
<?php $this->_tag_stack[] = array('title', array()); $_block_repeat=true;smarty_block_title($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Update avatar<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_title($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack);  $this->_tag_stack[] = array('add_bread_crumb', array()); $_block_repeat=true;smarty_block_add_bread_crumb($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Update avatar<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_add_bread_crumb($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>

<div id="edit_icon">
  <form method="POST" action="<?php echo $this->_tpl_vars['active_user']->getEditAvatarUrl(); ?>
" enctype="multipart/form-data" class="uniForm">
    <div class="blockLabels">
      <?php if (file_exists ( $this->_tpl_vars['active_user']->getAvatarPath(true) )): ?>
        <div class="current_avatar">
          <div id="updated_icon">
            <img src="<?php echo $this->_tpl_vars['active_user']->getAvatarUrl(true); ?>
" alt="" />
          </div>
          <?php $this->_tag_stack[] = array('assign_var', array('name' => 'request_type')); $_block_repeat=true;smarty_block_assign_var($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start();  if ($this->_tpl_vars['request']->isAsyncCall()): ?>get<?php else: ?>post<?php endif;  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_assign_var($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
          <p class="details"><?php $this->_tag_stack[] = array('link', array('href' => $this->_tpl_vars['active_user']->getDeleteAvatarUrl(),'class' => 'delete_current','method' => $this->_tpl_vars['request_type'])); $_block_repeat=true;smarty_block_link($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Delete Current Avatar<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_link($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></p>
        </div>
      <?php endif; ?>
      
      <?php $this->_tag_stack[] = array('wrap', array('field' => 'avatar')); $_block_repeat=true;smarty_block_wrap($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
        <?php $this->_tag_stack[] = array('label', array('for' => 'userAvatar')); $_block_repeat=true;smarty_block_label($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>New Avatar<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_label($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
        <?php echo smarty_function_file_field(array('name' => 'avatar','id' => 'userAvatar'), $this);?>

      <?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_wrap($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
      
      <?php $this->_tag_stack[] = array('wrap_buttons', array()); $_block_repeat=true;smarty_block_wrap_buttons($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
      	<?php $this->_tag_stack[] = array('submit', array()); $_block_repeat=true;smarty_block_submit($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Submit<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_submit($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
      <?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_wrap_buttons($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
      <input type="hidden" style="display: none;" value="submitted" name="submitted"/>
    </div>
  </form>
</div>