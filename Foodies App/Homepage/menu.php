<?php
include 'db.php';

// Get restaurant ID from URL
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

// Fetch restaurant info
$stmt = $pdo->prepare("SELECT * FROM restaurants WHERE id = ?");
$stmt->execute([$id]);
$restaurant = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$restaurant) {
    echo "<p style='text-align:center;padding:50px;'>Restaurant not found.</p>";
    exit;
}

// Fetch 3 food items for this restaurant
$foodStmt = $pdo->prepare("SELECT * FROM menu_items WHERE restaurant_id = ? AND item_type = 'food' LIMIT 3");
$foodStmt->execute([$id]);
$foodItems = $foodStmt->fetchAll(PDO::FETCH_ASSOC);

// Fetch 2 drink items for this restaurant
$drinkStmt = $pdo->prepare("SELECT * FROM menu_items WHERE restaurant_id = ? AND item_type = 'drink' LIMIT 2");
$drinkStmt->execute([$id]);
$drinkItems = $drinkStmt->fetchAll(PDO::FETCH_ASSOC);

$icons = ['Malay' => '🍚', 'Thai' => '🌶️', 'Western' => '🍔'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($restaurant['name']) ?> - Makan Now</title>
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
        .back-btn { text-decoration: none; font-size: 22px; color: #333; margin-right: 15px; }
        .header-title { flex: 1; text-align: center; font-size: 18px; font-weight: bold; }
        .cat-label {
            background: #FFCC00;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 13px;
            font-weight: bold;
        }

        /* Restaurant Info Block */
        .rest-info-block {
            background: white;
            border-left: 5px solid #FFCC00;
            margin: 20px 20px 0;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(0,0,0,0.07);
        }
        .rest-info-inner { padding: 18px; }
        .rest-name { font-size: 20px; font-weight: bold; margin-bottom: 6px; }
        .rest-desc { font-size: 14px; color: #777; line-height: 1.5; margin-bottom: 12px; }
        .stars { display: flex; align-items: center; gap: 6px; }
        .star-icons { color: #FFCC00; font-size: 18px; letter-spacing: 2px; }
        .star-count { font-size: 14px; color: #555; font-weight: bold; }

        /* Section headers */
        .page-content { max-width: 900px; margin: 0 auto; padding: 20px; }
        .section-title {
            font-size: 17px;
            font-weight: bold;
            margin: 25px 0 14px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        /* Menu Item Cards */
        .items-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 14px;
            margin-bottom: 10px;
        }
        .drinks-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 14px;
        }

        .item-card {
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(0,0,0,0.07);
            text-decoration: none;
            color: inherit;
            transition: transform 0.2s, box-shadow 0.2s;
            display: block;
        }
        .item-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.12);
        }
        .item-card img {
            width: 100%;
            height: 110px;
            object-fit: cover;
        }
        .item-card-body { padding: 10px 12px 12px; }
        .item-name { font-size: 14px; font-weight: bold; margin-bottom: 4px; line-height: 1.3; }
        .item-desc { font-size: 12px; color: #999; margin-bottom: 8px; line-height: 1.3; }
        .item-price { font-size: 14px; font-weight: bold; color: #00A651; }
        .add-tag {
            float: right;
            background: #00A651;
            color: white;
            font-size: 11px;
            font-weight: bold;
            padding: 3px 8px;
            border-radius: 6px;
        }

        @media (max-width: 600px) {
            .items-grid { grid-template-columns: repeat(2, 1fr); }
            .drinks-grid { grid-template-columns: repeat(2, 1fr); }
        }
    </style>
</head>
<body>

<div class="header">
    <a href="restaurant.php?category=<?= urlencode($restaurant['category']) ?>" class="back-btn">←</a>
    <div class="header-title">🍱 Makan Now</div>
    <span class="cat-label"><?= $icons[$restaurant['category']] ?> <?= $restaurant['category'] ?></span>
</div>

<!-- Restaurant Info -->
<div style="max-width:900px; margin:0 auto;">
    <div class="rest-info-block">
        <div class="rest-info-inner">
            <div class="rest-name"><?= htmlspecialchars($restaurant['name']) ?></div>
            <div class="rest-desc"><?= htmlspecialchars($restaurant['description']) ?></div>
            <div class="stars">
                <?php
                $rating = round($restaurant['rating']);
                $stars = str_repeat('★', $rating) . str_repeat('☆', 5 - $rating);
                ?>
                <span class="star-icons"><?= $stars ?></span>
                <span class="star-count"><?= $restaurant['rating'] ?> star</span>
            </div>
        </div>
    </div>
</div>

<div class="page-content">

    <!-- Food Section -->
    <div class="section-title">🍽️ Food</div>
    <div class="items-grid">
        <?php foreach ($foodItems as $item): ?>
        <a href="addtocart.php?item_id=<?= $item['id'] ?>&rest_id=<?= $restaurant['id'] ?>" class="item-card">
            <img src="<?= htmlspecialchars($item['image_url']) ?>" alt="<?= htmlspecialchars($item['name']) ?>">
            <div class="item-card-body">
                <div class="item-name"><?= htmlspecialchars($item['name']) ?></div>
                <div class="item-desc"><?= htmlspecialchars($item['description']) ?></div>
                <div>
                    <span class="item-price">RM <?= number_format($item['price'], 2) ?></span>
                    <span class="add-tag">Add +</span>
                </div>
            </div>
        </a>
        <?php endforeach; ?>
    </div>

    <!-- Drinks Section -->
    <div class="section-title">🥤 Drinks</div>
    <div class="drinks-grid">
        <?php foreach ($drinkItems as $item): ?>
        <a href="addtocart.php?item_id=<?= $item['id'] ?>&rest_id=<?= $restaurant['id'] ?>" class="item-card">
            <img src="<?= htmlspecialchars($item['image_url']) ?>" alt="<?= htmlspecialchars($item['name']) ?>">
            <div class="item-card-body">
                <div class="item-name"><?= htmlspecialchars($item['name']) ?></div>
                <div class="item-desc"><?= htmlspecialchars($item['description']) ?></div>
                <div>
                    <span class="item-price">RM <?= number_format($item['price'], 2) ?></span>
                    <span class="add-tag">Add +</span>
                </div>
            </div>
        </a>
        <?php endforeach; ?>
    </div>

</div>

</body>
</html>