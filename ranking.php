<?php
// ----INCLUDE APIS------------------------------------
include ("api/api.inc.php");

// ----PAGE GENERATION LOGIC---------------------------
function createPage($pimgdir, $pcurrpage, $psortmode, $psortorder)
{
    // Get the Presentation Layer content
    // $tstats = xmlLoadAll("data/xml/stats-any.xml", "PLStatistic", "Statistic");
    // $tkeylist = xmlLoadAll("data/xml/key-any.xml", "PLKeyPlayerItem", "KeyPlayer");
    // $tci = xmlLoadAll("data/xml/carousel-squad.xml", "PLCarouselImage", "Image");
    $tsquad = new BLLSquad();
    $tsquad->captainindex = 8;
    $tsquad->starplayerindex = 9;
    $tsquad->squadname = "Game Ranking";
    $tsquad->squadlist = jsonLoadAllPlayer();

    // We need to sort the squad using our custom class-based sort function
    $tsortfunc = "";
    if ($psortmode == "ranking")
        $tsortfunc = "squadsortbyranking";
    else 
        if ($psortmode == "name")
            $tsortfunc = "squadsortbyname";

    // Only sort the array if we have a valid function name
    if (! empty($tsortfunc))
        usort($tsquad->squadlist, $tsortfunc);

    // The pagination working out how many elements we need and
    $tnoitems = sizeof($tsquad->squadlist);
    $tperpage = 5;
    $tnopages = ceil($tnoitems / $tperpage);

    // Create a Pagniated Array based on the number of items and what page we want.
    $tfiltersquad = appPaginateArray($tsquad->squadlist, $pcurrpage, $tperpage);
    $tsquad->squadlist = $tfiltersquad;

    // Render the HTML for our Table and our Pagination Controls
    $tsquadtable = renderPlayerTable($tsquad);
    $tpagination = renderPagination($_SERVER['PHP_SELF'], $tnopages, $pcurrpage);

    // Use the Presentation Layer to build the UI Elements
    // $tcarousel = renderUICarousel($tci, "{$pimgdir}/carousel");
    // $tstats = renderUIStatistics($tstats);
    // $tkeyplayers = renderUIKeyPlayersList($tkeylist);

    $tcontent = <<<PAGE
		<ul class="breadcrumb">
			<li><a href="index.php">Home</a></li>
			<li class="active">Ranking</li>
		</ul>
		<div class="row">
		</div>
		<div class="row">
			<div class="panel panel-primary">
			<div class="panel-body">
				<h2>Game Ranking Table</h2>
				<p>{$tsquad->squadname}</p>
				<div id="squad-table">
			    {$tsquadtable}
                {$tpagination}
		        </div>
		    </div>
			</div>
		</div>
		<div class="row">
		</div>
PAGE;

    return $tcontent;
}

// ----BUSINESS LOGIC---------------------------------
// Start up a PHP Session for this user.
session_start();
$tcurrpage = $_REQUEST["page"] ?? 1;
$tcurrpage = is_numeric($tcurrpage) ? $tcurrpage : 1;
$tsortmode = $_REQUEST["sortmode"] ?? "";
$tsortorder = $_REQUEST["sortorder"] ?? "asc";

$tpagetitle = "Squad Information";
$tpage = new MasterPage($tpagetitle);
$timgdir = $tpage->getPage()->getDirImages();

// Build up our Dynamic Content Items.
$tpagelead = "";
$tpagecontent = createPage($timgdir, $tcurrpage, $tsortmode, $tsortorder);
$tpagefooter = "";

// ----BUILD OUR HTML PAGE----------------------------
// Set the Three Dynamic Areas (1 and 3 have defaults)
if (! empty($tpagelead))
    $tpage->setDynamic1($tpagelead);
$tpage->setDynamic2($tpagecontent);
if (! empty($tpagefooter))
    $tpage->setDynamic3($tpagefooter);
// Return the Dynamic Page to the user.
$tpage->renderPage();
?>