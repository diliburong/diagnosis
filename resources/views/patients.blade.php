
@extends('layouts.master')

@section('title','后台管理')

@section('content')

<section class="Hui-article-box">
    <nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 用户中心 <span class="c-gray en">&gt;</span> 会员列表<a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
    <div class="Hui-article">
        <article class="cl pd-20">
            <div class="text-c"> 日期范围：
                <input type="text" onfocus="WdatePicker({maxDate:'#F{$dp.$D(\'datemax\')||\'%y-%M-%d\'}'})" id="datemin" class="input-text Wdate" style="width:120px;">
                -
                <input type="text" onfocus="WdatePicker({minDate:'#F{$dp.$D(\'datemin\')}',maxDate:'%y-%M-%d'})" id="datemax" class="input-text Wdate" style="width:120px;">
                <input type="text" class="input-text" style="width:250px" placeholder="输入会员名称、电话、邮箱" id="" name="">
                <button type="submit" class="btn btn-success radius" id="" name=""><i class="Hui-iconfont">&#xe665;</i> 搜用户</button>
            </div>
            <div class="cl pd-5 bg-1 bk-gray mt-20"> <span class="l">
                <a href="javascript:;" onclick="datadel()" class="btn btn-danger radius"><i class="Hui-iconfont">&#xe6e2;</i> 批量删除</a> 
                <a href="javascript:;" onclick="patient_add('添加用户','patient_add','','510')" class="btn btn-primary radius"><i class="Hui-iconfont">&#xe600;</i> 添加用户</a></span> 
            </div>
            <div class="mt-20">
                <table class="table table-border table-bordered table-hover table-bg table-sort">
                    <thead>
                        <tr class="text-c">
                            <th width="25"><input type="checkbox" name="" value=""></th>
                            <th width="50">ID</th>
                            <th width="80">姓名</th>
                            <th width="40">性别</th>
                            <th width="150">电话</th>
                            <!-- <th width="90">角色</th> -->
                            <!-- <th width="">地址</th> -->
                            <th width="100">加入时间</th>
                            <th width="70">状态</th>
                            <th width="100">操作</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($patients as $patient)
                        <tr class="text-c">
                            <td><input type="checkbox" value="{{$patient->id}}" name=""></td>
                            <td>{{$patient->id}}</td>
                            <td><a href="{{url('diagnoes')}}/{{$patient->id}}">{{$patient->name}}</a></td>
                            <!-- <td><u style="cursor:pointer" class="text-primary" onclick="patient_show('{{$patient->name}}','patient-show.html','10001','360','400')">{{$patient->name}}</u></td> -->
                            <td>
                                @if($patient->sex ==1)
                                男
                                @else
                                女
                                @endif
                            </td>
                            <td>{{$patient->phone}}</td>
                            <td>{{$patient->created_at}}</td>
                            <td class="td-status">
                                @if($patient->status == 1)
                                <span class="label label-success radius">已诊断</span>
                                @else
                                <span class="label label-danger radius">待诊断</span>
                                @endif
                            </td>
                            <td class="td-manage">
                                <!-- <a style="text-decoration:none" onClick="patient_stop(this,'10001')" href="javascript:;" title="停用"><i class="Hui-iconfont">&#xe631;</i></a>  -->
                                <a title="编辑" href="javascript:;" onclick="patient_edit('编辑','patient_edit/{{$patient->id}}','','','510')" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe6df;</i></a>
                                <!-- <a style="text-decoration:none" class="ml-5" onClick="change_password('修改密码','change-password.html','10001','600','270')" href="javascript:;" title="修改密码"><i class="Hui-iconfont">&#xe63f;</i></a> -->
                                <a title="删除" href="javascript:;" onclick="patient_del(this,'{{$patient->id}}')" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe6e2;</i></a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $patients->links('vendor.pagination.default') }}
            </div>
        </article>
    </div>
</section>


@endsection

@section('my-js')

<script>
// $(function(){
// 	$('.table-sort').dataTable({
// 		"aaSorting": [[ 1, "desc" ]],//默认第几个排序
// 		"bStateSave": true,//状态保存
// 		"aoColumnDefs": [
// 		  //{"bVisible": false, "aTargets": [ 3 ]} //控制列的隐藏显示
// 		  {"orderable":false,"aTargets":[0,8,9]}// 制定列不参与排序
// 		]
// 	});
// 	$('.table-sort tbody').on( 'click', 'tr', function () {
// 		if ( $(this).hasClass('selected') ) {
// 			$(this).removeClass('selected');
// 		}
// 		else {
// 			table.$('tr.selected').removeClass('selected');
// 			$(this).addClass('selected');
// 		}
// 	});
// });
/*用户-添加*/
function patient_add(title,url,w,h){
	layer_show(title,url,w,h);
}
/*用户-查看*/
// function patient_show(title,url,id,w,h){
// 	layer_show(title,url,w,h);
// }
/*用户-停用*/
// function patient_stop(obj,id){
// 	layer.confirm('确认要停用吗？',function(index){
// 		$(obj).parents("tr").find(".td-manage").prepend('<a style="text-decoration:none" onClick="patient_start(this,id)" href="javascript:;" title="启用"><i class="Hui-iconfont">&#xe6e1;</i></a>');
// 		$(obj).parents("tr").find(".td-status").html('<span class="label label-defaunt radius">已停用</span>');
// 		$(obj).remove();
// 		layer.msg('已停用!',{icon: 5,time:1000});
// 	});
// }

/*用户-启用*/
// function patient_start(obj,id){
// 	layer.confirm('确认要启用吗？',function(index){
// 		$(obj).parents("tr").find(".td-manage").prepend('<a style="text-decoration:none" onClick="patient_stop(this,id)" href="javascript:;" title="停用"><i class="Hui-iconfont">&#xe631;</i></a>');
// 		$(obj).parents("tr").find(".td-status").html('<span class="label label-success radius">已启用</span>');
// 		$(obj).remove();
// 		layer.msg('已启用!',{icon: 6,time:1000});
// 	});
// }
/*用户-编辑*/
function patient_edit(title,url,id,w,h){
	layer_show(title,url,w,h);
}
// /*密码-修改*/
// function change_password(title,url,id,w,h){
// 	layer_show(title,url,w,h);	
// }
/*用户-删除*/
function patient_del(obj,id){
	layer.confirm('确认要删除吗？',function(index){
		// $(obj).parents("tr").remove();
        $.ajax({
            type:'post',
            url:'service/patient/del',
            dataType:'json',
            data:{
				id:id,
				_token:"{{csrf_token()}}" 
			},
            success:function(data){
                layer.closeAll('loading');
                if (data == null) {
                    layer.msg('服务端错误', {icon:2, time:2000});
                    return;
                }
                if (data.status != 0) {
                    layer.msg(data.message, {icon:2, time:2000});
                    return;				
                }
                layer.msg(data.message, {icon:1, time:2000});
                location.reload();  
            },
            error:function(xhr, status, error){
                console.log(xhr);
                console.log(status);
                console.log(error);
                layer.msg('ajax error',{icon:2, time:2000});
            },
            beforeSend:function(xhr){
                layer.load(0,{shade:false});
            }
        })

		// layer.msg('已删除!',{icon:1,time:1000});
	});
    return false;
}


    

</script>

@endsection


