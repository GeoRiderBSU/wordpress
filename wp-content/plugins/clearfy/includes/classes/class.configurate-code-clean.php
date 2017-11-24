<?php
	
	/**
	 * This class configures the code cleanup settings
	 * @author Webcraftic <wordpress.webraftic@gmail.com>
	 * @copyright (c) 2017 Webraftic Ltd
	 * @version 1.0
	 */
	class WbcrClearfy_ConfigCodeClean extends WbcrFactoryClearfy_Configurate {

		public function registerActionsAndFilters()
		{
			if( $this->getOption('disable_emoji') ) {
				add_action('init', array($this, 'disableEmojis'));
			}

			if( $this->getOption('remove_jquery_migrate') ) {
				add_filter('wp_default_scripts', array($this, 'removeJqueryMigrate'));
			}
			if( $this->getOption('disable_embeds') ) {
				add_action('init', array($this, 'disableEmbeds'));
			}

			if( $this->getOption('disable_json_rest_api') ) {
				add_action('init', array($this, 'removeRestApi'));
			}

			if( $this->getOption('disable_feed') ) {
				$this->disableFeed();
			}

			if( $this->getOption('html_minify') && !is_admin() ) {
				add_action('init', array($this, 'htmlCompressor'));
			}

			if( $this->getOption('remove_recent_comments_style') ) {
				add_action('widgets_init', array($this, 'removeRecentCommentsStyle'));
			}

			if( !is_admin() && $this->getOption('remove_html_comments') ) {
				add_action('init', array($this, 'removeHtmlComments'));
			}

			$this->remove_tags_from_head();
		}

		/**
		 * Disable Emojis
		 * URI: https://geek.hellyer.kiwi/plugins/disable-emojis/
		 * Version: 1.5.1
		 * Author: Ryan Hellyer
		 * Author URI: https://geek.hellyer.kiwi/
		 * License: GPL2
		 */
		
		public function disableEmojis()
		{
			remove_action('wp_head', 'print_emoji_detection_script', 7);
			remove_action('admin_print_scripts', 'print_emoji_detection_script');
			remove_action('wp_print_styles', 'print_emoji_styles');
			remove_action('admin_print_styles', 'print_emoji_styles');
			remove_filter('the_content_feed', 'wp_staticize_emoji');
			remove_filter('comment_text_rss', 'wp_staticize_emoji');
			remove_filter('wp_mail', 'wp_staticize_emoji_for_email');
			add_filter('tiny_mce_plugins', array($this, 'disableEmojisTinymce'));
		}
		
		/**
		 * Filter function used to remove the tinymce emoji plugin.
		 *
		 * @param    array $plugins
		 * @return   array Difference betwen the two arrays
		 */
		
		public function disableEmojisTinymce($plugins)
		{
			if( is_array($plugins) ) {
				
				return array_diff($plugins, array('wpemoji'));
			} else {
				
				return array();
			}
		}
		
		/**
		 * Disable JSON API
		 * http://wp-kama.ru/question/kak-polnostyu-otklyuchit-rest-api-vvedennyj-v-wp-4-4
		 */
		
		public function removeRestApi()
		{
			
			// Disabled REST API
			add_filter('rest_enabled', '__return_false');

			// Add redirect except contact form and post request
			if( (preg_match('#^/wp-json/(oembed|)#i', $_SERVER['REQUEST_URI']) || preg_match('#^/wp-json$#i', $_SERVER['REQUEST_URI'])) && (!preg_match('#^/wp-json/contact-form-7/#', $_SERVER['REQUEST_URI']) || $_SERVER['REQUEST_METHOD'] !== 'POST') ) {
				wp_redirect(get_option('siteurl'), 301);
				die();
			}
			
			// Disabled REST API filters
			remove_action('xmlrpc_rsd_apis', 'rest_output_rsd');
			remove_action('wp_head', 'rest_output_link_wp_head', 10, 0);
			remove_action('template_redirect', 'rest_output_link_header', 11, 0);
			remove_action('auth_cookie_malformed', 'rest_cookie_collect_status');
			remove_action('auth_cookie_expired', 'rest_cookie_collect_status');
			remove_action('auth_cookie_bad_username', 'rest_cookie_collect_status');
			remove_action('auth_cookie_bad_hash', 'rest_cookie_collect_status');
			remove_action('auth_cookie_valid', 'rest_cookie_collect_status');
			remove_filter('rest_authentication_errors', 'rest_cookie_check_errors', 100);
			
			// Disabled REST API events
			remove_action('init', 'rest_api_init');
			remove_action('rest_api_init', 'rest_api_default_filters', 10, 1);
			
			// Disabled Embeds which are used in Rest api
			remove_action('rest_api_init', 'wp_oembed_register_route');
			remove_filter('rest_pre_serve_request', '_oembed_rest_pre_serve_request', 10, 4);
			remove_action('wp_head', 'wp_oembed_add_discovery_links');
		}
		
		/**
		 * Remove styles for .recentcomments a
		 * .recentcomments a{display:inline !important;padding:0 !important;margin:0 !important;}
		 * https://github.com/nickyurov/
		 */
		
		public function removeRecentCommentsStyle()
		{
			
			global $wp_widget_factory;

			$widget_recent_comments = isset($wp_widget_factory->widgets['WP_Widget_Recent_Comments'])
				? $wp_widget_factory->widgets['WP_Widget_Recent_Comments']
				: null;

			if( !empty($widget_recent_comments) ) {
				remove_action('wp_head', array(
					$wp_widget_factory->widgets['WP_Widget_Recent_Comments'],
					'recent_comments_style'
				));
			}
		}

		/**
		 * Disable feeds

		 */

		public function disableFeed()
		{
			//Remove feed links from the <head> section

			remove_action('wp_head', 'feed_links_extra', 3);
			remove_action('wp_head', 'feed_links', 2);

			//Redirect feed URLs to home page

			add_action('do_feed', array($this, 'disableFeedRedirect'), 1);
			add_action('do_feed_rdf', array($this, 'disableFeedRedirect'), 1);
			add_action('do_feed_rss', array($this, 'disableFeedRedirect'), 1);
			add_action('do_feed_rss2', array($this, 'disableFeedRedirect'), 1);
			add_action('do_feed_atom', array($this, 'disableFeedRedirect'), 1);
		}

		public function disableFeedRedirect()
		{
			// if GET param - remove and redirect
			if( isset($_GET['feed']) ) {
				wp_redirect(esc_url_raw(remove_query_arg('feed')), 301);

				exit;
			}

			// if beauty permalink - remove and redirect
			if( get_query_var('feed') !== 'old' ) {

				set_query_var('feed', '');
			}

			redirect_canonical();

			wp_redirect(get_option('siteurl'), 301);

			die();
		}

		/**
		 * Remove unnecessary tags from head

		 */

		public function remove_tags_from_head()
		{
			if( $this->getOption('remove_dns_prefetch') ) {
				remove_action('wp_head', 'wp_resource_hints', 2);
			}

			if( $this->getOption('remove_rsd_link') ) {
				remove_action('wp_head', 'rsd_link');
			}

			if( $this->getOption('remove_wlw_link') ) {
				remove_action('wp_head', 'wlwmanifest_link');
			}

			if( $this->getOption('remove_adjacent_posts_link') ) {
				remove_action('wp_head', 'adjacent_posts_rel_link', 10, 0);
			}

			if( $this->getOption('remove_adjacent_posts_link') ) {
				remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);
			}

			if( $this->getOption('remove_shortlink_link') ) {
				remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0);
				remove_action('template_redirect', 'wp_shortlink_header', 11, 0);
			}
		}

		// Remove jQuery Migrate
		public function removeJqueryMigrate(&$scripts)
		{
			if( !is_admin() ) {
				$scripts->remove('jquery');
				$scripts->add('jquery', false, array('jquery-core'), '1.12.4');
			}
		}

		// Disable Embeds
		public function disableEmbeds()
		{
			global $wp;
			$wp->public_query_vars = array_diff($wp->public_query_vars, array('embed',));
			remove_action('rest_api_init', 'wp_oembed_register_route');
			add_filter('embed_oembed_discover', '__return_false');
			remove_filter('oembed_dataparse', 'wp_filter_oembed_result', 10);
			remove_action('wp_head', 'wp_oembed_add_discovery_links');
			remove_action('wp_head', 'wp_oembed_add_host_js');
			add_filter('tiny_mce_plugins', array($this, 'disableEmbedsTinyMcePlugin'));
			add_filter('rewrite_rules_array', array($this, 'disableEmbedsRewrites'));
			remove_filter('pre_oembed_result', 'wp_filter_pre_oembed_result', 10);
		}

		public function disableEmbedsTinyMcePlugin($plugins)
		{
			return array_diff($plugins, array('wpembed'));
		}

		public function disableEmbedsRewrites($rules)
		{
			foreach($rules as $rule => $rewrite) {
				if( false !== strpos($rewrite, 'embed=true') ) {
					unset($rules[$rule]);
				}
			}

			return $rules;
		}

		public function htmlCompressor()
		{
			ob_start(array($this, 'htmlCompressorMain'));
		}

		public function htmlCompressorMain($data)
		{
			return wbcr_clearfy_minify_html_output($data);
		}

		public function removeHtmlComments()
		{
			ob_start(array($this, 'removeHtmlCommentsMain'));
		}

		public function removeHtmlCommentsMain($data)
		{
			return preg_replace('#<!--(?!<!)[^\[>].*?-->#s', '', $data);
		}
	}