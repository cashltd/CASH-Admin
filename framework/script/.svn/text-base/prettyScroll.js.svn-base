/*		********** TO DO LIST **********
		Pull in items using AJAX from the database!

*/



currentn = 0; // Records the current array item we're on


function addTextnumberone() {
	var current = document.getElementById('scrollingArea').innerHTML;

	var xthisvoice = voice[0].split("~")
		var xentry = xthisvoice[0];
		var xdetails = xthisvoice[1];
		var xnewString = "<div id='newentryx'><div class='wholeentry'><div class='entry'>"+xthisvoice[0]+"</div><div class='details'>"+xthisvoice[1]+"</div></div></div>" + current.replace(/newentryx/, "");

	document.getElementById('scrollingArea').innerHTML = xnewString;
	new Effect.Opacity(document.getElementById('newentryx'), {duration:4.0, from:0, to:1.0});
	currentn++;

	if (currentn >= (voice.length - 1) )
		currentn = 0;

}




function addText() {
	var current = document.getElementById('scrollingArea').innerHTML;

	var thisvoice = voice[currentn].split("~")
		var entry = thisvoice[0];
		var details = thisvoice[1];
		var newString = "<div id='newentry'><div class='wholeentry'><div class='entry'>"+thisvoice[0]+"</div><div class='details'>"+thisvoice[1]+"</div></div></div>" + current.replace(/newentry/, "");

	document.getElementById('scrollingArea').innerHTML = newString;
	new Effect.Opacity(document.getElementById('newentry'), {duration:4.0, from:0, to:1.0});
	currentn++;

	if (currentn >= (voice.length - 1) )
		currentn = 0;

	setTimeout("addText()",8000);
}


function gogomessage() {

		var hthisvoice = voice[0].split("~");
		var hentry = hthisvoice[0];
		var hdetails = hthisvoice[1];

		var hnewString = "<div class='wholeentry'><div class='entry'>"+hthisvoice[0]+"</div><div class='details'>"+hthisvoice[1]+"</div></div>";

	Effect.Appear('popupnew', { duration: 1.5 });
	document.getElementById('popupnew').innerHTML = hnewString;
	setTimeout("Effect.SwitchOff('popupnew');",5000);
}


 function textLimit(field, maxlen) {
if (field.value.length > maxlen + 1)
alert('your input has been truncated!');
if (field.value.length > maxlen)
field.value = field.value.substring(0, maxlen);
}


function refreshEntries() {

	getCSV();
	setTimeout("refreshEntries()",15000);
}


function startLoad() {

	refreshEntries();
	setTimeout("addText()",1000);

}

