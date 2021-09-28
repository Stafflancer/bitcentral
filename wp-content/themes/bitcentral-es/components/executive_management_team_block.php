<?php if( get_row_layout() == 'executive_management_team_block' ): ?>

<section class="team-listing-block">
	<div class="container">
		<div class="wrap m-auto">
			<div class="title-block">
				<div class="section-title"><?php the_sub_field('label'); ?></div>
			</div>
		</div>
		<?php if(get_sub_field('members_per_row') == '3'){$col = 'three-col'; }
		elseif(get_sub_field('members_per_row') == '4'){$col = 'four-col'; }
		elseif(get_sub_field('members_per_row') == '5'){$col = 'five-col'; }
		?>
		<div class="listing m-auto d-flex flex-row-wrap <?php echo $col; ?>">
			<div class="inner d-flex flex-row-wrap justify-content-center">
				<?php
				$cnt = 0;
				$members = get_sub_field('members');
				foreach( $members as $p):
					$members_list = get_post($p);
					$image = wp_get_attachment_image_src( get_post_thumbnail_id( $p ), 'full' );
				?>
					<div class="team-col">
						<a href="javascript:void(0);" data-toggle="modal" data-target="#memberModal-<?php echo $cnt; ?>">
							<div class="profile bg-cover" style="background-image: url('<?php echo $image[0]; ?>');"></div>
							<div class="content">
								<h3><?php echo $members_list->post_title; ?></h3>
								<p><?php the_field('title', $p); ?></p>
								<div class="read-more">Learn more<?php echo svg_icon('arrow-right'); ?></div>
							</div>
						</a>
					</div>
				<?php $cnt++; endforeach; wp_reset_postdata(); ?>
			</div>
		</div>
	</div>
</section>

<?php
$cnt = 0;
$members = get_sub_field('members');
foreach( $members as $p):
	$members_list = get_post($p);
	$image = wp_get_attachment_image_src( get_post_thumbnail_id($p), 'full' );
?>
<!-- Modal -->
	<div class="modal fade member-modal" id="memberModal-<?php echo $cnt; ?>" tabindex="-1" role="dialog" aria-labelledby="memberModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/close-icon.svg" alt="Close"></button>
				<div class="modal-body d-flex flex-row-wrap">
					<div class="left-col">
						<div class="profile bg-cover" style="background-image: url('<?php echo $image[0]; ?>');"></div>
						<h3><?php echo $members_list->post_title; ?></h3>
						<p><?php the_field('title', $p); ?></p>
					</div>
					<div class="content">
						<p><?php echo $members_list->post_content; ?></p>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php $cnt++; endforeach; wp_reset_postdata(); ?>

<?php endif; ?>