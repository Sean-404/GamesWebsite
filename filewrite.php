<?php
// ----INCLUDE APIS------------------------------------
include ("api/api.inc.php");

// ----PAGE GENERATION LOGIC---------------------------
function createPage()
{
    $theredoc = <<<HTML
<div class="container">
  <div class="row">
    <div class="col-sm-4">
      <h3>Column 1</h3>
      <p>Lorem ipsum dolor..</p>
      <p>Ut enim ad..</p>
    </div>
    <div class="col-sm-4">
      <h3>Column 2</h3>
      <p>Lorem ipsum dolor..</p>
      <p>Ut enim ad..</p>
    </div>
    <div class="col-sm-4">
      <h3>Column 3</h3> 
      <p>Lorem ipsum dolor..</p>
      <p>Ut enim ad..</p>
    </div>
  </div>
</div>
HTML;

    $tfilename = "data/text/existing.txt";
    if (is_writable($tfilename))
    {
        // Open Existing File (or create new if it doesn't exist)
        // $tfile = fopen($tfilename,"w");
        // OR: If we want to append to the existing content
        $tfile = fopen($tfilename, "a");

        fwrite($tfile, $theredoc);
        $tarray = [
            "line one",
            "line two",
            "line three",
            "line four"
        ];
        foreach ($tarray as $tline)
        {
            fwrite($tfile, PHP_EOL . $tline);
        }
        fclose($tfile);
    }

    $texisting = file_get_contents($tfilename);

    $tnewdata = "";
    $tnewfilename = "data/text/new.txt";
    if (is_writable("data") && ! file_exists($tnewfilename))
    {
        // has to be a new file
        $tfile = fopen($tnewfilename, "x");
        fwrite($tfile, $theredoc);
        $tarray = [
            "line one",
            "line two",
            "line three",
            "line four"
        ];
        foreach ($tarray as $tline)
        {
            fwrite($tfile, $tline . PHP_EOL);
        }
        fclose($tfile);
        $tnewdata = file_get_contents($tfilename);
    }
    else
    {
        $tnewdata = "ERROR: File {$tnewfilename} already exists";
    }

    $tcontent = <<<PAGE
		<div class="row">
            <h2>1. Writing to an Existing File {$tfilename}</h2>
            <div class="well">
            <div>{$texisting}</div>
            </div>
		</div>
        <div class="row">
            <h2>2. Writing to a New File - {$tnewfilename}</h2>
            <div class="well">
            <div>{$tnewdata}</div>
            </div>
		</div>
PAGE;
    return $tcontent;
}

// ----BUSINESS LOGIC---------------------------------
// Build up our Dynamic Content Items.
$tpagetitle = "File Writing Example";
$tpagecontent = createPage();

// ----BUILD OUR HTML PAGE----------------------------
// Create an instance of our Page class
$tpage = new MasterPage($tpagetitle);
$tpage->setDynamic2($tpagecontent);
$tpage->renderPage();
?>