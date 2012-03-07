<script>

		var jsonnumber = 0;
		var json;



	function linkContent() {literal}{{/literal}
		addContent(jsonnumber);
		jsonnumber++;
	{literal}}{/literal}




	function addContent(id) {literal}{{/literal}
		var rand_id = 'newNews_'+json[id].id;
		$('news_list').insert({literal}{{/literal}top: '<li id="'+rand_id+'">' + json[id].action + '</li>'{literal}}{/literal});
		new Effect.Highlight(rand_id);
	{literal}}{/literal}




	function getContent() {literal}{{/literal}


		new Ajax.Request('http://admin.cash-ltd.co.uk/api/newsfeed/', {literal}{{/literal}
 		 onSuccess: function(transport) {literal}{{/literal}
 		   json = transport.responseText.evalJSON();

 		 {literal}}{/literal}
		{literal}}{/literal});



	{literal}}{/literal}

</script>


<ul id="news_list">

	<li>Test Item One</li>
	<li>Test Item Two</li>
	<li>Test Item Three</li>

</ul>


<input type="button" value="Get Content" onClick="getContent();">
<input type="button" Value="Show Content" onClick="linkContent();">


