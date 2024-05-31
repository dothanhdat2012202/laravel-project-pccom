<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Review;
use App\Models\Customer;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $totalProducts = Product::count();
        $totalReviews = Review::count();
        $totalCustomers = Customer::count();
        $totalUsers = User::count();

        // Biểu đồ cột doanh thu các tháng theo năm
        $currentYear = now()->year;
        $lastYear = now()->year - 1;

         // Doanh thu 12 tháng của năm hiện tại
         $currentYearSales = DB::table('carts')
         ->join('customers', 'carts.customer_id', '=', 'customers.id')
         ->select(
             DB::raw('MONTH(customers.created_at) as month'),
             DB::raw('SUM(carts.price * carts.quantity) as total_sales')
         )
         ->whereYear('customers.created_at', $currentYear)
         ->groupBy(DB::raw('MONTH(customers.created_at)'))
         ->pluck('total_sales', 'month')->toArray();

     // Doanh thu 12 tháng của năm trước
     $lastYearSales = DB::table('carts')
         ->join('customers', 'carts.customer_id', '=', 'customers.id')
         ->select(
             DB::raw('MONTH(customers.created_at) as month'),
             DB::raw('SUM(carts.price * carts.quantity) as total_sales')
         )
         ->whereYear('customers.created_at', $lastYear)
         ->groupBy(DB::raw('MONTH(customers.created_at)'))
         ->pluck('total_sales', 'month')->toArray();

     // Chuyển dữ liệu thành mảng đủ 12 tháng
     $monthlySalesCurrentYear = array_fill(1, 12, 0);
     $monthlySalesLastYear = array_fill(1, 12, 0);

     foreach ($currentYearSales as $month => $sales) {
         $monthlySalesCurrentYear[$month] = $sales;
     }

     foreach ($lastYearSales as $month => $sales) {
         $monthlySalesLastYear[$month] = $sales;
     }


        // Truy vấn doanh thu hàng tháng từ bảng customers thông qua bảng carts
        $year = now()->year;
        $monthlySales = DB::table('carts')
            ->join('customers', 'carts.customer_id', '=', 'customers.id')
            ->select(
                DB::raw('MONTH(customers.created_at) as month'),
                DB::raw('SUM(carts.price * carts.quantity) as total_sales')
            )
            ->whereYear('customers.created_at', $year)
            ->groupBy(DB::raw('MONTH(customers.created_at)'))
            ->pluck('total_sales', 'month');

        // Đảm bảo đủ 12 tháng, kể cả những tháng không có doanh thu
        $monthlySales = $monthlySales->toArray();
        for ($i = 1; $i <= 12; $i++) {
            if (!array_key_exists($i, $monthlySales)) {
                $monthlySales[$i] = 0;
            }
        }
        ksort($monthlySales); // Sắp xếp theo thứ tự tháng

        // Tính toán tổng doanh thu
        $totalRevenue = array_sum($monthlySales);

        // Tính toán doanh thu chênh lệch giữa tháng hiện tại và tháng trước
        $currentMonth = now()->month;
        $previousMonth = $currentMonth - 1;
        $currentMonthRevenue = $monthlySales[$currentMonth] ?? 0;
        $previousMonthRevenue = $monthlySales[$previousMonth] ?? 0;
        $revenueDifference = $currentMonthRevenue - $previousMonthRevenue;

        // Tính toán phần trăm chênh lệch
        $percentageDifference = $previousMonthRevenue != 0
            ? ($revenueDifference / $previousMonthRevenue) * 100
            : ($currentMonthRevenue != 0 ? 100 : 0); // Xử lý trường hợp chia cho 0

        // Thống kê tỷ lệ thanh toán
        $paymentMethods = Customer::select('payment_method', DB::raw('count(*) as count'))
            ->groupBy('payment_method')
            ->pluck('count', 'payment_method');

        return view('admin.dashboard.index', [
            'title' => 'Biểu đồ thống kê',
            'totalProducts' => $totalProducts,
            'totalReviews' => $totalReviews,
            'totalCustomers' => $totalCustomers,
            'totalUsers' => $totalUsers,
            'monthlySales' => $monthlySales,
            'totalRevenue' => $totalRevenue,
            'revenueDifference' => $revenueDifference,
            'percentageDifference' => $percentageDifference,
            'currentMonthRevenue' => $currentMonthRevenue,
            'paymentMethods' => $paymentMethods, // Truyền dữ liệu tỷ lệ thanh toán vào view
            'monthlySalesCurrentYear' => $monthlySalesCurrentYear,
            'monthlySalesLastYear' => $monthlySalesLastYear
        ]);
    }
}
