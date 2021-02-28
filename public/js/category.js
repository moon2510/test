$(document).ready(function(){
	$("form#options").submit(function( event ) {
		event.preventDefault();
		let orderby = $("select#orderby-select").val();
		let paginate = $("select#pagination-select").val();
		let categoryId = $(this).attr("data-category-id");
		let token = $("meta[name='csrf-token']").attr("content");
		$.ajax({
			type:'POST',
			url:'/category/'+categoryId,
			data:{
				'category':categoryId,
				'pagination':paginate,
				'orderby':orderby,
				'_token':token
			},
			success:function(data){
				$("#paginate").empty().append($(data).hide().fadeIn(500));
			},
			error:function(jqXHR,exception){
				console.log(jqXHR.responseText);
			}
		});
	});
});