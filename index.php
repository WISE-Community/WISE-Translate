<?php 
session_start(); 
if (!isset($_SESSION["username"]) || !isset($_SESSION["userEmail"]) || !isset($_SESSION["userLocale"])) {
  header("Location: login.php");
}
?>
<html>
<head>
<title><?php echo "Welcome ".$_SESSION["username"]; ?></title>
<style type="text/css">
h1,h2,h3 { padding: 0; margin: 20 0 0 10; }
p {margin: 2 0 0 10;}
</style>
<script type="text/javascript" src="common/js/jquery-1.9.0.js"></script>
<script type="text/javascript" src="common/js/common.js"></script>
<script type="text/javascript" src="common/js/jsonFormat.js"></script>
<script type="text/javascript" src="common/js/translateJSON.js"></script>
<script type="text/javascript" src="common/js/translateProperties.js"></script>
<script type="text/javascript">
$(document).ready(function() {

// show userLocale in the page title
$("#userLocale").html(localeToHumanReadableLanguage('<?php echo $_SESSION["userLocale"]; ?>'));

var currentLanguage = "<?php echo $_SESSION["userLocale"]; ?>";

$(".stats").each(function() {
  var projectType = $(this).attr("projectType");
  View.prototype.i18n[View.prototype.i18n.defaultLocale] = {};
  View.prototype.retrieveLocale(View.prototype.i18n.defaultLocale,projectType);

  View.prototype.i18n[currentLanguage] = {};
  View.prototype.retrieveLocale(currentLanguage,projectType);

  // get actual number of completions. Check if value is actually set
  var defaultLanguageKeys = Object.keys(View.prototype.i18n[View.prototype.i18n.defaultLocale]);
  var numTotal = defaultLanguageKeys.length;  
  var numCompleted = 0;
  if (projectType != "portal") {
     // this is a non-portal project, which uses JSON file format
     for (var i = 0; i < defaultLanguageKeys.length; i++) {
     	 var defaultLanguageKey = defaultLanguageKeys[i];
     	 // make sure that there is an actual translated value in the current language
     	 if (typeof View.prototype.i18n[currentLanguage][defaultLanguageKey] != "undefined" &&
            typeof View.prototype.i18n[currentLanguage][defaultLanguageKey]["value"] != "undefined" &&
            View.prototype.i18n[currentLanguage][defaultLanguageKey]["value"].trim() != "") {
 	    numCompleted++;							     
     	 }
     }
  } else {
     // this is the portal project, which uses Properties (key=value) file format
     // re-calculate number of total translatable keys
     numTotal = 0;
     numCompleted = 0;
     for (var k = 0; k < defaultLanguageKeys.length; k++) {
       if (!defaultLanguageKeys[k].endsWith(".description")) {
         numTotal++;
       }
     }
     for (var i = 0; i < defaultLanguageKeys.length; i++) {
     	 var defaultLanguageKey = defaultLanguageKeys[i];
     	 // make sure that there is an actual translated value in the current language
     	 if (!defaultLanguageKey.endsWith(".description") &&
             typeof View.prototype.i18n[currentLanguage][defaultLanguageKey] != "undefined" &&
             View.prototype.i18n[currentLanguage][defaultLanguageKey].trim() != "") {
      	       numCompleted++;
     	 }
     }
  }

  if (numCompleted < numTotal) {
    $(this).parent("a").css("background-color","yellow");
  } else if (numCompleted > numTotal) {
    // for some reason numCompleted > numTotal, show as completed so it won't confuse the translator.
    numCompleted = numTotal;
  }

  $(this).append(" ["+ numCompleted + "/" + numTotal + "]");

  // Also show a button to download the translation file
  $(this).append(" <a href=\"download.php?projectType=" + projectType + "&locale=" + currentLanguage + "\"><img src=\"images/downloadicon.png\" style=\"margin-left:5px; width:18px; height:18px; vertical-align:middle\"></a>");

});

$(".stats5").each(function() {
  var projectType = $(this).attr("projectType");

  View.prototype.i18n["en"] = {};
  View.prototype.retrieveLocale("en",projectType);

  View.prototype.i18n[currentLanguage] = {};
  View.prototype.retrieveLocale(currentLanguage,projectType);
  // get actual number of completions. Check if value is actually set
  var defaultLanguageKeys = Object.keys(View.prototype.i18n["en"]);
  var numTotal = defaultLanguageKeys.length;  
  var numCompleted = 0;

  // this is a non-portal project, which uses JSON file format
  for (var i = 0; i < defaultLanguageKeys.length; i++) {
    var defaultLanguageKey = defaultLanguageKeys[i];
    // make sure that there is an actual translated value in the current language
    if (typeof View.prototype.i18n[currentLanguage][defaultLanguageKey] != "undefined" &&
        typeof View.prototype.i18n[currentLanguage][defaultLanguageKey] != "undefined" &&
         View.prototype.i18n[currentLanguage][defaultLanguageKey].trim() != "") {
 	  numCompleted++;							     
    }
  }

  if (numCompleted < numTotal) {
    $(this).parent("a").css("background-color","yellow");
  } else if (numCompleted > numTotal) {
    // for some reason numCompleted > numTotal, show as completed so it won't confuse the translator.
    numCompleted = numTotal;
  }

  $(this).append(" ["+ numCompleted + "/" + numTotal + "]");

  // Also show a button to download the translation file
  $(this).append(" <a href=\"download.php?projectType=" + projectType + "&locale=" + currentLanguage + "\"><img src=\"images/downloadicon.png\" style=\"margin-left:5px; width:18px; height:18px; vertical-align:middle\"></a>");

});

});
</script>
</head>
<body>
<span style="float:right; margin-right:10px"><a href="logout.php">Logout</a></span>
<h1>Welcome to the WISE Translation Project! (English-><span id='userLocale'></span>)</h1>
<ul>
<li>Items that need translation will be highlighted in yellow.</li>
<li>We recommend that you translate in this order: WISE5 (Common->VLE->Classroom Monitor->Authoring Tool) -> WISE4 (VLE->Themes->Steps->Portal)</li>
<li>If you need help, please check out and post to the <a href="https://wise-discuss.berkeley.edu/t/wise-in-other-languages" target=_blank>WISE-Translation Discussion Forum</a> or email WISE staff (telsportal at gmail dot com).</li>
</ul>
<h1>WISE5</h1>
<!--
<h3>Translate WISE5 by following the steps on this page: <a href="https://github.com/WISE-Community/WISE/wiki/Translating-WISE#translate-wise5">https://github.com/WISE-Community/WISE/wiki/Translating-WISE#translate-wise5</a></h3>
-->

<h3><a href="translate.php?projectType=common5">Translate common elements <span class='stats5' projectType='common5'></span></a></h3>
<h3><a href="translate.php?projectType=vle5">Translate the Virtual Learning Environment (VLE) <span class='stats5' projectType='vle5'></span></a></h3>
<h3><a href="translate.php?projectType=authoringTool5">Translate the Authoring Tool <span class='stats5' projectType='authoringTool5'></span></a></h3>
<h3><a href="translate.php?projectType=classroomMonitor5">Translate the Classroom Monitor <span class='stats5' projectType='classroomMonitor5'></span></a></h3>

<h1>WISE4</h1>
<h3><a href="translate.php?projectType=vle">Translate the Virtual Learning Environment (VLE) <span class='stats' projectType='vle'></span></a></h3>
<p>The VLE includes the Student VLE, Authoring Tool, Grading Tool, and Researcher Tool.</p>

<h2>Translate Themes</h2>
<div id="themeDiv" style="margin-left:50px">
	<h3><a href="translate.php?projectType=themewise">WISE Default Theme<span class='stats' projectType='themewise'></span></a></h3>
	<p>WISE default theme</p>	

	<h3><a href="translate.php?projectType=themestarmap">Starmap Theme<span class='stats' projectType='themestarmap'></span></a></h3>
	<p>Starmap theme</p>	

</div>

<h2>Translate Steps</h2>
<div id="stepDiv" style="margin-left:50px">
<h3><a href="translate.php?projectType=assessmentlist">Assessment List (Questionnaire) <span class='stats' projectType='assessmentlist'></span></a></h3>
<p>Students answer a collection of questions that require text or multiple choice answers</p>

<h3><a href="translate.php?projectType=brainstorm">Brainstorm <span class='stats' projectType='brainstorm'></span></a></h3>
<p>Students post their answer for everyone in the class to read and discuss</p>

<h3><a href="translate.php?projectType=branching">Branching <span class='stats' projectType='branching'></span></a></h3>
<p>Students go down different branches/paths in the project based on various criteria</p>

<h3><a href="translate.php?projectType=draw">Draw Step <span class='stats' projectType='draw'></span></a></h3>
<p>	Students draw using basic drawing tools, take snapshots and create flipbook animations</p>

<h3><a href="translate.php?projectType=explanationbuilder">Explanation Builder <span class='stats' projectType='explanationbuilder'></span></a></h3>
<p>Students use ideas from their Idea Basket to generate a response</p>

<h3><a href="translate.php?projectType=fillin">Fill In <span class='stats' projectType='fillin'></span></a></h3>
<p>Students fill in the missing text blanks in a body of text</p>

<h3><a href="translate.php?projectType=flash">Flash <span class='stats' projectType='flash'></span></a></h3>
<p>Embed Flash content in a WISE step.</p>

<h3><a href="translate.php?projectType=grapher">Grapher <span class='stats' projectType='grapher'></span></a></h3>
<p>This is a lightweight version of the grapher step that allows graphing of multiple series, and connects to the cargraph step.</p>

<h3><a href="translate.php?projectType=matchsequence">Match & Sequence <span class='stats' projectType='matchsequence'></span></a></h3>
<p>Students drag and drop choices into boxes</p>

<h3><a href="translate.php?projectType=mw">Molecular Workbench <span class='stats' projectType='mw'></span></a></h3>
<p>Students work on a Molecular Workbench applet</p>

<h3><a href="translate.php?projectType=multiplechoice">Multiple Choice <span class='stats' projectType='multiplechoice'></span></a></h3>
<p>Students answer a multiple choice question</p>

<h3><a href="translate.php?projectType=netlogo">NetLogo <span class='stats' projectType='netlogo'></span></a></h3>
<p>Students work on a NetLogo activity</p>

<h3><a href="translate.php?projectType=openresponse">Open Response <span class='stats' projectType='openresponse'></span></a></h3>
<p>Students write text to answer a question or explain their thoughts</p>

<h3><a href="translate.php?projectType=sensor">Sensor <span class='stats' projectType='sensor'></span></a></h3>
<p>Students plot points on a graph and can use a USB probe to collect data</p>

<h3><a href="translate.php?projectType=table">Table <span class='stats' projectType='table'></span></a></h3>
<p>Students fill out a table</p>
</div>

<h3><a href="translate.php?projectType=portal">Translate the Portal <span class='stats' projectType='portal'></span></a></h3>
<p>The WISE Portal is the user and classroom management system. This includes user registration and project and run management.</p>


</body>
</html>
