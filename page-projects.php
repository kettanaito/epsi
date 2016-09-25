<?php
	/* Template name: Projects */
	get_header();
	page_header();
	page_subheader();
	content_begin();
?>

<div class="container-fluid">
	<div class="row">

		<div class="col-xs-2">
			<h3><?php _e('Категории', THEME_NAME); ?></h3>
			<ul class="categories-list">
				<li>
					<a href="#">Lorem</a>
				</li>
				<li>
					<a href="#">Lorem</a>
				</li>
				<li>
					<a href="#">Lorem</a>
				</li>
				<li>
					<a href="#">Lorem</a>
				</li>
			</ul>
		</div>

		<div class="col-xs-10">

			<div class="col-xs-4">
				<div class="project-thumbnail">
					<img src="">
					<div class="mask">
						<a href="#">
							<i class="fa fa-bars"></i>
						</a>
					</div>
				</div>
			</div>

			<div class="col-xs-4">
				<div class="project-thumbnail">
					<img src="">
					<div class="mask">
						<a href="#">
							<i class="fa fa-bars"></i>
						</a>
					</div>
				</div>
			</div>

			<div class="col-xs-4">
				<div class="project-thumbnail">
					<img src="">
					<div class="mask">
						<a href="#">
							<i class="fa fa-bars"></i>
						</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<?php
	content_end();
	get_footer();
?>
