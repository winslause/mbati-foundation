<?php
require 'config.php';

try {
    // Create admins table if not exists
    $pdo->exec("CREATE TABLE IF NOT EXISTS admins (
        id INT AUTO_INCREMENT PRIMARY KEY,
        username VARCHAR(50) UNIQUE NOT NULL,
        password VARCHAR(255) NOT NULL
    )");

    // Create activities table
    $pdo->exec("CREATE TABLE IF NOT EXISTS activities (
        id INT AUTO_INCREMENT PRIMARY KEY,
        title VARCHAR(255) NOT NULL,
        category VARCHAR(100) NOT NULL,
        description TEXT,
        start_date DATE,
        end_date DATE,
        location VARCHAR(255),
        status ENUM('draft', 'upcoming', 'active', 'completed') DEFAULT 'draft',
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    )");

    // Check and add missing columns
    $stmt = $pdo->query("DESCRIBE activities");
    $columns = $stmt->fetchAll(PDO::FETCH_COLUMN, 0);

    if (!in_array('category_id', $columns)) {
        $pdo->exec("ALTER TABLE activities ADD COLUMN category_id INT AFTER title");
        $pdo->exec("ALTER TABLE activities ADD CONSTRAINT fk_category FOREIGN KEY (category_id) REFERENCES categories(id) ON DELETE SET NULL");
    }

    if (!in_array('image', $columns)) {
        $pdo->exec("ALTER TABLE activities ADD COLUMN image VARCHAR(255) AFTER status");
    }

    // Create gallery table
    $pdo->exec("CREATE TABLE IF NOT EXISTS gallery (
        id INT AUTO_INCREMENT PRIMARY KEY,
        title VARCHAR(255),
        image_path VARCHAR(255) NOT NULL,
        category VARCHAR(100),
        description TEXT,
        uploaded_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )");

    // Create donations table
    $pdo->exec("CREATE TABLE IF NOT EXISTS donations (
        id INT AUTO_INCREMENT PRIMARY KEY,
        donor_name VARCHAR(255) NOT NULL,
        email VARCHAR(255),
        amount DECIMAL(10,2) NOT NULL,
        currency VARCHAR(10) DEFAULT 'KES',
        payment_method VARCHAR(50),
        status ENUM('completed', 'processing', 'pending') DEFAULT 'completed',
        notes TEXT,
        donation_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )");

    // Create categories table
    $pdo->exec("CREATE TABLE IF NOT EXISTS categories (
        id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(100) UNIQUE NOT NULL,
        description TEXT,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )");

    // Create videos table
    $pdo->exec("CREATE TABLE IF NOT EXISTS videos (
        id INT AUTO_INCREMENT PRIMARY KEY,
        title VARCHAR(255) NOT NULL,
        description TEXT,
        video_url VARCHAR(500) NOT NULL,
        thumbnail VARCHAR(255),
        category VARCHAR(100),
        status ENUM('active', 'inactive') DEFAULT 'active',
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    )");

    // Create albums table
    $pdo->exec("CREATE TABLE IF NOT EXISTS albums (
        id INT AUTO_INCREMENT PRIMARY KEY,
        title VARCHAR(255) NOT NULL,
        description TEXT,
        cover_image VARCHAR(255),
        category VARCHAR(100),
        status ENUM('active', 'inactive') DEFAULT 'active',
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    )");

    // Create album_images table (for images within albums)
    $pdo->exec("CREATE TABLE IF NOT EXISTS album_images (
        id INT AUTO_INCREMENT PRIMARY KEY,
        album_id INT NOT NULL,
        image_path VARCHAR(255) NOT NULL,
        title VARCHAR(255),
        description TEXT,
        sort_order INT DEFAULT 0,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        FOREIGN KEY (album_id) REFERENCES albums(id) ON DELETE CASCADE
    )");

    // Create highlights table
    $pdo->exec("CREATE TABLE IF NOT EXISTS highlights (
        id INT AUTO_INCREMENT PRIMARY KEY,
        title VARCHAR(255) NOT NULL,
        description TEXT,
        image_path VARCHAR(255),
        video_url VARCHAR(500),
        link_url VARCHAR(500),
        highlight_type ENUM('image', 'video', 'link') DEFAULT 'image',
        status ENUM('active', 'inactive') DEFAULT 'active',
        sort_order INT DEFAULT 0,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    )");

    // Create contacts table
    $pdo->exec("CREATE TABLE IF NOT EXISTS contacts (
        id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(255) NOT NULL,
        email VARCHAR(255) NOT NULL,
        phone VARCHAR(20),
        subject VARCHAR(100),
        message TEXT NOT NULL,
        is_read BOOLEAN DEFAULT FALSE,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )");

    // Check and add missing columns
    $stmt = $pdo->query("DESCRIBE contacts");
    $columns = $stmt->fetchAll(PDO::FETCH_COLUMN, 0);

    if (!in_array('subject', $columns)) {
        $pdo->exec("ALTER TABLE contacts ADD COLUMN subject VARCHAR(100) AFTER phone");
    }

    // Insert default admin if not exists
    $hashed = password_hash('HaroldMbati2024!', PASSWORD_DEFAULT);
    $stmt = $pdo->prepare("INSERT IGNORE INTO admins (username, password) VALUES (?, ?)");
    $stmt->execute(['admin', $hashed]);

    // Insert default categories if not exists
    $defaultCategories = [
        ['Youth Empowerment', 'Programs focused on empowering young people'],
        ['Sports Development', 'Sports and recreational activities'],
        ['School Development', 'Educational programs and school improvements'],
        ['Mother & Child Care', 'Healthcare and support for mothers and children'],
        ['Community Outreach', 'General community support programs'],
        ['Environmental', 'Environmental conservation and awareness'],
        ['Health & Wellness', 'General health and wellness programs']
    ];

    $stmt = $pdo->prepare("INSERT IGNORE INTO categories (name, description) VALUES (?, ?)");
    foreach ($defaultCategories as $category) {
        $stmt->execute($category);
    }

    echo "All tables and default admin initialized successfully.";
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>