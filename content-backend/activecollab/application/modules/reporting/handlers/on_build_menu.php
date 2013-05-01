<?php


  function reporting_handle_on_build_menu(&$menu, &$user) {
    $company = $user->getCompany();
    if($user->getSystemPermission('can_view_reports')) {
      $menu->addToGroup(array(
        new MenuItem('reporting', lang('Reports'), assemble_url('reports'), get_image_url('menu-icon.gif', REPORTING_MODULE))
      ), 'main');
    } else if ($user->isCompanyManager($company)) {
      $menu->addToGroup(array(
        new MenuItem('reporting', lang('Reports'), assemble_url('reports'), get_image_url('menu-icon.gif', REPORTING_MODULE)),
      ), 'main');        
    } // if
  } // reporting_handle_on_build_menu
?>