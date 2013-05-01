<?php /* Smarty version 2.6.16, created on 2012-08-10 13:52:21
         compiled from /var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/incoming_mail/views/incoming_mail_admin/index.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'title', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/incoming_mail/views/incoming_mail_admin/index.tpl', 1, false),array('block', 'add_bread_crumb', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/incoming_mail/views/incoming_mail_admin/index.tpl', 2, false),array('block', 'lang', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/incoming_mail/views/incoming_mail_admin/index.tpl', 4, false),array('block', 'link', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/incoming_mail/views/incoming_mail_admin/index.tpl', 44, false),array('block', 'pagination', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/incoming_mail/views/incoming_mail_admin/index.tpl', 70, false),array('function', 'cycle', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/incoming_mail/views/incoming_mail_admin/index.tpl', 17, false),array('function', 'image_url', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/incoming_mail/views/incoming_mail_admin/index.tpl', 22, false),array('function', 'empty_slate', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/incoming_mail/views/incoming_mail_admin/index.tpl', 54, false),array('function', 'assemble', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/incoming_mail/views/incoming_mail_admin/index.tpl', 60, false),array('modifier', 'clean', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/incoming_mail/views/incoming_mail_admin/index.tpl', 18, false),array('modifier', 'humanize', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/incoming_mail/views/incoming_mail_admin/index.tpl', 41, false),array('modifier', 'time', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/incoming_mail/views/incoming_mail_admin/index.tpl', 83, false),array('modifier', 'excerpt', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/incoming_mail/views/incoming_mail_admin/index.tpl', 94, false),)), $this); ?>
<?php $this->_tag_stack[] = array('title', array()); $_block_repeat=true;smarty_block_title($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Incoming Mail Settings<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_title($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack);  $this->_tag_stack[] = array('add_bread_crumb', array()); $_block_repeat=true;smarty_block_add_bread_crumb($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Settings<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_add_bread_crumb($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>

  <h2 class="section_name"><span class="section_name_span"><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Defined Mailboxes<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></span></h2>
  <div class="section_container">
  <?php if (is_foreachable ( $this->_tpl_vars['mailboxes'] )): ?> 
    <table class="common_table" id="mailbox_table">
      <tr>
        <th><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Mailbox<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></th>
        <th colspan="2"><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Last Status<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></th>
        <th class="mailbox_active"><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Active<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></th>
        <th><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Creates<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></th>
        <th><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Project<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></th>
        <th><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Options<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></th>
      </tr>
    <?php $_from = $this->_tpl_vars['mailboxes']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['mailbox']):
?>
      <tr class="<?php echo smarty_function_cycle(array('values' => 'odd,even'), $this);?>
" id="mailbox_<?php echo $this->_tpl_vars['mailbox']->getId(); ?>
">
         <td class="account_email"><?php echo ((is_array($_tmp=$this->_tpl_vars['mailbox']->getDisplayName())) ? $this->_run_mod_handler('clean', true, $_tmp) : smarty_modifier_clean($_tmp)); ?>
</td>
         <td class="icon">
          <a href="<?php echo $this->_tpl_vars['mailbox']->getViewUrl(); ?>
">
          <?php if ($this->_tpl_vars['mailbox']->getLastStatus() === 1): ?>
            <img src="<?php echo smarty_function_image_url(array('name' => 'ok_indicator.gif'), $this);?>
" />
          <?php else: ?>
            <img src="<?php echo smarty_function_image_url(array('name' => 'error_indicator.gif'), $this);?>
" />
          <?php endif; ?>
          </a>
         </td>
         <td class="incoming_mailbox_status_<?php echo $this->_tpl_vars['mailbox']->getLastStatus(); ?>
">
          <a href="<?php echo $this->_tpl_vars['mailbox']->getViewUrl(); ?>
"><?php echo $this->_tpl_vars['mailbox']->getFormattedLastStatus(); ?>
</a>
         </td>

         <td class="mailbox_active">
          <strong>
           <?php if ($this->_tpl_vars['mailbox']->getEnabled()): ?>
             <?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Yes<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
           <?php else: ?>
             <?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>No<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
           <?php endif; ?>
           </strong>
         </td>
         <td class="object_type"><?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['mailbox']->getObjectType())) ? $this->_run_mod_handler('clean', true, $_tmp) : smarty_modifier_clean($_tmp)))) ? $this->_run_mod_handler('humanize', true, $_tmp) : smarty_modifier_humanize($_tmp)); ?>
</td>
         <td class="mailbox_host"><?php echo ((is_array($_tmp=$this->_tpl_vars['mailbox']->getProjectName())) ? $this->_run_mod_handler('clean', true, $_tmp) : smarty_modifier_clean($_tmp)); ?>
</td>
         <td class="options">
          <?php $this->_tag_stack[] = array('link', array('href' => $this->_tpl_vars['mailbox']->getViewUrl(),'title' => 'Activity History...')); $_block_repeat=true;smarty_block_link($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><img src='<?php echo smarty_function_image_url(array('name' => "arrow-right-small.gif"), $this);?>
' alt='' /><?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_link($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?> 
          <?php $this->_tag_stack[] = array('link', array('href' => $this->_tpl_vars['mailbox']->getListEmailsUrl(),'title' => 'List Messages in mailbox...')); $_block_repeat=true;smarty_block_link($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><img src='<?php echo smarty_function_image_url(array('name' => "info-gray.gif"), $this);?>
' alt='' /><?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_link($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?> 
          <?php $this->_tag_stack[] = array('link', array('href' => $this->_tpl_vars['mailbox']->getEditUrl(),'title' => 'Edit...')); $_block_repeat=true;smarty_block_link($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><img src='<?php echo smarty_function_image_url(array('name' => "gray-edit.gif"), $this);?>
' alt='' /><?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_link($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?> 
          <?php $this->_tag_stack[] = array('link', array('href' => $this->_tpl_vars['mailbox']->getDeleteUrl(),'title' => 'Delete...','method' => 'post')); $_block_repeat=true;smarty_block_link($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><img src='<?php echo smarty_function_image_url(array('name' => "gray-delete.gif"), $this);?>
' alt='' /><?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_link($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?> 
         </td>
      </tr>
    <?php endforeach; endif; unset($_from); ?>
    </table>
  <?php else: ?>
      <p class="empty_page"><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>No mailboxes defined here<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>. <?php $this->_tag_stack[] = array('lang', array('add_url' => $this->_tpl_vars['add_new_mailbox_url'])); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Would you like to <a href=":add_url">create one</a><?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>?</p>
      <?php echo smarty_function_empty_slate(array('name' => 'mailboxes','module' => 'incoming_mail'), $this);?>

  <?php endif; ?>
  </div>

<?php if (is_foreachable ( $this->_tpl_vars['activity_history'] )): ?>
  <h2 class="section_name"><span class="section_name_span">
    <form method="get" action="<?php echo smarty_function_assemble(array('route' => 'incoming_mail_admin'), $this);?>
" class="simple_toggler">
      <input type="checkbox" name="only_problematic" value="true" <?php if ($this->_tpl_vars['only_problematic']): ?>checked="checked"<?php endif; ?> id="only_active_toggler" class="input_checkbox">
      <label for="only_active_toggler"><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Show Only Problems<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></label>
    </form>
    <?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Activity Log<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
  </span></h2>
  <div class="section_container">
    <?php if ($this->_tpl_vars['pagination']->getLastPage() > 1): ?>
    <p class="pagination top">
      <span class="inner_pagination">
      <?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Page<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>: <?php $this->_tag_stack[] = array('pagination', array('pager' => $this->_tpl_vars['pagination'])); $_block_repeat=true;smarty_block_pagination($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start();  echo smarty_function_assemble(array('route' => 'incoming_mail_admin','page' => '-PAGE-','only_problematic' => $this->_tpl_vars['only_problematic']), $this); $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_pagination($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
      </span>
    </p>
    <div class="clear"></div>
    <?php endif; ?>
    
    <div id="recent_activities" class="incoming_mail_activities">
    <?php $_from = $this->_tpl_vars['activity_history']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['date'] => $this->_tpl_vars['activities']):
?>
    <h3 class="day_section"><?php echo ((is_array($_tmp=$this->_tpl_vars['date'])) ? $this->_run_mod_handler('clean', true, $_tmp) : smarty_modifier_clean($_tmp)); ?>
</h3>
    <table class="common_table incoming_mail_log_table">
      <tbody>
      <?php $_from = $this->_tpl_vars['activities']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['activity']):
?>
        <tr class="<?php if ($this->_tpl_vars['activity']->getState()): ?>incoming_mail_ok<?php else: ?>incoming_mail_conflict<?php endif; ?> <?php echo smarty_function_cycle(array('values' => 'odd,even'), $this);?>
">
          <td class="time"><?php echo ((is_array($_tmp=$this->_tpl_vars['activity']->getCreatedOn())) ? $this->_run_mod_handler('time', true, $_tmp) : smarty_modifier_time($_tmp)); ?>
</td>
          <td class="mailbox_name"><a href="<?php echo $this->_tpl_vars['activity']->getMailboxViewUrl(); ?>
"><?php echo ((is_array($_tmp=$this->_tpl_vars['activity']->getMailboxDisplayName())) ? $this->_run_mod_handler('clean', true, $_tmp) : smarty_modifier_clean($_tmp)); ?>
</a></td>
          <td class="icon">
            <?php if ($this->_tpl_vars['activity']->getState()): ?>
              <img src="<?php echo smarty_function_image_url(array('name' => 'ok_indicator.gif'), $this);?>
" />
            <?php else: ?>
              <img src="<?php echo smarty_function_image_url(array('name' => 'error_indicator.gif'), $this);?>
" />
            <?php endif; ?>
          </td>
          <td class="response"><?php echo ((is_array($_tmp=$this->_tpl_vars['activity']->getResponse())) ? $this->_run_mod_handler('clean', true, $_tmp) : smarty_modifier_clean($_tmp)); ?>
</td>
          <td class="sender"><?php echo ((is_array($_tmp=$this->_tpl_vars['activity']->getSender())) ? $this->_run_mod_handler('clean', true, $_tmp) : smarty_modifier_clean($_tmp)); ?>
</td>
          <td class="subject"><span title="<?php echo ((is_array($_tmp=$this->_tpl_vars['activity']->getSubject())) ? $this->_run_mod_handler('clean', true, $_tmp) : smarty_modifier_clean($_tmp)); ?>
"><?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['activity']->getSubject())) ? $this->_run_mod_handler('clean', true, $_tmp) : smarty_modifier_clean($_tmp)))) ? $this->_run_mod_handler('excerpt', true, $_tmp, 30) : smarty_modifier_excerpt($_tmp, 30)); ?>
</span></td>
          <td class="options">
            <?php if ($this->_tpl_vars['activity']->getProjectObjectId() || $this->_tpl_vars['activity']->getIncomingMailId()): ?>
              <a href="<?php echo $this->_tpl_vars['activity']->getResultingObjectUrl(); ?>
"><img src='<?php echo smarty_function_image_url(array('name' => "arrow-right-small.gif"), $this);?>
' /></a>
            <?php endif; ?>
          </td>
        </tr>
      <?php endforeach; endif; unset($_from); ?>
      </tbody>
    </table>
    <?php endforeach; endif; unset($_from); ?>
    </div>
    <?php if (( $this->_tpl_vars['pagination']->getLastPage() > 1 ) && ! $this->_tpl_vars['pagination']->isLast()): ?>
      <p class="next_page"><a href="<?php echo smarty_function_assemble(array('route' => 'incoming_mail_admin','page' => $this->_tpl_vars['pagination']->getNextPage()), $this);?>
"><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Next Page<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a></p>
    <?php endif; ?>
  </div>
<?php endif; ?>



