<?php

    if ($_GET['element_filter'] == 'type') {
        $types = get_records('ItemType', array(), 500);
        echo "<ul>";
    	  foreach ($types as $type) {
        	  echo '<li><a href="browse?type=' . $type->id . '">' . $type->name . '</a></li>';
        }
        echo "</ul>";
    } else {

      $elementFilter = get_record('Element', array('name'=> $_GET['element_filter']));
      $db = get_db();
      $letter = $_GET['letter'];
      if ($letter != "") {
          $elementValues = $db->getTable('ElementText')->fetchObjects("SELECT DISTINCT(text) AS TEXT FROM {$db->prefix}element_texts et WHERE et.element_id = $elementFilter->id AND et.text LIKE '$letter%' ORDER BY TEXT");
      } else {
          $elementValues = $db->getTable('ElementText')->fetchObjects("SELECT DISTINCT(text) AS TEXT FROM {$db->prefix}element_texts et WHERE et.element_id = $elementFilter->id ORDER BY TEXT");
      }
  	  echo "<ul>";
  	  foreach ($elementValues as $elementVal) {
      	  echo '<li><a href="' . url('items/browse?search=&advanced%5B0%5D%5Bjoiner%5D=and&advanced%5B0%5D%5Belement_id%5D='. $elementFilter->id . '&advanced%5B0%5D%5Btype%5D=is+exactly&advanced%5B0%5D%5Bterms%5D=' . $elementVal["TEXT"]) . '">' . $elementVal["TEXT"] . '</a></li>';
      }
      echo "</ul>";
    }
?>
