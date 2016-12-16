<style>
.badgeimg {
	border-width: 10px;
	border-color: #f4f4f4;
	border-style: solid;
	padding: 8px;
	margin-bottom: 15px;
}
</style>

<div class="cont">
<h3>View Our Signature Backgrounds</h3>
<br />
	<?php foreach($allnames as $key => $val) { ?>
    	<div class="badge">
        	<h4>Badge No. <?php echo $key; ?></h4>
        	<img src="<?php echo SITE_URL.'/'.$val; ?>" class="badgeimg" alt="<?php echo 'Badge No.'.$key; ?>" />
            <?php if(Auth::LoggedIn()) { ?>
			<form action="<?php echo SITE_URL; ?>/index.php/BadgeView" method="post">
            	<input type="hidden" name="bgimage" value="<?php echo basename($val); ?>">
                <input type="hidden" name="action" value="save_badge">
            	<input type="submit" name="submit" class="" value="Set as my background">
            </form>
			<?php } ?>
        </div>
        <hr />
    <?php } ?>
</div>