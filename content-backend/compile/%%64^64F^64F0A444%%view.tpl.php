<?php /* Smarty version 2.6.16, created on 2012-08-01 17:59:01
         compiled from /var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/discussions/views/discussions/view.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'title', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/discussions/views/discussions/view.tpl', 1, false),array('block', 'add_bread_crumb', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/discussions/views/discussions/view.tpl', 3, false),array('block', 'lang', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/discussions/views/discussions/view.tpl', 3, false),array('block', 'pagination', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/discussions/views/discussions/view.tpl', 49, false),array('function', 'page_object', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/discussions/views/discussions/view.tpl', 2, false),array('function', 'object_quick_options', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/discussions/views/discussions/view.tpl', 5, false),array('function', 'milestone_link', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/discussions/views/discussions/view.tpl', 11, false),array('function', 'category_link', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/discussions/views/discussions/view.tpl', 16, false),array('function', 'object_subscriptions', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/discussions/views/discussions/view.tpl', 20, false),array('function', 'object_tags', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/discussions/views/discussions/view.tpl', 24, false),array('function', 'object_attachments', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/discussions/views/discussions/view.tpl', 38, false),array('function', 'object_comments', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/discussions/views/discussions/view.tpl', 54, false),)), $this); ?>
<?php $this->_tag_stack[] = array('title', array()); $_block_repeat=true;smarty_block_title($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start();  echo $this->_tpl_vars['active_discussion']->getName();  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_title($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack);  echo smarty_function_page_object(array('object' => $this->_tpl_vars['active_discussion']), $this);?>

<?php $this->_tag_stack[] = array('add_bread_crumb', array()); $_block_repeat=true;smarty_block_add_bread_crumb($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start();  $this->_tag_stack[] = array('lang', array('page' => $this->_tpl_vars['pagination']->getCurrentPage())); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Page :page<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack);  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_add_bread_crumb($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>

<?php echo smarty_function_object_quick_options(array('object' => $this->_tpl_vars['active_discussion'],'user' => $this->_tpl_vars['logged_user']), $this);?>

<div class="discussion main_object" id="discussion<?php echo $this->_tpl_vars['active_discussion']->getId(); ?>
">
  <div class="body">
    <dl class="properties">
    <?php if ($this->_tpl_vars['logged_user']->canSeeMilestones($this->_tpl_vars['active_project']) && $this->_tpl_vars['active_discussion']->getMilestoneId()): ?>
      <dt><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Milestone<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></dt>
      <dd><?php echo smarty_function_milestone_link(array('object' => $this->_tpl_vars['active_discussion']), $this);?>
</dd>
    <?php endif; ?>
    
    <?php if ($this->_tpl_vars['active_discussion']->getParent()): ?>
      <dt><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Category<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></dt>
      <dd><?php echo smarty_function_category_link(array('object' => $this->_tpl_vars['active_discussion']), $this);?>
</dd>
    <?php endif; ?>
    
      <dt><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Subscribers<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></dt>
      <dd><?php echo smarty_function_object_subscriptions(array('object' => $this->_tpl_vars['active_discussion'],'brief' => true), $this);?>
</dd>
    
    <?php if ($this->_tpl_vars['active_discussion']->hasTags()): ?>
      <dt><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Tags<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></dt>
      <dd><?php echo smarty_function_object_tags(array('object' => $this->_tpl_vars['active_discussion']), $this);?>
</dd>
    <?php endif; ?>
    </dl>
    
    <div class="body content discussion_details_toggled" id="discussions_body_<?php echo $this->_tpl_vars['active_discussion']->getId(); ?>
"><?php echo $this->_tpl_vars['active_discussion']->getFormattedBody(); ?>
</div>
    <?php if ($this->_tpl_vars['active_discussion']->getSource() == @OBJECT_SOURCE_EMAIL): ?>
      <script type="text/javascript">
        App.EmailObject.init('discussions_body_<?php echo $this->_tpl_vars['active_discussion']->getId(); ?>
');
      </script>
    <?php endif; ?>
  </div>
  
  <div class="resources">
    <div class="discussion_details_toggled">
      <?php echo smarty_function_object_attachments(array('object' => $this->_tpl_vars['active_discussion'],'brief' => true), $this);?>

    </div>
    <?php if ($this->_tpl_vars['pagination']->getCurrentPage() != 1): ?>
      <script type="text/javascript">
        $('.discussion_details_toggled').hide();
      </script>
    <?php endif; ?>
    
    <div class="resource object_comments" id="comments">
      <div class="body">
      <?php if ($this->_tpl_vars['pagination']->getLastPage() > 1): ?>
        <p class="pagination top"><span class="inner_pagination"><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Page<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>: <?php $this->_tag_stack[] = array('pagination', array('pager' => $this->_tpl_vars['pagination'])); $_block_repeat=true;smarty_block_pagination($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start();  echo $this->_tpl_vars['active_discussion']->getViewUrl('-PAGE-');  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_pagination($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></span></p>
        <div class="clear"></div>
        <?php endif; ?>
        
        <?php if ($this->_tpl_vars['pagination']->getLastPage() > $this->_tpl_vars['pagination']->getCurrentPage()): ?>
          <?php echo smarty_function_object_comments(array('object' => $this->_tpl_vars['active_discussion'],'comments' => $this->_tpl_vars['comments'],'show_header' => false,'count_from' => $this->_tpl_vars['count_start'],'next_page' => $this->_tpl_vars['active_discussion']->getViewUrl($this->_tpl_vars['pagination']->getNextPage())), $this);?>

        <?php else: ?>
          <?php echo smarty_function_object_comments(array('object' => $this->_tpl_vars['active_discussion'],'comments' => $this->_tpl_vars['comments'],'show_header' => false,'count_from' => $this->_tpl_vars['count_start']), $this);?>

        <?php endif; ?>
      </div>
    </div>
  </div>
</div>