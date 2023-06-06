<?php
    // Verbindung zur Datenbank herstellen und Abfrage ausführen
    $database = DatabaseFactory::getFactory()->getConnection();

    $sql = "SELECT p.id as product_id, p.name as product_name, CAST(IFNULL(sum(op.quantity),0) AS UNSIGNED) as quantity FROM products p
    left JOIN products_ordered op
    on p.id = op.product_id
    group by p.id
    order by quantity DESC
    LIMIT 5";
    $result = $database->query($sql);

    // SVG-Diagramm erzeugen
    echo "Five most sold Products:";
    echo '<svg viewBox="0 0 500 200">';
    $barWidth = 40;
    $x = 50;
    $y = 75;
    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        $height = $row['quantity'] * 0.25;
        echo '<text x="' . ($x + $barWidth/2) . '" y="' . ($y - $height - 10) . '" font-size="12" text-anchor="middle">' . $row['quantity'] . '</text>';
        echo '<rect x="' . $x . '" y="' . $y . '" width="' . $barWidth . '" height="' . $height . '" fill="#da1738" />';
        echo '<a href="' . Config::get('URL') . 'product/showProduct/' . $row['product_id'] . '"><text x="' . ($x + $barWidth/2) . '" y="' . ($y - $height - 30) . '" font-size="14" text-anchor="middle">' . $row['product_name'] . '</text></a>';
        $x += $barWidth + 20;
    }
    echo '</svg>';
?>