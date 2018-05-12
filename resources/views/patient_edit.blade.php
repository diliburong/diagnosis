@extends('layouts.layitem')

@section('content')

<article class="cl pd-20">
	<form action="" method="POST" class="form form-horizontal" id="form-patient-edit" onsumbit="return false;">
		 <input type="hidden" name="_token" value="{{ csrf_token() }}">
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>姓名：</label>
			<div class="formControls col-xs-5 col-sm-5">
                <input type="hidden" name="userId" value="{{$patient->id}}">
				<input type="text" class="input-text" value="{{$patient->name}}" placeholder="" id="name" name="name" nullmsg="姓名">
			</div>
		</div>

		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>电话：</label>
			<div class="formControls col-xs-5 col-sm-5">
				<input type="text" class="input-text" value="{{$patient->phone}}" placeholder="" name="phone"  datatype="*" nullmsg="电话不能为空">
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>年龄：</label>
			<div class="formControls col-xs-5 col-sm-5">
				<input type="number" class="input-text" value="{{$patient->age}}" placeholder="" name="age"  datatype="*" nullmsg="年龄不能为空">
			</div>
		</div>

		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3">性别：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<span class="select-box" style="width:150px;">
					<select class="select" name="sex" size="1">
                        @if($patient->sex == 1)
                        <option value="1" selected="selected">男</option>
                        <option value="0">女</option>
                        @else
                        <option value="1">男</option>
                        <option value="0" selected="selected">女</option>
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
// jQuery.validator.addMethod("isMobile", function(value, element) {  
//     var length = value.length;  
//     var mobile = /^(13[0-9]{9})|(18[0-9]{9})|(14[0-9]{9})|(17[0-9]{9})|(15[0-9]{9})$/;  
//     return this.optional(element) || (length == 11 && mobile.test(value));  
// }, "请正确填写您的手机号码");  
		$("#form-patient-edit").validate({
		rules:{
			name:{
				required:true,
				minlength:2,
				maxlength:16
			},
			age:{
				required:true,
			},
		
			phone:{
				required:true,
            	minlength : 11,  
            	// 自定义方法：校验手机号在数据库中是否存在  
            	// checkPhoneExist : true,  
            	// isMobile : true 
			},
            sex:{
                required:true,
            }
			
		},
		onkeyup:false,
		focusCleanup:true,
		success:"valid",
		submitHandler:function(form){
			$(form).ajaxSubmit({
				type:"POST",
				url:"service/patient/edit",
				dataType:'json',
				data:{
					name: $('input[name=name]').val(),
					phone: $('input[name=phone]').val(),
					age: $('input[name=age]').val(),
					sex: $('select[name=sex] option:selected').val(),
                    id: $('input[name=userId]').val(),
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
