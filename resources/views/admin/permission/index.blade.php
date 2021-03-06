@extends('admin/layout/layout')


@section('title','权限列表')

@section('content')

</head>
<body>
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 权限管理 <span class="c-gray en">&gt;</span> 权限列表 <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
<div class="page-container">
    <div class="text-c"> 日期范围：
        <input type="text" onfocus="WdatePicker({ maxDate:'#F{$dp.$D(\'datemax\')||\'%y-%M-%d\'}' })" id="datemin" class="input-text Wdate" style="width:120px;">
        -
        <input type="text" onfocus="WdatePicker({ minDate:'#F{$dp.$D(\'datemin\')}',maxDate:'%y-%M-%d' })" id="datemax" class="input-text Wdate" style="width:120px;">
        <input type="text" class="input-text" style="width:250px" placeholder="输入权限名称" id="" name="">
        <button type="submit" class="btn btn-success" id="" name=""><i class="Hui-iconfont">&#xe665;</i> 搜用户</button>
    </div>
    <div class="cl pd-5 bg-1 bk-gray mt-20"> <span class="l"><a href="javascript:;" onclick="datadel()" class="btn btn-danger radius"><i class="Hui-iconfont">&#xe6e2;</i> 批量删除</a>

			<a href="javascript:;" onclick="admin_add('添加权限','/admin/permission/tianjia','800','500')" class="btn btn-primary radius"><i class="Hui-iconfont">&#xe600;</i> 添加权限</a>


		</span> <span class="r">共有数据：<strong>54</strong> 条</span> </div>
    <table class="table table-border table-bordered table-bg">
        <thead>
        <tr class="text-c">
            <th width="6%"><input type="checkbox" name="" value=""></th>
            <th width="6%">ID</th>
            <th width="9%">权限名称</th>
            <th width="8%">上级</th>
            <th width="10%">控制器</th>
            <th width="8%">操作方法</th>
            <th width="15%">路由</th>
            <th width="6%">等级</th>
            <th width="9%">创建时间</th>
            <th width="*">操作</th>
        </tr>
        </thead>
        <tbody>
        @foreach($info as $v)
            <tr class="text-c">
                <td><input type="checkbox" value="1" name=""></td>
                <td>{{$v['ps_id']}}</td>
                <td style="text-align:left">{{str_repeat('&nbsp;&nbsp;&nbsp;&nbsp;',$v['ps_level'])}}{{$v['ps_name']}}</td>
                <td>{{$v['ps_pid']}}</td>
                <td>{{$v['ps_c']}}</td>
                <td>{{$v['ps_a']}}</td>
                <td>{{$v['address']}}</td>
                <td>{{$v['ps_level']}}</td>
                <td>{{$v['created_at']}}</td>
                <td class="td-manage"><a title="编辑" href="javascript:;" onclick="admin_edit('权限编辑','/admin/role/xiugai/<?php echo $v['ps_id']; ?>','1','800','500')" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe6df;</i></a> <a title="删除" href="javascript:;" onclick="admin_del(this,'<?php echo $v['ps_id']; ?>')" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe6e2;</i></a></td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <link rel="stylesheet" type="text/css" href="/css/pagination.css" />

</div>
<!--_footer 作为公共模版分离出去-->
<script type="text/javascript" src="/admin/lib/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript" src="/admin/lib/layer/2.4/layer.js"></script>
<script type="text/javascript" src="/admin/static/h-ui/js/H-ui.min.js"></script>
<script type="text/javascript" src="/admin/static/h-ui.admin/js/H-ui.admin.js"></script> <!--/_footer 作为公共模版分离出去-->

<!--请在下方写此页面业务相关的脚本-->
<script type="text/javascript" src="/admin/lib/My97DatePicker/4.8/WdatePicker.js"></script>
<script type="text/javascript" src="/admin/lib/datatables/1.10.0/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="/admin/lib/laypage/1.2/laypage.js"></script>
<script type="text/javascript">
    /*
     参数解释：
     title	标题
     url		请求的url
     id		需要操作的数据id
     w		弹出层宽度（缺省调默认值）
     h		弹出层高度（缺省调默认值）
     */
    /*权限-获取推流地址*/
    function get_push(title,url,w,h){
        layer_show(title,url,w,h);
    }

    /*权限-增加*/
    function admin_add(title,url,w,h){
        layer_show(title,url,w,h);
    }
    /*权限-删除*/
    function admin_del(obj,id){
        layer.confirm('确认要删除吗？',function(index){
            $.ajax({
                type: 'POST',
                url: '/admin/livecourse/del/'+id,
                headers: {
                    'X-CSRF-TOKEN':"<?php echo csrf_token(); ?>"
                },
                dataType: 'json',
                success: function(data){
                    if(data.success===true){
                        $(obj).parents("tr").remove();
                        layer.msg('已删除!',{icon:1,time:1000});
                    }else{
                        layer.msg('删除有问题!',{icon:1,time:1000});
                    }
                },
                error:function(data) {
                    console.log(data.msg);
                },
            });
        });
    }

    /*权限-编辑*/
    function admin_edit(title,url,id,w,h){
        layer_show(title,url,w,h);
    }
    /*权限-停用*/
    function admin_stop(obj,id){
        layer.confirm('确认要停用吗？',function(index){
            //此处请求后台程序，下方是成功后的前台处理……

            $(obj).parents("tr").find(".td-manage").prepend('<a onClick="admin_start(this,id)" href="javascript:;" title="启用" style="text-decoration:none"><i class="Hui-iconfont">&#xe615;</i></a>');
            $(obj).parents("tr").find(".td-status").html('<span class="label label-default radius">已禁用</span>');
            $(obj).remove();
            layer.msg('已停用!',{icon: 5,time:1000});
        });
    }

    /*权限-启用*/
    function admin_start(obj,id){
        layer.confirm('确认要启用吗？',function(index){
            //此处请求后台程序，下方是成功后的前台处理……


            $(obj).parents("tr").find(".td-manage").prepend('<a onClick="admin_stop(this,id)" href="javascript:;" title="停用" style="text-decoration:none"><i class="Hui-iconfont">&#xe631;</i></a>');
            $(obj).parents("tr").find(".td-status").html('<span class="label label-success radius">已启用</span>');
            $(obj).remove();
            layer.msg('已启用!', {icon: 6,time:1000});
        });
    }
</script>

@endsection