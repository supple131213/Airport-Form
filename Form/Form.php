<?php
/**
 * Plugin Name:       Form
 * Plugin URI:        Form.pk
 * Author:            Bilal
 * Author URI:        https://Form.pk
 * Description:       Form
 * Version:           1.0
 * License:           GPL-2.0-or-later
 */

// Ensure the file is being accessed through WordPress
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

// Enqueue Scripts and Styles
function enqueue_scripts() {
    // Enqueue jQuery UI CSS
    wp_enqueue_style('jquery-ui-css', 'https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css');

    // Enqueue custom CSS for the form
    wp_enqueue_style('custom-style', plugin_dir_url(__FILE__) . 'style.css');

    // Enqueue Google Maps API
    wp_enqueue_script('google-maps-api', 'https://maps.googleapis.com/maps/api/js?key=AIzaSyBX7sZMGGgu5pQOCBoOE3seSRLRgIn49iY&libraries=places', array(), null, true);

    // Enqueue jQuery and jQuery UI
    wp_enqueue_script('jquery');
    wp_enqueue_script('jquery-ui-datepicker');

    // Enqueue custom script to initialize datepicker and any other functionality
    wp_enqueue_script('custom-datepicker', plugin_dir_url(__FILE__) . 'js/custom-datepicker.js', array('jquery', 'jquery-ui-datepicker'), null, true);

    // Enqueue your custom script.js
    wp_enqueue_script('custom-script', plugin_dir_url(__FILE__) . 'script.js', array('jquery'), null, true);
}

add_action('wp_enqueue_scripts', 'enqueue_scripts');

// Create a shortcode to display a custom input field
add_shortcode('hello_world', 'hello_world_function');


function hello_world_function() {
    // Start output buffering
    ob_start();
    ?>
    <form method="post">
        <div class="form-group">
            <label for="kwtab_fieldfilter">Select Services</label>
            <div class="input-group input-sm">
                <span class="input-group-addon">
                    <span class="glyphicon glyphicon-th-list"></span>
                </span>
                <select id="kwtab_fieldfilter" name="custom_input" class="form-control input-sm">
                    <option value="" disabled selected>To Airport</option>
                    <option value="From Airport">From Airport</option>
                    <option value="Airport Roundtrip(To Airport 1st)">Airport Roundtrip(To Airport 1st)</option>
                    <option value="Airport Roundtrip(From Airport 1st)">Airport Roundtrip(From Airport 1st)</option>
                    <option value="One-Way Transfer">One-Way Transfer</option>
                    <option value="Hourly Charter">Hourly Charter</option>
                    <option value="US Bank Stadium Events, (within 30 Miles from the stadium)">US Bank Stadium Events, (within 30 Miles from the stadium)</option>
                </select>
            </div>
        </div>

        <div class="form-group">
            <label for="number_select">Passengers</label>
            <div class="input-group input-sm">
                <span class="input-group-addon">
                    <span class="glyphicon glyphicon-th-list"></span>
                </span>
                <select id="number_select" name="number_of_passengers" class="form-control input-sm">
                    <option value="" disabled selected>Select a number</option>
                    <?php
                    for ($i = 1; $i <= 100; $i++) {
                        echo '<option value="' . esc_attr($i) . '">' . esc_html($i) . '</option>';
                    }
                    ?>
                </select>
            </div>
        </div>

        <div class="form-group">
            <label for="">Pick time </label>
            <input type="text" id="time_input" class="form-control" placeholder="Select Date" readonly>
            <select id="time_input" name="time_input" class="form-control">
                <?php
                $times = [
                    "12:00 AM", "12:15 AM", "12:30 AM", "12:45 AM",
                    "1:00 AM", "1:15 AM", "1:30 AM", "1:45 AM",
                    "2:00 AM", "2:15 AM", "2:30 AM", "2:45 AM",
                    "3:00 AM", "3:15 AM", "3:30 AM", "3:45 AM",
                    "4:00 AM", "4:15 AM", "4:30 AM", "4:45 AM",
                    "5:00 AM", "5:15 AM", "5:30 AM", "5:45 AM",
                    "6:00 AM", "6:15 AM", "6:30 AM", "6:45 AM",
                    "7:00 AM", "7:15 AM", "7:30 AM", "7:45 AM",
                    "8:00 AM", "8:15 AM", "8:30 AM", "8:45 AM",
                    "9:00 AM", "9:15 AM", "9:30 AM", "9:45 AM",
                    "10:00 AM", "10:15 AM", "10:30 AM", "10:45 AM",
                    "11:00 AM", "11:15 AM", "11:30 AM", "11:45 AM",
                    "12:00 PM", "12:15 PM", "12:30 PM", "12:45 PM",
                    "1:00 PM", "1:15 PM", "1:30 PM", "1:45 PM",
                    "2:00 PM", "2:15 PM", "2:30 PM", "2:45 PM",
                    "3:00 PM", "3:15 PM", "3:30 PM", "3:45 PM",
                    "4:00 PM", "4:15 PM", "4:30 PM", "4:45 PM",
                    "5:00 PM", "5:15 PM", "5:30 PM", "5:45 PM",
                    "6:00 PM", "6:15 PM", "6:30 PM", "6:45 PM",
                    "7:00 PM", "7:15 PM", "7:30 PM", "7:45 PM",
                    "8:00 PM", "8:15 PM", "8:30 PM", "8:45 PM",
                    "9:00 PM", "9:15 PM", "9:30 PM", "9:45 PM",
                    "10:00 PM", "10:15 PM", "10:30 PM", "10:45 PM",
                    "11:00 PM", "11:15 PM", "11:30 PM", "11:45 PM"
                ];

                foreach ($times as $time) {
                    echo '<option value="' . esc_attr($time) . '">' . esc_html($time) . '</option>';
                }
                ?>           
            </select>
        </div>
        <div class="container">
        <div>
            <label for="destination-input">Pick At</label>
            <input type="text" id="origin-input" placeholder="Pick a starting location..." autocomplete="off">
            <div id="origin-suggestions" class="suggestions"></div>
        </div>
        <div>
            <label for="destination-input">Drop-off At</label>
             <select id="destination-input">
            <label for="text" id="destination-input" placeholder="Select a destination..." autocomplete="off">
            
                <option value="">Select a destination...</option>
                <option value="Minneapolis-St Paul international/world Chamberlain" data-lat="37.6213" data-lng="-122.3790">Minneapolis-St Paul international/world Chamberlain</option>
                <option value="Range Regional Airport" data-lat="37.6189" data-lng="-122.3751">Range Regional Airport</option>
                <option value="Rochester International Airport" data-lat="37.6211" data-lng="-122.3713">Rochester International Airport</option>
                <option value="St Cloud Regional Airport" data-lat="37.6173" data-lng="-122.3760">St Cloud Regional Airport</option>
                <option value="St paul Downtown Holman Field " data-lat="37.6150" data-lng="-122.3700">St paul Downtown Holman Field </option>
                <option value="Flying Cloud Airport" data-lat="37.6221" data-lng="-122.3731">Flying Cloud Airport</option>
            </select>
        </div><br>
        <div id="map" class="map" style="width: 600px; height: 400px;"></div>
        <div id="distance" class="distance"></div>
    </div>
        
        <br><input type="submit" value="Submit" class="btn btn-primary" />
    </form>
    <?php
    return ob_get_clean(); // Return the buffered output
}
?>
