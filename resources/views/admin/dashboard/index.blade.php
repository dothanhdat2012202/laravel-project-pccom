@extends('admin.main')
<!-- kế thừa từ main -->

@section('content')
<section class="content">
    <!-- Thống kê số lượt -->
    <div class="container-fluid">
      <div class="row">
        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
                <span class="info-box-icon bg-info elevation-1"><i class="fas fa-box"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Tổng sản phẩm</span>
                    <span class="info-box-number">
                        {{ $totalProducts }}
                    </span>
                </div>
            </div>
        </div>
        <!-- /.col -->
        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
                <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-star"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Tổng lượt đánh giá</span>
                    <span class="info-box-number">
                        {{ $totalReviews }}
                    </span>
                </div>
            </div>
        </div>
        <!-- /.col -->
        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
                <span class="info-box-icon bg-success elevation-1"><i class="fas fa-shopping-cart"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Tổng lượt mua hàng</span>
                    <span class="info-box-number">
                        {{ $totalCustomers }}
                    </span>
                </div>
            </div>
        </div>
        <!-- /.col -->
        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
                <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Tổng thành viên</span>
                    <span class="info-box-number">
                        {{ $totalUsers }}
                    </span>
                </div>
            </div>
        </div>
        <!-- /.col -->
    </div>
    <!-- /.end -->

    <!-- Thống kê doanh thu theo tháng -->
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Báo cáo tóm tắt hàng tháng</h5>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <p class="text-center">
                                <strong>Bán hàng: 1/1/{{ now()->year }} - 31/12/{{ now()->year }}</strong>
                            </p>
                            <div class="chart">
                                <canvas id="salesChart" style="width: 100%; height: 400px;"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="row">
                        <div class="col-sm-3 col-6">
                            <div class="description-block border-right">
                                <span class="description-percentage text-success">
                                    <i class="fas fa-caret-up"></i> 100%</span>
                                <h5 class="description-header">{{ number_format($totalRevenue, 0, ',', '.') }} VNĐ</h5>
                                <span class="description-text">TỔNG DOANH THU</span>
                            </div>
                        </div>
                        <div class="col-sm-3 col-6">
                            <div class="description-block border-right">
                                <span class="description-percentage text-{{ $percentageDifference >= 0 ? 'success' : 'danger' }}">
                                    <i class="fas fa-caret-{{ $percentageDifference >= 0 ? 'up' : 'down' }}"></i>
                                    {{ number_format($percentageDifference, 2, ',', '.') }} %
                                </span>
                                <h5 class="description-header">{{ number_format($revenueDifference, 0, ',', '.') }} VNĐ</h5>
                                <span class="description-text">DOANH THU CHÊNH LỆCH THÁNG TRƯỚC</span>
                            </div>
                        </div>
                        <div class="col-sm-3 col-6">
                            <div class="description-block border-right">
                                <span class="description-percentage text-primary">
                                    <i class="fas fa-money-bill-wave"></i>
                                </span>
                                <h5 class="description-header">{{ number_format($currentMonthRevenue, 0, ',', '.') }} VNĐ</h5>
                                <span class="description-text">DOANH THU THÁNG HIỆN TẠI</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.end -->

      <div class="row">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header border-0">
                    <div class="d-flex justify-content-between">
                        <h3 class="card-title">Tỷ lệ thanh toán</h3>
                    </div>
                </div>
                <div class="card-body">
                    <div class="position-relative mb-4">
                        <canvas id="paymentMethodChart" height="200" style="width: 100%;"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.col-md-6 -->
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header border-0">
                    <div class="d-flex justify-content-between">
                        <h3 class="card-title">Biểu đồ thống kê doanh thu tháng theo năm</h3>
                    </div>
                </div>
                <div class="card-body">
                    <div class="d-flex">
                        <p class="d-flex flex-column">
                            <span class="text-bold text-lg">{{ number_format(array_sum($monthlySalesCurrentYear), 0, ',', '.') }} VNĐ</span>
                            <span>Bán hàng theo thời gian</span>
                        </p>
                        <p class="ml-auto d-flex flex-column text-right">
                            <span class="text-success">
                                <i class="fas fa-arrow-up"></i>
                                @php
                                    $previousYearTotalSales = array_sum($monthlySalesLastYear);
                                    $percentageDifference = $previousYearTotalSales != 0 ? number_format((array_sum($monthlySalesCurrentYear) - $previousYearTotalSales) / $previousYearTotalSales * 100, 2, ',', '.') : 'N/A';
                                    echo $percentageDifference;
                                @endphp
                                %
                            </span>
                            <span class="text-muted">Kể từ năm ngoái</span>
                        </p>
                    </div>
                    <!-- /.d-flex -->

                    <div class="position-relative mb-4">
                        <canvas id="sales-chart" height="200"></canvas>
                    </div>

                    <div class="d-flex flex-row justify-content-end">
                        <span class="mr-2">
                            <i class="fas fa-square text-primary"></i> Năm nay
                        </span>
                        <span>
                            <i class="fas fa-square text-gray"></i> Năm ngoái
                        </span>
                    </div>
                </div>
            </div>
            <!-- /.card -->
        </div>
        <!-- /.col-md-6 -->
      </div>

  </section>


  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script>
      document.addEventListener('DOMContentLoaded', function() {
          var salesCtx = document.getElementById('salesChart').getContext('2d');
          var salesChart = new Chart(salesCtx, {
              type: 'line',
              data: {
                  labels: @json(range(1, 12)),
                  datasets: [{
                      label: 'Doanh thu hàng tháng',
                      data: @json(array_values($monthlySales)),
                      borderColor: 'rgba(75, 192, 192, 1)',
                      borderWidth: 2,
                      fill: true,
                      backgroundColor: 'rgba(75, 192, 192, 0.2)',
                      tension: 0.4 // Tạo hiệu ứng sóng cho biểu đồ
                  }]
              },
              options: {
                  responsive: true,
                  maintainAspectRatio: false,
                  scales: {
                      y: {
                          beginAtZero: true
                      }
                  }
              }
          });

          var paymentMethodCtx = document.getElementById('paymentMethodChart').getContext('2d');
          var paymentMethodChart = new Chart(paymentMethodCtx, {
              type: 'doughnut',
              data: {
                  labels: @json($paymentMethods->keys()),
                  datasets: [{
                      data: @json($paymentMethods->values()),
                      backgroundColor: [
                          'rgba(255, 99, 132, 0.2)',
                          'rgba(54, 162, 235, 0.2)',
                          'rgba(255, 206, 86, 0.2)'
                      ],
                      borderColor: [
                          'rgba(255, 99, 132, 1)',
                          'rgba(54, 162, 235, 1)',
                          'rgba(255, 206, 86, 1)'
                      ],
                      borderWidth: 1
                  }]
              },
              options: {
                  responsive: true,
                  maintainAspectRatio: false
              }
          });
      });
  </script>
  <script>
 document.addEventListener('DOMContentLoaded', function () {
    var ctx = document.getElementById('sales-chart').getContext('2d');
    var salesChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Tháng 1', 'Tháng 2', 'Tháng 3', 'Tháng 4', 'Tháng 5', 'Tháng 6', 'Tháng 7', 'Tháng 8', 'Tháng 9', 'Tháng 10', 'Tháng 11', 'Tháng 12'],
            datasets: [
                {
                    label: 'Năm nay',
                    backgroundColor: 'rgba(60,141,188,0.9)',
                    borderColor: 'rgba(60,141,188,0.8)',
                    data: @json(array_values($monthlySalesCurrentYear))
                },
                {
                    label: 'Năm ngoái',
                    backgroundColor: 'rgba(210, 214, 222, 1)',
                    borderColor: 'rgba(210, 214, 222, 1)',
                    data: @json(array_values($monthlySalesLastYear))
                }
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            datasetFill: false,
            scales: {
                y: {
                    beginAtZero: true
                }
            },
            plugins: {
                datalabels: {
                    formatter: function(value, context) {
                        if (value === Infinity || value === -Infinity || isNaN(value)) {
                            return '';
                        }
                        return value;
                    }
                }
            }
        }
    });
});

</script>

@endsection

