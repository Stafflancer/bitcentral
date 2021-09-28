<?php
/*
 * Disable ajax on all gravity forms
 */
add_filter('gform_form_args', 'no_ajax_on_all_forms', 10, 1);
function no_ajax_on_all_forms($args)
{
    $args['ajax'] = false;

    return $args;
}

add_filter('gform_akismet_enabled', '__return_false');

/*
 * Pass GF data to NS
 * function added by UJM on 03/28
 */
//add_action( 'gform_after_submission_11', 'post_to_third_party', 10, 2 );
function post_to_third_party($entry, $form)
{
    $NS_states = [
        '0'   => 'Alabama',
        '1'   => 'Alaska',
        '101' => 'Alberta',
        '2'   => 'Arizona',
        '3'   => 'Arkansas',
        '102' => 'British Columbia',
        '4'   => 'California',
        '5'   => 'Colorado',
        '6'   => 'Connecticut',
        '7'   => 'Delaware',
        '8'   => 'District of Columbia',
        '9'   => 'Florida',
        '10'  => 'Georgia',
        '11'  => 'Hawaii',
        '12'  => 'Idaho',
        '13'  => 'Illinois',
        '14'  => 'Indiana',
        '15'  => 'Iowa',
        '16'  => 'Kansas',
        '17'  => 'Kentucky',
        '18'  => 'Louisiana',
        '19'  => 'Maine',
        '103' => 'Manitoba',
        '20'  => 'Maryland',
        '21'  => 'Massachusetts',
        '22'  => 'Michigan',
        '23'  => 'Minnesota',
        '24'  => 'Mississippi',
        '25'  => 'Missouri',
        '26'  => 'Montana',
        '27'  => 'Nebraska',
        '28'  => 'Nevada',
        '104' => 'New Brunswick',
        '29'  => 'New Hampshire',
        '30'  => 'New Jersey',
        '31'  => 'New Mexico',
        '32'  => 'New York',
        '105' => 'Newfoundland',
        '33'  => 'North Carolina',
        '34'  => 'North Dakota',
        '107' => 'Northwest Territories',
        '106' => 'Nova Scotia',
        '108' => 'Nunavut',
        '35'  => 'Ohio',
        '36'  => 'Oklahoma',
        '109' => 'Ontario',
        '37'  => 'Oregon',
        '38'  => 'Pennsylvania',
        '110' => 'Prince Edward Island',
        '39'  => 'Puerto Rico',
        '111' => 'Quebec',
        '40'  => 'Rhode Island',
        '112' => 'Saskatchewan',
        '41'  => 'South Carolina',
        '42'  => 'South Dakota',
        '43'  => 'Tennessee',
        '44'  => 'Texas',
        '45'  => 'Utah',
        '46'  => 'Vermont',
        '47'  => 'Virginia',
        '48'  => 'Washington',
        '49'  => 'West Virginia',
        '50'  => 'Wisconsin',
        '51'  => 'Wyoming',
        '113' => 'Yukon',
        '53'  => 'Armed Forces Americas',
        '52'  => 'Armed Forces Europe',
        '54'  => 'Armed Forces Pacific',
    ];

    $GF_state = rgar($entry, '5');
    $offset   = 0;

    foreach ($NS_states as $k => $v) {
        if ($v == $GF_state) {
            $offset = $k;
        }
    }

    $posturl = 'https://forms.na2.netsuite.com/app/site/crm/externalleadpage.nl/compid.456526/.f?formid=1&h=AACffht_Qulxuhzfo8kYaMTO8p0u8N7WNtE&redirect_count=0&did_javascript_redirect=F';
    $fields  = [
        'companyname' => rgar($entry, '2'),
        'address1'    => rgar($entry, '3'),
        'address2'    => rgar($entry, '4'),
        'state'       => $offset, //rgar( $entry, '5' )
        'zipcode'     => rgar($entry, '12'),
        'email'       => rgar($entry, '8'),
        'phone'       => rgar($entry, '9'),
        'firstname'   => rgar($entry, '10'),
        'lastname'    => rgar($entry, '11'),
        'subsidiary'  => '1',
    ];
    GFCommon::log_debug('gform_after_submission: body => ' . print_r($body, true));

    /*
    $request = new WP_Http();
    #$response = $request->post( $posturl, array( 'body' => $fields ) );
    $response = $request->request( $posturl, array( 'timeout' => '30' , 'method' => 'POST' , 'sslverify' => 'false' , 'body' => $fields ) );
    GFCommon::log_debug( 'gform_after_submission: response => ' . print_r( $response, true ) );
    */

    // Add the data for the POST to URL
    foreach ($fields as $key => $value) {
        $fields_string .= $key . '=' . $value . '&';
    }
    rtrim($fields_string, '&');
    // Open curl connection
    $ch = curl_init();
    // Set the url, number of POST vars, POST data
    curl_setopt($ch, CURLOPT_URL, $posturl);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
    curl_setopt($ch, CURLOPT_TIMEOUT, 30);
    curl_setopt($ch, CURLOPT_POST, count($fields));
    curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
    // Execute post
    $result = curl_exec($ch);
    $info   = curl_getinfo($ch);
    // Close connection
    curl_close($ch);
    GFCommon::log_debug('Custom CURL Status: => ' . print_r($result, true));
    GFCommon::log_debug('Custom CURL Info: => ' . print_r($info, true));
}

/**
 * Write to log
 *
 * @param        $data
 * @param string $label
 * @param string $type
 *
 * @return false|void
 */
function write_to_log($data, $label = '', $type = '')
{
    # server_path/wp-content/uploads
    $upload_dir = wp_get_upload_dir(); // In some instances this the only writable path

    $file = $upload_dir['basedir'] . '/logs/log_' . date("Y-m-d") . '.txt';

    //echo $file;
    $fp = fopen($file, "a+");

    if (!$fp) {
        error_log("Unable to create log file.");

        return false;
    }

    $label = "<strong>[" . date('m-d-Y H:i:s') . "] $label</strong>" . PHP_EOL;

    fwrite($fp, "\n" . PHP_EOL);
    fwrite($fp, $label);
    fwrite($fp, "================================================================================================================================" . PHP_EOL);

    $data = print_r($data, true); //is_array($data) ? print_r($data, true) : $data;
    fwrite($fp, $data . PHP_EOL);

    fwrite($fp, "================================================================================================================================" . PHP_EOL);
    fwrite($fp, "\n\n" . PHP_EOL);

    fclose($fp);
}

/**
 * Main Curl Function
 *
 * @param        $posturl
 * @param        $fields
 * @param string $gformData
 */
function curl_gf_ns($posturl, $fields, $gformData = '')
{
    // Log to Gravity Forms log file
    GFCommon::log_debug('gform_after_submission: body => ' . print_r($body, true));

    // Add the data for the POST to URL
    foreach ($fields as $key => $value) {
        $fields_string .= $key . '=' . $value . '&';
    }
    rtrim($fields_string, '&');
    // Open curl connection
    $ch = curl_init();
    // Set the url, number of POST vars, POST data
    curl_setopt($ch, CURLOPT_URL, $posturl);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
    curl_setopt($ch, CURLOPT_TIMEOUT, 30);
    curl_setopt($ch, CURLOPT_POST, count($fields));
    curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); //make curl_exec return the data instead of outputting it.
    // Execute post
    $result = curl_exec($ch);
    $info   = curl_getinfo($ch);
    // Close connection
    curl_close($ch);

    // Log to Gravity Forms log file
    GFCommon::log_debug('Custom CURL Status: => ' . print_r($result, true));
    GFCommon::log_debug('Custom CURL Info: => ' . print_r($info, true));

    $posted_data = "Posted data:" . PHP_EOL . print_r($fields, true) . PHP_EOL;
    $post_fields = "Post fields:" . PHP_EOL . print_r($fields_string, true) . PHP_EOL;
    $gf_data = "GF Data:" . PHP_EOL .print_r($gformData, true) . PHP_EOL;
    $curl_result = "CURL Result:" . PHP_EOL . print_r($result, true) . PHP_EOL;
    $curl_info = "CURL Info:" . PHP_EOL . print_r($info, true) . PHP_EOL;

    write_to_log($posted_data . $post_fields . $gf_data . $curl_result . $curl_info);
}

/*
================================================
General Inquiries Form
 - English 6
 - Spanish 18
================================================
*/
add_action('gform_after_submission_6', 'gf_to_ns_submit_general', 10, 2);
add_action('gform_after_submission_18', 'gf_to_ns_submit_general', 10, 2);
function gf_to_ns_submit_general($entry, $form)
{
    $checkboxes = [
        '1'  => '4', //Create
        '2'  => '3', //Oasis
        '3'  => '2', //Precis
        '4'  => '11', //Media Encoder
        '5'  => '15', //Central Control
        '6'  => '16', //MultiPath
        '7'  => '', //LearnBitcentral
        '8'  => '17', //FUEL
        '9'  => '14', //Prism
        '11' => '13', //Flight
    ]; //GF_value => NS_value

    $products = [];
    foreach ($checkboxes as $k => $v) {
        $myvar = rgar($entry, '12.' . $k);
        if (!empty($myvar)) {
            $products[] = $v;
        }
    }

    #####
    # Get first value of array
    #####
    if (isset($products) && is_array($products)) {
        reset($products);
        $products = current($products);
    }

    //echo "<pre>";
    //print_r($entry);
    //print_r($products);
    //exit;

    $posturl = 'https://forms.na2.netsuite.com/app/site/crm/externalleadpage.nl/compid.456526/.f?formid=20&h=AACffht_A3YGscYPqZnOO5fuq-lZHUSMLfk&redirect_count=0&did_javascript_redirect=F';
    $fields  = [
        'companyname'                    => rgar($entry, '2'),
        'firstname'                      => rgar($entry, '3'),
        'lastname'                       => rgar($entry, '4'),
        'email'                          => rgar($entry, '7'),
        'phone'                          => rgar($entry, '8'),
        'comments'                       => rgar($entry, '10'),
        'custentityproducts_considering' => $products,
        'subsidiary'                     => '1',
    ];

    curl_gf_ns($posturl, $fields, $entry);
}

/*
================================================
Schedule a Demo Form
 - English 7
 - English Fuel 14
 - Spanish 15
================================================
*/
add_action('gform_after_submission_7', 'gf_to_ns_submit_demo', 10, 2);
add_action('gform_after_submission_14', 'gf_to_ns_submit_demo', 10, 2);
add_action('gform_after_submission_15', 'gf_to_ns_submit_demo', 10, 2);
function gf_to_ns_submit_demo($entry, $form)
{
    $products = '';

    if ($entry['form_id'] != 14) {
        $checkboxes = [
            '1'  => '4', //Create
            '2'  => '3', //Oasis
            '3'  => '2', //Precis
            '4'  => '11', //Media Encoder
            '5'  => '15', //Central Control
            '6'  => '16', //MultiPath
            '7'  => '', //LearnBitcentral
            '8'  => '17', //FUEL
            '9'  => '14', //Prism
            '11' => '13', //Flight
        ]; //GF_value => NS_value

        $products = [];
        foreach ($checkboxes as $k => $v) {
            $myvar = rgar($entry, '12.' . $k);
            if (!empty($myvar)) {
                $products[] = $v;
            }
        }

        #####
        # Get first value of array
        #####
        if (isset($products) && is_array($products)) {
            reset($products);
            $products = current($products);
        }
    }

    /*echo "<pre>";
    print_r($entry);
    print_r($products);
    exit;*/

    $posturl = 'https://456526.extforms.netsuite.com/app/site/crm/externalleadpage.nl/compid.456526/.f?formid=24&h=AAFdikaIClJpOjZdB6Nl002TRnctVpze1jLwGH6rccA4Z3IWEdc&redirect_count=1&did_javascript_redirect=T';
    $fields  = [
        'companyname'                    => rgar($entry, '2'),
        'firstname'                      => rgar($entry, '3'),
        'lastname'                       => rgar($entry, '4'),
        'email'                          => rgar($entry, '7'),
        'phone'                          => rgar($entry, '8'),
        'comments'                       => rgar($entry, '10'),
        'custentityproducts_considering' => $products,
        'custentity_websitesource'       => rgar($entry, '14'),
        'subsidiary'                     => '1',
    ];

    curl_gf_ns($posturl, $fields, $entry);
}

/*
================================================
Sales Inquiry Form
 - English 8
 - Spanish 20
================================================
*/
add_action('gform_after_submission_8', 'gf_to_ns_submit_sales', 10, 2);
add_action('gform_after_submission_20', 'gf_to_ns_submit_sales', 10, 2);
function gf_to_ns_submit_sales($entry, $form)
{
    $checkboxes = [
        '1'  => '4', //Create
        '2'  => '3', //Oasis
        '3'  => '2', //Precis
        '4'  => '11', //Media Encoder
        '5'  => '15', //Central Control
        '6'  => '16', //MultiPath
        '7'  => '', //LearnBitcentral
        '8'  => '17', //FUEL
        '9'  => '14', //Prism
        '11' => '13', //Flight
    ]; //GF_value => NS_value

    $products = [];
    foreach ($checkboxes as $k => $v) {
        $myvar = rgar($entry, '12.' . $k);
        if (!empty($myvar)) {
            $products[] = $v;
        }
    }

    #####
    # Get first value of array
    #####
    if (isset($products) && is_array($products)) {
        reset($products);
        $products = current($products);
    }

    /*echo "<pre>";
    print_r($entry);
    print_r($products);
    exit;*/

    $posturl = 'https://forms.na2.netsuite.com/app/site/crm/externalleadpage.nl/compid.456526/.f?formid=21&h=AACffht_ep_e_lPYqBacl7dMFQVACcNiVjY&redirect_count=0&did_javascript_redirect=F';
    $fields  = [
        'companyname'                    => rgar($entry, '2'),
        'firstname'                      => rgar($entry, '3'),
        'lastname'                       => rgar($entry, '4'),
        'email'                          => rgar($entry, '7'),
        'phone'                          => rgar($entry, '8'),
        'comments'                       => rgar($entry, '10'),
        'custentityproducts_considering' => $products,
        'subsidiary'                     => '1',
    ];

    curl_gf_ns($posturl, $fields, $entry);
}

/*
================================================
Contact Support Form
 - English 9
 - Spanish 16
================================================
*/
add_action('gform_after_submission_9', 'gf_to_ns_submit_support', 10, 2);
add_action('gform_after_submission_16', 'gf_to_ns_submit_support', 10, 2);
function gf_to_ns_submit_support($entry, $form)
{
    // dropdown
    $NS_states = [
        '28' => 'Bitsocial',
        '37' => 'Central Control',
        '42' => 'CNN Portal',
        '51' => 'Core App',
        '46' => 'CORE Client',
        '44' => 'CORE News',
        '41' => 'CORE Select',
        '18' => 'Create',
        '32' => 'Eagleye',
        '21' => 'Enhanced Media Encoder',
        '53' => 'Fuel',
        '45' => 'LearnBitcentral',
        '33' => 'ME-Router',
        '7'  => 'Media Encoder',
        '49' => 'MultiPath',
        '38' => 'Neighborhood',
        '43' => 'Newsource',
        '26' => 'NLE Plug-in',
        '35' => 'NRCS ActiveX Plugin',
        '34' => 'NRCS Gateway',
        '23' => 'Oasis',
        '50' => 'On Air Monitor',
        '25' => 'Other',
        '22' => 'Precis',
        '29' => 'Prime',
        '54' => 'Prism',
        '52' => 'Ross Inception NRCS integration',
        '30' => 'Scheduler',
        '47' => 'Transfer App',
        '31' => 'Wellspring',
        '39' => 'Workflow',
    ];

    $GF_state = rgar($entry, '15');
    $offset   = 25;

    foreach ($NS_states as $k => $v) {
        if ($v == $GF_state) {
            $offset = $k;
        }
    }

    #####
    # Get first value of array
    #####
    if (isset($offset) && is_array($offset)) {
        reset($offset);
        $offset = current($offset);
    }

    //echo "<pre>";
    //print_r($entry);
    //print_r($products);
    //exit;

    $posturl = 'https://forms.na2.netsuite.com/app/site/crm/externalcasepage.nl/compid.456526/.f?formid=3&h=AACffht_L2UPlrgpJsAE-Z3mN55hWJNha2M&redirect_count=0&did_javascript_redirect=F';
    $fields  = [
        'title'                       => rgar($entry, '16'),
        'companyname'                 => rgar($entry, '2'),
        'firstname'                   => rgar($entry, '3'),
        'lastname'                    => rgar($entry, '4'),
        'email'                       => rgar($entry, '7'),
        'phone'                       => rgar($entry, '8'),
        'incomingmessage'             => rgar($entry, '10'),
        'custevent_productonlineform' => $offset,
        'subsidiary'                  => '1',
    ];

    curl_gf_ns($posturl, $fields, $entry);
}

/*
================================================
Download resource Form
 - English 10
 - Spanish 17
================================================
*/
add_action('gform_after_submission_10', 'gf_to_ns_submit_download_resource', 10, 2);
add_action('gform_after_submission_17', 'gf_to_ns_submit_download_resource', 10, 2);
function gf_to_ns_submit_download_resource($entry, $form)
{
    /*echo "<pre>";
    print_r($form);
    echo '<br>+++++++++++++++<br>';
    print_r($entry); exit;*/

    //dropdown
    $NS_states = [
        '14' => 'prism-2018',
        '17' => 'fuel-2019',
        '2'  => 'precis',
        '3'  => 'oasis',
        '1'  => 'core-news',
        '15' => 'central-control',
        '16' => 'multipath',
        '3'  => 'oasis-white-paper',
    ];

    $GF_state = rgar($entry, '19');
    $offset   = '';

    foreach ($NS_states as $k => $v) {
        if ($v == $GF_state) {
            $offset = $k;
        }
    }

    #####
    # Get first value of array
    #####
    if (isset($offset) && is_array($offset)) {
        reset($offset);
        $offset = current($offset);
    }

    $posturl = 'https://forms.na2.netsuite.com/app/site/crm/externalleadpage.nl/compid.456526/.f?formid=17&h=AACffht_MNU2SELI4AntvLNTQWR6IS1uyqU&redirect_count=0&did_javascript_redirect=F';
    $fields  = [
        'firstname'                      => rgar($entry, '3'),
        'lastname'                       => rgar($entry, '4'),
        'email'                          => rgar($entry, '7'),
        'title'                          => rgar($entry, '9'),
        'companyname'                    => rgar($entry, '2'),
        'country'                        => rgar($entry, '17'),
        'custentityproducts_considering' => $offset,
        'subsidiary'                     => '1',
    ];

    curl_gf_ns($posturl, $fields, $entry);
}

/*
================================================
Lead Form
 - English 11
================================================
*/
add_action('gform_after_submission_11', 'gf_to_ns_submit_lead', 10, 2);
function gf_to_ns_submit_lead($entry, $form)
{
    // dropdown
    $NS_states = [
        '0'   => 'Alabama',
        '1'   => 'Alaska',
        '101' => 'Alberta',
        '2'   => 'Arizona',
        '3'   => 'Arkansas',
        '102' => 'British Columbia',
        '4'   => 'California',
        '5'   => 'Colorado',
        '6'   => 'Connecticut',
        '7'   => 'Delaware',
        '8'   => 'District of Columbia',
        '9'   => 'Florida',
        '10'  => 'Georgia',
        '11'  => 'Hawaii',
        '12'  => 'Idaho',
        '13'  => 'Illinois',
        '14'  => 'Indiana',
        '15'  => 'Iowa',
        '16'  => 'Kansas',
        '17'  => 'Kentucky',
        '18'  => 'Louisiana',
        '19'  => 'Maine',
        '103' => 'Manitoba',
        '20'  => 'Maryland',
        '21'  => 'Massachusetts',
        '22'  => 'Michigan',
        '23'  => 'Minnesota',
        '24'  => 'Mississippi',
        '25'  => 'Missouri',
        '26'  => 'Montana',
        '27'  => 'Nebraska',
        '28'  => 'Nevada',
        '104' => 'New Brunswick',
        '29'  => 'New Hampshire',
        '30'  => 'New Jersey',
        '31'  => 'New Mexico',
        '32'  => 'New York',
        '105' => 'Newfoundland',
        '33'  => 'North Carolina',
        '34'  => 'North Dakota',
        '107' => 'Northwest Territories',
        '106' => 'Nova Scotia',
        '108' => 'Nunavut',
        '35'  => 'Ohio',
        '36'  => 'Oklahoma',
        '109' => 'Ontario',
        '37'  => 'Oregon',
        '38'  => 'Pennsylvania',
        '110' => 'Prince Edward Island',
        '39'  => 'Puerto Rico',
        '111' => 'Quebec',
        '40'  => 'Rhode Island',
        '112' => 'Saskatchewan',
        '41'  => 'South Carolina',
        '42'  => 'South Dakota',
        '43'  => 'Tennessee',
        '44'  => 'Texas',
        '45'  => 'Utah',
        '46'  => 'Vermont',
        '47'  => 'Virginia',
        '48'  => 'Washington',
        '49'  => 'West Virginia',
        '50'  => 'Wisconsin',
        '51'  => 'Wyoming',
        '113' => 'Yukon',
        '53'  => 'Armed Forces Americas',
        '52'  => 'Armed Forces Europe',
        '54'  => 'Armed Forces Pacific',
    ];
    $GF_state  = rgar($entry, '5');
    $offset    = 0;

    foreach ($NS_states as $k => $v) {
        if ($v == $GF_state) {
            $offset = $k;
        }
    }

    //echo "<pre>";
    //print_r($entry);
    //print_r($products);
    //exit;

    $posturl = 'https://forms.na2.netsuite.com/app/site/crm/externalleadpage.nl/compid.456526/.f?formid=1&h=AACffht_Qulxuhzfo8kYaMTO8p0u8N7WNtE&redirect_count=0&did_javascript_redirect=F';
    $fields  = [
        'companyname' => rgar($entry, '2'),
        'address1'    => rgar($entry, '3'),
        'address2'    => rgar($entry, '4'),
        'state'       => $offset, //rgar( $entry, '5' )
        'zipcode'     => rgar($entry, '12'),
        'email'       => rgar($entry, '8'),
        'phone'       => rgar($entry, '9'),
        'firstname'   => rgar($entry, '10'),
        'lastname'    => rgar($entry, '11'),
        'subsidiary'  => '1',
    ];

    curl_gf_ns($posturl, $fields, $entry);
}