/**
 * Created by Administrator on 2017/5/23.
 */

/**
 * 分类
 */
$(".categoryId").change(function () {
    var category_id = $(this).val();
    //抛送请求
    var toUrl = SCOPE.category_url;
    var postData = {
        'category_id':category_id,
    };
    $.post(toUrl,postData,
        function (result) {
            //相关的业务处理
            var  str_html = '';
            if (result.status == 1){
                //将信息填充到二级城市列表中
                result.data.forEach(function (e) {
                    str_html += "<input type='checkbox' value='"+e.id+"'/>"
                        +e.name;
                    str_html += "&nbsp;&nbsp;"
                });
            }else {
                layer.msg(result.message,{'time':1500});
            }
            $(".se_category_id").html(str_html);
        },'json');
});

$(".cityId").change(function () {
    var city_id = $(this).val();
    //抛送请求
    var toUrl = SCOPE.city_url;
    var postData = {
        'city_id':city_id,
    };
    $.post(toUrl,postData,
    function (result) {
       //相关的业务处理
        var  str_html = '';
        if (result.status == 1){
            //将信息填充到二级城市列表中
            result.data.forEach(function (e) {
                str_html += "<option value='"+e.id+"'>"+e.name+"</option>";
            });
        }else {
            layer.msg(result.message,{'time':1500});
        }
        $(".se_city_id").html(str_html);
    },'json');
});
/**
 * 列表页进行 排序功能设计
 */
$(".listorder input").blur(function () {
    //编写推送逻辑
    //获取主键id
    var id = $(this).attr('attr-id');
    var listorder = $(this).val();
    var postData = {
        'id':id,
        'listorder':listorder,
    };

    var toUrl = SCOPE.listorder_url;
    //抛送http
    $.post(toUrl,postData,function (result) {
        if (result.status == 1){
            location.href = result.data.referer;
            //layer.msg(result.message);
            //$("td.listorder").val(result.data.listorder);
        }else {
            layer.msg(result.message);
        }
    },"JSON");
});
/*页面 全屏-添加*/
function o2o_f_edit(title,url){
    var index = layer.open({
        type: 2,
        title: title,
        content: url
    });
    layer.full(index);
}

/*添加或者编辑缩小的屏幕*/
function o2o_s_edit(title,url,w,h){
    layer_show(title,url,w,h);
}
function o2o_del(id) {
    o2o_s_status(id,-1,1);
}

function o2o_s_status(id,status,remove) {
    var remove_tag = $(".text-c-"+id);
    var postData = {
        'id':id,
        'status':status,
    };
    var toUrl = SCOPE.status_url;
    layer.open({
        type:0,
        title:false,
        btn:['确定','取消'],
        icon:3,
        closeBtn:2,
        content:"确定要执行此操作吗？",
        scrollbar:true,
        yes:function () {
            //抛送http
            $.post(toUrl,postData,function (result) {
                if (result.status == 1){
                    layer.msg(result.message);
                    if(remove == 1){
                        remove_tag.remove();
                    }else {
                        location.reload();
                    }
                }else {
                    layer.msg(result.message);
                }
            },"JSON");
        },
    });
}
/**
 * 解决H-UI 时间插件冲突方案
 * @param flag
 */
function selecttime(flag){

    if(flag==1){
        var endTime = $("#countTimeend").val();
        if(endTime != ""){
            WdatePicker({dateFmt:'yyyy-MM-dd HH:mm',maxDate:endTime});
        }else{
            WdatePicker({dateFmt:'yyyy-MM-dd HH:mm'});
        }
    }else{
        var startTime = $("#countTimestart").val();
        if(startTime != ""){
            WdatePicker({dateFmt:'yyyy-MM-dd HH:mm',minDate:startTime});
        }else{
            WdatePicker({dateFmt:'yyyy-MM-dd HH:mm'});
        }
    }
}
