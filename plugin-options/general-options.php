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


return array(

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
			'name'    => __( 'Multiple attachments limit', 'ywar' ),
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