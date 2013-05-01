<?php /* Smarty version 2.6.16, created on 2012-08-30 11:36:58
         compiled from /var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/mobile_access/views/mobile_access/assignments.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'clean', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/mobile_access/views/mobile_access/assignments.tpl', 8, false),array('modifier', 'excerpt', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/mobile_access/views/mobile_access/assignments.tpl', 27, false),array('block', 'lang', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/mobile_access/views/mobile_access/assignments.tpl', 16, false),array('function', 'mobile_access_get_view_url', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/mobile_access/views/mobile_access/assignments.tpl', 24, false),array('function', 'mobile_access_paginator', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/mobile_access/views/mobile_access/assignments.tpl', 35, false),)), $this); ?>
<div class="listing_options">
  <form action="<?php echo $this->_tpl_vars['pagination_url']; ?>
" method="GET" class="center">
    <select name="filter_id">
      <?php $_from = $this->_tpl_vars['grouped_filters']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['group_name'] => $this->_tpl_vars['filters']):
?>
        <optgroup label="<?php echo $this->_tpl_vars['group_name']; ?>
">
          <?php $_from = $this->_tpl_vars['filters']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['filter']):
?>
            <?php if ($this->_tpl_vars['active_filter']->getId() == $this->_tpl_vars['filter']->getId()): ?>
              <option value="<?php echo $this->_tpl_vars['filter']->getId(); ?>
" selected="selected"><?php echo ((is_array($_tmp=$this->_tpl_vars['filter']->getName())) ? $this->_run_mod_handler('clean', true, $_tmp) : smarty_modifier_clean($_tmp)); ?>
</option>
            <?php else: ?>
              <option value="<?php echo $this->_tpl_vars['filter']->getId(); ?>
"><?php echo ((is_array($_tmp=$this->_tpl_vars['filter']->getName())) ? $this->_run_mod_handler('clean', true, $_tmp) : smarty_modifier_clean($_tmp)); ?>
</option>
            <?php endif; ?>
          <?php endforeach; endif; unset($_from); ?>
        </optgroup>
      <?php endforeach; endif; unset($_from); ?>
    </select>
    <button type="submit"><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Filter<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></button>
  </form>
</div>

<?php if (is_foreachable ( $this->_tpl_vars['objects'] )): ?>
  <ul class="list_with_icons">
  <?php $_from = $this->_tpl_vars['objects']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['object']):
?>
    <li class="obj_link discussions_obj_link starred_list">
      <a href="<?php echo smarty_function_mobile_access_get_view_url(array('object' => $this->_tpl_vars['object']), $this);?>
">
        <span class="object_type"><?php echo $this->_tpl_vars['object']->getType(); ?>
</span>
        <span class="main_line">
        <?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['object']->getName())) ? $this->_run_mod_handler('clean', true, $_tmp) : smarty_modifier_clean($_tmp)))) ? $this->_run_mod_handler('excerpt', true, $_tmp, 28) : smarty_modifier_excerpt($_tmp, 28)); ?>

        </span>
        <?php $this->assign('project', $this->_tpl_vars['object']->getProject()); ?>
        <span class="project_name"><?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['project']->getName())) ? $this->_run_mod_handler('clean', true, $_tmp) : smarty_modifier_clean($_tmp)))) ? $this->_run_mod_handler('excerpt', true, $_tmp, 35) : smarty_modifier_excerpt($_tmp, 35)); ?>
</span>
      </a>
    </li>
  <?php endforeach; endif; unset($_from); ?>
  </ul>
  <?php echo smarty_function_mobile_access_paginator(array('paginator' => $this->_tpl_vars['pagination'],'url' => $this->_tpl_vars['pagination_url'],'url_param_filter_id' => $this->_tpl_vars['active_filter']->getId()), $this);?>

<?php else: ?>
  <div class="wrapper">
    <div class="box">
      <ul class="menu">
        <li><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>No objects match your criteria<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></li>
      </ul>
    </div>
  </div>
<?php endif; ?>