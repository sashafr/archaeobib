<?php echo head(); ?>

<div class="container-fluid">
    
    <div class="row">
        <div class="col-sm-12">
            <p class="ab-index-title"><strong>Search</strong></p>
        </div>
    </div>
    
    <div class="row justify-content-between">
        <div class="col-sm-3">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <p class="ab-index-subtitle"><strong>Basic Search</strong></p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <?php echo search_form(); ?>
                    </div>
                </div>
            </div>
        </div>
        <?php if (get_theme_option('Bsearch Text')): ?>
            <div class="col-sm-6 ab-mobile-hide">
                <?php echo get_theme_option('Bsearch Text'); ?>
            </div>
        <?php endif; ?>
    </div>
    
    <div class="row">
        <div class="col-sm-12">
            <p class="ab-index-title">&nbsp;</p>
        </div>
    </div>
    
    <div class="row justify-content-between">
        <div class="col-sm-3">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <p class="ab-index-subtitle"><strong>Advanced Search</strong></p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <?php echo $this->partial('items/search-form.php', array('formAttributes' => array('id' => 'advanced-search-form'))); ?>
                    </div>
                </div>
            </div>
        </div>
        <?php if (get_theme_option('Asearch Text')): ?>
            <div class="col-sm-6 ab-mobile-hide">
                <?php echo get_theme_option('Asearch Text'); ?>
            </div>
        <?php endif; ?>
    </div>    
    
</div>


        
      <TABLE border=0 cellPadding=0 cellSpacing=0>
        <TR align=middle>
          <TD valign="top" width="2%">
          </TD>
          
    <TD width="96%" align="left" valign="top"> 
      <hr size="1">
      <br>
      <table border="0" cellspacing="0" cellpadding="0" width="100%" height="671">
        <tr> 
          <td valign="top" colspan="6" height="23"> <hr size="1"> </td>
        </tr>
        <tr> 
          <td valign="top" colspan="6" height="23"> <hr size="1"> </td>
        </tr>
        <tr> 
          <td width="32" rowspan="2" valign="top"><br> <img border="0" src="bwg_search_glance.gif" width="32" height="32"></td>
          <td rowspan="2" valign="top"><b><font color="#000080">Lookup</font></b> 
            <p><a href="/bw_search_adv?sql=select+bib.*+from+bib+where+CURRENT_DATE-Date_created<7&hiwords="><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><strong>Within 
              the Past Week</strong></font></a><strong><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><br>
              <a href="bw_search_adv?sql=select+bib.*+from+bib+where+CURRENT_DATE-Date_created<30&hiwords=">Within 
              the Past Month</a><br>
              <a href="bw_search_adv?sql=select+bib.*+from+bib+where+CURRENT_DATE-Date_created<365&hiwords=">Within 
              the Past Year</a></font></strong></p>
            <p><font face="Verdana, Arial, Helvetica" size="2"> <a href="/bw_lookup_list?sql=select+distinct+year_pub,+count(*)+from+bib+group+by+year_pub&nextsql=year_pub"><b>Years 
              (All)<br>
              </b></a></font><b><font face="Verdana, Arial, Helvetica" size="2">
			  <a href="/bw_lookup_list?sql=select+distinct+publisher,+count(*)+from+bib+group+by+publisher&nextsql=publisher">Publishers (All)<br>
              </a></font></b><font face="Verdana, Arial, Helvetica" size="2"><b> 
              <a href="/bw_lookup_list?sql=select+distinct+ref_type,+count(*)+from+bib+group+by+ref_type&nextsql=ref_type">Reference Types (All)</a></b></font><b><font face="Verdana, Arial, Helvetica" size="2">
			  <a href="/bw_lookup_list?sql=select+distinct+publisher,+count(*)+from+bib+group+by+publisher&nextsql=publisher"><br></a>
			  <a href="bw_search_adv?sql=select+bib.*+from+bib&movebynum=1">All Records</a></font></b></p>
            <p><a href="/bw_search_adv?sql=select+ref_ID,+ref_type,+authors,+title,+year_pub,+sec_title,+publisher+from+bib+where+ref_type='Thesis-PhD'+AND+URL+is+not+null&hiwords=Thesis-PhD"> 
              <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><strong>Dissertations with Full Text (PDF Format)</strong></font></a></p></td>
          <td width="20" valign="top" height="83"></td>
          <td valign="top" height="83" colspan="3"> <p><font face="Verdana, Arial, Helvetica, sans-serif" size="2" color="#808080">To 
              aid reference retrieval by author, journal, keyword, year, publisher, 
              or reference type (e.g., Journal article, Book). Lookup results 
              are initially sorted in ascending order (A-Z, 1-3).</font></p>
            </td>
        </tr>
        <tr> 
          <td width="20" height="29" valign="top"></td>
          <td width="218" height="29" align="center" valign="top"> <font face="Verdana, Arial, Helvetica" size="2"><a href="/bw_lookup_list?sql=select+distinct+author%2C+count(*)+from+au_x+group+by+author&nextsql=author"><b>Authors 
            (including Editors)</b></a> <br>
            <a href="/bw_lookup_list?sql=select+distinct+author%2C+count(*)+from+au_x+where+upper(author)+like+%27A%25%27+group+by+author&amp;nextsql=author">A</a>&nbsp; 
            <a href="/bw_lookup_list?sql=select+distinct+author%2C+count(*)+from+au_x+where+upper(author)+like+%27B%25%27+group+by+author&nextsql=author">B</a>&nbsp; 
            <a href="/bw_lookup_list?sql=select+distinct+author%2C+count(*)+from+au_x+where+upper(author)+like+%27C%25%27+group+by+author&nextsql=author">C</a>&nbsp; 
            <a href="/bw_lookup_list?sql=select+distinct+author%2C+count(*)+from+au_x+where+upper(author)+like+%27D%25%27+group+by+author&nextsql=author">D</a>&nbsp; 
            <a href="/bw_lookup_list?sql=select+distinct+author%2C+count(*)+from+au_x+where+upper(author)+like+%27E%25%27+group+by+author&nextsql=author">E</a>&nbsp; 
            <a href="/bw_lookup_list?sql=select+distinct+author%2C+count(*)+from+au_x+where+upper(author)+like+%27F%25%27+group+by+author&nextsql=author">F</a>&nbsp; 
            <a href="/bw_lookup_list?sql=select+distinct+author%2C+count(*)+from+au_x+where+upper(author)+like+%27G%25%27+group+by+author&nextsql=author">G</a>&nbsp; 
            <a href="/bw_lookup_list?sql=select+distinct+author%2C+count(*)+from+au_x+where+upper(author)+like+%27H%25%27+group+by+author&amp;nextsql=author">H</a> 
            <br>
            &nbsp; <a href="/bw_lookup_list?sql=select+distinct+author%2C+count(*)+from+au_x+where+upper(author)+like+%27I%25%27+group+by+author&nextsql=author">I</a>&nbsp; 
            <a href="/bw_lookup_list?sql=select+distinct+author%2C+count(*)+from+au_x+where+upper(author)+like+%27J%25%27+group+by+author&nextsql=author">J</a>&nbsp; 
            <a href="/bw_lookup_list?sql=select+distinct+author%2C+count(*)+from+au_x+where+upper(author)+like+%27K%25%27+group+by+author&nextsql=author">K</a>&nbsp; 
            <a href="/bw_lookup_list?sql=select+distinct+author%2C+count(*)+from+au_x+where+upper(author)+like+%27L%25%27+group+by+author&nextsql=author">L</a>&nbsp; 
            <a href="/bw_lookup_list?sql=select+distinct+author%2C+count(*)+from+au_x+where+upper(author)+like+%27M%25%27+group+by+author&nextsql=author">M</a>&nbsp; 
            <br>
            <a href="/bw_lookup_list?sql=select+distinct+author%2C+count(*)+from+au_x+where+upper(author)+like+%27N%25%27+group+by+author&nextsql=author"> 
            N</a>&nbsp; <a href="/bw_lookup_list?sql=select+distinct+author%2C+count(*)+from+au_x+where+upper(author)+like+%27O%25%27+group+by+author&nextsql=author">O</a>&nbsp; 
            <a href="/bw_lookup_list?sql=select+distinct+author%2C+count(*)+from+au_x+where+upper(author)+like+%27P%25%27+group+by+author&nextsql=author">P</a>&nbsp; 
            <a href="/bw_lookup_list?sql=select+distinct+author%2C+count(*)+from+au_x+where+upper(author)+like+%27Q%25%27+group+by+author&nextsql=author">Q</a>&nbsp; 
            <a href="/bw_lookup_list?sql=select+distinct+author%2C+count(*)+from+au_x+where+upper(author)+like+%27R%25%27+group+by+author&nextsql=author">R</a>&nbsp; 
            <a href="/bw_lookup_list?sql=select+distinct+author%2C+count(*)+from+au_x+where+upper(author)+like+%27S%25%27+group+by+author&nextsql=author">S</a>&nbsp; 
            <a href="/bw_lookup_list?sql=select+distinct+author%2C+count(*)+from+au_x+where+upper(author)+like+%27T%25%27+group+by+author&nextsql=author">T</a>&nbsp; 
            <a href="/bw_lookup_list?sql=select+distinct+author%2C+count(*)+from+au_x+where+upper(author)+like+%27U%25%27+group+by+author&nextsql=author">U<br>
            </a><a href="/bw_lookup_list?sql=select+distinct+author%2C+count(*)+from+au_x+where+upper(author)+like+%27V%25%27+group+by+author&nextsql=author">V</a>&nbsp; 
            <a href="/bw_lookup_list?sql=select+distinct+author%2C+count(*)+from+au_x+where+upper(author)+like+%27W%25%27+group+by+author&nextsql=author">W</a>&nbsp; 
            <a href="/bw_lookup_list?sql=select+distinct+author%2C+count(*)+from+au_x+where+upper(author)+like+%27X%25%27+group+by+author&nextsql=author">X</a>&nbsp; 
            <a href="/bw_lookup_list?sql=select+distinct+author%2C+count(*)+from+au_x+where+upper(author)+like+%27Y%25%27+group+by+author&nextsql=author">Y</a>&nbsp; 
            <a href="/bw_lookup_list?sql=select+distinct+author%2C+count(*)+from+au_x+where+upper(author)+like+%27Z%25%27+group+by+author&nextsql=author">Z</a></font> 
            <p>&nbsp;</p></td>
          <td width="190" height="29" align="center" valign="top"> <p><a href="/bw_lookup_list?sql=select+distinct+keyword%2C+count(*)+from+kw_x+group+by+keyword+order+by+keyword+NOCASE&nextsql=keyword"><font face="Verdana, Arial, Helvetica, sans-serif" size="2"><b>Keywords 
              (All)</b></font></a><font face="Verdana, Arial, Helvetica, sans-serif" size="2"><br>
              <a href="/bw_lookup_list?sql=select+distinct+keyword%2C+count(*)+from+kw_x+where+upper(keyword)+like+%27A%25%27+group+by+keyword+order+by+keyword+NOCASE&nextsql=keyword"> 
              A</a>&nbsp; <a href="/bw_lookup_list?sql=select+distinct+keyword%2C+count(*)+from+kw_x+where+upper(keyword)+like+%27B%25%27+group+by+keyword+order+by+keyword+NOCASE&nextsql=keyword">B</a>&nbsp; 
              <a href="/bw_lookup_list?sql=select+distinct+keyword%2C+count(*)+from+kw_x+where+upper(keyword)+like+%27C%25%27+group+by+keyword+order+by+keyword+NOCASE&nextsql=keyword">C</a>&nbsp; 
              <a href="/bw_lookup_list?sql=select+distinct+keyword%2C+count(*)+from+kw_x+where+upper(keyword)+like+%27D%25%27+group+by+keyword+order+by+keyword+NOCASE&nextsql=keyword">D</a>&nbsp; 
              <a href="/bw_lookup_list?sql=select+distinct+keyword%2C+count(*)+from+kw_x+where+upper(keyword)+like+%27E%25%27+group+by+keyword+order+by+keyword+NOCASE&nextsql=keyword">E</a>&nbsp; 
              <a href="/bw_lookup_list?sql=select+distinct+keyword%2C+count(*)+from+kw_x+where+upper(keyword)+like+%27F%25%27+group+by+keyword+order+by+keyword+NOCASE&nextsql=keyword">F</a>&nbsp; 
              <a href="/bw_lookup_list?sql=select+distinct+keyword%2C+count(*)+from+kw_x+where+upper(keyword)+like+%27G%25%27+group+by+keyword+order+by+keyword+NOCASE&nextsql=keyword">G</a>&nbsp; 
              <a href="/bw_lookup_list?sql=select+distinct+keyword%2C+count(*)+from+kw_x+where+upper(keyword)+like+%27H%25%27+group+by+keyword+order+by+keyword+NOCASE&nextsql=keyword">H</a>&nbsp;<br>
              <a href="/bw_lookup_list?sql=select+distinct+keyword%2C+count(*)+from+kw_x+where+upper(keyword)+like+%27I%25%27+group+by+keyword+order+by+keyword+NOCASE&nextsql=keyword">I</a>&nbsp; 
              <a href="/bw_lookup_list?sql=select+distinct+keyword%2C+count(*)+from+kw_x+where+upper(keyword)+like+%27J%25%27+group+by+keyword+order+by+keyword+NOCASE&nextsql=keyword">J</a>&nbsp; 
              <a href="/bw_lookup_list?sql=select+distinct+keyword%2C+count(*)+from+kw_x+where+upper(keyword)+like+%27K%25%27+group+by+keyword+order+by+keyword+NOCASE&nextsql=keyword">K</a>&nbsp; 
              <a href="/bw_lookup_list?sql=select+distinct+keyword%2C+count(*)+from+kw_x+where+upper(keyword)+like+%27L%25%27+group+by+keyword+order+by+keyword+NOCASE&nextsql=keyword">L</a>&nbsp; 
              <a href="/bw_lookup_list?sql=select+distinct+keyword%2C+count(*)+from+kw_x+where+upper(keyword)+like+%27M%25%27+group+by+keyword+order+by+keyword+NOCASE&nextsql=keyword">M</a>&nbsp; 
              <br>
              <a href="/bw_lookup_list?sql=select+distinct+keyword%2C+count(*)+from+kw_x+where+upper(keyword)+like+%27N%25%27+group+by+keyword+order+by+keyword+NOCASE&nextsql=keyword"> 
              N</a>&nbsp; <a href="/bw_lookup_list?sql=select+distinct+keyword%2C+count(*)+from+kw_x+where+upper(keyword)+like+%27O%25%27+group+by+keyword+order+by+keyword+NOCASE&nextsql=keyword">O</a>&nbsp; 
              <a href="/bw_lookup_list?sql=select+distinct+keyword%2C+count(*)+from+kw_x+where+upper(keyword)+like+%27P%25%27+group+by+keyword+order+by+keyword+NOCASE&nextsql=keyword">P</a>&nbsp; 
              <a href="/bw_lookup_list?sql=select+distinct+keyword%2C+count(*)+from+kw_x+where+upper(keyword)+like+%27Q%25%27+group+by+keyword+order+by+keyword+NOCASE&nextsql=keyword">Q</a>&nbsp; 
              <a href="/bw_lookup_list?sql=select+distinct+keyword%2C+count(*)+from+kw_x+where+upper(keyword)+like+%27R%25%27+group+by+keyword+order+by+keyword+NOCASE&nextsql=keyword">R</a>&nbsp; 
              <a href="/bw_lookup_list?sql=select+distinct+keyword%2C+count(*)+from+kw_x+where+upper(keyword)+like+%27S%25%27+group+by+keyword+order+by+keyword+NOCASE&nextsql=keyword">S</a>&nbsp; 
              <a href="/bw_lookup_list?sql=select+distinct+keyword%2C+count(*)+from+kw_x+where+upper(keyword)+like+%27T%25%27+group+by+keyword+order+by+keyword+NOCASE&nextsql=keyword">T</a>&nbsp; 
              <a href="/bw_lookup_list?sql=select+distinct+keyword%2C+count(*)+from+kw_x+where+upper(keyword)+like+%27U%25%27+group+by+keyword+order+by+keyword+NOCASE&nextsql=keyword">U</a>&nbsp;<br>
              <a href="/bw_lookup_list?sql=select+distinct+keyword%2C+count(*)+from+kw_x+where+upper(keyword)+like+%27V%25%27+group+by+keyword+order+by+keyword+NOCASE&nextsql=keyword">V</a>&nbsp; 
              <a href="/bw_lookup_list?sql=select+distinct+keyword%2C+count(*)+from+kw_x+where+upper(keyword)+like+%27W%25%27+group+by+keyword+order+by+keyword+NOCASE&nextsql=keyword">W</a>&nbsp; 
              <a href="/bw_lookup_list?sql=select+distinct+keyword%2C+count(*)+from+kw_x+where+upper(keyword)+like+%27X%25%27+group+by+keyword+order+by+keyword+NOCASE&nextsql=keyword">X</a>&nbsp; 
              <a href="/bw_lookup_list?sql=select+distinct+keyword%2C+count(*)+from+kw_x+where+upper(keyword)+like+%27Y%25%27+group+by+keyword+order+by+keyword+NOCASE&nextsql=keyword">Y</a>&nbsp; 
              <a href="/bw_lookup_list?sql=select+distinct+keyword%2C+count(*)+from+kw_x+where+upper(keyword)+like+%27Z%25%27+group+by+keyword+order+by+keyword+NOCASE&nextsql=keyword">Z</a> 
              </font></p>
            <p><font size="2" face="Verdana, Arial, Helvetica, sans-serif">A categorized 
              index of keywords is available <a href="keywords.htm" target="_blank">here</a>.</font> 
            </p></td>
          <td width="205" height="29" align="center" valign="top"> <font face="Verdana, Arial, Helvetica" size="2"><a href="/bw_lookup_list?sql=select+distinct+journal%2C+count(*)+from+jn_x+group+by+journal&nextsql=journal"><b>Journals 
            (All)</b></a><br>
            <a href="/bw_lookup_list?sql=select+distinct+journal%2C+count(*)+from+jn_x+where+upper(journal)+like+%27A%25%27+group+by+journal&nextsql=journal"> 
            A</a>&nbsp; <a href="/bw_lookup_list?sql=select+distinct+journal%2C+count(*)+from+jn_x+where+upper(journal)+like+%27B%25%27+group+by+journal&nextsql=journal">B</a>&nbsp; 
            <a href="/bw_lookup_list?sql=select+distinct+journal%2C+count(*)+from+jn_x+where+upper(journal)+like+%27C%25%27+group+by+journal&nextsql=journal">C</a>&nbsp; 
            <a href="/bw_lookup_list?sql=select+distinct+journal%2C+count(*)+from+jn_x+where+upper(journal)+like+%27D%25%27+group+by+journal&nextsql=journal">D</a>&nbsp; 
            <a href="/bw_lookup_list?sql=select+distinct+journal,+count(*)+from+jn_x+where+upper(journal)+like+%27E%25%27+group+by+journal&amp;nextsql=journal">E</a>&nbsp; 
            <a href="/bw_lookup_list?sql=select+distinct+journal%2C+count(*)+from+jn_x+where+upper(journal)+like+%27F%25%27+group+by+journal&nextsql=journal">F</a>&nbsp; 
            <a href="/bw_lookup_list?sql=select+distinct+journal%2C+count(*)+from+jn_x+where+upper(journal)+like+%27G%25%27+group+by+journal&nextsql=journal">G</a>&nbsp; 
            <a href="/bw_lookup_list?sql=select+distinct+journal%2C+count(*)+from+jn_x+where+upper(journal)+like+%27H%25%27+group+by+journal&nextsql=journal">H</a><br>
            &nbsp; <a href="/bw_lookup_list?sql=select+distinct+journal%2C+count(*)+from+jn_x+where+upper(journal)+like+%27I%25%27+group+by+journal&nextsql=journal">I</a>&nbsp; 
            <a href="/bw_lookup_list?sql=select+distinct+journal%2C+count(*)+from+jn_x+where+upper(journal)+like+%27J%25%27+group+by+journal&nextsql=journal">J</a>&nbsp; 
            <a href="/bw_lookup_list?sql=select+distinct+journal%2C+count(*)+from+jn_x+where+upper(journal)+like+%27K%25%27+group+by+journal&nextsql=journal">K</a>&nbsp; 
            <a href="/bw_lookup_list?sql=select+distinct+journal%2C+count(*)+from+jn_x+where+upper(journal)+like+%27L%25%27+group+by+journal&nextsql=journal">L</a>&nbsp; 
            <a href="/bw_lookup_list?sql=select+distinct+journal%2C+count(*)+from+jn_x+where+upper(journal)+like+%27M%25%27+group+by+journal&nextsql=journal">M</a>&nbsp; 
            <br>
            <a href="/bw_lookup_list?sql=select+distinct+journal%2C+count(*)+from+jn_x+where+upper(journal)+like+%27N%25%27+group+by+journal&nextsql=journal"> 
            N</a>&nbsp; <a href="/bw_lookup_list?sql=select+distinct+journal%2C+count(*)+from+jn_x+where+upper(journal)+like+%27O%25%27+group+by+journal&nextsql=journal">O</a>&nbsp; 
            <a href="/bw_lookup_list?sql=select+distinct+journal%2C+count(*)+from+jn_x+where+upper(journal)+like+%27P%25%27+group+by+journal&nextsql=journal">P</a>&nbsp; 
            <a href="/bw_lookup_list?sql=select+distinct+journal%2C+count(*)+from+jn_x+where+upper(journal)+like+%27Q%25%27+group+by+journal&nextsql=journal">Q</a>&nbsp; 
            <a href="/bw_lookup_list?sql=select+distinct+journal%2C+count(*)+from+jn_x+where+upper(journal)+like+%27R%25%27+group+by+journal&nextsql=journal">R</a>&nbsp; 
            <a href="/bw_lookup_list?sql=select+distinct+journal%2C+count(*)+from+jn_x+where+upper(journal)+like+%27S%25%27+group+by+journal&nextsql=journal">S</a>&nbsp; 
            <a href="/bw_lookup_list?sql=select+distinct+journal%2C+count(*)+from+jn_x+where+upper(journal)+like+%27T%25%27+group+by+journal&nextsql=journal">T</a>&nbsp; 
            <a href="/bw_lookup_list?sql=select+distinct+journal%2C+count(*)+from+jn_x+where+upper(journal)+like+%27U%25%27+group+by+journal&nextsql=journal">U</a><br>
            <a href="/bw_lookup_list?sql=select+distinct+journal%2C+count(*)+from+jn_x+where+upper(journal)+like+%27V%25%27+group+by+journal&nextsql=journal">V</a>&nbsp; 
            <a href="/bw_lookup_list?sql=select+distinct+journal%2C+count(*)+from+jn_x+where+upper(journal)+like+%27W%25%27+group+by+journal&nextsql=journal">W</a>&nbsp; 
            <a href="/bw_lookup_list?sql=select+distinct+journal%2C+count(*)+from+jn_x+where+upper(journal)+like+%27X%25%27+group+by+journal&nextsql=journal">X</a>&nbsp; 
            <a href="/bw_lookup_list?sql=select+distinct+journal%2C+count(*)+from+jn_x+where+upper(journal)+like+%27Y%25%27+group+by+journal&nextsql=journal">Y</a>&nbsp; 
            <a href="/bw_lookup_list?sql=select+distinct+journal%2C+count(*)+from+jn_x+where+upper(journal)+like+%27Z%25%27+group+by+journal&nextsql=journal">Z</a> 
            </font> </td>
        </tr>
      </table>
      <p>&nbsp;</p>

          </TD>
          <TD valign="top" width="2%">
          </TD>
</TABLE>
      
<br>
<table border="0" width="100%" height="32">
  <tr> 
    <td colspan="3"> 
      <div align="center"><font face="Courier New, Courier, mono" size="2"><b><font face="Verdana, Arial, Helvetica, sans-serif">For 
        internal use only</font></b></font><font size="1" face="Verdana, Arial, Helvetica, sans-serif"></font></div>
    </td>
    <td width="12%">&nbsp;</td>
    <td colspan="4" width="44%">&nbsp;</td>
  </tr>
  <tr> 
    <td width="14%"> 
      <div align="center"><font face="Verdana, Arial, Helvetica" size="2"><a href="bw_bib_new" class="chan"><img border="0" src="bwg_bib_add.gif" width="16" height="16"> 
        New Record</a></font></div>
    </td>
    <td width="14%"> 
      <div align="center"><font face="Verdana, Arial, Helvetica" size="2"><a href="bw_folder_new" class="chan"><img border="0" src="bwg_folder_add.gif" width="16" height="16"> 
        New Folder</a></font></div>
    </td>
    <td width="12%"> 
      <div align="center"><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><a href="bw_import_new" class="chan"><img src="bwg_import.gif" width="16" height="16" border="0"> 
        Import</a></font></div>
    </td>
    <td width="12%" align="center"><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><img src="admin.gif" width="16" height="16"><a href="bw_user_list" class="chan">Admin</a></font></td>
    <td colspan="4" width="44%">&nbsp;</td>
  </tr>
</table>
</BODY></HTML>
