<?php
// ----INCLUDE APIS------------------------------------
include ("api/api.inc.php");

// ----PAGE GENERATION LOGIC---------------------------
function createPage($pmethod, $paction, array $pform)
{
    nullAsEmpty($pform, "faveGame");
    nullasEmpty($pform, "err-userName");

    $tcontent = <<<PAGE
<form class="form-horizontal" method="{$pmethod}" action="{$paction}">
		<div class="form-group">
			<label class="col-md-4 control-label" for="pos">Favourite Game</label>
			<div class="col-md-4">
				<select id="faveGame" name="faveGame" class="form-control"name="faveGame"
                    placeholder="Favourite Game" value="{$pform["faveGame"]}">
					<option value="Monster Hunter: World">Monster Hunter: World</option>
					<option value="ARK: Survival Evolved">ARK: Survival Evolved</option>
					<option value="Sonic Mania Plus">Sonic Mania Plus</option>
					<option value="Sonic Forces">Sonic Forces</option>
					<option value="Forza Horizon 3">Forza Horizon 3</option>
                    <option value="Forza Horizon 4">Forza Horizon 4</option>
                    <option value="Minecraft: Xbox One Edition">Minecraft: Xbox One Edition</option>
                    <option value="Titanfall 2">Titanfall 2</option>
                    <option value="Sword Art Online: Fatal Bullet">Sword Art Online: Fatal Bullet</option>
                    <option value="Halo: The Master Chief Collection">Halo: The Master Chief Collection</option>
                    <option value="Forza Motorsport 7">Forza Motorsport 7</option>
				</select>
			</div>
		</div>
            <div class="form-group">
		        <div class="col-xs-offset-3 col-xs-9">
		            <input type="submit" class="btn btn-primary" value="Submit">
		            <input type="reset" class="btn btn-default" value="Reset">
		        </div>
		    </div>
		</form>
PAGE;
    return $tcontent;
}

function createResponse(array $pformdata)
{
    $tresponse = <<<RESPONSE
		<section class="panel panel-primary" id="Form Response">
				<div class="jumbotron">
					<h1>Your favourite game is {$pformdata["faveGame"]}</h1>
					<p class="lead">Thank you for keeping up to date with Gaming Critic!</p>
					<p class="lead"></p>
				</div>
		</section>
RESPONSE;
    return $tresponse;
}

function processForm(array $pformdata): array
{
    foreach ($pformdata as $tfield => $tvalue)
    {
        $pformdata[$tfield] = appFormProcessData($tvalue);
    }
    $tvalid = true;
    if ($tvalid && empty($pformdata["faveGame"]))
    {
        $tvalid = false;
        $pformdata["err-firstName"] = "<p id=\"help-firstName\" class=\"help-block\">Game Required</p>";
    }
    if ($tvalid)
    {
        appFormSetValid($pformdata);
    }
    return $pformdata;
}

// ----BUSINESS LOGIC---------------------------------
// Start up a PHP Session for this user.
session_start();

// Build up our Dynamic Content Items.
$taction = appFormActionSelf();
$tmethod = appFormMethod();
$tformdata = processForm($_REQUEST) ?? array();

if (appFormCheckValid($tformdata))
{
    $tpagecontent = createResponse($tformdata);
}
else
{
    $tpagecontent = createPage($tmethod, $taction, $tformdata);
}
// ----BUILD OUR HTML PAGE----------------------------
// Create an instance of our Page class
$tindexpage = new MasterPage("Profile Page");
$tindexpage->setDynamic2($tpagecontent);
$tindexpage->renderPage();
?>