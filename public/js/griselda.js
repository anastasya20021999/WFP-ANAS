$('.show-submaster').change(function(){ 
    var jenis = $(this).val();
    var master_id=$(this).val();
    jenis=jenis.substring(0,1);
    
    if (jenis=="M") {
    	master_id=master_id.substring(1,$(this).val().length);
    	//alert(master_id);
	    $.ajax({
            type: 'POST',
            url: "{{ URL::route('/changeOption') }}",
            data: {
            	'_token': $('input[name=_token]').val(),
                'id': master_id
            },
            success: function(data) {
            	$('#jenis_submaster').append('<option value="foo" selected="selected">Foo</option>');
                alert(data);
            },
        });
    }
});
