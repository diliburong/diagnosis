
@extends('layouts.master')

@section('title','诊断历史')

@section('content')



<section class="Hui-article-box">
    <nav class="breadcrumb"><i class="Hui-iconfont"></i></nav>
    <!-- <nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 用户中心 <span class="c-gray en">&gt;</span> 会员列表<a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav> -->
    <div class="Hui-article">
        <article class="cl pd-20">
            <!-- <div class="text-c"> 日期范围：
                <input type="text" onfocus="WdatePicker({maxDate:'#F{$dp.$D(\'datemax\')||\'%y-%M-%d\'}'})" id="datemin" class="input-text Wdate" style="width:120px;">
                -
                <input type="text" onfocus="WdatePicker({minDate:'#F{$dp.$D(\'datemin\')}',maxDate:'%y-%M-%d'})" id="datemax" class="input-text Wdate" style="width:120px;">
                <input type="text" class="input-text" style="width:250px" placeholder="输入会员名称、电话、邮箱" id="" name="">
                <button type="submit" class="btn btn-success radius" id="" name=""><i class="Hui-iconfont">&#xe665;</i> 搜用户</button>
            </div> -->
            <div class="cl pd-5 bg-1 bk-gray mt-20"> <span class="l">
                <!-- <a href="javascript:;" onclick="datadel()" class="btn btn-danger radius"><i class="Hui-iconfont">&#xe6e2;</i> 批量删除</a>  -->
                <a href="javascript:;" onclick="diagonse_add('添加记录','{{url('diagonse_add')}}/{{$patient->id}}','','510')" class="btn btn-primary radius"><i class="Hui-iconfont">&#xe600;</i> 添加记录</a></span> 
            </div>
            <div class="mt-20">
                @foreach($diagonses as $diagonse)
                <div class="panel panel-primary">
                    <div class="panel-header">时间：{{$diagonse->created_at}} &nbsp&nbsp 姓名: {{$patient->name}}</div>
                    <div class="panel-body">
                        <div>

                            <div class="row cl mb-15">
                                <label class="form-label col-xs-4 col-sm-3"><span class="c-red"></span>舌像图：</label>
                                <div class="formControls col-xs-5 col-sm-7">
                                    <img id="preview_id" src="{{asset($diagonse->img_path)}}" style="border: 1px solid #B8B9B9; width: 200px; height: 200px;" />
                                </div>
                                <div class="col-4"> </div>
                            </div>

                            <div class="row cl mb-15">
                                <label class="form-label col-xs-4 col-sm-3"><span class="c-red"></span>舌质症状：</label>
                                <div class="formControls col-xs-5 col-sm-7">
                                    <span>{{$diagonse->symptomOne->text}}</span>
                                </div>
                                <div class="col-4"> </div>
                            </div>

                            <div class="row cl mb-15">
                                <label class="form-label col-xs-4 col-sm-3"><span class="c-red"></span>舌苔症状：</label>
                                <div class="formControls col-xs-5 col-sm-7">
                                    <span>{{$diagonse->symptomTwo->text}}</span>
                                </div>
                                <div class="col-4" > </div>
                            </div>
                            
                            <div class="row cl mb-15">
                                <label class="form-label col-xs-4 col-sm-3"><span class="c-red"></span>临床症状：</label>
                                <div class="formControls col-xs-5 col-sm-7">
                                    <span>{{$diagonse->mean}}</span>
                                </div>
                                <div class="col-4" > </div>
                            </div>
                            

                            <div class="row cl mb-15">
                                <label class="form-label col-xs-4 col-sm-3">诊断详情：</label>
                                <div class="formControls col-xs-5 col-sm-7">
                                    <div class="content">
                                        <p>{{$diagonse->summary}}</p>
                                    </div>

                                    <!-- <script id="editor" type="text/plain" style="width:100%; height:400px;"></script> -->
                                </div>
                            </div>
                        </div>

                    
                    </div>
                </div>
                @endforeach
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
function diagonse_add(title,url,w,h){
	layer_show(title,url,w,h);
}
/*用户-查看*/
// function diagonse_show(title,url,id,w,h){
// 	layer_show(title,url,w,h);
// }


/*用户-删除*/
function diagonse_del(obj,id){
	layer.confirm('确认要删除吗？',function(index){
		// $(obj).parents("tr").remove();
        $.ajax({
            type:'post',
            url:'service/diagonse/del',
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


