
@extends('layouts.master')

@section('title','后台管理')

@section('content')



<section class="Hui-article-box">
	<nav class="breadcrumb"><i class="Hui-iconfont"></i> 
	</nav>
	<div class="Hui-article">
		<article class="cl pd-20">
			<p class="f-20 text-success">欢迎使用
				<!-- <span class="f-14">v2.3</span>	 -->
				</p>


		<div class="row cl">
			<div class="col-xs-12 col-sm-6">
				<div class="panel">
					<div class="panel-header">
					病人诊断处理比例图
					</div>
					<div class="panel-body">
						<div id="patientIsJudge" style="width: 600px;height:400px;"></div>

					</div>
				</div>
			</div>
			<div class="col-xs-12 col-sm-6">
				<div class="panel">
					<div class="panel-header">
					病人患病类型比例图
					</div>
					<div class="panel-body">
						<div id="diagonseKind" style="width: 600px;height:400px;"></div>

					</div>
				</div>
			
			
			</div>
		</div>
		</article>
		<footer class="footer">
			<p><br> Copyright &copy;2015 H-ui.admin v3.0 All Rights Reserved.<br> 本后台系统由<a href="http://www.h-ui.net/" target="_blank" title="H-ui前端框架">H-ui前端框架</a>提供前端技术支持</p>
		</footer>
	</div>
</section>

@endsection

@section('my-js')
<script>

$(function(){
	$.get("{{url('getPatientJudge')}}", function(data) {
		var myChart = echarts.init(document.getElementById('patientIsJudge'));
		option = {
			tooltip: {
				trigger: 'item',
				formatter: "{a} <br/>{b}: {c} ({d}%)"
			},
			legend: {
				orient: 'vertical',
				x: 'left',
				data:data.lengend
			},
			series: [
				{
					name:'比例',
					type:'pie',
					radius: ['50%', '70%'],
					avoidLabelOverlap: false,
					label: {
						normal: {
							show: false,
							position: 'center'
						},
						emphasis: {
							show: true,
							textStyle: {
								fontSize: '30',
								fontWeight: 'bold'
							}
						}
					},
					labelLine: {
						normal: {
							show: false
						}
					},
					data:data.data
				}
			]
		};
		myChart.setOption(option);
	});

	$.get("{{url('getPatientKind')}}", function(data){
		var myChart = echarts.init(document.getElementById('diagonseKind'));
		option = {
			tooltip: {
				trigger: 'item',
				formatter: "{a} <br/>{b}: {c} ({d}%)"
			},
			legend: {
				orient: 'vertical',
				x: 'left',
				data:data.lengend
			},
			series: [
				{
					name:'比例',
					type:'pie',
					radius: ['50%', '70%'],
					avoidLabelOverlap: false,
					label: {
						normal: {
							show: false,
							position: 'center'
						},
						emphasis: {
							show: true,
							textStyle: {
								fontSize: '30',
								fontWeight: 'bold'
							}
						}
					},
					labelLine: {
						normal: {
							show: false
						}
					},
					data:data.data
				}
			]
		};
		myChart.setOption(option);
	})
})

</script>


@endsection

