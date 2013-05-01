<?php
class Bio_Widget extends WP_Widget {
    function Bio_Widget(){
        parent::WP_Widget(false,'Technician Bios');
    }
    
    function form($instance){
        global $wpdb;        
        $find_s = 'SELECT ID, post_title, post_name FROM wp_posts WHERE post_type=\'technician-bio\' AND post_status=\'publish\' ORDER BY post_title ASC';
        $find_q = $wpdb->get_results($find_s,'ARRAY_A');
        
        ?>
        <p>Select Bios</p>
        <?
        foreach($find_q as $a_bio) :
        ?>
            <input class="checkbox" type="checkbox" <?php checked($instance[$a_bio['ID']], true) ?> id="<?php echo $this->get_field_id($a_bio['ID']); ?>" name="<?php echo $this->get_field_name($a_bio['ID']); ?>" />
                <label for="<?php echo $this->get_field_id($a_bio['ID']); ?>"><?php _e($a_bio['post_title']); ?></label><br />
        <?
        endforeach;
    }
    
    function update( $new_instance, $old_instance ) {
            $new_instance = (array) $new_instance;
            
            global $wpdb;        
            $find_s = 'SELECT ID, post_title, post_name FROM wp_posts WHERE post_type=\'technician-bio\' AND post_status=\'publish\' ORDER BY post_title ASC';
            $find_q = $wpdb->get_results($find_s,'ARRAY_A');
        
            $instance = array();
            
            foreach($find_q as $a_bio) :                
                $instance[$a_bio['ID']] = 0;
            endforeach;
            
            foreach ( $instance as $field => $val ) {
                    if ( isset($new_instance[$field]) ){
                            $instance[$field] = 1;
                            $bio_ids[] = $field;
                    }
                            
            }
            $instance['category'] = intval($new_instance['category']);
            $instance['bio_ids'] = $bio_ids;

            return $instance;
    }
    
    function widget($args,$instance){
        $args['bio_ids'] = $instance['bio_ids'];
        //print_r($instance);
        accident_bio_content_func($args['bio_ids'],'none',true);
    }
}
register_widget('Bio_Widget');

function accident_bio_content_func($the_bios,$float='none',$sidebar=false){
    
        global $wpdb;       
        
        
        if($sidebar) $float = 'right';
        
        if($sidebar) : ?><? endif;
        ?>
        <div class="box">
            
            <h3>Expert Profiles</h3>
            <ul>
                <?php foreach($the_bios as &$a_bio) : ?>
                <li>                    
                    <?php
                        $find_s = 'SELECT ID, post_name, post_title, post_excerpt FROM wp_posts WHERE post_type=\'technician-bio\' AND post_status=\'publish\' AND ID = '.$a_bio;
                        $find_q = $wpdb->get_results($find_s,'ARRAY_A');                        
                        $bio = $find_q[0];
                        $link1 = get_permalink($bio['ID']);
                        $link2 = str_replace('technician-bio', 'reps/tech-aar', $link1)
                    ?>
                    <a href="<?php echo $link2; ?>"><?php echo $bio['post_title']; ?></a>
                    <p class="info"><?php echo $bio['post_excerpt']; ?></p>
                </li>
                <?php endforeach; ?>
            </ul>
            <p><a href="/reps/tech-aar/">View More Profiles »</a></p>
            <br class="clear" />
        </div>
        <br class="clear" />
        <?
        if($sidebar) : ?><? endif;
}

class Update_Widget extends WP_Widget {
    function Update_Widget(){
        parent::WP_Widget(false,'Technician Updates');
    }
    
    function form($instance){

        ?>
        <p><em>This widget has no options.</em></p>
        <?
        
    }
    
    function update( $new_instance, $old_instance ) {
        
            $instance = $new_instance;
        
            return $instance;
    }
    
    function widget($args,$instance){
        $args = $instance;
        //print_r($instance);
        accident_update_content_func($args,'none',true);
    }
}
register_widget('Update_Widget');

function accident_update_content_func($the_updates,$float='none',$sidebar=false){
    
        
        ?>
            <div class="box">
                <h3>Assignment Updates</h3>
                <ul>
                    <?php 
                    if($_SESSION['agent_user_admin']){
                        $updated_jobs=accident_get_company_jobs_updated($_SESSION['agent_user_company']);
                        $jobs=accident_get_company_jobs($_SESSION['agent_user_company']);

                        $open_jobs = array();
                        $pending_jobs = array();
                        $complete_jobs = array();
                        
                        $open_comments = 0;
                        $pending_comments = 0;
                        $complete_comments = 0;

                        foreach($jobs as &$a_job){                            
                            switch(accident_translate_job_state($a_job['ticket_id'])){
                                case 'Open':
                                    $open_jobs[] = $a_job;
                                    break;
                                case 'Pending':
                                    $pending_jobs[] = $a_job;
                                    break;
                                case 'Complete':
                                    $complete_jobs[] = $a_job;
                                    break;
                            }
                            
                        }
                        
                        foreach($jobs as &$a_job){                            
                            switch(accident_translate_job_state($a_job['ticket_id'])){
                                case 'Open':
                                    $open_comments += accident_get_new_comments($a_job['id']);
                                    //echo accident_get_new_comments($a_job['id']);
                                    break;
                                case 'Pending':
                                    $pending_comments += accident_get_new_comments($a_job['id']);
                                    //echo accident_get_new_comments($a_job['id']);
                                    break;
                                case 'Complete':
                                    $complete_comments += accident_get_new_comments($a_job['id']);
                                    //echo accident_get_new_comments($a_job['id']);
                                    break;
                            }
                            
                        }
                        
                        echo '<li><a href="/reps/assignments/#open">Open ['.count($open_jobs).']</a>';
                        if($open_comments){
                            echo '<a href="/reps/assignments/#open"><div class="comments-icon">&nbsp'/*.$open_comments*/.'</div></a>';
                        }
                        echo '</li>';
                        echo '<li><a href="/reps/assignments/#pending">Pending ['.count($pending_jobs).']</a>';
                        if($pending_comments){
                            echo '<a href="/reps/assignments/#pending"><div class="comments-icon">&nbsp'/*.$pending_comments*/.'</div></a>';
                        }
                        echo '</li>';
                        echo '<li><a href="/reps/assignments/#complete">Complete ['.count($complete_jobs).']</a>';
                        if($complete_comments){
                            echo '<a href="/reps/assignments/#complete"><div class="comments-icon">&nbsp'/*.$complete_comments*/.'</div></a>';
                        }
                        echo '</li>';
                        
                    }else{
                        $jobs=accident_get_jobs($_SESSION['agent_user_id']);

                        $open_jobs = array();
                        $pending_jobs = array();
                        $complete_jobs = array();
                        
                        $open_comments = 0;
                        $pending_comments = 0;
                        $complete_comments = 0;

                        foreach($jobs as &$a_job){
                            $comments += count($a_job['comments']);
                            switch(accident_translate_job_state($a_job['ticket_id'])){
                                case 'Open':
                                    $open_comments += accident_get_new_comments($a_job['id']);
                                    $open_jobs[] = $a_job;
                                    //echo accident_get_new_comments($a_job['id']);
                                    break;
                                case 'Pending':
                                    $pending_comments += accident_get_new_comments($a_job['id']);
                                    $pending_jobs[] = $a_job;
                                    //echo accident_get_new_comments($a_job['id']);
                                    break;
                                case 'Complete':
                                    $complete_comments += accident_get_new_comments($a_job['id']);
                                    $complete_jobs[] = $a_job;
                                    //echo accident_get_new_comments($a_job['id']);
                                    break;
                            }
                            
                        }
                        echo '<li><a href="/reps/assignments/#open">Open ['.count($open_jobs).']</a>';
                        if($open_comments){
                            echo '<a href="/reps/assignments/#open"><div class="comments-icon">&nbsp'/*.$open_comments*/.'</div></a>';
                        }
                        echo '</li>';
                        echo '<li><a href="/reps/assignments/#pending">Pending ['.count($pending_jobs).']</a>';
                        if($pending_comments){
                            echo '<a href="/reps/assignments/#pending"><div class="comments-icon">&nbsp'/*.$pending_comments*/.'</div></a>';
                        }
                        echo '</li>';
                        echo '<li><a href="/reps/assignments/#complete">Complete ['.count($complete_jobs).']</a>';
                        if($complete_comments){
                            echo '<a href="/reps/assignments/#complete"><div class="comments-icon">&nbsp'/*.$complete_comments*/.'</div></a>';
                        }
                        echo '</li>';
                    }
                    
                    
                    ?>
                </ul>
            </div>    
    <?
}

class Contact_Widget extends WP_Widget {
    function Contact_Widget(){
        parent::WP_Widget(false,'Contact_Widget');
    }
    
    function form($instance){

        ?>
        <p><em>This widget has no options.</em></p>
        <?
        
    }
    
    function update( $new_instance, $old_instance ) {
        
            $instance = $new_instance;
        
            return $instance;
    }
    
    function widget($args,$instance){
        $args = $instance;
        //print_r($instance);
        accident_contact_content_func($args,'none',true);
    }
}
register_widget('Contact_Widget');

function accident_contact_content_func($the_updates,$float='none',$sidebar=false){
    
        
        ?>
            <div id="infobar">
                <h3>Contact Information</h3>
                <ul>
                    <li class="subheader">Address</li>
                    <li>
                        1898 Fall River Ave<br />
                        Seekonk, MA 02771
                    </li>
                    
                    <li class="subheader">Phone</li>
                    <li>508.336.9393</li>
                    
                    <li class="subheader">Fax</li>
                    <li>508.336.8989</li>
                    
                    <li class="subheader">Email</li>
                    <li><a href="mailto:info@accidentreview.com">info@accidentreview.com</a></li>
                    <li>For all general inquiries</li>
                    <li>&nbsp</li>
                    <li><a href="mailto:press@accidentreview.com">press@accidentreview.com</a></li>
                    <li>For all press inquiries</li>
                    <li>&nbsp</li>
                    <li><a href="mailto:support@accidentreview.com">support@accidentreview.com</a></li>
                    <li>For all site support inquiries</li>
                    
                    
                </ul>
            </div>    
    <?
}

