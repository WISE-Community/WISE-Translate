
// returns the string representation of what should be saved in the translation file
// for VLE and step types, this is a JSONString. for Portal, this would be a properties string
function getTranslationString_JSON(obj) {
	for (key in obj) {
	    obj[key].description = addSlashes(obj[key].description);
	    obj[key].value = addSlashes(obj[key].value);
        }
        return FormatJSON(obj);
}

// build and show the translation table for the currentLanguage
function buildTable5() {
	var translationTable = 
	"<div id='dumpDiv' style='display:none'>"+
	"<b>Please copy and save the following into a file for backup.</b><br/><br/>You can close this window and keep working, or if you are done,<br/><button onclick='notifyComplete(\""+projectType+"\")'>Click here to notify the WISE Staff.</button>"+
	"<textarea rows='50' cols='150' id='dumpTextarea'></textarea>"+
	"</div>"+
	"<p><b>Remember to save your work before closing this window by clicking on the \"Save\" button.</b></p><div style='display:block; margin:10px 0px'><input id='onlyShowMissingTranslationInput' onClick='onlyShowMissingTranslation()' type='checkbox'></input>Only Show Missing Translations <span id='numMissingTranslations'></span>&nbsp;&nbsp;&nbsp;" +
	"<input id='saveButton' type='button' onClick='save(\""+projectType+"\")' value='Save'></input><span id='loadingGif' style='display:none'><img src='common/wait30.gif'></img></div>" +
	"<table border='1' id='translationTable'>";

	// build the header row
	translationTable += "<tr><th class='cell_key'>key</th><th>"+View.prototype.i18n.defaultLocale+"</th>";
	translationTable += "<th class='cell_currentLanguage'>"+currentLanguage+"</th>";
	translationTable += "</tr>\n\n";

	// build the rest of the table
	if (currentLanguage != "") {        
		for (key in View.prototype.i18n[View.prototype.i18n.defaultLocale]) {
			var value = View.prototype.i18n[View.prototype.i18n.defaultLocale][key];
			translationTable += "<tr class='translationRow'>\n<td class='cell_key'>"+key+"</td>\n<td>"+value+"</td>\n";
			if (View.prototype.i18n[currentLanguage][key]) {
				translationTable += "<td class='cell_currentLanguage'><textarea style='height:100%;width:100%' id='"+key+"'>"+View.prototype.i18n[currentLanguage][key]+"</textarea></td>\n";
			} else {
				translationTable += "<td class='cell_currentLanguage'><textarea style='height:100%;width:100%' id='"+key+"'></textarea></td>\n";
			}
			translationTable += "</tr>\n\n";                      
		}
	}
	translationTable += "</table>";
	$("#translationTableDiv").html(translationTable);

	$("textarea").change(function() {
		// user changed a value in the textarea
		var key = this.id;
		var value = $(this).val();
		if (!View.prototype.i18n[currentLanguage][key]) {
			View.prototype.i18n[currentLanguage][key] = {};
		}
		View.prototype.i18n[currentLanguage][key].value = value;
		View.prototype.i18n[currentLanguage][key].description = View.prototype.i18n[View.prototype.i18n.defaultLocale][key].description;
		isDirty=true;  // mark document as changed
		updateMissingTranslationsCount();
	});

	// show number of missing translations
	updateMissingTranslationsCount();
}

// build and show the translation table for the currentLanguage
function buildTable_JSON() {
	var translationTable = 
	"<div id='dumpDiv' style='display:none'>"+
	"<b>Please copy and save the following into a file for backup.</b><br/><br/>You can close this window and keep working, or if you are done,<br/><button onclick='notifyComplete(\""+projectType+"\")'>Click here to notify the WISE Staff.</button>"+
	"<textarea rows='50' cols='150' id='dumpTextarea'></textarea>"+
	"</div>"+
	"<p><b>Remember to save your work before closing this window by clicking on the \"Save\" button.</b></p><div style='display:block; margin:10px 0px'><input id='onlyShowMissingTranslationInput' onClick='onlyShowMissingTranslation()' type='checkbox'></input>Only Show Missing Translations <span id='numMissingTranslations'></span>&nbsp;&nbsp;&nbsp;" +
	"<input id='saveButton' type='button' onClick='save(\""+projectType+"\")' value='Save'></input><span id='loadingGif' style='display:none'><img src='common/wait30.gif'></img></div>" +
	"<table border='1' id='translationTable'>";

	// build the header row
	translationTable += "<tr><th class='cell_key'>key</th><th>description</th><th>"+View.prototype.i18n.defaultLocale+"</th>";
	translationTable += "<th class='cell_currentLanguage'>"+currentLanguage+"</th>";
	translationTable += "</tr>\n\n";

	// build the rest of the table
	if (currentLanguage != "") {        
		for (key in View.prototype.i18n[View.prototype.i18n.defaultLocale]) {
			var obj = View.prototype.i18n[View.prototype.i18n.defaultLocale][key];
			translationTable += "<tr class='translationRow'>\n<td class='cell_key'>"+key+"</td>\n<td>"+obj.description+"</td>\n<td>"+obj.value+"</td>\n";
			if (View.prototype.i18n[currentLanguage][key]) {
				translationTable += "<td class='cell_currentLanguage'><textarea style='height:100%;width:100%' id='"+key+"'>"+View.prototype.i18n[currentLanguage][key].value+"</textarea></td>\n";
			} else {
				translationTable += "<td class='cell_currentLanguage'><textarea style='height:100%;width:100%' id='"+key+"'></textarea></td>\n";
			}
			translationTable += "</tr>\n\n";                      
		}
	}
	translationTable += "</table>";
	$("#translationTableDiv").html(translationTable);

	$("textarea").change(function() {
		// user changed a value in the textarea
		var key = this.id;
		var value = $(this).val();
		if (!View.prototype.i18n[currentLanguage][key]) {
			View.prototype.i18n[currentLanguage][key] = {};
		}
		View.prototype.i18n[currentLanguage][key].value = value;
		View.prototype.i18n[currentLanguage][key].description = View.prototype.i18n[View.prototype.i18n.defaultLocale][key].description;
		isDirty=true;  // mark document as changed
		updateMissingTranslationsCount();
	});

	// show number of missing translations
	updateMissingTranslationsCount();
}

/**
 * Synchronously retrieves specified locale json mapping file
 */
View.prototype.retrieveLocale_JSON = function(locale,projectType) {
	var localePath = projectType + "/i18n/i18n_" + locale + ".json";
        if (projectType === "common5") {
          localePath = "wise5/common/i18n_" + locale + ".json";
        } else if (projectType === "vle5") {
          localePath = "wise5/vle/i18n_" + locale + ".json"; 
        } else if (projectType === "authoringTool5") {
          localePath = "wise5/authoringTool/i18n_" + locale + ".json";
        } else if (projectType === "classroomMonitor5") {
          localePath = "wise5/classroomMonitor/i18n_" + locale + ".json";
        }
	$.ajax({"url":localePath,
		    async:false,
		    dataType:"json",
		    success:function(obj){ console.log('retrieved:' + locale);
				View.prototype.i18n[locale] = obj;
			},
			error:function(){ console.log('error retrieving:' + locale); }
	});	
};


/*

$(document).ready(function() {  
	// add supported locales to selectable drop-down list
	for (var i=0; i<View.prototype.i18n.supportedLocales.length; i++) { 
		var supportedLocale = View.prototype.i18n.supportedLocales[i];
		if (supportedLocale != "en_US") {
			$("#currentLanguageSelect").append("<option id='"+supportedLocale+"' value='"+supportedLocale+"'>"+localeToHumanReadableLanguage(supportedLocale)+" ("+supportedLocale+") "+"</option");
		}
	}

	// print default and supported locales
	$("#defaultLocale").append(View.prototype.i18n.defaultLocale + " (" + localeToHumanReadableLanguage(View.prototype.i18n.defaultLocale) + ")");
	// fetch translation files for all supported locales and set them to View.prototype.i18n[locale] array
	for (var i=0; i < View.prototype.i18n.supportedLocales.length; i++) {
		var locale = View.prototype.i18n.supportedLocales[i];
		View.prototype.i18n[locale] = {};
		View.prototype.retrieveLocale(locale);
	};

	$("#currentLanguageSelect").change(function() {
		// user changed currentLanguage, so we need to build and display the table
		currentLanguage = $(this).find(":selected").val()
		buildTable();
	});

	$("#heading").append(" ").append(projectType);
});
*/