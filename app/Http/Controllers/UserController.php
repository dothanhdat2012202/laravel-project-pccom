<?php

namespace App\Http\Controllers;

use App\Http\Services\CartService;
use App\Models\Customer;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Models\Cart;

class UserController extends Controller
{
    protected $cart;
    public function __construct(CartService $cart){
        $this->cart = $cart;
    }
    public function login_user()
    {
        return view('users.login',[
            'title' => 'Đăng nhập tài khoản'
        ]);
    }
    public function postUser(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email:filter', // Email không được trống và phải đúng định dạng email
            'password' => 'required' // Mật khẩu không được trống
        ]);

        if (Auth::attempt([
            'email' => $request->email,
            'password' => $request->password,
            'role' => 0
        ], $request->input('remember'))) {
            // Đăng nhập thành công
            return redirect()->route('home')->with('success', 'Đăng nhập thành công'); //SweetAlert2.
        }

        // Đăng nhập thất bại
        return redirect()->back()->with('error', 'Thông tin đăng nhập không chính xác, vui lòng thử lại');

    }
    public function register(){
        return view('users.register',[
            'title' => 'Tạo tài khoản ngay'
        ]);
    }

    public function postRegister(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'phone' => 'required|string|max:15',
            'password' => 'required|string|min:8',
        ]);
        $request->merge(['password'=>Hash::make($request->password)]);
        try {
            User::create($request->all());
            // Tạo thông báo thành công
            $request->session()->flash('success', 'Tạo tài khoản thành công. Vui lòng đăng nhập.'); //SweetAlert2.
            return redirect()->route('login_user');
        } catch (\Throwable $th) {
            // Tạo thông báo lỗi
            $request->session()->flash('error', 'Tạo tài khoản thất bại. Vui lòng thử lại.'); //SweetAlert2.
            return redirect()->back();
        }
    }

    public function logout_user()
    {
        Auth::logout();
        return redirect()->route('home');
    }

    public function my_account()
    {
        return view('users.account',[
            'title'=> 'Trang người dùng'
        ]);
    }
    public function history_cart(){
        $user = Auth::user(); // Lấy người dùng hiện tại

        if (!$user) {
            return redirect()->route('login_user')->with('error', 'Vui lòng đăng nhập để xem lịch sử mua hàng.');
        }

        // Lấy tất cả khách hàng có tên và email giống với người dùng hiện tại
        $customers = Customer::where('name', $user->name)
            ->where('email', $user->email)
            ->get();

        // Khởi tạo một collection để lưu tất cả các đơn hàng
        $carts = collect();
        return view('users.history', [
            'title' => 'Lịch sử mua hàng của ' . $user->name,
            'customers' => $customers,
            'carts' => $carts
    ]);
    }
    public function history_show(Customer $customer){

         return view('users.detail',[
            'title'=> 'Thông tin đơn hàng ' . $customer-> name,
            'customer'=>$customer,
            'carts' => $customer->carts

         ]);
    }
    //hiển thị tài khoản user trong admin
    public function index()
    {
        $title = 'Danh sách tài khoản users';
        // Lấy tất cả user có role là 0 (trừ admin)
        $users = User::where('role', 0)->get();
        return view('admin.users.index', compact('title','users'));
    }
      // Thêm phương thức update
      public function update(Request $request)
      {
          $user = Auth::user();

          $request->validate([
              'name' => 'required|string|max:255',
              'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
              'phone' => 'nullable|string|max:15',
              'city' => 'nullable|string|max:255',
              'district' => 'nullable|string|max:255',
              'ward' => 'nullable|string|max:255',
              'street' => 'nullable|string|max:255',
              'old-password' => 'nullable|string',
              'new-password' => 'nullable|string|min:8|confirmed',
          ]);

          $user->name = $request->input('name');
          $user->email = $request->input('email');
          $user->phone = $request->input('phone');
          $user->city = $request->input('city');
          $user->district = $request->input('district');
          $user->ward = $request->input('ward');
          $user->street = $request->input('street');

          if ($request->filled('old-password') && $request->filled('new-password')) {
              if (Hash::check($request->input('old-password'), $user->password)) {
                  $user->password = Hash::make($request->input('new-password'));
              } else {
                  return back()->withErrors(['old-password' => 'Mật khẩu cũ không đúng']);
              }
          }

          $user->save();

          return back()->with('success', 'Cập nhật thông tin thành công');
      }

}
