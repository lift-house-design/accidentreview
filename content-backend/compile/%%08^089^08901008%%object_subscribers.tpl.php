<?php /* Smarty version 2.6.16, created on 2012-08-01 19:57:56
         compiled from /var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/system/views/widgets/object_subscribers.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'clean', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/system/views/widgets/object_subscribers.tpl', 6, false),array('function', 'cycle', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/system/views/widgets/object_subscribers.tpl', 9, false),array('function', 'user_link', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/system/views/widgets/object_subscribers.tpl', 11, false),)), $this); ?>
<div id="object_subscriptions">
<?php if (is_foreachable ( $this->_tpl_vars['people'] )): ?>
  <?php $_from = $this->_tpl_vars['people']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['project_company']):
?>
    <table>
      <tr>
        <th colspan="3"><?php echo ((is_array($_tmp=$this->_tpl_vars['project_company']['company']->getName())) ? $this->_run_mod_handler('clean', true, $_tmp) : smarty_modifier_clean($_tmp)); ?>
</th>
      </tr>
    <?php $_from = $this->_tpl_vars['project_company']['users']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['user']):
?>
      <tr class="<?php echo smarty_function_cycle(array('values' => 'odd,even'), $this);?>
">
        <td class="avatar"><img src="<?php echo $this->_tpl_vars['user']->getAvatarUrl(); ?>
" alt="" /></td>
        <td class="name"><?php echo smarty_function_user_link(array('user' => $this->_tpl_vars['user']), $this);?>
</td>
        <td class="subscription">
          <input type="checkbox" class="auto input_checkbox" subscribe_url="<?php echo $this->_tpl_vars['active_object']->getSubscribeUrl($this->_tpl_vars['user']); ?>
" unsubscribe_url="<?php echo $this->_tpl_vars['active_object']->getUnsubscribeUrl($this->_tpl_vars['user']); ?>
" <?php if ($this->_tpl_vars['active_object']->isSubscribed($this->_tpl_vars['user'])): ?>checked="checked"<?php endif; ?> />
        </td>
      </tr>
    <?php endforeach; endif; unset($_from); ?>
    </table>
  <?php endforeach; endif; unset($_from);  endif; ?>
</div>