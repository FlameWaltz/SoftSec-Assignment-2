<?php
include 'db.php';

$item_id  = isset($_GET['item_id'])  ? (int)$_GET['item_id']  : 0;
$rest_id  = isset($_GET['rest_id'])  ? (int)$_GET['rest_id']  : 0;

// Fetch item
$stmt = $pdo->prepare("SELECT * FROM menu_items WHERE id = ?");
$stmt->execute([$item_id]);
$item = $stmt->fetch(PDO::FETCH_ASSOC);

// Fetch restaurant
$stmtR = $pdo->prepare("SELECT * FROM restaurants WHERE id = ?");
$stmtR->execute([$rest_id]);
$restaurant = $stmtR->fetch(PDO::FETCH_ASSOC);

if (!$item || !$restaurant) {
    echo "<p style='text-align:center;padding:50px;'>Item not found.</p>";
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add to Cart - <?= htmlspecialchars($item['name']) ?></title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Segoe UI', sans-serif; background: #f7f7f7; color: #333; }

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

        .item-hero img {
            width: 100%;
            max-height: 260px;
            object-fit: cover;
        }

        .item-detail {
            background: white;
            padding: 20px;
            border-bottom: 8px solid #f7f7f7;
        }
        .item-name { font-size: 22px; font-weight: bold; margin-bottom: 6px; }
        .item-rest { font-size: 13px; color: #999; margin-bottom: 10px; }
        .item-desc { font-size: 14px; color: #666; line-height: 1.5; margin-bottom: 14px; }
        .item-price { font-size: 22px; font-weight: bold; color: #00A651; }

        .section {
            background: white;
            margin-top: 10px;
            padding: 20px;
            border-bottom: 8px solid #f7f7f7;
        }
        .section-title { font-size: 16px; font-weight: bold; margin-bottom: 12px; }
        .special-instructions textarea {
            width: 100%;
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 12px;
            font-family: inherit;
            resize: none;
            box-sizing: border-box;
            font-size: 14px;
        }

        /* Bottom Bar */
        .bottom-bar {
            position: fixed;
            bottom: 0; left: 0; right: 0;
            background: white;
            padding: 15px 20px;
            border-top: 1px solid #eee;
            box-shadow: 0 -2px 10px rgba(0,0,0,0.07);
            display: flex;
            align-items: center;
            gap: 15px;
        }
        .qty-selector { display: flex; align-items: center; gap: 12px; }
        .qty-btn {
            width: 36px; height: 36px;
            border: 1.5px solid #ddd;
            background: white;
            border-radius: 6px;
            font-size: 20px;
            cursor: pointer;
            display: flex; align-items: center; justify-content: center;
            font-weight: bold;
            transition: border-color 0.2s;
        }
        .qty-btn:hover { border-color: #00A651; color: #00A651; }
        .qty-num { font-size: 18px; font-weight: bold; min-width: 20px; text-align: center; }

        .add-btn {
            flex: 1;
            background: #00A651;
            color: white;
            border: none;
            padding: 13px;
            border-radius: 10px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            transition: background 0.2s;
        }
        .add-btn:hover { background: #008f45; }

        .content-wrap { padding-bottom: 90px; }
    </style>
</head>
<body>

<div class="header">
    <a href="menu.php?id=<?= $rest_id ?>" class="back-btn">×</a>
    <div class="header-title">Add to Cart</div>
</div>

<div class="content-wrap">

    <div class="item-hero">
        <img src="<?= htmlspecialchars($item['image_url']) ?>" alt="<?= htmlspecialchars($item['name']) ?>">
    </div>

    <div class="item-detail">
        <div class="item-name"><?= htmlspecialchars($item['name']) ?></div>
        <div class="item-rest">from <?= htmlspecialchars($restaurant['name']) ?></div>
        <div class="item-desc"><?= htmlspecialchars($item['description']) ?></div>
        <div class="item-price">RM <span id="displayPrice"><?= number_format($item['price'], 2) ?></span></div>
    </div>

    <div class="section">
        <div class="section-title">Special Instructions</div>
        <div class="special-instructions">
            <textarea rows="3" placeholder="E.g. No onions, extra spicy, less oil..."></textarea>
        </div>
    </div>

</div>

<div class="bottom-bar">
    <div class="qty-selector">
        <button class="qty-btn" onclick="changeQty(-1)">−</button>
        <span class="qty-num" id="qtyDisplay">1</span>
        <button class="qty-btn" onclick="changeQty(1)">+</button>
    </div>
    <button class="add-btn" id="addBtn">
        Add to Cart — RM <span id="totalDisplay"><?= number_format($item['price'], 2) ?></span>
    </button>
</div>

<script>
    let qty = 1;
    const unitPrice = <?= $item['price'] ?>;

    function changeQty(delta) {
        qty = Math.max(1, qty + delta);
        document.getElementById('qtyDisplay').textContent = qty;
        document.getElementById('totalDisplay').textContent = (qty * unitPrice).toFixed(2);
    }
</script>

</body>
</html>