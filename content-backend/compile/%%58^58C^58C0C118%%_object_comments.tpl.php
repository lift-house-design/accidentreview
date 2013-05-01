<?php /* Smarty version 2.6.16, created on 2012-07-27 16:10:06
         compiled from /var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/resources/views/comments/_object_comments.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'lang', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/resources/views/comments/_object_comments.tpl', 4, false),array('block', 'assign_var', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/resources/views/comments/_object_comments.tpl', 15, false),array('block', 'link', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/resources/views/comments/_object_comments.tpl', 28, false),array('block', 'form', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/resources/views/comments/_object_comments.tpl', 69, false),array('block', 'wrap', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/resources/views/comments/_object_comments.tpl', 72, false),array('block', 'label', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/resources/views/comments/_object_comments.tpl', 73, false),array('block', 'editor_field', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/resources/views/comments/_object_comments.tpl', 74, false),array('block', 'wrap_buttons', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/resources/views/comments/_object_comments.tpl', 88, false),array('block', 'submit', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/resources/views/comments/_object_comments.tpl', 89, false),array('function', 'counter', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/resources/views/comments/_object_comments.tpl', 15, false),array('function', 'cycle', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/resources/views/comments/_object_comments.tpl', 19, false),array('function', 'image_url', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/resources/views/comments/_object_comments.tpl', 30, false),array('function', 'object_visibility', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/resources/views/comments/_object_comments.tpl', 37, false),array('function', 'user_link', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/resources/views/comments/_object_comments.tpl', 45, false),array('function', 'object_attachments', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/resources/views/comments/_object_comments.tpl', 57, false),array('function', 'checkbox_field', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/resources/views/comments/_object_comments.tpl', 77, false),array('function', 'attach_files', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/resources/views/comments/_object_comments.tpl', 84, false),array('modifier', 'ago', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/resources/views/comments/_object_comments.tpl', 46, false),)), $this); ?>
<div class="object_comments resource" id="object_comments_<?php echo $this->_tpl_vars['_object_comments_object']->getId(); ?>
">
  <?php if ($this->_tpl_vars['_object_comments_show_header']): ?>
  <div class="head">
    <h2 class="section_name comments_section_name"><span class="section_name_span"><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Comments<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></span></h2>
  </div>
  <?php endif; ?>
  
  <div class="body">
    <div class="subobjects_container">
    <?php if (is_foreachable ( $this->_tpl_vars['_object_comments_comments'] )): ?>
      <?php if (! isset ( $this->_tpl_vars['counter'] )): ?>
        <?php $this->assign('counter', 0); ?>
      <?php endif; ?>
    
      <?php $this->_tag_stack[] = array('assign_var', array('name' => 'black_hole')); $_block_repeat=true;smarty_block_assign_var($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start();  echo smarty_function_counter(array('name' => 'comment_num','start' => $this->_tpl_vars['counter']), $this); $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_assign_var($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
      
      <?php $_from = $this->_tpl_vars['_object_comments_comments']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['_object_comments_comments'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['_object_comments_comments']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['_object_comments_comment']):
        $this->_foreach['_object_comments_comments']['iteration']++;
?>
        <?php $this->assign('_object_comment_author', $this->_tpl_vars['_object_comments_comment']->getCreatedBy()); ?>
        <div class="subobject comment <?php if ($this->_foreach['_object_comments_comments']['iteration'] == 1): ?>first_subobject<?php endif; ?> <?php echo smarty_function_cycle(array('values' => 'odd,even','name' => 'object_comments'), $this);?>
" id="comment<?php echo $this->_tpl_vars['_object_comments_comment']->getId(); ?>
">
        
          <div class="subobject_author">
            <a class="avatar" href="<?php if (instance_of ( $this->_tpl_vars['_object_comment_author'] , 'User' )):  echo $this->_tpl_vars['_object_comment_author']->getViewUrl();  elseif (instance_of ( $this->_tpl_vars['_object_comment_author'] , 'AnonymousUser' ) && trim ( $this->_tpl_vars['_object_comment_author']->getName() ) && is_valid_email ( $this->_tpl_vars['_object_comment_author']->getEmail() )): ?>mailto:<?php echo $this->_tpl_vars['_object_comment_author']->getEmail();  endif; ?>">
              <img src="<?php echo $this->_tpl_vars['_object_comment_author']->getAvatarUrl(true); ?>
" alt="avatar" />
            </a>
          
            <ul class="comment_options">
              <li class="comment_options_first">&nbsp;</li>
              <li><?php $this->_tag_stack[] = array('link', array('href' => $this->_tpl_vars['_object_comments_comment']->getViewUrl(),'title' => 'Permalink','class' => 'subobject_permalink','not_lang' => true)); $_block_repeat=true;smarty_block_link($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start();  $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>#<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack);  echo smarty_function_counter(array('name' => 'comment_num'), $this); $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_link($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></li>
            <?php if ($this->_tpl_vars['_object_comments_comment']->canEdit($this->_tpl_vars['logged_user'])): ?>
              <li><?php $this->_tag_stack[] = array('link', array('href' => $this->_tpl_vars['_object_comments_comment']->getAttachmentsUrl(),'title' => 'Manage Attachments')); $_block_repeat=true;smarty_block_link($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><img src="<?php echo smarty_function_image_url(array('name' => "gray-attachment.gif"), $this);?>
" alt="" /><?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_link($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></li>
              <li><?php $this->_tag_stack[] = array('link', array('href' => $this->_tpl_vars['_object_comments_comment']->getEditUrl(),'title' => 'Update Comment')); $_block_repeat=true;smarty_block_link($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><img src="<?php echo smarty_function_image_url(array('name' => "gray-edit.gif"), $this);?>
" alt="" /><?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_link($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></li>
            <?php endif; ?>
            <?php if ($this->_tpl_vars['_object_comments_comment']->canDelete($this->_tpl_vars['logged_user'])): ?>
              <li><?php $this->_tag_stack[] = array('link', array('href' => $this->_tpl_vars['_object_comments_comment']->getTrashUrl(),'title' => 'Move to Trash','method' => 'post')); $_block_repeat=true;smarty_block_link($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><img src='<?php echo smarty_function_image_url(array('name' => "gray-delete.gif"), $this);?>
' alt='delete' /><?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_link($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></li>
            <?php endif; ?>
            <?php if ($this->_tpl_vars['_object_comments_comment']->getVisibility() == VISIBILITY_PRIVATE): ?>
              <li><?php echo smarty_function_object_visibility(array('object' => $this->_tpl_vars['_object_comments_comment'],'user' => $this->_tpl_vars['logged_user']), $this);?>
</li>
            <?php endif; ?>
            </ul>
            <script type="text/javascript">
              App.CommentOptions.init('comment<?php echo $this->_tpl_vars['_object_comments_comment']->getId(); ?>
');
            </script>
          
            <div class="subobject_author_info">
              <?php echo smarty_function_user_link(array('user' => $this->_tpl_vars['_object_comment_author']), $this);?>
 <?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>said<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?><br />
              <span class="subobject_date"><?php echo ((is_array($_tmp=$this->_tpl_vars['_object_comments_comment']->getCreatedOn())) ? $this->_run_mod_handler('ago', true, $_tmp) : smarty_modifier_ago($_tmp)); ?>
</span>
            </div>
          </div>
        
          <div class="content" id="comment_body_<?php echo $this->_tpl_vars['_object_comments_comment']->getId(); ?>
"><?php echo $this->_tpl_vars['_object_comments_comment']->getFormattedBody(); ?>
</div>
          <?php if ($this->_tpl_vars['_object_comments_comment']->getSource() == @OBJECT_SOURCE_EMAIL): ?>
            <script type="text/javascript">
              App.EmailObject.init('comment_body_<?php echo $this->_tpl_vars['_object_comments_comment']->getId(); ?>
');
            </script>
          <?php endif; ?>
          
          <?php echo smarty_function_object_attachments(array('object' => $this->_tpl_vars['_object_comments_comment'],'brief' => true), $this);?>

        </div>
      <?php endforeach; endif; unset($_from); ?>
    <?php endif; ?>
    
    <?php if ($this->_tpl_vars['_object_comments_next_page']): ?>
    <p class="next_page"><a href=<?php echo $this->_tpl_vars['_object_comments_next_page']; ?>
><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Next Page<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a></p>
    <?php endif; ?>
    
    <?php if ($this->_tpl_vars['_object_comments_show_form'] && $this->_tpl_vars['_object_comments_object']->canComment($this->_tpl_vars['logged_user'])): ?>
      <!-- Post comment form -->
      <div class="quick_comment_form">
        <?php $this->_tag_stack[] = array('form', array('action' => $this->_tpl_vars['_object_comments_object']->getPostCommentUrl(),'method' => 'post','enctype' => "multipart/form-data",'autofocus' => false,'ask_on_leave' => true)); $_block_repeat=true;smarty_block_form($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
          <div class="expandable_editor">
            <div class="real_textarea">
              <?php $this->_tag_stack[] = array('wrap', array('field' => 'body')); $_block_repeat=true;smarty_block_wrap($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
                <?php $this->_tag_stack[] = array('label', array('for' => 'commentBody','required' => true)); $_block_repeat=true;smarty_block_label($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Your Comment<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_label($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
                <?php $this->_tag_stack[] = array('editor_field', array('name' => 'comment[body]','class' => 'validate_callback tiny_value_present','id' => 'commentBody')); $_block_repeat=true;smarty_block_editor_field($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start();  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_editor_field($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
              <?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_wrap($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
              <?php if ($this->_tpl_vars['_object_comments_object']->canChangeCompleteStatus($this->_tpl_vars['logged_user']) && $this->_tpl_vars['_object_comments_object']->isOpen()): ?>
                <label for="completeParent" class="checkbox_complete"><?php echo smarty_function_checkbox_field(array('name' => 'comment[complete_parent_object]','id' => 'completeParent','value' => 'true'), $this);?>
 <?php $this->_tag_stack[] = array('lang', array('object_type' => $this->_tpl_vars['_object_comments_object']->getVerboseType(true))); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Complete :object_type with this comment<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></label>
              <?php endif; ?>
              <div class="ctrlHolderContainer">
                <a href="#" class="ctrlHolderToggler button_add attachments"><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Attach Files<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>...</a>
                <div class="strlHolderToggled">
                <?php $this->_tag_stack[] = array('wrap', array('field' => 'attachments')); $_block_repeat=true;smarty_block_wrap($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
                  <?php $this->_tag_stack[] = array('label', array()); $_block_repeat=true;smarty_block_label($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Attachments<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_label($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
                  <?php echo smarty_function_attach_files(array('max_files' => 5), $this);?>

                <?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_wrap($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
                </div>
              </div>
              <?php $this->_tag_stack[] = array('wrap_buttons', array()); $_block_repeat=true;smarty_block_wrap_buttons($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
                <?php $this->_tag_stack[] = array('submit', array()); $_block_repeat=true;smarty_block_submit($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Comment<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_submit($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
              <?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_wrap_buttons($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
            </div>
          </div>
        <?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_form($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
      </div>
    <?php elseif ($this->_tpl_vars['_object_comments_object']->getIsLocked()): ?>
      <p id="locked_comments"><span><?php $this->_tag_stack[] = array('lang', array('type' => $this->_tpl_vars['_object_comments_object']->getVerboseType(true))); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>This :type is locked for new comments<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></span></p>
    <?php endif; ?>
    </div>
    <div class="clear"></div>
  </div>
</div>
<script type="text/javascript">
  // TODO: App.resources.quickCommentForm.init('object_comments_<?php echo $this->_tpl_vars['_object_comments_object']->getId(); ?>
');
  $('#object_comments_<?php echo $this->_tpl_vars['_object_comments_object']->getId(); ?>
 div.comment div.content').scaleBigImages();
</script>