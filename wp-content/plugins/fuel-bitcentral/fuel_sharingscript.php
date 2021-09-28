<?php

function fuel_bitcentral_script_listing() {
    global $wpdb;
    if (isset($_GET['type']) && $_GET['type'] == 'add_script') {
        fuel_bitcentral_add_script_listing();
    } else {
        if (isset($_POST['del_id'])) {
            global $wpdb;
            $id = $_POST['del_id'];
            $table = $wpdb->prefix . 'fuel_script';
            $wpdb->delete($table, array('id' => $id));
            $_SESSION['success_delete'] = 'delete';
        }
        if (isset($_SESSION['success_delete'])) {
            ?> 
            <div id="message" class="notice notice-success"> <p><strong>Delete Successfully.</strong></p> </div>
            <?php
            unset($_SESSION["success_delete"]);
        }
        ?>
        <div class="wrap">
            <style>
                .code_parent{padding: 10px;background:#e9e9e9;border-radius: 10px;border: solid black 1px;}
            </style>
            <h1 style="margin-bottom: 20px;"><?php _e('Fuel Scripts', 'textdomain'); ?></h1>
            <?php
            if (!isset($_GET['view'])) {
                ?>
                <?php
                $scripts = $wpdb->get_results("SELECT * FROM " . $wpdb->prefix . "fuel_script");
                ?>
                <a href="edit.php?post_type=fuel&page=fuel_script&type=add_script" class="button button-primary button-large" style="margin-bottom: 10px;">Add New Script</a>

                <table class="wp-list-table widefat fixed striped tags main_tab_set">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th scope="col" id="name" class="manage-column column-name column-primary sortable desc">
                                <span>Title</span>
                            </th>
                            <th scope="col" id="categories" class="manage-column column-slug sortable desc">
                                <span>Categories</span>
                            </th>
                            <th scope="col" id="categories" class="manage-column column-slug sortable desc">
                                <span>Count</span>
                            </th>
                            <th scope="col" id="slug" class="manage-column column-slug sortable desc">
                                <span>Action</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody id="the-list" data-wp-lists="list:tag">
                        <?php
                        $a = 1;
                        foreach ($scripts as $script) {
                            $cats = json_decode($script->categories);
                            $cats_byName = array();
                            if (!empty($cats)) {
                                foreach ($cats as $cat) {
                                    $cats_byName[] = get_term_by('id', $cat, 'fuel_category')->name;
                                }
                            }
                            $count = $script->count;
                            if (empty($count)) {
                                $total_tiel = 20;
                            } else {
                                $total_tiel = $count;
                            }
                            ?>
                        <form action="" method="post">
                            <tr class="level-0">
                                <td class="padd_left" width="5%">
                                    <?php echo $a; ?>
                                </td>
                                <td>
                                    <?php echo $script->title; ?>
                                </td>
                                <td><?php echo implode(', ', $cats_byName); ?></td>
                                <td><?php echo $total_tiel; ?></td>
                                <td>
                                    <span> <a href="edit.php?post_type=fuel&page=fuel_script&view=<?php echo $script->id; ?>">View</a> /<input onclick="return confirm('Are you sure?')" class="input_style" type="submit" name="delete" value="Delete"> </span>
                                    <input  type="hidden" name="del_id" value="<?php echo $script->id; ?>">
                                </td>
                            </tr>
                        </form>
                        <?php
                        ++$a;
                    }
                    ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>ID</th>
                            <th scope="col" id="name" class="manage-column column-name column-primary sortable desc">
                                <span>Title</span>
                            </th>
                            <th scope="col" id="categories" class="manage-column column-slug sortable desc">
                                <span>Categories</span>
                            </th>
                            <th scope="col" id="categories" class="manage-column column-slug sortable desc">
                                <span>Count</span>
                            </th>
                            <th scope="col" id="slug" class="manage-column column-slug sortable desc">
                                <span>Action</span>
                            </th>
                        </tr>
                    </tfoot>
                </table>
                <?php
                $script_style_success = '';
                $loadcontent = plugin_dir_path(__FILE__)."assets/css/fuel-share.css"; 
                if(isset($_POST['update_fuelshare_file']) && isset($_POST['fuel_share_styles'])) {
                    $savecontent = stripslashes($_POST['fuel_share_styles']);
                    $fp = @fopen($loadcontent, "w");
                    if ($fp) {
                        fwrite($fp, $savecontent);
                        fclose($fp);
                    }
                    $script_style_success = 'Script css has been updated';
                }           
                $fp = @fopen($loadcontent, "r");
                $loadcontent = fread($fp, filesize($loadcontent));
                $loadcontent = htmlspecialchars($loadcontent);
                fclose($fp);
                ?>  
                <?php if($script_style_success) : ?>
                <div id="message" class="notice notice-success"> <p><strong><?php echo $script_style_success; ?></strong></p> </div>
                <?php endif; ?>
                <div style="margin-top: 30px;">
                <form method=post action="">
                    <textarea name="fuel_share_styles" style="width: 100%" rows="15"><?php echo $loadcontent; ?></textarea>
                <br>
                <input type="submit" class="button button-primary button-large" style="float: right;" name="update_fuelshare_file" value="Update">  
                </form>
            </div>
                <style type="text/css">
                    .input_style{background: transparent;box-shadow: none;border: 0px;cursor: pointer;color: #007d7f;margin-right: 0px;}
                    .main_tab_set form th{padding-left: 0px;}
                    .main_tab_set th .input_style{margin-left: 0px !important;}
                    .main_tab_set td{padding-left: 0px;}
                    .main_tab_set .padd_left{padding-left: 8px;}
                </style>
                <?php
            } else {
                if (isset($_GET['view']) && $_GET['view'] != '') {
                    global $wpdb;

                    $script_ID = $_GET['view'];
                    $result = $wpdb->get_row("SELECT * FROM " . $wpdb->prefix . "fuel_script WHERE id='" . $script_ID . "'");
                    $fuel_count = $result->count;
                    if (empty($fuel_count)) {
                        $count = 20;
                    } else {
                        $count = $fuel_count;
                    }
                    $home_url = site_url('/wp-admin/admin-ajax.php?code=' . $result->code . '&action=fuel_sharing_script&count=' . $count . '');
                    $random_div_number = rand(9999, 7777);
                    echo '<div class="code_parent">
<xmp><div id="fuel_content_'.$random_div_number.'"></div>
<script>
const url_'.$random_div_number.' = "' . $home_url . '";
const myFuelHeaders_'.$random_div_number.' = new Headers();
document.getElementById("fuel_content_'.$random_div_number.'").innerHTML = "<h5>Loading content..</h5>";
const othrPram_'.$random_div_number.'={ headers:myFuelHeaders_'.$random_div_number.', method:"GET", };
fetch(url_'.$random_div_number.', othrPram_'.$random_div_number.')
.then((data) => { return data.json() })
.then((res) => { if(res.html != "")  document.getElementById("fuel_content_'.$random_div_number.'").innerHTML = res.html; });</script></xmp></div>';
                }
                ?> 
                <p>Copy this script and paste in your html body.</p>
                <a href="edit.php?post_type=fuel&page=fuel_script" class="button button-primary button-large" id="publish">
                    Go Back
                </a>
            <?php } ?>
        </div>
        <?php
    }
}

function fuel_bitcentral_send_response() {
    header('Access-Control-Allow-Origin: *');
    if ($_GET) {
        if (isset($_GET['code'])) {
            global $wpdb;

            $code = sanitize_key($_GET['code']);
            $count = $_GET['count'];
            $table_name = $wpdb->prefix . 'fuel_script';
            $result = $wpdb->get_row("SELECT * FROM " . $table_name . " WHERE code='" . $code . "'");
            $cats = json_decode($result->categories);
            if ($code == $result->code) {
                // The Query
                $args = array('post_type' => 'fuel', 'posts_per_page' => $count,
                    'tax_query' => array(
                        'relation' => 'AND',
                        array(
                            'taxonomy' => 'fuel_category',
                            'field' => 'id',
                            'terms' => $cats,
                            'include_children' => false,
                            'operator' => 'IN'
                        ),
                    )
                );
                $the_query = new WP_Query($args);

                // -The Loop
                $html = '<link rel="stylesheet" href="' . FUEL_BITCENTRAL_PLUGIN_ROOT_URL . 'assets/css/fuel-share.css" />';

                if ($the_query->have_posts()) {
                    $html .= '<ul class = "fuel-related-tiles-ul-share">';
                    while ($the_query->have_posts()) {
                        $the_query->the_post();
                        $fuel_post_data = fuel_bitcentral_get_fuel_postdata(get_the_ID());
                        $fuel_category = get_the_terms(get_the_ID(), 'fuel_category');
                        $fuel_cat_url = get_term_link($fuel_category[0]->term_id, 'fuel_category');
                        $html .= '<li data-tile = "' . get_the_ID() . '" class = "fuel_tile_box-share">';
                        $html .= '<a class = "fuel-related-tile-image-share" href = "' . esc_url($fuel_post_data->url) . '">
                                    <img width = "640" height = "360" alt = "" src = "' . $fuel_post_data->tile_image . '">
                                  </a>';
                        $html .= '<div class = "fuel-related-info-share">';
                        if (fuel_bitcentral_player_settings()->category_script === 'on') {
                            $html .= '<div class = "fuel-category-share"><a href = "' . esc_url($fuel_cat_url.'?site='.  site_url()) . '"><span>' . $fuel_category[0]->name . '</span></a></div>';
                        }                        
                        $html .= '<h3 class = "fuel-title-share" title = "' . $fuel_post_data->title . '"><a href = "' . esc_url($fuel_post_data->url.'?site='.  site_url()) . '">' . $fuel_post_data->title . '</a></h3>'; 
                        $html .= '</div>';
                        $html .= '</li>';
                    }
                    $html .= '</ul>';

                    echo json_encode(array('html' => $html));
                } else {
                    // no posts found
                    echo json_encode(array('html' => 'No posts found.'));
                }
                /* Restore original Post Data */
                wp_reset_postdata();

                wp_die();
            } else {
                echo json_encode(array('html' => 'Invalid script or code'));
            }
        } else {
            echo json_encode(array('html' => 'Invalid script or code'));
        }
    }

    wp_die();
}

add_action('wp_ajax_fuel_sharing_script', 'fuel_bitcentral_send_response');
add_action('wp_ajax_nopriv_fuel_sharing_script', 'fuel_bitcentral_send_response');

function fuel_bitcentral_add_script_listing() {
    $terms = get_terms(array(
        'taxonomy' => 'fuel_category',
        'hide_empty' => false,
    ));
    $error_title = '';
    $error_categories = '';
    if (isset($_POST['create_script'])) {
        $error_set = 0;
        if ($_POST["fuel_title"] == "") {
            $error_title = "Title Required!";
            $error_set = 1;
        } else {
            $title_val = $_POST["fuel_title"];
        }
        if (!isset($_POST["categories"])) {
            $error_categories = "Categories Required!";
            $error_set = 1;
        }
        if ($_POST["fuel_count"] == "") {
            $fuel_count = 20;
        } else {
            $fuel_count = $_POST["fuel_count"];
        }

        if ($error_set == 0) {

            $permitted_chars = 'abcdefghijklmnopqrstuvwxyz123456789';
            $rnd_name = substr(str_shuffle($permitted_chars), 0, 15);
            $categories = json_encode($_POST['categories']);
            $title = $_POST['fuel_title'];

            global $wpdb;
            $table = $wpdb->prefix . 'fuel_script';
            $data = array('title' => $title, 'code' => $rnd_name, 'categories' => $categories, 'count' => $fuel_count);
            $wpdb->insert($table, $data);
            $my_id = $wpdb->insert_id;
            $_SESSION['success_update'] = 'update';
        }
    }
    ?>	
    <div class="wrap main_set_script">
        <?php if (isset($_SESSION['success_update'])) { ?> 
            <div id="message" class="notice notice-success">
                <p><strong>Script has been created.</strong></p>
            </div>
            <script>
                setTimeout(function () {
                    window.location.href = "<?php echo home_url('/wp-admin/edit.php?post_type=fuel&page=fuel_script'); ?>";
                }, 2000);
            </script>
            <?php
            unset($_SESSION["success_update"]);
        }
        ?>
        <h1><?php _e('Add Script', 'textdomain'); ?></h1>
        <form method="POST" action="#">
            <div class="titlewrap">
                <label for="title"><strong>Add Title</strong></label>
                <input class="title_set" value="<?php echo isset($title_val) ? $title_val : ''; ?>" type="text" name="fuel_title" size="30" value="" id="title" spellcheck="true" autocomplete="off" />
            </div>
            <div class="error_err">
                <p>
                    <?php if ($error_title) { ?> 
                        <?php echo $error_title; ?>
                    <?php } ?>
                </p>
            </div>
            <div class="titlewrap">
                <label for="categories"><strong>Select Categories</strong></label>
                <select id="categories" name="categories[]" multiple>
                    <?php foreach ($terms as $term) { ?> 
                        <option value="<?php echo $term->term_id; ?>"><?php echo $term->name; ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="titlewrap">
                <label for="fuel_count"><strong>Tiles Count</strong></label>
                <input class="title_count" value="<?php echo $fuel_count; ?>" type="number" name="fuel_count" value="" id="fuel_count" min="1" step="1" autocomplete="off" required="required" />
            </div>
            <div class="error_err">
                <p>
                    <?php if ($error_categories) { ?> 
                        <?php echo $error_categories; ?>
                    <?php } ?>
                </p>
            </div>
            <input class="button button-primary button-large" type="submit" name="create_script" value="Create Script" />
            <a href="edit.php?post_type=fuel&page=fuel_script" class="button button-primary button-large" >Back to listing</a>
        </form>
    </div>
    <style type="text/css">
        .title_set{
            width: 100%;
        }
        .title_count{
            width: 100px;
        }
        .main_set_script #categories{
            width: 100%;
            margin-bottom: 15px;
            padding-top: 10px;
            padding-bottom: 10px;
            min-height: 194px;
            display: block;
            max-width: initial;
        }
        .main_set_script form{
            width: 50%;
        }
        .error_err p{
            color: #ca0000;
        }	        
    </style>
<?php } ?>