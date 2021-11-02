<?php
    $posterName = html_escape(get_option('poster_page_title'));
    $pageTitle = $posterName . ': &quot;' . html_escape($poster->title) . '&quot;';
    $pageLayout = get_option('poster_show_option');
    $defaultType = get_option('poster_default_file_type');
    echo queue_css_file('jquery.bxslider');
    echo queue_css_file('poster');
    echo queue_js_file('jquery.bxslider');
    echo head(array('title'=>$pageTitle));
    $bibFormat = $_GET['format'];

    function url_get_contents ($url) {
        if (!function_exists('curl_init')){
            die('CURL is not installed!');
        }
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $output = curl_exec($ch);
        curl_close($ch);
        return $output;
    }
?>

<?php if($bibFormat): ?>

    <script>

        jQuery.get("<?php echo WEB_ROOT; ?>/themes/archaeobib/templates/<?php echo $bibFormat; ?>.csl", function(template) {

            var Cite = require('citation-js')
            <?php
                $bibList = array();
                $itemTypeMappings = array(
                    "Artwork" => "graphic",
                    "Audiovisual Material" => "song",
                    "BAR Book" => "book",
                    "BAR Book (Edited)" => "book",
                    "BAR Section" => "chapter",
                    "Book" => "book",
                    "Book (Edited)" => "book",
                    "Book in a Series" => "book",
                    "Book in a Series (Edited)" => "book",
                    "Book in a Series - VN" => "book",
                    "Book in a Series (Edited) - VN" => "book",
                    "Book Section" => "chapter",
                    "Book Section in a Series" => "chapter",
                    "Book Section in a Series - NST" => "chapter",
                    "Conference Paper" => "paper-conference",
                    "Conference Proceeding" => "book",
                    "Document" => "article",
                    "Electronic Source" => "webpage",
                    "Film or Broadcast" => "motion_picture",
                    "Journal Article" => "article-journal",
                    "Magazine Article" => "article-magazine",
                    "Manuscript" => "manuscript",
                    "Map" => "map",
                    "Newspaper Article" => "article-newspaper",
                    "Report" => "report",
                    "Serial" => "book",
                    "Thesis" => "thesis",
                    "Thesis-Bachelor" => "thesis",
                    "Thesis-MA" => "thesis",
                    "Thesis-PhD" => "thesis"
                );
                $elementMappings = array(
                    "Date" => "issued",
                    "Description" => "note",
                    "Title" => "title",
                    "Type" => "genre",
                    "Abstract" => "abstract",
                    "Date Submitted" => "submitted",
                    "Extent" => "dimensions",
                    "Publisher" => "publisher",
                    "Place of Publication" => "publisher-place",
                    "Edition" => "edition",
                    "Series Title" => "collection-title",
                    "Series Editor" => "collection-editor",
                    "External Link" => "URL",
                    "Identifier" => "URL",
                    "Call Number" => "call-number",
                    "Section" => "section",
                    "Scale" => "scale",
                    "Source" => "container-title",
                    "Volume" => "volume"
                );
                $elementArrayMappings = array(
                    "Number" => array(
                        "BAR Section" => "chapter-number",
                        "Book Section" => "chapter-number",
                        "Book Section in a Series" => "chapter-number",
                        "Book Section in a Series - NST" => "chapter-number",
                        "BAR Book" => "collection-number",
                        "BAR Book (Edited)" => "collection-number",
                        "Book" => "collection-number",
                        "Book (Edited)" => "collection-number",
                        "Book in Series" => "collection-number",
                        "Book in a Series (Edited)" => "collection-number",
                        "Book in a Series - VN" => "collection-number",
                        "Book in a Series (Edited) - VN" => "collection-number",
                        "Journal Article" => "issue",
                        "Report" => "number",
                        "Other" => "issue"
                    ),
                    "Editors" => array(
                        "BAR Book" => "editor",
                        "BAR Book (Edited)" => "editor",
                        "BAR Section" => "container-author",
                        "Book" => "editor",
                        "Book (Edited)" => "editor",
                        "Book in Series" => "editor",
                        "Book in a Series (Edited)" => "editor",
                        "Book in a Series - VN" => "editor",
                        "Book in a Series (Edited) - VN" => "editor",
                        "Book Section" => "container-author",
                        "Book Section in a Series" => "container-author",
                        "Book Section in a Series - NST" => "container-author",
                        "Other" => "editor"
                    ),
                    "Creator" => array(
                        "Book (Edited)" => "editor",
                        "Conference Proceeding" => "editor",
                        "Other" => "author"
                    )
                );

                foreach($poster->Items as $posterItem) {
                    $thisCitation = array(
                        "id" => $posterItem->id,
                        "type" => $itemTypeMappings[$posterItem->getItemType()->name]
                    );
                    $theseElementSets = all_element_texts($posterItem, array('return_type' => "array"));
                    $pages = "";
                    $deptFound = "";
                    foreach($theseElementSets as $thisElementSet) {
                        foreach($thisElementSet as $thisElement => $thisElementText) {
                            $cleanedText = "";
                            if ($thisElement == "Creator" || $thisElement == "Series Editor" || $thisElement == "Editors") {
                                $cleanedText = array();
                                foreach($thisElementText as $authorTexts) {
                                    $nameParts = explode(", ", $authorTexts);
                                    if (count($nameParts) > 1) {
                                        $authorJSON = array(
                                            "given" => $nameParts[1],
                                            "family" => $nameParts[0]
                                        );
                                    } else {
                                        $authorJSON = array("family" => $nameParts[0]);
                                    }
                                    array_push($cleanedText, $authorJSON);
                                }
                            } else if ($thisElement == "Date") {
                                $cleanedText = array();
                                foreach($thisElementText as $dateText) {
                                    array_push($cleanedText, array("date-parts" => [$dateText]));
                                }
                            } else if ($thisElement == "Page Start") {
                                if (count($thisElementText) > 0) {
                                    $pages = $thisElementText[0];
                                }
                            } else if ($thisElement == "Page End") {
                                if (count($thisElementText) > 0) {
                                    $pages = $pages . "-" . $thisElementText[0];
                                }
                            } else if ($thisElement == "Department") {
                                if (count($thisElementText) > 0) {
                                    $deptFound = $thisElementText[0];
                                }
                            } else {
                                foreach($thisElementText as $eachText) {
                                    if ($thisElement == "External Link") {
                                        if(stripos($eachText,"pdf_articles") > 0) {
                                            // I'm omitting links to their private PDF storage
                                            continue;
                                        }
                                    }
                                    $encodingCleanedText = str_replace("&quot;", '"', str_replace("&#039;", "'", $eachText));
                                    if ($cleanedText == "") {
                                        $cleanedText = $encodingCleanedText;
                                    } else {
                                        $cleanedText = $cleanedText . "; " . $encodingCleanedText;
                                    }
                                }
                            }
                            if(array_key_exists($thisElement, $elementMappings)) {
                                $cslKey = $elementMappings[$thisElement];
                                $thisCitation[$cslKey] = $cleanedText;
                            } else if (array_key_exists($thisElement, $elementArrayMappings)) {
                                if (array_key_exists($posterItem->getItemType()->name, $elementArrayMappings[$thisElement])) {
                                    $cslKey = $elementArrayMappings[$thisElement][$posterItem->getItemType()->name];
                                } else {
                                    $cslKey = $elementArrayMappings[$thisElement]["Other"];
                                }
                                $thisCitation[$cslKey] = $cleanedText;
                            }
                        }
                    }
                    if ($pages != "") {
                        $thisCitation["page"] = $pages;
                    }
                    if ($posterItem->getItemType()->name == "Thesis-PhD") {
                        $thisCitation["genre"] = "PhD Thesis";
                    } else if ($posterItem->getItemType()->name == "Thesis-Bachelor") {
                        $thisCitation["genre"] = "Bachelor Thesis";
                    } else if ($posterItem->getItemType()->name == "Thesis-MA") {
                        $thisCitation["genre"] = "Masters Thesis";
                    }
                    if ($deptFound != "") {
                        $thisCitation["publisher"] = $deptFound . ", " . $thisCitation["publisher"];
                    }
                    array_push($bibList, $thisCitation);
                }
            ?>
            var bibList = <?php echo json_encode($bibList) ?>;
            let cite = new Cite(bibList)
            let templateName = '<?php echo $bibFormat; ?>';
            Cite.plugins.config.get('@csl').templates.add(templateName, template)
            var parseAsync = Cite.parse.input.async.chain

            function decodeHtml(html) {
                var txt = document.createElement("textarea");
                txt.innerHTML = html;
                return txt.value;
            }

            // Make a factory for callback
            var callbackFactory = function (out) {
              return function (data) {
                out.html(decodeHtml(cite.format('bibliography', {
                    format: 'html',
                    template: '<?php echo $bibFormat; ?>',
                    lang:'en-US'
                })))
              }
            }

            $(function(){

              // Callbacks
              var jsonCb = callbackFactory($('#json-out'))

              // Declare function to update the output
              function update() {
                // Set data (explicit parsing only recommended for async) and set html element to get output
                parseAsync(bibList).then(jsonCb)
              }

              // Trigger update
              update()
            })
        })

        <?php
            $xmlTemplate = url_get_contents(WEB_ROOT . "/themes/archaeobib/templates/" . $bibFormat . ".csl"); ?>
        <?php
            $xml = new SimpleXMLElement($xmlTemplate);
            $linespacing = "normal";
            $marginBottom = "0";
            $hangingindent = "0";
            $formatTitle = "";

            foreach ($xml->children() as $child) {
                if ($child->getName() == 'bibliography') {
                    $attrs = $child->attributes();
                    if($attrs["line-spacing"]) {
                        $linespacing = $attrs["line-spacing"];
                    }
                    if($attrs["entry-spacing"]) {
                        $marginBottom = $attrs["entry-spacing"];
                    }
                    if ($attrs["hanging-indent"] && $attrs["hanging-indent"] == "true") {
                        $hangingindent = "2";
                    }
                }
                if ($child->getName() == 'info') {
                    foreach ($child->children() as $infoChild) {
                        if ($infoChild->getName() == 'title') {
                            $formatTitle = $infoChild;
                        }
                    }
                }
            }
        ?>
    </script>

    <style>
        .csl-bib-body {
            line-height: <?php echo $linespacing; ?>;
        }
        .csl-entry {
            clear: left;
            margin-bottom: <?php echo $marginBottom; ?>em;
        }
        .csl-indent {
            margin: .5em 0 0 2em;
            padding: 0 0 .2em .5em;
            border-left: 5px solid #ccc;
        }
        .csl-right-inline {
            margin: 0 .4em 0 0;
            <?php if ($hangingindent != "0"): ?>
                padding-left: <?php echo $hangingindent; ?>em;
            <?php endif; ?>
        }
        .csl-left-margin {
            float: left;
            text-align: right;
            padding-right: 1em;
            <?php if ($hangingindent != "0"): ?>
                padding-left: <?php echo $hangingindent; ?>em;
            <?php endif; ?>
        }
    </style>

<?php endif; ?>


<div class="container-fluid">

    <div class="row">
        <div class="col-sm-12">
            <p class="ab-index-title">
                <strong><?php echo $pageTitle; ?><?php if ($bibFormat){ echo " | Format: " . $formatTitle; }?></strong>
            </p>
            <div class="ab-header-text">
                <?php echo $poster->description; ?>
                <div class="row justify-content-between">
                    <div class="col-md-3">
                        <?php if ($this->currentUser): ?>
                            <div class="edit-link">
                                <a href="<?php echo html_escape(url(array('action' => 'edit','id' => $poster->id), get_option('poster_page_path'))); ?>" class="edit-poster-link">Edit</a> |
                                <a href="<?php echo html_escape(url(array('action'=>'print','id' => $poster->id), get_option('poster_page_path'))); ?>" class="print" media="print" >Download</a>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="col-md-9">
                        <div class="row justify-content-end no-gutters">
                            <div class="col-md-auto">
                                <div class="dropdown">
                                    <button type="button" class="btn btn-default dropdown-toggle ab-dropdown-button" id="format-select" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <span>Bibliographic Format</span>
                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="format-select">
                                        <a class="dropdown-item" href="<?php echo $this->url(); ?>?format=american-anthropological-association">Amer. Anth. Assoc.</a>
                                        <a class="dropdown-item" href="<?php echo $this->url(); ?>?format=american-antiquity">American Antiquity</a>
                                        <a class="dropdown-item" href="<?php echo $this->url(); ?>?format=american-journal-of-physical-anthropology">Amer. J. of Physical Anth.</a>
                                      <!--  <a class="dropdown-item" href="<?php echo $this->url(); ?>?format=anthropological-science">Anthropological Science</a> -->
                                        <a class="dropdown-item" href="<?php echo $this->url(); ?>?format=antiquity">Antiquity</a>
                                        <a class="dropdown-item" href="<?php echo $this->url(); ?>?format=asian-perspectives">Asian Perspectives</a>
                                        <a class="dropdown-item" href="<?php echo $this->url(); ?>?format=world-archaeology">World Archaeology</a>
                                        <a class="dropdown-item" href="<?php echo $this->url(); ?>">Clear Format</a>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <hr />
        </div>
    </div>

    <?php if($bibFormat): ?>
        <div id="json-out"></div>
    <?php else: ?>
        <div class="row" id="poster">
            <table class="table table-striped-ab">
                <thead class="thead-ab">
                    <tr>
                        <th scope="col">Type</th>
                        <th scope="col">Year</th>
                        <th scope="col">Authors</th>
                        <th scope="col">Title</th>
                        <th scope="col">Source</th>
                        <th scope="col">Notes</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($poster->Items as $posterItem): ?>
                        <tr>
                            <td><?php echo $posterItem->getItemType()->name; ?></td>
                            <td><?php echo metadata($posterItem, array('Dublin Core', 'Date')); ?></td>
                            <td><?php echo metadata($posterItem, array('Dublin Core', 'Creator')); ?></td>
                            <td><?php echo link_to_item(metadata($posterItem, array('Dublin Core', 'Title')), null, 'show', $posterItem); ?></td>
                            <td>
                                <?php echo metadata($posterItem, array('Dublin Core', 'Source')); ?>
                                <?php if (element_exists('Item Type Metadata', 'Book Title')): ?>
                                    <p><?php echo metadata($posterItem, array('Item Type Metadata', 'Book Title')); ?></p>
                                <?php endif; ?>
                                <?php if (element_exists('Item Type Metadata', 'Journal Title')): ?>
                                    <p><?php echo metadata($posterItem, array('Item Type Metadata', 'Journal Title')); ?></p>
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php echo $posterItem->caption; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <?php
                 $disclaimer = get_option('poster_disclaimer');
                 if (!empty($disclaimer)):
            ?>
            <div id="poster-disclaimer">
                <h2 id="poster-disclaimer-title">Disclaimer</h2>
                <?php echo html_escape($disclaimer); ?>
            </div>
            <?php endif; ?>
        </div> <!-- end poster div -->
    <?php endif; ?>
</div>
<script type="text/javascript">
    var n = jQuery('.poster-items li').length;
    var showOption = '<?php echo ($showOption = get_option('poster_show_option')) ? $showOption : 'carousel'; ?>';
    var fileSize = '<?php echo ($fileSize = get_option('poster_default_file_type')) ? $fileSize : 'fullsize'; ?>';
    if (n > 0 && showOption == 'carousel') {
       jQuery('.poster-items').bxSlider({
          auto: false,
          adaptiveHeight: true,
          mode: 'fade',
          captions: true,
          pager: n > 1,
       });
       <?php if ($defaultType == 'thumbnail'): ?>
       jQuery(window).load(function() {
           jQuery('.thumbnail .bx-caption').each(function() {
              var imageWidth = jQuery(this).prev().find('img').prop('width');
              var caption = jQuery(this);
              caption.css('left', imageWidth);
           });
        });
       <?php endif; ?>
    } else {
        jQuery('.poster-items').addClass('poster-items-grid');
        jQuery('.bx-caption').addClass('bx-caption-grid');
    }
</script>
<?php echo foot(); ?>
