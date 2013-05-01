<?php /* Smarty version 2.6.16, created on 2012-07-20 15:47:47
         compiled from /mnt/raid0/vhosts/accident-review/content-backend/activecollab/application/modules/system/layouts/error.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'page_title', '/mnt/raid0/vhosts/accident-review/content-backend/activecollab/application/modules/system/layouts/error.tpl', 6, false),array('function', 'image_url', '/mnt/raid0/vhosts/accident-review/content-backend/activecollab/application/modules/system/layouts/error.tpl', 7, false),array('function', 'assemble', '/mnt/raid0/vhosts/accident-review/content-backend/activecollab/application/modules/system/layouts/error.tpl', 11, false),array('function', 'brand', '/mnt/raid0/vhosts/accident-review/content-backend/activecollab/application/modules/system/layouts/error.tpl', 11, false),array('function', 'year', '/mnt/raid0/vhosts/accident-review/content-backend/activecollab/application/modules/system/layouts/error.tpl', 17, false),)), $this); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-us" lang="en-us">
  <head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" href="<?php echo $this->_tpl_vars['assets_url']; ?>
/stylesheets/error.css" type="text/css" media="screen"/>
    <title><?php echo smarty_function_page_title(array('default' => 'Error'), $this);?>
</title>
    <link rel="shortcut icon" href="<?php echo smarty_function_image_url(array('name' => 'favicon.png'), $this);?>
" type="image/x-icon" />
  </head>
  <body>
    <div id="company_logo">
    <a href="<?php echo smarty_function_assemble(array('route' => 'homepage'), $this);?>
"><img src="<?php echo smarty_function_brand(array('what' => 'logo'), $this);?>
" alt="" /></a>
    </div>
    <div id="error_box">
      <?php echo $this->_tpl_vars['content_for_layout']; ?>

    </div>
    <div id="footer">
      <p id="copyright">&copy;<?php echo smarty_function_year(array(), $this);?>
</p>
    </div>
  </body>
</html>