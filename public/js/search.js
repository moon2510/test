$(document).ready(function(){
	$("form#options_search").submit(function( event ) {
		event.preventDefault();
		let categoryId = $("select#category-select").val();
		let orderby = $("select#groupby-select").val();
		let paginate = $("select#paginate-select").val();
		let keysearch = $("#keysearch").val();
		let token = $("meta[name='csrf-token']").attr("content");
		$.ajax({
			type:'POST',
			url:'/search',
			data:{
				'keysearch':keysearch,
				'category':categoryId,
				'orderby':orderby,
				'paginate':paginate,
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
	$('#keysearch').keyup(function() {
		let categoryId = $("select#category-select").val();
		let orderby = $("select#groupby-select").val();
		let paginate = $("select#paginate-select").val();
		let keysearch = $("input#keysearch").val();
		let token = $("meta[name='csrf-token']").attr("content");
		$.ajax({
			type:'POST',
			url:'/search/ajax',
			data:{
				'keysearch':keysearch,
				'category':categoryId,
				'orderby':orderby,
				'paginate':paginate,
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