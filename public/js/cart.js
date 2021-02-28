$(document).ready(function(){
	$('Form').on('submit', function(e){
		let book_id = $(this).attr("data-book-id");
		if (book_id == null) {
			return;
		}
		$('#myModal'+book_id).modal('show');
		e.preventDefault();
	});
	$('#myForm2').on('submit', function(e){
		$('#myModal2').modal('show');
		e.preventDefault();
	});
});