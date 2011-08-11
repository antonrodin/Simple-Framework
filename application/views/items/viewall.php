<?php
/**
 * Template for View ALL variables
 */

echo "<p>Titulo: $title</p>";
echo "<ul>";
foreach($all_items as $item) {
    echo "<li>" . $item->item_name . " : " . $item->item_desc . "</li>";
}
echo "</ul>";
?>