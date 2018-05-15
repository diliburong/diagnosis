@extends('layouts.layitem')



@section('content')

<article class="cl pd-20">
	<form action="" method="post" class="form form-horizontal" id="form-diagonse-add">
		{{ csrf_field() }}

		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>姓名：</label>
			<div class="formControls col-xs-5 col-sm-7">
                <input type="hidden" name="patientId" value="{{$patient->id}}">
				<input type="text" class="input-text" value="{{$patient->name}}" placeholder="" id="name" name="name" disabled="disabled">
			</div>
			<div class="col-4"> </div>
		</div>

		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3">舌质：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<span class="select-box" style="width:150px;">
					<select class="select symptomOne" name="symptomOne" size="1">
						<option value="0">请选择</option>
						@foreach($symptoms as $symptom)
						<option value="{{$symptom->id}}">{{$symptom->text}}</option>
						@endforeach
					</select>
				</span>
			</div>
		</div>

		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3">舌苔：</label>
			<div class="formControls col-xs-8 col-sm-9">
				@foreach($symptoms as $symptom)
				<span class="select-box symptomTwo" style="width:150px;display:none;" id="{{$symptom->id}}">
					<select class="select" name="symptomTwo" size="1" style=""  >
							@foreach($symptom->symptomChild as $symptomChild)
						<option value="{{$symptomChild->id}}">{{$symptomChild->text}}</option>
						@endforeach
					</select>
				</span>
				@endforeach
			</div>
		</div>

		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>浏览图</label>
			<div class="formControls col-xs-5 col-sm-7">
				<img id="preview_id" src="{{asset('admin/static/h-ui.admin/images/icon-add.png')}}" style="border: 1px solid #B8B9B9; width: 200px; height: 200px;" onclick="$('#input_id').click()" />
				<input type="file" name="file" id="input_id" style="display: none;" onchange="return uploadImageToServer('input_id','images', 'preview_id', '{{url('service/upload')}}');" />
			</div>
			<div class="col-4"> </div>
		</div>

		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3">详细内容：</label>
			<div class="formControls col-xs-5 col-sm-7">
				<textarea class="textarea" placeholder="说点什么..." rows="" cols="" name="summary"></textarea>
			</div>
		</div>

		<div class="row cl">
			<div class="col-9 col-offset-3">
				<input class="btn btn-primary radius" type="submit" value="&nbsp;&nbsp;提交&nbsp;&nbsp;">
			</div>
		</div>
	</form>
</article>

@endsection

@section('my-js')

<script>
// var ue = UE.getEditor('editor');
// ue.execCommand( "getlocaldata" );
// var symptom = JSON.parse('{{!! $symptoms !!}}');
_getSymptomTwo();

var globalParentId=0;

$('.symptomOne').change(function(event){
	_getSymptomTwo();
});

function _getSymptomTwo() {
	var parent_id=$('.symptomOne option:selected').val();
	globalParentId  = parent_id;

	$('.symptomTwo').hide();
	$('#' + parent_id).show();
}

$("#form-diagonse-add").validate({
	rules:{
		symptomOne:{
			required: true
		},	
		symptomTwo:{
			required:true,
		},
		summary:{
			required:true,
		}
	},
	onkeyup:false,
	focusCleanup:true,
	success:"valid",
	submitHandler:function(form){
		$(form).ajaxSubmit({
			type:'post',
			url:"{{url('service/diagonse/add')}}",
			dataType:'json',
			data:{
				patientId:$('input[name=patientId]').val(),
				symptomOne:$('select[name=symptomOne] option:selected').val(),
				symptomTwo:$('#' + globalParentId+ ' option:selected').val(),
				summary:$('textarea[name=summary]').val(),
				preview: ($('#preview_id').attr('src')!='/admin/images/icon-add.png'?$('#preview_id').attr('src'):''),
				_token:"{{csrf_token( )}}" 
			},
			success:function(data){
				if (data==null) {
					layer.msg('服务端错误',{icon:2,time:2000});
					return;
				}
				if (data.status!=0) {
					layer.msg(data.message,{icon:2,time:2000});
					return;				
				}
				layer.msg(data.message,{icon:1,time:2000});
				parent.location.reload();  //刷新父页面
			},
			error:function(xhr,status,error){
				console.log(xhr);
				console.log(status);
				console.log(error);
				layer.msg('ajax error',{icon:2,time:2000});
			},
			beforeSend:function(xhr){
				layer.load(0,{shade:false});

			},


		});
		// var index = parent.layer.getFrameIndex(window.name);
		// parent.$('.btn-refresh').click();
		// parent.layer.close(index);
		
			return false;
	}
});

function uploadImageToServer(fileElmId, type, id, url)
{
	console.log(url);
	var test = '{{asset("img/loading_072.gif")}}';
	$("#"+id).attr("src", test);
	$.ajaxFileUpload({
		url: url +"/" + type,
		fileElementId: fileElmId,
		dataType: 'text',
		success: function (data)
		{
			var result = JSON.parse(data);
			$("#"+id).attr("src",  result.uri);
		},
    error: function (XMLHttpRequest, textStatus, errorThrown) {
      alert(errorThrown);
    }
	});
	return false;
}

</script>


@endsection
