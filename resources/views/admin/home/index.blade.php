@extends('layouts.admin')
@section('title', 'Bảng Thống Kê')
    @section('content')

      @if($errors->any())
      <ul class="alert alert-danger list-unstyled">
      @foreach($errors->all() as $error)
      <li>- {{ $error }}</li>
      @endforeach
      </ul>
      @endif


      <style>
        #chart-container {
            width: 100%;
            height: 100%;
        }
        .chart-container {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 500px; /* Chiều cao của biểu đồ */
    width: 100%; /* Chiều rộng của biểu đồ */
    margin: 0 auto; /* Căn giữa theo chiều ngang */
}
    </style>
    <div class="pagetitle">
      <h1>Bảng điều khiển</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{route('admin.home.index')}}">Home</a></li>
          <li class="breadcrumb-item active">Bảng điều khiển</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
    <div class="card">
        <div class="card-body">
            <h2>Biểu Đồ Doanh Thu</h2>
            <form action="{{ route('admin.home.index') }}" method="GET" id="revenueFilterForm">
                <div class="d-flex flex-row align-items-end">
                    <div class="p-2">
                        <label for="start-date" class="d-block">Ngày Bắt Đầu:</label>
                        <input type="date" id="from_date" class="form-control" name="start_date" value="{{ $fromDate ?? '' }}">
                    </div>
              
                    <div class="p-2">
                        <label for="end-date" class="d-block">Ngày Kết Thúc:</label>
                        <input type="date" id="to_date" class="form-control" name="end_date" value="{{ $toDate ?? '' }}">
                    </div>
              
                    <div class="p-2">
                        <button type="submit" class="btn btn-primary">Tìm Kiếm</button>
                    </div>
                    <div class="p-2">
                        <select class="form-control" name="filteroption" onchange="filterByOption(this)">
                            <option>--Chọn--</option>
                            <option value="lastweek">7 Ngày Qua</option>
                            <option value="lastmonth">Tháng Vừa Rồi</option>
                            <option value="nowmonth">Tháng Hiện Tại</option>
                            <option value="lastyear">365 Ngày Qua</option>
                        </select>
                        
                       
                    </div>
                   
        
                </div>
            </form>
           
            <!-- Hiển thị biểu đồ cột -->
            <div class="col-md-12">
                <div id="chart-container" class="chart-container" style="height: 700px;"></div>
                <hr> <!-- Đường ngang phân cách -->
                <div id="piechart" style="width: 600px; height: 300px;"></div>
            </div>
            <!-- Div để hiển thị biểu đồ tròn -->
        
        
            <script>
                document.addEventListener("DOMContentLoaded", function() {
                    var startDateInput = document.getElementById("from_date");
                    var endDateInput = document.getElementById("to_date");
            
                    // Khi ngày bắt đầu thay đổi, cập nhật ngày tối thiểu cho ngày kết thúc
                    startDateInput.addEventListener("change", function() {
                        endDateInput.setAttribute("min", startDateInput.value);
                        // Nếu ngày kết thúc hiện tại nhỏ hơn ngày bắt đầu mới, đặt lại ngày kết thúc
                        if (endDateInput.value < startDateInput.value) {
                            endDateInput.value = startDateInput.value;
                        }
                    });
                });
            </script>
        <!-- Include thư viện Google Charts -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
        
        <script type="text/javascript">
         google.charts.load('current', {'packages':['corechart']});
google.charts.setOnLoadCallback(drawChart);

function drawChart() {
    var revenueData = [];
    @if ($filterOption == 'lastyear')
        revenueData.push(['Tháng', 'Doanh Thu', { role: 'annotation' }]);

        @foreach($revenueData as $month => $revenue)
            revenueData.push(['Tháng {{ $month }}', {{ $revenue }}, '{{ number_format($revenue, 0, ',', '.') }}']);
        @endforeach
    @else
        revenueData.push(['Ngày', 'Doanh Thu', { role: 'annotation' }]);
        @foreach($revenueData as $date => $revenue)
            revenueData.push(['{{ \Carbon\Carbon::parse($date)->format('d/m') }}', {{ $revenue }}, '{{ number_format($revenue, 0, ',', '.') }}']);
        @endforeach
    @endif

    var data = google.visualization.arrayToDataTable(revenueData);
    var options = {
        title: 'Biểu Đồ Doanh Thu',
        curveType: 'function',
        legend: { position: 'bottom' },
        hAxis: {
            slantedText: false,
            showTextEvery: 1,
            maxAlternation: 1,
            minTextSpacing: 10,
            textStyle: {
                fontSize: 8
            },
        },
        chartArea: {
            width: '85%',
            height: '85%'
        },
        annotations: {
            textStyle: {
                fontSize: 12,
                color: 'black'
            },
            stem: {
                color: 'transparent'
            }
        }
    };


    var chart = new google.visualization.ColumnChart(document.getElementById('chart-container'));

    chart.draw(data, options);

    window.addEventListener('resize', resizeChart);

    function resizeChart() {
        chart.draw(data, {
            ...options,
            width: '100%',
            height: '100%'
        });
    }
}
        </script>
      <script type="text/javascript">
        google.charts.load('current', {'packages':['corechart']});
        google.charts.setOnLoadCallback(drawPieChart);
        
        function drawPieChart() {
            var data = new google.visualization.DataTable();
            data.addColumn('string', 'Month');
            data.addColumn('number', 'Quantity');
    
            @if ($filterOption == 'lastyear')
                data.addRows([
                    @foreach($productQuantities as $productName => $quantity)
                        ['Tên Sản Phẩm: {{ $productName }}', {{ $quantity }}],
                    @endforeach
                ]);
            @else
                data.addRows([
                    @foreach($productQuantities as $productName => $quantity)
                        ['{{ $productName }}', {{ $quantity }}],
                    @endforeach
                ]);
            @endif
    
            var options = {
                title: 'Số Lượng Sản Phẩm Bán Ra',
                is3D: true,
                pieSliceText: 'value', // Hiển thị giá trị thực tế trên các lát cắt của biểu đồ
                tooltip: {
                    text: 'value' // Đảm bảo tooltip hiển thị giá trị thực tế khi di chuột qua
                }
            };
    
            var chart = new google.visualization.PieChart(document.getElementById('piechart'));
            chart.draw(data, options);
    
            // Đáp ứng với thay đổi kích thước cửa sổ
            window.addEventListener('resize', function() {
                chart.draw(data, options);
            });
        }
    </script>
        <script>
            function filterByOption(select) {
                var option = select.value;
                var fromDate, toDate;
        switch (option) {
    case 'lastweek':
        fromDate = "{{ now()->subWeek()->startOfWeek()->toDateString() }}";
        toDate = "{{ now()->subWeek()->endOfWeek()->toDateString() }}";
        break;
    case 'lastmonth':
        fromDate = "{{ now()->subMonth()->startOfMonth()->toDateString() }}";
        toDate = "{{ now()->subMonth()->endOfMonth()->toDateString() }}";
        break;
    case 'nowmonth':
        fromDate = "{{ now()->startOfMonth()->toDateString() }}";
        toDate = "{{ now()->endOfMonth()->toDateString() }}";
        break;
    case 'lastyear':
        fromDate = "{{ now()->subYear()->startOfYear()->toDateString() }}";
        toDate = "{{ now()->subYear()->endOfYear()->toDateString() }}";
        break;
    // Thêm các trường hợp khác nếu cần
}
                
        
                // Cập nhật giá trị của các trường input
                document.getElementById('from_date').value = fromDate;
                document.getElementById('to_date').value = toDate;
        
                // Gửi form đi
                document.getElementById("revenueFilterForm").submit();
            }
        </script>
        </div>
        </div>

@endsection