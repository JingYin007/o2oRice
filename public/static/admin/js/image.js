/**
 * Created by 百鬼夜行 on 2017/6/6.
 */
$(function() {
    $("#file_upload").uploadify({
        'fileTypeDesc'    : 'Image Files',
        'fileObjName'     : 'file',
        'fileTypeExts'    : '*.gif; *.jpg; *.png; *.jpeg',
        'swf'             : SCOPE.uploadify_swf,
        'uploader'        : SCOPE.image_upload,
        'buttonText'      : '图片上传',
        'onUploadSuccess' : function(file, data, response) {
            //alert('The file ' + file.name + ' was successfully uploaded with a response of ' + response + ':' + data);
            if(response){
                var obj = JSON.parse(data);
                $("#upload_org_code_img").attr('src',obj.data);
                $("#file_upload_image").attr('value',obj.data);
                $("#upload_org_code_img").show();
            }
        }
    });
    $("#file_upload_other").uploadify({
        'fileTypeDesc'    : 'Image Files',
        'fileObjName'     : 'file',
        'fileTypeExts'    : '*.gif; *.jpg; *.png; *.jpeg',
        'swf'             : SCOPE.uploadify_swf,
        'uploader'        : SCOPE.image_upload,
        'buttonText'      : '图片上传',
        'onUploadSuccess' : function(file, data, response) {
            //alert('The file ' + file.name + ' was successfully uploaded with a response of ' + response + ':' + data);
            if(response){
                var obj = JSON.parse(data);
                $("#upload_org_code_img_other").attr('src',obj.data);
                $("#file_upload_image_other").attr('value',obj.data);
                $("#upload_org_code_img_other").show();
            }
        }
    });
});
