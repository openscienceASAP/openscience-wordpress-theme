<?php
/**
 * Advanced Custom Fields for Course Overview Page
 * Open Science Theme v0.1.1
 * 
 * Activate Add-ons
 * Here you can enter your activation codes to unlock Add-ons to use in your theme. 
 * Since all activation codes are multi-site licenses, you are allowed to include your key in premium themes.
 */ 

function my_acf_settings( $options )
{
    // activate add-ons
    $options['activation_codes']['repeater'] = 'XXXX-XXXX-XXXX-XXXX';
    $options['activation_codes']['options_page'] = 'XXXX-XXXX-XXXX-XXXX';
    $options['activation_codes']['flexible_content'] = 'XXXX-XXXX-XXXX-XXXX';
    $options['activation_codes']['gallery'] = 'XXXX-XXXX-XXXX-XXXX';
    
    // setup other options (http://www.advancedcustomfields.com/docs/filters/acf_settings/)
    
    return $options;
    
}
add_filter('acf_settings', 'my_acf_settings');


/**
 * Register field groups
 * The register_field_group function accepts 1 array which holds the relevant data to register a field group
 * You may edit the array as you see fit. However, this may result in errors if the array is not compatible with ACF
 * This code must run every time the functions.php file is read
 */

if(function_exists("register_field_group"))
{
	register_field_group(array (
		'id' => '50f2b92d213e1',
		'title' => 'Course Overview (main)',
		'fields' => 
		array (
			0 => 
			array (
				'key' => 'field_26',
				'label' => 'Short Description',
				'name' => 'short_description',
				'type' => 'wysiwyg',
				'order_no' => 0,
				'instructions' => 'max. 200 Letters, without html markup',
				'required' => 0,
				'conditional_logic' => 
				array (
					'status' => 0,
					'rules' => 
					array (
						0 => 
						array (
							'field' => 'null',
							'operator' => '==',
						),
					),
					'allorany' => 'all',
				),
				'default_value' => '',
				'toolbar' => 'full',
				'media_upload' => 'no',
				'the_content' => 'no',
			),
			1 => 
			array (
				'key' => 'field_504b643d44a19',
				'label' => 'Description',
				'name' => 'description',
				'type' => 'wysiwyg',
				'order_no' => 1,
				'instructions' => '',
				'required' => 1,
				'conditional_logic' => 
				array (
					'status' => 0,
					'rules' => 
					array (
						0 => 
						array (
							'field' => 'null',
							'operator' => '==',
							'value' => '',
						),
					),
					'allorany' => 'all',
				),
				'default_value' => '',
				'toolbar' => 'full',
				'media_upload' => 'yes',
				'the_content' => 'yes',
			),
			2 => 
			array (
				'key' => 'field_504b643d4c1ca',
				'label' => 'Openness',
				'name' => 'openness',
				'type' => 'wysiwyg',
				'order_no' => 2,
				'instructions' => 'DEFAULT: The course will be opened up as far as possible. This means, to publish the sourcecode, the data and the expirience under a free copyright.',
				'required' => 1,
				'conditional_logic' => 
				array (
					'status' => 0,
					'rules' => 
					array (
						0 => 
						array (
							'field' => 'null',
							'operator' => '==',
							'value' => '',
						),
					),
					'allorany' => 'all',
				),
				'default_value' => '',
				'toolbar' => 'full',
				'media_upload' => 'no',
				'the_content' => 'yes',
			),
			3 => 
			array (
				'key' => 'field_33',
				'label' => 'Participation',
				'name' => 'participation',
				'type' => 'wysiwyg',
				'order_no' => 3,
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 
				array (
					'status' => 0,
					'rules' => 
					array (
						0 => 
						array (
							'field' => 'null',
							'operator' => '==',
							'value' => '',
						),
					),
					'allorany' => 'all',
				),
				'default_value' => '',
				'toolbar' => 'full',
				'media_upload' => 'no',
				'the_content' => 'yes',
			),
			4 => 
			array (
				'key' => 'field_18',
				'label' => 'Sources',
				'name' => 'sources',
				'type' => 'wysiwyg',
				'order_no' => 4,
				'instructions' => 'Sources: Educational Resources, Links, Literature',
				'required' => 0,
				'conditional_logic' => 
				array (
					'status' => 0,
					'rules' => 
					array (
						0 => 
						array (
							'field' => 'null',
							'operator' => '==',
							'value' => '',
						),
					),
					'allorany' => 'all',
				),
				'default_value' => '',
				'toolbar' => 'full',
				'media_upload' => 'no',
				'the_content' => 'yes',
			),
		),
		'location' => 
		array (
			'rules' => 
			array (
				0 => 
				array (
					'param' => 'page_parent',
					'operator' => '==',
					'value' => '3460',
					'order_no' => 0,
				),
			),
			'allorany' => 'all',
		),
		'options' => 
		array (
			'position' => 'normal',
			'layout' => 'default',
			'hide_on_screen' => 
			array (
				0 => 'excerpt',
				1 => 'custom_fields',
				2 => 'discussion',
				3 => 'categories',
			),
		),
		'menu_order' => 0,
	));
	register_field_group(array (
		'id' => '50f2b92d226d4',
		'title' => 'Course Overview (sidebar)',
		'fields' => 
		array (
			0 => 
			array (
				'key' => 'field_17',
				'label' => 'Status',
				'name' => 'status',
				'type' => 'select',
				'order_no' => 0,
				'instructions' => 'actual state',
				'required' => 0,
				'conditional_logic' => 
				array (
					'status' => 0,
					'rules' => 
					array (
						0 => 
						array (
							'field' => 'field_10',
							'operator' => '==',
							'value' => 'GPLv2',
						),
					),
					'allorany' => 'all',
				),
				'choices' => 
				array (
					'announcement' => 'Announcement',
					'preparations' => 'Preparations',
					'participating' => 'Participating',
					'wrapping-up' => 'Wrapping-up',
				),
				'default_value' => '',
				'allow_null' => 0,
				'multiple' => 0,
			),
			1 => 
			array (
				'key' => 'field_504b8532f12c5',
				'label' => 'Wiki Page',
				'name' => 'wiki-page',
				'type' => 'text',
				'order_no' => 1,
				'instructions' => 'full URL',
				'required' => 0,
				'conditional_logic' => 
				array (
					'status' => 0,
					'rules' => 
					array (
						0 => 
						array (
							'field' => 'field_17',
							'operator' => '==',
							'value' => 'Announced',
						),
					),
					'allorany' => 'all',
				),
				'default_value' => '',
				'formatting' => 'html',
			),
			2 => 
			array (
				'key' => 'field_2',
				'label' => 'Etherpad',
				'name' => 'etherpad',
				'type' => 'text',
				'order_no' => 2,
				'instructions' => 'full URL',
				'required' => 0,
				'conditional_logic' => 
				array (
					'status' => 0,
					'rules' => 
					array (
						0 => 
						array (
							'field' => 'field_17',
							'operator' => '==',
							'value' => 'Announced',
						),
					),
					'allorany' => 'all',
				),
				'default_value' => '',
				'formatting' => 'none',
			),
			3 => 
			array (
				'key' => 'field_49',
				'label' => 'Category',
				'name' => 'category',
				'type' => 'taxonomy-field',
				'order_no' => 3,
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 
				array (
					'status' => 0,
					'rules' => 
					array (
						0 => 
						array (
							'field' => 'field_34',
							'operator' => '==',
							'value' => 1,
						),
					),
					'allorany' => 'all',
				),
				'taxonomy' => 'category',
				'input_type' => 'select',
				'set_post_terms' => 'override',
				'use_post_terms' => 0,
				'return_value_type' => 'link',
				'input_size' => 5,
			),
			4 => 
			array (
				'key' => 'field_22',
				'label' => 'Participants',
				'name' => 'participants',
				'type' => 'users_field',
				'order_no' => 4,
				'instructions' => 'Author is automaticaly included',
				'required' => 0,
				'conditional_logic' => 
				array (
					'status' => 0,
					'rules' => 
					array (
						0 => 
						array (
							'field' => 'field_17',
							'operator' => '==',
							'value' => 'Announced',
						),
					),
					'allorany' => 'all',
				),
				'role' => 
				array (
					0 => '',
				),
				'allow_null' => 0,
				'multiple' => 1,
			),
			5 => 
			array (
				'key' => 'field_12',
				'label' => 'Projects',
				'name' => 'projects',
				'type' => 'post_object',
				'order_no' => 5,
				'instructions' => 'choose related Research or Project',
				'required' => 0,
				'conditional_logic' => 
				array (
					'status' => 0,
					'rules' => 
					array (
						0 => 
						array (
							'field' => 'field_10',
							'operator' => '==',
							'value' => 'GPLv2',
						),
					),
					'allorany' => 'all',
				),
				'post_type' => 
				array (
					0 => 'page',
				),
				'taxonomy' => 
				array (
					0 => 'all',
				),
				'allow_null' => 0,
				'multiple' => 1,
			),
			6 => 
			array (
				'key' => 'field_51',
				'label' => 'Twitter Timeline?',
				'name' => 'twitter_timeline',
				'type' => 'true_false',
				'order_no' => 6,
				'instructions' => 'do you want a twitter timeline in the sidebar?',
				'required' => 0,
				'conditional_logic' => 
				array (
					'status' => 0,
					'rules' => 
					array (
						0 => 
						array (
							'field' => 'field_28',
							'operator' => '==',
							'value' => 'German',
						),
					),
					'allorany' => 'all',
				),
				'message' => '',
			),
			7 => 
			array (
				'key' => 'field_20',
				'label' => 'Twitter Hashtag',
				'name' => 'twitter_hashtag',
				'type' => 'text',
				'order_no' => 7,
				'instructions' => 'without #',
				'required' => 0,
				'conditional_logic' => 
				array (
					'status' => 0,
					'rules' => 
					array (
						0 => 
						array (
							'field' => 'field_10',
							'operator' => '==',
							'value' => 'GPLv2',
						),
					),
					'allorany' => 'all',
				),
				'default_value' => '',
				'formatting' => 'none',
			),
			8 => 
			array (
				'key' => 'field_28',
				'label' => 'Language',
				'name' => 'language',
				'type' => 'radio',
				'order_no' => 8,
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 
				array (
					'status' => 0,
					'rules' => 
					array (
						0 => 
						array (
							'field' => 'field_34',
							'operator' => '==',
							'value' => 1,
						),
					),
					'allorany' => 'all',
				),
				'choices' => 
				array (
					'German' => 'German',
					'English' => 'English',
				),
				'default_value' => '',
				'layout' => 'vertical',
			),
			9 => 
			array (
				'key' => 'field_34',
				'label' => 'add RSS Feed ?',
				'name' => 'rss_feed_page',
				'type' => 'true_false',
				'order_no' => 9,
				'instructions' => 'Add RSS Feed to RSS Feed Page?',
				'required' => 0,
				'conditional_logic' => 
				array (
					'status' => 0,
					'rules' => 
					array (
						0 => 
						array (
							'field' => 'field_17',
							'operator' => '==',
							'value' => 'Announced',
						),
					),
					'allorany' => 'all',
				),
				'message' => '',
			),
			10 => 
			array (
				'key' => 'field_38',
				'label' => 'License Jurisdiction',
				'name' => 'license_jurisdiction',
				'type' => 'select',
				'order_no' => 10,
				'instructions' => 'for Creative Commons Licenses Version 3.0',
				'required' => 0,
				'conditional_logic' => 
				array (
					'status' => 0,
					'rules' => 
					array (
						0 => 
						array (
							'field' => 'field_17',
							'operator' => '==',
							'value' => 'Announced',
						),
					),
					'allorany' => 'all',
				),
				'choices' => 
				array (
					'at' => 'Austria',
					'de' => 'Germany',
					'us' => 'USA',
				),
				'default_value' => '',
				'allow_null' => 0,
				'multiple' => 0,
			),
			11 => 
			array (
				'key' => 'field_11',
				'label' => 'Content License',
				'name' => 'content_license',
				'type' => 'select',
				'order_no' => 11,
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 
				array (
					'status' => 0,
					'rules' => 
					array (
						0 => 
						array (
							'field' => 'field_10',
							'operator' => '==',
							'value' => 'GPLv2',
						),
					),
					'allorany' => 'all',
				),
				'choices' => 
				array (
					'cc-zero' => 'CC0 / Public Domain',
					'by' => 'CC by',
					'by-sa' => 'CC by sa',
					'by-nd' => 'CC by nd',
					'by-nc' => 'CC by nc',
					'by-nc-sa' => 'CC by nc sa',
					'by-nc-nd' => 'CC by nc nd',
				),
				'default_value' => '',
				'allow_null' => 0,
				'multiple' => 0,
			),
			12 => 
			array (
				'key' => 'field_32',
				'label' => 'Data License',
				'name' => 'data_license',
				'type' => 'select',
				'order_no' => 12,
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 
				array (
					'status' => 0,
					'rules' => 
					array (
						0 => 
						array (
							'field' => 'field_10',
							'operator' => '==',
							'value' => 'GPLv2',
						),
					),
					'allorany' => 'all',
				),
				'choices' => 
				array (
					'cc-zero' => 'CC0 / Public Domain',
					'by' => 'CC by',
					'by-sa' => 'CC by sa',
					'by-nd' => 'CC by nd',
					'by-nc' => 'CC by nc',
					'by-nc-sa' => 'CC by nc sa',
					'by-nc-nd' => 'CC by nc nd',
				),
				'default_value' => '',
				'allow_null' => 0,
				'multiple' => 0,
			),
			13 => 
			array (
				'key' => 'field_10',
				'label' => 'Sourcecode License',
				'name' => 'sourcecode_license',
				'type' => 'select',
				'order_no' => 13,
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 
				array (
					'status' => 0,
					'rules' => 
					array (
						0 => 
						array (
							'field' => 'field_10',
							'operator' => '==',
							'value' => 'GPLv2',
						),
					),
					'allorany' => 'all',
				),
				'choices' => 
				array (
					'GPLv2' => 'GPLv2',
					'GPLv3' => 'GPLv3',
					'BSD 2-clause' => 'BSD 2-clause',
					'BSD 3-clause' => 'BSD 3-clause',
					'MIT' => 'MIT',
					'MPLv2' => 'MPLv2',
					'LGPLv2.1' => 'LGPLv2.1',
					'LGPLv3.0' => 'LGPLv3.0',
					'ApacheLv2.0' => 'ApacheLv2.0',
				),
				'default_value' => '',
				'allow_null' => 0,
				'multiple' => 0,
			),
			14 => 
			array (
				'key' => 'field_504b656156eae',
				'label' => 'Sourcecode Repository',
				'name' => 'sourcecode_repo',
				'type' => 'text',
				'order_no' => 14,
				'instructions' => 'full URL',
				'required' => 0,
				'conditional_logic' => 
				array (
					'status' => 0,
					'rules' => 
					array (
						0 => 
						array (
							'field' => 'field_17',
							'operator' => '==',
							'value' => 'Announced',
						),
					),
					'allorany' => 'all',
				),
				'default_value' => '',
				'formatting' => 'none',
			),
			15 => 
			array (
				'key' => 'field_13',
				'label' => 'Course Starting Date',
				'name' => 'course_starting_date',
				'type' => 'date_picker',
				'order_no' => 15,
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 
				array (
					'status' => 0,
					'rules' => 
					array (
						0 => 
						array (
							'field' => 'field_10',
							'operator' => '==',
							'value' => 'GPLv2',
						),
					),
					'allorany' => 'all',
				),
				'date_format' => 'yy-mm-dd',
				'display_format' => 'dd/mm/yy',
			),
			16 => 
			array (
				'key' => 'field_15',
				'label' => 'Course Duration',
				'name' => 'course_duration',
				'type' => 'number',
				'order_no' => 16,
				'instructions' => 'weeks',
				'required' => 0,
				'conditional_logic' => 
				array (
					'status' => 0,
					'rules' => 
					array (
						0 => 
						array (
							'field' => 'field_10',
							'operator' => '==',
							'value' => 'GPLv2',
						),
					),
					'allorany' => 'all',
				),
				'default_value' => '',
			),
			17 => 
			array (
				'key' => 'field_16',
				'label' => 'Course Workload',
				'name' => 'course_workload',
				'type' => 'text',
				'order_no' => 17,
				'instructions' => 'Hours per Week: i.e. 3-5',
				'required' => 0,
				'conditional_logic' => 
				array (
					'status' => 0,
					'rules' => 
					array (
						0 => 
						array (
							'field' => 'field_10',
							'operator' => '==',
							'value' => 'GPLv2',
						),
					),
					'allorany' => 'all',
				),
				'default_value' => '',
				'formatting' => 'none',
			),
			18 => 
			array (
				'key' => 'field_3',
				'label' => 'Course Platform Name',
				'name' => 'course_platform',
				'type' => 'text',
				'order_no' => 18,
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 
				array (
					'status' => 0,
					'rules' => 
					array (
						0 => 
						array (
							'field' => 'field_17',
							'operator' => '==',
							'value' => 'Announced',
						),
					),
					'allorany' => 'all',
				),
				'default_value' => '',
				'formatting' => 'none',
			),
			19 => 
			array (
				'key' => 'field_23',
				'label' => 'Course Platform Website',
				'name' => 'course_platform_url',
				'type' => 'text',
				'order_no' => 19,
				'instructions' => 'full URL',
				'required' => 0,
				'conditional_logic' => 
				array (
					'status' => 0,
					'rules' => 
					array (
						0 => 
						array (
							'field' => 'field_17',
							'operator' => '==',
							'value' => 'Announced',
						),
					),
					'allorany' => 'all',
				),
				'default_value' => '',
				'formatting' => 'none',
			),
			20 => 
			array (
				'key' => 'field_1',
				'label' => 'Course Page',
				'name' => 'course_page',
				'type' => 'text',
				'order_no' => 20,
				'instructions' => 'full URL',
				'required' => 0,
				'conditional_logic' => 
				array (
					'status' => 0,
					'rules' => 
					array (
						0 => 
						array (
							'field' => 'field_17',
							'operator' => '==',
							'value' => 'Announced',
						),
					),
					'allorany' => 'all',
				),
				'default_value' => '',
				'formatting' => 'none',
			),
			21 => 
			array (
				'key' => 'field_5',
				'label' => 'University Name',
				'name' => 'university_name',
				'type' => 'text',
				'order_no' => 21,
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 
				array (
					'status' => 0,
					'rules' => 
					array (
						0 => 
						array (
							'field' => 'field_10',
							'operator' => '==',
							'value' => 'GPLv2',
						),
					),
					'allorany' => 'all',
				),
				'default_value' => '',
				'formatting' => 'none',
			),
			22 => 
			array (
				'key' => 'field_6',
				'label' => 'University Website',
				'name' => 'university_url',
				'type' => 'text',
				'order_no' => 22,
				'instructions' => 'full URL',
				'required' => 0,
				'conditional_logic' => 
				array (
					'status' => 0,
					'rules' => 
					array (
						0 => 
						array (
							'field' => 'field_10',
							'operator' => '==',
							'value' => 'GPLv2',
						),
					),
					'allorany' => 'all',
				),
				'default_value' => '',
				'formatting' => 'none',
			),
			23 => 
			array (
				'key' => 'field_7',
				'label' => 'Teacher',
				'name' => 'teacher',
				'type' => 'text',
				'order_no' => 23,
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 
				array (
					'status' => 0,
					'rules' => 
					array (
						0 => 
						array (
							'field' => 'field_10',
							'operator' => '==',
							'value' => 'GPLv2',
						),
					),
					'allorany' => 'all',
				),
				'default_value' => '',
				'formatting' => 'none',
			),
			24 => 
			array (
				'key' => 'field_9',
				'label' => 'Teacher Website',
				'name' => 'teacher_url',
				'type' => 'text',
				'order_no' => 24,
				'instructions' => 'full URL',
				'required' => 0,
				'conditional_logic' => 
				array (
					'status' => 0,
					'rules' => 
					array (
						0 => 
						array (
							'field' => 'field_10',
							'operator' => '==',
							'value' => 'GPLv2',
						),
					),
					'allorany' => 'all',
				),
				'default_value' => '',
				'formatting' => 'none',
			),
			25 => 
			array (
				'key' => 'field_8',
				'label' => 'Teacher Twitter',
				'name' => 'teacher_twitter',
				'type' => 'text',
				'order_no' => 25,
				'instructions' => 'username without @',
				'required' => 0,
				'conditional_logic' => 
				array (
					'status' => 0,
					'rules' => 
					array (
						0 => 
						array (
							'field' => 'field_17',
							'operator' => '==',
							'value' => 'Announced',
						),
					),
					'allorany' => 'all',
				),
				'default_value' => '',
				'formatting' => 'none',
			),
		),
		'location' => 
		array (
			'rules' => 
			array (
				0 => 
				array (
					'param' => 'page_parent',
					'operator' => '==',
					'value' => '3460',
					'order_no' => 0,
				),
			),
			'allorany' => 'all',
		),
		'options' => 
		array (
			'position' => 'side',
			'layout' => 'default',
			'hide_on_screen' => 
			array (
			),
		),
		'menu_order' => 0,
	));
}

?>
