<?php
/**
 * Items Controller Class
 *
 * @author Anton Zekeriev Rodin
 */
class ItemsController extends Controller {

    function viewall() {

        $db_result = $this->_model->get_results("SELECT * FROM `items`");
        $this->set("title", "View All Items");
        $this->set("all_items", $db_result);
    }

}
?>
