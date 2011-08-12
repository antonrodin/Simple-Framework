<?php
/**
 * Template for View ALL variables
 */

echo "<p>Titulo: $title</p>";
echo "<ul>";
foreach($all_items as $item) {
    $item_name_url = strtolower(str_replace(" ", "-", $item->item_name));
    echo "<li>";
        echo "<a href=\"../../items/view/" . $item->id . "/" . $item_name_url . "/\">";
            echo $item->item_name;
        echo "</a>";
    echo "</li>";
}
echo "</ul>";
?>