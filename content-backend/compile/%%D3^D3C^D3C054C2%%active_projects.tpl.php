<?php /* Smarty version 2.6.16, created on 2012-07-31 18:44:59
         compiled from /var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/system/views/dashboard/active_projects.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'lang', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/system/views/dashboard/active_projects.tpl', 5, false),array('function', 'cycle', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/system/views/dashboard/active_projects.tpl', 11, false),array('function', 'project_link', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/system/views/dashboard/active_projects.tpl', 13, false),array('function', 'project_progress', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/system/views/dashboard/active_projects.tpl', 19, false),array('modifier', 'clean', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/system/views/dashboard/active_projects.tpl', 12, false),)), $this); ?>
<div id="active_projects">
<?php if (is_foreachable ( $this->_tpl_vars['projects'] )): ?>
  <table class="common_table active_projects">
    <tr>
      <th colspan="2"><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Projects<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></th>
      <th><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Client<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></th>
      <th><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Progress<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></th>
    </tr>
  <?php $_from = $this->_tpl_vars['projects']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['project']):
?>
  <?php $this->assign('project_client', $this->_tpl_vars['project']->getCompany()); ?>
    <tr class="<?php echo smarty_function_cycle(array('values' => 'odd,even'), $this);?>
 active_project" pin_url="<?php echo $this->_tpl_vars['project']->getPinUrl(); ?>
" unpin_url="<?php echo $this->_tpl_vars['project']->getUnpinUrl(); ?>
" id="project_<?php echo $this->_tpl_vars['project']->getId(); ?>
">
      <td class="icon"><a href="<?php echo $this->_tpl_vars['project']->getOverviewUrl(); ?>
"><img src="<?php echo $this->_tpl_vars['project']->getIconUrl(); ?>
" alt="<?php echo ((is_array($_tmp=$this->_tpl_vars['project']->getName())) ? $this->_run_mod_handler('clean', true, $_tmp) : smarty_modifier_clean($_tmp)); ?>
" /></a></td>
      <td class="name"><?php echo smarty_function_project_link(array('project' => $this->_tpl_vars['project']), $this);?>
</td>
      <td class="client">
      <?php if (instance_of ( $this->_tpl_vars['project_client'] , 'Company' )): ?>
        <a href="<?php echo $this->_tpl_vars['project_client']->getViewUrl(); ?>
"><?php echo ((is_array($_tmp=$this->_tpl_vars['project_client']->getName())) ? $this->_run_mod_handler('clean', true, $_tmp) : smarty_modifier_clean($_tmp)); ?>
</a>
      <?php endif; ?>
      </td>
      <td class="progress"><?php echo smarty_function_project_progress(array('project' => $this->_tpl_vars['project'],'info' => false), $this);?>
</td>
    </tr>
  <?php endforeach; endif; unset($_from); ?>
  </table>
  <p class="details"><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Drag project on Favorites Projects block to mark it as favorite<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></p>
<?php else: ?>
  <p class="empty_page"><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>There are no active projects you are working on<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></p>
<?php endif; ?>
</div>
<script type="text/javascript">
  App.widgets.ActiveProjects.init('active_projects');
</script>