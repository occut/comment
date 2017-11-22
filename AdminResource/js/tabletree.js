
layui.define(["jquery","layer"],function(el) {
    var o = layui.jquery,layer = layui.layer,
        d = {
            column: 1,
            retract: 16,
            icon: ["&#xe623;", "&#xe625;"],
            iconClass: "layui-icon",
            icD: ".layui-icon",
            topId: 0,
        },
        i = function(e) {
            this.options = e;
        };
    i.prototype.init = function(e,url,action){
     //   var p = this;
        e.find("tbody tr").each(function(i,c){
            var t 	= o(c),
                pid = t.data("tb-pid"),
                id  = t.data('tb-id');
                ico = t.find('.treename '+d.icD),
                // ic 	= e.find("tbody tr[data-tb-pid='"+t.data("tb-id")+"']").length,
                // icH = '<i class="'+d.iconClass+'">'+(ic ? d.icon[0] : '')+'</i>',
                icH = '<i class="'+d.iconClass+'">'+d.icon[0]+'</i>';
                px 	= e.find("tbody tr[data-tb-id='"+pid+"']").find(d.icD).css("margin-left");
            // pid == d.topId || t.hide();
            if (ico.length == 0 && t.find("[data-tb-pid='"+id+"']").length == 0){
                t.find("td").eq(d.column).prepend(icH);
                t.find("td").eq(d.column).css('cursor','pointer');
                t.find(d.icD).eq(0).css("margin-left",(parseInt(px)+d.retract)+'px');
            }

        });
        if (action === undefined) {
            this.on(e, url);
        }
    },
        i.prototype.packup = function(e,pid){
            var t = this;
            e.find("tbody tr[data-tb-pid='"+pid+"']").each(function(){
                o(this).css('display','none');
                o(this).find('.treename '+d.icD).removeClass("sopen").html(o(this).find(d.icD).html()?d.icon[0]:'');
                t.packup(e,o(this).data("tb-id"));
            });
        },
        i.prototype.on = function(e,url){
            var t = this;
            var el = o(e.selector);//重新获取元素
            el.find("tbody").on("click","tr td.treename",function(){
                var ico = o(this).find(d.icD),
                    tr  = o(this).parent('tr'),
                    id 	= tr.data("tb-id");
                       if (ico.hasClass('sopen')){ //不展开
                           ico.html(ico.html()?d.icon[0]:'');
                           t.packup(el,id);
                           ico.removeClass('sopen');
                       }else{ //展开
                           // //有数据 就不在post 获取了
                           if(el.find("tbody tr[data-tb-pid='"+id+"']").length > 0){
                               el.find("tbody tr[data-tb-pid='"+id+"']").show();
                           }else{
                               //没数据 post获取
                               var html = post(url,'catId='+id,'html');
                               if(html.length > 0){
                                   tr.after(html);
                                   t.init(el,url,false);
                               }else{
                                 var lg =  tr.find('td').length;
                                   tr.after('<tr data-tb-pid="'+id+'"><td align="center"  colspan="'+lg+'"><span style="color: red;">底边没有啦...</span></td></tr>');
                               }

                           }
                           ico.html(ico.html()?d.icon[1]:'');
                           ico.addClass('sopen');
                       }
            });
        };

     el("tabletree", function(e){
        var r   = new i(e = e || {}),
            t   = o(e.elem),
            url = e.url;
        return t[0] ? void r.init(t,url) : layer.alert("没有找到" + e.elem + "元素")
    });
});