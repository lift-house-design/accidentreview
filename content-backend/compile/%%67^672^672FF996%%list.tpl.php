<?php /* Smarty version 2.6.16, created on 2012-08-09 18:33:58
         compiled from /var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/resources/views/categories/list.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'title', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/resources/views/categories/list.tpl', 1, false),array('block', 'add_bread_crumb', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/resources/views/categories/list.tpl', 2, false),array('block', 'lang', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/resources/views/categories/list.tpl', 13, false),array('function', 'include_template', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/resources/views/categories/list.tpl', 9, false),array('function', 'image_url', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/resources/views/categories/list.tpl', 18, false),)), $this); ?>
<?php $this->_tag_stack[] = array('title', array()); $_block_repeat=true;smarty_block_title($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Categories<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_title($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack);  $this->_tag_stack[] = array('add_bread_crumb', array()); $_block_repeat=true;smarty_block_add_bread_crumb($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Categories<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_add_bread_crumb($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>

<div id="manage_categories_list" class="manage_categories <?php if ($this->_tpl_vars['request']->isAsyncCall()): ?>async<?php endif; ?>">
  <div class="manage_categories_table_wrapper">
    <table class="common_table">
  <?php if (is_foreachable ( $this->_tpl_vars['categories'] )): ?>
    <?php $_from = $this->_tpl_vars['categories']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['category']):
?>
      <?php echo smarty_function_include_template(array('name' => '_category_row','controller' => 'categories','module' => 'resources'), $this);?>

    <?php endforeach; endif; unset($_from); ?>
  <?php endif; ?>
    </table>
    <p id="manage_categories_empty_list" class="empty_page" <?php if (is_foreachable ( $this->_tpl_vars['categories'] )): ?>style="display: none"<?php endif; ?>><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>There are no categories in this section!<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></p>
  </div>
  
  <?php if ($this->_tpl_vars['can_add_category']): ?>
  <form action="<?php echo $this->_tpl_vars['add_category_url']; ?>
" method="post" class="add_category_form">
    <input type="text" /> <img src="<?php echo smarty_function_image_url(array('name' => 'plus-small.gif'), $this);?>
" alt="" title="<?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>New Category<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>" />
  </form>
  <?php endif; ?>
</div>

<script type="text/javascript">
  App.resources.ManageCategories.init_page('manage_categories_list');
</script>