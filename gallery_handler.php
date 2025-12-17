<?php
// Enable error reporting for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require 'config.php';

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
header('Access-Control-Allow-Headers: Content-Type');

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $action = $_GET['action'] ?? '';

    // Test database connection
    if ($action === 'test') {
        try {
            $stmt = $pdo->query('SELECT COUNT(*) as count FROM gallery');
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            echo json_encode(['success' => true, 'message' => 'Database connected', 'gallery_count' => $result['count']]);
        } catch (Exception $e) {
            echo json_encode(['success' => false, 'error' => 'Database error: ' . $e->getMessage()]);
        }
        exit;
    }

    try {
        switch ($action) {
            case 'get_categories':
                // Get all categories
                $stmt = $pdo->query("SELECT * FROM categories ORDER BY name");
                $categories = $stmt->fetchAll(PDO::FETCH_ASSOC);
                echo json_encode(['success' => true, 'categories' => $categories]);
                break;

            case 'get_gallery':
                $stmt = $pdo->query("SELECT * FROM gallery ORDER BY uploaded_at DESC");
                $gallery = $stmt->fetchAll(PDO::FETCH_ASSOC);
                echo json_encode(['success' => true, 'images' => $gallery]);
                break;

            case 'get_albums':
                // Get featured albums
                $stmt = $pdo->query("SELECT a.*, COUNT(ai.id) as image_count FROM albums a LEFT JOIN album_images ai ON a.id = ai.album_id WHERE a.status = 'active' GROUP BY a.id ORDER BY a.created_at DESC LIMIT 6");
                $albums = $stmt->fetchAll(PDO::FETCH_ASSOC);
                echo json_encode(['success' => true, 'albums' => $albums]);
                break;

            case 'get_videos':
                // Get videos
                $stmt = $pdo->query("SELECT * FROM videos WHERE status = 'active' ORDER BY created_at DESC LIMIT 6");
                $videos = $stmt->fetchAll(PDO::FETCH_ASSOC);
                echo json_encode(['success' => true, 'videos' => $videos]);
                break;

            case 'get_album_images':
                // Get images for a specific album
                $album_id = $_GET['album_id'] ?? 0;
                $stmt = $pdo->prepare("SELECT * FROM album_images WHERE album_id = ? ORDER BY sort_order, created_at");
                $stmt->execute([$album_id]);
                $images = $stmt->fetchAll(PDO::FETCH_ASSOC);
                echo json_encode(['success' => true, 'images' => $images]);
                break;

            case 'get_activities':
                // Get all activities with category names
                $stmt = $pdo->prepare("
                    SELECT a.*, c.name as category_name
                    FROM activities a
                    LEFT JOIN categories c ON a.category_id = c.id
                    ORDER BY a.created_at DESC
                ");
                $stmt->execute();
                $activities = $stmt->fetchAll(PDO::FETCH_ASSOC);

                // Get stats
                $statsStmt = $pdo->query("
                    SELECT
                        SUM(CASE WHEN status = 'completed' THEN 1 ELSE 0 END) as completed,
                        SUM(CASE WHEN status IN ('active', 'ongoing') THEN 1 ELSE 0 END) as ongoing,
                        SUM(CASE WHEN status IN ('upcoming', 'draft') THEN 1 ELSE 0 END) as upcoming,
                        COUNT(*) as total
                    FROM activities
                ");
                $stats = $statsStmt->fetch(PDO::FETCH_ASSOC);

                // Calculate total beneficiaries (this would be a sum from a field, for now use a placeholder)
                $stats['beneficiaries'] = 500; // Placeholder

                echo json_encode(['success' => true, 'activities' => $activities, 'stats' => $stats]);
                break;

            case 'get_highlight':
                // Get photo of the day (most recent highlight)
                $stmt = $pdo->query("SELECT * FROM highlights WHERE status = 'active' ORDER BY created_at DESC LIMIT 1");
                $highlight = $stmt->fetch(PDO::FETCH_ASSOC);
                echo json_encode(['success' => true, 'highlight' => $highlight]);
                break;

            case 'get_activity':
                // Get single activity details
                $activity_id = $_GET['id'] ?? 0;
                if (!$activity_id) {
                    echo json_encode(['success' => false, 'error' => 'Activity ID required']);
                    break;
                }

                $stmt = $pdo->prepare("
                    SELECT a.*, c.name as category_name
                    FROM activities a
                    LEFT JOIN categories c ON a.category_id = c.id
                    WHERE a.id = ?
                ");
                $stmt->execute([$activity_id]);
                $activity = $stmt->fetch(PDO::FETCH_ASSOC);

                if ($activity) {
                    echo json_encode($activity);
                } else {
                    echo json_encode(['success' => false, 'error' => 'Activity not found']);
                }
                break;

            default:
                echo json_encode(['success' => false, 'error' => 'Invalid action']);
        }
    } catch (PDOException $e) {
        error_log('Gallery handler error: ' . $e->getMessage());
        echo json_encode(['success' => false, 'error' => 'Database error']);
    }
} else {
    echo json_encode(['success' => false, 'error' => 'Method not allowed']);
}
?>