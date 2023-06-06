<?php
    // Verbindung zur Datenbank herstellen und Abfrage ausführen
    $database = DatabaseFactory::getFactory()->getConnection();

    $sql = "SELECT p.id as product_id, p.name as product_name, CAST(sum(op.quantity) AS UNSIGNED) as quantity FROM products p
    left JOIN products_orderd op
    on p.id = op.product_id
    group by p.id
    order by quantity DESC";
    $result = $database->query($sql);

    // SVG-Diagramm erzeugen
    echo '<svg viewBox="0 0 500 200">';
    $barWidth = 40;
    $x = 50;
    $y = 75;
    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        $height = $row['quantity'] * 0.25;
        echo '<text x="' . ($x + $barWidth/2) . '" y="' . ($y - $height - 10) . '" font-size="12" text-anchor="middle">' . $row['quantity'] . '</text>';
        echo '<rect x="' . $x . '" y="' . $y . '" width="' . $barWidth . '" height="' . $height . '" fill="#008080" />';
        echo '<text x="' . ($x + $barWidth/2) . '" y="' . ($y - $height - 30) . '" font-size="14" text-anchor="middle">' . $row['product_name'] . '</text>';
        $x += $barWidth + 20;
    }
    echo '</svg>';
?>