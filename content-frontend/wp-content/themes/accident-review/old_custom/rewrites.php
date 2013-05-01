<?php
/**
* create_custom_rewrite_rules()
* Creates the custom rewrite rules.
* return array $rules.
**/

$custom_rules = array(
    
	'job-details'	=> array(
		'regex'	=>	'reps/jobs/view/(.+?)',
		'query'	=>	'pagename=jobs&accident_dtype=detail&accident_query='
	)
);


function create_custom_rewrite_rules() {
	global $wp_rewrite, $custom_rules;
	
	foreach ($custom_rules as $rule_name => $rule_values){
		$rw_tag = '%' . $rule_name . '%';
		$wp_rewrite->add_rewrite_tag($rw_tag, $rule_values['regex'], $rule_values['query']);
		$rewrite_keywords_structure = $wp_rewrite->root. "$rw_tag";
		$rule = $wp_rewrite->generate_rewrite_rules( $rewrite_keywords_structure );
		$wp_rewrite->rules = $rule + $wp_rewrite->rules;
	}
	
	return $wp_rewrite->rules;
} // End create_custom_rewrite_rules()


/**
* add_custom_page_variables()
* Add the custom token as an allowed query variable.
* return array $public_query_vars.
**/

function add_custom_page_variables( $public_query_vars ) {
	$public_query_vars[] = 'accident_query';
	$public_query_vars[] = 'accident_dtype';
        
	return $public_query_vars;
} // End add_custom_page_variables()

/**
* flush_rewrite_rules()
* Flush the rewrite rules, which forces the regeneration with new rules.
* return void.
**/

function flush_my_rewrite_rules() {
	global $wp_rewrite;
	$wp_rewrite->flush_rules();
} 

add_action( 'init', 'flush_my_rewrite_rules' );
add_action( 'generate_rewrite_rules', 'create_custom_rewrite_rules' );
add_filter( 'query_vars', 'add_custom_page_variables' );

?>