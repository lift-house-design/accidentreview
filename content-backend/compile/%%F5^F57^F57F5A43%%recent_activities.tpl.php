<?php /* Smarty version 2.6.16, created on 2012-07-27 16:10:00
         compiled from /var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/system/views/dashboard/recent_activities.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'title', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/system/views/dashboard/recent_activities.tpl', 2, false),array('block', 'add_bread_crumb', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/system/views/dashboard/recent_activities.tpl', 3, false),array('block', 'lang', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/system/views/dashboard/recent_activities.tpl', 38, false),array('modifier', 'clean', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/system/views/dashboard/recent_activities.tpl', 9, false),array('modifier', 'lower', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/system/views/dashboard/recent_activities.tpl', 13, false),array('modifier', 'time', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/system/views/dashboard/recent_activities.tpl', 15, false),array('function', 'cycle', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/system/views/dashboard/recent_activities.tpl', 13, false),array('function', 'object_star', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/system/views/dashboard/recent_activities.tpl', 15, false),array('function', 'project_link', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/system/views/dashboard/recent_activities.tpl', 15, false),array('function', 'assemble', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/system/views/dashboard/recent_activities.tpl', 38, false),)), $this); ?>
<?php if ($this->_tpl_vars['request']->getController() == 'dashboard' && $this->_tpl_vars['request']->getAction() == 'recent_activities'): ?>
  <?php $this->_tag_stack[] = array('title', array()); $_block_repeat=true;smarty_block_title($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Recent Activities<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_title($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
  <?php $this->_tag_stack[] = array('add_bread_crumb', array()); $_block_repeat=true;smarty_block_add_bread_crumb($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>List<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_add_bread_crumb($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack);  endif; ?>

<div id="recent_activities">
<?php if (is_foreachable ( $this->_tpl_vars['grouped_activities'] )): ?>
  <?php $_from = $this->_tpl_vars['grouped_activities']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['activities'] = array('total' => count($_from), 'iteration' => 0);
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
 &middot; <strong><?php echo ((is_array($_tmp=$this->_tpl_vars['activity']->getCreatedOn())) ? $this->_run_mod_handler('time', true, $_tmp) : smarty_modifier_time($_tmp)); ?>
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

  <p class="recent_activities_rss"><a href="<?php echo smarty_function_assemble(array('route' => 'rss','token' => $this->_tpl_vars['logged_user']->getToken(true)), $this);?>
"><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Recent Activities<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a></p>
<?php else: ?>
  <p class="empty_page"><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>There are no activities logged<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></p>
<?php endif; ?>
</div>