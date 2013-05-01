//Javascript!


(function($,undefined){
    
   $(document).ready(function() {
        //plupload functions:


        var uploader = new plupload.Uploader({
                runtimes : 'gears,html5,flash,silverlight',
                browse_button : 'pickfiles',
                container : 'container',
                max_file_size : '100mb',
                url : '/wp-content/themes/accident-review/custom/file-upload.php',
                flash_swf_url : '/wp-content/themes/accident-review/lib/plupload/plupload.flash.swf',
                silverlight_xap_url : '/wp-content/themes/accident-review/lib/plupload/plupload.silverlight.xap',
                filters : [
                    {title : "Image files", extensions : "jpg,gif,png,bmp,tga,tif"},
                    {title : "Documents", extensions : "txt,doc,docx,odt,rtf,pdf"}
                    ],
                multipart: false,                
                drop_element: 'droptarget'
                        
        });

        uploader.bind('Init', function(up, params) {
                //$('#filelist').html("<div>Current runtime: " + params.runtime + "</div>");
                if(params.runtime != 'html5'){
                        $('#droptarget').hide();
                }
        });


        uploader.init();

        uploader.bind('FilesAdded', function(up, files) {
            $('#filesdiv').show("fast");
                $.each(files, function(i, file) {
                        $('#filetable').append(
                        '<tr class="{attid:new}">' +
                    '<td><input type="hidden" name="uploaded_files['+file.id+'][name]" value="'+file.name+'" />' + file.name + '</td>' +
                    '<td><input type="hidden" name="uploaded_files['+file.id+'][size]" value="'+file.size+'" />' + plupload.formatSize(file.size) + '</td>' +
                    '<td id="' + file.id + '"><input type="hidden" name="uploaded_files['+file.id+'][id]" value="'+file.id+'" /> Uploaded <b></b> </td>' +
                    '</td></tr>');
                });

                up.refresh(); // Reposition Flash/Silverlight
                setTimeout(function(){
                        up.start();    
                },100);
        });

        uploader.bind('UploadComplete',function(up, file){

        });

        uploader.bind('UploadProgress', function(up, file) {
                $('#' + file.id + " b").html(file.percent + "%");
        });

        uploader.bind('Error', function(up, err) {
                $('#filelist').append("<div>Error: " + err.code +
                ". Message: " + err.message +
                (err.file ? " File: " + err.file.name : "") +
                "</div>"
                );

                up.refresh(); // Reposition Flash/Silverlight
        });

        uploader.bind('FileUploaded', function(up, file) {
                $('#' + file.id + " b").html("100%");
        });

        $('#clearfiles').bind('click',function(event){
                event.preventDefault();
                $('#filelist > div').fadeOut();
        })
    })

})(jQuery);


