@extends('layouts.main')
@section('content')
	<title>Thêm mới sinh viên</title>
	<style>
		form {
			margin: 20px auto;
			width: 50%;
			padding: 20px;
			border: 1px solid #ccc;
			border-radius: 5px;
		}
		label {
			display: block;
			margin-bottom: 5px;
		}
		input[type="text"], select {
			padding: 5px;
			width: 100%;
			border: 1px solid #ccc;
			border-radius: 5px;
			margin-bottom: 10px;
			box-sizing: border-box;
		}
		input[type="submit"] {
			background-color: #4CAF50;
			color: white;
			padding: 10px;
			border: none;
			border-radius: 5px;
			cursor: pointer;
		}
		.radio_check{
			display: flex;
		}
	</style>
</head>
<body>
	{{--  --}}
	<form action="{{route('addHotel_database')}}" method="post">
        @csrf
		<label for="name">Tên Khách sạn:</label>
		<input type="text" id="name" name="name" required>
		<label for="star">Star</label>
		<select name="star">
			<option value="1">1</option>
			<option value="2">2</option>
			<option value="3">3</option>
			<option value="4">4</option>
			<option value="5">5</option>
		</select>
		<label for="address">Địa chỉ:</label>
		<input type="text" id="address" name="address" required>
		<label for="Logo">Logo</label>
		
		<input type="text" id="Logo" name="Logo" required>
		<label for="Online">Đang Bận</label>
  		<input type="radio" id="Online" name="status" value="0" class="radio_check">
  		<label for="off">Đang Hoạt Động</label>
  <input type="radio" id="off" name="status" value="1" class="radio_check">
	<input type="submit" value="Thêm mới">
	</form>

    @endsection
