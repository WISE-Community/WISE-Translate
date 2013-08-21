<?php 
session_start(); 
if (!isset($_SESSION["username"]) || !isset($_SESSION["userEmail"])) {
  header("Location: login.php");
}
?>
<html>
<head>
<title><?= "Welcome ".$_SESSION["username"]; ?></title>
<style type="text/css">
h1,h2,h3 { padding: 0; margin: 20 0 0 10; }
p {margin: 2 0 0 10;}
</style>
</head>
<body>
<h1>Welcome to the WISE4 Translation Project!</h1>
<p>If you need help, contact WISE staff (telsportal at gmail dot com)</p>

<h3><a href="portal">Translate the Portal</a></h3>
<p>The WISE Portal is the user and classroom management system. This includes user registration and project and run management.</p>

<h3><a href="vle">Translate the Virtual Learning Environment (VLE)</a></h3>
<p>The VLE includes the Student VLE, Authoring Tool, Grading Tool, and Researcher Tool.</p>

<h2>Translate Steps</h2>
<div id="stepDiv" style="margin-left:50px">
<h3><a href="assessmentlist">Assessment List (Questionnaire)</a></h3>
<p>Students answer a collection of questions that require text or multiple choice answers</p>

<h3><a href="brainstorm">Brainstorm</a></h3>
<p>tudents post their answer for everyone in the class to read and discuss</p>

<h3><a href="explanationbuilder">Explanation Builder</a></h3>
<p>Students use ideas from their Idea Basket to generate a response</p>

<h3><a href="fillin">Fill In</a></h3>
<p>Students fill in the missing text blanks in a body of text</p>

<h3><a href="flash">Flash</a></h3>
<p>Embed Flash content in a WISE step.</p>

<h3><a href="grapher">Grapher</a></h3>
<p>This is a lightweight version of the grapher step that allows graphing of multiple series, and connects to the cargraph step.</p>

<h3><a href="matchsequence">Match & Sequence</a></h3>
<p>Students drag and drop choices into boxes</p>

<h3><a href="mw">Molecular Workbench</a></h3>
<p>Students work on a Molecular Workbench applet</p>

<h3><a href="multiplechoice">Multiple Choice</a></h3>
<p>Students answer a multiple choice question</p>

<h3><a href="netlogo">NetLogo</a></h3>
<p>Students work on a NetLogo activity</p>

<h3><a href="openresponse">Open Response</a></h3>
<p>Students write text to answer a question or explain their thoughts</p>

<h3><a href="sensor">Sensor</a></h3>
<p>Students plot points on a graph and can use a USB probe to collect data</p>

<h3><a href="table">Table</a></h3>
<p>Students fill out a table</p>
</div>


</body>
</html>
