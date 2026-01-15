<?php
header('Content-Type: application/json');
require_once '../config/database.php';
require_once '../config/functions.php';

$conn = getDBConnection();
$response = ['success' => false, 'message' => ''];

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    $response['message'] = 'Invalid request method';
    echo json_encode($response);
    exit;
}

if (!isset($_FILES['csv_file']) || $_FILES['csv_file']['error'] !== UPLOAD_ERR_OK) {
    $response['message'] = 'Please select a CSV file';
    echo json_encode($response);
    exit;
}

$file = $_FILES['csv_file'];
$fileName = $file['tmp_name'];

// Check file extension
$fileExtension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
if ($fileExtension !== 'csv') {
    $response['message'] = 'Only CSV files are allowed';
    echo json_encode($response);
    exit;
}

// Read CSV file
$handle = fopen($fileName, 'r');
if ($handle === false) {
    $response['message'] = 'Failed to read CSV file';
    echo json_encode($response);
    exit;
}

// Read header row
$headers = fgetcsv($handle);
if ($headers === false) {
    $response['message'] = 'Invalid CSV file format';
    fclose($handle);
    echo json_encode($response);
    exit;
}

// Normalize headers (lowercase, trim)
$headers = array_map('trim', array_map('strtolower', $headers));

$imported = 0;
$skipped = 0;
$errors = [];

$rowNumber = 1;

while (($data = fgetcsv($handle)) !== false) {
    $rowNumber++;
    
    if (count($data) !== count($headers)) {
        $skipped++;
        $errors[] = "Row $rowNumber: Column count mismatch";
        continue;
    }
    
    // Create associative array from CSV row
    $row = array_combine($headers, $data);
    
    // Validate required fields
    if (empty($row['name']) || empty($row['price'])) {
        $skipped++;
        $errors[] = "Row $rowNumber: Missing required fields (name or price)";
        continue;
    }
    
    // Get or create category
    $categoryId = null;
    if (!empty($row['category'])) {
        $categorySlug = generateSlug($row['category']);
        $categoryQuery = "SELECT id FROM categories WHERE slug = ? LIMIT 1";
        $categoryStmt = $conn->prepare($categoryQuery);
        $categoryStmt->bind_param("s", $categorySlug);
        $categoryStmt->execute();
        $categoryResult = $categoryStmt->get_result();
        
        if ($categoryResult->num_rows > 0) {
            $categoryId = $categoryResult->fetch_assoc()['id'];
        } else {
            // Create category
            $categoryInsertQuery = "INSERT INTO categories (name, slug, status) VALUES (?, ?, 'active')";
            $categoryInsertStmt = $conn->prepare($categoryInsertQuery);
            $categoryInsertStmt->bind_param("ss", $row['category'], $categorySlug);
            if ($categoryInsertStmt->execute()) {
                $categoryId = $conn->insert_id;
            }
            $categoryInsertStmt->close();
        }
        $categoryStmt->close();
    }
    
    // Get or create brand
    $brandId = null;
    if (!empty($row['brand'])) {
        $brandSlug = generateSlug($row['brand']);
        $brandQuery = "SELECT id FROM brands WHERE slug = ? LIMIT 1";
        $brandStmt = $conn->prepare($brandQuery);
        $brandStmt->bind_param("s", $brandSlug);
        $brandStmt->execute();
        $brandResult = $brandStmt->get_result();
        
        if ($brandResult->num_rows > 0) {
            $brandId = $brandResult->fetch_assoc()['id'];
        } else {
            // Create brand
            $brandInsertQuery = "INSERT INTO brands (name, slug, status) VALUES (?, ?, 'active')";
            $brandInsertStmt = $conn->prepare($brandInsertQuery);
            $brandInsertStmt->bind_param("ss", $row['brand'], $brandSlug);
            if ($brandInsertStmt->execute()) {
                $brandId = $conn->insert_id;
            }
            $brandInsertStmt->close();
        }
        $brandStmt->close();
    }
    
    // Generate slug if not provided
    $slug = !empty($row['slug']) ? generateSlug($row['slug']) : generateSlug($row['name']) . '-' . rand(1000, 9999);
    
    // Prepare product data
    $name = $row['name'];
    $price = floatval($row['price']);
    $image = !empty($row['image_url']) ? $row['image_url'] : null;
    $description = !empty($row['description']) ? $row['description'] : null;
    $rating = !empty($row['rating']) ? floatval($row['rating']) : 4.5;
    $reviews = !empty($row['reviews']) ? intval($row['reviews']) : 0;
    $status = !empty($row['status']) ? $row['status'] : 'active';
    
    // Insert product
    $insertQuery = "INSERT INTO products (name, slug, price, image, category_id, brand_id, description, rating, reviews, status) 
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $insertStmt = $conn->prepare($insertQuery);
    $insertStmt->bind_param("ssdsiisdis", $name, $slug, $price, $image, $categoryId, $brandId, $description, $rating, $reviews, $status);
    
    if ($insertStmt->execute()) {
        $imported++;
    } else {
        $skipped++;
        $errors[] = "Row $rowNumber: " . $insertStmt->error;
    }
    
    $insertStmt->close();
}

fclose($handle);
$conn->close();

$response['success'] = true;
$response['message'] = "Import completed! Imported: $imported, Skipped: $skipped";
if (!empty($errors)) {
    $response['errors'] = array_slice($errors, 0, 10); // Show first 10 errors
}

echo json_encode($response);
?>
