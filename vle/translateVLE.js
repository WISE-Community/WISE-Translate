     var currentLanguage = "";  // language that is currently being translated
     var isDirty = false;       // has user made any changes that need to be saved?

     // given locale (e.g. "ja"), returns language (e.g. "Japanese")
     function localeToLanguage(locale) {
       if (locale == "zh_TW") {
         return "Chinese - Traditional";
       } else if (locale == "zh_CN") {
         return "Chinese - Simplified";
       } else if (locale == "nl") {
         return "Dutch";
       } else if (locale == "he") {
         return "Hebrew";
       } else if (locale == "it") {
         return "Italian";
       } else if (locale == "ja") {
         return "Japanese";
       } else if (locale == "ko") {
         return "Korean";
       } 
     }
 
     // opens up the translated json file in a new window
     function save() {
         isDirty = false;  // assume that user does the right thing and saves changes.
         $("#saveButton").attr("disabled","disabled");   // disable multiple saving
         $("#loadingGif").show();   // show the spinning wheel.
         var translationFormattedJSONString = FormatJSON(View.prototype.i18n[currentLanguage]);
         $.ajax({
           url:"post.php",
           type:"POST",
           data:{locale:currentLanguage,jsonStr:translationFormattedJSONString},
           success:function(data, textStatus, jq) {
             if (data != "FAIL") {
               alert('Work successfully saved');
               $("#saveButton").removeAttr("disabled");
               $("#loadingGif").hide();   // hide the spinning wheel.
             } else {
               alert('Error saving data. Please stop further work and contact the administrator.');
             }
           },
           error:function() {alert('Error saving data. Please stop further work and contact the administrator.');}
         });
     }

     // show/hide rows that have already been translated
     function onlyShowMissingTranslation() {
       if($("#onlyShowMissingTranslationInput:checked").length == 1) {
         $("tr textarea").each(function() {if ($(this).val() != "") { $(this).parents(".translationRow").hide()}});
       } else {
         $("tr textarea").each(function() {if ($(this).val() != "") { $(this).parents(".translationRow").show()}});
       }
     }

     // build and show the translation table for the currentLanguage
     function buildTable() {
         var translationTable = 
	"<p><b>Remember to save your work before closing this window by clicking on the \"Save\" button.</b></p><div style='display:block; margin:10px 0px'><input id='onlyShowMissingTranslationInput' onClick='onlyShowMissingTranslation()' type='checkbox'></input>Only Show Missing Translations&nbsp;&nbsp;&nbsp;" +
	"<input id='saveButton' type='button' onClick='save()' value='Save'></input><span id='loadingGif' style='display:none'><img src='../wait30.gif'></img></div>" +
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
         });
     }

     $(document).ready(function() {  
         // add supported locales to selectable drop-down list
         for (var i=0; i<View.prototype.i18n.supportedLocales.length; i++) { 
           var supportedLocale = View.prototype.i18n.supportedLocales[i];
           if (supportedLocale != "en_US") {
             $("#currentLanguageSelect").append("<option id='"+supportedLocale+"' value='"+supportedLocale+"'>"+localeToLanguage(supportedLocale)+" ("+supportedLocale+") "+"</option");
           }
         }

         // print default and supported locales
         $("#defaultLocale").append(View.prototype.i18n.defaultLocale);
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
      }); 

      window.onbeforeunload = function() {
          // before user navigates away from the page or refreshes it, check to see if user needs to save changes or not
          if (isDirty) {
             // this will ensure that the user sees an "Are you sure? Unsaved things will be deleted" message
             return false;
          }
      }