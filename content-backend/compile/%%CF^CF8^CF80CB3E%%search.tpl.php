<?php /* Smarty version 2.6.16, created on 2013-02-15 18:48:24
         compiled from /var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/system/views/dashboard/search.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'title', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/system/views/dashboard/search.tpl', 1, false),array('block', 'add_bread_crumb', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/system/views/dashboard/search.tpl', 2, false),array('block', 'form', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/system/views/dashboard/search.tpl', 5, false),array('block', 'lang', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/system/views/dashboard/search.tpl', 8, false),array('block', 'wrap', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/system/views/dashboard/search.tpl', 10, false),array('block', 'submit', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/system/views/dashboard/search.tpl', 23, false),array('block', 'pagination', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/system/views/dashboard/search.tpl', 34, false),array('function', 'text_field', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/system/views/dashboard/search.tpl', 11, false),array('function', 'assemble', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/system/views/dashboard/search.tpl', 34, false),array('function', 'list_objects', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/system/views/dashboard/search.tpl', 41, false),array('function', 'cycle', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/system/views/dashboard/search.tpl', 45, false),array('function', 'user_link', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/system/views/dashboard/search.tpl', 47, false),array('function', 'project_progress', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/system/views/dashboard/search.tpl', 58, false),array('modifier', 'clean', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/system/views/dashboard/search.tpl', 48, false),)), $this); ?>
<?php $this->_tag_stack[] = array('title', array()); $_block_repeat=true;smarty_block_title($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Search<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_title($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack);  $this->_tag_stack[] = array('add_bread_crumb', array()); $_block_repeat=true;smarty_block_add_bread_crumb($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Search<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_add_bread_crumb($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>

<div id="search">
  <?php $this->_tag_stack[] = array('form', array('action' => "?route=search",'method' => 'get','show_errors' => false,'id' => 'search_form')); $_block_repeat=true;smarty_block_form($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
  <table class="search_form stripped_background">
    <tr>
      <td class="search_form_caption"><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Search<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>:</td>
      <td class="search_for">
      <?php $this->_tag_stack[] = array('wrap', array('field' => 'search_for')); $_block_repeat=true;smarty_block_wrap($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
        <?php echo smarty_function_text_field(array('name' => 'q','id' => 'search_for_input','value' => $this->_tpl_vars['search_for'],'class' => 'required'), $this);?>

      <?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_wrap($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
      </td>
      <td class="search_type">
      <?php $this->_tag_stack[] = array('wrap', array('field' => 'search_type')); $_block_repeat=true;smarty_block_wrap($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
        <select name="type" id="search_for_type">
          <option value="in_projects" <?php if ($this->_tpl_vars['search_type'] == 'in_projects'): ?>selected="selected"<?php endif; ?>><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>In projects<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></option>
          <option value="for_people" <?php if ($this->_tpl_vars['search_type'] == 'for_people'): ?>selected="selected"<?php endif; ?>><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>For users<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></option>
          <option value="for_projects" <?php if ($this->_tpl_vars['search_type'] == 'for_projects'): ?>selected="selected"<?php endif; ?>><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>For projects<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></option>
        </select>
      <?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_wrap($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
      </td>
      <td class="search_form_button"><?php $this->_tag_stack[] = array('submit', array('class' => 'grey_button')); $_block_repeat=true;smarty_block_submit($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Go<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_submit($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></td>
    </tr>
  </table>
  <?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_form($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
  
<?php if ($this->_tpl_vars['search_for'] && $this->_tpl_vars['search_type']): ?>
  <div class="clear"></div>
  <?php if (is_foreachable ( $this->_tpl_vars['search_results'] )): ?>
  <div id="search_results">
    <p class="pagination top">
      <span class="inner_pagination">
      <?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Page<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>: <?php $this->_tag_stack[] = array('pagination', array('pager' => $this->_tpl_vars['pagination'])); $_block_repeat=true;smarty_block_pagination($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start();  echo smarty_function_assemble(array('route' => 'search','q' => $this->_tpl_vars['search_for'],'type' => $this->_tpl_vars['search_type'],'page' => '-PAGE-'), $this); $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_pagination($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
      </span>
    </p>
    
    <div class="clear"></div>
    
    <?php if ($this->_tpl_vars['search_type'] == 'in_projects'): ?>
      <?php echo smarty_function_list_objects(array('objects' => $this->_tpl_vars['search_results'],'show_checkboxes' => false,'show_header' => false,'id' => 'search_results'), $this);?>

    <?php elseif ($this->_tpl_vars['search_type'] == 'for_people'): ?>
    <table id="people_list">
    <?php $_from = $this->_tpl_vars['search_results']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['user']):
?>
      <tr class="<?php echo smarty_function_cycle(array('values' => 'odd,even'), $this);?>
">
        <td class="avatar"><img src="<?php echo $this->_tpl_vars['user']->getAvatarUrl(); ?>
" alt="" /></td>
        <td class="name"><?php echo smarty_function_user_link(array('user' => $this->_tpl_vars['user']), $this);?>
</td>
        <td class="email"><a href="mailto:<?php echo ((is_array($_tmp=$this->_tpl_vars['user']->getEmail())) ? $this->_run_mod_handler('clean', true, $_tmp) : smarty_modifier_clean($_tmp)); ?>
"><?php echo ((is_array($_tmp=$this->_tpl_vars['user']->getEmail())) ? $this->_run_mod_handler('clean', true, $_tmp) : smarty_modifier_clean($_tmp)); ?>
</a></td>
      </tr>
    <?php endforeach; endif; unset($_from); ?>
    </table>
    <?php elseif ($this->_tpl_vars['search_type'] == 'for_projects'): ?>
    <table id="projects_list">
    <?php $_from = $this->_tpl_vars['search_results']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['project']):
?>
      <tr class="<?php echo smarty_function_cycle(array('values' => 'odd,even'), $this);?>
">
        <td class="icon"><img src="<?php echo $this->_tpl_vars['project']->getIconUrl(); ?>
" alt="" /></td>
        <td class="name"><a href="<?php echo $this->_tpl_vars['project']->getOverviewUrl(); ?>
"><?php echo ((is_array($_tmp=$this->_tpl_vars['project']->getName())) ? $this->_run_mod_handler('clean', true, $_tmp) : smarty_modifier_clean($_tmp)); ?>
</a></td>
        <td class="progress"><?php echo smarty_function_project_progress(array('project' => $this->_tpl_vars['project'],'info' => false), $this);?>
</td>
      </tr>
    <?php endforeach; endif; unset($_from); ?>
    </table>
    <?php endif; ?>
  </div>
  <?php else: ?>
    <p class="empty_page"><?php $this->_tag_stack[] = array('lang', array('for' => $this->_tpl_vars['search_for'])); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Search failed to find any object that match your request<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></p>
  <?php endif;  endif; ?>
  
</div>