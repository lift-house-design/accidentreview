<?php /* Smarty version 2.6.16, created on 2012-08-30 11:37:05
         compiled from /var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/mobile_access/views/_project_breadcrumbs.tpl */ ?>
<ul id="project_breadcrumbs">
  <?php $_from = $this->_tpl_vars['mobile_access_project_breadcrumbs_breadcrumbs']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['breadcrumb']):
?>
  <?php if ($this->_tpl_vars['breadcrumb']['url']): ?>
  <li><a href="<?php echo $this->_tpl_vars['breadcrumb']['url']; ?>
"><?php echo $this->_tpl_vars['breadcrumb']['name']; ?>
</a></li>
  <?php else: ?>
  <li><span><?php echo $this->_tpl_vars['breadcrumb']['name']; ?>
</span></li>
  <?php endif; ?>
  <?php endforeach; endif; unset($_from); ?>
</ul>

<div class="clear"></div>