<?php /* Smarty version 2.6.16, created on 2012-07-31 18:45:04
         compiled from /var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/system/views/dashboard/new_since_last_visit.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'title', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/system/views/dashboard/new_since_last_visit.tpl', 1, false),array('block', 'add_bread_crumb', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/system/views/dashboard/new_since_last_visit.tpl', 2, false),array('block', 'lang', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/system/views/dashboard/new_since_last_visit.tpl', 7, false),array('block', 'pagination', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/system/views/dashboard/new_since_last_visit.tpl', 7, false),array('block', 'link', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/system/views/dashboard/new_since_last_visit.tpl', 36, false),array('function', 'assemble', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/system/views/dashboard/new_since_last_visit.tpl', 7, false),array('function', 'cycle', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/system/views/dashboard/new_since_last_visit.tpl', 17, false),array('function', 'object_star', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/system/views/dashboard/new_since_last_visit.tpl', 18, false),array('function', 'object_link', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/system/views/dashboard/new_since_last_visit.tpl', 20, false),array('function', 'action_on_by', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/system/views/dashboard/new_since_last_visit.tpl', 22, false),array('function', 'project_link', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/system/views/dashboard/new_since_last_visit.tpl', 28, false),array('modifier', 'clean', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/system/views/dashboard/new_since_last_visit.tpl', 20, false),)), $this); ?>
<?php $this->_tag_stack[] = array('title', array()); $_block_repeat=true;smarty_block_title($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>New Since Your Last Visit<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_title($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack);  $this->_tag_stack[] = array('add_bread_crumb', array()); $_block_repeat=true;smarty_block_add_bread_crumb($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>New<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_add_bread_crumb($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>

<div id="new_since_last_visit">
<?php if (is_foreachable ( $this->_tpl_vars['objects'] )): ?>
  <?php if ($this->_tpl_vars['pagination']->getLastPage() > 1): ?>
  <p class="pagination top"><span class="inner_pagination"><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Page<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>: <?php $this->_tag_stack[] = array('pagination', array('pager' => $this->_tpl_vars['pagination'])); $_block_repeat=true;smarty_block_pagination($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start();  echo smarty_function_assemble(array('route' => 'new_since_last_visit','page' => '-PAGE-'), $this); $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_pagination($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></span></p>
  <div class="clear"></div>
  <?php endif; ?>
  
  <table>
    <tr>
      <th></th>
      <th colspan="2"><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>What's new<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></th>
    </tr>
  <?php $_from = $this->_tpl_vars['objects']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['object']):
?>
    <tr class="<?php echo smarty_function_cycle(array('values' => 'odd,even'), $this);?>
">
      <td class="star"><?php echo smarty_function_object_star(array('object' => $this->_tpl_vars['object'],'user' => $this->_tpl_vars['logged_user']), $this);?>
</td>
      <td class="name">
        <?php echo ((is_array($_tmp=$this->_tpl_vars['object']->getVerboseType())) ? $this->_run_mod_handler('clean', true, $_tmp) : smarty_modifier_clean($_tmp)); ?>
: <?php echo smarty_function_object_link(array('object' => $this->_tpl_vars['object']), $this);?>

        <span class="details block">
        <?php echo smarty_function_action_on_by(array('datetime' => $this->_tpl_vars['object']->getCreatedOn(),'action' => 'Created','user' => $this->_tpl_vars['object']->getCreatedBy()), $this);?>
 
        <?php if (in_array ( strtolower ( $this->_tpl_vars['object']->getType() ) , array ( 'comment' , 'task' , 'attachment' ) )): ?>
          <?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>in<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?> <?php echo smarty_function_object_link(array('object' => $this->_tpl_vars['object']->getParent()), $this);?>
 
        <?php endif; ?>
        </span>
      </td>
      <td class="project"><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>in<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?> <?php echo smarty_function_project_link(array('project' => $this->_tpl_vars['object']->getProject()), $this);?>
</td>
    </tr>
  <?php endforeach; endif; unset($_from); ?>
  </table>
  
  <p id="mark_all_read">
    <a href="<?php echo smarty_function_assemble(array('route' => 'mark_all_read'), $this);?>
" id="mark_all_read_link"><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Mark All as Read<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a>
    <?php if ($this->_tpl_vars['request']->get('async')): ?>
      &middot; <?php $this->_tag_stack[] = array('link', array('href' => '?route=new_since_last_visit')); $_block_repeat=true;smarty_block_link($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Open in Separate Page<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_link($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
    <?php endif; ?>
  </p>
  <script type="text/javascript">
    App.system.MarkAllAsRead.init('new_since_last_visit');
  </script>
<?php else: ?>
  <p class="empty_page"><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>There is nothing new since your last visit<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></p>
<?php endif; ?>
</div>