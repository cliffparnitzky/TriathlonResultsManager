var competitionTemplates = new Array(
"SD (0,5 km - 20 km - 5 km)",
"OD (1,5 km - 40 km - 10 km)",
"MD (2 km - 80 km - 20 km)",
"IM 70.3 (1,9 km - 90 km - 21,1 km)",
"MD (1,9 km - 90 km - 21,1 km)",
"IM (3,8 km - 180 km - 42,2 km)",
"LD (3,8 km - 180 km - 42,2 km)",
"Halbmarathon",
"Marathon",
"24-Stunden-Schwimmen");


var actCompetitionId = 0;
var errorCount = 0;

function getXMLRow(row) {
	return row + '\n';
}

function getXML() {

	var competitions = getCompetitions();
	if (competitions == null || competitions.length < 1) {
		return "";
	}

	var resultXML = '';

	resultXML += getXMLRow('	<paragraph>');
	resultXML += getXMLRow('		<title>' + parseFieldValue(document.getElementById("dateDay"), true) + '.' + parseFieldValue(document.getElementById("dateMonth"), true) + '.' + parseFieldValue(document.getElementById("dateYear"), true) + ' : ' + parseTextFieldValue(document.getElementById("eventName")) + '</title>');
	resultXML += getXMLRow('		<text><![CDATA[');
	resultXML += competitions;
	resultXML += getXMLRow('		]]></text>');
	resultXML += getXMLRow('	</paragraph>');

	return resultXML;
}

function generateHTML() {
	errorCount = 0;
	document.getElementById("resultHTML").innerHTML = getCompetitions();
}

function reportResults()
{
	errorCount = 0;
	var xml = getXML();

	if (errorCount > 0) {
		showErrorMsg();
	}
	else if (xml != null && xml.length > 0)
	{
		if (document.getElementById("sendDialog") == null) {
			handleOverlay(true);

			var dialog = document.createElement("div");
			dialog.id = "sendDialog";
			dialog.style.width = "380px";
			dialog.style.height = "400px";
			dialog.style.left = "50%";
			dialog.style.marginLeft = "-150px";
			dialog.style.position = "fixed";
			dialog.style.top = "150px";
			dialog.style.zIndex = "10000";
			dialog.style.border = "2px solid #afafaf";
			dialog.style.background = "#ffffff";
			dialog.style.padding = "5px";

			var headline = document.createElement("div");
			headline.style.fontSize = "12px";
			headline.style.fontWeight = "bold";
			headline.appendChild(document.createTextNode("Ergebnisse melden"));
			dialog.appendChild(headline);

			var input = document.createElement("div");
			input.style.height = "340px";
			input.style.marginTop = "10px";
			input.style.marginBottom = "10px";

			{
				var userLabel = document.createElement("div");
				userLabel.style.fontStyle = "italic";
				userLabel.innerHTML = "Name<span class=\"mandatory\" title=\"Pflichtfeld: Bitte einen Eintrag aus der Liste ausw�hlen.\">*</span>";
				input.appendChild(userLabel);

				var allUser = women.slice();
				allUser.reverse();
				allUser.pop();
				allUser = allUser.concat(men);
				allUser.sort();

				var userSelect = document.createElement("select");
				userSelect.id = "userSelect";
				for (var i = 0; i < allUser.length; i++) {
					var userOption = document.createElement("option");
					userOption.value = allUser[i];
					userOption.appendChild(document.createTextNode(allUser[i]));
					userSelect.appendChild(userOption);
				}
				input.appendChild(userSelect);

				var eventTypeLabel = document.createElement("div");
				eventTypeLabel.style.fontStyle = "italic";
				eventTypeLabel.style.paddingTop = "10px";
				eventTypeLabel.innerHTML = "Veranstaltungsart<span class=\"mandatory\" title=\"Pflichtfeld: Bitte einen Eintrag aus der Liste ausw�hlen.\">*</span>";
				input.appendChild(eventTypeLabel);

				var eventTypeSelect = document.createElement("select");
				eventTypeSelect.id = "eventTypeSelect";
				/*
				// Select Box for Women
				var eventTypes = new Array("",
				"Schwimm-Event",
				"Radfahr-Event",
				"Lauf-Event",
				"Duathlon",
				"Triathlon",
				"Sonstiges");
				for (var i = 0; i < eventTypes.length; i++) {
					var eventTypeOption = document.createElement("option");
					eventTypeOption.value = eventTypes[i];
					eventTypeOption.appendChild(document.createTextNode(eventTypes[i]));
					eventTypeSelect.appendChild(eventTypeOption);
				}*/
				input.appendChild(eventTypeSelect);

				var commentLabel = document.createElement("div");
				commentLabel.style.fontStyle = "italic";
				commentLabel.style.paddingTop = "10px";
				commentLabel.appendChild(document.createTextNode("Kommentar"));
				input.appendChild(commentLabel);

				var commentTextarea = document.createElement("textarea");
				commentTextarea.id = "commentTextarea";
				commentTextarea.style.width = "380px";
				commentTextarea.style.maxWidth = "380px";
				commentTextarea.style.minWidth = "380px";
				commentTextarea.style.height = "100px";
				commentTextarea.style.maxHeight = "100px";
				commentTextarea.style.minHeight = "100px";
				input.appendChild(commentTextarea);

				var completenessLabelGeneral = document.createElement("div");
				completenessLabelGeneral.setAttribute("class", "completeness");
				{
					var completenessCheckboxGeneral = document.createElement("input");
					completenessCheckboxGeneral.type = "checkbox";
					completenessCheckboxGeneral.id = "completenessCheckboxGeneral";
					completenessCheckboxGeneral.setAttribute("class", "completeness");
					completenessLabelGeneral.appendChild(completenessCheckboxGeneral);

					var completenessTextGeneral = document.createElement("label");
					completenessTextGeneral.setAttribute("for", "completenessCheckboxGeneral");
					completenessTextGeneral.setAttribute("class", "completeness");
					completenessTextGeneral.innerHTML = "Ja, die Ergebnismeldung ist vollst�ndig.<span class=\"mandatory\" title=\"Pflichtfeld: Bitte best�tigen.\">*</span>";
					completenessLabelGeneral.appendChild(completenessTextGeneral);
				}
				input.appendChild(completenessLabelGeneral);

				var completenessLabelCompetitions = document.createElement("div");
				completenessLabelCompetitions.setAttribute("class", "completeness");
				{
					var completenessCheckboxCompetitions = document.createElement("input");
					completenessCheckboxCompetitions.type = "checkbox";
					completenessCheckboxCompetitions.id = "completenessCheckboxCompetitions";
					completenessCheckboxCompetitions.setAttribute("class", "completeness");
					completenessLabelCompetitions.appendChild(completenessCheckboxCompetitions);

					var completenessTextCompetitions = document.createElement("label");
					completenessTextCompetitions.setAttribute("for", "completenessCheckboxCompetitions");
					completenessTextCompetitions.setAttribute("class", "completeness");
					completenessTextCompetitions.innerHTML = "Ja, ich habe <b><u>alle Wettbewerbe</u></b>, die stattgefunden haben, eingetragen.<span class=\"mandatory\" title=\"Pflichtfeld: Bitte best�tigen.\">*</span>";
					completenessLabelCompetitions.appendChild(completenessTextCompetitions);
				}
				input.appendChild(completenessLabelCompetitions);

				var completenessLabelMembers = document.createElement("div");
				completenessLabelMembers.setAttribute("class", "completeness");
				{
					var completenessCheckboxMembers = document.createElement("input");
					completenessCheckboxMembers.type = "checkbox";
					completenessCheckboxMembers.id = "completenessCheckboxMembers";
					completenessCheckboxMembers.setAttribute("class", "completeness");
					completenessLabelMembers.appendChild(completenessCheckboxMembers);

					var completenessTextMembers = document.createElement("label");
					completenessTextMembers.setAttribute("for", "completenessCheckboxMembers");
					completenessTextMembers.setAttribute("class", "completeness");
					completenessTextMembers.innerHTML = "Ja, ich habe <b><u>alle Vereinsmitglieder</u></b>, die teilgenommen haben, eingetragen.<span class=\"mandatory\" title=\"Pflichtfeld: Bitte best�tigen.\">*</span>";
					completenessLabelMembers.appendChild(completenessTextMembers);
				}
				input.appendChild(completenessLabelMembers);

				var infoMandatory = document.createElement("div");
				infoMandatory.setAttribute("class", "info");
				infoMandatory.innerHTML = "<span class=\"mandatory\">*</span> mit einem roten Stern gekennzeichnete Felder sind Pflichtfelder";
				input.appendChild(infoMandatory);

			}

			dialog.appendChild(input);

			var buttons = document.createElement("div");
			buttons.style.width = "100%";
			buttons.style.textAlign = "center";

			{
				var buttonAbort = document.createElement("input");
				buttonAbort.className = "actionBtn";
				buttonAbort.type = "button";
				buttonAbort.value = "Abbrechen";
				buttonAbort.onclick = function () {document.getElementById("body").removeChild(document.getElementById("sendDialog")); handleOverlay(false);};
				buttons.appendChild(buttonAbort);

				buttons.appendChild(document.createTextNode(" "));

				var buttonSend = document.createElement("input");
				buttonSend.className = "actionBtn";
				buttonSend.type = "button";
				buttonSend.value = "Senden";
				buttonSend.onclick = function () {sendResults(xml);};
				buttons.appendChild(buttonSend);
			}

			dialog.appendChild(buttons);

			document.getElementById("body").appendChild(dialog);

			document.getElementById("userSelect").focus();
		}
	}
}

function handleOverlay(show) {
	var dialog = document.getElementById("overlay");
	if (show) {
		dialog.style.display = "block";
	} else {
		dialog.style.display = "none";
	}
}


function sendResults(xml) {
	if (document.getElementById("userSelect").selectedIndex > 0 &&
		document.getElementById("eventTypeSelect").selectedIndex > 0 &&
		document.getElementById("completenessCheckboxGeneral").checked &&
		document.getElementById("completenessCheckboxCompetitions").checked &&
		document.getElementById("completenessCheckboxMembers").checked) {

		var user = document.getElementById("userSelect").options[document.getElementById("userSelect").selectedIndex].value;
		var eventName = document.getElementById("eventName").value;
		var eventType = document.getElementById("eventTypeSelect").options[document.getElementById("eventTypeSelect").selectedIndex].value;
		var comment = commentTextarea.value;

		var params = new Array();
		params.push(["1_Name", user]);
		params.push(["2_Wettkampfname", eventName]);
		params.push(["3_Veranstaltungsart", eventType]);
		params.push(["4_Kommentar", "\n\n" + comment + "\n"]);
		params.push(["5_XML", "\n\n" + xml]);

		doAjaxRequest("php/formmailer.php", params, function handleAjax(){resultsSendHandler()});

		document.getElementById("body").removeChild(document.getElementById("sendDialog"));
		handleOverlay(false);
	}
	else {
		alert("Bitte w�hle deinen Namen sowie die Veranstaltungsart aus und best�tige die Vollst�ndigkeit der Ergebnismeldung.");
		document.getElementById("userSelect").focus();
	}
}

function showErrorMsg() {
	if (errorCount > 0) {
		alert("Es wurden " + errorCount + " fehlende oder fehlerhafte Eingaben gefunden.\nBitte korrigieren bzw. erg�nzen Sie diese Felder!");
	}
}

function getCompetitions() {
	var result = '';

	if (document.getElementById("competitions").getElementsByTagName("table").length < 1) {
		alert("Es sind keine Wettbewerbe angelegt. Bitte korrigiere deine Eingaben.");
		errorCount = 0;
		return "";
	}

	for (var a = 0; a < document.getElementById("competitions").getElementsByTagName("table").length; a++) {
		var actId = document.getElementById("competitions").getElementsByTagName("table")[a].id;

		if (a > 0) {
			result += getXMLRow('		<br/><br/>');
		}

		result += getXMLRow('		<table class="resultTable" border="0" cellpadding="5" cellspacing="0" width="100%">');
		result += getXMLRow('			<thead>');
		result += getXMLRow('				<tr style="font-size: 1.1em; text-align: center;">');
		result += getXMLRow('					<td colspan="5" style="border-bottom: 1px solid #000000;">' + parseTextFieldValue(document.getElementById("competition_" + actId + "_title")) + '</td>');
		result += getXMLRow('				</tr>');
		result += getXMLRow('				<tr>');
		result += getXMLRow('					<td style="border-bottom: 1px solid #000000;">' + translations['tableHeadStarters'] + '</td>');
		result += getXMLRow('					<td style="border-bottom: 1px solid #000000;" width="20%">' + translations['tableHeadTime'] + '</td>');

		if (document.getElementById("competition_" + actId + "_placingAgeGroup").checked) {
			result += getXMLRow('					<td style="border-bottom: 1px solid #000000;" width="20%">' + translations['tableHeadOverallPlace'] + '</td>');
			result += getXMLRow('					<td style="border-bottom: 1px solid #000000;" width="20%">' + translations['tableHeadAgeGroupPlace'] + '</td>');
		} else {
			result += getXMLRow('					<td style="border-bottom: 1px solid #000000;" width="40%">' + translations['tableHeadOverallPlace'] + '</td>');

		}

		result += getXMLRow('				</tr>');
		result += getXMLRow('			</thead>');
		result += getXMLRow('			<tbody>');

		var actNode = document.getElementById("competition_" + actId + "_tbody").firstChild.nextSibling;
		var womenFinished = false;
		var womanAdded = false;
		var manAdded = false;
		while (actNode != null) {
			if (actNode.nodeType == 1) {
				if (actNode.id == "competition_" + actId + "_tr_men") {
					womenFinished = true;
				} else if (actNode.getElementsByTagName("select")[0].selectedIndex > 0) {
					if (!womenFinished) {
						if(!womanAdded && actNode.getElementsByTagName("select")[0].selectedIndex  > 0) {
							result += getXMLRow('				<tr>');
							result += getXMLRow('					<td colspan="5" style="font-style: italic;">' + translations['headerWomen'] + '</a></td>');
							result += getXMLRow('				</tr>');
							womanAdded = true;
						}
					}
					else {
						if(!manAdded && actNode.getElementsByTagName("select")[0].selectedIndex  > 0) {
							result += getXMLRow('				<tr>');
							result += getXMLRow('					<td colspan="5" style="font-style: italic;">' + translations['headerMen'] + '</a></td>');
							result += getXMLRow('				</tr>');
							manAdded = true;
						}

					}

					var timeHours = parseFieldValue(actNode.getElementsByTagName("input")[0], true);
					var timeMinutes = parseFieldValue(actNode.getElementsByTagName("input")[1], true);
					var timeSeconds = parseFieldValue(actNode.getElementsByTagName("input")[2], true);

					// add member
					result += getXMLRow('				<tr>');
					result += getXMLRow('					<td class="member">' + actNode.getElementsByTagName("select")[0].options[actNode.getElementsByTagName("select")[0].selectedIndex].text + '</td>');
					if ((parseInt(timeHours, 10) + parseInt(timeMinutes, 10) + parseInt(timeSeconds, 10)) == 0) {
						result += getXMLRow('					<td colspan="4">DNF (Did not finish)</td>');
					}
					else {
						var placingOverall = parseFieldValue(actNode.getElementsByTagName("input")[3], false);
						var placingOverallTotal = parseFieldValue(actNode.getElementsByTagName("input")[4], false);
						var medalOverall = getMedalString(placingOverall, true);

						result += getXMLRow('					<td>' + timeHours + ':' + timeMinutes + ':' + timeSeconds + ' h</td>');
						result += getXMLRow('					<td>' + placingOverall + './' + placingOverallTotal + medalOverall + '</td>');
						if (document.getElementById("competition_" + actId + "_placingAgeGroup").checked) {
							var placingAgeGroup = parseFieldValue(actNode.getElementsByTagName("input")[5], false);
							var placingAgeGroupTotal = parseFieldValue(actNode.getElementsByTagName("input")[6], false);
							var medalAgeGroup = getMedalString(placingAgeGroup, false);
							result += getXMLRow('					<td>' + placingAgeGroup + './' + placingAgeGroupTotal + medalAgeGroup + '</td>');
						}
					}
					result += getXMLRow('				</tr>');
				}
			}
			actNode = actNode.nextSibling;
		}

		if (!womanAdded && !manAdded) {
			alert("Es wurde mindestens 1 Wettbewerb ohne Teilnehmer gefunden. Bitte korrigiere deine Eingaben.");
			errorCount = 0;
			return "";
		}


		result += getXMLRow('			</tbody>');
		result += getXMLRow('		</table>');
	}

	return result;
}

function parseFieldValue (field, addLeadingZeros) {
	var value = parseInt(field.value, 10);

	if (isNaN(value)) {
		errorCount++;
		return "<span class='error'>???</span>"
	}
	else {
		if (addLeadingZeros) {
			var maxLength = field.maxLength;
			while ((value + "").length < maxLength) {
				value = "0" + value;
			}
		}
		return value;
	}
}

function parseTextFieldValue (field) {
	var value = field.value;

	if (value == null || value.length < 1) {
		errorCount++;
		return "<span class='error'>???</span>"
	}
	else {
		return value;
	}
}

// Adding and deleting competitions
function addCompetition() {
	var nextId = actCompetitionId++;

	var table = document.createElement("table");
	table.className = "inputTable";
	table.id = nextId;

	var thead = document.createElement("thead");

	var row = document.createElement("tr");

	var col = document.createElement("th");
	col.colSpan = "5";
	col.className = "head col_0 col_first col_last";

	var input = document.createElement("input");
	input.title = translations["inputCompetitionNameTitle"];
	input.id = "competition_" + nextId + "_title";
	input.type = "text";
	input.maxLength = "255";
	col.appendChild(input);

	var image = document.createElement("img");
	image.src = translations["buttonMoveUpCompetitionImage"];
	image.alt = translations["buttonMoveUpCompetitionTitle"];
	image.title = translations["buttonMoveUpCompetitionTitle"];

	var link = document.createElement("a");
	link.onclick = function () {moveCompetitionUp(this);};
	link.className = "action-button move-button move-up-button move-competition-up-button";
	link.appendChild(image);
	col.appendChild(link);

	image = document.createElement("img");
	image.src = translations["buttonMoveDownCompetitionImage"];
	image.alt = translations["buttonMoveDownCompetitionTitle"];
	image.title = translations["buttonMoveDownCompetitionTitle"];

	link = document.createElement("a");
	link.onclick = function () {moveCompetitionDown(this);};
	link.className = "action-button move-button move-down-button move-competition-down-button";
	link.appendChild(image);
	col.appendChild(link);

	var competitionTemplateSelect = document.createElement("select");
	competitionTemplateSelect.title = translations["selectCompetitionTemplateTitle"];
	competitionTemplateSelect.onchange = function () {document.getElementById("competition_" + nextId + "_title").value = this.options[this.selectedIndex].value};
	addCompetitionTemplateValues(competitionTemplateSelect);
	col.appendChild(competitionTemplateSelect);

	row.appendChild(col);
	thead.appendChild(row);

	row = document.createElement("tr");

	col = document.createElement("th");
	col.className = "head col_0 col_first";
	col.appendChild(document.createTextNode(translations["tableHeadStarters"]));
	row.appendChild(col);

	col = document.createElement("th");
	col.className = "head col_1 col_time";
	col.appendChild(document.createTextNode(translations["tableHeadTime"]));
	row.appendChild(col);

	col = document.createElement("th");
	col.className = "head col_2 col_place";
	col.appendChild(document.createTextNode(translations["tableHeadOverallPlace"]));
	row.appendChild(col);

	col = document.createElement("th");
	col.className = "head col_3 col_place col_last";

	var label = document.createElement("label");
	label.setAttribute("for", "competition_" + nextId + "_placingAgeGroup");
	label.appendChild(document.createTextNode(translations["tableHeadAgeGroupPlace"]));
	col.appendChild(label);

	var checkBox = document.createElement("input");
	checkBox.title = "Angabe der Altersklassenwertung: Falls keine Altersklassenwertung existiert bitte hier deselektiert.";
	checkBox.type = "checkbox";
	checkBox.id = "competition_" + nextId + "_placingAgeGroup";
	col.appendChild(checkBox);

	row.appendChild(col);

	thead.appendChild(row);

	table.appendChild(thead);

	var tbody = document.createElement("tbody");
	tbody.id = "competition_" + nextId + "_tbody";

	row = document.createElement("tr");
	row.id = "competition_" + nextId + "_tr_women";
	col = document.createElement("td");
	col.colSpan = "5";
	col.style.fontStyle = "italic";

	var span = document.createElement("div");
	span.appendChild(document.createTextNode(translations["headerWomen"]));

	col.appendChild(span);

	image = document.createElement("img");
	image.src = translations["buttonAddWomanImage"];
	image.alt = translations["buttonAddWomanTitle"];
	image.title = translations["buttonAddWomanTitle"];

	link = document.createElement("a");
	link.onclick = function () {addResultWoman('competition_' + nextId + '_tbody', 'competition_' + nextId + '_tr_men');};
	link.className = "action-button add-button add-result-button add-result-woman-button";
	link.appendChild(image);
	col.appendChild(link);

	col.appendChild(document.createTextNode(" "));

	image = document.createElement("img");
	image.src = translations["buttonDelWomanImage"];
	image.alt = translations["buttonDelWomanTitle"];
	image.title = translations["buttonDelWomanTitle"];

	link = document.createElement("a");
	link.onclick = function () {delResultWoman('competition_' + nextId + '_tbody', 'competition_' + nextId + '_tr_men');};
	link.className = "action-button del-button del-result-button del-result-woman-button";
	link.appendChild(image);
	col.appendChild(link);

	row.appendChild(col);
	tbody.appendChild(row);

	row = document.createElement("tr");
	row.id = "competition_" + nextId + "_tr_men";
	col = document.createElement("td");
	col.colSpan = "5";
	col.style.fontStyle = "italic";

	var span = document.createElement("div");
	span.appendChild(document.createTextNode(translations["headerMen"]));

	col.appendChild(span);

	image = document.createElement("img");
	image.src = translations["buttonAddManImage"];
	image.alt = translations["buttonAddManTitle"];
	image.title = translations["buttonAddManTitle"];

	link = document.createElement("a");
	link.onclick = function () {addResultMan('competition_' + nextId + '_tbody');};
	link.className = "action-button add-button add-result-button add-result-man-button";
	link.appendChild(image);
	col.appendChild(link);

	col.appendChild(document.createTextNode(" "));

	image = document.createElement("img");
	image.src = translations["buttonDelManImage"];
	image.alt = translations["buttonDelManTitle"];
	image.title = translations["buttonDelManTitle"];

	link = document.createElement("a");
	link.onclick = function () {delResultMan('competition_' + nextId + '_tbody');};
	link.className = "action-button del-button del-result-button del-result-man-button";
	link.appendChild(image);
	col.appendChild(link);

	row.appendChild(col);
	tbody.appendChild(row);

	table.appendChild(tbody);

	document.getElementById("competitions").appendChild(table);

	document.getElementById("competition_" + nextId + "_placingAgeGroup").checked = true;
}

function delCompetition() {
	var nodeToDelete = document.getElementById("competitions").lastChild;
	if (nodeToDelete.nodeType == 1 && nodeToDelete.nodeName == "TABLE") {
		document.getElementById("competitions").removeChild(nodeToDelete);
	}
}

// Adding and deleting women rows
function addResultWoman(tbodyId, trId) {
	document.getElementById(tbodyId).insertBefore(getResultRow(women), document.getElementById(trId));
	focusActMemberSelect();
}

function delResultWoman(tbodyId, trId) {
	var nodeToDelete = document.getElementById(trId).previousSibling;
	if (nodeToDelete.firstChild.firstChild.firstChild.nodeType == 1) {
		document.getElementById(tbodyId).removeChild(nodeToDelete);
	}
}

// Adding and deleting men rows
function addResultMan(tbodyId) {
	document.getElementById(tbodyId).appendChild(getResultRow(men));
	focusActMemberSelect();
}

function delResultMan(tbodyId) {
	var nodeToDelete = document.getElementById(tbodyId).lastChild;
	if (nodeToDelete.firstChild.firstChild.firstChild.nodeType == 1) {
		document.getElementById(tbodyId).removeChild(nodeToDelete);
	}
}

// Create new row
function getResultRow(members) {
	var row = document.createElement("tr");
	row.className="member";

	var col = document.createElement("td");
	col.className="member";
	col.appendChild(getMemberSelectBox(members));

	var image = document.createElement("img");
	image.src = translations["buttonMoveUpResultImage"];
	image.alt = translations["buttonMoveUpResultTitle"];
	image.title = translations["buttonMoveUpResultTitle"];

	var link = document.createElement("a");
	link.onclick = function () {moveResultUp(this);};
	link.className = "action-button move-button move-up-button move-result-up-button";
	link.appendChild(image);
	col.appendChild(link);

	image = document.createElement("img");
	image.src = translations["buttonMoveDownResultImage"];
	image.alt = translations["buttonMoveDownResultTitle"];
	image.title = translations["buttonMoveDownResultTitle"];

	link = document.createElement("a");
	link.onclick = function () {moveResultDown(this);};
	link.className = "action-button move-button move-down-button move-result-down-button";
	link.appendChild(image);
	col.appendChild(link);

	row.appendChild(col);
	// TODO ... weg Start
	col = document.createElement("td");
	col.appendChild(getSmallInput(2, "Gesamtzeit: Stunden"));
	col.appendChild(document.createTextNode(":"));
	col.appendChild(getSmallInput(2, "Gesamtzeit: Minuten"));
	col.appendChild(document.createTextNode(":"));
	col.appendChild(getSmallInput(2, "Gesamtzeit: Sekunden"));
	col.appendChild(document.createTextNode(" h"));
	row.appendChild(col);

	col = document.createElement("td");
	col.appendChild(getSmallInput(5, "Platzierung im Gesamtklassement pro Geschlecht"));
	col.appendChild(document.createTextNode(translations["placeFormat"]));
	col.appendChild(getSmallInput(5, "Gesamtzahl Teilnehmer im Gesamtklassement pro Geschlecht"));
	row.appendChild(col);

	col = document.createElement("td");
	col.appendChild(getSmallInput(5, "Platzierung in der Altersklasse"));
	col.appendChild(document.createTextNode(translations["placeFormat"]));
	col.appendChild(getSmallInput(5, "Gesamtzahl Teilnehmer in der Altersklasse"));
	row.appendChild(col);

	// TODO ... ändern Ende

	return row;
}

// Create row elements
function getSmallInput(maxlength, title) {
	var input = document.createElement("input");
	input.type = "text";
	input.className = "small_" + maxlength;
	input.title = title;
	input.maxLength = maxlength;
	return input;
}

//TODO ... ändern Start
function getMedalString(placing, overallPlacing) {
	var titlePart = "Gesamtplatz";
	var medalType = "place_overall";
	if (!overallPlacing) {
		titlePart = "Altersklassenplatz";
		medalType = "place_agegroup";
	}

	switch (placing) {
		case 1 : return ' <img src="system/modules/TriathlonResultsManager/assets/' + medalType + '_gold.png" title="1. ' + titlePart + '"/>';
		case 2 : return ' <img src="system/modules/TriathlonResultsManager/assets/' + medalType + '_silver.png" title="2. ' + titlePart + '"/>';
		case 3 : return ' <img src="system/modules/TriathlonResultsManager/assets/' + medalType + '_bronze.png" title="3. ' + titlePart + '"/>';
		default : return '';
	}
}
//TODO ... ändern Ende

function moveResultUp(srcButton) {
	var actRow = srcButton.parentNode.parentNode;
	var previousRow = actRow.previousSibling;
	var tbody = actRow.parentNode;
	if (previousRow.firstChild.colSpan != 5) {
		tbody.removeChild(actRow);
		tbody.insertBefore(actRow, previousRow);
	}
}

function moveResultDown(srcButton) {
	var actRow = srcButton.parentNode.parentNode;
	var nextRow = actRow.nextSibling;
	var tbody = actRow.parentNode;
	if (nextRow != null && nextRow.firstChild.colSpan != 5) {
		tbody.removeChild(actRow);
		if (nextRow.nextSibling == null) {
			tbody.appendChild(actRow);
		} else {
			tbody.insertBefore(actRow, nextRow.nextSibling);
		}
	}
}

function moveCompetitionUp(srcButton) {
	var actTable = srcButton.parentNode.parentNode.parentNode.parentNode;
	var previousElement = actTable.previousSibling;
	if (previousElement.nodeName != "LEGEND") {
		document.getElementById("competitions").removeChild(actTable);
		document.getElementById("competitions").insertBefore(actTable, previousElement);
	}
}

function moveCompetitionDown(srcButton) {
	var actTable = srcButton.parentNode.parentNode.parentNode.parentNode;
	var nextTable = actTable.nextSibling;
	if (nextTable != null) {
		document.getElementById("competitions").removeChild(actTable);
		if (nextTable.nextSibling == null) {
			document.getElementById("competitions").appendChild(actTable);
		} else {
			document.getElementById("competitions").insertBefore(actTable, nextTable.nextSibling);
		}
	}
}

function addCompetitionTemplateValues (select) {
	var optionEmpty = document.createElement("option");
	optionEmpty.innerHTML = translations["selectCompetitionTemplateFirstOption"];
	optionEmpty.value = "";
	select.appendChild(optionEmpty);

	var optGroup = document.createElement("optgroup");
	optGroup.label = translations["selectCompetitionTemplateOptgroup"];

	for (var i = 0; i < competitionTemplates.length; i++) {
		var option = document.createElement("option");
		option.value = competitionTemplates[i];
		option.appendChild(document.createTextNode(competitionTemplates[i]));

		optGroup.appendChild(option);
	}

	select.appendChild(optGroup);
}

function getMemberSelectBox(members) {
	var select = document.createElement("select");
	select.title = translations["selectMemberTitle"];
	var option = null;
	for (var i = 0; i < members.length; i++) {
		option = document.createElement("option");
		option.value = members[i]['id'];
		option.appendChild(document.createTextNode(members[i]['name']));
		select.appendChild(option);
	}
	actMemberSelect = select;
	return select;
}

var actMemberSelect = null;

function focusActMemberSelect () {
	if (actMemberSelect != null) {
		actMemberSelect.focus();
		actMemberSelect = null;
	}
}


// TODO ... weg Start
/**
 * -------------------------------------
 * Adding Ajax
 * -------------------------------------
 */
var browserUrl = String(window.location);
var baseUrl = browserUrl.substring(0, browserUrl.indexOf(".de") + 3) + "/";

function doAjaxRequest(url, params, handlerFunction)
{
	try
	{
		req = new XMLHttpRequest();
	}
	catch (e)
	{
		try
		{
			req = new ActiveXObject("Msxml2.XMLHTTP");
		}
		catch (e)
		{
			try
			{
				req = new ActiveXObject("Microsoft.XMLHTTP");
			}
			catch (failed)
			{
				req = null;
			}
		}
	}

	if (req == null)
	{
		showErrorMessage("Error creating request object!");
	}

	var paramString = "";

	if (params != null && params.length > 0)
	{
		for (var i = 0; i < params.length; i++)
		{
			paramString += encodeParam(params[i][0]);
			paramString += "="
			paramString += encodeParam(params[i][1]);

			if (i < (params.length - 1))
			{
				paramString += "&";
			}
		}
	}

	req.open("POST", baseUrl + url, true);

	req.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	req.setRequestHeader("Content-length", paramString.length);
	req.setRequestHeader("Connection", "close");

	req.onreadystatechange = handlerFunction;

	req.send(paramString);

}

// private method for UTF-8 encoding
function encodeParam (param)
{
	var string = String(param);
	string = escape(string);
	string = string.replace(/\+/g, encodeURIComponent("+"));
	return string;
}

/**
 * Handler message if results where send
 */
function resultsSendHandler ()
{
	switch(req.readyState)
	{
		case 4:
			if(req.status!=200)
			{
				alert("Beim Senden der Ergebnisse ist ein Fehler entstanden.\nBitte versuchen Sie es ein weiteres Mal oder versenden das generierte XML mit ihrem Email-Programm.\n(Request-Status: " + req.status + "; Request-Statustext: " + req.statusText + ")");
			}
			else
			{
				alert("Die Ergebnisse wurden erfolgreich gesendet.");
			}
			break;
		default: return false; break;
	}
}

//TODO ... weg Ende