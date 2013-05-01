<?php /* Smarty version 2.6.16, created on 2012-07-31 18:39:54
         compiled from /var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/system/views/project/_project_form.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'wrap', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/system/views/project/_project_form.tpl', 2, false),array('block', 'label', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/system/views/project/_project_form.tpl', 3, false),array('block', 'editor_field', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/system/views/project/_project_form.tpl', 9, false),array('block', 'textarea_field', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/system/views/project/_project_form.tpl', 13, false),array('block', 'assign_var', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/system/views/project/_project_form.tpl', 31, false),array('block', 'lang', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/system/views/project/_project_form.tpl', 31, false),array('function', 'text_field', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/system/views/project/_project_form.tpl', 4, false),array('function', 'select_visibility', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/system/views/project/_project_form.tpl', 36, false),array('function', 'select_user', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/system/views/project/_project_form.tpl', 201, false),array('function', 'select_company', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/system/views/project/_project_form.tpl', 206, false),array('function', 'select_project_group', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/system/views/project/_project_form.tpl', 222, false),array('function', 'select_date', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/system/views/project/_project_form.tpl', 227, false),)), $this); ?>
<div class="form_left_col">
  <?php $this->_tag_stack[] = array('wrap', array('field' => 'name')); $_block_repeat=true;smarty_block_wrap($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
    <?php $this->_tag_stack[] = array('label', array('for' => 'projectName','required' => 1)); $_block_repeat=true;smarty_block_label($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Client Name<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_label($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
    <?php echo smarty_function_text_field(array('name' => 'project[name]','value' => $this->_tpl_vars['project_data']['name'],'id' => 'projectName','class' => 'title'), $this);?>

  <?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_wrap($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
  
  <?php $this->_tag_stack[] = array('wrap', array('field' => 'overview')); $_block_repeat=true;smarty_block_wrap($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
    <?php $this->_tag_stack[] = array('label', array('for' => 'projectOverview')); $_block_repeat=true;smarty_block_label($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Client Notes<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_label($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
    <?php $this->_tag_stack[] = array('editor_field', array('name' => 'project[overview]','id' => 'projectOverview','inline_attachments' => $this->_tpl_vars['project_data']['inline_attachments'])); $_block_repeat=true;smarty_block_editor_field($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start();  echo $this->_tpl_vars['project_data']['overview'];  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_editor_field($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
  <?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_wrap($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack);  $this->_tag_stack[] = array('wrap', array('field' => 'office_address')); $_block_repeat=true;smarty_block_wrap($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
  <?php $this->_tag_stack[] = array('label', array('for' => 'companyAddress')); $_block_repeat=true;smarty_block_label($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Address<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_label($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
  <?php $this->_tag_stack[] = array('textarea_field', array('name' => 'company[office_address]','id' => 'companyAddress')); $_block_repeat=true;smarty_block_textarea_field($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start();  echo $this->_tpl_vars['company_data']['office_address'];  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_textarea_field($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack);  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_wrap($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>

<?php $this->_tag_stack[] = array('wrap', array('field' => 'office_phone')); $_block_repeat=true;smarty_block_wrap($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
  <?php $this->_tag_stack[] = array('label', array('for' => 'companyName')); $_block_repeat=true;smarty_block_label($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Phone Number<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_label($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
  <?php echo smarty_function_text_field(array('name' => 'company[office_phone]','value' => $this->_tpl_vars['company_data']['office_phone'],'id' => 'companyName'), $this);?>

<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_wrap($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>

<?php $this->_tag_stack[] = array('wrap', array('field' => 'office_fax')); $_block_repeat=true;smarty_block_wrap($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
  <?php $this->_tag_stack[] = array('label', array('for' => 'companyFax')); $_block_repeat=true;smarty_block_label($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Fax Number<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_label($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
  <?php echo smarty_function_text_field(array('name' => 'company[office_fax]','value' => $this->_tpl_vars['company_data']['office_fax'],'id' => 'companyFax'), $this);?>

<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_wrap($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>

<?php $this->_tag_stack[] = array('wrap', array('field' => 'office_homepage')); $_block_repeat=true;smarty_block_wrap($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
  <?php $this->_tag_stack[] = array('label', array('for' => 'companyHomepage')); $_block_repeat=true;smarty_block_label($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Homepage<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_label($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
  <?php echo smarty_function_text_field(array('name' => 'company[office_homepage]','value' => $this->_tpl_vars['company_data']['office_homepage'],'id' => 'companyHomepage'), $this);?>

<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_wrap($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack);  if ($this->_tpl_vars['logged_user']->canSeePrivate()): ?>
  <?php $this->_tag_stack[] = array('assign_var', array('name' => 'project_visibility_normal_caption')); $_block_repeat=true;smarty_block_assign_var($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start();  $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Normal &mdash; <span class="details">Visible to everyone involved with the project</span><?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack);  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_assign_var($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
  <?php $this->_tag_stack[] = array('assign_var', array('name' => 'project_visibility_private_caption')); $_block_repeat=true;smarty_block_assign_var($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start();  $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Private &mdash; <span class="details">Visible only to people with can_see_private_objects role permission</span><?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack);  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_assign_var($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>

  <?php $this->_tag_stack[] = array('wrap', array('field' => 'default_visibility')); $_block_repeat=true;smarty_block_wrap($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
    <?php $this->_tag_stack[] = array('label', array('for' => 'projectVisibility')); $_block_repeat=true;smarty_block_label($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Default Visibility<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_label($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
    <?php echo smarty_function_select_visibility(array('name' => 'project[default_visibility]','value' => $this->_tpl_vars['project_data']['default_visibility'],'id' => 'projectVisibility','normal_caption' => $this->_tpl_vars['project_visibility_normal_caption'],'private_caption' => $this->_tpl_vars['project_visibility_private_caption']), $this);?>

  <?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_wrap($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack);  else: ?>
  <input type="hidden" name="project[default_visibility]" value="<?php echo $this->_tpl_vars['project_data']['default_visibility']; ?>
" />
<?php endif; ?>

    <br />
    <div class="company_user_options">
        <h3>Client Users</h3>
        <?php $_from = $this->_tpl_vars['company_users']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['comp_user_loop'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['comp_user_loop']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['company_user']):
        $this->_foreach['comp_user_loop']['iteration']++;
?>
        <div class="accident_user_block" id="company_user_<?php echo ($this->_foreach['comp_user_loop']['iteration']-1); ?>
">
            <div>
                <label for="company_user_email">Email Address</label>
                <input type="text" name="company_user_email[]" value="<?php echo $this->_tpl_vars['company_user']['email']; ?>
" class="full"/>
            </div>
            <div>
                <label for="company_user_first">First Name</label>
                <input type="text" name="company_user_first[]" value="<?php echo $this->_tpl_vars['company_user']['first_name']; ?>
" class="full" />
            </div>
            <div>
                <label for="company_user_last">Last Name</label>
                <input type="text" name="company_user_last[]" value="<?php echo $this->_tpl_vars['company_user']['last_name']; ?>
" class="full" />
            </div>
            <div>
                <label for="company_user_password">User Password</label>
                <input type="text" name="company_user_password[]" value="<?php echo $this->_tpl_vars['company_user']['password_plain']; ?>
" class="full" />
            </div>
            <div>
                <label for="company_admin_admin">Is Admin</label>
                <input type="checkbox" name="company_user_admin[]" value="<?php echo ($this->_foreach['comp_user_loop']['iteration']-1); ?>
" class="short" <?php if ($this->_tpl_vars['company_user']['admin'] == 1): ?>checked="checked"<?php endif; ?>/>
            </div>
            <br class="clear" />
            <a class="remove_company_user" href="#">Remove User</a>
            <br class="clear" />
        </div>
        <?php endforeach; else: ?>
        <div class="accident_user_block" id="company_user_1">
            <div>
                <label for="company_user_email">Email Address</label>
                <input type="text" name="company_user_email[]" value="" class="full"/>
            </div>
            <div>
                <label for="company_user_first">First Name</label>
                <input type="text" name="company_user_first[]" value="" class="full" />
            </div>
            <div>
                <label for="company_user_last">Last Name</label>
                <input type="text" name="company_user_last[]" value="" class="full" />
            </div>
            <div>
                <label for="company_user_password">User Password</label>
                <input type="text" name="company_user_password[]" value="" class="full" />
            </div>
            <div>
                <label for="company_admin_admin">Is Admin</label>
                <input type="checkbox" name="company_user_admin[]" value="1" class="short" />
            </div>
            <br class="clear" />
            <a class="remove_company_user" href="#">Remove User</a>
            <br class="clear" />
        </div>
        <?php endif; unset($_from); ?>
        <a href="#" class="add_company_user">Add another User</a>
        <?php echo '
        <script type="text/javascript">
            
            $(function(){
                
                $(\'select[name="project[company_id]"]\').parents(\'.ctrlHolder:eq(0)\').hide();
                $(\'select[name="project[group_id]"]\').parents(\'.ctrlHolder:eq(0)\').hide();
                $(\'input[name="project[starts_on]"]\').parents(\'.ctrlHolder:eq(0)\').hide();
                $(\'select[name="project[project_template_id]"]\').parents(\'.ctrlHolder:eq(0)\').hide();
                
                $(\'#projectVisibility_1\').trigger(\'click\');
                
                var total_users = 1;
				var user_block_html = $(".accident_user_block").html();
                
                $(user_block_html).find(\'input[type="text"]\').val(\'\');
                $(user_block_html).find(\'input[type="checkbox"]\').attr({ \'checked\': \'\'});
                
                $(\'.remove_company_user\').bind(\'click\',function(event){
                    if($(\'.accident_user_block\').length > 1){
                        $(\'<div>Are you sure you want to remove this user?</div>\').dialog({
                           buttons: {
                                \'Yes\' : function(){
                                    $(this).dialog(\'close\');
                                    $(event.target).parents(\'.accident_user_block\').fadeOut(\'slow\',function(){
                                        $(this).remove(); 
                                    });
                                    total_users = total_users - 1;
                                },
                                \'Cancel\': function(){
                                    $(this).dialog(\'close\');
                                }
                           } 
                        });
                    } else {
                        $(\'<div>At least one Company user is required</div>\').dialog({
                            buttons: {
                                \'Okay\' : function(){
                                    $(this).dialog(\'close\');
                                }
                            }
                        });
                    }
                });
                
                $(\'.add_company_user\').bind(\'click\',function(event){
                    
                    
                    total_users = total_users + 1;
                    
                    new_block = $(\'<div />\').addClass(\'accident_user_block\')
                                    .attr({
                                        \'id\': \'company_user_\'+total_users
                                    })
                                    .append(user_block_html);
                    
                    $(new_block).find(\'input[type="checkbox"]\').val(total_users);
                    $(new_block).css(\'display\',\'none\');
                    
                    $(new_block).find(\'.remove_company_user\').bind(\'click\',function(event){
                    if($(\'.accident_user_block\').length > 1){
                        $(\'<div>Are you sure you want to remove this user?</div>\').dialog({
                           buttons: {
                                \'Yes\' : function(){
                                    $(this).dialog(\'close\');
                                    $(event.target).parents(\'.accident_user_block\').fadeOut(\'slow\',function(){
                                        $(this).remove(); 
                                    });
                                    total_users = total_users - 1;
                                },
                                \'Cancel\': function(){
                                    $(this).dialog(\'close\');
                                }
                           } 
                        });
                    } else {
                        $(\'<div>At least one Company user is required</div>\').dialog({
                            buttons: {
                                \'Okay\' : function(){
                                    $(this).dialog(\'close\');
                                }
                            }
                        });
                    }
                });
                    
                    $(\'.accident_user_block:last\').after(new_block);
                    $(\'#company_user_\'+total_users).fadeIn(\'slow\');
                    event.preventDefault();
                });
                
                
            });
        </script>
        '; ?>

    </div>
</div>

<div class="form_right_col">
<?php if ($this->_tpl_vars['logged_user']->isOwner()): ?>
  <?php $this->_tag_stack[] = array('wrap', array('field' => 'leader_id')); $_block_repeat=true;smarty_block_wrap($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
    <?php $this->_tag_stack[] = array('label', array('for' => 'projectLader','required' => true)); $_block_repeat=true;smarty_block_label($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Leader<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_label($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
    <?php echo smarty_function_select_user(array('name' => 'project[leader_id]','value' => $this->_tpl_vars['project_data']['leader_id'],'id' => 'projectLader','optional' => false), $this);?>

  <?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_wrap($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>

  <?php $this->_tag_stack[] = array('wrap', array('field' => 'company_id')); $_block_repeat=true;smarty_block_wrap($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
    <?php $this->_tag_stack[] = array('label', array('for' => 'projectCompany')); $_block_repeat=true;smarty_block_label($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Company<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_label($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
    <?php echo smarty_function_select_company(array('name' => 'project[company_id]','value' => $this->_tpl_vars['project_data']['company_id'],'id' => 'projectCompany','optional' => true,'exclude' => $this->_tpl_vars['owner_company']->getId()), $this);?>

  <?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_wrap($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack);  else: ?>
  <?php $this->_tag_stack[] = array('wrap', array('field' => 'leader_id')); $_block_repeat=true;smarty_block_wrap($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
    <?php $this->_tag_stack[] = array('label', array('for' => 'projectLader','required' => true)); $_block_repeat=true;smarty_block_label($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Leader<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_label($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
    <?php echo smarty_function_select_user(array('name' => 'project[leader_id]','value' => $this->_tpl_vars['project_data']['leader_id'],'id' => 'projectLader','users' => $this->_tpl_vars['logged_user']->visibleUserIds(),'optional' => false), $this);?>

  <?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_wrap($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>

  <?php $this->_tag_stack[] = array('wrap', array('field' => 'company_id')); $_block_repeat=true;smarty_block_wrap($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
    <?php $this->_tag_stack[] = array('label', array('for' => 'projectCompany')); $_block_repeat=true;smarty_block_label($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Company<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_label($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
    <?php echo smarty_function_select_company(array('name' => 'project[company_id]','value' => $this->_tpl_vars['project_data']['company_id'],'id' => 'projectCompany','companies' => $this->_tpl_vars['logged_user']->visibleCompanyIds(),'optional' => true,'exclude' => $this->_tpl_vars['owner_company']->getId()), $this);?>

  <?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_wrap($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack);  endif; ?>

  <?php $this->_tag_stack[] = array('wrap', array('field' => 'group_id')); $_block_repeat=true;smarty_block_wrap($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
    <?php $this->_tag_stack[] = array('label', array('for' => 'projectGroup')); $_block_repeat=true;smarty_block_label($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Group<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_label($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
    <?php echo smarty_function_select_project_group(array('name' => 'project[group_id]','value' => $this->_tpl_vars['project_data']['group_id'],'id' => 'projectGroup','optional' => true), $this);?>

  <?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_wrap($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
  
  <?php $this->_tag_stack[] = array('wrap', array('field' => 'starts_on')); $_block_repeat=true;smarty_block_wrap($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
    <?php $this->_tag_stack[] = array('label', array('for' => 'projectStartsOn')); $_block_repeat=true;smarty_block_label($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Starts On<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_label($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
    <?php echo smarty_function_select_date(array('name' => 'project[starts_on]','value' => $this->_tpl_vars['project_data']['starts_on'],'id' => 'projectStartsOn'), $this);?>

  <?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_wrap($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
</div>
<div class="clear"></div>