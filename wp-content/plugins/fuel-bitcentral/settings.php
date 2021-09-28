<?php

function fuel_bitcentral_settings_page() {
    ?>
    <style>
    .facebook-enable{ display: none; }
    </style>
    <div class="wrap">
     
        <div id="icon-themes" class="icon32"></div>
        <h2>Fuel Settings</h2>
    
        <h2 class="nav-tab-wrapper">
            <a href="?page=fuel" class="nav-tab">Fuel Setting</a>            
            <a href="?page=fuel&tab=fule_share_options" class="nav-tab">Share Options</a>            
        </h2>
        
        <form method="post" action="options.php">
            <?php if(isset($_GET['tab']) == 'fule_share_options' ) : ?>
            <?php settings_fields('fuel-share-options'); ?>
            <?php do_settings_sections('fuel-share-options'); ?>
                <table class="form-table">
                    <tr valign="top">
                        <th scope="row"><label for="fuel_player_share_option">Share Option</label></th>
                        <td>
                            <select name="fuel_player_share_option" id="fuel_player_share_option">       
                                <option value="enable" <?php echo get_option('fuel_player_share_option') == 'enable' ? 'selected="selected"' : ''; ?>>Enable</option>                           
                                <option value="disable" <?php echo get_option('fuel_player_share_option') == 'disable' ? 'selected="selected"' : ''; ?>>Disable</option>                                
                            </select>                       
                        </td>
                    </tr>
                    <tr valign="top">
                        <th scope="row"><label for="fuel_player_embed_option">Embed Option</label></th>
                        <td>
                            <select name="fuel_player_embed_option" id="fuel_player_embed_option">                      
                                <option value="enable" <?php echo get_option('fuel_player_embed_option') == 'enable' ? 'selected="selected"' : ''; ?>>Enable</option>                           
                                <option value="disable" <?php echo get_option('fuel_player_embed_option') == 'disable' ? 'selected="selected"' : ''; ?>>Disable</option>                                
                            </select>                       
                        </td>
                    </tr>
                    <!-- Facebook -->
                    <tr valign="top">
                        <th scope="row"><label for="fuel_player_social_option">Social Option</label></th>
                        <td>
                            <select name="fuel_player_social_option" id="fuel_player_share_option">       
                                <option value="enable" <?php echo get_option('fuel_player_social_option') == 'enable' ? 'selected="selected"' : ''; ?>>Enable</option>                           
                                <option value="disable" <?php echo get_option('fuel_player_social_option') == 'disable' ? 'selected="selected"' : ''; ?>>Disable</option>                                
                            </select>                       
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">Facebook</th>
                        <td>
                            <fieldset>
                                <label for="fuel_player_enable_facebook">
                                <input name="fuel_player_enable_facebook" type="checkbox" id="fuel_player_enable_facebook" value="1" <?php checked( get_option('fuel_player_enable_facebook'), 1 ); ?> />
                                    Enable Facebook
                                </label>
                            </fieldset>
                        </td>
                    </tr>
                    <tr style="display: none !important;" class="facebook-enable" <?php if( get_option('fuel_player_enable_facebook') == 1 ){echo 'style="display: table-row;"'; } ?>>
                        <th scope="row"><label for="fuel_player_enable_facebook_app_id">Facebook App ID</label></th>
                        <td>
                            <input type="text" value="<?php echo get_option('fuel_player_enable_facebook_app_id'); ?>" name="fuel_player_enable_facebook_app_id" id="fuel_player_enable_facebook_app_id" placeholder="Insert Your Facebook App ID" class="regular-text"/>                                             
                        </td>
                    </tr>
                    <tr style="display: none !important;" class="facebook-enable" <?php if( get_option('fuel_player_enable_facebook') == 1 ){echo 'style="display: table-row;"'; } ?>>
                        <th scope="row"><label for="fuel_player_enable_facebook_app_secret">Facebook App Secret</label></th>
                        <td>
                            <input type="text" value="<?php echo get_option('fuel_player_enable_facebook_app_secret'); ?>" name="fuel_player_enable_facebook_app_secret" id="fuel_player_enable_facebook_app_secret" placeholder="Insert Your Facebook App Secret" class="regular-text"/>                                             
                        </td>
                    </tr>
                    <!-- Twitter -->
                    <tr>
                        <th scope="row">Twitter</th>
                        <td>
                            <fieldset>
                                <label for="fuel_player_enable_twitter">
                                <input name="fuel_player_enable_twitter" type="checkbox" id="fuel_player_enable_twitter" value="1" <?php checked( get_option('fuel_player_enable_twitter'), 1 ); ?> />
                                    Enable Twitter
                                </label>
                            </fieldset>
                        </td>
                    </tr>
                    <!-- LinkedIn -->
                    <tr>
                        <th scope="row">LinkedIn</th>
                        <td>
                            <fieldset>
                                <label for="fuel_player_enable_linkedIn">
                                <input name="fuel_player_enable_linkedIn" type="checkbox" id="fuel_player_enable_linkedIn" value="1" <?php checked( get_option('fuel_player_enable_linkedIn'), 1 ); ?> />
                                    Enable LinkedIn
                                </label>
                            </fieldset>
                        </td>
                    </tr>
                    <!-- Email -->
                    <tr>
                        <th scope="row">Email</th>
                        <td>
                            <fieldset>
                                <label for="fuel_player_enable_email">
                                <input name="fuel_player_enable_email" type="checkbox" id="fuel_player_enable_email" value="1" <?php checked( get_option('fuel_player_enable_email'), 1 ); ?> />
                                    Enable Email
                                </label>
                            </fieldset>
                        </td>
                    </tr>
                </table>
                <script>
                jQuery(document).ready(function () {
                    jQuery('#fuel_player_enable_facebook').click(function () {
                        if (jQuery(this).prop("checked") == true) {                            
                        }else{
                            jQuery( '.facebook-enable' ).css( 'display', 'none' );
                        }
                    });
                });
                </script>
            <?php else : ?>
                <?php settings_fields('fuel-options-group'); ?>
                <?php do_settings_sections('fuel-options-group'); ?>
                
                    <p>Setting Player Autoplay Control to <b>OFF</b> will turn the MUTE function OFF as well. This means the video will have audio when the user clicks play.</p>
                    <p>Setting Autoplay Control to <b>On</b> turns the MUTE function ON. The video will play on load and audio will be off.</p>
                
                <table class="form-table">       
                    <tr valign="top">
                        <th scope="row"><label for="fuel_player_title_position_option">Title Position</label></th>
                        <td>
                            <select name="fuel_player_title_position_option" id="fuel_player_share_option">       
                                <option value="top" <?php echo get_option('fuel_player_title_position_option') == 'top' ? 'selected="selected"' : ''; ?>>Above The Player</option>                           
                                <option value="bottom" <?php echo get_option('fuel_player_title_position_option') == 'bottom' ? 'selected="selected"' : ''; ?>>Below The Player</option>                                
                            </select>                       
                        </td>
                    </tr>
                    <tr valign="top">
                        <th scope="row"><label for="fuel_tiles_heading_option">Tiles Heading Option</label></th>
                        <td>
                            <select name="fuel_tiles_heading_option" id="fuel_tiles_heading_option">
                                <option value="show_lm" <?php echo get_option('fuel_tiles_heading_option') == 'show_lm' ? 'selected="selected"' : ''; ?>>Show Limited Heading</option>                                                           
                                <option value="show_full" <?php echo get_option('fuel_tiles_heading_option') == 'show_full' ? 'selected="selected"' : ''; ?>>Show Full Heading</option>                                                                
                            </select>                       
                        </td>
                    </tr>
                    <tr valign="top">
                        <th scope="row"><label for="fuel_tiles_category_option">Category On Tiles</label></th>
                        <td>
                            <select name="fuel_tiles_category_option" id="fuel_tiles_category_option">                                       
                                <option value="on" <?php echo get_option('fuel_tiles_category_option') == 'on' ? 'selected="selected"' : ''; ?>>On</option> 
                                <option value="off" <?php echo get_option('fuel_tiles_category_option') == 'off' ? 'selected="selected"' : ''; ?>>Off</option>                                
                            </select>                       
                        </td>
                    </tr>
                    <tr valign="top">
                        <th scope="row"><label for="fuel_tiles_script_category_option">Category On Script Tiles</label></th>
                        <td>
                            <select name="fuel_tiles_script_category_option" id="fuel_tiles_script_category_option">     
                                <option value="off" <?php echo get_option('fuel_tiles_script_category_option') == 'off' ? 'selected="selected"' : ''; ?>>Off</option>
                                <option value="on" <?php echo get_option('fuel_tiles_script_category_option') == 'on' ? 'selected="selected"' : ''; ?>>On</option>                                                                 
                            </select>                       
                        </td>
                    </tr>
                    <tr valign="top">
                        <th scope="row"><label for="fuel_player_tag_option">Tags</label></th>
                        <td>
                            <select name="fuel_player_tag_option" id="fuel_player_tag_option">       
                                <option value="off" <?php echo get_option('fuel_player_tag_option') == 'off' ? 'selected="selected"' : ''; ?>>Off</option>                                
                                <option value="on" <?php echo get_option('fuel_player_tag_option') == 'on' ? 'selected="selected"' : ''; ?>>On</option>                                                           
                            </select>                       
                        </td>
                    </tr>
                    <tr>
                        <th scope="row"><label for="fuel_player_autoplay_control">Player Autoplay Control</label></th>
                        <td>
                            <select name="fuel_player_autoplay_control" id="fuel_player_autoplay_control">                            
                                <option value="off" <?php echo get_option('fuel_player_autoplay_control') == 'off' ? 'selected="selected"' : ''; ?>>Off</option>
                                <option value="on" <?php echo get_option('fuel_player_autoplay_control') == 'on' ? 'selected="selected"' : ''; ?>>On</option>
                            </select>                       
                        </td>
                    </tr>
                    <tr valign="top">
                        <th scope="row"><label for="fuel_player_floating_option">Floating Option</label></th>
                        <td>
                            <select name="fuel_player_floating_option" id="fuel_player_floating_option">                      
                                <option value="disable" <?php echo get_option('fuel_player_floating_option') == 'disable' ? 'selected="selected"' : ''; ?>>Disable</option>
                                <option value="enable" <?php echo get_option('fuel_player_floating_option') == 'enable' ? 'selected="selected"' : ''; ?>>Enable</option>                           
                            </select>                       
                        </td>
                    </tr>                    
                    <?php do_action( 'fuel_bitcentral_preroll_addon_fields' ); ?>                    
                </table>
            <?php endif; ?>
            <?php submit_button(); ?>
        </form>        
    </div>
    <?php
}

function fuel_bitcentral_register_settings() {
    register_setting('fuel-options-group', 'fuel_player_audio_control');
    register_setting('fuel-options-group', 'fuel_tiles_heading_option');
    register_setting('fuel-options-group', 'fuel_tiles_category_option');
    register_setting('fuel-options-group', 'fuel_tiles_script_category_option');
    register_setting('fuel-options-group', 'fuel_player_tag_option');
    register_setting('fuel-options-group', 'fuel_player_title_position_option');
    register_setting('fuel-options-group', 'fuel_player_autoplay_control');    
    register_setting('fuel-options-group', 'fuel_player_floating_option');
    // Social Settings
    
    register_setting('fuel-share-options', 'fuel_player_share_option');
    register_setting('fuel-share-options', 'fuel_player_embed_option');
    register_setting('fuel-share-options', 'fuel_player_social_option');
    register_setting('fuel-share-options', 'fuel_player_enable_facebook');
    register_setting('fuel-share-options', 'fuel_player_enable_facebook_app_id');
    register_setting('fuel-share-options', 'fuel_player_enable_facebook_app_secret');
    register_setting('fuel-share-options', 'fuel_player_enable_twitter');
    register_setting('fuel-share-options', 'fuel_player_enable_linkedIn');
    register_setting('fuel-share-options', 'fuel_player_enable_email');
}

add_action('admin_init', 'fuel_bitcentral_register_settings');
