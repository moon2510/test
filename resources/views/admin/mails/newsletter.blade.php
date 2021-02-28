<style type="text/css">
	.middle{
		margin: 0 auto;
	}
	.container{
		width: 600px;
		background: #f0f8ff;
	}
	.container h1{
		color: #e41717;
		font-family: Garamond, Baskerville, "Baskerville Old Face", "Hoefler Text", "Times New Roman", serif;
		font-style: normal; font-variant: normal; font-weight: 700; line-height: 26.4px;
		padding: 20px;
		border-bottom: 3px solid #e41717;
		margin-bottom: 0;
		text-align: center;
	}
	.book-new{
		padding: 10px;
		text-align: center;
		background-color: #fffad3;
	}
	.book-new .thumb{
		width: 270px;
		height: 364px;
		margin: 0 auto;
		display: block;
		margin-bottom: 10px;
		border: 3px solid #fda70b;
	}
	.book-new .title{
		font-family: sans-serif;
		text-transform: uppercase;
		color: #000000;
	}
	.container .footer{
		background-color: #e8e8e8;
		padding: 30px;
	}
	.btn-buy{
		text-decoration: none;
		color: #ffffff;
		text-transform: uppercase;
		font-family: sans-serif;
		display: inline-block;
		padding: 10px;
		background: #da5454;
	}
</style>
<div class="container middle">
	<h1>Online Library</h1>
	<div class="book-new">
		@if($img == null)
		<img class="thumb" src="http://localhost:8000/images/default.jpg">
		@else
		<img class="thumb" src="http://localhost:8000/{{ $img }}">
		@endif
		<a href="http://localhost:8000/book/{{$id}}" class="btn-buy">Xem ngay</a>
		<p class="title">{{$name}}</p>
	</div>
	<div class="footer">
		<p>Trung Tâm Thương Mại Điện Tử</p>
	</div>
</div>
