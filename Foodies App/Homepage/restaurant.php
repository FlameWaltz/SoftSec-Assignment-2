<?php include 'db.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Makan Now - Restaurants</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Segoe UI', sans-serif; background: #f7f7f7; color: #333; }

        /* Header */
        .header {
            background: white;
            padding: 15px 20px;
            display: flex;
            align-items: center;
            border-bottom: 1px solid #eee;
            position: sticky;
            top: 0;
            z-index: 100;
        }
        .back-btn {
            text-decoration: none;
            font-size: 22px;
            color: #333;
            margin-right: 15px;
        }
        .header-title {
            flex: 1;
            text-align: center;
            font-size: 20px;
            font-weight: bold;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        /* Filter tabs */
        .filter-tabs {
            display: flex;
            gap: 10px;
            padding: 15px 20px;
            background: white;
            border-bottom: 1px solid #eee;
            overflow-x: auto;
        }
        .tab {
            padding: 8px 20px;
            border-radius: 20px;
            border: 2px solid #ddd;
            background: white;
            font-size: 14px;
            font-weight: bold;
            cursor: pointer;
            white-space: nowrap;
            text-decoration: none;
            color: #555;
            transition: all 0.2s;
        }
        .tab.active, .tab:hover {
            background: #FFCC00;
            border-color: #FFCC00;
            color: black;
        }

        /* Page content */
        .page-content { max-width: 900px; margin: 0 auto; padding: 20px; }

        /* Category Section */
        .category-section { margin-bottom: 35px; }
        .category-heading {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 14px;
            padding-bottom: 8px;
            border-bottom: 2px solid #FFCC00;
            display: inline-block;
        }

        /* Restaurant Cards - horizontal scroll row */
        .restaurant-row {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 15px;
        }

        .rest-card {
            background: white;
            border-radius: 14px;
            overflow: hidden;
            box-shadow: 0 3px 10px rgba(0,0,0,0.08);
            text-decoration: none;
            color: inherit;
            transition: transform 0.2s, box-shadow 0.2s;
            display: block;
        }
        .rest-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 6px 18px rgba(0,0,0,0.13);
        }
        .rest-card img {
            width: 100%;
            height: 140px;
            object-fit: cover;
        }
        .rest-card-body { padding: 12px 14px; }
        .rest-card-name {
            font-size: 16px;
            font-weight: bold;
            margin-bottom: 4px;
        }
        .rest-card-desc {
            font-size: 13px;
            color: #888;
            margin-bottom: 8px;
            line-height: 1.4;
        }
        .rest-card-meta {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        .rating-badge {
            background: #fff3cc;
            color: #b8860b;
            font-size: 12px;
            font-weight: bold;
            padding: 3px 10px;
            border-radius: 20px;
        }
        .cat-badge {
            background: #e8f5e9;
            color: #00A651;
            font-size: 11px;
            font-weight: bold;
            padding: 3px 10px;
            border-radius: 20px;
        }

        @media (max-width: 600px) {
            .restaurant-row { grid-template-columns: 1fr; }
        }
    </style>
</head>
<body>

<div class="header">
    <a href="homepage.php" class="back-btn">←</a>
    <div class="header-title">🍱 Makan Now</div>
</div>

<!-- Filter Tabs -->
<div class="filter-tabs">
    <a href="restaurant.php" class="tab <?= !isset($_GET['category']) ? 'active' : '' ?>">All</a>
    <a href="restaurant.php?category=Malay" class="tab <?= (isset($_GET['category']) && $_GET['category'] == 'Malay') ? 'active' : '' ?>">🍚 Malay</a>
    <a href="restaurant.php?category=Thai" class="tab <?= (isset($_GET['category']) && $_GET['category'] == 'Thai') ? 'active' : '' ?>">🌶️ Thai</a>
    <a href="restaurant.php?category=Western" class="tab <?= (isset($_GET['category']) && $_GET['category'] == 'Western') ? 'active' : '' ?>">🍔 Western</a>
</div>

<div class="page-content">

    <?php
    $categories = ['Malay', 'Thai', 'Western'];
    $icons = ['Malay' => '🍚', 'Thai' => '🌶️', 'Western' => '🍔'];

    // Filter by category if set
    $filterCat = isset($_GET['category']) ? $_GET['category'] : null;
    $displayCats = $filterCat ? [$filterCat] : $categories;

    foreach ($displayCats as $cat):
        $stmt = $pdo->prepare("SELECT * FROM restaurants WHERE category = ? LIMIT 2");
        $stmt->execute([$cat]);
        $restaurants = $stmt->fetchAll(PDO::FETCH_ASSOC);
    ?>

    <div class="category-section">
        <div class="category-heading"><?= $icons[$cat] ?> <?= $cat ?> Restaurant</div>
        <div class="restaurant-row">
            <?php foreach ($restaurants as $rest): ?>
            <a href="menu.php?id=<?= $rest['id'] ?>" class="rest-card">
                <img src="<?= htmlspecialchars($rest['image_url']) ?>" alt="<?= htmlspecialchars($rest['name']) ?>">
                <div class="rest-card-body">
                    <div class="rest-card-name"><?= htmlspecialchars($rest['name']) ?></div>
                    <div class="rest-card-desc"><?= htmlspecialchars($rest['description']) ?></div>
                    <div class="rest-card-meta">
                        <span class="rating-badge">⭐ <?= $rest['rating'] ?></span>
                        <span class="cat-badge"><?= $rest['category'] ?></span>
                    </div>
                </div>
            </a>
            <?php endforeach; ?>
        </div>
    </div>

    <?php endforeach; ?>

</div>

</body>
</html>