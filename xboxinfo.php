<?php
// ----INCLUDE APIS------------------------------------
include ("api/api.inc.php");

// ----PAGE GENERATION LOGIC---------------------------
function createPage()
{
    // Get the Data we need for this page
    $tcitems = xmlLoadAll("data/xml/carousel-club.xml", "PLCarouselImage", "Image");
    $ttabs = xmlLoadAll("data/xml/tabs-club.xml", "PLTab", "Tab");
    $tquotes = xmlLoadOne("data/xml/quotes-any.xml", "PLQuote");
    // $tmanager = jsonLoadOneManager(1);
    // $tcoaches = jsonLoadAllCoaching();
    // $tboard = jsonLoadAllExecutive();
    // $tstadium = jsonLoadOneStadium(1);

    // $tkits = jsonLoadAllKit();

    // Build the UI Components
    $tcarouselhtml = renderUICarousel($tcitems, "img/carousel");
    // $tmanagerhtml = renderManagerTable($tmanager);
    // $tboardhtml = renderExecutiveTable($tboard);
    // $tstadiumhtml = renderStadiumSummary($tstadium);
    // $tcoachhtml = renderCoachingTable($tcoaches);
    // $tkitshtml = renderKitTable($tkits);

    // Build UI Components with External HTML Loading
    $tquotehtml = "I need a weapon";
    $tquotehtml .= renderUIQuote($tquotes);

    foreach ($ttabs as $ttab)
    {
        $ttab->content = file_get_contents("data/html/{$ttab->content_href}");
    }
    $ttabhtml = renderUITabs($ttabs, "club-content");

    // Construct the Page
    $tcontent = <<<PAGE
    {$tcarouselhtml}
<section class="row details" id="club-quote">
    {$tquotehtml}
    </section>
    <section class="row details" id="club-overview">
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title">Xbox One Overview:</h3>
        </div>
        <div class="panel-body">
        {$ttabhtml}
        </div>
    </div>
</section>
     
PAGE;

    return $tcontent;
}

// ----BUSINESS LOGIC---------------------------------
// Start up a PHP Session for this user.
session_start();

// Build up our Dynamic Content Items.
$tpagetitle = "Club Information";
$tpagelead = "";
$tpagecontent = createPage();
$tpagefooter = "";

// ----BUILD OUR HTML PAGE----------------------------
// Create an instance of our Page class
$tpage = new MasterPage($tpagetitle);
// Set the Three Dynamic Areas (1 and 3 have defaults)
if (! empty($tpagelead))
    $tpage->setDynamic1($tpagelead);
$tpage->setDynamic2($tpagecontent);
if (! empty($tpagefooter))
    $tpage->setDynamic3($tpagefooter);
// Return the Dynamic Page to the user.
$tpage->renderPage();
?>