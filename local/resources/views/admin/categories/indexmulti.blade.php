@extends('admin/layout/common')
@section('content')



<!-- Main content -->
<section class="content">
    
	<h2>CheckBox Tree</h2>
	<p>Tree nodes with check boxes.</p>
	<div style="margin:20px 0;">
		<a href="#" class="easyui-linkbutton" onclick="getChecked()">GetChecked</a> 
	</div>
	<div style="margin:10px 0">
		<input type="checkbox" checked onchange="$('#tt').tree({cascadeCheck:$(this).is(':checked')})">CascadeCheck 
		<input type="checkbox" onchange="$('#tt').tree({onlyLeafCheck:$(this).is(':checked')})">OnlyLeafCheck
	</div>
	<div class="easyui-panel" style="padding:5px">
		<ul id="tt" class="easyui-tree" data-options="url:'categories_json',method:'get',animate:true,checkbox:true"></ul>
	</div>
	

    
   
</section>
<!-- /.content -->	  


@stop
