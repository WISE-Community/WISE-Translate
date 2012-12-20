//"en_US"=english (US), "ja"=japanese, "zh_TW"=traditional chinese, "ko"=korean
View.prototype.i18n.supportedLocales = [
                                        "en_US","zh_TW","zh_CN","nl","he","it","ja","ko"
                                        ];

// returns the string representation of what should be saved in the translation file
// for VLE, this is a JSONString. for Portal, this would be a properties string
function getTranslationString(obj) {
    return FormatJSON(obj);
}

// build and show the translation table for the currentLanguage
function buildTable() {
	var translationTable = 
	"<p><b>Remember to save your work before closing this window by clicking on the \"Save\" button.</b></p><div style='display:block; margin:10px 0px'><input id='onlyShowMissingTranslationInput' onClick='onlyShowMissingTranslation()' type='checkbox'></input>Only Show Missing Translations <span id='numMissingTranslations'></span>&nbsp;&nbsp;&nbsp;" +
	"<input id='saveButton' type='button' onClick='save()' value='Save'></input><span id='loadingGif' style='display:none'><img src='../common/wait30.gif'></img></div>" +
	"<table border='1'>";

	// build the header row
	translationTable += "<tr><th>key</th><th>description</th><th>"+View.prototype.i18n.defaultLocale+"</th>";
	translationTable += "<th>"+currentLanguage+"</th>";
	translationTable += "</tr>\n\n";

	// build the rest of the table
	if (currentLanguage != "") {        
		for (key in View.prototype.i18n[View.prototype.i18n.defaultLocale]) {
			var obj = View.prototype.i18n[View.prototype.i18n.defaultLocale][key];
			translationTable += "<tr class='translationRow'>\n<td>"+key+"</td>\n<td>"+obj.description+"</td>\n<td>"+obj.value+"</td>\n";
			if (View.prototype.i18n[currentLanguage][key]) {
				translationTable += "<td><textarea style='height:100%;width:100%' id='"+key+"'>"+View.prototype.i18n[currentLanguage][key].value+"</textarea></td>\n";
			} else {
				translationTable += "<td><textarea style='height:100%;width:100%' id='"+key+"'></textarea></td>\n";
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
View.prototype.retrieveLocale = function(locale) {
	var localePath = "bundle/i18n_" + locale + ".json";
	$.ajax({"url":localePath,
		    async:false,
		    dataType:"json",
		    success:function(obj){ console.log('retrieved:' + locale);
				View.prototype.i18n[locale] = obj;
			},
			error:function(){}
	});	
};

