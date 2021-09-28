<?php

add_filter('gform_pre_render_10', 'populate_fields');
add_filter('gform_pre_validation_10', 'populate_fields');
add_filter('gform_pre_submission_filter_10', 'populate_fields');
add_filter('gform_admin_pre_render_10', 'populate_fields');

add_filter('gform_pre_render_17', 'populate_fields');
add_filter('gform_pre_validation_17', 'populate_fields');
add_filter('gform_pre_submission_filter_17', 'populate_fields');
add_filter('gform_admin_pre_render_17', 'populate_fields');

function populate_fields($form)
{
    foreach ($form['fields'] as &$field) {
        if ($field->type != 'select' && $field->visibility != 'hidden') {
            continue;
        }

        $choices = [];

        // Select Job Role
//        if ($field->adminLabel == 'role') {
//            // You can add additional parameters here to alter the posts that are retrieved
//            // more info: http://codex.wordpress.org/Template_Tags/get_posts
//            $cat_args = [
//                'taxonomy'   => 'job-role',
//                'hide_empty' => false,
//            ];
//            $cat_list = [];
//            $cat_obj  = get_categories($cat_args);
//
//            foreach ($cat_obj as $cat) {
//                //$cat_list[$cat->slug] = $cat->name;
//                $choices[] = ['text' => $cat->name, 'value' => $cat->name];
//            }
//
//            // Update 'Select a Post' to whatever you'd like the instructive option to be
//            $field->placeholder = '--Select Job Role--';
//            $field->choices     = $choices;
//        }

        // Select Industry
//        if ($field->adminLabel == 'industry') {
//            // You can add additional parameters here to alter the posts that are retrieved
//            // more info: http://codex.wordpress.org/Template_Tags/get_posts
//            $cat_args = [
//                'taxonomy'   => 'resource-industry',
//                'hide_empty' => false,
//            ];
//            $cat_list = [];
//            $cat_obj  = get_categories($cat_args);
//
//            foreach ($cat_obj as $cat) {
//                //$cat_list[$cat->slug] = $cat->name;
//                $choices[] = ['text' => $cat->name, 'value' => $cat->name];
//            }
//
//            // Update 'Select a Post' to whatever you'd like the instructive option to be
//            $field->placeholder = '--Select Industry--';
//            $field->choices     = $choices;
//        }

        // Select Country
        if ($field->adminLabel == 'country') {
            // You can add additional parameters here to alter the posts that are retrieved
            // more info: http://codex.wordpress.org/Template_Tags/get_posts
            $countries = get_countries();

            foreach ($countries as $text => $value) {
                $choices[] = ['text' => $value, 'value' => $text];
            }

            // Update 'Select a Post' to whatever you'd like the instructive option to be
            $field->placeholder  = '--Select Country--';
            $field->choices      = $choices;
            $field->defaultValue = (isset($_COOKIE['bc_form_country']) && $_COOKIE['bc_form_country'] != "") ? $_COOKIE['bc_form_country'] : "US";
        }

//        if ($field->adminLabel == 'resource') {
//            // You can add additional parameters here to alter the posts that are retrieved
//            // more info: http://codex.wordpress.org/Template_Tags/get_posts
//            $resource_slug  = $_GET['form_resource'];
//            $resource       = get_page_by_path($resource_slug, OBJECT, 'resource');
//            $resource_title = get_the_title($resource);
//            $choices[]      = ['text' => $resource_title, 'value' => $resource_slug];
//
//            $field->choices      = $choices;
//            $field->defaultValue = $_GET['form_resource'];
//        }

        if ($field->adminLabel == 'resource_type') {
            // You can add additional parameters here to alter the posts that are retrieved
            // more info: http://codex.wordpress.org/Template_Tags/get_posts
            $resource_type  = get_post_type();
            $resource_label = get_post_type_object($resource_type)->labels->singular_name;
            $field->defaultValue = strtolower($resource_label);
        }

        if ($field->adminLabel == 'lead_key') {
            // You can add additional parameters here to alter the posts that are retrieved
            // more info: http://codex.wordpress.org/Template_Tags/get_posts
            $key                 = uniqid(time(), true);
            $field->defaultValue = str_replace(".", "", $key);
        }
    }

    return $form;
}

function bc_generate_lead($entry, $form)
{
    // Getting post
    $values      = [
        'entry_id' => $entry['id'],
        'email'    => $entry['7'],
        'resource' => $entry['25'],
        'lead_key' => $entry['21'],
        'name'     => $entry['3'] . ' ' . $entry['4'],
        'lang'     => $entry['23'],
    ];
//    $resource    = get_page_by_path($values['resource'], OBJECT, 'resource');
//    $resource_id = $resource->ID;

    $resource_lead_post = [
        'post_title'  => $values['name'] . ' - Entry #' . $values['entry_id'],
        'post_type'   => 'resource_lead',
        'post_status' => 'private',
    ];

    // Insert the post into the database
    $post_id = wp_insert_post($resource_lead_post);

    // Resource
    $field_key = "lead_resource";
    $value     = $values['resource'];
    update_field($field_key, $value, $post_id);

    // Entry
    $field_key = "entry_id";
    $value     = $values['entry_id'];
    update_field($field_key, $value, $post_id);

    // Email
    $field_key = "lead_email";
    $value     = $values['email'];
    update_field($field_key, $value, $post_id);

    // Lead Key
    $field_key = "lead_key";
    $value     = $values['lead_key'];
    update_field($field_key, $value, $post_id);

    // 9/10/18
    // Language
    $field_key = "lead_lang";
    $value     = $values['lang'];
    update_field($field_key, $value, $post_id);

}

add_action('gform_after_submission_10', 'bc_generate_lead', 10, 2);
add_action('gform_after_submission_17', 'bc_generate_lead', 10, 2);

function add_resource_lead_metabox()
{
    add_meta_box('bc_resource_lead_link', 'View Lead', 'bc_resource_lead_link', 'resource_lead', 'normal', 'high');
}

add_action('add_meta_boxes', 'add_resource_lead_metabox');

function bc_resource_lead_link()
{
    global $post;
    $post_id          = $post->ID;
    $lead_entry       = get_post_meta($post_id, "entry_id", true);
    $lead_resource_id = get_post_meta($post_id, "lead_resource", true);

    echo '<p>Contact Info: <a href="/wp-admin/admin.php?page=gf_entries&view=entry&id=5&lid=' . $lead_entry . '" target="_blank">' . $post->post_title . '</a></p>';
    echo '<p>Resource Post: <a href="/wp-admin/post.php?post=' . $lead_resource_id . '&action=edit" target="_blank">' . get_the_title($lead_resource_id) . '</a></p>';
}

// Cookie responses for easy resubmission
function bc_cookie_responses($entry, $form)
{
    $common_fields = [
        'company',
        'first_name',
        'last_name',
        'email',
        'phone',
        'zip',
        'website',
        'job',
        'country',
    ];

    foreach ($form["fields"] as &$field) {
        // Skip if this is a multi-field
        if (is_array($field["inputs"])) {
            continue;
        }

        $field_name = $field["adminLabel"];

        if (in_array($field_name, $common_fields) !== false) {
            // Get value from entry object
            $value = $entry[ $field["id"] ];

            if (!empty($value)) {
                // Set cookie
                $cookie_name = 'bc_form_' . $field_name;
                setcookie($cookie_name, $value, strtotime('+30 days'), COOKIEPATH, COOKIE_DOMAIN);
            } else {
                // Remove this value
                $cookie_name = 'bc_form_' . $field_name;
                setcookie($cookie_name, "", time() - 3600, COOKIEPATH, COOKIE_DOMAIN);
            }
        }
    }
}

add_action('gform_after_submission', 'bc_cookie_responses', 15, 2);

// Get cookied responses
function bc_prepopulate_cookie_fields($form)
{
    $common_fields = [
        'company',
        'first_name',
        'last_name',
        'email',
        'phone',
        'zip',
        'website',
        'job',
        'country',
    ];

    foreach ($form["fields"] as &$field) {
        // Skip multi-select
        if (is_array($field["inputs"])) {
            continue;
        }

        $field_name = $field["adminLabel"];

        if (in_array($field_name, $common_fields) !== false) {
            $cookie_name = 'bc_form_' . $field_name;

            if (isset($_COOKIE[ $cookie_name ])) {
                // Get value from entry object
                $value               = $_COOKIE[ $cookie_name ];
                $field->defaultValue = isset($_POST[ 'input_' . $field->id ]) ? $_POST[ 'input_' . $field->id ] : $value;
            }
        }
    }

    return $form;
}

add_filter('gform_pre_render', 'bc_prepopulate_cookie_fields', 20);

function add_resource_metabox()
{
    add_meta_box('bc_resource_file', 'File', 'bc_resource_file', 'resource', 'normal', 'high');
}

add_action('add_meta_boxes', 'add_resource_metabox');

function bc_resource_file()
{
    global $post;
    $post_id       = $post->ID;
    $resource_file = get_post_meta($post_id, '_resource_file', true);
    if ($resource_file) {
        $resource_file_hide = 'style="display:none" ';
        ?>
        <div class="resource_file_name">
            <b>Current File:</b>
            <a href="/wp-content/uploads/resources/downloads/<?php echo $resource_file; ?>?TB_iframe=true" class="thickbox"><?php echo $resource_file; ?></a>
        </div>
        <input type="hidden" name="resource_file_name" id="resource_file_name" value="<?php echo $resource_file; ?>"/>
        <div class="resource_file_replace">
            <a href="javascript:" class="button replace-resource-file">Replace File</a>
            <a href="javascript:" class="button remove-resource-file">Remove File</a>
        </div>
        <?php
    }
    ?>
    <input type="file" name="resource_file" id="resource_file" <?php echo $resource_file_hide; ?>accept="image/jpeg,image/gif,image/png,image/bmp,image/tiff,application/pdf,application/x-pdf,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document,application/vnd.ms-powerpoint,application/vnd.openxmlformats-officedocument.presentationml.presentation" class="input-text"/>
    <script type="text/javascript">
        jQuery( 'form#post' ).attr( 'enctype', 'multipart/form-data' );
        jQuery( '.replace-resource-file' ).click( function () {
            jQuery( '#resource_file' ).slideToggle();
        } );
        jQuery( '.remove-resource-file' ).click( function () {
            jQuery( this ).slideUp();
            jQuery( '.resource_file_name' ).html( '' );
            jQuery( '#resource_file' ).slideDown();
            jQuery( '.replace-resource-file' ).slideUp();
            jQuery( '#resource_file_name' ).val( '' );
        } );
    </script>
    <?php
}

function remove_resource_metabox()
{
    // Only run if the user is an Author or lower.
    global $post;

    $resource_types = wp_get_post_terms($post->ID, 'resource-type');

    foreach ($resource_types as $rt) {
        if ($rt->slug == 'web-page') {
            remove_meta_box('bc_resource_file', 'resource', 'normal');
            break;
        }
    }
}

add_action('do_meta_boxes', 'remove_resource_metabox');

function bc_save_resource_meta($post_id, $post)
{
    // Return if the user doesn't have edit permissions.
    if (!current_user_can('edit_post', $post_id)) {
        return $post_id;
    }

    // Verify this came from the our screen and with proper authorization,
    // because save_post can be triggered at other times.
    if (!isset($_POST['resource_file_name']) && !isset($_FILES['resource_file'])) {
        return $post_id;
    }

    if ('revision' === $post->post_type) {
        return;
    }

    // First change the upload directory temporarily and enable upload handling
    add_filter('upload_dir', 'bc_resource_upload_dir');

    if (!function_exists('wp_handle_upload')) {
        require_once(ABSPATH . 'wp-admin/includes/file.php');
    }

    // If there's already a file...
    if (get_post_meta($post_id, '_resource_file', true)) {
        //File was removed. Delete it and its metadata
        if (!isset($_POST['resource_file_name'])) {
            bc_delete_resource_file('resource_file', $post_id);
        }

        // File is being replaced
        if ($_FILES['resource_file']['size'] > 0 && $_FILES['resource_file']['error'] == 0) {
            //bc_delete_resource_file('resource_file',$post_id);
            bc_upload_resource_file('resource_file', $post_id, false);
        }

    } // If this is a brand new file upload
    else {
        // Just upload the file and save it to the field
        if ($_FILES['resource_file']['size'] > 0 && $_FILES['resource_file']['error'] == 0) {
            //upload the recommendation file
            bc_upload_resource_file('resource_file', $post_id, false);
        }
    }
    // Reset to default upload folder
    add_filter('remove_dir', 'bc_resource_upload_dir');
}

add_action('save_post', 'bc_save_resource_meta', 1, 2);

// Set customer upload directory
function bc_resource_upload_dir($dir)
{
    return [
               'path'   => $dir['basedir'] . '/resources/downloads',
               'url'    => $dir['baseurl'] . '/resources/downloads',
               'subdir' => '/resources/downloads',
           ] + $dir;
}

// Upload to customer's personal directory
function bc_upload_resource_file($imgFile, $post_id, $req = true)
{
    $uploadedfile     = $_FILES[ $imgFile ];
    $upload_overrides = ['test_form' => false];
    $movefile         = wp_handle_upload($uploadedfile, $upload_overrides);

    if ($movefile && !isset($movefile['error'])) {
        //echo "File is valid, and was successfully uploaded.\n";
        //var_dump( $movefile );
        update_post_meta($post_id, '_' . $imgFile, basename($movefile['file']));
    } elseif ($req) {
        /**
         * Error generated by _wp_handle_upload()
         * @see _wp_handle_upload() in wp-admin/includes/file.php
         */
        //echo $movefile['error'];
        if ($movefile['error'] != 'No file was uploaded.') {
            update_post_meta($post_id, '_' . $imgFile, $movefile['error']);
        }
    }
}

function bc_delete_resource_file($imgFile, $post_id)
{
    $filename = get_post_meta($post_id, '_' . $imgFile, true);
    unlink(ABSPATH . 'wp-content/uploads/resources/downloads/' . $filename);
    delete_post_meta($post_id, '_' . $imgFile);
}

function get_countries()
{
    $countries = [
        "US" => "United States",
        "CA" => "Canada",
        "MX" => "Mexico",
        "UM" => "United States Minor Outlying Islands",
        "AF" => "Afghanistan",
        "AL" => "Albania",
        "DZ" => "Algeria",
        "AS" => "American Samoa",
        "AD" => "Andorra",
        "AO" => "Angola",
        "AI" => "Anguilla",
        "AQ" => "Antarctica",
        "AG" => "Antigua and Barbuda",
        "AR" => "Argentina",
        "AM" => "Armenia",
        "AW" => "Aruba",
        "AU" => "Australia",
        "AT" => "Austria",
        "AZ" => "Azerbaijan",
        "BS" => "Bahamas",
        "BH" => "Bahrain",
        "BD" => "Bangladesh",
        "BB" => "Barbados",
        "BY" => "Belarus",
        "BE" => "Belgium",
        "BZ" => "Belize",
        "BJ" => "Benin",
        "BM" => "Bermuda",
        "BT" => "Bhutan",
        "BO" => "Bolivia",
        "BA" => "Bosnia and Herzegovina",
        "BW" => "Botswana",
        "BV" => "Bouvet Island",
        "BR" => "Brazil",
        "IO" => "British Indian Ocean Territory",
        "BN" => "Brunei Darussalam",
        "BG" => "Bulgaria",
        "BF" => "Burkina Faso",
        "BI" => "Burundi",
        "KH" => "Cambodia",
        "CM" => "Cameroon",
        "CV" => "Cape Verde",
        "KY" => "Cayman Islands",
        "CF" => "Central African Republic",
        "TD" => "Chad",
        "CL" => "Chile",
        "CN" => "China",
        "CX" => "Christmas Island",
        "CC" => "Cocos (Keeling) Islands",
        "CO" => "Colombia",
        "KM" => "Comoros",
        "CG" => "Congo",
        "CD" => "Congo, the Democratic Republic of the",
        "CK" => "Cook Islands",
        "CR" => "Costa Rica",
        "CI" => "Cote D'Ivoire",
        "HR" => "Croatia",
        "CU" => "Cuba",
        "CY" => "Cyprus",
        "CZ" => "Czech Republic",
        "DK" => "Denmark",
        "DJ" => "Djibouti",
        "DM" => "Dominica",
        "DO" => "Dominican Republic",
        "EC" => "Ecuador",
        "EG" => "Egypt",
        "SV" => "El Salvador",
        "GQ" => "Equatorial Guinea",
        "ER" => "Eritrea",
        "EE" => "Estonia",
        "ET" => "Ethiopia",
        "FK" => "Falkland Islands (Malvinas)",
        "FO" => "Faroe Islands",
        "FJ" => "Fiji",
        "FI" => "Finland",
        "FR" => "France",
        "GF" => "French Guiana",
        "PF" => "French Polynesia",
        "TF" => "French Southern Territories",
        "GA" => "Gabon",
        "GM" => "Gambia",
        "GE" => "Georgia",
        "DE" => "Germany",
        "GH" => "Ghana",
        "GI" => "Gibraltar",
        "GR" => "Greece",
        "GL" => "Greenland",
        "GD" => "Grenada",
        "GP" => "Guadeloupe",
        "GU" => "Guam",
        "GT" => "Guatemala",
        "GN" => "Guinea",
        "GW" => "Guinea-Bissau",
        "GY" => "Guyana",
        "HT" => "Haiti",
        "HM" => "Heard Island and Mcdonald Islands",
        "VA" => "Holy See (Vatican City State)",
        "HN" => "Honduras",
        "HK" => "Hong Kong",
        "HU" => "Hungary",
        "IS" => "Iceland",
        "IN" => "India",
        "ID" => "Indonesia",
        "IR" => "Iran, Islamic Republic of",
        "IQ" => "Iraq",
        "IE" => "Ireland",
        "IL" => "Israel",
        "IT" => "Italy",
        "JM" => "Jamaica",
        "JP" => "Japan",
        "JO" => "Jordan",
        "KZ" => "Kazakhstan",
        "KE" => "Kenya",
        "KI" => "Kiribati",
        "KP" => "Korea, Democratic People's Republic of",
        "KR" => "Korea, Republic of",
        "KW" => "Kuwait",
        "KG" => "Kyrgyzstan",
        "LA" => "Lao People's Democratic Republic",
        "LV" => "Latvia",
        "LB" => "Lebanon",
        "LS" => "Lesotho",
        "LR" => "Liberia",
        "LY" => "Libyan Arab Jamahiriya",
        "LI" => "Liechtenstein",
        "LT" => "Lithuania",
        "LU" => "Luxembourg",
        "MO" => "Macao",
        "MK" => "Macedonia, the Former Yugoslav Republic of",
        "MG" => "Madagascar",
        "MW" => "Malawi",
        "MY" => "Malaysia",
        "MV" => "Maldives",
        "ML" => "Mali",
        "MT" => "Malta",
        "MH" => "Marshall Islands",
        "MQ" => "Martinique",
        "MR" => "Mauritania",
        "MU" => "Mauritius",
        "YT" => "Mayotte",
        "FM" => "Micronesia, Federated States of",
        "MD" => "Moldova, Republic of",
        "MC" => "Monaco",
        "MN" => "Mongolia",
        "MS" => "Montserrat",
        "MA" => "Morocco",
        "MZ" => "Mozambique",
        "MM" => "Myanmar",
        "NA" => "Namibia",
        "NR" => "Nauru",
        "NP" => "Nepal",
        "NL" => "Netherlands",
        "AN" => "Netherlands Antilles",
        "NC" => "New Caledonia",
        "NZ" => "New Zealand",
        "NI" => "Nicaragua",
        "NE" => "Niger",
        "NG" => "Nigeria",
        "NU" => "Niue",
        "NF" => "Norfolk Island",
        "MP" => "Northern Mariana Islands",
        "NO" => "Norway",
        "OM" => "Oman",
        "PK" => "Pakistan",
        "PW" => "Palau",
        "PS" => "Palestinian Territory, Occupied",
        "PA" => "Panama",
        "PG" => "Papua New Guinea",
        "PY" => "Paraguay",
        "PE" => "Peru",
        "PH" => "Philippines",
        "PN" => "Pitcairn",
        "PL" => "Poland",
        "PT" => "Portugal",
        "PR" => "Puerto Rico",
        "QA" => "Qatar",
        "RE" => "Reunion",
        "RO" => "Romania",
        "RU" => "Russian Federation",
        "RW" => "Rwanda",
        "SH" => "Saint Helena",
        "KN" => "Saint Kitts and Nevis",
        "LC" => "Saint Lucia",
        "PM" => "Saint Pierre and Miquelon",
        "VC" => "Saint Vincent and the Grenadines",
        "WS" => "Samoa",
        "SM" => "San Marino",
        "ST" => "Sao Tome and Principe",
        "SA" => "Saudi Arabia",
        "SN" => "Senegal",
        "CS" => "Serbia and Montenegro",
        "SC" => "Seychelles",
        "SL" => "Sierra Leone",
        "SG" => "Singapore",
        "SK" => "Slovakia",
        "SI" => "Slovenia",
        "SB" => "Solomon Islands",
        "SO" => "Somalia",
        "ZA" => "South Africa",
        "GS" => "South Georgia and the South Sandwich Islands",
        "ES" => "Spain",
        "LK" => "Sri Lanka",
        "SD" => "Sudan",
        "SR" => "Suriname",
        "SJ" => "Svalbard and Jan Mayen",
        "SZ" => "Swaziland",
        "SE" => "Sweden",
        "CH" => "Switzerland",
        "SY" => "Syrian Arab Republic",
        "TW" => "Taiwan, Province of China",
        "TJ" => "Tajikistan",
        "TZ" => "Tanzania, United Republic of",
        "TH" => "Thailand",
        "TL" => "Timor-Leste",
        "TG" => "Togo",
        "TK" => "Tokelau",
        "TO" => "Tonga",
        "TT" => "Trinidad and Tobago",
        "TN" => "Tunisia",
        "TR" => "Turkey",
        "TM" => "Turkmenistan",
        "TC" => "Turks and Caicos Islands",
        "TV" => "Tuvalu",
        "UG" => "Uganda",
        "UA" => "Ukraine",
        "AE" => "United Arab Emirates",
        "GB" => "United Kingdom",
        "UY" => "Uruguay",
        "UZ" => "Uzbekistan",
        "VU" => "Vanuatu",
        "VE" => "Venezuela",
        "VN" => "Viet Nam",
        "VG" => "Virgin Islands, British",
        "VI" => "Virgin Islands, U.s.",
        "WF" => "Wallis and Futuna",
        "EH" => "Western Sahara",
        "YE" => "Yemen",
        "ZM" => "Zambia",
        "ZW" => "Zimbabwe",
    ];

    return $countries;
}
?>