<?php

// Include our HTML Page Class
require_once ("oo_page.inc.php");

class MasterPage
{

    // -------FIELD MEMBERS----------------------------------------
    private $_htmlpage;

    // Holds our Custom Instance of an HTML Page
    private $_dynamic_1;

    // Field Representing our Dynamic Content #1
    private $_dynamic_2;

    // Field Representing our Dynamic Content #2
    private $_dynamic_3;

    // Field Representing our Dynamic Content #3
    private $_player_ids;

    // -------CONSTRUCTORS-----------------------------------------
    function __construct($ptitle)
    {
        $this->_htmlpage = new HTMLPage($ptitle);
        $this->setPageDefaults();
        $this->setDynamicDefaults();
        $this->_player_ids = [
            1,
            2,
            3,
            4,
            5,
            6,
            7,
            8,
            9,
            10,
            11
        ];
    }

    // -------GETTER/SETTER FUNCTIONS------------------------------
    public function getDynamic1()
    {
        return $this->_dynamic_1;
    }

    public function getDynamic2()
    {
        return $this->_dynamic_2;
    }

    public function getDynamic3()
    {
        return $this->_dynamic_3;
    }

    public function setDynamic1($phtml)
    {
        $this->_dynamic_1 = $phtml;
    }

    public function setDynamic2($phtml)
    {
        $this->_dynamic_2 = $phtml;
    }

    public function setDynamic3($phtml)
    {
        $this->_dynamic_3 = $phtml;
    }

    public function getPage(): HTMLPage
    {
        return $this->_htmlpage;
    }

    // -------PUBLIC FUNCTIONS-------------------------------------
    public function createPage()
    {
        // Create our Dynamic Injected Master Page
        $this->setMasterContent();
        // Return the HTML Page..
        return $this->_htmlpage->createPage();
    }

    public function renderPage()
    {
        // Create our Dynamic Injected Master Page
        $this->setMasterContent();
        // Echo the page immediately.
        $this->_htmlpage->renderPage();
    }

    public function addCSSFile($pcssfile)
    {
        $this->_htmlpage->addCSSFile($pcssfile);
    }

    public function addScriptFile($pjsfile)
    {
        $this->_htmlpage->addScriptFile($pjsfile);
    }

    // -------PRIVATE FUNCTIONS-----------------------------------
    private function setPageDefaults()
    {
        $this->_htmlpage->setMediaDirectory("css", "js", "fonts", "img", "data");
        $this->addCSSFile("bootstrap.css");
        $this->addCSSFile("site.css");
        $this->addScriptFile("jquery-2.2.4.js");
        $this->addScriptFile("bootstrap.js");
        $this->addScriptFile("holder.js");
    }

    private function setDynamicDefaults()
    {
        $tcurryear = date("Y");
        // Set the Three Dynamic Points to Empty By Default.
        $this->_dynamic_1 = <<<JUMBO
<h1>Gaming Critic</h1>
<p class="lead">Top Xbox One Reviews</p>
JUMBO;
        $this->_dynamic_2 = "";
        $this->_dynamic_3 = <<<FOOTER
<p>Sean McKenna - LJMU &copy; {$tcurryear}</p>
FOOTER;
    }

    private function setMasterContent()
    {
        $tusername = $_SESSION["userName"] ?? "";
        $texithtml = <<<EXIT
        <a class="btn btn-info navbar-right" href="app_exit.php?action=exit">Exit</a>
EXIT;
        $tuserprofile = <<<USERPROFILE
        <li role="presentation"><a href="profile.php">{$tusername}</a></li>
USERPROFILE;

        $tauth = "";
        $tauth2 = "";
        if (isset($_SESSION["userName"]))
        {
            $tauth = $texithtml;
            $tauth2 = $tuserprofile;
        }
        $tid = $this->_player_ids[array_rand($this->_player_ids, 1)];
        $tmasterpage = <<<MASTER
<div class="container">
	<div class="header clearfix">
		<nav>
		    {$tauth}
			<ul class="nav nav-pills pull-right">
				<li role="presentation"><a href="xboxinfo.php">Xbox One Info</a></li>
                <li role="presentation"><a href="ranking.php">Ranking Table</a></li>
				<li role="presentation"><a href="games.php?id={$tid}">Game Reviews</a></li>
                <li role="presentation"><a href="datainput.php">Create Account</a></li>
                <li role="presentation"><a href="login.php">Login</a></li>
                {$tauth2}
			</ul>
			<h3 class="text-muted"><a href="index.php">Gaming Critic</a></h3>
		</nav>
	</div>
	<div class="jumbotron">
		{$this->_dynamic_1}
    </div>
	<div class="row details">
		{$this->_dynamic_2}
    </div>
    <footer class="footer">
		{$this->_dynamic_3}
	</footer>
</div>        
MASTER;
        $this->_htmlpage->setBodyContent($tmasterpage);
    }
}

?>