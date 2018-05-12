@extends('layouts.layitem')


@section('content')

<article class="cl pd-20">
	<form action="" method="POST" class="form form-horizontal" id="form-user-edit" onsumbit="return false;">
		 <input type="hidden" name="_token" value="{{ csrf_token() }}">
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>姓名：</label>
			<div class="formControls col-xs-5 col-sm-5">
                <input type="hidden" name="userId" value="{{$user->id}}">
				<input type="text" class="input-text" value="{{$user->name}}" placeholder="" id="name" name="name" nullmsg="姓名">
			</div>
		</div>

		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>邮箱：</label>
			<div class="formControls col-xs-5 col-sm-5">
				<input type="email" class="input-text" value="{{$user->email}}"  placeholder="" name="email"  datatype="*" nullmsg="邮箱不能为空">
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3">用户类别：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<span class="select-box" style="width:150px;">
					<select class="select" name="role_id" size="1">
                        <option value="">无</option>
                        @if($user->role_id == 1)
                        <option value="1" selected="selected">医生</option>
                        <option value="0">管理员</option>
                        @else
                        <option value="1">医生</option>
                        <option value="0" selected="selected">管理员</option>
                        @endif
					</select>
				</span>
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
		$("#form-user-edit").validate({
		rules:{
			name:{
				required:true,
				minlength:2,
				maxlength:16
			},
		
			eamil:{
				required:true,
			},	
			
		},
		onkeyup:false,
		focusCleanup:true,
		success:"valid",
		submitHandler:function(form){
			$(form).ajaxSubmit({
				type:"POST",
				url:"{{url('service/user/edit')}}",
				dataType:'json',
				data:{
					name: $('input[name=name]').val(),
					user_id: $('input[name=userId]').val(),
					eamil: $('input[name=email]').val(),
					role_id: $('select[name=role_id] option:selected').val(),
					_token: "{{csrf_token()}}"
				},
				success:function(data){
					layer.closeAll('loading');
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
		return false;
		}
	});


</script>



@endsection
