<?php /* Smarty version 2.6.16, created on 2012-08-09 18:51:25
         compiled from /var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/system/views/_recent_activities_for_selected_user.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'clean', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/system/views/_recent_activities_for_selected_user.tpl', 2, false),array('modifier', 'lower', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/system/views/_recent_activities_for_selected_user.tpl', 6, false),array('modifier', 'datetime', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/system/views/_recent_activities_for_selected_user.tpl', 8, false),array('function', 'cycle', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/system/views/_recent_activities_for_selected_user.tpl', 6, false),array('function', 'object_star', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/system/views/_recent_activities_for_selected_user.tpl', 8, false),array('function', 'project_link', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/system/views/_recent_activities_for_selected_user.tpl', 8, false),)), $this); ?>
<?php $_from = $this->_tpl_vars['recent_activities']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['activities'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['activities']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['date'] => $this->_tpl_vars['activities']):
        $this->_foreach['activities']['iteration']++;
?>
<h3 class="day_section"><?php echo ((is_array($_tmp=$this->_tpl_vars['date'])) ? $this->_run_mod_handler('clean', true, $_tmp) : smarty_modifier_clean($_tmp)); ?>
</h3>
<div class="day_activities">
  <?php $_from = $this->_tpl_vars['activities']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['activities'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['activities']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['activity']):
        $this->_foreach['activities']['iteration']++;
?>
  <?php $this->assign('activity_object', $this->_tpl_vars['activity']->getObject()); ?>
  <div class="<?php echo smarty_function_cycle(array('values' => ''), $this);?>
 activity <?php echo ((is_array($_tmp=$this->_tpl_vars['activity_object']->getType())) ? $this->_run_mod_handler('lower', true, $_tmp) : smarty_modifier_lower($_tmp)); ?>
_activity <?php echo ((is_array($_tmp=$this->_tpl_vars['activity']->getType())) ? $this->_run_mod_handler('lower', true, $_tmp) : smarty_modifier_lower($_tmp)); ?>
_activity">
    <div class="log_icon"><img src="<?php echo $this->_tpl_vars['activity']->getIconUrl(); ?>
" alt="" /></div>
    <div class="log_time"><span><?php echo smarty_function_object_star(array('object' => $this->_tpl_vars['activity_object'],'user' => $this->_tpl_vars['logged_user']), $this);?>
</span> &middot; <?php echo smarty_function_project_link(array('project' => $this->_tpl_vars['activity_object']->getProject()), $this);?>
 &middot; <strong><?php echo ((is_array($_tmp=$this->_tpl_vars['activity']->getCreatedOn())) ? $this->_run_mod_handler('datetime', true, $_tmp) : smarty_modifier_datetime($_tmp)); ?>
</strong></div>
    <div class="log_info">
      <div class="log_info_head"><?php echo $this->_tpl_vars['activity']->renderHead($this->_tpl_vars['activity_object'],true); ?>
</div>
      <?php if ($this->_tpl_vars['activity']->has_body): ?>
        <?php $this->assign('rendered_body', $this->_tpl_vars['activity']->renderBody($this->_tpl_vars['activity_object'],false)); ?>
        <?php if (( $this->_tpl_vars['rendered_body'] )): ?>
        <div class="log_info_body"><?php echo $this->_tpl_vars['rendered_body']; ?>
</div>
        <?php endif; ?>
      <?php endif; ?>
      <?php if ($this->_tpl_vars['activity']->has_footer): ?>
        <?php $this->assign('rendered_footer', $this->_tpl_vars['activity']->renderFooter($this->_tpl_vars['activity_object'],false)); ?>
        <?php if (( $this->_tpl_vars['rendered_footer'] )): ?>
        <div class="log_info_foot">
          <?php echo $this->_tpl_vars['rendered_footer']; ?>

        </div>
        <?php endif; ?>
      <?php endif; ?>
    </div>
  </div>
  <?php endforeach; endif; unset($_from); ?>
</div>
<?php endforeach; endif; unset($_from); ?>