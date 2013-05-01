<?php /* Smarty version 2.6.16, created on 2012-08-09 19:05:29
         compiled from /var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/system/views/settings/mailing.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'title', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/system/views/settings/mailing.tpl', 1, false),array('block', 'add_bread_crumb', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/system/views/settings/mailing.tpl', 2, false),array('block', 'form', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/system/views/settings/mailing.tpl', 5, false),array('block', 'label', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/system/views/settings/mailing.tpl', 8, false),array('block', 'lang', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/system/views/settings/mailing.tpl', 13, false),array('block', 'wrap', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/system/views/settings/mailing.tpl', 19, false),array('block', 'wrap_buttons', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/system/views/settings/mailing.tpl', 115, false),array('block', 'submit', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/system/views/settings/mailing.tpl', 116, false),array('function', 'text_field', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/system/views/settings/mailing.tpl', 21, false),array('function', 'yes_no', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/system/views/settings/mailing.tpl', 45, false),array('function', 'password_field', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/system/views/settings/mailing.tpl', 59, false),array('function', 'image_url', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/system/views/settings/mailing.tpl', 79, false),array('function', 'empty_slate', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/system/views/settings/mailing.tpl', 121, false),)), $this); ?>
<?php $this->_tag_stack[] = array('title', array()); $_block_repeat=true;smarty_block_title($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Outgoing Email Settings<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_title($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack);  $this->_tag_stack[] = array('add_bread_crumb', array()); $_block_repeat=true;smarty_block_add_bread_crumb($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Outgoing Email Settings<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_add_bread_crumb($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>

<div id="mailing_settings">
  <?php $this->_tag_stack[] = array('form', array('action' => '?route=admin_settings_mailing','method' => 'post','id' => 'mailing_settings_admin')); $_block_repeat=true;smarty_block_form($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
    <div class="section_container">
      <div class="ctrlHolder">
        <?php $this->_tag_stack[] = array('label', array('for' => 'mailingType','required' => true)); $_block_repeat=true;smarty_block_label($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Connection Type<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_label($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
        <select name="mailing[mailing]" id="mailingType">
          <option value="native" <?php if ($this->_tpl_vars['mailing_data']['mailing'] == 'native'): ?>selected<?php endif; ?>>Native</option>
          <option value="smtp" <?php if ($this->_tpl_vars['mailing_data']['mailing'] == 'smtp'): ?>selected<?php endif; ?>>SMTP</option>
        </select>
        <p class="details"><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Native mailing support uses your PHP setup to send emails. You can also use SMTP server to send emails.<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></p>
      </div>
    </div>
    
    <div id="native_mailer_settings" style="display: none">
      <div class="section_container">
        <?php $this->_tag_stack[] = array('wrap', array('field' => 'mailing_native_options')); $_block_repeat=true;smarty_block_wrap($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
          <?php $this->_tag_stack[] = array('label', array('for' => 'mailingNativeOptions')); $_block_repeat=true;smarty_block_label($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Native Mailer Options<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_label($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
          <?php echo smarty_function_text_field(array('name' => "mailing[mailing_native_options]",'value' => $this->_tpl_vars['mailing_data']['mailing_native_options'],'id' => 'mailingNativeOptions'), $this);?>

          <p class="details"><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Default value is "-oi -f %s". If you are <strong>experiencing problems</strong> with default value, try setting it empty value<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></p>
        <?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_wrap($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
      </div>
    </div>
    
    <div id="smtp_mailer_settings" style="display: none">
      <div class="section_container">
        <div class="col">
        <?php $this->_tag_stack[] = array('wrap', array('field' => 'mailing_smtp_host')); $_block_repeat=true;smarty_block_wrap($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
          <?php $this->_tag_stack[] = array('label', array('for' => 'mailingSmtpHost','required' => true)); $_block_repeat=true;smarty_block_label($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>SMTP host<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_label($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
          <?php echo smarty_function_text_field(array('name' => "mailing[mailing_smtp_host]",'value' => $this->_tpl_vars['mailing_data']['mailing_smtp_host'],'id' => 'mailingSmtpHost'), $this);?>

        <?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_wrap($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
        </div>
        
        <div class="col">
        <?php $this->_tag_stack[] = array('wrap', array('field' => 'mailing_smtp_port')); $_block_repeat=true;smarty_block_wrap($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
          <?php $this->_tag_stack[] = array('label', array('for' => 'mailingSmtpPort','required' => true)); $_block_repeat=true;smarty_block_label($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>SMTP port<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_label($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
          <?php echo smarty_function_text_field(array('name' => "mailing[mailing_smtp_port]",'value' => $this->_tpl_vars['mailing_data']['mailing_smtp_port'],'id' => 'mailingSmtpPort','class' => 'short'), $this);?>

        <?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_wrap($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
        </div>
        
        <?php $this->_tag_stack[] = array('wrap', array('field' => 'mailing_smtp_authenticate','id' => 'mailingAuthenticateRadioWrapper')); $_block_repeat=true;smarty_block_wrap($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
          <?php $this->_tag_stack[] = array('label', array('for' => 'mailingAuthenticate')); $_block_repeat=true;smarty_block_label($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>SMTP Authentication<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_label($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
          <?php echo smarty_function_yes_no(array('name' => "mailing[mailing_smtp_authenticate]",'value' => $this->_tpl_vars['mailing_data']['mailing_smtp_authenticate'],'id' => 'mailingAuthenticate'), $this);?>

        <?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_wrap($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
        
        <div id="mailingAuthenticateWrapper" style="display: none">
          <div class="col">
          <?php $this->_tag_stack[] = array('wrap', array('field' => 'mailing_smtp_username')); $_block_repeat=true;smarty_block_wrap($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
            <?php $this->_tag_stack[] = array('label', array('for' => 'mailingUsername')); $_block_repeat=true;smarty_block_label($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Username<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_label($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
            <?php echo smarty_function_text_field(array('name' => "mailing[mailing_smtp_username]",'value' => $this->_tpl_vars['mailing_data']['mailing_smtp_username'],'id' => 'mailingUsername'), $this);?>

          <?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_wrap($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
          </div>
          
          <div class="col">
          <?php $this->_tag_stack[] = array('wrap', array('field' => 'mailing_smtp_password')); $_block_repeat=true;smarty_block_wrap($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
            <?php $this->_tag_stack[] = array('label', array('for' => 'mailingPassword')); $_block_repeat=true;smarty_block_label($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Password<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_label($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
            <?php echo smarty_function_password_field(array('name' => "mailing[mailing_smtp_password]",'value' => $this->_tpl_vars['mailing_data']['mailing_smtp_password'],'id' => 'mailingPassword'), $this);?>

          <?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_wrap($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
          </div>
          
          <div class="col">
          <?php $this->_tag_stack[] = array('wrap', array('field' => 'mailing_smtp_security')); $_block_repeat=true;smarty_block_wrap($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
            <?php $this->_tag_stack[] = array('label', array('for' => 'mailingType')); $_block_repeat=true;smarty_block_label($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Security<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_label($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
            <select name="mailing[mailing_smtp_security]" id="mailingSecurity">
              <option value="off" <?php if ($this->_tpl_vars['mailing_data']['mailing_smtp_security'] == 'off'): ?>selected<?php endif; ?>>Off</option>
              <option value="ssl" <?php if ($this->_tpl_vars['mailing_data']['mailing_smtp_security'] == 'ssl'): ?>selected<?php endif; ?>>SSL</option>
              <option value="tls" <?php if ($this->_tpl_vars['mailing_data']['mailing_smtp_security'] == 'tls'): ?>selected<?php endif; ?>>TLS</option>
            </select>
          <?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_wrap($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
          </div>
        </div>
        
        <div class="clear"></div>
        <div id="test_connection" class="test_smtp_connection">
          <button type="button"><span><span><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Test Connection<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></span></span></button>
          <span class="test_connection_results">
            <img src="<?php echo smarty_function_image_url(array('name' => "pending_indicator.gif"), $this);?>
" alt='' />
            <span></span>
          </span>
        </div>
      </div>
    </div>
    
    <h2 class="section_name"><span class="section_name_span"><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Message Settings<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></span></h2>
    
    <div id="mailing_bulk_settings">
      <div class="section_container">
        <div class="col">
          <?php $this->_tag_stack[] = array('wrap', array('field' => 'notifications_from_email')); $_block_repeat=true;smarty_block_wrap($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
            <?php $this->_tag_stack[] = array('label', array('for' => 'notificationsFromEmail')); $_block_repeat=true;smarty_block_label($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>From Email<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_label($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
            <?php echo smarty_function_text_field(array('name' => "mailing[notifications_from_email]",'value' => $this->_tpl_vars['mailing_data']['notifications_from_email'],'id' => 'notificationsFromEmail'), $this);?>

          <?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_wrap($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
        </div>
        
        <div class="col">
          <?php $this->_tag_stack[] = array('wrap', array('field' => 'notifications_from_name')); $_block_repeat=true;smarty_block_wrap($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
            <?php $this->_tag_stack[] = array('label', array('for' => 'notificationsFromName')); $_block_repeat=true;smarty_block_label($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>From Name<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_label($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
            <?php echo smarty_function_text_field(array('name' => "mailing[notifications_from_name]",'value' => $this->_tpl_vars['mailing_data']['notifications_from_name'],'id' => 'notificationsFromName'), $this);?>

          <?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_wrap($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
        </div>
        
        <div class="clear"></div>
        <p class="details"><?php $this->_tag_stack[] = array('lang', array('email' => $this->_tpl_vars['admin_email'])); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Email clients will display this email address and name as sender. If this values are not set or valid, :email will be used<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></p>
        
        <?php $this->_tag_stack[] = array('wrap', array('field' => 'bulk_options')); $_block_repeat=true;smarty_block_wrap($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
          <p><input type="checkbox" name="mailing[mailing_mark_as_bulk]" value="1" id="mailingMarkAsBulk" class="inline" <?php if ($this->_tpl_vars['mailing_data']['mailing_mark_as_bulk']): ?>checked="checked"<?php endif; ?> />  <?php $this->_tag_stack[] = array('label', array('for' => 'mailingMarkAsBulk','class' => 'inline')); $_block_repeat=true;smarty_block_label($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Mark Notifications as Bulk Email (Recommended)<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_label($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></p>
          <p><input type="checkbox" name="mailing[mailing_empty_return_path]" value="1" id="mailingEmptyReturnPath" class="inline" <?php if ($this->_tpl_vars['mailing_data']['mailing_empty_return_path']): ?>checked="checked"<?php endif; ?> />  <?php $this->_tag_stack[] = array('label', array('for' => 'mailingEmptyReturnPath','class' => 'inline')); $_block_repeat=true;smarty_block_label($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Set Empty Return-Path<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_label($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></p>
        <?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_wrap($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
        <p class="details"><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>When messages are marked as bulk / auto-generated, email servers will not send automatic responses (such are Out of the Office messages) to them. Automatic responses are not desired if you are using Incoming Mail feature to capture responses to notifications as comments<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></p>
      </div>
    </div>
    
    <?php $this->_tag_stack[] = array('wrap_buttons', array()); $_block_repeat=true;smarty_block_wrap_buttons($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
      <?php $this->_tag_stack[] = array('submit', array()); $_block_repeat=true;smarty_block_submit($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Submit<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_submit($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
    <?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_wrap_buttons($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
  <?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_form($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
</div>

<?php echo smarty_function_empty_slate(array('name' => 'mailing','module' => 'system'), $this);?>