$('.show-submaster').change(function(){ 
    var jenis = $(this).val();
    var master_id=$(this).val();
    jenis=jenis.substring(0,1);
    
    if (jenis=="M") {
    	master_id=master_id.substring(1,$(this).val().length);
    	//alert(master_id);
	    $.ajax({
            type: 'POST',
            url: 'changeOption'
            data: {
            	'_token': $('input[name=_token]').val(),
                'id': master_id,
            },
            success: function(dataResult) {
            	var resultData = dataResult.data;
            	alert(resultData.id);
            	if((dataResult.errors))
            	{
            		alert(dataResult.errors);
            	}
            	else
            	{
            		alert(resultData.name);
            		$('#jenis_submaster').append('option value='+resultData.id+'>'+resultData.name+'</option>');
            	}
            },
        });
    }
});
