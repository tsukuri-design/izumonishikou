<?php
add_action('acf/include_fields', function () {
    if (!function_exists('acf_add_local_field_group')) {
        return;
    }

    acf_add_local_field_group(
        array(
            'key' => 'group_659210f680033',
            'title' => '問い合わせフォーム詳細設定',
            'fields' => array(
                array(
                    'key' => 'field_659210f6354f2',
                    'label' => 'reCAPTCHAサイトキー',
                    'name' => 'recaptcha_site_key',
                    'aria-label' => '',
                    'type' => 'text',
                    'instructions' => 'reCAPCHTAのサイトキーを入力してください。',
                    'required' => 1,
                    'conditional_logic' => 0,
                    'wrapper' => array(
                        'width' => '',
                        'class' => '',
                        'id' => '',
                    ),
                    'default_value' => '',
                    'maxlength' => '',
                    'placeholder' => '',
                    'prepend' => '',
                    'append' => '',
                ),
                array(
                    'key' => 'field_65921162b3eaf',
                    'label' => 'reCAPTCHAシークレットキー',
                    'name' => 'recaptcha_secret_key',
                    'aria-label' => '',
                    'type' => 'text',
                    'instructions' => 'reCAPCHTAのシークレットキーを入力してください。',
                    'required' => 1,
                    'conditional_logic' => 0,
                    'wrapper' => array(
                        'width' => '',
                        'class' => '',
                        'id' => '',
                    ),
                    'default_value' => '',
                    'maxlength' => '',
                    'placeholder' => '',
                    'prepend' => '',
                    'append' => '',
                ),
            ),
            'location' => array(
                array(
                    array(
                        'param' => 'page',
                        'operator' => '==',
                        'value' => get_page_by_path('contact')->ID,
                    ),
                ),
            ),
            'menu_order' => 0,
            'position' => 'normal',
            'style' => 'default',
            'label_placement' => 'top',
            'instruction_placement' => 'label',
            'hide_on_screen' => '',
            'active' => true,
            'description' => '',
            'show_in_rest' => 0,
        )
    );
});

