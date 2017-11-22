layui.use(['laydate','element','laypage','layer','form'], function(){
    $ = layui.jquery;//jquery
    laydate = layui.laydate;//日期插件
    lement = layui.element();//面包导航
    laypage = layui.laypage;//分页
    layer = layui.layer;//弹出层
    form = layui.form();

    $(document).ready(function () {
        var num = 1;
        var checkbox = $("input[type='checkbox'][name='delAll']");
        $('#dellAll').on('click',function () {
            if (num%2){
                $.each(checkbox, function(i, n){
                    checkbox[i].checked = true;
                });
            }else{
                $.each(checkbox, function(i, n){
                    checkbox[i].checked = false;
                });
            }
            num++;
        });
        $('.selectRule').on('click',function () {
            var classname = $(this).children(".layui-form-checkbox")[0].className;
            var classArr = classname.split(' ');
            var checkbox = $(this).next('td').find("input[type='checkbox']");
            if($.inArray('layui-form-checked',classArr) >= 0){
                $.each(checkbox,function (i,n) {
                    checkbox[i].checked = true;
                });
                $(this).next('td').find(".layui-form-checkbox").addClass('layui-form-checked');
            }else{
                $.each(checkbox,function (i,n) {
                    checkbox[i].checked = false;
                });
                $(this).next('td').find(".layui-form-checkbox").removeClass('layui-form-checked');
            }
        });

    });
    //触发表单
    // form.on('submit(save)',function(data) {
    //     var action = $('.layui-form').attr('action');
    //     data = jsw_post(action,$('.layui-form').serialize());
    //     if(data.error){
    //         layer.alert(data.info,{ icon: 1,skin: 'layer-ext-moon' },function(){
    //             location.href=data.href;
    //         });
    //     }else{
    //         layer.alert(data.info,{icon:2, skin:'layer-ext-moon' });
    //     }
    //     return false;
    // });

});
    /*
    *   action url
    *   formdata 表单数据
    *   dataType 返回数据类型
    *
     */
    // function jsw_post(action,formdata,dataType='json',async=false) {
    //     var result = '';
    //     $.ajax({
    //         type: "POST",
    //         url: action,
    //         data: formdata,
    //         cache:false,
    //         async:async,
    //         dataType:dataType,
    //         success: function(data){
    //             result = data;
    //         }
    //     });
    //     return result;
    // }
    /** parame action string
     * parame formData object string
     * parame dataType json,txt,xml...
     * parame async boolean*/
    function post(action, formData,dataType) {
        var result = '';
        if(dataType === undefined){
            dataType = 'json';
        }
        layui.use(['jquery'], function() {
            $ = layui.jquery;//jquery
             $.ajax({
                type: 'post',
                url: action,
                data: formData, //'id=1&aid=2' {id:1,aid:2}
                cache: false,
                async: false,
                dataType: dataType,
                success: function (data) {
                    //    layer.close(index);
                    result = data;
                },
                error: function () {
                    result['error'] = true;
                    result['info'] = '请求异常！';
                }
            });
        });
        return result;
    }

    //批量删除提交
    function delAll (action,title) {
        if(title === undefined){
            title = '确认要删除吗？';
        }
        layer.confirm(title,function(index){
            var checkbox = $("input[type='checkbox'][name='delAll']");
            var str = [];
            $.each(checkbox, function(i, n){
                if(checkbox[i].checked == true){
                    str[i] = {name:'ids[]',value:checkbox[i].value};
                }
            });
            //str.join() 分割成 字符串
          var result =  post(action,str);
           console.log(result == 1);
            if (result == 1){
                // console.log(result.msg);
                // alert(123);
                layer.msg("成功",{icon: 1,time:1000},function(){
                    window.location.reload();
                });
            }else{
                layer.msg("失败",{icon: 5,time:1000});
            }
        });
    }
    /*添加*/
    function add(title,url,w,h){
        x_admin_show(title,url,w,h);
    }
    /*停用*/
    function stop(obj,id,action){
        layer.confirm('确认禁用吗？',function(index){
            var data = 'status=stop&id='+id;
            var result = jsw_post(action,data);
            if (result.error){
                //发异步把用户状态进行更改
                $(obj).parents("tr").find(".td-manage").prepend('<a style="text-decoration:none" onClick="banner_start(this,'+id+',\''+action+'\')" href="javascript:;" title="启用"><i class="layui-icon">&#xe62f;</i></a>');
                $(obj).parents("tr").find(".td-status").html('<span class="layui-btn layui-btn-disabled layui-btn-mini">禁用</span>');
                $(obj).remove();
                layer.msg('已禁用!',{icon: 5,time:1000});
            }else{
                layer.msg(result.info,{icon: 5,time:1000});
            }

        });
    }

    /*启用*/
    function start(obj,id,action){
        var data = 'status=start&id='+id;
        var result = jsw_post(action,data);
        if (result.error){
            layer.confirm('确认启用吗？',function(index){
                //发异步把用户状态进行更改
                $(obj).parents("tr").find(".td-manage").prepend('<a style="text-decoration:none" onClick="banner_stop(this,'+id+',\''+action+'\')" href="javascript:;" title="禁用"><i class="layui-icon">&#xe601;</i></a>');
                $(obj).parents("tr").find(".td-status").html('<span class="layui-btn layui-btn-normal layui-btn-mini">正常</span>');
                $(obj).remove();
                layer.msg('已正常!',{icon: 6,time:1000});
            });
        }else{
            layer.msg(result.info,{icon: 5,time:1000});
        }

    }


    // 编辑
    function edit (title,url,w,h) {
        x_admin_show(title,url,w,h);
    }
    /*删除*/
    function del(obj,id,action,title){
        if(title === undefined){
            title = '确认要删除吗？';
        }
        layer.confirm(title,function(index){
            var data = 'id='+id;
            var result = post(action,data);
            if (result.error){
                $(obj).parents("tr").remove();
                layer.msg(result.msg,{icon:1,time:1000});
            }else{
                layer.msg(result.msg,{icon:2,time:1000});
            }
            //发异步删除数据

        });
    }
function del(obj,id,action,title){
    if(title === undefined){
        title = '确认要删除吗？';
    }
    layer.confirm(title,function(index){
        var data = 'id='+id;
        var result = post(action,data);
        if (result.error){
            $(obj).parents("tr").remove();
            layer.msg(result.msg,{icon:1,time:1000});
        }else{
            layer.msg(result.msg,{icon:2,time:1000});
        }
        //发异步删除数据

    });
}
function delll(obj,id,action,title){
    if(title === undefined){
        title = '确认要删除吗？';
    }
    layer.confirm(title,function(index){
        var data = 'id='+id;
        var result = post(action,data);
        if (result == 1){
            $(obj).parents("tr").remove();
            layer.msg("成功",{icon:1,time:1000});
            location.reload();
        }else{
            layer.msg(失败,{icon:2,time:1000});
        }
        //发异步删除数据

    });
}


/*弹出层*/
/*
 参数解释：
 title	标题
 url		请求的url
 id		需要操作的数据id
 w		弹出层宽度（缺省调默认值）
 h		弹出层高度（缺省调默认值）
 */
    function x_admin_show(title,url,w,h){
        if (title == null || title == '') {
            title=false;
        };
        if (url == null || url == '') {
            url="404.html";
        };
        if (w == null || w == '') {
            w=800+'px';
        };
        if (h == null || h == '') {
            h=($(window).height() - 50)+'px';
        };
        layer.open({
            type: 2,
            area: [w, h],
            fix: false, //不固定
            maxmin: true,
            shadeClose: true,
            shade:0.4,
            title: title,
            content: url
        });
    }

    /*关闭弹出框口*/
    function x_admin_close(){
        var index = parent.layer.getFrameIndex(window.name);
        parent.layer.close(index);
    }




