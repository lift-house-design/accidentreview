<?php

?>
<div class="custom-post-type-meta">
    <div style="float:left;">
        <label>Public Bio</label>
        <div class="buttongroup">
            <label for="_technician_bio_public_yes">Yes</label>
            <input type="radio" name="_technician_bio_public" id="_technician_bio_public_yes" value="1" <?php echo (($post_meta['_technician_bio_public'] == '1')?'checked="checked"':''); ?> />
            <label for="_technician_bio_public_no">No</label>
            <input type="radio" name="_technician_bio_public" id="_technician_bio_public_no" value="0" <?php echo (($post_meta['_technician_bio_public'] == '0')?'checked="checked"':''); ?> />
        </div>
    </div>
    <br class="clear" />
</div>