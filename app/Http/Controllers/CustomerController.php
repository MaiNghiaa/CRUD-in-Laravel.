<?php

namespace App\Http\Controllers;

use App\Models\hotels;
use App\Models\users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
// Phân trang
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Symfony\Component\HttpFoundation\Cookie;


class CustomerController extends Controller
{
    //
    public function login()
    {
        if (Auth::guard('cus')->check()) {
            return redirect()->route('index');
        }
        return view('DanhSachKhachSan.login');
    }

    public function post_login(Request $request)
    {
        $login_data = [
            'email' => $request->email,
            'password' => $request->password
        ];
        // dd($login_data)
        $check_login = Auth::guard('cus')->attempt($login_data);
        if (!$check_login) {
            return redirect()->back()->with('error', 'Đăng nhập không thành công vui lòng thử lại');
        }
        return redirect()->route('index');
    }

    public function register()
    {
        return view('DanhSachKhachSan.register');
    }

    public function post_register(Request $request)
    {
        $rules = [
            'name' => 'required|max:100',
            'email' => 'required|unique:users|max:100',
            'password' => 'required|min:6|max:12',
            'password_confirmation' => 'required|same:password',
        ];
        $message = [
            'name.required' => 'Vui lòng nhập họ tên'
            // .....blabla
        ];
        $request->validate($rules, $message);
        // Lưu thông in vào bảng admin
        $add = users::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);
        // kiểm tra thêm mới thành công hay không
        return redirect()->route('DanhSachKhachSan.login');
    }
    public function index(Request $req)
    {
        if (Auth::guard('cus')->check()) {
            $Hotels = DB::table('hotels')
                ->paginate(5); // phan trang
            // dd($Hotels);
            // tìm kiếm 
            if ($req->name) {
                $Hotels = DB::table('hotels')->where('hotels.name', 'LIKE', '%' . $req->name . '%')->paginate(3);
            }
            return view('DanhSachKhachSan.index', compact('Hotels'));
        }
        return view('DanhSachKhachSan.login');
    }

    // Them khach san moi 
    public function AddNew()
    {
        if (Auth::guard('cus')->check()) {
            return view('modules.addnew');
        }
        return view('DanhSachKhachSan.login');
    }
    // thêm khach san vao db 
    public function addHotel_database(Request $request)
    {
        hotels::create([
            'name' => $request->name,
            'star' => $request->star,
            'address' => $request->address,
            'logo' => $request->address,
            'status' => $request->status
        ]);
        return redirect()->route('index'); //redirect()->route('admin.login');
    }
    // Xoa Khach san
    public function delete_hotel($id)
    {
        DB::table('hotels')->where('id', $id)->delete();
        return redirect()->back();
    }
    // hiển thị form sửa thông tin khách sạn 
    public function hotel_edit($id)
    {
        $find_hotel = DB::table('hotels')->where('id', $id)->first();
        return view('modules.edit', compact('find_hotel'));
    }
    // SỬa thông tin trong db 
    public function hotel_update(Request $request, $id)
    {
        // dd($request);
        DB::table('hotels')->where('id', $id)->update($request->only('name', 'Star', 'address', 'Logo', 'status'));
        return redirect()->route('index'); // chuyển hướng về danh sách
    }
}
