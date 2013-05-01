<?php /* Smarty version 2.6.16, created on 2013-01-17 20:12:29
         compiled from /var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/system/views/_quick_search_project_objects.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'lang', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/system/views/_quick_search_project_objects.tpl', 2, false),array('function', 'cycle', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/system/views/_quick_search_project_objects.tpl', 6, false),array('function', 'object_star', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/system/views/_quick_search_project_objects.tpl', 7, false),array('function', 'object_link', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/system/views/_quick_search_project_objects.tpl', 9, false),array('function', 'project_link', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/system/views/_quick_search_project_objects.tpl', 9, false),array('function', 'assemble', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/system/views/_quick_search_project_objects.tpl', 16, false),)), $this); ?>
<div id="quick_search_project_objects_result">
  <h3><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Search Results<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></h3>
<?php if (is_foreachable ( $this->_tpl_vars['results'] )): ?>
  <table>
<?php $_from = $this->_tpl_vars['results']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['object']):
?>
    <tr class="<?php echo smarty_function_cycle(array('values' => 'odd,even'), $this);?>
">
      <td class="star"><?php echo smarty_function_object_star(array('object' => $this->_tpl_vars['object'],'user' => $this->_tpl_vars['logged_user']), $this);?>
</td>
      <td class="name">
        <?php echo smarty_function_object_link(array('object' => $this->_tpl_vars['object']), $this);?>
 <span class="details"><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>in<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?> <?php echo smarty_function_project_link(array('project' => $this->_tpl_vars['object']->getProject()), $this);?>
</span>
      </td>
    </tr>
<?php endforeach; endif; unset($_from); ?>
  </table>
  <?php if ($this->_tpl_vars['pagination']->hasNext()): ?>
  <?php $this->assign('items_per_page', $this->_tpl_vars['pagination']->getItemsPerPage()); ?>
  <p id="quick_search_more_results"><a href="<?php echo smarty_function_assemble(array('route' => 'search','q' => $this->_tpl_vars['search_for'],'type' => $this->_tpl_vars['search_type']), $this);?>
"><?php $this->_tag_stack[] = array('lang', array('count' => $this->_tpl_vars['pagination']->getTotalItems()-$this->_tpl_vars['items_per_page'])); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>:count more &raquo;<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a></p>
  <?php endif;  else: ?>
  <p><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>We haven't found any data in projects that matched your request<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></p>
<?php endif; ?>
</div>