function reloadinfo_search(query)
{
	$('#bmore').hide();
	$('#morepreload').show();
	
	numitems = $('#numitems').val();

	$.ajax({
		type: 'POST',
		url: siteurl + 'ajax/reload-search-tag/r:' + Math.round(Math.random()*1000),
		data: 'ni=' + numitems + '&q=' + query,
		success: function(h){
			switch(h.charAt(0)){
				case '0':
					alert(h.substring(3));
					$('#morepreload').hide();
					$('#bmore').show();
					break;
				
				case '1':
					cad = h.substring(3);
					$('#moreitems').append(cad);
					$('#numitems').val(parseInt($('#numitems').val()) + parseInt(itemperpage));
					
					$('#morepreload').hide();
					$('#bmore').show();
					break;
					
				case '2':
					cad = h.substring(3);
					$('#moreitems').append(cad);
					$('#moreitemsbar').hide();
					break;
			}
		},
		error: function(){
			alert(txt_norequest);
			$('#morepreload').hide();
			$('#bmore').show();
		} //end error
	}); // end ajax
}