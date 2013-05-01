<?php /* Smarty version 2.6.16, created on 2012-07-30 12:45:15
         compiled from /var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/system/views/error/403.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'clean', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/system/views/error/403.tpl', 1, false),array('function', 'assemble', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/system/views/error/403.tpl', 5, false),)), $this); ?>
<h1><?php echo ((is_array($_tmp=$this->_tpl_vars['message'])) ? $this->_run_mod_handler('clean', true, $_tmp) : smarty_modifier_clean($_tmp)); ?>
</h1>

<div class="description">
  <p><strong>You don't have privilege to access this page or object</strong></p>
  <p>You can go back to <a href="#" onclick="history.back(1); return false">page you came from</a>, or alternatively you can visit <a href="<?php echo smarty_function_assemble(array('route' => 'homepage'), $this);?>
">dashboard</a></p>
</div>