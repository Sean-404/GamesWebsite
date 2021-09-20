<?php
// ----INCLUDE APIS------------------------------------
// Include our Website API
include ("api/api.inc.php");

// ----PAGE GENERATION LOGIC---------------------------
session_start();

function createPage($pmethod, $paction, array $pform)
{
    nullAsEmpty($pform, "userName");
    nullAsEmpty($pform, "inputPassword");
    nullAsEmpty($pform, "err-userName");

    $tcontent = <<<PAGE
<form class="form-horizontal" method="{$pmethod}" action="{$paction}">
            <div class="form-group">
                <label class="control-label col-xs-3" for="firstName">Username:</label>
                <div class="col-xs-9">
                    <input type="text" class="form-control" id="userName" name="userName"
                    placeholder="Username" value="{$pform["userName"]}">
                </div>
            </div>
		    <div class="form-group">
		        <label for="inputPassword" class="control-label col-xs-3">Password</label>
		        <div class="col-xs-9">
		            <input type="password" class="form-control" id="inputPassword"
                     name="inputPassword" placeholder="Password" value="{$pform["inputPassword"]}">
		        </div>
		    </div>
		    <div class="form-group">
		        <div class="col-xs-offset-3 col-xs-9">
		            <div class="checkbox">
		                <label><input type="checkbox"> Remember me</label>
		            </div>
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
					<h1>You have been logged in {$pformdata["userName"]}</h1>
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
    if ($tvalid && empty($pformdata["userName"]))
    {
        $tvalid = false;
        $pformdata["err-firstName"] = "<p id=\"help-firstName\" class=\"help-block\">Username Required</p>";
    }
    if ($tvalid && empty($pformdata["inputPassword"]))
    {
        $tvalid = false;
    }
    if ($tvalid)
    {
        appFormSetValid($pformdata);
    }
    return $pformdata;
}

// ----BUSINESS LOGIC---------------------------------
$taction = appFormActionSelf();
$tmethod = appFormMethod();
$tformdata = processForm($_REQUEST) ?? array();

if (appFormCheckValid($tformdata))
{
    $_SESSION["userName"] = $tformdata["userName"];
    $user_input = $tformdata["userName"];
    $password_input = $tformdata["inputPassword"];
    $file = fopen("data/text/User_Data.txt", "r");

    while (! feof($file))
    {
        $line = fgets($file);
        list ($user, $password) = explode("\n", $line);
        if (trim($user) == $user_input && trim($password) == $password_input)
        {
            break;
        }
    }
    fclose($file);
    $tpagecontent = createResponse($tformdata);
}
else
{
    $tpagecontent = createPage($tmethod, $taction, $tformdata);
}

// ----BUILD OUR HTML PAGE----------------------------
// Create an instance of our Page class
$tindexpage = new MasterPage("Data Entry");
$tindexpage->setDynamic2($tpagecontent);
$tindexpage->renderPage();

?>