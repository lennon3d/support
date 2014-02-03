<?php if($report){?>
<table class="table table-bordered table-hover table-checks table-block" id="data-table">
<thead><tr><th>الأرقام</th></tr></thead>
<tbody>
<?php $array = explode(",", $report->mobiles);?>
<?php foreach($array as $mobile){?>
<tr><td><?=$mobile?></td></tr>
<?php }?>
</tbody>
</table>
<?php }?>