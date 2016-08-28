<?php
	$page_description = get_field('page_description');
	if (!empty($page_description)) {
?>

<section class="subheader">
	<div class="container">
		<div class="row">
			<div class="col-xs-6 col-xs-push-3">
				<h1><?php the_title(); ?></h1>
				<?php echo $page_description; ?>
			</div>
		</div>
	</div>
</section>

<?php } ?>