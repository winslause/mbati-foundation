<?php
session_start();
require 'config.php';

// Check if admin is logged in
if (!isset($_SESSION['admin_id'])) {
    header('Location: login.php');
    exit;
}

// Handle logout
if (isset($_GET['logout'])) {
    session_destroy();
    header('Location: login.php');
    exit;
}

// Handle AJAX requests for data
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    header('Content-Type: application/json');

    try {
        switch ($_POST['action']) {
            case 'get_stats':
                // Get dashboard stats
                $stats = [];
                $stats['activities'] = $pdo->query("SELECT COUNT(*) as count FROM activities")->fetch()['count'];
                $stats['donations'] = $pdo->query("SELECT SUM(amount) as total FROM donations WHERE status = 'completed'")->fetch()['total'] ?? 0;
                $stats['donations_this_month'] = $pdo->query("SELECT SUM(amount) as total FROM donations WHERE status = 'completed' AND donation_date >= DATE_FORMAT(NOW(), '%Y-%m-01')")->fetch()['total'] ?? 0;
                $stats['gallery'] = $pdo->query("SELECT COUNT(*) as count FROM gallery")->fetch()['count'];
                $stats['contacts'] = $pdo->query("SELECT COUNT(*) as count FROM contacts WHERE is_read = FALSE")->fetch()['count'];
                echo json_encode($stats);
                break;

            case 'get_activities':
                $stmt = $pdo->query("SELECT a.*, c.name as category_name FROM activities a LEFT JOIN categories c ON a.category_id = c.id ORDER BY a.created_at DESC");
                $activities = $stmt->fetchAll(PDO::FETCH_ASSOC);
                echo json_encode($activities);
                break;

            case 'add_activity':
                // Handle image upload
                $image_path = '';
                if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
                    $upload_dir = 'uploads/activities/';
                    if (!is_dir($upload_dir)) {
                        mkdir($upload_dir, 0755, true);
                    }

                    $file_extension = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
                    $allowed_extensions = ['jpg', 'jpeg', 'png', 'gif'];

                    if (!in_array($file_extension, $allowed_extensions)) {
                        echo json_encode(['success' => false, 'error' => 'Invalid image format. Only JPG, PNG, and GIF are allowed.']);
                        exit;
                    }

                    // Generate unique filename
                    $filename = uniqid('activity_') . '.' . $file_extension;
                    $image_path = $upload_dir . $filename;

                    if (!move_uploaded_file($_FILES['image']['tmp_name'], $image_path)) {
                        echo json_encode(['success' => false, 'error' => 'Failed to upload image.']);
                        exit;
                    }
                } else {
                    echo json_encode(['success' => false, 'error' => 'Image is required.']);
                    exit;
                }

                $stmt = $pdo->prepare("INSERT INTO activities (title, category_id, description, start_date, end_date, location, status, image) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
                $stmt->execute([
                    $_POST['title'], $_POST['category_id'], $_POST['description'],
                    $_POST['start_date'], $_POST['end_date'], $_POST['location'], $_POST['status'], $image_path
                ]);
                echo json_encode(['success' => true]);
                break;

            case 'get_gallery':
                $stmt = $pdo->query("SELECT * FROM gallery ORDER BY uploaded_at DESC");
                $gallery = $stmt->fetchAll(PDO::FETCH_ASSOC);
                echo json_encode($gallery);
                break;

            case 'get_donations':
                $stmt = $pdo->query("SELECT * FROM donations ORDER BY donation_date DESC");
                $donations = $stmt->fetchAll(PDO::FETCH_ASSOC);
                echo json_encode($donations);
                break;

            case 'add_donation':
                $stmt = $pdo->prepare("INSERT INTO donations (donor_name, email, amount, currency, payment_method, status, notes) VALUES (?, ?, ?, ?, ?, ?, ?)");
                $stmt->execute([
                    $_POST['donor_name'], $_POST['email'], $_POST['amount'],
                    $_POST['currency'], $_POST['payment_method'], $_POST['status'], $_POST['notes']
                ]);
                echo json_encode(['success' => true]);
                break;

            case 'get_contacts':
                $stmt = $pdo->query("SELECT * FROM contacts ORDER BY created_at DESC");
                $contacts = $stmt->fetchAll(PDO::FETCH_ASSOC);
                echo json_encode($contacts);
                break;

            case 'mark_contact_read':
                $stmt = $pdo->prepare("UPDATE contacts SET is_read = ? WHERE id = ?");
                $stmt->execute([$_POST['is_read'], $_POST['id']]);
                echo json_encode(['success' => true]);
                break;

            case 'add_contact':
                $stmt = $pdo->prepare("INSERT INTO contacts (name, email, phone, subject, message, is_read) VALUES (?, ?, ?, ?, ?, ?)");
                $stmt->execute([
                    $_POST['name'], $_POST['email'], $_POST['phone'] ?? '', $_POST['subject'] ?? '', $_POST['message'], FALSE
                ]);
                echo json_encode(['success' => true, 'id' => $pdo->lastInsertId()]);
                break;

            case 'get_categories':
                $stmt = $pdo->query("SELECT * FROM categories ORDER BY name");
                $categories = $stmt->fetchAll(PDO::FETCH_ASSOC);
                echo json_encode($categories);
                break;

            case 'add_category':
                $stmt = $pdo->prepare("INSERT INTO categories (name, description) VALUES (?, ?)");
                $stmt->execute([$_POST['name'], $_POST['description']]);
                echo json_encode(['success' => true, 'id' => $pdo->lastInsertId()]);
                break;

            case 'update_category':
                $stmt = $pdo->prepare("UPDATE categories SET name = ?, description = ? WHERE id = ?");
                $stmt->execute([$_POST['name'], $_POST['description'], $_POST['id']]);
                echo json_encode(['success' => true]);
                break;

            case 'delete_category':
                $stmt = $pdo->prepare("DELETE FROM categories WHERE id = ?");
                $stmt->execute([$_POST['id']]);
                echo json_encode(['success' => true]);
                break;

            case 'delete_activity':
                $stmt = $pdo->prepare("DELETE FROM activities WHERE id = ?");
                $stmt->execute([$_POST['id']]);
                echo json_encode(['success' => true]);
                break;

            case 'get_activity':
                $stmt = $pdo->prepare("SELECT * FROM activities WHERE id = ?");
                $stmt->execute([$_POST['id']]);
                $activity = $stmt->fetch(PDO::FETCH_ASSOC);
                echo json_encode($activity);
                break;

            case 'update_activity':
                // Handle image upload for updates (optional)
                $image_path = $_POST['existing_image'] ?? '';
                if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
                    $upload_dir = 'uploads/activities/';
                    if (!is_dir($upload_dir)) {
                        mkdir($upload_dir, 0755, true);
                    }

                    $file_extension = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
                    $allowed_extensions = ['jpg', 'jpeg', 'png', 'gif'];

                    if (!in_array($file_extension, $allowed_extensions)) {
                        echo json_encode(['success' => false, 'error' => 'Invalid image format. Only JPG, PNG, and GIF are allowed.']);
                        exit;
                    }

                    // Generate unique filename
                    $filename = uniqid('activity_') . '.' . $file_extension;
                    $image_path = $upload_dir . $filename;

                    if (!move_uploaded_file($_FILES['image']['tmp_name'], $image_path)) {
                        echo json_encode(['success' => false, 'error' => 'Failed to upload image.']);
                        exit;
                    }

                    // Delete old image if it exists
                    if (!empty($_POST['existing_image']) && file_exists($_POST['existing_image'])) {
                        unlink($_POST['existing_image']);
                    }
                }

                $stmt = $pdo->prepare("UPDATE activities SET title = ?, category_id = ?, description = ?, start_date = ?, end_date = ?, location = ?, status = ?, image = ? WHERE id = ?");
                $stmt->execute([
                    $_POST['title'], $_POST['category_id'], $_POST['description'],
                    $_POST['start_date'], $_POST['end_date'], $_POST['location'], $_POST['status'],
                    $image_path, $_POST['id']
                ]);
                echo json_encode(['success' => true]);
                break;

            // Videos CRUD
            case 'get_videos':
                $stmt = $pdo->query("SELECT * FROM videos ORDER BY created_at DESC");
                $videos = $stmt->fetchAll(PDO::FETCH_ASSOC);
                echo json_encode($videos);
                break;

            case 'add_video':
                $stmt = $pdo->prepare("INSERT INTO videos (title, description, video_url, thumbnail, category, status) VALUES (?, ?, ?, ?, ?, ?)");
                $stmt->execute([
                    $_POST['title'], $_POST['description'], $_POST['video_url'],
                    $_POST['thumbnail'], $_POST['category'], $_POST['status']
                ]);
                echo json_encode(['success' => true, 'id' => $pdo->lastInsertId()]);
                break;

            case 'update_video':
                $stmt = $pdo->prepare("UPDATE videos SET title = ?, description = ?, video_url = ?, thumbnail = ?, category = ?, status = ? WHERE id = ?");
                $stmt->execute([
                    $_POST['title'], $_POST['description'], $_POST['video_url'],
                    $_POST['thumbnail'], $_POST['category'], $_POST['status'], $_POST['id']
                ]);
                echo json_encode(['success' => true]);
                break;

            case 'delete_video':
                $stmt = $pdo->prepare("DELETE FROM videos WHERE id = ?");
                $stmt->execute([$_POST['id']]);
                echo json_encode(['success' => true]);
                break;

            // Albums CRUD
            case 'get_albums':
                $stmt = $pdo->query("SELECT * FROM albums ORDER BY created_at DESC");
                $albums = $stmt->fetchAll(PDO::FETCH_ASSOC);
                echo json_encode($albums);
                break;

            case 'add_album':
                // Handle cover image upload
                $cover_image = '';
                if (isset($_FILES['cover_image']) && $_FILES['cover_image']['error'] === UPLOAD_ERR_OK) {
                    $upload_dir = 'uploads/albums/';
                    if (!is_dir($upload_dir)) {
                        mkdir($upload_dir, 0755, true);
                    }

                    $file_extension = strtolower(pathinfo($_FILES['cover_image']['name'], PATHINFO_EXTENSION));
                    $allowed_extensions = ['jpg', 'jpeg', 'png', 'gif'];

                    if (!in_array($file_extension, $allowed_extensions)) {
                        echo json_encode(['success' => false, 'error' => 'Invalid image format. Only JPG, PNG, and GIF are allowed.']);
                        exit;
                    }

                    $filename = uniqid('album_cover_') . '.' . $file_extension;
                    $cover_image = $upload_dir . $filename;

                    if (!move_uploaded_file($_FILES['cover_image']['tmp_name'], $cover_image)) {
                        echo json_encode(['success' => false, 'error' => 'Failed to upload cover image.']);
                        exit;
                    }
                }

                $stmt = $pdo->prepare("INSERT INTO albums (title, description, cover_image, category, status) VALUES (?, ?, ?, ?, ?)");
                $stmt->execute([
                    $_POST['title'], $_POST['description'], $cover_image,
                    $_POST['category'], $_POST['status']
                ]);
                echo json_encode(['success' => true, 'id' => $pdo->lastInsertId()]);
                break;

            case 'update_album':
                $cover_image = $_POST['existing_cover'] ?? '';
                if (isset($_FILES['cover_image']) && $_FILES['cover_image']['error'] === UPLOAD_ERR_OK) {
                    $upload_dir = 'uploads/albums/';
                    if (!is_dir($upload_dir)) {
                        mkdir($upload_dir, 0755, true);
                    }

                    $file_extension = strtolower(pathinfo($_FILES['cover_image']['name'], PATHINFO_EXTENSION));
                    $allowed_extensions = ['jpg', 'jpeg', 'png', 'gif'];

                    if (!in_array($file_extension, $allowed_extensions)) {
                        echo json_encode(['success' => false, 'error' => 'Invalid image format. Only JPG, PNG, and GIF are allowed.']);
                        exit;
                    }

                    $filename = uniqid('album_cover_') . '.' . $file_extension;
                    $cover_image = $upload_dir . $filename;

                    if (!move_uploaded_file($_FILES['cover_image']['tmp_name'], $cover_image)) {
                        echo json_encode(['success' => false, 'error' => 'Failed to upload cover image.']);
                        exit;
                    }

                    // Delete old cover image
                    if (!empty($_POST['existing_cover']) && file_exists($_POST['existing_cover'])) {
                        unlink($_POST['existing_cover']);
                    }
                }

                $stmt = $pdo->prepare("UPDATE albums SET title = ?, description = ?, cover_image = ?, category = ?, status = ? WHERE id = ?");
                $stmt->execute([
                    $_POST['title'], $_POST['description'], $cover_image,
                    $_POST['category'], $_POST['status'], $_POST['id']
                ]);
                echo json_encode(['success' => true]);
                break;

            case 'delete_album':
                $stmt = $pdo->prepare("DELETE FROM albums WHERE id = ?");
                $stmt->execute([$_POST['id']]);
                echo json_encode(['success' => true]);
                break;

            case 'get_album_images':
                $stmt = $pdo->prepare("SELECT * FROM album_images WHERE album_id = ? ORDER BY sort_order, created_at");
                $stmt->execute([$_POST['album_id']]);
                $images = $stmt->fetchAll(PDO::FETCH_ASSOC);
                echo json_encode($images);
                break;

            case 'add_album_image':
                $upload_dir = 'uploads/albums/';
                if (!is_dir($upload_dir)) {
                    mkdir($upload_dir, 0755, true);
                }

                $uploaded_count = 0;
                $errors = [];

                if (isset($_FILES['images'])) {
                    $files = $_FILES['images'];

                    // Handle multiple files
                    for ($i = 0; $i < count($files['name']); $i++) {
                        if ($files['error'][$i] === UPLOAD_ERR_OK) {
                            $file_extension = strtolower(pathinfo($files['name'][$i], PATHINFO_EXTENSION));
                            $allowed_extensions = ['jpg', 'jpeg', 'png', 'gif'];

                            if (!in_array($file_extension, $allowed_extensions)) {
                                $errors[] = "Invalid format for {$files['name'][$i]}";
                                continue;
                            }

                            $filename = uniqid('album_img_') . '.' . $file_extension;
                            $image_path = $upload_dir . $filename;

                            if (move_uploaded_file($files['tmp_name'][$i], $image_path)) {
                                $stmt = $pdo->prepare("INSERT INTO album_images (album_id, image_path) VALUES (?, ?)");
                                $stmt->execute([$_POST['album_id'], $image_path]);
                                $uploaded_count++;
                            } else {
                                $errors[] = "Failed to upload {$files['name'][$i]}";
                            }
                        }
                    }
                }

                if ($uploaded_count > 0) {
                    echo json_encode(['success' => true, 'uploaded' => $uploaded_count, 'errors' => $errors]);
                } else {
                    echo json_encode(['success' => false, 'error' => 'No images uploaded. ' . implode(', ', $errors)]);
                }
                break;

            case 'delete_album_image':
                $stmt = $pdo->prepare("SELECT image_path FROM album_images WHERE id = ?");
                $stmt->execute([$_POST['id']]);
                $image = $stmt->fetch(PDO::FETCH_ASSOC);

                if ($image && file_exists($image['image_path'])) {
                    unlink($image['image_path']);
                }

                $stmt = $pdo->prepare("DELETE FROM album_images WHERE id = ?");
                $stmt->execute([$_POST['id']]);
                echo json_encode(['success' => true]);
                break;

            case 'add_gallery_image':
                // Handle gallery image upload
                $image_path = '';
                if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
                    $upload_dir = 'uploads/gallery/';
                    if (!is_dir($upload_dir)) {
                        mkdir($upload_dir, 0755, true);
                    }

                    $file_extension = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
                    $allowed_extensions = ['jpg', 'jpeg', 'png', 'gif'];

                    if (!in_array($file_extension, $allowed_extensions)) {
                        echo json_encode(['success' => false, 'error' => 'Invalid image format. Only JPG, PNG, and GIF are allowed.']);
                        exit;
                    }

                    // Generate unique filename
                    $filename = uniqid('gallery_') . '.' . $file_extension;
                    $image_path = $upload_dir . $filename;

                    if (!move_uploaded_file($_FILES['image']['tmp_name'], $image_path)) {
                        echo json_encode(['success' => false, 'error' => 'Failed to upload image.']);
                        exit;
                    }
                } else {
                    echo json_encode(['success' => false, 'error' => 'Image is required.']);
                    exit;
                }

                $stmt = $pdo->prepare("INSERT INTO gallery (title, image_path, category, description) VALUES (?, ?, ?, ?)");
                $stmt->execute([
                    $_POST['title'] ?? '', $image_path, $_POST['category'] ?? '', $_POST['description'] ?? ''
                ]);
                echo json_encode(['success' => true, 'id' => $pdo->lastInsertId()]);
                break;

            case 'delete_gallery_image':
                $stmt = $pdo->prepare("SELECT image_path FROM gallery WHERE id = ?");
                $stmt->execute([$_POST['id']]);
                $image = $stmt->fetch(PDO::FETCH_ASSOC);

                if ($image && file_exists($image['image_path'])) {
                    unlink($image['image_path']);
                }

                $stmt = $pdo->prepare("DELETE FROM gallery WHERE id = ?");
                $stmt->execute([$_POST['id']]);
                echo json_encode(['success' => true]);
                break;

            // Highlights CRUD
            case 'get_highlights':
                $stmt = $pdo->query("SELECT * FROM highlights ORDER BY sort_order, created_at DESC");
                $highlights = $stmt->fetchAll(PDO::FETCH_ASSOC);
                echo json_encode($highlights);
                break;

            case 'add_highlight':
                // Handle image upload for highlights
                $image_path = '';
                if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
                    $upload_dir = 'uploads/highlights/';
                    if (!is_dir($upload_dir)) {
                        mkdir($upload_dir, 0755, true);
                    }

                    $file_extension = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
                    $allowed_extensions = ['jpg', 'jpeg', 'png', 'gif'];

                    if (!in_array($file_extension, $allowed_extensions)) {
                        echo json_encode(['success' => false, 'error' => 'Invalid image format. Only JPG, PNG, and GIF are allowed.']);
                        exit;
                    }

                    $filename = uniqid('highlight_') . '.' . $file_extension;
                    $image_path = $upload_dir . $filename;

                    if (!move_uploaded_file($_FILES['image']['tmp_name'], $image_path)) {
                        echo json_encode(['success' => false, 'error' => 'Failed to upload image.']);
                        exit;
                    }
                }

                $stmt = $pdo->prepare("INSERT INTO highlights (title, description, image_path, video_url, link_url, highlight_type, status, sort_order) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
                $stmt->execute([
                    $_POST['title'], $_POST['description'], $image_path,
                    $_POST['video_url'], $_POST['link_url'], $_POST['highlight_type'],
                    $_POST['status'], $_POST['sort_order'] ?? 0
                ]);
                echo json_encode(['success' => true, 'id' => $pdo->lastInsertId()]);
                break;

            case 'update_highlight':
                $image_path = $_POST['existing_image'] ?? '';
                if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
                    $upload_dir = 'uploads/highlights/';
                    if (!is_dir($upload_dir)) {
                        mkdir($upload_dir, 0755, true);
                    }

                    $file_extension = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
                    $allowed_extensions = ['jpg', 'jpeg', 'png', 'gif'];

                    if (!in_array($file_extension, $allowed_extensions)) {
                        echo json_encode(['success' => false, 'error' => 'Invalid image format. Only JPG, PNG, and GIF are allowed.']);
                        exit;
                    }

                    $filename = uniqid('highlight_') . '.' . $file_extension;
                    $image_path = $upload_dir . $filename;

                    if (!move_uploaded_file($_FILES['image']['tmp_name'], $image_path)) {
                        echo json_encode(['success' => false, 'error' => 'Failed to upload image.']);
                        exit;
                    }

                    // Delete old image
                    if (!empty($_POST['existing_image']) && file_exists($_POST['existing_image'])) {
                        unlink($_POST['existing_image']);
                    }
                }

                $stmt = $pdo->prepare("UPDATE highlights SET title = ?, description = ?, image_path = ?, video_url = ?, link_url = ?, highlight_type = ?, status = ?, sort_order = ? WHERE id = ?");
                $stmt->execute([
                    $_POST['title'], $_POST['description'], $image_path,
                    $_POST['video_url'], $_POST['link_url'], $_POST['highlight_type'],
                    $_POST['status'], $_POST['sort_order'] ?? 0, $_POST['id']
                ]);
                echo json_encode(['success' => true]);
                break;

            case 'delete_highlight':
                $stmt = $pdo->prepare("SELECT image_path FROM highlights WHERE id = ?");
                $stmt->execute([$_POST['id']]);
                $highlight = $stmt->fetch(PDO::FETCH_ASSOC);

                if ($highlight && !empty($highlight['image_path']) && file_exists($highlight['image_path'])) {
                    unlink($highlight['image_path']);
                }

                $stmt = $pdo->prepare("DELETE FROM highlights WHERE id = ?");
                $stmt->execute([$_POST['id']]);
                echo json_encode(['success' => true]);
                break;

            case 'change_password':
                // Get current admin id from session
                $admin_id = $_SESSION['admin_id'];

                // Verify current password
                $stmt = $pdo->prepare("SELECT password FROM admins WHERE id = ?");
                $stmt->execute([$admin_id]);
                $admin = $stmt->fetch();

                if (!$admin || !password_verify($_POST['current_password'], $admin['password'])) {
                    echo json_encode(['success' => false, 'error' => 'Current password is incorrect']);
                    exit;
                }

                // Check if new password is different
                if ($_POST['new_password'] === $_POST['current_password']) {
                    echo json_encode(['success' => false, 'error' => 'New password must be different from current password']);
                    exit;
                }

                // Hash new password
                $new_hashed = password_hash($_POST['new_password'], PASSWORD_DEFAULT);

                // Update password
                $stmt = $pdo->prepare("UPDATE admins SET password = ? WHERE id = ?");
                $stmt->execute([$new_hashed, $admin_id]);

                if ($stmt->rowCount() === 0) {
                    echo json_encode(['success' => false, 'error' => 'Failed to update password']);
                    exit;
                }

                session_destroy();
                echo json_encode(['success' => true]);
                break;

            case 'delete_donation':
                $stmt = $pdo->prepare("DELETE FROM donations WHERE id = ?");
                $stmt->execute([$_POST['id']]);
                echo json_encode(['success' => true]);
                break;

            case 'delete_contact':
                $stmt = $pdo->prepare("DELETE FROM contacts WHERE id = ?");
                $stmt->execute([$_POST['id']]);
                echo json_encode(['success' => true]);
                break;

            default:
                echo json_encode(['error' => 'Invalid action']);
        }
    } catch (PDOException $e) {
        echo json_encode(['error' => $e->getMessage()]);
    }
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard | Harold Mbati Foundation</title>
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Favicon -->
    <link rel="icon" type="image/png" sizes="32x32" href="logo.png">
    <link rel="apple-touch-icon" href="logo.png">
    
    <style>
        :root {
            --primary: #0f172a;
            --secondary: #1e293b;
            --accent: #f59e0b;
            --success: #10b981;
            --warning: #f59e0b;
            --danger: #ef4444;
        }
        
        body {
            font-family: 'Inter', sans-serif;
            background: #f8fafc;
            color: #1e293b;
            overflow-x: hidden;
        }
        
        /* Custom Scrollbar */
        ::-webkit-scrollbar {
            width: 6px;
            height: 6px;
        }
        
        ::-webkit-scrollbar-track {
            background: #f1f5f9;
            border-radius: 4px;
        }
        
        ::-webkit-scrollbar-thumb {
            background: linear-gradient(to bottom, #f59e0b, #1e40af);
            border-radius: 4px;
        }
        
        /* Sidebar */
        .sidebar {
            background: linear-gradient(180deg, #0f172a 0%, #1e293b 100%);
            box-shadow: 4px 0 20px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }
        
        .sidebar-item {
            transition: all 0.3s ease;
            border-radius: 0.5rem;
            margin: 0.25rem 0.5rem;
        }
        
        .sidebar-item:hover {
            background: rgba(255, 255, 255, 0.1);
            transform: translateX(5px);
        }
        
        .sidebar-item.active {
            background: rgba(245, 158, 11, 0.2);
            border-left: 4px solid var(--accent);
        }
        
        /* Card Styles */
        .dashboard-card {
            background: white;
            border-radius: 1rem;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
            border: 1px solid #e2e8f0;
        }
        
        .dashboard-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.1);
        }
        
        /* Table Styles */
        .data-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
        }

        .table-responsive {
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }
        
        .data-table th {
            background: #f8fafc;
            padding: 0.75rem 1rem;
            font-weight: 600;
            text-align: left;
            border-bottom: 2px solid #e2e8f0;
            color: #475569;
        }
        
        .data-table td {
            padding: 0.75rem 1rem;
            border-bottom: 1px solid #e2e8f0;
        }
        
        .data-table tr:hover {
            background: #f8fafc;
        }
        
        /* Status Badges */
        .status-badge {
            padding: 0.25rem 0.75rem;
            border-radius: 9999px;
            font-size: 0.75rem;
            font-weight: 500;
        }
        
        .status-published {
            background: rgba(16, 185, 129, 0.1);
            color: #065f46;
        }
        
        .status-draft {
            background: rgba(245, 158, 11, 0.1);
            color: #92400e;
        }
        
        .status-pending {
            background: rgba(59, 130, 246, 0.1);
            color: #1e40af;
        }
        
        .status-completed {
            background: rgba(16, 185, 129, 0.1);
            color: #065f46;
        }
        
        /* Modal Styles */
        .modal-overlay {
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.5);
            backdrop-filter: blur(5px);
            z-index: 9998;
            display: none;
            align-items: center;
            justify-content: center;
            padding: 1rem;
        }
        
        .modal-content {
            background: white;
            border-radius: 1rem;
            max-width: 800px;
            width: 100%;
            max-height: 90vh;
            overflow-y: auto;
            animation: modalSlideIn 0.3s ease-out;
        }
        
        @keyframes modalSlideIn {
            from {
                opacity: 0;
                transform: translateY(-20px) scale(0.95);
            }
            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }
        
        /* Form Styles */
        .form-input {
            width: 100%;
            padding: 0.75rem 1rem;
            border: 1px solid #cbd5e1;
            border-radius: 0.5rem;
            transition: all 0.3s ease;
            background: white;
        }
        
        .form-input:focus {
            outline: none;
            border-color: #f59e0b;
            box-shadow: 0 0 0 3px rgba(245, 158, 11, 0.1);
        }
        
        .form-select {
            width: 100%;
            padding: 0.75rem 1rem;
            border: 1px solid #cbd5e1;
            border-radius: 0.5rem;
            transition: all 0.3s ease;
            background: white;
        }
        
        .form-select:focus {
            outline: none;
            border-color: #f59e0b;
            box-shadow: 0 0 0 3px rgba(245, 158, 11, 0.1);
        }
        
        /* Responsive */
        @media (max-width: 825px) {
            .sidebar {
                transform: translateX(-100%);
                position: fixed;
                z-index: 1000;
                height: 100vh;
                width: 280px;
            }

            .sidebar.mobile-open {
                transform: translateX(0);
            }

            .mobile-menu-btn {
                display: block;
            }

            .data-table {
                display: block;
                overflow-x: auto;
                min-width: 600px;
            }

            .table-responsive {
                overflow-x: auto;
                -webkit-overflow-scrolling: touch;
                margin: 0 -1rem;
                padding: 0 1rem;
            }
        }
        
        @media (min-width: 826px) {
            .sidebar {
                transform: translateX(0);
            }
            
            .mobile-menu-btn {
                display: none;
            }
        }
        
        /* Notification */
        .notification {
            position: fixed;
            top: 1rem;
            right: 1rem;
            padding: 1rem 1.5rem;
            border-radius: 0.75rem;
            background: white;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            z-index: 9999;
            transform: translateX(120%);
            transition: transform 0.3s ease;
            display: flex;
            align-items: center;
            gap: 0.75rem;
            max-width: 400px;
        }
        
        .notification.show {
            transform: translateX(0);
        }
        
        .notification.success {
            border-left: 4px solid var(--success);
        }
        
        .notification.error {
            border-left: 4px solid var(--danger);
        }
        
        /* Tab Content */
        .tab-content {
            display: none;
        }

        .tab-content.active {
            display: block;
            animation: fadeIn 0.3s ease;
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        /* Button default text color */
        button {
            color: #1e293b !important;
        }
    </style>
</head>
<body class="min-h-screen">
    <!-- Main Container -->
    <div class="flex min-h-screen">
        <!-- Sidebar -->
        <aside class="sidebar w-64 min-h-screen fixed lg:relative z-50 flex flex-col">
            <!-- Logo -->
            <div class="p-6 border-b border-white/10">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-lg bg-accent flex items-center justify-center">
                        <i class="fas fa-hands-helping text-white"></i>
                    </div>
                    <div>
                        <h1 class="font-bold text-white text-lg">HMF Admin</h1>
                        <p class="text-white/60 text-xs">Dashboard</p>
                    </div>
                </div>
            </div>
            
            <!-- Admin Info -->
            <div class="p-6 border-b border-white/10">
                <div class="flex items-center gap-3">
                    <div class="w-12 h-12 rounded-full bg-gradient-to-br from-accent to-yellow-600 flex items-center justify-center">
                        <i class="fas fa-user text-white"></i>
                    </div>
                    <div>
                        <h3 class="font-semibold text-white">Administrator</h3>
                        <p class="text-white/60 text-sm">Super Admin</p>
                    </div>
                </div>
            </div>

            <!-- Navigation -->
            <nav class="p-4 space-y-1 flex-1 overflow-y-auto">
                <a href="#" class="sidebar-item active flex items-center gap-3 p-3 text-white" onclick="showTab('dashboard')">
                    <i class="fas fa-tachometer-alt w-5"></i>
                    <span>Dashboard</span>
                </a>
                
                <a href="#" class="sidebar-item flex items-center gap-3 p-3 text-white/80 hover:text-white" onclick="showTab('activities')">
                    <i class="fas fa-tasks w-5"></i>
                    <span>Activities</span>
                    <span class="ml-auto bg-accent/20 text-accent text-xs px-2 py-1 rounded-full activity-count">24</span>
                </a>
                
                <a href="#" class="sidebar-item flex items-center gap-3 p-3 text-white/80 hover:text-white" onclick="showTab('gallery')">
                    <i class="fas fa-images w-5"></i>
                    <span>Gallery</span>
                    <span class="ml-auto bg-accent/20 text-accent text-xs px-2 py-1 rounded-full gallery-count">156</span>
                </a>
                
                <a href="#" class="sidebar-item flex items-center gap-3 p-3 text-white/80 hover:text-white" onclick="showTab('donations')">
                    <i class="fas fa-donate w-5"></i>
                    <span>Donations</span>
                    <span class="ml-auto bg-accent/20 text-accent text-xs px-2 py-1 rounded-full donation-count">48</span>
                </a>
                
                <a href="#" class="sidebar-item flex items-center gap-3 p-3 text-white/80 hover:text-white" onclick="showTab('contacts')">
                    <i class="fas fa-envelope w-5"></i>
                    <span>Contact Messages</span>
                    <span class="ml-auto bg-accent/20 text-accent text-xs px-2 py-1 rounded-full contact-count">12</span>
                </a>
                
                <a href="#" class="sidebar-item flex items-center gap-3 p-3 text-white/80 hover:text-white" onclick="showTab('settings')">
                    <i class="fas fa-cog w-5"></i>
                    <span>Settings</span>
                </a>

                <button onclick="logout()" class="sidebar-item flex items-center gap-3 p-3 text-white w-full bg-red-600/20 hover:bg-red-600/30">
                    <i class="fas fa-sign-out-alt w-5"></i>
                    <span>Logout</span>
                </button>
            </nav>
        </aside>
        
        <!-- Mobile Menu Button -->
        <button class="mobile-menu-btn fixed top-2 right-4 z-40 w-10 h-10 rounded-lg bg-accent text-black flex items-center justify-center lg:hidden shadow-lg" onclick="toggleSidebar()">
            <i class="fas fa-bars"></i>
        </button>
        
        <!-- Main Content -->
        <main class="flex-1 lg:ml-0 overflow-x-hidden">
            <!-- Top Bar -->
            <header class="bg-white border-b border-gray-200 sticky top-0 z-30">
                <div class="px-6 py-4">
                    <div class="flex items-center justify-between">
                        <div>
                            <h2 class="text-xl font-bold text-gray-800" id="pageTitle">Dashboard</h2>
                            <p class="text-gray-600 text-sm">Manage Harold Mbati Foundation</p>
                        </div>
                        
                        <div class="flex items-center gap-4">
                            <!-- Add Activity Button -->
                            <!-- <button class="px-4 py-2 bg-accent text-white rounded-lg hover:bg-yellow-600 transition-colors flex items-center gap-2" onclick="openModal('activityModal')">
                                <i class="fas fa-plus"></i>
                                Add Activity
                            </button> -->

                            <!-- Search -->
                            <div class="hidden md:block">
                                <div class="relative">
                                    <input type="text" placeholder="Search..." class="pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-accent focus:ring-1 focus:ring-accent w-64">
                                    <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
                                </div>
                            </div>

                            <!-- Date -->
                            <div class="hidden md:block text-right">
                                <div class="text-sm font-medium text-gray-800" id="currentDate"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </header>
            
            <!-- Dashboard Content -->
            <div class="p-6">
                <!-- Dashboard Tab -->
                <div id="dashboard-tab" class="tab-content active">
                    <!-- Quick Stats -->
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                        <!-- Total Activities -->
                        <div class="dashboard-card p-6">
                            <div class="flex items-center justify-between mb-4">
                                <div>
                                    <p class="text-gray-600 text-sm">Total Activities</p>
                                    <h3 class="text-2xl font-bold text-gray-800" id="total-activities">0</h3>
                                </div>
                                <div class="w-12 h-12 rounded-lg bg-blue-100 flex items-center justify-center">
                                    <i class="fas fa-tasks text-blue-600 text-xl"></i>
                                </div>
                            </div>
                            <div class="text-sm text-gray-600">
                                <span class="text-green-600 font-medium">+3 this month</span>
                            </div>
                        </div>
                        
                        <!-- Total Donations -->
                        <div class="dashboard-card p-6">
                            <div class="flex items-center justify-between mb-4">
                                <div>
                                    <p class="text-gray-600 text-sm">Total Donations</p>
                                    <h3 class="text-2xl font-bold text-gray-800" id="total-donations">Ksh 0</h3>
                                </div>
                                <div class="w-12 h-12 rounded-lg bg-green-100 flex items-center justify-center">
                                    <i class="fas fa-donate text-green-600 text-xl"></i>
                                </div>
                            </div>
                            <div class="text-sm text-gray-600">
                                <span class="text-green-600 font-medium" id="donations-this-month">Ksh 0 this month</span>
                            </div>
                        </div>
                        
                        <!-- Gallery Items -->
                        <div class="dashboard-card p-6">
                            <div class="flex items-center justify-between mb-4">
                                <div>
                                    <p class="text-gray-600 text-sm">Gallery Items</p>
                                    <h3 class="text-2xl font-bold text-gray-800" id="total-gallery">0</h3>
                                </div>
                                <div class="w-12 h-12 rounded-lg bg-purple-100 flex items-center justify-center">
                                    <i class="fas fa-images text-purple-600 text-xl"></i>
                                </div>
                            </div>
                            <div class="text-sm text-gray-600">
                                <span class="text-green-600 font-medium">+12 this week</span>
                            </div>
                        </div>
                        
                        <!-- Pending Messages -->
                        <div class="dashboard-card p-6">
                            <div class="flex items-center justify-between mb-4">
                                <div>
                                    <p class="text-gray-600 text-sm">Pending Messages</p>
                                    <h3 class="text-2xl font-bold text-gray-800" id="pending-contacts">0</h3>
                                </div>
                                <div class="w-12 h-12 rounded-lg bg-yellow-100 flex items-center justify-center">
                                    <i class="fas fa-envelope text-yellow-600 text-xl"></i>
                                </div>
                            </div>
                            <div class="text-sm text-gray-600">
                                <span class="text-red-600 font-medium" id="unread-messages">0 unread</span>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Quick Actions -->
                    <div class="mb-8">
                        <h3 class="font-bold text-gray-800 text-lg mb-4">Quick Actions</h3>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <button class="dashboard-card p-6 text-left hover:shadow-lg transition-shadow" onclick="openModal('activityModal')">
                                <div class="flex items-center gap-4">
                                    <div class="w-12 h-12 rounded-lg bg-blue-100 flex items-center justify-center">
                                        <i class="fas fa-plus text-blue-600"></i>
                                    </div>
                                    <div>
                                        <h4 class="font-bold text-gray-800 mb-1">Add New Activity</h4>
                                        <p class="text-gray-600 text-sm">Create a new foundation activity</p>
                                    </div>
                                </div>
                            </button>
                            
                            <button class="dashboard-card p-6 text-left hover:shadow-lg transition-shadow" onclick="openModal('galleryModal')">
                                <div class="flex items-center gap-4">
                                    <div class="w-12 h-12 rounded-lg bg-purple-100 flex items-center justify-center">
                                        <i class="fas fa-upload text-purple-600"></i>
                                    </div>
                                    <div>
                                        <h4 class="font-bold text-gray-800 mb-1">Upload Images</h4>
                                        <p class="text-gray-600 text-sm">Add photos to the gallery</p>
                                    </div>
                                </div>
                            </button>
                            
                            <button class="dashboard-card p-6 text-left hover:shadow-lg transition-shadow" onclick="showTab('donations')">
                                <div class="flex items-center gap-4">
                                    <div class="w-12 h-12 rounded-lg bg-green-100 flex items-center justify-center">
                                        <i class="fas fa-eye text-green-600"></i>
                                    </div>
                                    <div>
                                        <h4 class="font-bold text-gray-800 mb-1">View Donations</h4>
                                        <p class="text-gray-600 text-sm">Check recent donations</p>
                                    </div>
                                </div>
                            </button>
                        </div>
                    </div>
                    
                    <!-- Recent Activity -->
                    <div class="dashboard-card p-6">
                        <h3 class="font-bold text-gray-800 text-lg mb-6">Recent Activity</h3>
                        <div class="space-y-4" id="recent-activities">
                            <!-- Activities will be loaded here -->
                        </div>
                    </div>
                </div>
                
                <!-- Activities Tab -->
                <div id="activities-tab" class="tab-content">
                    <div class="flex items-center justify-between mb-6">
                        <div>
                            <h3 class="font-bold text-gray-800 text-lg">Manage Activities</h3>
                            <!-- <p class="text-gray-600 text-sm">Create, edit, and publish foundation activities</p> -->
                        </div>
                        <div class="flex items-center gap-4">
                            <button class="px-4 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700 transition-colors flex items-center gap-2" onclick="openModal('categoriesModal')">
                                <i class="fas fa-tags"></i>
                                Manage Categories
                            </button>
                            <!-- <button class="px-4 py-2 bg-accent text-white rounded-lg hover:bg-yellow-600 transition-colors flex items-center gap-2" onclick="openModal('activityModal')">
                                <i class="fas fa-plus"></i>
                                Add New Activity
                            </button> -->
                        </div>
                    </div>

                    <!-- Add Activity Button -->
                    <div class="mb-6">
                        <button class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors flex items-center gap-2" onclick="openModal('activityModal')">
                            <i class="fas fa-plus"></i>
                            Add New Activity
                        </button>
                    </div>

                    <!-- Activities Table -->
                    <div class="dashboard-card overflow-hidden">
                        <div class="table-responsive">
                            <table class="data-table">
                                <thead>
                                    <tr>
                                        <th>Activity</th>
                                        <th>Description</th>
                                        <th>Category</th>
                                        <th>Start Date</th>
                                        <th>End Date</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody id="activities-table-body">
                                    <!-- Activities will be loaded here -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                
                <!-- Gallery Tab -->
                <div id="gallery-tab" class="tab-content">
                    <div class="flex items-center justify-between mb-6">
                        <div>
                            <h3 class="font-bold text-gray-800 text-lg">Manage Gallery</h3>
                            <!-- <p class="text-gray-600 text-sm">Upload and organize foundation content</p> -->
                        </div>
                        <div class="flex items-center gap-2">
                            <button class="px-3 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700 transition-colors text-sm" onclick="openModal('categoriesModal')">
                                <i class="fas fa-tags"></i>
                                Categories
                            </button>
                            <button class="px-3 py-2 bg-purple-600 text-white rounded-lg hover:bg-purple-700 transition-colors text-sm" onclick="openModal('videosModal')">
                                <i class="fas fa-video"></i>
                                Videos
                            </button>
                            <button class="px-3 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors text-sm" onclick="openModal('albumsModal')">
                                <i class="fas fa-images"></i>
                                Albums
                            </button>
                            <button class="px-3 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors text-sm" onclick="openModal('highlightModal')">
                                <i class="fas fa-star"></i>
                                Highlights
                            </button>
                            <!-- <button class="px-3 py-2 bg-accent text-white rounded-lg hover:bg-yellow-600 transition-colors text-sm" onclick="openModal('galleryModal')">
                                <i class="fas fa-upload"></i>
                                Upload Images
                            </button> -->
                        </div>
                    </div>

                    <!-- Gallery Content Sections -->
                    <div class="space-y-8">
                        <!-- Categories Section -->
                        <div class="dashboard-card p-6">
                            <div class="flex items-center justify-between mb-4">
                                <h4 class="font-bold text-gray-800">Categories</h4>
                                <button class="px-3 py-1 bg-gray-600 text-white rounded text-sm hover:bg-gray-700" onclick="openModal('categoriesModal')">
                                    Manage Categories
                                </button>
                            </div>
                            <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-3" id="gallery-categories">
                                <!-- Categories will be loaded here -->
                            </div>
                        </div>

                        <!-- Videos Section -->
                        <div class="dashboard-card p-6">
                            <div class="flex items-center justify-between mb-4">
                                <h4 class="font-bold text-gray-800">Videos</h4>
                                <button class="px-3 py-1 bg-purple-600 text-white rounded text-sm hover:bg-purple-700" onclick="openModal('videosModal')">
                                    Manage Videos
                                </button>
                            </div>
                            <div class="space-y-3" id="gallery-videos">
                                <!-- Videos will be loaded here -->
                            </div>
                        </div>

                        <!-- Albums Section -->
                        <div class="dashboard-card p-6">
                            <div class="flex items-center justify-between mb-4">
                                <h4 class="font-bold text-gray-800">Albums</h4>
                                <button class="px-3 py-1 bg-green-600 text-white rounded text-sm hover:bg-green-700" onclick="openModal('albumsModal')">
                                    Manage Albums
                                </button>
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4" id="gallery-albums">
                                <!-- Albums will be loaded here -->
                            </div>
                        </div>

                        <!-- Highlights Section -->
                        <div class="dashboard-card p-6">
                            <div class="flex items-center justify-between mb-4">
                                <h4 class="font-bold text-gray-800">Highlights</h4>
                                <button class="px-3 py-1 bg-red-600 text-white rounded text-sm hover:bg-red-700" onclick="openModal('highlightModal')">
                                    Manage Highlights
                                </button>
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4" id="gallery-highlights">
                                <!-- Highlights will be loaded here -->
                            </div>
                        </div>

                        <!-- Gallery Images Section -->
                        <div class="dashboard-card p-6">
                            <div class="flex items-center justify-between mb-4">
                                <h4 class="font-bold text-gray-800">Gallery Images</h4>
                                <button class="px-3 py-1 bg-accent text-white rounded text-sm hover:bg-yellow-600" onclick="openModal('galleryModal')">
                                    Upload Images
                                </button>
                            </div>
                            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4" id="gallery-images">
                                <!-- Gallery images will be loaded here -->
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Donations Tab -->
                <div id="donations-tab" class="tab-content">
                    <div class="flex items-center justify-between mb-6">
                        <div>
                            <h3 class="font-bold text-gray-800 text-lg">Manage Donations</h3>
                            <p class="text-gray-600 text-sm">Track and manage foundation donations</p>
                        </div>
                        <button class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors flex items-center gap-2" onclick="openModal('donationModal')">
                            <i class="fas fa-plus"></i>
                            Add Donation
                        </button>
                    </div>
                    
                    <!-- Donations Table -->
                    <div class="dashboard-card overflow-hidden">
                        <div class="overflow-x-auto">
                            <table class="data-table">
                                <thead>
                                    <tr>
                                        <th>Donor</th>
                                        <th>Amount</th>
                                        <th>Date</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody id="donations-table-body">
                                    <!-- Donations will be loaded here -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                
                <!-- Contact Messages Tab -->
                <div id="contacts-tab" class="tab-content">
                    <div class="flex items-center justify-between mb-6">
                        <div>
                            <h3 class="font-bold text-gray-800 text-lg">Contact Messages</h3>
                            <p class="text-gray-600 text-sm">Manage incoming contact form messages</p>
                        </div>
                        <select class="form-select w-40" onchange="filterMessages(this.value)">
                            <option value="all">All Messages</option>
                            <option value="unread">Unread</option>
                            <option value="read">Read</option>
                        </select>
                    </div>
                    
                    <!-- Messages List -->
                    <div class="space-y-4" id="contacts-list">
                        <!-- Messages will be loaded here -->
                    </div>
                </div>
                <!-- Settings Tab -->
                <div id="settings-tab" class="tab-content">
                    <div class="flex items-center justify-between mb-6">
                        <div>
                            <h3 class="font-bold text-gray-800 text-lg">Settings</h3>
                            <p class="text-gray-600 text-sm">Manage your account settings</p>
                        </div>
                    </div>
                    <div class="dashboard-card p-6 max-w-md">
                        <h4 class="font-bold text-gray-800 mb-4">Change Password</h4>
                        <form id="changePasswordForm">
                            <div class="space-y-4">
                                <div>
                                    <label class="block text-gray-700 mb-2">Current Password</label>
                                    <div class="relative">
                                        <input type="password" name="current_password" class="form-input pr-10" required>
                                        <button type="button" class="absolute right-3 top-3 text-gray-400 hover:text-gray-600" onclick="togglePassword('current_password')">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                    </div>
                                </div>
                                <div>
                                    <label class="block text-gray-700 mb-2">New Password</label>
                                    <div class="relative">
                                        <input type="password" name="new_password" class="form-input pr-10" required minlength="8">
                                        <button type="button" class="absolute right-3 top-3 text-gray-400 hover:text-gray-600" onclick="togglePassword('new_password')">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                    </div>
                                </div>
                                <div>
                                    <label class="block text-gray-700 mb-2">Confirm New Password</label>
                                    <div class="relative">
                                        <input type="password" name="confirm_password" class="form-input pr-10" required minlength="8">
                                        <button type="button" class="absolute right-3 top-3 text-gray-400 hover:text-gray-600" onclick="togglePassword('confirm_password')">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                    </div>
                                </div>
                                <button type="submit" class="px-6 py-3 bg-accent text-white rounded-lg hover:bg-yellow-600">
                                    Change Password
                                </button>
                            </div>
                        </form>

                        <div class="mt-8 pt-6 border-t border-gray-200">
                            <button onclick="logout()" class="px-6 py-3 bg-red-600 text-white rounded-lg">
                                <i class="fas fa-sign-out-alt mr-2"></i>Logout
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
    
    <!-- Activity Modal -->
    <div id="activityModal" class="modal-overlay">
        <div class="modal-content">
            <div class="p-8">
                <div class="flex justify-between items-center mb-8">
                    <h3 class="font-bold text-gray-800 text-2xl">Add New Activity</h3>
                    <button onclick="closeModal('activityModal')" class="text-gray-400 hover:text-gray-600">
                        <i class="fas fa-times text-2xl"></i>
                    </button>
                </div>
                
                <form id="activityForm" class="space-y-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-gray-700 mb-2">Activity Title *</label>
                            <input type="text" name="title" class="form-input" placeholder="Enter activity title" required>
                        </div>
                        
                        <div>
                            <label class="block text-gray-700 mb-2">Category *</label>
                            <select name="category_id" id="categorySelect" class="form-select" required>
                                <option value="">Select Category</option>
                                <!-- Categories will be loaded here -->
                            </select>
                        </div>
                        
                        <div>
                            <label class="block text-gray-700 mb-2">Start Date *</label>
                            <input type="date" name="start_date" class="form-input" required>
                        </div>
                        
                        <div>
                            <label class="block text-gray-700 mb-2">End Date</label>
                            <input type="date" name="end_date" class="form-input">
                        </div>
                        
                        <div>
                            <label class="block text-gray-700 mb-2">Location *</label>
                            <input type="text" name="location" class="form-input" placeholder="Enter location" required>
                        </div>
                        
                        <div>
                            <label class="block text-gray-700 mb-2">Status</label>
                            <select name="status" class="form-select">
                                <option value="draft">Draft</option>
                                <option value="upcoming">Upcoming</option>
                                <option value="active">Active</option>
                                <option value="completed">Completed</option>
                            </select>
                        </div>
                    </div>
                    
                    <div>
                        <label class="block text-gray-700 mb-2">Description *</label>
                        <textarea name="description" class="form-input h-32" placeholder="Enter activity description" required></textarea>
                    </div>

                    <div>
                        <label class="block text-gray-700 mb-2">Activity Image *</label>
                        <input type="file" name="image" class="form-input" accept="image/*" required>
                        <p class="text-sm text-gray-500 mt-1">Upload an image for this activity (JPG, PNG, GIF)</p>
                        <div id="imagePreview" class="mt-2 hidden">
                            <img id="previewImg" class="max-w-xs max-h-48 rounded-lg border" alt="Image preview">
                        </div>
                    </div>
                    
                    <div class="flex justify-end gap-4 pt-6 border-t border-gray-200">
                        <button type="button" onclick="closeModal('activityModal')" class="px-6 py-3 border border-gray-300 rounded-lg hover:bg-gray-50">
                            Cancel
                        </button>
                        <button type="submit" class="px-6 py-3 bg-accent text-black rounded-lg hover:bg-yellow-600">
                            Save Activity
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Edit Activity Modal -->
    <div id="editActivityModal" class="modal-overlay">
        <div class="modal-content">
            <div class="p-8">
                <div class="flex justify-between items-center mb-8">
                    <h3 class="font-bold text-gray-800 text-2xl">Edit Activity</h3>
                    <button onclick="closeModal('editActivityModal')" class="text-gray-400 hover:text-gray-600">
                        <i class="fas fa-times text-2xl"></i>
                    </button>
                </div>

                <form id="editActivityForm" class="space-y-6">
                    <input type="hidden" name="id" id="editActivityId">
                    <input type="hidden" name="existing_image" id="editExistingImage">

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-gray-700 mb-2">Activity Title *</label>
                            <input type="text" name="title" id="editTitle" class="form-input" placeholder="Enter activity title" required>
                        </div>

                        <div>
                            <label class="block text-gray-700 mb-2">Category *</label>
                            <select name="category_id" id="editCategorySelect" class="form-select" required>
                                <option value="">Select Category</option>
                                <!-- Categories will be loaded here -->
                            </select>
                        </div>

                        <div>
                            <label class="block text-gray-700 mb-2">Start Date *</label>
                            <input type="date" name="start_date" id="editStartDate" class="form-input" required>
                        </div>

                        <div>
                            <label class="block text-gray-700 mb-2">End Date</label>
                            <input type="date" name="end_date" id="editEndDate" class="form-input">
                        </div>

                        <div>
                            <label class="block text-gray-700 mb-2">Location *</label>
                            <input type="text" name="location" id="editLocation" class="form-input" placeholder="Enter location" required>
                        </div>

                        <div>
                            <label class="block text-gray-700 mb-2">Status</label>
                            <select name="status" id="editStatus" class="form-select">
                                <option value="draft">Draft</option>
                                <option value="upcoming">Upcoming</option>
                                <option value="active">Active</option>
                                <option value="completed">Completed</option>
                            </select>
                        </div>
                    </div>

                    <div>
                        <label class="block text-gray-700 mb-2">Description *</label>
                        <textarea name="description" id="editDescription" class="form-input h-32" placeholder="Enter activity description" required></textarea>
                    </div>

                    <div>
                        <label class="block text-gray-700 mb-2">Activity Image</label>
                        <input type="file" name="image" id="editImage" class="form-input" accept="image/*">
                        <p class="text-sm text-gray-500 mt-1">Leave empty to keep current image. Upload a new image to replace it (JPG, PNG, GIF)</p>
                        <div id="editImagePreview" class="mt-2 hidden">
                            <img id="editPreviewImg" class="max-w-xs max-h-48 rounded-lg border" alt="Current image">
                        </div>
                    </div>

                    <div class="flex justify-end gap-4 pt-6 border-t border-gray-200">
                        <button type="button" onclick="closeModal('editActivityModal')" class="px-6 py-3 border border-gray-300 rounded-lg hover:bg-gray-50">
                            Cancel
                        </button>
                        <button type="submit" class="px-6 py-3 bg-accent text-white rounded-lg hover:bg-yellow-600">
                            Update Activity
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Donation Modal -->
    <div id="donationModal" class="modal-overlay">
        <div class="modal-content">
            <div class="p-8">
                <div class="flex justify-between items-center mb-8">
                    <h3 class="font-bold text-gray-800 text-2xl">Add Donation Record</h3>
                    <button onclick="closeModal('donationModal')" class="text-gray-400 hover:text-gray-600">
                        <i class="fas fa-times text-2xl"></i>
                    </button>
                </div>
                
                <form id="donationForm" class="space-y-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-gray-700 mb-2">Donor Name *</label>
                            <input type="text" name="donor_name" class="form-input" placeholder="Enter donor name" required>
                        </div>
                        
                        <div>
                            <label class="block text-gray-700 mb-2">Email</label>
                            <input type="email" name="email" class="form-input" placeholder="Enter email address">
                        </div>
                        
                        <div>
                            <label class="block text-gray-700 mb-2">Amount *</label>
                            <input type="number" name="amount" step="0.01" class="form-input" placeholder="Enter amount" required>
                        </div>
                        
                        <div>
                            <label class="block text-gray-700 mb-2">Currency</label>
                            <select name="currency" class="form-select">
                                <option value="KES">Kenyan Shilling (KES)</option>
                                <option value="USD">US Dollar (USD)</option>
                                <option value="EUR">Euro (EUR)</option>
                            </select>
                        </div>
                        
                        <div>
                            <label class="block text-gray-700 mb-2">Payment Method</label>
                            <select name="payment_method" class="form-select">
                                <option value="mpesa">M-Pesa</option>
                                <option value="bank">Bank Transfer</option>
                                <option value="cash">Cash</option>
                                <option value="card">Credit Card</option>
                            </select>
                        </div>
                        
                        <div>
                            <label class="block text-gray-700 mb-2">Status</label>
                            <select name="status" class="form-select">
                                <option value="completed">Completed</option>
                                <option value="processing">Processing</option>
                                <option value="pending">Pending</option>
                            </select>
                        </div>
                    </div>
                    
                    <div>
                        <label class="block text-gray-700 mb-2">Notes (Optional)</label>
                        <textarea name="notes" class="form-input h-24" placeholder="Any additional notes about this donation"></textarea>
                    </div>
                    
                    <div class="flex justify-end gap-4 pt-6 border-t border-gray-200">
                        <button type="button" onclick="closeModal('donationModal')" class="px-6 py-3 border border-gray-300 rounded-lg hover:bg-gray-50">
                            Cancel
                        </button>
                        <button type="submit" class="px-6 py-3 bg-green-600 text-white rounded-lg hover:bg-green-700">
                            Save Donation
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Categories Modal -->
    <div id="categoriesModal" class="modal-overlay">
        <div class="modal-content">
            <div class="p-8">
                <div class="flex justify-between items-center mb-8">
                    <h3 class="font-bold text-gray-800 text-2xl">Manage Categories</h3>
                    <button onclick="closeModal('categoriesModal')" class="text-gray-400 hover:text-gray-600">
                        <i class="fas fa-times text-2xl"></i>
                    </button>
                </div>

                <!-- Add Category Form -->
                <div class="mb-6 p-4 bg-gray-50 rounded-lg">
                    <h4 class="font-semibold text-gray-800 mb-4">Add New Category</h4>
                    <form id="categoryForm" class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-gray-700 mb-2">Category Name *</label>
                            <input type="text" name="name" class="form-input" placeholder="Enter category name" required>
                        </div>
                        <div>
                            <label class="block text-gray-700 mb-2">Description</label>
                            <input type="text" name="description" class="form-input" placeholder="Brief description">
                        </div>
                        <div class="md:col-span-2 flex justify-end gap-4">
                            <button type="button" onclick="resetCategoryForm()" class="px-4 py-2 border border-gray-300 rounded-lg hover:bg-gray-50">
                                Clear
                            </button>
                            <button type="submit" class="px-4 py-2 bg-accent text-black rounded-lg hover:bg-yellow-600">
                                Add Category
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Categories List -->
                <div class="mb-6">
                    <h4 class="font-semibold text-gray-800 mb-4">Existing Categories</h4>
                    <div class="space-y-3" id="categoriesList">
                        <!-- Categories will be loaded here -->
                    </div>
                </div>

                <div class="flex justify-end gap-4 pt-6 border-t border-gray-200">
                    <button onclick="closeModal('categoriesModal')" class="px-6 py-3 border border-gray-300 rounded-lg hover:bg-gray-50">
                        Close
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Videos Modal -->
    <div id="videosModal" class="modal-overlay">
        <div class="modal-content">
            <div class="p-8">
                <div class="flex justify-between items-center mb-8">
                    <h3 class="font-bold text-gray-800 text-2xl">Manage Videos</h3>
                    <button onclick="closeModal('videosModal')" class="text-gray-400 hover:text-gray-600">
                        <i class="fas fa-times text-2xl"></i>
                    </button>
                </div>

                <!-- Add Video Form -->
                <div class="mb-6 p-4 bg-gray-50 rounded-lg">
                    <h4 class="font-semibold text-gray-800 mb-4">Add New Video</h4>
                    <form id="videoForm" class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-gray-700 mb-2">Video Title *</label>
                            <input type="text" name="title" class="form-input" placeholder="Enter video title" required>
                        </div>
                        <div>
                            <label class="block text-gray-700 mb-2">Category</label>
                            <select name="category" class="form-select" id="videoCategorySelect">
                                <option value="">Select Category</option>
                                <!-- Categories will be loaded here -->
                            </select>
                        </div>
                        <div class="md:col-span-2">
                            <label class="block text-gray-700 mb-2">Video URL *</label>
                            <input type="url" name="video_url" class="form-input" placeholder="https://youtube.com/watch?v=..." required>
                        </div>
                        <div>
                            <label class="block text-gray-700 mb-2">Thumbnail URL</label>
                            <input type="url" name="thumbnail" class="form-input" placeholder="https://...">
                        </div>
                        <div>
                            <label class="block text-gray-700 mb-2">Status</label>
                            <select name="status" class="form-select">
                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>
                            </select>
                        </div>
                        <div class="md:col-span-2">
                            <label class="block text-gray-700 mb-2">Description</label>
                            <textarea name="description" class="form-input h-24" placeholder="Video description"></textarea>
                        </div>
                        <div class="md:col-span-2 flex justify-end gap-4">
                            <button type="button" onclick="resetVideoForm()" class="px-4 py-2 border border-gray-300 rounded-lg hover:bg-gray-50">
                                Clear
                            </button>
                            <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700">
                                Add Video
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Videos List -->
                <div class="mb-6">
                    <h4 class="font-semibold text-gray-800 mb-4">Existing Videos</h4>
                    <div class="space-y-3" id="videosList">
                        <!-- Videos will be loaded here -->
                    </div>
                </div>

                <div class="flex justify-end gap-4 pt-6 border-t border-gray-200">
                    <button onclick="closeModal('videosModal')" class="px-6 py-3 border border-gray-300 rounded-lg hover:bg-gray-50">
                        Close
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Albums Modal -->
    <div id="albumsModal" class="modal-overlay">
        <div class="modal-content">
            <div class="p-8">
                <div class="flex justify-between items-center mb-8">
                    <h3 class="font-bold text-gray-800 text-2xl">Manage Albums</h3>
                    <button onclick="closeModal('albumsModal')" class="text-gray-400 hover:text-gray-600">
                        <i class="fas fa-times text-2xl"></i>
                    </button>
                </div>

                <!-- Add Album Form -->
                <div class="mb-6 p-4 bg-gray-50 rounded-lg">
                    <h4 class="font-semibold text-gray-800 mb-4">Add New Album</h4>
                    <form id="albumForm" class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-gray-700 mb-2">Album Title *</label>
                            <input type="text" name="title" class="form-input" placeholder="Enter album title" required>
                        </div>
                        <div>
                            <label class="block text-gray-700 mb-2">Category</label>
                            <select name="category" class="form-select" id="albumCategorySelect">
                                <option value="">Select Category</option>
                                <!-- Categories will be loaded here -->
                            </select>
                        </div>
                        <div>
                            <label class="block text-gray-700 mb-2">Cover Image</label>
                            <input type="file" name="cover_image" class="form-input" accept="image/*">
                        </div>
                        <div>
                            <label class="block text-gray-700 mb-2">Status</label>
                            <select name="status" class="form-select">
                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>
                            </select>
                        </div>
                        <div class="md:col-span-2">
                            <label class="block text-gray-700 mb-2">Description</label>
                            <textarea name="description" class="form-input h-24" placeholder="Album description"></textarea>
                        </div>
                        <div class="md:col-span-2 flex justify-end gap-4">
                            <button type="button" onclick="resetAlbumForm()" class="px-4 py-2 border border-gray-300 rounded-lg hover:bg-gray-50">
                                Clear
                            </button>
                            <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700">
                                Add Album
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Albums List -->
                <div class="mb-6">
                    <h4 class="font-semibold text-gray-800 mb-4">Existing Albums</h4>
                    <div class="space-y-3" id="albumsList">
                        <!-- Albums will be loaded here -->
                    </div>
                </div>

                <div class="flex justify-end gap-4 pt-6 border-t border-gray-200">
                    <button onclick="closeModal('albumsModal')" class="px-6 py-3 border border-gray-300 rounded-lg hover:bg-gray-50">
                        Close
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Album Images Modal -->
    <div id="albumImagesModal" class="modal-overlay">
        <div class="modal-content">
            <div class="p-8">
                <div class="flex justify-between items-center mb-8">
                    <h3 class="font-bold text-gray-800 text-2xl" id="albumImagesTitle">Album Images</h3>
                    <button onclick="closeModal('albumImagesModal')" class="text-gray-400 hover:text-gray-600">
                        <i class="fas fa-times text-2xl"></i>
                    </button>
                </div>

                <!-- Add Images Form -->
                <div class="mb-6 p-4 bg-gray-50 rounded-lg">
                    <h4 class="font-semibold text-gray-800 mb-4">Add Images to Album</h4>
                    <form id="albumImageForm" class="space-y-4">
                        <input type="hidden" name="album_id" id="currentAlbumId">
                        <div>
                            <label class="block text-gray-700 mb-2">Select Images *</label>
                            <input type="file" name="images[]" class="form-input" accept="image/*" multiple required>
                            <p class="text-sm text-gray-500 mt-1">You can select multiple images at once</p>
                        </div>
                        <div class="flex justify-end gap-4">
                            <button type="submit" class="px-4 py-2 bg-purple-600 text-white rounded-lg hover:bg-purple-700">
                                Upload Images
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Album Images Grid -->
                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 mb-6" id="albumImagesGrid">
                    <!-- Album images will be loaded here -->
                </div>

                <div class="flex justify-end gap-4 pt-6 border-t border-gray-200">
                    <button onclick="closeModal('albumImagesModal')" class="px-6 py-3 border border-gray-300 rounded-lg hover:bg-gray-50">
                        Close
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Highlights Modal -->
    <div id="highlightModal" class="modal-overlay">
        <div class="modal-content">
            <div class="p-8">
                <div class="flex justify-between items-center mb-8">
                    <h3 class="font-bold text-gray-800 text-2xl">Manage Highlights</h3>
                    <button onclick="closeModal('highlightModal')" class="text-gray-400 hover:text-gray-600">
                        <i class="fas fa-times text-2xl"></i>
                    </button>
                </div>

                <!-- Add Highlight Form -->
                <div class="mb-6 p-4 bg-gray-50 rounded-lg">
                    <h4 class="font-semibold text-gray-800 mb-4">Add New Highlight</h4>
                    <form id="highlightForm" class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-gray-700 mb-2">Highlight Title *</label>
                            <input type="text" name="title" class="form-input" placeholder="Enter highlight title" required>
                        </div>
                        <div>
                            <label class="block text-gray-700 mb-2">Type</label>
                            <select name="highlight_type" id="highlightType" class="form-select" onchange="toggleHighlightFields()">
                                <option value="image">Image</option>
                                <option value="video">Video</option>
                                <option value="link">Link</option>
                            </select>
                        </div>
                        <div id="imageField">
                            <label class="block text-gray-700 mb-2">Image</label>
                            <input type="file" name="image" class="form-input" accept="image/*">
                        </div>
                        <div id="videoField" style="display: none;">
                            <label class="block text-gray-700 mb-2">Video URL</label>
                            <input type="url" name="video_url" class="form-input" placeholder="https://youtube.com/watch?v=...">
                        </div>
                        <div id="linkField" style="display: none;">
                            <label class="block text-gray-700 mb-2">Link URL</label>
                            <input type="url" name="link_url" class="form-input" placeholder="https://...">
                        </div>
                        <div>
                            <label class="block text-gray-700 mb-2">Sort Order</label>
                            <input type="number" name="sort_order" class="form-input" placeholder="0" min="0">
                        </div>
                        <div>
                            <label class="block text-gray-700 mb-2">Status</label>
                            <select name="status" class="form-select">
                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>
                            </select>
                        </div>
                        <div class="md:col-span-2">
                            <label class="block text-gray-700 mb-2">Description</label>
                            <textarea name="description" class="form-input h-24" placeholder="Highlight description"></textarea>
                        </div>
                        <div class="md:col-span-2 flex justify-end gap-4">
                            <button type="button" onclick="resetHighlightForm()" class="px-4 py-2 border border-gray-300 rounded-lg hover:bg-gray-50">
                                Clear
                            </button>
                            <button type="submit" class="px-4 py-2 bg-yellow-600 text-white rounded-lg hover:bg-yellow-700">
                                Add Highlight
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Highlights List -->
                <div class="mb-6">
                    <h4 class="font-semibold text-gray-800 mb-4">Existing Highlights</h4>
                    <div class="space-y-3" id="highlightsList">
                        <!-- Highlights will be loaded here -->
                    </div>
                </div>

                <div class="flex justify-end gap-4 pt-6 border-t border-gray-200">
                    <button onclick="closeModal('highlightModal')" class="px-6 py-3 border border-gray-300 rounded-lg hover:bg-gray-50">
                        Close
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Gallery Modal -->
    <div id="galleryModal" class="modal-overlay">
        <div class="modal-content">
            <div class="p-8">
                <div class="flex justify-between items-center mb-8">
                    <h3 class="font-bold text-gray-800 text-2xl">Upload Gallery Image</h3>
                    <button onclick="closeModal('galleryModal')" class="text-gray-400 hover:text-gray-600">
                        <i class="fas fa-times text-2xl"></i>
                    </button>
                </div>

                <form id="galleryForm" class="space-y-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-gray-700 mb-2">Image Title (Optional)</label>
                            <input type="text" name="title" class="form-input" placeholder="Enter image title">
                        </div>

                        <div>
                            <label class="block text-gray-700 mb-2">Category (Optional)</label>
                            <select name="category" class="form-select" id="galleryCategorySelect">
                                <option value="">Select Category</option>
                                <!-- Categories will be loaded here -->
                            </select>
                        </div>
                    </div>

                    <div>
                        <label class="block text-gray-700 mb-2">Description (Optional)</label>
                        <textarea name="description" class="form-input h-24" placeholder="Image description"></textarea>
                    </div>

                    <div>
                        <label class="block text-gray-700 mb-2">Image *</label>
                        <input type="file" name="image" class="form-input" accept="image/*" required>
                        <p class="text-sm text-gray-500 mt-1">Upload an image for the gallery (JPG, PNG, GIF)</p>
                        <div id="galleryImagePreview" class="mt-2 hidden">
                            <img id="galleryPreviewImg" class="max-w-xs max-h-48 rounded-lg border" alt="Image preview">
                        </div>
                    </div>

                    <div class="flex justify-end gap-4 pt-6 border-t border-gray-200">
                        <button type="button" onclick="closeModal('galleryModal')" class="px-6 py-3 border border-gray-300 rounded-lg hover:bg-gray-50">
                            Cancel
                        </button>
                        <button type="submit" class="px-6 py-3 bg-accent text-white rounded-lg hover:bg-yellow-600">
                            Upload Image
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Notification Container -->
    <div id="notificationContainer"></div>

    <script>
        // Sample data for different tabs
        const pageTitles = {
            'dashboard': 'Dashboard Overview',
            'activities': 'Manage Activities',
            'gallery': 'Manage Gallery',
            'donations': 'Manage Donations',
            'contacts': 'Contact Messages',
            'settings': 'Settings'
        };
        
        // Show tab function
        function showTab(tabName) {
            // Hide all tab contents
            document.querySelectorAll('.tab-content').forEach(tab => {
                tab.classList.remove('active');
            });

            // Show selected tab
            document.getElementById(tabName + '-tab').classList.add('active');

            // Update page title
            document.getElementById('pageTitle').textContent = pageTitles[tabName];

            // Update active sidebar item
            document.querySelectorAll('.sidebar-item').forEach(item => {
                item.classList.remove('active');
            });

            // Find and activate the corresponding sidebar item
            const sidebarItem = Array.from(document.querySelectorAll('.sidebar-item')).find(item => {
                const text = item.textContent.trim().toLowerCase();
                return text.includes(tabName);
            });

            if (sidebarItem) {
                sidebarItem.classList.add('active');
            }

            // Load data for the tab
            loadTabData(tabName);

            // Close sidebar on mobile
            if (window.innerWidth < 769) {
                const sidebar = document.querySelector('.sidebar');
                if (sidebar.classList.contains('mobile-open')) {
                    toggleSidebar();
                }
            }
        }
        
        // Sidebar Toggle
        function toggleSidebar() {
            const sidebar = document.querySelector('.sidebar');
            const isOpen = sidebar.classList.contains('mobile-open');

            if (isOpen) {
                sidebar.classList.remove('mobile-open');
                // Remove backdrop
                const backdrop = document.querySelector('.sidebar-backdrop');
                if (backdrop) backdrop.remove();
                document.body.style.overflow = 'auto';
            } else {
                sidebar.classList.add('mobile-open');
                // Add backdrop
                const backdrop = document.createElement('div');
                backdrop.className = 'sidebar-backdrop fixed inset-0 bg-black bg-opacity-50 z-30 lg:hidden';
                backdrop.onclick = toggleSidebar;
                document.body.appendChild(backdrop);
                document.body.style.overflow = 'hidden';
            }
        }
        
        // Modal Functions
        function openModal(modalId) {
            document.getElementById(modalId).style.display = 'flex';
            document.body.style.overflow = 'hidden';

            // Load data for specific modals
            if (modalId === 'categoriesModal') {
                loadCategories();
            } else if (modalId === 'videosModal') {
                loadVideos();
                loadCategoriesForSelect('videoCategorySelect');
            } else if (modalId === 'albumsModal') {
                loadAlbums();
                loadCategoriesForSelect('albumCategorySelect');
            } else if (modalId === 'highlightModal') {
                loadHighlights();
            } else if (modalId === 'galleryModal') {
                loadCategoriesForSelect('galleryCategorySelect');
            }
        }
        
        function closeModal(modalId) {
            document.getElementById(modalId).style.display = 'none';
            document.body.style.overflow = 'auto';
        }
        
        // Show Notification
        function showNotification(message, type = 'success') {
            const container = document.getElementById('notificationContainer');
            const notification = document.createElement('div');
            notification.className = `notification ${type}`;
            notification.innerHTML = `
                <i class="fas fa-${type === 'success' ? 'check-circle' : 'exclamation-circle'} text-${type === 'success' ? 'green' : 'red'}-500"></i>
                <div class="flex-1">
                    <p class="font-medium">${message}</p>
                </div>
                <button onclick="this.parentElement.remove()" class="text-gray-400 hover:text-gray-600">
                    <i class="fas fa-times"></i>
                </button>
            `;
            
            container.appendChild(notification);
            
            // Show notification
            setTimeout(() => {
                notification.classList.add('show');
            }, 10);
            
            // Auto remove after 5 seconds
            setTimeout(() => {
                notification.remove();
            }, 5000);
        }
        
        // Load tab data
        function loadTabData(tabName) {
            switch(tabName) {
                case 'dashboard':
                    loadDashboardStats();
                    loadRecentActivities();
                    break;
                case 'activities':
                    loadActivities();
                    loadCategories();
                    break;
                case 'gallery':
                    loadGalleryContent();
                    break;
                case 'donations':
                    loadDonations();
                    break;
                case 'contacts':
                    loadContacts();
                    break;
                case 'settings':
                    break;
            }
        }

        // Load dashboard stats
        function loadDashboardStats() {
            fetch('admin.php', {
                method: 'POST',
                headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                body: 'action=get_stats'
            })
            .then(response => response.json())
            .then(data => {
                document.getElementById('total-activities').textContent = data.activities;
                document.getElementById('total-donations').textContent = 'Ksh ' + parseFloat(data.donations).toLocaleString();
                document.getElementById('donations-this-month').textContent = 'Ksh ' + parseFloat(data.donations_this_month).toLocaleString() + ' this month';
                document.getElementById('total-gallery').textContent = data.gallery;
                document.getElementById('pending-contacts').textContent = data.contacts;
                document.getElementById('unread-messages').textContent = data.contacts + ' unread';
                document.querySelector('.activity-count').textContent = data.activities;
                document.querySelector('.gallery-count').textContent = data.gallery;
                document.querySelector('.donation-count').textContent = data.donations;
                document.querySelector('.contact-count').textContent = data.contacts;
            })
            .catch(error => console.error('Error loading stats:', error));
        }

        // Load recent activities
        function loadRecentActivities() {
            fetch('admin.php', {
                method: 'POST',
                headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                body: 'action=get_activities'
            })
            .then(response => response.json())
            .then(activities => {
                const container = document.getElementById('recent-activities');
                container.innerHTML = '';
                activities.slice(0, 3).forEach(activity => {
                    const statusClass = activity.status === 'completed' ? 'status-completed' : 
                                      activity.status === 'active' ? 'status-pending' : 'status-draft';
                    const statusText = activity.status.charAt(0).toUpperCase() + activity.status.slice(1);
                    container.innerHTML += `
                        <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-full bg-green-100 flex items-center justify-center">
                                    <i class="fas fa-check text-green-600"></i>
                                </div>
                                <div>
                                    <p class="text-sm font-medium">${activity.title}</p>
                                    <p class="text-gray-600 text-xs">${activity.start_date} • ${activity.location}</p>
                                </div>
                            </div>
                            <span class="status-badge ${statusClass}">${statusText}</span>
                        </div>
                    `;
                });
            })
            .catch(error => console.error('Error loading activities:', error));
        }

        // Load activities
        function loadActivities() {
            fetch('admin.php', {
                method: 'POST',
                headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                body: 'action=get_activities'
            })
            .then(response => response.json())
            .then(activities => {
                const tbody = document.getElementById('activities-table-body');
                tbody.innerHTML = '';
                activities.forEach(activity => {
                    const statusClass = activity.status === 'completed' ? 'status-completed' :
                                       activity.status === 'active' ? 'status-pending' : 'status-draft';
                    const categoryName = activity.category_name || 'Uncategorized';
                    const imageHtml = activity.image ? `<img src="${activity.image}" alt="${activity.title}" class="w-12 h-12 rounded-lg object-cover">` : '<div class="w-12 h-12 rounded-lg bg-gray-200 flex items-center justify-center"><i class="fas fa-image text-gray-400"></i></div>';

                    const description = activity.description ? (activity.description.length > 100 ? activity.description.substring(0, 100) + '...' : activity.description) : 'No description';

                    tbody.innerHTML += `
                        <tr>
                            <td>
                                <div class="flex items-center gap-3">
                                    ${imageHtml}
                                    <div>
                                        <div class="font-medium">${activity.title}</div>
                                        <div class="text-sm text-gray-500">${activity.location}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="max-w-xs">
                                <div class="text-sm text-gray-700 truncate" title="${activity.description || ''}">${description}</div>
                            </td>
                            <td><span class="px-2 py-1 bg-blue-100 text-blue-600 text-xs rounded-full">${categoryName}</span></td>
                            <td>${activity.start_date || 'Not set'}</td>
                            <td>${activity.end_date || 'Not set'}</td>
                            <td><span class="status-badge ${statusClass}">${activity.status}</span></td>
                            <td>
                                <div class="flex items-center gap-2">
                                    <button class="w-8 h-8 rounded-lg hover:bg-gray-100 flex items-center justify-center text-blue-600" title="Edit" onclick="editActivity(${activity.id})">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="w-8 h-8 rounded-lg hover:bg-gray-100 flex items-center justify-center text-red-600" title="Delete" onclick="deleteActivity(${activity.id}, '${activity.title}')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    `;
                });
            })
            .catch(error => console.error('Error loading activities:', error));
        }

        // Load all gallery content
        function loadGalleryContent() {
            loadGalleryCategories();
            loadGalleryVideos();
            loadGalleryAlbums();
            loadGalleryHighlights();
            loadGalleryImages();
        }

        // Load gallery categories preview
        function loadGalleryCategories() {
            fetch('admin.php', {
                method: 'POST',
                headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                body: 'action=get_categories'
            })
            .then(response => response.json())
            .then(categories => {
                const container = document.getElementById('gallery-categories');
                container.innerHTML = '';

                if (categories.length === 0) {
                    container.innerHTML = '<p class="text-gray-500 text-sm col-span-full">No categories created yet.</p>';
                    return;
                }

                categories.slice(0, 6).forEach(category => {
                    container.innerHTML += `
                        <div class="bg-blue-50 border border-blue-200 rounded-lg p-3 text-center">
                            <i class="fas fa-tag text-blue-600 text-lg mb-2"></i>
                            <p class="text-sm font-medium text-blue-800">${category.name}</p>
                            <p class="text-xs text-blue-600">${category.description || 'No description'}</p>
                        </div>
                    `;
                });

                if (categories.length > 6) {
                    container.innerHTML += `
                        <div class="bg-gray-50 border border-gray-200 rounded-lg p-3 text-center">
                            <i class="fas fa-plus text-gray-600 text-lg mb-2"></i>
                            <p class="text-sm font-medium text-gray-800">${categories.length - 6} more</p>
                        </div>
                    `;
                }
            })
            .catch(error => console.error('Error loading gallery categories:', error));
        }

        // Load gallery videos preview
        function loadGalleryVideos() {
            fetch('admin.php', {
                method: 'POST',
                headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                body: 'action=get_videos'
            })
            .then(response => response.json())
            .then(videos => {
                const container = document.getElementById('gallery-videos');
                container.innerHTML = '';

                if (videos.length === 0) {
                    container.innerHTML = '<p class="text-gray-500 text-sm">No videos added yet.</p>';
                    return;
                }

                videos.slice(0, 3).forEach(video => {
                    const statusClass = video.status === 'active' ? 'status-completed' : 'status-draft';
                    container.innerHTML += `
                        <div class="flex items-center gap-4 p-3 bg-gray-50 rounded-lg">
                            <div class="w-16 h-12 bg-red-100 rounded flex items-center justify-center">
                                <i class="fas fa-play text-red-600"></i>
                            </div>
                            <div class="flex-1">
                                <h5 class="font-medium text-gray-800">${video.title}</h5>
                                <p class="text-gray-600 text-sm">${video.category || 'No category'} • ${new Date(video.created_at).toLocaleDateString()}</p>
                            </div>
                            <span class="status-badge ${statusClass} text-xs">${video.status}</span>
                        </div>
                    `;
                });

                if (videos.length > 3) {
                    container.innerHTML += `<p class="text-gray-500 text-sm text-center mt-2">${videos.length - 3} more videos...</p>`;
                }
            })
            .catch(error => console.error('Error loading gallery videos:', error));
        }

        // Load gallery albums preview
        function loadGalleryAlbums() {
            fetch('admin.php', {
                method: 'POST',
                headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                body: 'action=get_albums'
            })
            .then(response => response.json())
            .then(albums => {
                const container = document.getElementById('gallery-albums');
                container.innerHTML = '';

                if (albums.length === 0) {
                    container.innerHTML = '<p class="text-gray-500 text-sm col-span-full">No albums created yet.</p>';
                    return;
                }

                albums.slice(0, 6).forEach(album => {
                    const statusClass = album.status === 'active' ? 'status-completed' : 'status-draft';
                    const coverHtml = album.cover_image ? `<img src="${album.cover_image}" alt="${album.title}" class="w-full h-32 object-cover rounded-t-lg">` : '<div class="w-full h-32 bg-gray-200 rounded-t-lg flex items-center justify-center"><i class="fas fa-images text-gray-400 text-2xl"></i></div>';

                    container.innerHTML += `
                        <div class="border border-gray-200 rounded-lg overflow-hidden">
                            ${coverHtml}
                            <div class="p-3">
                                <h5 class="font-medium text-gray-800 mb-1">${album.title}</h5>
                                <p class="text-gray-600 text-sm mb-2">${album.description || 'No description'}</p>
                                <div class="flex items-center justify-between">
                                    <span class="px-2 py-1 bg-green-100 text-green-600 text-xs rounded-full">${album.category || 'General'}</span>
                                    <span class="status-badge ${statusClass} text-xs">${album.status}</span>
                                </div>
                            </div>
                        </div>
                    `;
                });
            })
            .catch(error => console.error('Error loading gallery albums:', error));
        }

        // Load gallery highlights preview
        function loadGalleryHighlights() {
            fetch('admin.php', {
                method: 'POST',
                headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                body: 'action=get_highlights'
            })
            .then(response => response.json())
            .then(highlights => {
                const container = document.getElementById('gallery-highlights');
                container.innerHTML = '';

                if (highlights.length === 0) {
                    container.innerHTML = '<p class="text-gray-500 text-sm col-span-full">No highlights created yet.</p>';
                    return;
                }

                highlights.slice(0, 6).forEach(highlight => {
                    const statusClass = highlight.status === 'active' ? 'status-completed' : 'status-draft';
                    let mediaHtml = '';

                    if (highlight.highlight_type === 'image' && highlight.image_path) {
                        mediaHtml = `<img src="${highlight.image_path}" alt="${highlight.title}" class="w-full h-24 object-cover rounded-t-lg">`;
                    } else if (highlight.highlight_type === 'video') {
                        mediaHtml = '<div class="w-full h-24 bg-red-100 rounded-t-lg flex items-center justify-center"><i class="fas fa-play text-red-600 text-2xl"></i></div>';
                    } else {
                        mediaHtml = '<div class="w-full h-24 bg-blue-100 rounded-t-lg flex items-center justify-center"><i class="fas fa-link text-blue-600 text-2xl"></i></div>';
                    }

                    container.innerHTML += `
                        <div class="border border-gray-200 rounded-lg overflow-hidden">
                            ${mediaHtml}
                            <div class="p-3">
                                <h5 class="font-medium text-gray-800 mb-1">${highlight.title}</h5>
                                <p class="text-gray-600 text-sm mb-2">${highlight.description || 'No description'}</p>
                                <div class="flex items-center justify-between">
                                    <span class="px-2 py-1 bg-yellow-100 text-yellow-600 text-xs rounded-full">${highlight.highlight_type}</span>
                                    <span class="status-badge ${statusClass} text-xs">${highlight.status}</span>
                                </div>
                            </div>
                        </div>
                    `;
                });
            })
            .catch(error => console.error('Error loading gallery highlights:', error));
        }

        // Load gallery images
        function loadGalleryImages() {
            fetch('admin.php', {
                method: 'POST',
                headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                body: 'action=get_gallery'
            })
            .then(response => response.json())
            .then(images => {
                const container = document.getElementById('gallery-images');
                container.innerHTML = '';

                if (images.length === 0) {
                    container.innerHTML = '<p class="text-gray-500 text-sm col-span-full">No images uploaded yet.</p>';
                    return;
                }

                images.slice(0, 8).forEach(image => {
                    container.innerHTML += `
                        <div class="border border-gray-200 rounded-lg overflow-hidden">
                            <div class="h-32 overflow-hidden">
                                <img src="${image.image_path}"
                                     alt="${image.title || 'Gallery'}"
                                     class="w-full h-full object-cover hover:scale-110 transition-transform duration-500">
                            </div>
                            <div class="p-2 flex justify-between items-center">
                                <div>
                                    <p class="text-xs font-medium truncate">${image.title || 'Untitled'}</p>
                                    <p class="text-gray-500 text-xs">${new Date(image.uploaded_at).toLocaleDateString()}</p>
                                </div>
                                <button class="text-red-600 hover:text-red-800" onclick="deleteGalleryImage(${image.id}, '${image.title || 'this image'}')">
                                    <i class="fas fa-trash text-sm"></i>
                                </button>
                            </div>
                        </div>
                    `;
                });

                if (images.length > 8) {
                    container.innerHTML += `
                        <div class="border border-gray-200 rounded-lg flex items-center justify-center h-32 bg-gray-50">
                            <div class="text-center">
                                <i class="fas fa-plus text-gray-400 text-2xl mb-2"></i>
                                <p class="text-gray-500 text-sm">${images.length - 8} more images</p>
                            </div>
                        </div>
                    `;
                }
            })
            .catch(error => console.error('Error loading gallery images:', error));
        }

        // Load gallery (legacy function for modal)
        function loadGallery() {
            loadGalleryImages();
        }

        // Load donations
        function loadDonations() {
            fetch('admin.php', {
                method: 'POST',
                headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                body: 'action=get_donations'
            })
            .then(response => response.json())
            .then(donations => {
                const tbody = document.getElementById('donations-table-body');
                tbody.innerHTML = '';
                donations.forEach(donation => {
                    const statusClass = donation.status === 'completed' ? 'status-completed' : 'status-pending';
                    tbody.innerHTML += `
                        <tr>
                            <td class="font-medium">${donation.donor_name}</td>
                            <td>${donation.currency} ${parseFloat(donation.amount).toLocaleString()}</td>
                            <td>${new Date(donation.donation_date).toLocaleDateString()}</td>
                            <td><span class="status-badge ${statusClass}">${donation.status}</span></td>
                            <td>
                                <div class="flex items-center gap-2">
                                    <button class="text-blue-600 hover:text-blue-800 text-sm">
                                        View Details
                                    </button>
                                    <button class="text-red-600 hover:text-red-800 text-sm" onclick="deleteDonation(${donation.id}, '${donation.donor_name}')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    `;
                });
            })
            .catch(error => console.error('Error loading donations:', error));
        }

        // Load contacts
        function loadContacts() {
            fetch('admin.php', {
                method: 'POST',
                headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                body: 'action=get_contacts'
            })
            .then(response => response.json())
            .then(contacts => {
                const list = document.getElementById('contacts-list');
                list.innerHTML = '';
                contacts.forEach(contact => {
                    const statusClass = contact.is_read ? 'Read' : 'Unread';
                    const statusColor = contact.is_read ? 'green' : 'red';
                    list.innerHTML += `
                        <div class="dashboard-card p-6">
                            <div class="flex items-start justify-between mb-4">
                                <div>
                                    <h4 class="font-medium">${contact.name}</h4>
                                    <p class="text-gray-600 text-sm">${contact.email} • ${contact.phone || 'No phone'}</p>
                                    ${contact.subject ? `<p class="text-blue-600 text-sm font-medium">Subject: ${contact.subject}</p>` : ''}
                                </div>
                                <span class="px-2 py-1 bg-${statusColor}-100 text-${statusColor}-600 text-xs rounded-full">${statusClass}</span>
                            </div>
                            <p class="text-gray-700 mb-4">${contact.message}</p>
                            <div class="flex items-center justify-between">
                                <span class="text-gray-500 text-xs">${new Date(contact.created_at).toLocaleString()}</span>
                                <div class="flex items-center gap-2">
                                    <button class="px-3 py-1 bg-gray-100 text-gray-700 rounded text-sm hover:bg-gray-200" onclick="markAsRead(${contact.id})">
                                        Mark as Read
                                    </button>
                                    <button class="px-3 py-1 bg-accent text-white rounded text-sm hover:bg-yellow-600" onclick="replyToContact(this.dataset.email)" data-email="${contact.email}">
                                        Reply
                                    </button>
                                    <button class="px-3 py-1 bg-red-100 text-red-600 rounded text-sm hover:bg-red-200" onclick="deleteContact(this.dataset.id, this.dataset.name)" data-id="${contact.id}" data-name="${contact.name}">
                                        <i class="fas fa-trash mr-1"></i>Delete
                                    </button>
                                </div>
                            </div>
                        </div>
                    `;
                });
            })
            .catch(error => console.error('Error loading contacts:', error));
        }

        // Load categories
        function loadCategories() {
            fetch('admin.php', {
                method: 'POST',
                headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                body: 'action=get_categories'
            })
            .then(response => response.json())
            .then(categories => {
                const select = document.getElementById('categorySelect');
                const list = document.getElementById('categoriesList');

                // Clear existing options except the first one
                select.innerHTML = '<option value="">Select Category</option>';
                list.innerHTML = '';

                categories.forEach(category => {
                    // Add to activity form dropdown
                    select.innerHTML += `<option value="${category.id}">${category.name}</option>`;

                    // Add to categories list
                    list.innerHTML += `
                        <div class="flex items-center justify-between p-4 bg-white rounded-lg border border-gray-200">
                            <div>
                                <h5 class="font-medium text-gray-800">${category.name}</h5>
                                <p class="text-gray-600 text-sm">${category.description || 'No description'}</p>
                            </div>
                            <div class="flex items-center gap-2">
                                <button class="px-3 py-1 bg-blue-100 text-blue-600 rounded text-sm hover:bg-blue-200" onclick="editCategory(${category.id}, '${category.name}', '${category.description || ''}')">
                                    <i class="fas fa-edit mr-1"></i>Edit
                                </button>
                                <button class="px-3 py-1 bg-red-100 text-red-600 rounded text-sm hover:bg-red-200" onclick="deleteCategory(${category.id}, '${category.name}')">
                                    <i class="fas fa-trash mr-1"></i>Delete
                                </button>
                            </div>
                        </div>
                    `;
                });
            })
            .catch(error => console.error('Error loading categories:', error));
        }

        // Handle form submissions
        document.getElementById('activityForm').addEventListener('submit', function(e) {
            e.preventDefault();
            const formData = new FormData(this);
            formData.append('action', 'add_activity');

            // Show loading state
            const submitBtn = this.querySelector('button[type="submit"]');
            const originalText = submitBtn.innerHTML;
            submitBtn.disabled = true;
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Uploading...';

            fetch('admin.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    closeModal('activityModal');
                    showNotification('Activity saved successfully!', 'success');
                    loadActivities();
                    loadDashboardStats();
                    this.reset();
                    document.getElementById('imagePreview').classList.add('hidden');
                } else {
                    showNotification(data.error || 'Error saving activity', 'error');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showNotification('Error saving activity', 'error');
            })
            .finally(() => {
                // Reset loading state
                submitBtn.disabled = false;
                submitBtn.innerHTML = originalText;
            });
        });

        // Handle category form
        document.getElementById('categoryForm').addEventListener('submit', function(e) {
            e.preventDefault();
            const formData = new FormData(this);
            formData.append('action', 'add_category');

            // Show loading state
            const submitBtn = this.querySelector('button[type="submit"]');
            const originalText = submitBtn.innerHTML;
            submitBtn.disabled = true;
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Saving...';

            fetch('admin.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    showNotification('Category added successfully!', 'success');
                    loadCategories();
                    this.reset();
                } else {
                    showNotification(data.error || 'Error adding category', 'error');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showNotification('Error adding category', 'error');
            })
            .finally(() => {
                // Reset loading state
                submitBtn.disabled = false;
                submitBtn.innerHTML = originalText;
            });
        });

        // Handle edit activity form
        document.getElementById('editActivityForm').addEventListener('submit', function(e) {
            e.preventDefault();
            const formData = new FormData(this);
            formData.append('action', 'update_activity');

            // Show loading state
            const submitBtn = this.querySelector('button[type="submit"]');
            const originalText = submitBtn.innerHTML;
            submitBtn.disabled = true;
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Uploading...';

            fetch('admin.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    closeModal('editActivityModal');
                    showNotification('Activity updated successfully!', 'success');
                    loadActivities();
                    loadDashboardStats();
                } else {
                    showNotification(data.error || 'Error updating activity', 'error');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showNotification('Error updating activity', 'error');
            })
            .finally(() => {
                // Reset loading state
                submitBtn.disabled = false;
                submitBtn.innerHTML = originalText;
            });
        });

        // Handle video form
        document.getElementById('videoForm').addEventListener('submit', function(e) {
            e.preventDefault();
            const formData = new FormData(this);
            formData.append('action', 'add_video');

            // Show loading state
            const submitBtn = this.querySelector('button[type="submit"]');
            const originalText = submitBtn.innerHTML;
            submitBtn.disabled = true;
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Saving...';

            fetch('admin.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    showNotification('Video added successfully!', 'success');
                    loadVideos();
                    resetVideoForm();
                } else {
                    showNotification(data.error || 'Error adding video', 'error');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showNotification('Error adding video', 'error');
            })
            .finally(() => {
                // Reset loading state
                submitBtn.disabled = false;
                submitBtn.innerHTML = originalText;
            });
        });

        // Handle album form
        document.getElementById('albumForm').addEventListener('submit', function(e) {
            e.preventDefault();
            const formData = new FormData(this);
            formData.append('action', 'add_album');

            // Show loading state
            const submitBtn = this.querySelector('button[type="submit"]');
            const originalText = submitBtn.innerHTML;
            submitBtn.disabled = true;
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Uploading...';

            fetch('admin.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    showNotification('Album added successfully!', 'success');
                    loadAlbums();
                    resetAlbumForm();
                } else {
                    showNotification(data.error || 'Error adding album', 'error');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showNotification('Error adding album', 'error');
            })
            .finally(() => {
                // Reset loading state
                submitBtn.disabled = false;
                submitBtn.innerHTML = originalText;
            });
        });

        // Handle album image form
        document.getElementById('albumImageForm').addEventListener('submit', function(e) {
            e.preventDefault();
            const formData = new FormData(this);
            formData.append('action', 'add_album_image');

            // Show loading state
            const submitBtn = this.querySelector('button[type="submit"]');
            const originalText = submitBtn.innerHTML;
            submitBtn.disabled = true;
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Uploading...';

            fetch('admin.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    showNotification(`${data.uploaded} image(s) added to album successfully!`, 'success');
                    if (data.errors && data.errors.length > 0) {
                        showNotification('Some images failed: ' + data.errors.join(', '), 'error');
                    }
                    const albumId = document.getElementById('currentAlbumId').value;
                    loadAlbumImages(albumId);
                    this.reset();
                } else {
                    showNotification(data.error || 'Error adding images', 'error');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showNotification('Error adding images', 'error');
            })
            .finally(() => {
                // Reset loading state
                submitBtn.disabled = false;
                submitBtn.innerHTML = originalText;
            });
        });

        // Handle highlight form
        document.getElementById('highlightForm').addEventListener('submit', function(e) {
            e.preventDefault();
            const formData = new FormData(this);
            formData.append('action', 'add_highlight');

            // Show loading state
            const submitBtn = this.querySelector('button[type="submit"]');
            const originalText = submitBtn.innerHTML;
            submitBtn.disabled = true;
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Uploading...';

            fetch('admin.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    showNotification('Highlight added successfully!', 'success');
                    loadHighlights();
                    resetHighlightForm();
                } else {
                    showNotification(data.error || 'Error adding highlight', 'error');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showNotification('Error adding highlight', 'error');
            })
            .finally(() => {
                // Reset loading state
                submitBtn.disabled = false;
                submitBtn.innerHTML = originalText;
            });
        });
        
        document.getElementById('donationForm').addEventListener('submit', function(e) {
            e.preventDefault();
            const formData = new FormData(this);
            formData.append('action', 'add_donation');

            // Show loading state
            const submitBtn = this.querySelector('button[type="submit"]');
            const originalText = submitBtn.innerHTML;
            submitBtn.disabled = true;
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Saving...';

            fetch('admin.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    closeModal('donationModal');
                    showNotification('Donation record saved!', 'success');
                    loadDonations();
                    loadDashboardStats();
                } else {
                    showNotification(data.error || 'Error saving donation', 'error');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showNotification('Error saving donation', 'error');
            })
            .finally(() => {
                // Reset loading state
                submitBtn.disabled = false;
                submitBtn.innerHTML = originalText;
            });
        });

        // Handle gallery form
        document.getElementById('galleryForm').addEventListener('submit', function(e) {
            e.preventDefault();
            const formData = new FormData(this);
            formData.append('action', 'add_gallery_image');

            // Show loading state
            const submitBtn = this.querySelector('button[type="submit"]');
            const originalText = submitBtn.innerHTML;
            submitBtn.disabled = true;
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Uploading...';

            fetch('admin.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    closeModal('galleryModal');
                    showNotification('Gallery image uploaded successfully!', 'success');
                    loadGalleryImages();
                    loadDashboardStats();
                    this.reset();
                    document.getElementById('galleryImagePreview').classList.add('hidden');
                } else {
                    showNotification(data.error || 'Error uploading image', 'error');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showNotification('Error uploading image', 'error');
            })
            .finally(() => {
                // Reset loading state
                submitBtn.disabled = false;
                submitBtn.innerHTML = originalText;
            });
        });

        // Mark contact as read
        function markAsRead(contactId) {
            fetch('admin.php', {
                method: 'POST',
                headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                body: `action=mark_contact_read&id=${contactId}&is_read=1`
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    loadContacts();
                    loadDashboardStats();
                }
            })
            .catch(error => console.error('Error marking as read:', error));
        }
        
        // Category management functions
        function editCategory(id, name, description) {
            document.querySelector('input[name="name"]').value = name;
            document.querySelector('input[name="description"]').value = description;

            // Change form to edit mode
            const form = document.getElementById('categoryForm');
            const submitBtn = form.querySelector('button[type="submit"]');
            submitBtn.textContent = 'Update Category';
            submitBtn.onclick = function(e) {
                e.preventDefault();
                updateCategory(id);
            };
        }

        function updateCategory(id) {
            const name = document.querySelector('input[name="name"]').value;
            const description = document.querySelector('input[name="description"]').value;

            const formData = new FormData();
            formData.append('action', 'update_category');
            formData.append('id', id);
            formData.append('name', name);
            formData.append('description', description);

            fetch('admin.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    showNotification('Category updated successfully!', 'success');
                    loadCategories();
                    resetCategoryForm();
                } else {
                    showNotification(data.error || 'Error updating category', 'error');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showNotification('Error updating category', 'error');
            });
        }

        function deleteCategory(id, name) {
            if (confirm(`Are you sure you want to delete the category "${name}"? This may affect existing activities.`)) {
                fetch('admin.php', {
                    method: 'POST',
                    headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                    body: `action=delete_category&id=${id}`
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        showNotification('Category deleted successfully!', 'success');
                        loadCategories();
                    } else {
                        showNotification(data.error || 'Error deleting category', 'error');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    showNotification('Error deleting category', 'error');
                });
            }
        }

        function resetCategoryForm() {
            const form = document.getElementById('categoryForm');
            form.reset();
            const submitBtn = form.querySelector('button[type="submit"]');
            submitBtn.textContent = 'Add Category';
            submitBtn.onclick = null;
        }

        // Activity management functions
        function editActivity(id) {
            // Fetch activity data
            fetch('admin.php', {
                method: 'POST',
                headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                body: `action=get_activity&id=${id}`
            })
            .then(response => response.json())
            .then(activity => {
                // Populate form fields
                document.getElementById('editActivityId').value = activity.id;
                document.getElementById('editTitle').value = activity.title;
                document.getElementById('editDescription').value = activity.description || '';
                document.getElementById('editStartDate').value = activity.start_date || '';
                document.getElementById('editEndDate').value = activity.end_date || '';
                document.getElementById('editLocation').value = activity.location || '';
                document.getElementById('editStatus').value = activity.status || 'draft';
                document.getElementById('editExistingImage').value = activity.image || '';

                // Load categories and set selected
                loadCategoriesForEdit(activity.category_id);

                // Show current image if exists
                const preview = document.getElementById('editImagePreview');
                const previewImg = document.getElementById('editPreviewImg');
                if (activity.image) {
                    previewImg.src = activity.image;
                    preview.classList.remove('hidden');
                } else {
                    preview.classList.add('hidden');
                }

                // Open modal
                openModal('editActivityModal');
            })
            .catch(error => {
                console.error('Error loading activity:', error);
                showNotification('Error loading activity data', 'error');
            });
        }

        function loadCategoriesForSelect(selectId) {
            fetch('admin.php', {
                method: 'POST',
                headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                body: 'action=get_categories'
            })
            .then(response => response.json())
            .then(categories => {
                const select = document.getElementById(selectId);
                if (select) {
                    select.innerHTML = '<option value="">Select Category</option>';

                    categories.forEach(category => {
                        const option = document.createElement('option');
                        option.value = category.name; // Use category name as value
                        option.textContent = category.name;
                        select.appendChild(option);
                    });
                }
            })
            .catch(error => console.error('Error loading categories for select:', error));
        }

        function loadCategoriesForEdit(selectedId) {
            fetch('admin.php', {
                method: 'POST',
                headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                body: 'action=get_categories'
            })
            .then(response => response.json())
            .then(categories => {
                const select = document.getElementById('editCategorySelect');
                select.innerHTML = '<option value="">Select Category</option>';

                categories.forEach(category => {
                    const option = document.createElement('option');
                    option.value = category.id;
                    option.textContent = category.name;
                    if (category.id == selectedId) {
                        option.selected = true;
                    }
                    select.appendChild(option);
                });
            })
            .catch(error => console.error('Error loading categories for edit:', error));
        }

        function deleteActivity(id, title) {
            if (confirm(`Are you sure you want to delete the activity "${title}"? This action cannot be undone.`)) {
                fetch('admin.php', {
                    method: 'POST',
                    headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                    body: `action=delete_activity&id=${id}`
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        showNotification('Activity deleted successfully!', 'success');
                        loadActivities();
                        loadDashboardStats();
                    } else {
                        showNotification(data.error || 'Error deleting activity', 'error');
                    }
                })
                .catch(error => {
                    console.error('Error deleting activity:', error);
                    showNotification('Error deleting activity', 'error');
                });
            }
        }

        // Utility Functions
        function deleteItem(type) {
            if (confirm(`Are you sure you want to delete this ${type}?`)) {
                showNotification(`${type.charAt(0).toUpperCase() + type.slice(1)} deleted successfully`, 'success');
            }
        }
        
        function filterMessages(filter) {
            // In a real app, this would filter the messages
            showNotification(`Showing ${filter} messages`, 'success');
        }
        
        // Update Date
        function updateDate() {
            const now = new Date();
            const date = now.toLocaleDateString('en-US', { 
                weekday: 'long', 
                year: 'numeric', 
                month: 'long', 
                day: 'numeric' 
            });
            document.getElementById('currentDate').textContent = date;
        }
        
        // Logout Function
        function logout() {
            if (confirm('Are you sure you want to logout?')) {
                window.location.href = 'admin.php?logout=1';
            }
        }
        
        // Image preview functionality
        function previewImage(input) {
            const preview = document.getElementById('imagePreview');
            const previewImg = document.getElementById('previewImg');

            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    previewImg.src = e.target.result;
                    preview.classList.remove('hidden');
                };
                reader.readAsDataURL(input.files[0]);
            } else {
                preview.classList.add('hidden');
            }
        }

        function previewEditImage(input) {
            const preview = document.getElementById('editImagePreview');
            const previewImg = document.getElementById('editPreviewImg');

            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    previewImg.src = e.target.result;
                    preview.classList.remove('hidden');
                };
                reader.readAsDataURL(input.files[0]);
            }
        }

        function previewGalleryImage(input) {
            const preview = document.getElementById('galleryImagePreview');
            const previewImg = document.getElementById('galleryPreviewImg');

            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    previewImg.src = e.target.result;
                    preview.classList.remove('hidden');
                };
                reader.readAsDataURL(input.files[0]);
            } else {
                preview.classList.add('hidden');
            }
        }

        // Initialize when page loads
        document.addEventListener('DOMContentLoaded', () => {
            updateDate();
            loadDashboardStats();
            loadRecentActivities();

            // Add image preview listeners
            const imageInput = document.querySelector('input[name="image"]');
            if (imageInput) {
                imageInput.addEventListener('change', function() {
                    previewImage(this);
                });
            }

            const editImageInput = document.getElementById('editImage');
            if (editImageInput) {
                editImageInput.addEventListener('change', function() {
                    previewEditImage(this);
                });
            }

            const galleryImageInput = document.querySelector('#galleryForm input[name="image"]');
            if (galleryImageInput) {
                galleryImageInput.addEventListener('change', function() {
                    previewGalleryImage(this);
                });
            }

            // Close modals with ESC key
            document.addEventListener('keydown', (e) => {
                if (e.key === 'Escape') {
                    document.querySelectorAll('.modal-overlay').forEach(modal => {
                        modal.style.display = 'none';
                        document.body.style.overflow = 'auto';
                    });
                }
            });

            // Close modal when clicking outside
            document.querySelectorAll('.modal-overlay').forEach(overlay => {
                overlay.addEventListener('click', (e) => {
                    if (e.target === overlay) {
                        overlay.style.display = 'none';
                        document.body.style.overflow = 'auto';
                    }
                });
            });

            // Handle password change form
            document.getElementById('changePasswordForm').addEventListener('submit', function(e) {
                e.preventDefault();
                const formData = new FormData(this);
                formData.append('action', 'change_password');

                // Show loading state
                const submitBtn = this.querySelector('button[type="submit"]');
                const originalText = submitBtn.innerHTML;
                submitBtn.disabled = true;
                submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Changing...';

                fetch('admin.php', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        showNotification('Password changed successfully! You will be logged out.', 'success');
                        setTimeout(() => {
                            window.location.href = 'login.php';
                        }, 2000);
                    } else {
                        showNotification(data.error || 'Error changing password', 'error');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    showNotification('Error changing password', 'error');
                })
                .finally(() => {
                    // Reset loading state
                    submitBtn.disabled = false;
                    submitBtn.innerHTML = originalText;
                });
            });
        });
        
        // Gallery management functions
        function loadVideos() {
            fetch('admin.php', {
                method: 'POST',
                headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                body: 'action=get_videos'
            })
            .then(response => response.json())
            .then(videos => {
                const list = document.getElementById('videosList');
                list.innerHTML = '';

                videos.forEach(video => {
                    const statusClass = video.status === 'active' ? 'status-completed' : 'status-draft';
                    list.innerHTML += `
                        <div class="flex items-center justify-between p-4 bg-white rounded-lg border border-gray-200">
                            <div class="flex items-center gap-4">
                                <div class="w-16 h-12 bg-gray-200 rounded flex items-center justify-center">
                                    <i class="fas fa-play text-gray-600"></i>
                                </div>
                                <div>
                                    <h5 class="font-medium text-gray-800">${video.title}</h5>
                                    <p class="text-gray-600 text-sm">${video.category || 'No category'}</p>
                                    <span class="status-badge ${statusClass} text-xs">${video.status}</span>
                                </div>
                            </div>
                            <div class="flex items-center gap-2">
                                <button class="px-3 py-1 bg-blue-100 text-blue-600 rounded text-sm hover:bg-blue-200" onclick="editVideo(${video.id}, '${video.title}', '${video.description || ''}', '${video.video_url}', '${video.thumbnail || ''}', '${video.category || ''}', '${video.status}')">
                                    <i class="fas fa-edit mr-1"></i>Edit
                                </button>
                                <button class="px-3 py-1 bg-red-100 text-red-600 rounded text-sm hover:bg-red-200" onclick="deleteVideo(${video.id}, '${video.title}')">
                                    <i class="fas fa-trash mr-1"></i>Delete
                                </button>
                            </div>
                        </div>
                    `;
                });
            })
            .catch(error => console.error('Error loading videos:', error));
        }

        function editVideo(id, title, description, videoUrl, thumbnail, category, status) {
            document.querySelector('#videoForm input[name="title"]').value = title;
            document.querySelector('#videoForm textarea[name="description"]').value = description || '';
            document.querySelector('#videoForm input[name="video_url"]').value = videoUrl;
            document.querySelector('#videoForm input[name="thumbnail"]').value = thumbnail || '';
            document.querySelector('#videoForm input[name="category"]').value = category || '';
            document.querySelector('#videoForm select[name="status"]').value = status;

            const form = document.getElementById('videoForm');
            const submitBtn = form.querySelector('button[type="submit"]');
            submitBtn.textContent = 'Update Video';
            submitBtn.onclick = function(e) {
                e.preventDefault();
                updateVideo(id);
            };
        }

        function updateVideo(id) {
            const formData = new FormData(document.getElementById('videoForm'));
            formData.append('action', 'update_video');
            formData.append('id', id);

            fetch('admin.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    showNotification('Video updated successfully!', 'success');
                    loadVideos();
                    resetVideoForm();
                } else {
                    showNotification(data.error || 'Error updating video', 'error');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showNotification('Error updating video', 'error');
            });
        }

        function deleteVideo(id, title) {
            if (confirm(`Are you sure you want to delete the video "${title}"?`)) {
                fetch('admin.php', {
                    method: 'POST',
                    headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                    body: `action=delete_video&id=${id}`
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        showNotification('Video deleted successfully!', 'success');
                        loadVideos();
                    } else {
                        showNotification(data.error || 'Error deleting video', 'error');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    showNotification('Error deleting video', 'error');
                });
            }
        }

        function resetVideoForm() {
            const form = document.getElementById('videoForm');
            form.reset();
            const submitBtn = form.querySelector('button[type="submit"]');
            submitBtn.textContent = 'Add Video';
            submitBtn.onclick = null;
        }

        // Albums management functions
        function loadAlbums() {
            fetch('admin.php', {
                method: 'POST',
                headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                body: 'action=get_albums'
            })
            .then(response => response.json())
            .then(albums => {
                const list = document.getElementById('albumsList');
                list.innerHTML = '';

                albums.forEach(album => {
                    const statusClass = album.status === 'active' ? 'status-completed' : 'status-draft';
                    const coverHtml = album.cover_image ? `<img src="${album.cover_image}" alt="${album.title}" class="w-16 h-12 rounded object-cover">` : '<div class="w-16 h-12 rounded bg-gray-200 flex items-center justify-center"><i class="fas fa-images text-gray-400"></i></div>';

                    list.innerHTML += `
                        <div class="flex items-center justify-between p-4 bg-white rounded-lg border border-gray-200">
                            <div class="flex items-center gap-4">
                                ${coverHtml}
                                <div>
                                    <h5 class="font-medium text-gray-800">${album.title}</h5>
                                    <p class="text-gray-600 text-sm">${album.category || 'No category'}</p>
                                    <span class="status-badge ${statusClass} text-xs">${album.status}</span>
                                </div>
                            </div>
                            <div class="flex items-center gap-2">
                                <button class="px-3 py-1 bg-purple-100 text-purple-600 rounded text-sm hover:bg-purple-200" onclick="manageAlbumImages(${album.id}, '${album.title}')">
                                    <i class="fas fa-images mr-1"></i>Images
                                </button>
                                <button class="px-3 py-1 bg-blue-100 text-blue-600 rounded text-sm hover:bg-blue-200" onclick="editAlbum(${album.id}, '${album.title}', '${album.description || ''}', '${album.category || ''}', '${album.status}')">
                                    <i class="fas fa-edit mr-1"></i>Edit
                                </button>
                                <button class="px-3 py-1 bg-red-100 text-red-600 rounded text-sm hover:bg-red-200" onclick="deleteAlbum(${album.id}, '${album.title}')">
                                    <i class="fas fa-trash mr-1"></i>Delete
                                </button>
                            </div>
                        </div>
                    `;
                });
            })
            .catch(error => console.error('Error loading albums:', error));
        }

        function editAlbum(id, title, description, category, status) {
            document.querySelector('#albumForm input[name="title"]').value = title;
            document.querySelector('#albumForm textarea[name="description"]').value = description || '';
            document.querySelector('#albumForm input[name="category"]').value = category || '';
            document.querySelector('#albumForm select[name="status"]').value = status;

            const form = document.getElementById('albumForm');
            const submitBtn = form.querySelector('button[type="submit"]');
            submitBtn.textContent = 'Update Album';
            submitBtn.onclick = function(e) {
                e.preventDefault();
                updateAlbum(id);
            };
        }

        function updateAlbum(id) {
            const formData = new FormData(document.getElementById('albumForm'));
            formData.append('action', 'update_album');
            formData.append('id', id);

            fetch('admin.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    showNotification('Album updated successfully!', 'success');
                    loadAlbums();
                    resetAlbumForm();
                } else {
                    showNotification(data.error || 'Error updating album', 'error');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showNotification('Error updating album', 'error');
            });
        }

        function deleteAlbum(id, title) {
            if (confirm(`Are you sure you want to delete the album "${title}"? This will also delete all images in the album.`)) {
                fetch('admin.php', {
                    method: 'POST',
                    headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                    body: `action=delete_album&id=${id}`
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        showNotification('Album deleted successfully!', 'success');
                        loadAlbums();
                    } else {
                        showNotification(data.error || 'Error deleting album', 'error');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    showNotification('Error deleting album', 'error');
                });
            }
        }

        function resetAlbumForm() {
            const form = document.getElementById('albumForm');
            form.reset();
            const submitBtn = form.querySelector('button[type="submit"]');
            submitBtn.textContent = 'Add Album';
            submitBtn.onclick = null;
        }

        function manageAlbumImages(albumId, albumTitle) {
            document.getElementById('albumImagesTitle').textContent = `Images in "${albumTitle}"`;
            document.getElementById('currentAlbumId').value = albumId;

            loadAlbumImages(albumId);
            openModal('albumImagesModal');
        }

        function loadAlbumImages(albumId) {
            fetch('admin.php', {
                method: 'POST',
                headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                body: `action=get_album_images&album_id=${albumId}`
            })
            .then(response => response.json())
            .then(images => {
                const grid = document.getElementById('albumImagesGrid');
                grid.innerHTML = '';

                images.forEach(image => {
                    grid.innerHTML += `
                        <div class="border border-gray-200 rounded-lg overflow-hidden">
                            <div class="h-32 overflow-hidden">
                                <img src="${image.image_path}" alt="${image.title || 'Album image'}" class="w-full h-full object-cover">
                            </div>
                            <div class="p-3">
                                <p class="text-sm font-medium truncate">${image.title || 'Untitled'}</p>
                                <div class="flex items-center justify-between mt-2">
                                    <span class="text-xs text-gray-500">${new Date(image.created_at).toLocaleDateString()}</span>
                                    <button class="text-red-600 hover:text-red-800" onclick="deleteAlbumImage(${image.id}, '${image.title || 'this image'}')">
                                        <i class="fas fa-trash text-sm"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    `;
                });
            })
            .catch(error => console.error('Error loading album images:', error));
        }

        function deleteAlbumImage(id, title) {
            if (confirm(`Are you sure you want to delete "${title}"?`)) {
                fetch('admin.php', {
                    method: 'POST',
                    headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                    body: `action=delete_album_image&id=${id}`
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        showNotification('Image deleted successfully!', 'success');
                        const albumId = document.getElementById('currentAlbumId').value;
                        loadAlbumImages(albumId);
                    } else {
                        showNotification(data.error || 'Error deleting image', 'error');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    showNotification('Error deleting image', 'error');
                });
            }
        }

        function deleteGalleryImage(id, title) {
            if (confirm(`Are you sure you want to delete "${title}"?`)) {
                fetch('admin.php', {
                    method: 'POST',
                    headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                    body: `action=delete_gallery_image&id=${id}`
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        showNotification('Image deleted successfully!', 'success');
                        loadGalleryImages();
                        loadDashboardStats();
                    } else {
                        showNotification(data.error || 'Error deleting image', 'error');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    showNotification('Error deleting image', 'error');
                });
            }
        }

        function deleteDonation(id, donorName) {
            if (confirm(`Are you sure you want to delete the donation from "${donorName}"?`)) {
                fetch('admin.php', {
                    method: 'POST',
                    headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                    body: `action=delete_donation&id=${id}`
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        showNotification('Donation deleted successfully!', 'success');
                        loadDonations();
                        loadDashboardStats();
                    } else {
                        showNotification(data.error || 'Error deleting donation', 'error');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    showNotification('Error deleting donation', 'error');
                });
            }
        }

        function replyToContact(email) {
            window.open('https://mail.google.com/mail/?view=cm&fs=1&to=' + encodeURIComponent(email), '_blank');
        }

        function deleteContact(id, name) {
            if (confirm(`Are you sure you want to delete the contact from "${name}"?`)) {
                fetch('admin.php', {
                    method: 'POST',
                    headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                    body: `action=delete_contact&id=${id}`
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        showNotification('Contact deleted successfully!', 'success');
                        loadContacts();
                        loadDashboardStats();
                    } else {
                        showNotification(data.error || 'Error deleting contact', 'error');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    showNotification('Error deleting contact', 'error');
                });
            }
        }

        // Highlights management functions
        function loadHighlights() {
            fetch('admin.php', {
                method: 'POST',
                headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                body: 'action=get_highlights'
            })
            .then(response => response.json())
            .then(highlights => {
                const list = document.getElementById('highlightsList');
                list.innerHTML = '';

                highlights.forEach(highlight => {
                    const statusClass = highlight.status === 'active' ? 'status-completed' : 'status-draft';
                    let mediaHtml = '';

                    if (highlight.highlight_type === 'image' && highlight.image_path) {
                        mediaHtml = `<img src="${highlight.image_path}" alt="${highlight.title}" class="w-16 h-12 rounded object-cover">`;
                    } else if (highlight.highlight_type === 'video') {
                        mediaHtml = '<div class="w-16 h-12 rounded bg-red-100 flex items-center justify-center"><i class="fas fa-play text-red-600"></i></div>';
                    } else {
                        mediaHtml = '<div class="w-16 h-12 rounded bg-blue-100 flex items-center justify-center"><i class="fas fa-link text-blue-600"></i></div>';
                    }

                    list.innerHTML += `
                        <div class="flex items-center justify-between p-4 bg-white rounded-lg border border-gray-200">
                            <div class="flex items-center gap-4">
                                ${mediaHtml}
                                <div>
                                    <h5 class="font-medium text-gray-800">${highlight.title}</h5>
                                    <p class="text-gray-600 text-sm">${highlight.highlight_type} • Order: ${highlight.sort_order}</p>
                                    <span class="status-badge ${statusClass} text-xs">${highlight.status}</span>
                                </div>
                            </div>
                            <div class="flex items-center gap-2">
                                <button class="px-3 py-1 bg-blue-100 text-blue-600 rounded text-sm hover:bg-blue-200" onclick="editHighlight(${highlight.id}, '${highlight.title}', '${highlight.description || ''}', '${highlight.image_path || ''}', '${highlight.video_url || ''}', '${highlight.link_url || ''}', '${highlight.highlight_type}', '${highlight.status}', ${highlight.sort_order})">
                                    <i class="fas fa-edit mr-1"></i>Edit
                                </button>
                                <button class="px-3 py-1 bg-red-100 text-red-600 rounded text-sm hover:bg-red-200" onclick="deleteHighlight(${highlight.id}, '${highlight.title}')">
                                    <i class="fas fa-trash mr-1"></i>Delete
                                </button>
                            </div>
                        </div>
                    `;
                });
            })
            .catch(error => console.error('Error loading highlights:', error));
        }

        function editHighlight(id, title, description, imagePath, videoUrl, linkUrl, type, status, sortOrder) {
            document.querySelector('#highlightForm input[name="title"]').value = title;
            document.querySelector('#highlightForm textarea[name="description"]').value = description || '';
            document.querySelector('#highlightForm select[name="highlight_type"]').value = type;
            document.querySelector('#highlightForm select[name="status"]').value = status;
            document.querySelector('#highlightForm input[name="sort_order"]').value = sortOrder;

            toggleHighlightFields();

            if (type === 'video') {
                document.querySelector('#highlightForm input[name="video_url"]').value = videoUrl || '';
            } else if (type === 'link') {
                document.querySelector('#highlightForm input[name="link_url"]').value = linkUrl || '';
            }

            const form = document.getElementById('highlightForm');
            const submitBtn = form.querySelector('button[type="submit"]');
            submitBtn.textContent = 'Update Highlight';
            submitBtn.onclick = function(e) {
                e.preventDefault();
                updateHighlight(id);
            };
        }

        function updateHighlight(id) {
            const formData = new FormData(document.getElementById('highlightForm'));
            formData.append('action', 'update_highlight');
            formData.append('id', id);

            fetch('admin.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    showNotification('Highlight updated successfully!', 'success');
                    loadHighlights();
                    resetHighlightForm();
                } else {
                    showNotification(data.error || 'Error updating highlight', 'error');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showNotification('Error updating highlight', 'error');
            });
        }

        function deleteHighlight(id, title) {
            if (confirm(`Are you sure you want to delete the highlight "${title}"?`)) {
                fetch('admin.php', {
                    method: 'POST',
                    headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                    body: `action=delete_highlight&id=${id}`
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        showNotification('Highlight deleted successfully!', 'success');
                        loadHighlights();
                    } else {
                        showNotification(data.error || 'Error deleting highlight', 'error');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    showNotification('Error deleting highlight', 'error');
                });
            }
        }

        function resetHighlightForm() {
            const form = document.getElementById('highlightForm');
            form.reset();
            toggleHighlightFields();
            const submitBtn = form.querySelector('button[type="submit"]');
            submitBtn.textContent = 'Add Highlight';
            submitBtn.onclick = null;
        }

        function toggleHighlightFields() {
            const type = document.getElementById('highlightType').value;
            document.getElementById('imageField').style.display = type === 'image' ? 'block' : 'none';
            document.getElementById('videoField').style.display = type === 'video' ? 'block' : 'none';
            document.getElementById('linkField').style.display = type === 'link' ? 'block' : 'none';
        }

        function togglePassword(fieldName) {
            const input = document.querySelector(`input[name="${fieldName}"]`);
            const icon = input.nextElementSibling.querySelector('i');
            if (input.type === 'password') {
                input.type = 'text';
                icon.className = 'fas fa-eye-slash';
            } else {
                input.type = 'password';
                icon.className = 'fas fa-eye';
            }
        }

        // Make functions global
        window.toggleSidebar = toggleSidebar;
        window.showTab = showTab;
        window.openModal = openModal;
        window.closeModal = closeModal;
        window.deleteItem = deleteItem;
        window.logout = logout;
        window.filterMessages = filterMessages;
        window.markAsRead = markAsRead;
        window.loadGallery = loadGallery;
        window.loadGalleryContent = loadGalleryContent;
        window.loadVideos = loadVideos;
        window.loadAlbums = loadAlbums;
        window.loadHighlights = loadHighlights;
        window.manageAlbumImages = manageAlbumImages;
        window.togglePassword = togglePassword;
        window.deleteGalleryImage = deleteGalleryImage;
        window.deleteDonation = deleteDonation;

        window.replyToContact = replyToContact;

        window.deleteContact = deleteContact;
    </script>
</body>
</html></content>
