/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

jQuery(document).ready(function(){
    
    jQuery('.buttongroup').buttonset();
  

    var formfield=false;
    var append=false;
    jQuery('.wp-upload-button').click(function() {
            if(jQuery(this).siblings('input[type="text"]').length){
                    formfield = jQuery(this).siblings('input[type="text"]').attr('id');
                    append = false; 
            } else {
                    if(jQuery(this).siblings('textarea').length){
                            formfield = jQuery(this).siblings('textarea').attr('name');
                            append = true;
                    } else {
                            append = false;
                            return false;
                    }
            }
            jQuery('html').addClass('image'+formfield);
            tb_show('', 'media-upload.php?type=image&TB_iframe=true&width=620&height=750');
            console.log('Name: '+formfield);
            return false;
    });

    function original_send_to_editor(b){var a;if(typeof tinyMCE!="undefined"&&(a=tinyMCE.activeEditor)&&!a.isHidden()){a.focus();if(tinymce.isIE){a.selection.moveToBookmark(tinymce.EditorManager.activeEditor.windowManager.bookmark)}if(b.indexOf("[caption")===0){if(a.plugins.wpeditimage){b=a.plugins.wpeditimage._do_shcode(b)}}else{if(b.indexOf("[gallery")===0){if(a.plugins.wpgallery){b=a.plugins.wpgallery._do_gallery(b)}}else{if(b.indexOf("[embed")===0){if(a.plugins.wordpress){b=a.plugins.wordpress._setEmbed(b)}}}}a.execCommand("mceInsertContent",false,b)}else{if(typeof edInsertContent=="function"){edInsertContent(edCanvas,b)}else{jQuery(edCanvas).val(jQuery(edCanvas).val()+b)}}tb_remove()}var tb_position;(function(a){tb_position=function(){var f=a("#TB_window"),e=a(window).width(),d=a(window).height(),c=(720<e)?720:e,b=0;if(a("body.admin-bar").length){b=28}if(f.size()){f.width(c-50).height(d-45-b);a("#TB_iframeContent").width(c-50).height(d-75-b);f.css({"margin-left":"-"+parseInt(((c-50)/2),10)+"px"});if(typeof document.body.style.maxWidth!="undefined"){f.css({top:20+b+"px","margin-top":"0"})}}return a("a.thickbox").each(function(){var g=a(this).attr("href");if(!g){return}g=g.replace(/&width=[0-9]+/g,"");g=g.replace(/&height=[0-9]+/g,"");a(this).attr("href",g+"&width="+(c-80)+"&height="+(d-85-b))})};a(window).resize(function(){tb_position()})})(jQuery);jQuery(document).ready(function(a){a("a.thickbox").click(function(){if(typeof tinyMCE!="undefined"&&tinyMCE.activeEditor){tinyMCE.get("content").focus();tinyMCE.activeEditor.windowManager.bookmark=tinyMCE.activeEditor.selection.getBookmark("simple")}})});
    
    window.send_to_editor = function(html){
            if (formfield) {
                    fileurl = jQuery('img',html).attr('src');
                    value_out = '';
                    if(append){
                            cur_val = jQuery('textarea[name="'+formfield+'"]').val();
                            if(cur_val.length) new_val = cur_val+"\n"+fileurl;
                            else new_val = fileurl;
                            jQuery('textarea[name="'+formfield+'"]').val(new_val);
                            jQuery('textarea[name="'+formfield+'"]').trigger('change');
                    } else {
                            jQuery('input[id="'+formfield+'"]').val(fileurl);
                            jQuery('textarea[name="'+formfield+'"]').trigger('change');

                    }


                    tb_remove();
                    jQuery('html').removeClass('image'+formfield);
                    formfield = false;
                    append = false;
            } else {
                    original_send_to_editor(html);
            }
    };
});

(function($,undefined){
    $(function(){
       
    });
})(jQuery);