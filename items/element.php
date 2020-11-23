<?php

    $filter = $_GET['element_filter'];
    $letter = $_GET['letter'];
    if ($letter != "") {
        $letterurl = "&letter=$letter";
    } else {
        $letterurl = "";
    }

    $textSortUrl = url("items/search?element_filter=" . $filter . $letterurl . "&sort_field=name");
    $countSortUrl = url("items/search?element_filter=" . $filter . $letterurl . "&sort_field=count");

    $sort = $_GET['sort_field'];
    $sort_dir = $_GET['sort_dir'];

    if ($sort_dir == 'a') {
        $textSortUrl = $textSortUrl . "&sort_dir=d";
        $countSortUrl = $countSortUrl . "&sort_dir=d";
    } else if ($sort_dir == 'd') {
        $textSortUrl = $textSortUrl . "&sort_dir=a";
        $countSortUrl = $countSortUrl . "&sort_dir=a";
    } else {
        $textSortUrl = $textSortUrl . "&sort_dir=a";
        $countSortUrl = $countSortUrl . "&sort_dir=d";
    }

    if ($_GET['element_filter'] == 'type') {
        echo '<div class="card bg-light">';
        echo '<div class="card-body">';

        $types = get_records('ItemType', array('sort_field' => 'name','sort_dir' => 'a'), 500);
        echo "<ul>";
    	  foreach ($types as $type) {
        	  echo '<li><a href="browse?type=' . $type->id . '">' . $type->name . '</a></li>';
        }
        echo "</ul></div></div>";
    } else {

        echo '      <div class="row justify-content-end no-gutters">';
        echo '          <div class="col-md-auto">';
        echo '              <span class="sort-label">' . __('Sort by: ') . '</span>';
        echo '          </div>';
        echo '          <div class="col-md-auto">';
        echo '              <ul id="sort-links-list">';
        echo '                  <li';
        if ($sort === 'name') {
            echo ' class="sorting';
            if ($sort_dir === 'a') {
                echo ' asc';
            } elseif ($sort_dir === 'd') {
                echo ' desc';
            }
            echo '"';
        }
        echo '>';
        echo '                      <a href="'. $textSortUrl . '">Text</a>';
        echo '                  </li>';
        echo '                  <li';
        if ($sort === 'count') {
            echo ' class="sorting';
            if ($sort_dir === 'a') {
                echo ' asc';
            } elseif ($sort_dir === 'd') {
                echo ' desc';
            }
            echo '"';
        }
        echo '>';
        echo '                      <a href="'. $countSortUrl . '">Count</a>';
        echo '                  </li>';
        echo '              </ul>';
        echo '          </div>';
        echo '        </div>';

        echo '<div class="card bg-light">';
        echo '<div class="card-body ab-tags">';

        $elementFilter = get_record('Element', array('name'=> $_GET['element_filter']));
        $db = get_db();
        $queryString = "SELECT text AS TEXT, count(*) as COUNT FROM om_element_texts et WHERE et.element_id = " . $elementFilter->id;
        if ($letter != "") {
            $queryString = $queryString . " AND et.text LIKE '" . $letter . "%'";
        }
        $queryString = $queryString . " GROUP BY TEXT ORDER BY";
        if ($sort === 'count') {
            $queryString = $queryString . " COUNT";
        } else {
            $queryString = $queryString . " TEXT";
        }
        if ($sort_dir === 'd') {
            $queryString = $queryString . " DESC";
        }
        $elementValues = $db->getTable('ElementText')->fetchObjects($queryString);
  	    echo "<ul>";
  	    foreach ($elementValues as $elementVal) {
            if ( $elementVal["TEXT"] == '') {
                echo '<li><a href="' . url('items/browse?search=&advanced%5B0%5D%5Bjoiner%5D=and&advanced%5B0%5D%5Belement_id%5D='. $elementFilter->id . '&advanced%5B0%5D%5Btype%5D=is+exactly&advanced%5B0%5D%5Bterms%5D=' . $elementVal["TEXT"]) . '"><span class="count">' . $elementVal["COUNT"] . '</span>' . '[none]</a></li>';
            } else {
                echo '<li><a href="' . url('items/browse?search=&advanced%5B0%5D%5Bjoiner%5D=and&advanced%5B0%5D%5Belement_id%5D='. $elementFilter->id . '&advanced%5B0%5D%5Btype%5D=is+exactly&advanced%5B0%5D%5Bterms%5D=' . $elementVal["TEXT"]) . '"><span class="count">' . $elementVal["COUNT"] . '</span>' . $elementVal["TEXT"] . '</a></li>';
            }
        }
        echo "</ul></div></div>";
    }
?>
