<!DOCTYPE html>

<html
    lang="fa"
    class="light-style layout-navbar-fixed layout-menu-fixed"
    dir="rtl"
    data-theme="theme-default"
    data-assets-path="/theme/vuexy/assets/"
    data-template="vertical-menu-template">

    <head>

        <meta charset="utf-8" />
        <meta
            name="viewport"
            content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
        <title>
            {{env('APP_NAME')}}
        </title>
        <meta name="robots" content="noindex, nofollow" />
        @include('admin.includes.style')
{{--        <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">--}}


    </head>



    <body>
        <div class="layout-wrapper layout-content-navbar">
            <div class="layout-container">
                @include('admin.includes.sidebar')

                <div class="layout-page">

                    @include('admin.includes.header')

                    <div class="content-wrapper">

                        <div class="container-xxl flex-grow-1 container-p-y">
                            <div class="row">
                                <div class="col-12 mb-4">
                                    <div class="card">
                                        <div class="card-content">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <h5 class="mb-0 text-center">
                                                            آمار بازدید
                                                        </h5>
                                                    </div>

                                                    <div class="col-12">
                                                        <canvas id="lineChart" class="chartjs" data-height="500"></canvas>

                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-4 col-12 mb-4">
                                    <div class="card">
                                        <h5 class="card-header">
                                            کشور ها
                                        </h5>
                                        <div class="card-body">
                                            <canvas id="doughnutChart" class="chartjs mb-4" data-height="350"></canvas>
                                            <ul class="doughnut-legend d-flex justify-content-around ps-0 mb-2 pt-1">
                                                <?php
                                                    $colors = [
                                                        0 => 'rgb(40, 208, 148)' ,
                                                        1 => 'rgb(253, 172, 52)' ,
                                                        2 => 'rgb(102, 110, 232)' ,
                                                    ];
                                                    $colorCount = 0 ;
                                                ?>

                                                @foreach($country as $item)
                                                    <li class="ct-series-0 d-flex flex-column">
                                                        <h5 class="mb-0">
{{--                                                            {{$item->code}} ({{$item->title}})--}}
                                                            {{$item->code}}
                                                        </h5>
                                                        <span
                                                            class="badge badge-dot my-2 cursor-pointer rounded-pill"
                                                            style="background-color: {{$colors[$colorCount]}}; width: 35px; height: 6px"></span>
                                                        <div class="text-muted">{{number_format(($item->countt / $countryTotalCount) * 100, 0)}} %</div>
                                                    </li>
                                                    <?php
                                                        $colorCount++;
                                                    ?>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-8 col-12 mb-4">
                                    <div class="card">
                                        <div class="card-content">
                                            <div class="card-body">
                                                <div class="table-responsive text-nowrap text-center">
                                        <table class="table ">
                                            <thead class="table">
                                            <tr>
                                                <th>کشور</th>
                                                <th>IP</th>
                                                <th>تاریخ و ساعت</th>
                                                <th>دستگاه</th>
                                            </tr>
                                            </thead>
                                            <tbody class="table-border-bottom-0">
                                            @if(count($view_logs) > 0)
                                                @foreach($view_logs as $item)
                                                    <tr>
                                                        <td>{{@$item->country->code}}</td>
                                                        <td>{{@$item->ip}}</td>
                                                        <td dir="ltr">{{\App\Util::toJalali(@$item->created_at , true)}}</td>
                                                        <td>{{@$item->device->title}}</td>
                                                    </tr>
                                                @endforeach
                                            @endif
                                            </tbody>
                                        </table>
                                    </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                        @include('admin.includes.footer')

                        <div class="content-backdrop fade"></div>
                    </div>

                </div>

            </div>



            <!-- Overlay -->
            <div class="layout-overlay layout-menu-toggle"></div>

            <!-- Drag Target Area To SlideIn Menu On Small Screens -->
            <div class="drag-target"></div>


        </div>

        @include('admin.includes.script')
{{--        <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>--}}
{{--        <script src="/theme/vuexy/assets/js/extended-ui-drag-and-drop.js"></script>--}}
        @yield('script')
        @foreach (['error', 'warning', 'success', 'info'] as $msg)
            @if(Session::has($msg))
                <script> message('{{ Session::get($msg) }}', '{{$msg}}');</script>
            @endif
        @endforeach
        @if ($errors->any())
            @foreach ($errors->all() as $error)
                <script> message('{{ $error }}', 'error', '');</script>
            @endforeach
        @endif


        <script>

            const purpleColor = '#836AF9',
                yellowColor = '#ffe800',
                cyanColor = '#28dac6',
                orangeColor = '#FF8132',
                orangeLightColor = '#FDAC34',
                oceanBlueColor = '#299AFF',
                greyColor = '#4F5D70',
                greyLightColor = '#EDF1F4',
                blueColor = '#2B9AFF',
                blueLightColor = '#84D0FF';

            let cardColor, headingColor, labelColor, borderColor, legendColor;

            if (isDarkStyle) {
                cardColor = config.colors_dark.cardColor;
                headingColor = config.colors_dark.headingColor;
                labelColor = config.colors_dark.textMuted;
                legendColor = config.colors_dark.bodyColor;
                borderColor = config.colors_dark.borderColor;
            } else {
                cardColor = config.colors.cardColor;
                headingColor = config.colors.headingColor;
                labelColor = config.colors.textMuted;
                legendColor = config.colors.bodyColor;
                borderColor = config.colors.borderColor;
            }

            const chartList = document.querySelectorAll('.chartjs');
            chartList.forEach(function (chartListItem) {
                chartListItem.height = chartListItem.dataset.height;
            });

            const lineChart = document.getElementById('lineChart');
            if (lineChart) {
                const lineChartVar = new Chart(lineChart, {
                    type: 'line',
                    data: {
                        labels: [
                            @foreach($data as $key => $val)
                                "{{$key}}",
                            @endforeach
                            // 0, 10, 20, 30, 40, 50, 60, 70, 80, 90, 100, 110, 120, 130, 140
                        ],
                        datasets: [
                            {
                                data: [
                                    // 80, 125, 105, 130, 215, 195, 140, 160, 230, 300, 220, 170, 210, 200, 280
                                    @foreach($data as $key => $val)
                                        "{{$val}}",
                                    @endforeach
                                ],
                                label: 'آمار بازدید',
                                borderColor: config.colors.primary,
                                tension: 0.5,
                                pointStyle: 'circle',
                                backgroundColor: config.colors.primary,
                                fill: false,
                                pointRadius: 1,
                                pointHoverRadius: 5,
                                pointHoverBorderWidth: 5,
                                pointBorderColor: 'transparent',
                                pointHoverBorderColor: cardColor,
                                pointHoverBackgroundColor: config.colors.primary
                            }
                        ]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        scales: {
                            x: {
                                grid: {
                                    color: borderColor,
                                    drawBorder: false,
                                    borderColor: borderColor
                                },
                                ticks: {
                                    color: labelColor
                                }
                            },
                            y: {
                                scaleLabel: {
                                    display: true
                                },
                                min: 0,
                                // max: 400,
                                ticks: {
                                    color: labelColor,
                                    stepSize: 100
                                },
                                grid: {
                                    color: borderColor,
                                    drawBorder: false,
                                    borderColor: borderColor
                                }
                            }
                        },
                        plugins: {
                            tooltip: {
                                // Updated default tooltip UI
                                rtl: isRtl,
                                backgroundColor: cardColor,
                                titleColor: headingColor,
                                bodyColor: legendColor,
                                borderWidth: 1,
                                borderColor: borderColor
                            },
                            legend: {
                                position: 'top',
                                align: 'start',
                                rtl: isRtl,
                                labels: {
                                    usePointStyle: true,
                                    padding: 35,
                                    boxWidth: 6,
                                    boxHeight: 6,
                                    color: legendColor
                                }
                            }
                        }
                    }
                });
            }



            const doughnutChart = document.getElementById('doughnutChart');
            if (doughnutChart) {
                const doughnutChartVar = new Chart(doughnutChart, {
                    type: 'doughnut',
                    data: {
                        labels: [
                            // 'Tablet', 'Mobile', 'Desktop'
                            @foreach($country as $item)
                            '{{$item->code}} ({{$item->title}})',
                            @endforeach
                        ],
                        datasets: [
                            {
                                data: [
                                    // 10, 10, 80
                                    @foreach($country as $item)
                                        {{number_format(($item->countt / $countryTotalCount) * 100, 0)}} ,
                                    @endforeach
                                ],
                                backgroundColor: [cyanColor, orangeLightColor, config.colors.primary],
                                borderWidth: 0,
                                pointStyle: 'rectRounded'
                            }
                        ]
                    },
                    options: {
                        responsive: true,
                        animation: {
                            duration: 500
                        },
                        cutout: '68%',
                        plugins: {
                            legend: {
                                display: false
                            },
                            tooltip: {
                                callbacks: {
                                    label: function (context) {
                                        const label = context.labels || '',
                                            value = context.parsed;
                                        const output = ' ' + label + ' : ' + value + ' %';
                                        return output;
                                    }
                                },
                                // Updated default tooltip UI
                                rtl: isRtl,
                                backgroundColor: cardColor,
                                titleColor: headingColor,
                                bodyColor: legendColor,
                                borderWidth: 1,
                                borderColor: borderColor
                            }
                        }
                    }
                });
            }
        </script>
    </body>




</html>
