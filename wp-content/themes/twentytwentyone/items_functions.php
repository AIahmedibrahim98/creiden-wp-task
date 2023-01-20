<?php
//Register post type
//
if ( ! function_exists( 'items_post_type_callback' ) ) {
	function items_post_type_callback() {
		$args = array(
			'public'   => true,
			'label'    => __( 'Items', 'textdomain' ),
			'supports' => [ 'custom-fields', 'title', 'editor' ]
		);
		register_post_type( 'item', $args );
	}

	add_action( 'init', 'items_post_type_callback' );
}


add_action( 'init', function () {
	register_rest_route( 'items/v1', '/test/(?P<items_param>\d+)', array(
		'methods'  => 'GET',
		'callback' => 'items_api_test_callback'

	) );
} );

//GET routes
add_action( 'init', function () {
	register_rest_route( 'items/v1', '/items/', array(
		'methods'  => 'GET',
		'callback' => 'items_api_get_callback'

	) );
} );
add_action( 'init', function () {
	register_rest_route( 'items/v1', '/items/(?P<item_id>\d+)', array(
		'methods'  => 'GET',
		'callback' => 'items_api_get_callback'

	) );
} );

//POST
add_action( 'init', function () {
	register_rest_route( 'items/v1', '/items/create/', array(
		'methods'  => 'POST',
		'callback' => 'items_api_post_callback'

	) );
} );

//PUT
add_action( 'init', function () {
	register_rest_route( 'items/v1', '/items/update/(?P<item_id>\d+)', array(
		'methods'  => 'PUT',
		'callback' => 'items_api_put_callback'

	) );
} );

//DELETE
add_action( 'init', function () {
	register_rest_route( 'items/v1', '/items/(?P<item_id>\d+)', array(
		'methods'  => 'DELETE',
		'callback' => 'items_api_delete_callback'

	) );
} );

/*function items_api_test_callback( $request ){
    $response['status'] =  200;
    $response['success'] = true;
    $response['data'] = $request->get_param('items_param');
    return new WP_REST_Response( $response );
}*/

/**
 * Get all items from our WordPress Installation
 *
 * @param object $request WP_Request with data
 *
 * @return obeject         WP_REST_Response
 */
function items_api_get_callback( $request ) {


	$item_id = $request->get_param( 'item_id' );
	if ( empty( $item_id ) ) {
		$posts = get_posts( [ 'post_type' => 'item', 'post_status' => 'publish'] );

		if ( count( $posts ) > 0 ) {
			$items = [];
			foreach ( $posts as $post ) {
				$items[] = [
					'id'      => $post->ID,
					'title'   => $post->post_title,
					'content' => $post->post_content,
					'date'    => $post->post_date,
					'user_id' => get_field( 'user_id', $post->ID ),
				];
			}$response['status']  = 200;
			$response['success'] = true;
			$response['data']    = $items;
		} else {
			$response['status']  = 200;
			$response['success'] = false;
			$response['message'] = 'NO posts!';
		}
	} else {
		if ( $item_id > 0 ) {
			$post = get_post( $item_id );
			$data = [
				'id'      => $post->ID,
				'title'   => $post->post_title,
				'content' => $post->post_content,
				'date'    => $post->post_date,
				'user_id' => get_field( 'user_id', $post->ID )
			];
			if ( ! empty( $post ) ) {
				$response['status']  = 200;
				$response['success'] = true;
				$response['data']    = $data;
			} else {
				$response['status']  = 200;
				$response['success'] = false;
				$response['message'] = 'No post found!';
			}

		}
	}

	wp_reset_postdata();

	return new WP_REST_Response( $response );
}

/**
 * Create a item post by rest api
 *
 * @param object $request WP_Request with data
 *
 * @return obeject         WP_REST_Response
 */
function items_api_post_callback( $request ) {


	$post['post_title']   = sanitize_text_field( $request->get_param( 'title' ) );
	$post['post_content'] = sanitize_text_field( $request->get_param( 'content' ) );
	// set user id custom field
	$post['meta_input']['user_id'] = sanitize_text_field( $request->get_param( 'user_id' ) );
	$post['post_status']  = 'publish';
	$post['post_type']    = 'item';
	$new_post_id          = wp_insert_post( $post );

	if ( ! is_wp_error( $new_post_id ) ) {
		$response['status']  = 200;
		$response['success'] = true;
		$response['data']    = get_post( $new_post_id );
	} else {
		$response['status']  = 200;
		$response['success'] = false;
		$response['message'] = 'No post found!';
	}

	return new WP_REST_Response( $response );

}


/**
 * Update a item post
 *
 * @param object $request WP_Request with data
 *
 * @return obeject         WP_REST_Response
 */
function items_api_put_callback( $request ) {
	$item_id = $request->get_param( 'item_id' );
	if ( $item_id > 0 ) {
		$post['ID']           = $item_id;
		$post['post_title']   = sanitize_text_field( $request->get_param( 'title' ) );
		$post['post_content'] = sanitize_text_field( $request->get_param( 'content' ) );
		$post['meta_input']   = [
			'genre' => sanitize_text_field( $request->get_param( 'meta_genre' ) )
		];
		$post['post_status']  = 'publish';
		$post['post_type']    = 'item';
		$new_post_id          = wp_update_post( $post, true );

		if ( ! is_wp_error( $new_post_id ) ) {
			$response['status']  = 200;
			$response['success'] = true;
			$response['data']    = $new_post_id;
		} else {
			$response['status']  = 200;
			$response['success'] = false;
			$response['message'] = 'No post found!';
		}


	} else {
		$response['status']  = 200;
		$response['success'] = false;
		$response['message'] = 'item id is no set!';
	}

	return new WP_REST_Response( $response );
}

function items_api_delete_callback( $request ) {
	$item_id = $request->get_param( 'item_id' );
	if ( $item_id > 0 ) {
		$deleted_post = wp_delete_post( $item_id );
		if ( ! empty( $deleted_post ) ) {
			$response['status']  = 200;
			$response['success'] = true;
			$response['data']    = $deleted_post;
		} else {
			$response['status']  = 200;
			$response['success'] = false;
			$response['message'] = 'No post found!';
		}
	} else {
		$response['status']  = 200;
		$response['success'] = false;
		$response['message'] = 'item id is no set!';
	}

	return new WP_REST_Response( $response );
}