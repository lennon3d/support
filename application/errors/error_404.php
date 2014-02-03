<?php
		exit ( "
				<meta charset='utf-8'/>
				<link href='" . base_url () . "assets/admin/css/admin.css' rel='stylesheet' type='text/css' />
				<div class='wrapper'>
				<div class='content'>
				<div class='inner'>
				<div class='body'>
				<div class='no-permission-div'>
				<img style='left;0' src='" . base_url () . "assets/admin/images/404.png'/>
				<label style='display:block;'>" . lang ( "404_title" ) . "</label>
				<a style='display:block;' href = '" . base_url() . "'>" . lang ( "go_home" ) . "</a>
				</div>
				</div>
				</div>
				</div>
				</div>
				" );
