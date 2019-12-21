<?php

  header("Content-type: text/csv");
  header("Content-Disposition: attachment; filename=marked.csv");
  printCsvExport($poster->Items);

?>
