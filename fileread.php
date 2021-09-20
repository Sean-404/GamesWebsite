<?php 
//----INCLUDE APIS------------------------------------
include("api/api.inc.php");

//----PAGE GENERATION LOGIC---------------------------

function createPage()
{
    //---Reading from an existing file on the file system-----------------
    
    //APPROACH 1:  USING FGETS AND A WHILE LOOP
    $tmyfile = fopen("data/text/content.txt", "r");
    $tfilecontents = "";
    while(!feof($tmyfile))
    {
        $tfilecontents .= fgets($tmyfile);
    }
    fclose($tmyfile);
    
    //APPROACH 2:  READING ENTIRE FILE AS A STRING
    $twholefile = file_get_contents("data/text/content.txt");
    $tarray = file("data/text/content.txt");
    $tfromarray = implode("<br>",$tarray);
    
    //APPROACH 4 and 5:  USING SPL FILE CONTENTS TO GET DATA
    $tlineno = 2;
    $tid = $tlineno-1;
    $tfile = new SplFileObject("data/text/content.txt");
    $tfile->seek($tid);
    $tlinedata = $tfile->current();
            
    //Go back to First line
    $tfile->rewind();
    $tfiledata = "";
    while(!$tfile->eof())
    {
        $tfiledata .= $tfile->current();
        $tfile->next();
    }
    $tfile= null;
    
$tcontent = <<<PAGE
		<div class="row">
            <h2>1. Using fopen, feof and fgets</h2>
            <div class="well">
            <pre>{$tfilecontents}</pre>
            </div>
		</div>
        <div class="row">
            <h2>2. Using file_get_contents</h2>
            <div class="well">
            <pre>{$twholefile}</pre>
            </div>
		</div>
        <div class="row">
            <h2>3. using file to get array</h2>
            <div class="well">
            <pre>{$tfromarray}</pre>
            </div>
		</div>
        <div class="row">
            <h2>4. SPLFileObject - Whole File</h2>
            <div class="well">
            <pre>{$tfiledata}</pre>
            </div>
		</div>
        <div class="row">
            <h2>5. SPLFileObject - Individual Line</h2>
            <div class="well">
            <pre>{$tlinedata}</pre>
            </div>
		</div>
PAGE;
return $tcontent;
}

//----BUSINESS LOGIC---------------------------------
//Build up our Dynamic Content Items. 
$tpagetitle = "File Reading Example";
$tpagecontent = createPage();

//----BUILD OUR HTML PAGE----------------------------
//Create an instance of our Page class
$tpage = new MasterPage($tpagetitle);
$tpage->setDynamic2($tpagecontent);   
$tpage->renderPage();
?>