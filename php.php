<?php
$host = 'MySQL-5.7';
$dbname = 'blog_bd';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=${host};dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if (isset($_GET['query']) && !empty($_GET['query'])) {
        $query = htmlspecialchars($_GET['query']);
        $stmtSearch = $pdo->prepare("SELECT * FROM comments WHERE body LIKE ?");
        $stmtSearch->execute(['%' . $query . '%']);
        $results = $stmtSearch->fetchAll(PDO::FETCH_ASSOC);

        if ($results) {
            echo "<h2>Результаты поиска:</h2><ul>";
            foreach ($results as $comment) {
                
                $highlightedBody = preg_replace(
                    '/' . preg_quote($query, '/') . '/i',
                    '<span class="highlight">$0</span>',
                    htmlspecialchars($comment['body'])
                );

                echo "<li><strong>" . htmlspecialchars($comment['name']) . ":</strong> " . $highlightedBody . "</li>";
            }
            echo "</ul>";
        } else {
            echo "<p>Ничего не найдено.</p>";
        }
    }
} catch (PDOException $e) {
    die("Ошибка подключения или работы с БД: " . $e->getMessage() . "\n");
}
?>