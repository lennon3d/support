<div id="top">
    <div class="top-wrapper">
        <ul class="topnav">
			<li class="topuser">
                <a target="_blank" title="" href="<?=base_url()?>"><?=lang("show_home")?></a>
            </li>
            <li class="topuser">
                <a title="" href="<?=base_url()?>admin/users/modifyUser/<?=$this->session->userdata("id")?>"><?=$this->session->userdata("name")?></a>
            </li>
            <li><a href="<?=base_url()?>admin/do_logout" title=""><b class="logout"></b></a></li>
        </ul>
    </div>
</div>