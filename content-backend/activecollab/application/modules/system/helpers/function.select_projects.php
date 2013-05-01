<?php

  /**
   * Select projects helper definition
   *
   * @package activeCollab.modules.system
   * @subpackage helpers
   */

  /**
   * Render select projects widget
   * 
   * Parameters:
   * 
   * - user - Instance of user accesing the page, required
   * - exclude - Single project or array of projects that need to be excluded
   * - value - Array of selected projects
   * - active_only - List only active projects
   * - show_all - If true and user is project manager / administrator, all 
   *   projects will be listed
   *
   * @param array $params
   * @param Smarty $smarty
   * @return string
   */
  function smarty_function_select_projects($params, &$smarty) {
    static $ids = array();
    
    $name = array_var($params, 'name');
    if($name == '') {
      return new InvalidParamError('name', $name, '$name is expected to be a valid control name', true);
    } // if
    
  	$user = array_var($params, 'user', null, true);
    if(!instance_of($user, 'User')) {
      return new InvalidParamError('user', $user, '$user is expected to be an instance of User class', true);
    } // if
    
    $id = array_var($params, 'id', null, true);
    if(empty($id)) {
      $counter = 1;
      do {
        $id = "select_projects_$counter";
      } while(in_array($id, $ids));
    } // if
    $ids[] = $id;
    
    $show_all = array_var($params, 'show_all', false) && $user->isProjectManager();
    
    $exclude = array_var($params, 'exclude', array(), true);
    if(!is_array($exclude)) {
      $exclude = array($exclude);
    } // if
    
    $value = array_var($params, 'value', null, true);
    if(is_foreachable($value) && count($exclude)) {
      foreach($value as $k => $v) {
        if(in_array($v, $exclude)) {
          unset($value[$k]);
        } // if
      } // foreach
    } // if
    
    $selected_projects = is_foreachable($value) ? Projects::findByIds($value) : null;
    
    require_once ANGIE_PATH . '/classes/json/init.php';
    $smarty->assign(array(
      '_select_projects_id' => $id,
      '_select_projects_name' => array_var($params, 'name'),
      '_select_projects_user' => $user,
      '_select_projects_projects' => $selected_projects,
      '_select_projects_exclude_ids' => do_json_encode($exclude),
      '_select_projects_active_only' => array_var($params, 'active_only', true),
      '_select_projects_show_all' => $show_all,
    ));
    
    return $smarty->fetch(get_template_path('_select_projects', null, SYSTEM_MODULE));
  } // smarty_function_select_projects

?>