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
	</style>
</head>
<body>
	<form action="{{route('student.update',$find_hotel->id)}}" method="post">
        @csrf
        @method('PUT')
		<label for="name">Tên Khách Sạn :</label>
        {{-- {{dd($find_hotel)}} --}}
		<input type="text" id="name" name="name" required value="{{$find_hotel->name}}">
		<label for="class_room_id">Star</label>
		<select name="Star">
			@for($i = 1; $i <= 5; $i++)
    <option value="{{ $i }}" @if($i == $find_hotel->star) selected @endif>Lớp {{ $i }}</option>
@endfor
		</select>
		<label for="address">Địa chỉ:</label>
		<input type="text" id="address" name="address" required value="{{$find_hotel->address}}">
		<label for="Logo">Logo</label>
		<input type="text" id="Logo" name="Logo" required value="{{$find_hotel->logo}}">
		<label for="Online">Đang Bận</label>
  		<input type="radio" id="Online" name="status" value="0" class="radio_check" @if($find_hotel->status == '0') checked @endif>
  		<label for="off">Đang Hoạt Động</label>
  <input type="radio" id="off" name="status" value="1" class="radio_check" @if($find_hotel->status == '1') checked @endif>
	<input type="submit" value="Thêm mới">
	</form>

    @endsection
