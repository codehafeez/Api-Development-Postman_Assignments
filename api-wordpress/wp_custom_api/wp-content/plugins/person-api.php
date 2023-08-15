<?php
/*
Plugin Name: Person API Plugin
Description: Provides a REST API for managing person records.
Version: 1.0
*/

// Create the database table
function create_persons_table() {
    global $wpdb;
    $table_name = $wpdb->prefix . 'persons';

    $sql = "CREATE TABLE IF NOT EXISTS $table_name (
        id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(100) NOT NULL,
        age INT NOT NULL,
        gender VARCHAR(10) NOT NULL,
        image VARCHAR(255)
    );";

    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    dbDelta($sql);
}
register_activation_hook(__FILE__, 'create_persons_table');

// Create CRUD API endpoints for persons
add_action('rest_api_init', function () {
    // Get all persons
    register_rest_route('person-api/v1', '/persons', array(
        'methods' => 'GET',
        'callback' => 'get_persons',
    ));

    // Get a specific person
    register_rest_route('person-api/v1', '/persons/(?P<id>\d+)', array(
        'methods' => 'GET',
        'callback' => 'get_person',
    ));

    // Add a new person
    register_rest_route('person-api/v1', '/persons', array(
        'methods' => 'POST',
        'callback' => 'create_person',
    ));

    // Update a person using POST
    register_rest_route('person-api/v1', '/persons/update', array(
        'methods' => 'POST',
        'callback' => 'update_person_post',
    ));

    // Delete a person
    register_rest_route('person-api/v1', '/persons/(?P<id>\d+)', array(
        'methods' => 'DELETE',
        'callback' => 'delete_person',
    ));

    // Find persons by name
    register_rest_route('person-api/v1', '/persons/find/(?P<name>[a-zA-Z]+)', array(
        'methods' => 'GET',
        'callback' => 'find_persons',
    ));
});

// Callback function to get all persons
function get_persons() {
    global $wpdb;
    $table_name = $wpdb->prefix . 'persons';
    $persons = $wpdb->get_results("SELECT * FROM $table_name");
    return $persons;
}

// Callback function to get a person by ID
function get_person($request) {
    global $wpdb;
    $table_name = $wpdb->prefix . 'persons';
    $person_id = $request['id'];
    $person = $wpdb->get_row($wpdb->prepare("SELECT * FROM $table_name WHERE id = %d", $person_id));
    return $person;
}

// Callback function to create a new person with image upload
function create_person($request) {
    global $wpdb;
    $table_name = $wpdb->prefix . 'persons';

    $data = $request->get_params();

    $name = sanitize_text_field($data['name']);
    $age = intval($data['age']);
    $gender = sanitize_text_field($data['gender']);

    // Process file upload if an image is provided
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $file = $_FILES['image'];
        $image_path = wp_upload_dir()['path'] . '/' . $file['name'];
        move_uploaded_file($file['tmp_name'], $image_path);
    }

    $wpdb->insert(
        $table_name,
        array('name' => $name, 'age' => $age, 'gender' => $gender, 'image' => $image_path),
        array('%s', '%d', '%s', '%s')
    );

    return "Person created successfully";
}

// Callback function to update a person using a POST request with image upload
function update_person_post($request) {
    global $wpdb;
    $table_name = $wpdb->prefix . 'persons';

    $data = $request->get_params();

    $person_id = intval($data['id']); // Assuming the 'id' is sent in the request body
    $name = sanitize_text_field($data['name']);
    $age = intval($data['age']);
    $gender = sanitize_text_field($data['gender']);

    // Get the existing image path before potentially updating it
    $existing_person = $wpdb->get_row($wpdb->prepare("SELECT * FROM $table_name WHERE id = %d", $person_id));
    $image_path = $existing_person->image;

    // Process file upload if a new image is provided
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $file = $_FILES['image'];
        $new_image_path = wp_upload_dir()['path'] . '/' . $file['name'];
        move_uploaded_file($file['tmp_name'], $new_image_path);
        
        // Set the new image path
        $image_path = $new_image_path;
    }

    $wpdb->update(
        $table_name,
        array('name' => $name, 'age' => $age, 'gender' => $gender, 'image' => $image_path),
        array('id' => $person_id),
        array('%s', '%d', '%s', '%s'),
        array('%d')
    );

    return "Person updated successfully";
}

// Callback function to delete a person
function delete_person($request) {
    global $wpdb;
    $table_name = $wpdb->prefix . 'persons';

    $person_id = intval($request['id']);

    $wpdb->delete(
        $table_name,
        array('id' => $person_id),
        array('%d')
    );

    return "Person deleted successfully";
}

// Callback function to find persons by name
function find_persons($request) {
    global $wpdb;
    $table_name = $wpdb->prefix . 'persons';

    $name = sanitize_text_field($request['name']);

    $persons = $wpdb->get_results(
        $wpdb->prepare("SELECT * FROM $table_name WHERE name LIKE %s", '%' . $wpdb->esc_like($name) . '%')
    );

    return $persons;
}

// ... Other callback functions ...

// Additional endpoints and callback functions...
