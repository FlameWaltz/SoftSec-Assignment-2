<?php include 'db.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Foodies - Home</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Segoe UI', sans-serif; background: #f7f7f7; color: #333; }

        .header {
            background: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5)),
                        url('https://images.unsplash.com/photo-1550547660-d9450f859349?w=1200');
            background-size: cover;
            background-position: center;
            padding: 30px 20px 40px;
            text-align: center;
        }
        .logo { color: white; font-size: 32px; font-weight: bold; margin-bottom: 20px; }
        .logo span { font-size: 36px; }

        .search-wrapper { position: relative; max-width: 500px; margin: 0 auto; }
        .search-wrapper input {
            width: 100%;
            padding: 14px 20px 14px 45px;
            border: none;
            border-radius: 30px;
            font-size: 16px;
            outline: none;
        }
        .search-icon { position: absolute; left: 15px; top: 50%; transform: translateY(-50%); }

        .suggestions-box {
            display: none;
            position: absolute;
            top: 105%;
            left: 0; right: 0;
            background: white;
            border-radius: 12px;
            box-shadow: 0 8px 20px rgba(0,0,0,0.15);
            overflow: hidden;
            z-index: 999;
        }
        .suggestion-item {
            padding: 14px 20px;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 12px;
            font-size: 15px;
        }
        .suggestion-item:hover { background: #fff9e0; }

        .section { max-width: 1100px; margin: 40px auto; padding: 0 20px; }
        .section h2 { font-size: 22px; margin-bottom: 20px; }

        .category-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 20px; }
        .cat-card {
            border-radius: 14px;
            overflow: hidden;
            position: relative;
            height: 180px;
            text-decoration: none;
        }
        .cat-card img { width: 100%; height: 100%; object-fit: cover; }
        .cat-label {
            position: absolute;
            bottom: 0; left: 0; right: 0;
            background: linear-gradient(transparent, rgba(0,0,0,0.7));
            color: white;
            padding: 20px 15px 12px;
            font-size: 18px;
            font-weight: bold;
        }

        .restaurant-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 20px; }
        .rest-card {
            background: white;
            border-radius: 12px;
            overflow: hidden;
            text-decoration: none;
            color: inherit;
        }
        .rest-card img { width: 100%; height: 160px; object-fit: cover; }
        .rest-info { padding: 15px; }
        .rest-name { font-weight: bold; font-size: 17px; }
        .rest-meta { font-size: 13px; color: #777; }
        .rest-badge {
            display: inline-block;
            background: #fff3cc;
            color: #b8860b;
            font-size: 11px;
            padding: 2px 8px;
            border-radius: 20px;
            margin-bottom: 6px;
        }
    </style>
</head>
<body>

<div class="header">
    <div class="logo"><span>🍔</span> Foodies</div>
    <div class="search-wrapper">
        <span class="search-icon">🔍</span>
        <input 
            type="text" 
            id="searchInput"
            placeholder="Search Malay, Thai or Western food..."
            autocomplete="off"
            onkeyup="filterSuggestions(this.value)"
            onfocus="showSuggestions()"
            onblur="hideSuggestions()"
        >
        <div class="suggestions-box" id="suggestionsBox">
            <div class="suggestion-item" onmousedown="goToMenu('Malay')">🍚 Malay Food</div>
            <div class="suggestion-item" onmousedown="goToMenu('Thai')">🌶️ Thai Food</div>
            <div class="suggestion-item" onmousedown="goToMenu('Western')">🍔 Western Food</div>
        </div>
    </div>
</div>

<!-- Category Cards -->
<div class="section">
    <h2>Browse by Category</h2>
    <div class="category-grid">
        <a href="restaurant.php?category=Malay" class="cat-card">
            <img src="https://images.unsplash.com/photo-1512058564366-18510be2db19?w=600">
            <div class="cat-label">🍚 Malay</div>
        </a>
        <a href="restaurant.php?category=Thai" class="cat-card">
            <img src="https://images.unsplash.com/photo-1559314809-0d155014e29e?w=600">
            <div class="cat-label">🌶️ Thai</div>
        </a>
        <a href="restaurant.php?category=Western" class="cat-card">
            <img src="https://images.unsplash.com/photo-1550547660-d9450f859349?w=600">
            <div class="cat-label">🍔 Western</div>
        </a>
    </div>
</div>

<!-- Featured Restaurants -->
<div class="section">
    <h2>Featured Restaurants</h2>
    <div class="restaurant-grid">
        <?php
        $stmt = $pdo->query("SELECT * FROM restaurants ORDER BY rating DESC LIMIT 6");
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)):
        ?>
        <a href="restaurant.php?id=<?= $row['id'] ?>" class="rest-card">
            <img src="<?= htmlspecialchars($row['image_url']) ?>">
            <div class="rest-info">
                <span class="rest-badge"><?= $row['category'] ?></span>
                <div class="rest-name"><?= htmlspecialchars($row['name']) ?></div>
                <div class="rest-meta">⭐ <?= $row['rating'] ?> • <?= htmlspecialchars($row['description']) ?></div>
            </div>
        </a>
        <?php endwhile; ?>
    </div>
</div>

<script>
    const categories = ['Malay', 'Thai', 'Western'];

    function showSuggestions() {
        filterSuggestions(document.getElementById('searchInput').value);
    }

    function hideSuggestions() {
        setTimeout(() => {
            document.getElementById('suggestionsBox').style.display = 'none';
        }, 150);
    }

    function filterSuggestions(val) {
        const box = document.getElementById('suggestionsBox');
        const items = box.querySelectorAll('.suggestion-item');
        let anyVisible = false;

        items.forEach(item => {
            const label = item.textContent.toLowerCase();
            if (val === '' || label.includes(val.toLowerCase())) {
                item.style.display = 'flex';
                anyVisible = true;
            } else {
                item.style.display = 'none';
            }
        });

        box.style.display = anyVisible ? 'block' : 'none';
    }

    function goToMenu(category) {
        window.location.href = 'restaurant.php?category=' + category;
    }

    document.getElementById('searchInput').addEventListener('keydown', function(e) {
        if (e.key === 'Enter') {
            const val = this.value.trim();
            const match = categories.find(c => c.toLowerCase() === val.toLowerCase());
            if (match) {
                goToMenu(match);
            }
        }
    });
</script>

</body>
</html>