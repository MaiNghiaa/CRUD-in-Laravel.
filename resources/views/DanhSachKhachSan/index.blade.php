@extends('layouts.main')
@section('content')
<link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">

    <style>
        * {
  box-sizing: border-box;
}

body {
  font-family: Arial, sans-serif;
  margin: 0;
}
.search-form,.form_del {
  display: flex;
  align-items: center;
  justify-content: flex-end;
  margin-bottom: 20px;
}

.search-form input[type="text"] {
  width: 200px;
  padding: 10px;
  border: 1px solid #ccc;
  border-radius: 5px;
  margin-right: 10px;
}

.search-form button[type="submit"] {
  padding: 10px 20px;
  background-color: #007bff;
  color: #fff;
  border: none;
  border-radius: 5px;
  cursor: pointer;
}
.form_del input[type="text"] {
  width: 200px;
  padding: 10px;
  border: 1px solid #ccc;
  border-radius: 5px;
  margin-right: 10px;
}
.form_del button[type="submit"]{
  padding: 10px 20px;
  background-color: red;
  color: #fff;
  border: none;
  border-radius: 5px;
  cursor: pointer;
}


.container {
  max-width: 800px;
  margin: 0 auto;
  padding: 20px;
}

h1 {
  text-align: center;
  margin-bottom: 30px;
}

table {
  width: 100%;
  border-collapse: collapse;
  border-radius: 10px;
  overflow: hidden;
}

th,
td {
  padding: 10px;
  text-align: left;
}

th {
  background-color: #eee;
  font-weight: bold;
  text-transform: uppercase;
}

tr:nth-child(even) {
  background-color: #f2f2f2;
}

.edit,
.delete,
.add {
  background-color: #4CAF50;
  color: white;
  border: none;
  padding: 10px;
  cursor: pointer;
  margin-right: 5px;
  border-radius: 30px;
  font-size: 14px;
  transition: background-color 0.3s ease-in-out;
}

.delete {
  background-color: #f44336;
}

.add {
  background-color: #008CBA;
}

button:hover {
  opacity: 0.8;
}

.add:hover {
  background-color: #006b8f;
}

.edit:hover,
.delete:hover {
  background-color: #3e8e41;
}

button:active {
  transform: translateY(1px);
}

form {
  display: none;
  margin-top: 20px;
}

form label,
form input {
  display: block;
  /* margin-bottom: 10px; */
  font-size: 14px;
}

form label {
  font-weight: bold;
}

form input {
  width: 100%;
  padding: 10px;
  border: none;
  border-radius: 30px;
  font-size: 14px;
  box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
}

form button {
  background-color: #008CBA;
  color: white;
  border: none;
  padding: 10px;
  cursor: pointer;
  border-radius: 30px;
  font-size: 14px;
  transition: background-color 0.3s ease-in-out;
}
a{
  color:#fff;
}

form button:hover {
  background-color: #006b8f;
}

form button:active {
  transform: translateY(1px);
}
img{
  width: 100px;
  height: 100px;
  object-fit: cover;
}
.pagination {
        margin-top: 20px;
        margin-bottom: 20px;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .pagination > * {
        margin: 0 10px;
    }

    .pagination .active {
        font-weight: bold;
    }
    </style>
    
    <div class="container">
        <h1>Danh sách Khách sạn</h1>
        <div class="search-container">
          <form class="search-form" method="GET">
            <input type="text" name="name" placeholder="Tìm kiếm...">
            <button type="submit">Tìm kiếm</button>
          </form>
      </div>
        <table>
            <thead>
                <tr>
                    <th>name</th>
                    <th>Star</th>
                    <th>address</th>
                    <th>logo</th>
                    <th>trạng thái</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($Hotels as $Hotel)
                <tr>
                    <td>{{$Hotel->name}}</td>
                    <td>{{$Hotel->star}}</td>
                    <td>{{$Hotel->address}}</td>
                    <td><img src="{{$Hotel->logo}}" alt=""></td>
                    <td>{{$Hotel->status}}</td>
                        {{-- <button class="edit">Sửa</button> --}}
                        <td>
                        <form class="form_del" action="{{ route('delete_hotel', $Hotel->id) }}" method="POST">
                          @csrf
                          @method('DELETE')
                          <button type="submit">Xóa</button>
                          <button class="btn btn-xs btn-primary" style="margin-left:10px"><a href="{{route('hotel.edit',$Hotel->id)}}">
                            Sửa</a></button>
                      </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
            
        </table>
        
        <a href="{{route('addHotel')}}"><button class="add">Thêm Khach San Moi</button></a>
        <div class="pagination">
            {{ $Hotels->links('pagination::bootstrap-4') }}
        </div>

    </div>
    @endsection
