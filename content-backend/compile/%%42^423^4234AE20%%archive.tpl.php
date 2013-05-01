<?php /* Smarty version 2.6.16, created on 2012-08-01 22:21:27
         compiled from /var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/tickets/views/tickets/archive.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'title', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/tickets/views/tickets/archive.tpl', 1, false),array('block', 'add_bread_crumb', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/tickets/views/tickets/archive.tpl', 2, false),array('block', 'lang', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/tickets/views/tickets/archive.tpl', 2, false),array('block', 'pagination', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/tickets/views/tickets/archive.tpl', 9, false),array('block', 'form', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/tickets/views/tickets/archive.tpl', 16, false),array('block', 'button', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/tickets/views/tickets/archive.tpl', 51, false),array('function', 'assemble', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/tickets/views/tickets/archive.tpl', 9, false),array('function', 'cycle', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/tickets/views/tickets/archive.tpl', 20, false),array('function', 'object_star', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/tickets/views/tickets/archive.tpl', 21, false),array('function', 'object_priority', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/tickets/views/tickets/archive.tpl', 22, false),array('function', 'object_link', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/tickets/views/tickets/archive.tpl', 25, false),array('function', 'action_on_by', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/tickets/views/tickets/archive.tpl', 26, false),array('modifier', 'clean', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/tickets/views/tickets/archive.tpl', 77, false),)), $this); ?>
<?php $this->_tag_stack[] = array('title', array()); $_block_repeat=true;smarty_block_title($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Archive<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_title($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack);  $this->_tag_stack[] = array('add_bread_crumb', array('not_lang' => true)); $_block_repeat=true;smarty_block_add_bread_crumb($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start();  $this->_tag_stack[] = array('lang', array('page' => $this->_tpl_vars['pagination']->getCurrentPage())); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Page :page<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack);  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_add_bread_crumb($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>

<div class="list_view" id="milestones">
  <div class="object_list">
  <?php if (is_foreachable ( $this->_tpl_vars['tickets'] )): ?>
    <?php if ($this->_tpl_vars['pagination']->getLastPage() > 1): ?>
      <?php if (isset ( $this->_tpl_vars['active_category'] ) && instance_of ( $this->_tpl_vars['active_category'] , 'Category' ) && $this->_tpl_vars['active_category']->isLoaded()): ?>
        <p class="pagination top"><span class="inner_pagination"><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Page<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>: <?php $this->_tag_stack[] = array('pagination', array('pager' => $this->_tpl_vars['pagination'])); $_block_repeat=true;smarty_block_pagination($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start();  echo smarty_function_assemble(array('route' => 'project_tickets_archive','project_id' => $this->_tpl_vars['active_project']->getId(),'page' => '-PAGE-','category_id' => $this->_tpl_vars['active_category']->getId()), $this); $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_pagination($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></span></p>
      <?php else: ?>
        <p class="pagination top"><span class="inner_pagination"><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Page<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>: <?php $this->_tag_stack[] = array('pagination', array('pager' => $this->_tpl_vars['pagination'])); $_block_repeat=true;smarty_block_pagination($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start();  echo smarty_function_assemble(array('route' => 'project_tickets_archive','project_id' => $this->_tpl_vars['active_project']->getId(),'page' => '-PAGE-'), $this); $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_pagination($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></span></p>
      <?php endif; ?>
    <?php endif; ?>
    
    <div class="clear"></div>
    <?php $this->_tag_stack[] = array('form', array('action' => $this->_tpl_vars['mass_edit_tickets_url'],'method' => 'post')); $_block_repeat=true;smarty_block_form($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
      <table>
        <tbody>
        <?php $_from = $this->_tpl_vars['tickets']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['ticket']):
?>
          <tr class="discussion <?php echo smarty_function_cycle(array('values' => 'odd,even'), $this);?>
" id="ticket<?php echo $this->_tpl_vars['ticket']->getId(); ?>
">
            <td class="star"><?php echo smarty_function_object_star(array('object' => $this->_tpl_vars['ticket'],'user' => $this->_tpl_vars['logged_user']), $this);?>
</td>
            <td class="priority"><?php echo smarty_function_object_priority(array('object' => $this->_tpl_vars['ticket']), $this);?>
</td>
            <td class="id">#<?php echo $this->_tpl_vars['ticket']->getTicketId(); ?>
</td>
            <td class="name">
              <?php echo smarty_function_object_link(array('object' => $this->_tpl_vars['ticket']), $this);?>

              <span class="details block"><?php echo smarty_function_action_on_by(array('user' => $this->_tpl_vars['ticket']->getCompletedBy(),'datetime' => $this->_tpl_vars['ticket']->getCompletedOn(),'action' => 'Completed'), $this);?>
</span>
            </td>
            <td class="ticket_checkbox"><input type="checkbox" name="tickets[]" value="<?php echo $this->_tpl_vars['ticket']->getId(); ?>
" class="auto input_checkbox" /></td>
          </tr>
        <?php endforeach; endif; unset($_from); ?>
        </tbody>
      </table>
      
      <div id="mass_edit">
        <select name="with_selected">
          <option value=""><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>With Selected ...<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></option>
          <option value=""></option>
          <option value="open"><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Mark as Open<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></option>
      <?php if (is_foreachable ( $this->_tpl_vars['milestones'] )): ?>
          <option value=""></option>
        <?php $_from = $this->_tpl_vars['milestones']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['milestone']):
?>
          <option value="move_to_milestone_<?php echo $this->_tpl_vars['milestone']->getId(); ?>
"><?php $this->_tag_stack[] = array('lang', array('name' => $this->_tpl_vars['milestone']->getName())); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Move to :name<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></option>
        <?php endforeach; endif; unset($_from); ?>
      <?php endif; ?>
          <option value=""></option>
          <option value="star"><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Star<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></option>
          <option value="unstar"><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Unstar<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></option>
          <option value=""></option>
          <option value="trash"><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Move to Trash<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></option>
        </select>
        <?php $this->_tag_stack[] = array('button', array()); $_block_repeat=true;smarty_block_button($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Go<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_button($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
      </div>
      
      <div class="clear"></div>
      
      <?php if (( $this->_tpl_vars['pagination']->getLastPage() > 1 ) && ! $this->_tpl_vars['pagination']->isLast()): ?>
        <?php if (isset ( $this->_tpl_vars['active_category'] ) && instance_of ( $this->_tpl_vars['active_category'] , 'Category' ) && $this->_tpl_vars['active_category']->isLoaded()): ?>
          <p class="next_page"><a href="<?php echo smarty_function_assemble(array('route' => 'project_tickets_archive','project_id' => $this->_tpl_vars['active_project']->getId(),'page' => $this->_tpl_vars['pagination']->getNextPage(),'category_id' => $this->_tpl_vars['active_category']->getId()), $this);?>
"><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Next Page<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a></p>
        <?php else: ?>
          <p class="next_page"><a href="<?php echo smarty_function_assemble(array('route' => 'project_tickets_archive','project_id' => $this->_tpl_vars['active_project']->getId(),'page' => $this->_tpl_vars['pagination']->getNextPage()), $this);?>
"><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Next Page<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a></p>
        <?php endif; ?>
      <?php endif; ?>
    <?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_form($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
  <?php else: ?>
  <?php if ($this->_tpl_vars['active_category']->isLoaded()): ?>
    <p class="empty_page"><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>No completed tickets in this category<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></p>
  <?php else: ?>
    <p class="empty_page"><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>No completed tickets in this project<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></p>
  <?php endif; ?>
  <?php endif; ?>
  </div>
  
  <ul class="category_list">
    <li <?php if ($this->_tpl_vars['active_category']->isNew()): ?>class="selected"<?php endif; ?>><a href="<?php echo $this->_tpl_vars['tickets_archive_url']; ?>
"><span><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>All Completed<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></span></a></li>
  <?php if (is_foreachable ( $this->_tpl_vars['categories'] )): ?>
    <?php $_from = $this->_tpl_vars['categories']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['category']):
?>
    <li category_id="<?php echo $this->_tpl_vars['category']->getId(); ?>
" <?php if ($this->_tpl_vars['active_category']->isLoaded() && $this->_tpl_vars['active_category']->getId() == $this->_tpl_vars['category']->getId()): ?>class="selected"<?php endif; ?>><a href="<?php echo smarty_function_assemble(array('route' => 'project_tickets_archive','project_id' => $this->_tpl_vars['active_project']->getId(),'category_id' => $this->_tpl_vars['category']->getId()), $this);?>
"><span><?php echo ((is_array($_tmp=$this->_tpl_vars['category']->getName())) ? $this->_run_mod_handler('clean', true, $_tmp) : smarty_modifier_clean($_tmp)); ?>
</span></a></li>
    <?php endforeach; endif; unset($_from); ?>
  <?php endif; ?>
    <li id="manage_categories"><a href="<?php echo $this->_tpl_vars['categories_url']; ?>
"><span><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Manage Categories<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></span></a></li>
  </ul>
  <script type="text/javascript">
    App.resources.ManageCategories.init('manage_categories');
  </script>

<div class="clear"></div>
</div>