<?php
global $product;
global $review_perc_array;
global $review_stats;
?>

<div id="reviews_summary">
	<h3><?php _e( 'Customers\' reviews', 'ywar' ) ?></h3>

	<?php do_action( 'ywar_summary_prepend', $product ) ?>

	<div class="reviews_bar">

		<?php for ( $i = 0; $i < 5; $i ++ ) :
			$index = 4 - $i;    //  number of stars for the loop item rating
			$stars  = $index + 1;
			$perc  = $review_perc_array[ $index ]; //  position of percentage value for current star rating

			?>

			<div class="ywar_review_row">
				<?php do_action( 'ywar_summary_row_prepend', $stars, $product->id ) ?>

				<span
					class="ywar_stars_value"><?php printf( _n( '%s star', '%s stars', $stars, 'ywar' ), $stars ); ?></span>
				<span class="ywar_num_reviews"><?php echo $review_stats[ $index ]; ?></span>
				<span class="ywar_rating_bar">
					<span style="background-color:<?php echo get_option( 'ywar_summary_bar_color' ); ?>"
					      class="ywar_scala_rating">
						<span class="ywar_perc_rating"
						      style="width: <?php echo $perc; ?>%; background-color:<?php echo get_option( 'ywar_summary_percentage_bar_color' ); ?>">
							<?php if ( 'yes' == get_option( 'ywar_summary_percentage_value' ) ) : ?>
								<span style="color:<?php echo get_option( 'ywar_summary_percentage_value_color' ); ?>"
								      class="ywar_perc_value"><?php printf( '%s %%', $perc ); ?></span>							<?php endif; ?>
						</span>
					</span>
				</span>

				<?php do_action( 'ywar_summary_row_append', $stars, $product->id ) ?>
			</div>
		<?php endfor; ?>
	</div>

	<?php do_action( 'ywar_summary_append' ) ?>

	<div id="reviews_header">
		<?php do_action( 'ywar_reviews_header', $review_stats ) ?>
	</div>
</div>



