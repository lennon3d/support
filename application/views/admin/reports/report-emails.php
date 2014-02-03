<?php if($report){?>
<table class="table table-bordered table-hover table-checks table-block" id="data-table">
<thead><tr><th>الايميلات</th></tr></thead>
<tbody>
<?php $array = explode(",", $report->emails);?>
<?php foreach($array as $email){?>
<tr><td><?=$email?></td></tr>
<?php }?>
</tbody>
</table>
<?php }?>