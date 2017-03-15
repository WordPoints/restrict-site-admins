<?php

/**
 * Main file of the module.
 *
 * ---------------------------------------------------------------------------------|
 * Copyright 2017  J.D. Grimes  (email : jdg@codesymphony.co)
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License, version 2 or later, as
 * published by the Free Software Foundation.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
 * ---------------------------------------------------------------------------------|
 *
 * @package WordPoints_Restrict_Site_Admins
 * @version 1.0.0
 * @author  J.D. Grimes <jdg@codesymphony.co>
 * @license GPLv2+
 */

WordPoints_Modules::register(
	'
		Module Name: Restrict Site Admins
		Author:      J.D. Grimes
		Author URI:  https://codesymphony.co/
		Module URI:  https://wordpoints.org/modules/restrict-site-admins/
		Version:     1.0.0
		License:     GPLv2+
		Description: Restricts site admins from being able to modify points reactions.
		Text Domain: wordpoints-restrict-site-admins
		Domain Path: /languages
		Channel:     wordpoints.org
		ID:          1048
		Namespace:   Restrict_Site_Admins
	'
	, __FILE__
);

/**
 * Filters user caps to ensure that only super admins have the capabilities.
 *
 * @since 1.0.0
 *
 * @WordPress\filter user_has_cap
 *
 * @param array   $all_caps An array of all the user's capabilities.
 * @param array   $caps     Actual capabilities for meta capability.
 * @param array   $args     Other args, like an object ID.
 * @param WP_User $user     The user object.
 *
 * @return array The filtered capabilities.
 */
function wordpoints_restrict_site_admins_filter_user_caps( $all_caps, $caps, $args, $user ) {

	if ( is_multisite() && ! is_super_admin( $user->ID ) ) {

		$all_caps = array_diff_key(
			$all_caps
			, wordpoints_get_custom_caps()
			, wordpoints_points_get_custom_caps()
		);
	}

	return $all_caps;
}
add_filter( 'user_has_cap', 'wordpoints_restrict_site_admins_filter_user_caps', 10, 4 );

/**
 * Removes the Points Type screen from the admin menu for non-super admins.
 *
 * @since 1.0.0
 *
 * @WordPress\action admin_menu 20 After the menus have been registered.
 */
function wordpoints_restrict_site_admins_remove_points_type_menu() {

	if ( ! is_super_admin() ) {

		remove_submenu_page(
			wordpoints_get_main_admin_menu()
			, 'wordpoints_points_types'
		);
	}
}
add_action( 'admin_menu', 'wordpoints_restrict_site_admins_remove_points_type_menu', 20 );

// EOF
