<?php /* Smarty version 2.6.16, created on 2012-07-27 16:10:05
         compiled from /var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/resources/views/subscriptions/_object_subscriptions.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'join', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/resources/views/subscriptions/_object_subscriptions.tpl', 7, false),array('block', 'lang', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/resources/views/subscriptions/_object_subscriptions.tpl', 7, false),array('block', 'assign_var', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/resources/views/subscriptions/_object_subscriptions.tpl', 16, false),array('block', 'link', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/resources/views/subscriptions/_object_subscriptions.tpl', 32, false),)), $this); ?>
<?php if ($this->_tpl_vars['_object_subscription_brief']): ?>
  <div id="object_subscriptions_for_<?php echo $this->_tpl_vars['_object_subscriptions_object']->getId(); ?>
" popup_url=<?php echo $this->_tpl_vars['_object_subscriptions_popup_url']; ?>
>
    <div class="object_subscriptions_list_wrapper">
    <?php if ($this->_tpl_vars['_object_subscriptions_list_subscribers']): ?>
      <?php if (is_foreachable ( $this->_tpl_vars['_object_subscriptions'] )): ?>
        <?php if (count ( $this->_tpl_vars['_object_subscription_links'] ) == 1): ?>
          <?php echo smarty_function_join(array('items' => $this->_tpl_vars['_object_subscription_links']), $this);?>
 <?php $this->_tag_stack[] = array('lang', array('type' => $this->_tpl_vars['_object_subscriptions_object']->getVerboseType(true))); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>is subscribed to this :type<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
        <?php else: ?>
          <?php echo smarty_function_join(array('items' => $this->_tpl_vars['_object_subscription_links']), $this);?>
 <?php $this->_tag_stack[] = array('lang', array('type' => $this->_tpl_vars['_object_subscriptions_object']->getVerboseType(true))); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>are subscribed to this :type<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
        <?php endif; ?>
      <?php else: ?>
        <?php $this->_tag_stack[] = array('lang', array('type' => $this->_tpl_vars['_object_subscriptions_object']->getVerboseType(true))); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>There are no users subscribed to this :type<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
      <?php endif; ?>
    <?php else: ?>
      <?php if ($this->_tpl_vars['_object_subscriptions_subscribers_count'] > 0): ?>
        <?php $this->_tag_stack[] = array('assign_var', array('name' => 'person')); $_block_repeat=true;smarty_block_assign_var($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start();  if ($this->_tpl_vars['_object_subscriptions_subscribers_count'] == 1):  $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>person<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack);  else:  $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>people<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack);  endif;  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_assign_var($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
        <?php $this->_tag_stack[] = array('lang', array('subscribers_count' => $this->_tpl_vars['_object_subscriptions_subscribers_count'],'type' => $this->_tpl_vars['_object_subscriptions_object']->getVerboseType(true),'person' => $this->_tpl_vars['person'])); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>:subscribers_count :person subscribed to this :type<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
      <?php else: ?>
        <?php $this->_tag_stack[] = array('lang', array('type' => $this->_tpl_vars['_object_subscriptions_object']->getVerboseType(true))); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>There are no users subscribed to this :type<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
      <?php endif; ?>
    <?php endif; ?>
    </div>
  </div>
<?php else: ?>
<div class="resource object_subscriptions" id="object_subscriptions_for_<?php echo $this->_tpl_vars['_object_subscriptions_object']->getId(); ?>
" popup_url=<?php echo $this->_tpl_vars['_object_subscriptions_popup_url']; ?>
>
  <div class="head">
  <?php if ($this->_tpl_vars['_object_subscriptions_object']->canEdit($this->_tpl_vars['logged_user'])): ?>
    <h2 class="section_name"><span class="section_name_span">
      <span class="section_name_span_span"><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Subscriptions<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></span>
      <ul class="section_options">
        
        <li><?php $this->_tag_stack[] = array('link', array('href' => $this->_tpl_vars['_object_subscriptions_object']->getSubscriptionsUrl(),'class' => 'open_manage_subscriptions')); $_block_repeat=true;smarty_block_link($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Manage / Add<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_link($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></li>
      </ul>
      <div class="clear"></div>
    </span></h2>
  <?php else: ?>
    <h2 class="section_name"><span class="section_name_span"><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Subscriptions<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></span></h2>
  <?php endif; ?>
  </div>
  <div class="body object_subscriptions_list_wrapper">
      <?php if ($this->_tpl_vars['_object_subscriptions_list_subscribers']): ?>
        <?php if (is_foreachable ( $this->_tpl_vars['_object_subscriptions'] )): ?>
          <?php if (count ( $this->_tpl_vars['_object_subscription_links'] ) == 1): ?>
            <?php echo smarty_function_join(array('items' => $this->_tpl_vars['_object_subscription_links']), $this);?>
 <?php $this->_tag_stack[] = array('lang', array('type' => $this->_tpl_vars['_object_subscriptions_object']->getVerboseType(true))); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>is subscribed to this :type<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>.
          <?php else: ?>
            <?php echo smarty_function_join(array('items' => $this->_tpl_vars['_object_subscription_links']), $this);?>
 <?php $this->_tag_stack[] = array('lang', array('type' => $this->_tpl_vars['_object_subscriptions_object']->getVerboseType(true))); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>are subscribed to this :type<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>.
          <?php endif; ?>
        <?php else: ?>
            <?php $this->_tag_stack[] = array('lang', array('type' => $this->_tpl_vars['_object_subscriptions_object']->getVerboseType(true))); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>There are no users subscribed to this :type<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
        <?php endif; ?>
      <?php else: ?>
        <?php if ($this->_tpl_vars['_object_subscriptions_subscribers_count'] > 0): ?>
          <?php $this->_tag_stack[] = array('assign_var', array('name' => 'person')); $_block_repeat=true;smarty_block_assign_var($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start();  if ($this->_tpl_vars['_object_subscriptions_subscribers_count'] == 1):  $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>person<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack);  else:  $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>people<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack);  endif;  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_assign_var($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
          <?php $this->_tag_stack[] = array('lang', array('subscribers_count' => $this->_tpl_vars['_object_subscriptions_subscribers_count'],'type' => $this->_tpl_vars['_object_subscriptions_object']->getVerboseType(true),'person' => $this->_tpl_vars['person'])); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>:subscribers_count :person subscribed to this :type<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
        <?php else: ?>
          <?php $this->_tag_stack[] = array('lang', array('type' => $this->_tpl_vars['_object_subscriptions_object']->getVerboseType(true))); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>There are no users subscribed to this :type<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
        <?php endif; ?>
      <?php endif; ?>
  </div>
</div>
<?php endif; ?>
<script type="text/javascript">
  App.resources.ManageSubscriptions.init('object_subscriptions_for_<?php echo $this->_tpl_vars['_object_subscriptions_object']->getid(); ?>
', '<?php echo $this->_tpl_vars['_object_subscriptions_object']->getVerboseType(true); ?>
');
</script>