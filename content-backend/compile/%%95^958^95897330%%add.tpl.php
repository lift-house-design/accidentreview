<?php /* Smarty version 2.6.16, created on 2012-12-26 16:57:20
         compiled from /var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/resources/views/reminders/add.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'form', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/resources/views/reminders/add.tpl', 1, false),array('block', 'label', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/resources/views/reminders/add.tpl', 6, false),array('block', 'lang', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/resources/views/reminders/add.tpl', 15, false),array('block', 'wrap', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/resources/views/reminders/add.tpl', 69, false),array('block', 'textarea_field', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/resources/views/reminders/add.tpl', 71, false),array('block', 'wrap_buttons', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/resources/views/reminders/add.tpl', 75, false),array('block', 'submit', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/resources/views/reminders/add.tpl', 76, false),array('modifier', 'clean', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/resources/views/reminders/add.tpl', 12, false),array('function', 'select_user', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/resources/views/reminders/add.tpl', 65, false),)), $this); ?>
<?php $this->_tag_stack[] = array('form', array('action' => $this->_tpl_vars['parent']->getSendReminderUrl(),'method' => 'post','class' => 'focusFirstField','id' => 'send_reminder_users_form')); $_block_repeat=true;smarty_block_form($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>

  <?php if ($this->_tpl_vars['parent']->can_have_assignees): ?>
  <div>
    <div class="label_wrapper">
      <input type="radio" name="reminder[who]" value="assignees" id="reminderAssigneesRadio" class="auto input_radio" <?php if ($this->_tpl_vars['reminder_data']['who'] == 'assignees'): ?>checked="checked"<?php endif; ?> /> <?php $this->_tag_stack[] = array('label', array('for' => 'reminderAssigneesRadio','class' => 'inline')); $_block_repeat=true;smarty_block_label($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Assignees<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_label($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
    </div>
    <div class="content_wrapper" style="display: none">
      <span class="details">
    <?php if (is_foreachable ( $this->_tpl_vars['assignees'] )): ?>
      <?php $_from = $this->_tpl_vars['assignees']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['reminder_assignees'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['reminder_assignees']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['assignee']):
        $this->_foreach['reminder_assignees']['iteration']++;
?>
        <?php echo ((is_array($_tmp=$this->_tpl_vars['assignee']->getDisplayName())) ? $this->_run_mod_handler('clean', true, $_tmp) : smarty_modifier_clean($_tmp));  if (! ($this->_foreach['reminder_assignees']['iteration'] == $this->_foreach['reminder_assignees']['total'])): ?>, <?php endif; ?>
      <?php endforeach; endif; unset($_from); ?>
    <?php else: ?>
        <?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>There are no assignees<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
    <?php endif; ?>
      </span>
    </div>
  </div>
  <?php endif; ?>
  
  <?php if ($this->_tpl_vars['parent']->can_have_subscribers): ?>
  <div>
    <div class="label_wrapper">
      <input type="radio" name="reminder[who]" value="subscribers" id="reminderSubscribersRadio" class="auto input_radio" <?php if ($this->_tpl_vars['reminder_data']['who'] == 'subscribers'): ?>checked="checked"<?php endif; ?> /> <?php $this->_tag_stack[] = array('label', array('for' => 'reminderSubscribersRadio','class' => 'inline')); $_block_repeat=true;smarty_block_label($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Subscribers<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_label($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
    </div>
    <div class="content_wrapper" style="display: none">
      <span class="details">
    <?php if (is_foreachable ( $this->_tpl_vars['subscribers'] )): ?>
      <?php $_from = $this->_tpl_vars['subscribers']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['reminder_subscribers'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['reminder_subscribers']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['subscriber']):
        $this->_foreach['reminder_subscribers']['iteration']++;
?>
        <?php echo ((is_array($_tmp=$this->_tpl_vars['subscriber']->getDisplayName())) ? $this->_run_mod_handler('clean', true, $_tmp) : smarty_modifier_clean($_tmp));  if (! ($this->_foreach['reminder_subscribers']['iteration'] == $this->_foreach['reminder_subscribers']['total'])): ?>, <?php endif; ?>
      <?php endforeach; endif; unset($_from); ?>
    <?php else: ?>
        <?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>There are no users subscribed to this object<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
    <?php endif; ?>
      </span>
    </div>
  </div>
  <?php endif; ?>
  
  <?php if ($this->_tpl_vars['parent']->can_have_comments): ?>
  <div>
    <div class="label_wrapper">
      <input type="radio" name="reminder[who]" value="commenters" id="reminderCommentersRadio" class="auto input_radio" <?php if ($this->_tpl_vars['reminder_data']['who'] == 'commenters'): ?>checked="checked"<?php endif; ?> /> <?php $this->_tag_stack[] = array('label', array('for' => 'reminderCommentersRadio','class' => 'inline')); $_block_repeat=true;smarty_block_label($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Everyone involved in a discussion<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_label($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
    </div>
    <div class="content_wrapper" style="display: none">
      <span class="details">
    <?php if (is_foreachable ( $this->_tpl_vars['commenters'] )): ?>
      <?php $_from = $this->_tpl_vars['commenters']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['reminder_commenters'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['reminder_commenters']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['commenter']):
        $this->_foreach['reminder_commenters']['iteration']++;
?>
        <?php echo ((is_array($_tmp=$this->_tpl_vars['commenter']->getDisplayName())) ? $this->_run_mod_handler('clean', true, $_tmp) : smarty_modifier_clean($_tmp));  if (! ($this->_foreach['reminder_commenters']['iteration'] == $this->_foreach['reminder_commenters']['total'])): ?>, <?php endif; ?>
      <?php endforeach; endif; unset($_from); ?>
    <?php else: ?>
        <?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>No users involved in a discussion<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
    <?php endif; ?>
      </span>
    </div>
  </div>
  <?php endif; ?>
  
  <div>
    <div class="label_wrapper">
      <input type="radio" name="reminder[who]" value="user" id="reminderUserRadio" class="auto input_radio" <?php if ($this->_tpl_vars['reminder_data']['who'] == 'user'): ?>checked="checked"<?php endif; ?> /> <?php $this->_tag_stack[] = array('label', array('for' => 'reminderUserRadio','class' => 'inline')); $_block_repeat=true;smarty_block_label($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Selected User<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_label($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
    </div>
    <div class="content_wrapper" style="display: none">
      <?php echo smarty_function_select_user(array('name' => 'reminder[user_id]','users' => $this->_tpl_vars['project_users'],'optional' => false), $this);?>

    </div>
  </div>
  
  <?php $this->_tag_stack[] = array('wrap', array('field' => 'comment')); $_block_repeat=true;smarty_block_wrap($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
    <?php $this->_tag_stack[] = array('label', array('for' => 'reminderComment')); $_block_repeat=true;smarty_block_label($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Optional Comment<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_label($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
    <?php $this->_tag_stack[] = array('textarea_field', array('name' => 'reminder[comment]')); $_block_repeat=true;smarty_block_textarea_field($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start();  echo $this->_tpl_vars['reminder_data']['comment'];  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_textarea_field($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
    <p class="details boxless"><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>HTML not supported! Line breaks are preserved. Links are recognized and converted<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>.</p>
  <?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_wrap($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
  
  <?php $this->_tag_stack[] = array('wrap_buttons', array()); $_block_repeat=true;smarty_block_wrap_buttons($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
    <?php $this->_tag_stack[] = array('submit', array()); $_block_repeat=true;smarty_block_submit($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Submit<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_submit($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
  <?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_wrap_buttons($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack);  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_form($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>

<script type="text/javascript">
  App.widgets.SendReminder.init_form();
</script>