<?php /* Smarty version 2.6.16, created on 2012-08-30 11:37:05
         compiled from /var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/mobile_access/views/_object_comments.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'lang', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/mobile_access/views/_object_comments.tpl', 2, false),array('function', 'counter', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/mobile_access/views/_object_comments.tpl', 5, false),array('function', 'cycle', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/mobile_access/views/_object_comments.tpl', 7, false),array('function', 'mobile_access_get_view_url', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/mobile_access/views/_object_comments.tpl', 16, false),array('function', 'mobile_access_object_attachments', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/mobile_access/views/_object_comments.tpl', 23, false),array('function', 'mobile_access_paginator', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/mobile_access/views/_object_comments.tpl', 27, false),array('modifier', 'clean', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/mobile_access/views/_object_comments.tpl', 16, false),array('modifier', 'datetime', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/mobile_access/views/_object_comments.tpl', 20, false),)), $this); ?>
<?php if (is_foreachable ( $this->_tpl_vars['_mobile_access_comments_comments'] )): ?>
<h2 class="label" id="comments"><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Comments<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></h2>
<div class="box">
  <div class="comments">
    <?php echo smarty_function_counter(array('start' => $this->_tpl_vars['_mobile_access_comments_counter'],'skip' => 1,'assign' => 'counter_var'), $this);?>

    <?php $_from = $this->_tpl_vars['_mobile_access_comments_comments']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['comment']):
?>
      <div class="comment <?php echo smarty_function_cycle(array('values' => "odd,even"), $this);?>
" id="comment_<?php echo $this->_tpl_vars['comment']->getId(); ?>
">
      <?php $this->assign('comment_author', $this->_tpl_vars['comment']->getCreatedBy()); ?>
        <div class="author">
        <?php if ($this->_tpl_vars['_mobile_access_comments_show_counter']): ?>
          <div class="comment_number">
            #<?php echo $this->_tpl_vars['counter_var']; ?>

          </div>
        <?php endif; ?>
          <img src="<?php echo $this->_tpl_vars['comment_author']->getAvatarUrl(); ?>
" class="author_icon">
          <a href="<?php echo smarty_function_mobile_access_get_view_url(array('object' => $this->_tpl_vars['comment_author']), $this);?>
" class="author_link"><?php echo ((is_array($_tmp=$this->_tpl_vars['comment_author']->getName())) ? $this->_run_mod_handler('clean', true, $_tmp) : smarty_modifier_clean($_tmp)); ?>
</a>
          <div class="clear"></div>
        </div>
        <div class="date">
        <?php echo ((is_array($_tmp=$this->_tpl_vars['comment']->getCreatedOn())) ? $this->_run_mod_handler('datetime', true, $_tmp) : smarty_modifier_datetime($_tmp)); ?>

        </div>
        <div class="content formatted"><?php echo $this->_tpl_vars['comment']->getFormattedBody(); ?>
</div>
        <?php echo smarty_function_mobile_access_object_attachments(array('object' => $this->_tpl_vars['comment']), $this);?>

      </div>
      <?php echo smarty_function_counter(array(), $this);?>

    <?php endforeach; endif; unset($_from); ?>
    <?php echo smarty_function_mobile_access_paginator(array('paginator' => $this->_tpl_vars['_mobile_access_comments_paginator'],'url' => $this->_tpl_vars['_mobile_access_comments_url'],'anchor' => '#comments'), $this);?>

  </div>
</div>
<?php endif; ?>