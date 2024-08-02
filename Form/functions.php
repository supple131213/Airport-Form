
/*<?php
/*
// Enqueue Scripts and Styles
function enqueue_scripts() {
    // Enqueue jQuery UI CSS
    wp_enqueue_style('jquery-ui-css', 'https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css');
    
    // Enqueue jQuery and jQuery UI
    wp_enqueue_script('jquery');
    wp_enqueue_script('jquery-ui-datepicker');
    
    // Enqueue custom script to initialize datepicker
    wp_enqueue_script('custom-datepicker', get_template_directory_uri() . '/js/custom-datepicker.js', array('jquery', 'jquery-ui-datepicker'), null, true);
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
            <label for="time_input">Select Date:</label>
            <input type="text" id="time_input" class="form-control" placeholder="Select Date" readonly>
        </div>

        <input type="submit" value="Submit" class="btn btn-primary" />
    </form>
    <?php
    return ob_get_clean(); // Return the buffered output
}
?>

*/