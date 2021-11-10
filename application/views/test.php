<div class="container" style="margin-top: 50px;">
<div class="col-lg-offset-3 col-lg-6" style="padding:10px; border: solid 1px lightgray;">
<div class="col-lg-12">
<?php
echo form_open('auth/ops');
$inpt = ['name'=>'lenght','class'=>'form-control'];
echo form_input($inpt);
echo form_submit('submit','Enter',['class'=>'btn btn-primary','style'=>'margin-top:10px;']);
echo form_close();
if(isset($sum_lima)){
?>
<table class="table table-bordered" style="margin-top: 10px;">
<tr>
<th>top n </th>
<th>Hit Rate</th>
<th>Coverage</th>
</tr>
<tr>
<td>5</td>
<td><?php echo $hsum_lima; ?>%</td>
<td><?php echo $sum_lima; ?>%</td>
</tr>
<tr>
<td>9</td>
<td><?php echo $hsum_nine; ?>%</td>
<td><?php echo $sum_nine; ?>%</td>
</tr>
</table>
<?php
}else{
	?>
	<table class="table table-bordered" style="margin-top: 10px;">
<tr>
<th>top n </th>
<th>Hit Rate</th>
<th>Coverage</th>
</tr>
<tr>
<td>5</td>
<td>0%</td>
<td>0%</td>
</tr>
<tr>
<td>9</td>
<td>0%</td>
<td>0%</td>
</tr>
</table>
	<?php
}
?>
<?php echo anchor('auth/home','HOME',['class'=>'btn btn-warning']); ?>
</div>
</div>
</div>