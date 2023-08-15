<?php
/*
Plugin Name: Student API Plugin
Description: Provides a REST API for managing student records.
Version: 1.0
*/

// Create the database table
function create_students_table() {
    global $wpdb;
    $table_name = $wpdb->prefix . 'students';

    $sql = "CREATE TABLE IF NOT EXISTS $table_name (
        id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(100) NOT NULL,
        age INT NOT NULL,
        gender VARCHAR(10) NOT NULL
    );";

    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    dbDelta($sql);
}
register_activation_hook(__FILE__, 'create_students_table');

// Create CRUD API endpoints
add_action('rest_api_init', function () {
    // Get all students
    register_rest_route('student-api/v1', '/students', array(
        'methods' => 'GET',
        'callback' => 'get_students',
    ));

    // Get a specific student
    register_rest_route('student-api/v1', '/students/(?P<id>\d+)', array(
        'methods' => 'GET',
        'callback' => 'get_student',
    ));

    // Add a new student
    register_rest_route('student-api/v1', '/students', array(
        'methods' => 'POST',
        'callback' => 'create_student',
    ));

    // Update a student
    register_rest_route('student-api/v1', '/students/(?P<id>\d+)', array(
        'methods' => 'PUT',
        'callback' => 'update_student',
    ));

    // Delete a student
    register_rest_route('student-api/v1', '/students/(?P<id>\d+)', array(
        'methods' => 'DELETE',
        'callback' => 'delete_student',
    ));

    // Find students by name
    register_rest_route('student-api/v1', '/students/find/(?P<name>[a-zA-Z]+)', array(
        'methods' => 'GET',
        'callback' => 'find_students',
    ));
});

// Callback function to get all students
function get_students() {
    global $wpdb;
    $table_name = $wpdb->prefix . 'students';
    $students = $wpdb->get_results("SELECT * FROM $table_name");
    return $students;
}

// Callback function to get a student by ID
function get_student($request) {
    global $wpdb;
    $table_name = $wpdb->prefix . 'students';
    $student_id = $request['id'];
    $student = $wpdb->get_row($wpdb->prepare("SELECT * FROM $table_name WHERE id = %d", $student_id));
    return $student;
}

// Callback function to create a new student
function create_student($request) {
    global $wpdb;
    $table_name = $wpdb->prefix . 'students';

    $data = $request->get_json_params();
    $name = sanitize_text_field($data['name']);
    $age = intval($data['age']);
    $gender = sanitize_text_field($data['gender']);

    $wpdb->insert(
        $table_name,
        array('name' => $name, 'age' => $age, 'gender' => $gender),
        array('%s', '%d', '%s')
    );

    return "Student created successfully";
}

// Callback function to update a student
function update_student($request) {
    global $wpdb;
    $table_name = $wpdb->prefix . 'students';

    $student_id = intval($request['id']);
    $data = $request->get_json_params();
    $name = sanitize_text_field($data['name']);
    $age = intval($data['age']);
    $gender = sanitize_text_field($data['gender']);

    $wpdb->update(
        $table_name,
        array('name' => $name, 'age' => $age, 'gender' => $gender),
        array('id' => $student_id),
        array('%s', '%d', '%s'),
        array('%d')
    );

    return "Student updated successfully";
}

// Callback function to delete a student
function delete_student($request) {
    global $wpdb;
    $table_name = $wpdb->prefix . 'students';

    $student_id = intval($request['id']);

    $wpdb->delete(
        $table_name,
        array('id' => $student_id),
        array('%d')
    );

    return "Student deleted successfully";
}

// Callback function to find students by name
function find_students($request) {
    global $wpdb;
    $table_name = $wpdb->prefix . 'students';

    $name = sanitize_text_field($request['name']);

    $students = $wpdb->get_results(
        $wpdb->prepare("SELECT * FROM $table_name WHERE name LIKE %s", '%' . $wpdb->esc_like($name) . '%')
    );

    return $students;
}
