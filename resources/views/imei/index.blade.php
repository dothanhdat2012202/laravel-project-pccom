<!DOCTYPE html>
<html lang="en">
<head>
    @include('head')
    <style>
        /* CSS cho bảng */
        table {
            border-collapse: collapse;
            width: 100%;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #dddddd;
            text-align: center;
            padding: 8px;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        th {
            border: 1px solid #dddddd; /* Xác định đường viền cho thẻ th */
        }
    </style>
</head>
<body class="account res layout-1 layout-subpage">
    <div id="wrapper" class="wrapper-fluid banners-effect-5">
        @include('header')
        <div class="main-container container">
            <ul class="breadcrumb">
                <li><a href="/"><i class="fa fa-home"></i> Trang chủ</a></li>
                <li><a href="/search_imei">{{ $title }}</a></li>
            </ul>
            <div class="row">
                <div id="content">
                    <h2 class="title" style="padding-left: 20px;">{{ $title }}</h2>
                    <h4 style="text-align: center;">Tra cứu imei/serial number</h4>
                    <div style="display: flex; justify-content: center; align-items: center;">
                        <input id="imei-input" type="text" style="padding: 8px; border: 1px solid #ccc; border-radius: 5px 0 0 5px; width: 500px;" placeholder="Điền số imei/serial number vào đây">
                        <button id="search-button" style="padding: 8px 15px; border: 1px solid #ff5e00; background-color: #ff5e00; color: #fff; border-radius: 0 5px 5px 0; cursor: pointer;">Tra cứu</button>
                    </div>
                    <div id="imei-info"></div> <!-- Thêm phần hiển thị thông tin IMEI -->
                </div>
            </div>
        </div>
        @include('footer')
    </div>
    <script>
   document.getElementById('search-button').addEventListener('click', function() {
    var imei = document.getElementById('imei-input').value;

    fetch('/get-imei-info', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({
            imei: imei
        })
    })
    .then(response => response.json())
    .then(data => {
        // Xử lý dữ liệu imeiInfo trả về từ server và hiển thị lên trang web
        console.log(data);

        // Hàm để thêm số 0 phía trước cho các số từ 1 đến 9
        function addLeadingZero(number) {
            return number < 10 ? '0' + number : number;
        }

        // Định dạng lại ngày thành dd/mm/yyyy
        var startDate = new Date(data.start_date);
        var endDate = new Date(data.end_date);
        var formattedStartDate = `${addLeadingZero(startDate.getDate())}/${addLeadingZero(startDate.getMonth() + 1)}/${startDate.getFullYear()}`;
        var formattedEndDate = `${addLeadingZero(endDate.getDate())}/${addLeadingZero(endDate.getMonth() + 1)}/${endDate.getFullYear()}`;

        // Tạo biến HTML chứa thông tin IMEI, Product Name, Start Date và End Date
        var tableContent = `
            <table>
                <tr>
                    <th>Tên sản phẩm</th>
                    <th>IMEI/Serial Number</th>
                    <th>Ngày bắt đầu bảo hành</th>
                    <th>Ngày hết hạn bảo hành</th>
                </tr>
                <tr>
                    <td>${data.product_name ? data.product_name : 'N/A'}</td>
                    <td>${data.imei}</td>
                    <td>${formattedStartDate}</td>
                    <td>${formattedEndDate}</td>
                </tr>
            </table>
        `;
        // Thêm biến HTML vào phần imei-info
        document.getElementById('imei-info').innerHTML = tableContent;
    })
    .catch(error => console.error('Error:', error));
});

    </script>
</body>
</html>
