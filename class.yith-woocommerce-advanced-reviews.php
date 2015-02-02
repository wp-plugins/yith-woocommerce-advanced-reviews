<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( ! class_exists( 'YITH_WooCommerce_Advanced_Reviews' ) ) {

	/**
	 * Implements features of FREE version of YWAR plugin
	 *
	 * @class YITH_WooCommerce_Advanced_Reviews
	 * @package Yithemes
	 * @since   1.0.0
	 * @author  Your Inspiration Themes
	 */
	class YITH_WooCommerce_Advanced_Reviews {

		/**
		 * @var $_panel Panel Object
		 */
		protected $_panel;

		/**
		 * @var $_premium string Premium tab template file name
		 */
		protected $_premium = 'premium.php';

		/**
		 * @var string Premium version landing link
		 */
		protected $_premium_landing = 'http://yithemes.com/themes/plugins/yith-woocommerce-advanced-reviews/';

		/**
		 * @var string Plugin official documentation
		 */
		protected $_official_documentation = 'http://yithemes.com/docs-plugins/yith_woocommerce_advanced_reviews/';

		/**
		 * @var string Advanced Reviews panel page
		 */
		protected $_panel_page = 'yith_ywar_panel';

		/**
		 * @var $enable_title Let users to add a title when writing a review
		 */
		protected $enable_title = 0;

		/**
		 * @var $enable_attachments Let users to add attachments when submit a review
		 */
		protected $enable_attachments = 0;

		/**
		 * @var $attachments_limit Set the maximum number of attachments a users can add when submit a review
		 */
		protected $attachments_limit = 0;

		/**
		 * Constructor
		 *
		 * Initialize plugin and registers actions and filters to be used
		 *
		 * @since  1.0
		 * @author Lorenzo giuffrida
		 */
		public function __construct() {

			if ( ! function_exists( 'WC' ) ) {
				return;
			}

			//  Add stylesheets and scripts files
			add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ) );

			// Load Plugin Framework
			add_action( 'after_setup_theme', array( $this, 'plugin_fw_loader' ), 1 );

			//Add action links
			add_filter( 'plugin_action_links_' . plugin_basename( YITH_YWAR_DIR . '/' . basename( YITH_YWAR_FILE ) ), array(
				$this,
				'action_links'
			) );
			add_filter( 'plugin_row_meta', array( $this, 'plugin_row_meta' ), 10, 4 );

			//  Add stylesheets and scripts files
			add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_styles' ) );
			add_action( 'admin_menu', array( $this, 'register_panel' ), 5 );
			add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_admin_styles' ) );

			//  Add a reviews summary with bars and percentage based on reviews rating
			add_filter( 'comments_template', array( $this, 'load_reviews_summary' ) );

			add_action( 'init', array( $this, 'initialize_settings' ) );

			add_action( 'admin_init', array( $this, 'register_pointer' ) );

			//Add settings
			add_action( 'ywar_summary_prepend', array( $this, 'add_reviews_average_info' ) );

			add_action( 'yith_advanced_reviews_premium', array( $this, 'premium_tab' ) );

			add_filter( 'woocommerce_product_review_comment_form_args', array(
				$this,
				'add_upload_element_on_bottom'
			) );


			//  Add custom fields "Title" on top of comment form
			add_action( 'comment_form_logged_in_after', array( $this, 'add_custom_fields_on_comment_form' ) );
			add_action( 'comment_form_after_fields', array( $this, 'add_custom_fields_on_comment_form' ) );

			//  Show additional information on review content
			add_filter( 'comment_text', array( $this, 'show_expanded_review_content' ) );

			//  Save additional comment fields on comment submit
			add_action( 'comment_post', array( $this, 'submit_additional_form_fields' ) );

			add_action( 'edit_comment', array( $this, 'update_plugin_metabox_data' ) );

			//  Add a new metabox for editing and saving title comment in meta_comment table
			add_action( 'add_meta_boxes_comment', array( $this, 'add_plugin_metabox' ), 1 );
		}

		/**
		 * Add scripts
		 *
		 * @since  1.0
		 * @author Lorenzo giuffrida
		 */
		public function enqueue_scripts() {

//  register and enqueue ajax calls related script file
			wp_register_script( "attachments-script", YITH_YWAR_URL . 'assets/js/ywar-attachments.js', array( 'jquery' ) );

			wp_localize_script( 'attachments-script', 'ywar', array(
				'limit_multiple_upload' => $this->attachments_limit
			) );
			wp_enqueue_script( 'attachments-script' );
		}

		/**
		 * Initialize plugin options
		 *
		 * @since  1.0
		 * @access public
		 * @return void
		 * @author Lorenzo Giuffrida
		 */
		public function initialize_settings() {
			$this->enable_title       = get_option( 'ywar_enable_review_title' ) === 'yes';
			$this->enable_attachments = get_option( 'ywar_enable_attachments' ) === 'yes';
			$this->attachments_limit  = get_option( 'ywar_max_attachments' );
		}

		/**
		 * Add custom field "Title" on top of comment form
		 *
		 * Check if the "enable title" option is activated and add a title field on comment form
		 *
		 * @return void
		 *
		 * @since 1.0
		 * @author Lorenzo giuffrida
		 */
		public function add_custom_fields_on_comment_form() {
			if ( ! is_product() ) {
				return;
			}

			if ( $this->enable_title ) {
				echo '<p class="comment-form-title"><label for="title">' . __( 'Title', 'ywar' ) . '</label><input type="text" name="title" id="title"/></p>';
			}
		}

		/**
		 * Display a customized comment content
		 *
		 * @param   string $text
		 *
		 * @return  string  customized comment content
		 *
		 * @since  1.0
		 * @author Lorenzo giuffrida
		 */
		public function show_expanded_review_content( $text ) {
			global $current_user;
			global $comment;

			$is_review     = ( 0 == $comment->comment_parent );
			$comment_title = '';
			$thumbnail_div = '';
			$div_yes_not   = '';

			if ( $this->enable_title ) {
				//  Add review title before review content text
				if ( $comment_title = get_comment_meta( get_comment_ID(), 'title', true ) ) {
					$comment_title = '<span class="review_title">' . esc_attr( $comment_title ) . '</span>';
				}
			}

			if ( $is_review && $this->enable_attachments ) {
				$thumbnail_div     = '';
				$review_thumbnails = get_comment_meta( $comment->comment_ID, 'thumb_ids', true );
				if ( isset ( $review_thumbnails ) && is_array( $review_thumbnails ) && ( count( $review_thumbnails ) > 0 ) ) {
					$thumbnail_div = '
<div class="review_thumbnail horizontalRule">';
					foreach ( $review_thumbnails as $thumb_id ) {
						$file_url    = wp_get_attachment_url( $thumb_id );
						$image_thumb = wp_get_attachment_image_src( $thumb_id, array( 100, 100 ), true );

						$thumbnail_div .= "<a href='$file_url' data-rel=\"prettyPhoto[review-gallery-$comment->comment_ID]\"><img class=\"ywar_thumbnail\" src='{$image_thumb[0]}' width='70px' height='70px'></a>";
					}
					$thumbnail_div .= '</div>';
				}
			}

			return $comment_title . $text . $thumbnail_div;
		}

		/**
		 * Save title of review
		 *
		 * Save the title submitted from comment form on comment_meta table
		 *
		 * @param int $comment_id the review id for which the title is submitted
		 *
		 * @return void
		 *
		 * @since 1.0
		 * @author Lorenzo giuffrida
		 */
		public function submit_form_values( $comment_id ) {
// check if review's title is enabled
			if ( ! $this->enable_title ) {
				return;
			}

			if ( isset ( $_POST['title'] ) ) {
				$comment_title = $_POST['title'];
// save additional field "title" in comment_meta
				update_comment_meta( $comment_id, 'title', $comment_title );
			}
		}

		/**
		 * Save additional comment fields on comment form submit.
		 *
		 * @return  void
		 *
		 * @since  1.0
		 * @author Lorenzo giuffrida
		 */
		public function submit_additional_form_fields( $comment_id ) {
			$this->submit_attachments( $comment_id );
			$this->submit_form_values( $comment_id );
		}

		/**
		 * Submit attachments from a comment form
		 *
		 * Check if attachment option is enabled and option value is satisfied, then upload attachment files.
		 *
		 * @param   int $comment_id the review id the files are referred.
		 *
		 * @return  void
		 *
		 * @since  1.0
		 * @author Lorenzo giuffrida
		 */
		public function submit_attachments( $comment_id ) {
//  check if attachments are enabled
			if ( ! $this->enable_attachments ) {
				return;
			}

			if ( $_FILES ) {
				$post_id = $_POST['comment_post_ID'];

				$files       = $_FILES["uploadFile"];
				$files_count = count( $files['name'] );

//  check for attachments limits

				if ( ( $this->attachments_limit > 0 ) && ( $files_count > $this->attachments_limit ) ) {
					return;
				}

				$attacchments_array = array();

				foreach ( $files['name'] as $key => $value ) {
					if ( $files['name'][ $key ] ) {
						$file   = array(
							'name'     => $files['name'][ $key ],
							'type'     => $files['type'][ $key ],
							'tmp_name' => $files['tmp_name'][ $key ],
							'error'    => $files['error'][ $key ],
							'size'     => $files['size'][ $key ]
						);
						$_FILES = array( "uploadFile" => $file );

						foreach ( $_FILES as $file => $array ) {
							$attachId = $this->insert_attachment( $file, $post_id );
//  enqueue attachments to current comment
							array_push( $attacchments_array, $attachId );
						}
					}
				}
//  save comment_meta with attachments array
				update_comment_meta( $comment_id, 'thumb_ids', $attacchments_array );
			}
		}

		/**
		 * Add attachment to media library
		 *
		 * @param   int $postId
		 * @param   string $fileHandler
		 *
		 * @return  void
		 *
		 * @since  1.0
		 * @author Lorenzo giuffrida
		 */
		public function insert_attachment( $fileHandler, $postId ) {
			if ( $_FILES[ $fileHandler ]['error'] !== UPLOAD_ERR_OK ) {
				__return_false();
			}

			require_once( ABSPATH . "wp-admin" . '/includes/image.php' );
			require_once( ABSPATH . "wp-admin" . '/includes/file.php' );
			require_once( ABSPATH . "wp-admin" . '/includes/media.php' );

			return media_handle_upload( $fileHandler, $postId );
		}

		/**
		 * Append attachment fields on comment form
		 *
		 * @param object $comment_form
		 *
		 * @return object $comment_form
		 *
		 * @since 1.0
		 * @author Lorenzo giuffrida
		 */
		public function add_upload_element_on_bottom( $comment_form ) {
			if ( ! $this->enable_attachments ) {
				return $comment_form;
			}

			$comment_form['comment_field'] .= '
				<p class="upload_section">
					<label for="uploadFile">' . __( 'Attachments', 'ywar' ) . '</label>
					<input type="button" value="' . __( 'Choose file(s)', 'ywar' ) . '" id="do_uploadFile" />
					<input type="file" name="uploadFile[]" id="uploadFile" accept="image/*" multiple="2" />
				</p>

				<p>
				<ul id="uploadFileList"></ul>
				</p>';

			return $comment_form;
		}

		/**
		 * Update custom extended comment properties
		 */
		public function update_plugin_metabox_data( $comment_id ) {
			if ( ! isset( $_POST['metabox_additional_data'] ) || ! wp_verify_nonce( $_POST['metabox_additional_data'], 'metabox_data_' . $comment_id ) ) {
				return;
			}

			if ( ( isset( $_POST['title'] ) ) && ( $_POST['title'] != '' ) ) {
				$title = wp_filter_nohtml_kses( $_POST['title'] );
				update_comment_meta( $comment_id, 'title', $title );
			} else {
				delete_comment_meta( $comment_id, 'title' );
			}
		}

		/**
		 * Display a meta box with additional review data, like title and thumbnails
		 *
		 * @return  void
		 *
		 * @since  1.0
		 * @author Lorenzo giuffrida
		 */
		public function display_plugin_metabox( $comment ) {
			$title = get_comment_meta( $comment->comment_ID, 'title', true );
			wp_nonce_field( 'metabox_data_' . $comment->comment_ID, 'metabox_additional_data', false );

			$title_paragraph = "<p><label for=\"title\">" . __( 'Title', 'ywar' ) . "</label><input type=\"text\" style=\"width:98%\" name=\"title\" value=\"" . esc_attr( $title ) . "\"/></p>";

			$thumbnail_div     = '';
			$review_thumbnails = get_comment_meta( $comment->comment_ID, 'thumb_ids', true );
			if ( isset ( $review_thumbnails ) && is_array( $review_thumbnails ) ) {
				$thumbnail_div = ' < hr><div style = "padding-top: 10px;padding-bottom: 10px;overflow:hidden" > ';
				foreach ( $review_thumbnails as $thumb_id ) {
					$file_url = wp_get_attachment_url( $thumb_id );
					// $image_thumb = wp_get_attachment_image($thumb_id, array(100, 100), true );
					$image_thumb = wp_get_attachment_image_src( $thumb_id, array( 100, 100 ), true );

					$thumbnail_div .= "<a href='$file_url'><img src='{
				$image_thumb[0]}' width='{
				$image_thumb[1]}'
	                                            height='{
				$image_thumb[2]}'</a>";

					//$thumbnail_div .= wp_get_attachment_image( $thumb_id, array(100,100),true, );
				}
				$thumbnail_div .= ' </div > ';
			}

			echo $title_paragraph . $thumbnail_div;
		}

		/**
		 * Add a metabox on review page for review's title
		 *
		 * @return void
		 *
		 * @since  1.0
		 * @author Lorenzo giuffrida
		 */
		public function add_plugin_metabox() {
			add_meta_box( 'AdditionalData', __( 'Additional data', 'ywar' ), array(
				$this,
				'display_plugin_metabox'
			), 'comment', 'normal', 'high' );
		}

		/**
		 * Enqueue css file
		 *
		 * @since  1.0
		 * @access public
		 * @return void
		 * @author Andrea Grillo <andrea.grillo@yithemes.com>
		 */
		public function plugin_fw_loader() {
			if ( ! defined( 'YIT' ) || ! defined( 'YIT_CORE_PLUGIN' ) ) {
				require_once( 'plugin-fw/yit-plugin.php' );
			}
		}

		/**
		 * Enqueue css file
		 *
		 * @since  1.0
		 * @author Lorenzo giuffrida
		 */
		public function enqueue_styles() {
			wp_enqueue_style( 'yit-style', YITH_YWAR_ASSETS_URL . '/css/yit-advanced-reviews.css' );
		}

		/**
		 * Enqueue script on administration comment page
		 *
		 * @param $hook
		 */
		function enqueue_admin_styles( $hook ) {
			wp_enqueue_style( 'yith-google-fonts', 'http://fonts.googleapis.com/css?family=Raleway:500,700,800,400' );

			if ( ( 'edit-comments.php' != $hook ) && ( 'post.php' != $hook ) ) {
				return;
			}

			wp_enqueue_style( 'yit-style', YITH_YWAR_ASSETS_URL . '/css/yit-advanced-reviews.css' );
		}

		/**
		 * Set default plugin options
		 *
		 * Add plugin option on plugin activation, with default values.
		 *
		 * @since  1.0
		 * @author Lorenzo giuffrida
		 */
		public function activate() {
			$settings = $this->get_settings();

			foreach ( $settings as $option ) {
				if ( isset( $option['default'] ) && isset( $option['id'] ) ) {
					add_option( $option['id'], $option['default'] );
				}
			}
		}

		public function add_reviews_average_info( $product ) {

			if ( get_option( 'woocommerce_enable_review_rating' ) === 'no' ) {
				return;
			}

			$count   = $product->get_rating_count();
			$average = $product->get_average_rating();

			if ( $count > 0 ) {
				echo '<div class="woocommerce-product-rating">
                    <div class="star-rating" title="' . sprintf( __( "Rated %s out of 5", 'ywar' ), $average ) . '">
                        <span  style="width:' . ( ( $average / 5 ) * 100 ) . '%"></span>
                    </div>
                    <a href="#reviews" class="ywar_filter_reviews" data-id_product="' . $product->id . '" data-stars="0" rel="nofollow"><span itemprop="reviewCount">' . $count . '</span>' . _n( " review", " reviews", $count, 'ywar' ) . ' </a><span class="review-rating-value"> ' . esc_html( $average ) . ' ' . __( "out of 5 stars", 'ywar' ) . '</span>
                </div>';
			}
		}

		/**
		 * Collect data about reviews rating and show a summary grouped by stars
		 *
		 * @param   object $template a custom template to be shown
		 *
		 * @return  object  $template
		 *
		 * @since  1.0
		 * @author Lorenzo giuffrida
		 */
		public function load_reviews_summary( $template ) {
			if ( ! is_product() ) {
				return $template;
			}

			global $product;
			$divSize = 100;

			$review_stats = $this->get_comments_stats( $product->id );

			$review1_perc = ( $review_stats[0] == '0' ) ? 0 : floor( $review_stats[1] / $review_stats[0] * 100 );
			$review2_perc = ( $review_stats[0] == '0' ) ? 0 : floor( $review_stats[2] / $review_stats[0] * 100 );
			$review3_perc = ( $review_stats[0] == '0' ) ? 0 : floor( $review_stats[3] / $review_stats[0] * 100 );
			$review4_perc = ( $review_stats[0] == '0' ) ? 0 : floor( $review_stats[4] / $review_stats[0] * 100 );
			$review5_perc = ( $review_stats[0] == '0' ) ? 0 : floor( $review_stats[5] / $review_stats[0] * 100 );

			include( 'templates/ywar-single-product-reviews.php' );

			return $template;
		}

		/**
		 * Get comments statistics about how many reviews there are for any rating
		 *
		 * @param   int $post_id $template   a custom template to be shown
		 *
		 * @return  array   array(total count reviews, reviews with 1 star, reviews with 2 stars, ..., reviews with 5 stars)
		 *
		 * @since  1.0
		 * @author Lorenzo giuffrida
		 */
		public function get_comments_stats( $post_id ) {
			$review5 = count( get_comments( array(
				'post_id'    => $post_id,
				'status'     => 'approve',
				'meta_query' => array( array( 'key' => 'rating', 'value' => '5' ) )
			) ) );

			$review4 = count( get_comments( array(
				'post_id'    => $post_id,
				'status'     => 'approve',
				'meta_query' => array( array( 'key' => 'rating', 'value' => '4' ) )
			) ) );

			$review3 = count( get_comments( array(
				'post_id'    => $post_id,
				'status'     => 'approve',
				'meta_query' => array( array( 'key' => 'rating', 'value' => '3' ) )
			) ) );

			$review2 = count( get_comments( array(
				'post_id'    => $post_id,
				'status'     => 'approve',
				'meta_query' => array( array( 'key' => 'rating', 'value' => '2' ) )
			) ) );

			$review1 = count( get_comments( array(
				'post_id'    => $post_id,
				'status'     => 'approve',
				'meta_query' => array( array( 'key' => 'rating', 'value' => '1' ) )
			) ) );

			$total = $review1 + $review2 + $review3 + $review4 + $review5;

			return array( $total, $review1, $review2, $review3, $review4, $review5 );
		}


		/**
		 * Add a panel under YITH Plugins tab
		 *
		 * @return   void
		 * @since    1.0
		 * @author   Andrea Grillo <andrea.grillo@yithemes.com>
		 * @use     /Yit_Plugin_Panel class
		 * @see      plugin-fw/lib/yit-plugin-panel.php
		 */
		public function register_panel() {

			if ( ! empty( $this->_panel ) ) {
				return;
			}

			$admin_tabs = array(
				'general' => __( 'General', 'ywar' ),
				'layout'  => __( 'Layout', 'ywar' )
			);

			if ( defined( 'YITH_YWAR_PREMIUM' ) ) {
				$admin_tabs['premium'] = __( 'Voting/Reviews settings', 'ywar' );
			} else {
				$admin_tabs['premium-landing'] = __( 'Premium Version', 'ywar' );
			}

			$args = array(
				'create_menu_page' => true,
				'parent_slug'      => '',
				'page_title'       => __( 'Advanced Reviews', 'ywar' ),
				'menu_title'       => __( 'Advanced Reviews', 'ywar' ),
				'capability'       => 'manage_options',
				'parent'           => '',
				'parent_page'      => 'yit_plugin_panel',
				'page'             => $this->_panel_page,
				'admin-tabs'       => $admin_tabs,
				'options-path'     => YITH_YWAR_DIR . '/plugin-options'
			);

			/* === Fixed: not updated theme  === */
			if ( ! class_exists( 'YIT_Plugin_Panel_WooCommerce' ) ) {
				require_once( 'plugin-fw/lib/yit-plugin-panel-wc.php' );
			}

			$this->_panel = new YIT_Plugin_Panel_WooCommerce( $args );
		}

		/**
		 * Premium Tab Template
		 *
		 * Load the premium tab template on admin page
		 *
		 * @return   void
		 * @since    1.0
		 * @author   Andrea Grillo <andrea.grillo@yithemes.com>
		 * @return void
		 */
		public function premium_tab() {
			$premium_tab_template = YITH_YWAR_TEMPLATE_PATH . '/admin/' . $this->_premium;
			if ( file_exists( $premium_tab_template ) ) {
				include_once( $premium_tab_template );
			}
		}

		/**
		 * Action Links
		 *
		 * add the action links to plugin admin page
		 *
		 * @param $links | links plugin array
		 *
		 * @return   mixed Array
		 * @since    1.0
		 * @author   Andrea Grillo <andrea.grillo@yithemes.com>
		 * @return mixed
		 * @use plugin_action_links_{$plugin_file_name}
		 */
		public function action_links( $links ) {

			$links[] = '<a href="' . admin_url( "admin.php?page={$this->_panel_page}" ) . '">' . __( 'Settings', 'ywar' ) . '</a>';

			if ( defined( 'YITH_YWAR_FREE_INIT' ) ) {
				$links[] = '<a href="' . $this->_premium_landing . '" target="_blank">' . __( 'Premium Version', 'ywar' ) . '</a>';
			}

			return $links;
		}

		/**
		 * plugin_row_meta
		 *
		 * add the action links to plugin admin page
		 *
		 * @param $plugin_meta
		 * @param $plugin_file
		 * @param $plugin_data
		 * @param $status
		 *
		 * @return   Array
		 * @since    1.0
		 * @author   Andrea Grillo <andrea.grillo@yithemes.com>
		 * @use plugin_row_meta
		 */
		public function plugin_row_meta( $plugin_meta, $plugin_file, $plugin_data, $status ) {
			if ( ( defined( 'YITH_YWAR_INIT' ) && ( YITH_YWAR_INIT == $plugin_file ) ) ||
			     ( defined( 'YITH_YWAR_FREE_INIT' ) && ( YITH_YWAR_FREE_INIT == $plugin_file ) )
			) {

				$plugin_meta[] = '<a href="' . $this->_official_documentation . '" target="_blank">' . __( 'Plugin Documentation', 'ywar' ) . '</a>';
			}

			return $plugin_meta;
		}

		public function register_pointer() {
			if ( ! class_exists( 'YIT_Pointers' ) ) {

				include_once( 'plugin-fw/lib/yit-pointers.php' );
			}

			$premium_message = defined( 'YITH_YWAR_PREMIUM' )
				? ''
				: __( 'YITH WooCommerce Advanced Reviews is available in an outstanding PREMIUM version with many new options, discover it now.', 'ywar' ) .
				  ' <a href="' . $this->_premium_landing . '">' . __( 'Premium version', 'ywar' ) . '</a>';

			$args[] = array(
				'screen_id'  => 'plugins',
				'pointer_id' => 'yith_ywar_panel',
				'target'     => '#toplevel_page_yit_plugin_panel',
				'content'    => sprintf( '<h3> %s </h3> <p> %s </p>',
					__( 'YITH WooCommerce Advanced Reviews', 'ywar' ),
					__( 'In the YIT Plugins tab you can find the YITH WooCommerce Advanced Reviews options. With this menu, you can access to all the settings of our plugins that you have activated.', 'ywar' ) . '<br>' . $premium_message
				),
				'position'   => array( 'edge' => 'left', 'align' => 'center' ),
				'init'       => defined( 'YITH_YWAR_PREMIUM' ) ? YITH_YWAR_INIT : YITH_YWAR_FREE_INIT
			);

			$args[] = array(
				'screen_id'  => 'update',
				'pointer_id' => 'yith_ywar_panel',
				'target'     => '#toplevel_page_yit_plugin_panel',
				'content'    => sprintf( '<h3> %s </h3> <p> %s </p>',
					__( 'YITH WooCommerce Advanced Reviews', 'ywar' ),
					__( 'From now on, you can find all the options of YITH WooCommerce Advanced Reviews under YIT Plugin -> Advanced Reviews instead of WooCommerce -> Settings -> Advanced Reviews, as in the previous version. When one of our plugins updates, a new voice will be added to this menu.', 'ywar' ) . $premium_message
				),
				'position'   => array( 'edge' => 'left', 'align' => 'center' ),
				'init'       => defined( 'YITH_YWAR_PREMIUM' ) ? YITH_YWAR_INIT : YITH_YWAR_FREE_INIT
			);

			YIT_Pointers()->register( $args );
		}


	}

}