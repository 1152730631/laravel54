@extends('admin/layout/layout')

@section('title','课时列表')

@section('content')
</head>
<body>
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 用户中心 <span class="c-gray en">&gt;</span> 用户管理 <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
<div class="page-container">
    <div class="text-c"> 日期范围：
        <input type="text" onfocus="WdatePicker({ maxDate:'#F{$dp.$D(\'datemax\')||\'%y-%M-%d\'}' })" id="datemin" class="input-text Wdate" style="width:120px;">
        -
        <input type="text" onfocus="WdatePicker({ minDate:'#F{$dp.$D(\'datemin\')}',maxDate:'%y-%M-%d' })" id="datemax" class="input-text Wdate" style="width:120px;">
        <input type="text" class="input-text" style="width:250px" placeholder="输入会员名称、电话、邮箱" id="" name="">
        <button type="submit" class="btn btn-success radius" id="" name=""><i class="Hui-iconfont">&#xe665;</i> 搜用户</button>
    </div>
    <div class="cl pd-5 bg-1 bk-gray mt-20"> <span class="l"><a href="javascript:;" onclick="datadel()" class="btn btn-danger radius"><i class="Hui-iconfont">&#xe6e2;</i> 批量删除</a> <a href="javascript:;" onclick="member_add('添加用户','member-add.html','','510')" class="btn btn-primary radius"><i class="Hui-iconfont">&#xe600;</i> 添加用户</a></span> <span class="r">共有数据：<strong>88</strong> 条</span> </div>
    <div class="mt-20">
        <table class="table table-border table-bordered table-hover table-bg table-sort">
            <thead>
            <tr class="text-c">
                <th width="6%"><input type="checkbox" name="" value=""></th>
                <th width="6%">ID</th>
                <th width="14%">课时名称</th>
                <th width="14%">对应课程</th>
                <th width="15%">图片</th>
                <th width="7%">视频</th>
                <th width="12%">授课老师</th>
                <th width="13%">创建时间</th>
                <th width="*">操作</th>
            </tr>
            </thead>
        </table>
    </div>
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
    $(function(){
        $('.table-sort').dataTable({
            "order": [[ 1, "desc" ]],
            "stateSave": false,//状态保存
            "columnDefs": [
                {"targets": [0,8],"orderable": false}// 制定列不参与排序
            ],

            "lengthMenu": [ 4,8,16,32 ],
            "paging": true,
            "info":     true,
            "searching": true,
            "ordering": true,
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": "{{ url('lesson/index') }}",
                "type": "POST",
                'headers': {
                    'X-CSRF-TOKEN' : '{{ csrf_token() }}'
                },
            },

            //给各个"td"填充内容
            "columns": [
                {'data':'a',"defaultContent": "<input type='checkbox'>"},
                {'data':'lesson_id'},
                {'data':'lesson_name'},
                {'data':'course_id'},
                {'data':'cover_img'},
                {'data':'video_address'},
                {'data':'teacher_ids'},
                {'data':'created_at'},
                {'data':'b',"defaultContent": "",'className':'td-manager'},
            ],
            "createdRow":function(row,data,dataIndex){
                //该方法会"遍历"每个新生成的tr
                //此处，可以对生成好的tr、td进行二次优化，改造
                //row:就是生成的tr的dom对象，设置为$(row)就变为jquery对象
                //data:服务器端传递回来的每条 数据记录
                //dataIndex:是tr的下标索引号码

                //① 给最后td设置功能按钮
                var anniu = '<a style="text-decoration:none" onClick="member_stop(this,10001)" href="javascript:;" title="停用"><i class="Hui-iconfont">&#xe631;</i></a><a title="编辑" href="javascript:;" onclick="member_edit(\'编辑\',\'member-add.html\',4,\'\',510)" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe6df;</i></a><a title="删除" href="javascript:;" onclick="member_del(this,1)" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe6e2;</i></a>';
                $(row).find('td:eq(8)').html(anniu);

                //② 给tr设置class属性
                $(row).addClass('text-c');
            },
        });

    });
    /*用户-添加*/
    function member_add(title,url,w,h){
        layer_show(title,url,w,h);
    }
    /*用户-查看*/
    function member_show(title,url,id,w,h){
        layer_show(title,url,w,h);
    }
    /*用户-停用*/
    function member_stop(obj,id){
        layer.confirm('确认要停用吗？',function(index){
            $.ajax({
                type: 'POST',
                url: '',
                dataType: 'json',
                success: function(data){
                    $(obj).parents("tr").find(".td-manage").prepend('<a style="text-decoration:none" onClick="member_start(this,id)" href="javascript:;" title="启用"><i class="Hui-iconfont">&#xe6e1;</i></a>');
                    $(obj).parents("tr").find(".td-status").html('<span class="label label-defaunt radius">已停用</span>');
                    $(obj).remove();
                    layer.msg('已停用!',{icon: 5,time:1000});
                },
                error:function(data) {
                    console.log(data.msg);
                },
            });
        });
    }

    /*用户-启用*/
    function member_start(obj,id){
        layer.confirm('确认要启用吗？',function(index){
            $.ajax({
                type: 'POST',
                url: '',
                dataType: 'json',
                success: function(data){
                    $(obj).parents("tr").find(".td-manage").prepend('<a style="text-decoration:none" onClick="member_stop(this,id)" href="javascript:;" title="停用"><i class="Hui-iconfont">&#xe631;</i></a>');
                    $(obj).parents("tr").find(".td-status").html('<span class="label label-success radius">已启用</span>');
                    $(obj).remove();
                    layer.msg('已启用!',{icon: 6,time:1000});
                },
                error:function(data) {
                    console.log(data.msg);
                },
            });
        });
    }
    /*用户-编辑*/
    function member_edit(title,url,id,w,h){
        layer_show(title,url,w,h);
    }
    /*密码-修改*/
    function change_password(title,url,id,w,h){
        layer_show(title,url,w,h);
    }
    /*用户-删除*/
    function member_del(obj,id){
        layer.confirm('确认要删除吗？',function(index){
            $.ajax({
                type: 'POST',
                url: '',
                dataType: 'json',
                success: function(data){
                    $(obj).parents("tr").remove();
                    layer.msg('已删除!',{icon:1,time:1000});
                },
                error:function(data) {
                    console.log(data.msg);
                },
            });
        });
    }
</script>
@endsection
