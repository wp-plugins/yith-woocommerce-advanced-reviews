<?php
/**
 * This file belongs to the YIT Plugin Framework.
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly


$general_options = array(

	'general' => array(

		'section_general_settings'          => array(
			'name' => __( 'General settings', 'ywar' ),
			'type' => 'title',
			'id'   => 'ywar_section_general'
		),
		'review_settings_enable_title'      => array(
			'name'    => __( 'Show title', 'ywar' ),
			'type'    => 'checkbox',
			'desc'    => __( 'Add a title field on reviews.', 'ywar' ),
			'id'      => 'ywar_enable_review_title',
			'default' => 'yes'
		),
		'review_settings_enable_attachment' => array(
			'name'    => __( 'Show attachments', 'ywar' ),
			'type'    => 'checkbox',
			'desc'    => __( 'Append an attachment section on reviews.', 'ywar' ),
			'id'      => 'ywar_enable_attachments',
			'default' => 'yes'
		),
		'review_settings_attachment_limit'  => array(
			'name'    => __( 'Multiple attachment limit', 'ywar' ),
			'type'    => 'number',
			'desc'    => __( 'Set maximum number of attachments selectable (0 = no limit).', 'ywar' ),
			'id'      => 'ywar_max_attachments',
			'default' => '0'
		),
		'section_general_settings_end'      => array(
			'type' => 'sectionend',
			'id'   => 'ywar_section_general_end'
		)
	)
);

if ( ! defined( 'YITH_YWAR_PREMIUM' ) ) {
	$intro_tab = array(
		'section_general_settings_videobox' => array(
			'name'    => __( 'Upgrade to the PREMIUM VERSION', 'yit' ),
			'type'    => 'videobox',
			'default' => array(
				'plugin_name'               => __( 'YITH WooCommerce Advanced Reviews', 'yit' ),
				'title_first_column'        => __( 'Discover Advanced Features', 'yit' ),
				'description_first_column'  => __( 'Upgrade to the PREMIUM VERSION of YITH WOOCOMMERCE ADVANCED REVIEWS to benefit from all features!', 'yit' ),
				'image'                     => array(
					'image_url'  => YITH_YWAR_ASSETS_IMAGES_URL . 'feature2.png',
					'image_link' => 'http://yithemes.com/themes/plugins/yith-woocommerce-advanced-reviews/',
				),
				'title_second_column'       => __( 'Get Support and Pro Features', 'yit' ),
				'description_second_column' => __( 'By purchasing the premium version of the plugin, you will take advantage of the advanced features of the product and you will get one year of free updates and support through our platform available 24h/24.', 'yit' ),
				'button'                    => array(
					'href'  => 'http://yithemes.com/themes/plugins/yith-woocommerce-advanced-reviews',
					'title' => 'Get Support and Pro Features'
				)
			),
			'id'      => 'yith_wcas_general_videobox'
		)
	);
	$general_options['general'] = $intro_tab + $general_options['general'];
}

return $general_options;
