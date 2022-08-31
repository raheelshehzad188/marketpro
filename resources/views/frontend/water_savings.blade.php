@extends('frontend.layouts.app')

@section('content')


    <div class="d-block  packages-banner-area   bg-no-repeat  bg-cover bg-center lazyload"
        style="background-image: url('{{ static_asset('assets/img/placeholder.jpg') }}');"
        data-bg="{{ static_asset('assets/img/water-savings-banner.jpg') }}">
        <div class="container-fluid ps-0 pe-0">
            <div class="row position-relative">
                <div class="col-md-12 text-white text-shadow fw-800">
                    <img src="{{ static_asset('assets/img/placeholder.jpg') }}"
                        data-src="{{ static_asset('assets/img/water-savings-banner.jpg') }}"
                        class="w-100 lazyload invisible">
                    <div class="container text-center">
                        <div class="banner-content">
                            <h1 class=" lh-1-1 px-5 w-100">Better for You, Better for the Planet</h1>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>


    <section class="calculator py-sm-5 py-3">
        <div class="container space-1 space-1--lg">
            <div class="row justify-content-lg-between align-items-lg-center">
                <div class="col-lg-3 mb-9 mb-lg-0 mb-5">
                    <div class="fs-20 fw-600">Find Out How Much You Can Save </div>
                    <div class="fs-15 mt-3 mb-3">
                        Use our calculator to measure your impact on the world and your wallet
                        by switching to a water efficient garden.
                    </div>
                    <div class="form-group row g-0">
                        <div class="col-3">
                            <input type="number" onkeyup="drawChart()" class="form-control" name="lawnSize" value="1000"
                                id="lawnsizegraphvalue">
                        </div>
                        <label for="inputEmail3" class="col-9 col-form-label"> Square Feet of Your Lawn</label>
                    </div>
                    <div class="form-group row g-0">
                        <div class="col-3">
                            <input type="number" onkeyup="drawChart()" class="form-control" name="days" value="58"
                                id="daysgraphvalue">
                        </div>
                        <label for="inputEmail3" class="col-9 col-form-label">Days of Cycle In Your Last Water
                            Bill</label>
                    </div>

                    <div class="form-group row g-0">
                        <div class="col-3">
                            <input type="number" onkeyup="drawChart()" class="form-control" name="houseCCF" value="20"
                                id="houseccfgraphvalue">
                        </div>
                        <label for="inputEmail3" class="col-9 col-form-label"> CCF (Centum Cubit Feet) In Your Last
                            Water Bill</label>
                    </div>

                    <div class="form-group row g-0">
                        <div class="col-3">
                            <input type="number" onkeyup="drawChart()" class="form-control" name="billAmount" value="120"
                                id="billamountgraphvalue">
                        </div>
                        <label for="inputEmail3" class="col-9 col-form-label"> $ Amount Charged In Your Last Water
                            Bill</label>
                    </div>

                    <a href=""
                        class="btn btn-primary bg-2 text-white border-none fs-16 fw-600 mt-3 fm-bold hover-green">LEARN
                        MORE</a>
                </div>

                <div class="col-lg-9">
                    <div class="row">
                        <div class="col-md-6">
                            <div id="chart_div" class="w-100"></div>
                        </div>
                        <div class="col-md-6">
                            <div id="chart_div3" class="w-100"></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div id="chart_div2" class="w-100"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <section class="parallex home bg-no-repeat h-250px bg-cover bg-center lazyload"
        style="background-image: url('{{ static_asset('assets/img/placeholder.jpg') }}');"
        data-bg="{{ static_asset('assets/img/parallex.jpg') }}">
        <div class="inner-lay py-5">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-7 col-md-6 left">
                        <div class="row">
                            <div class="col-12 counters">
                                <span class="ff-ultra color-3 counter">31,020</span>
                                <span class="ff-bold color-3">sq ft</span>
                            </div>
                            <div class="col-12 counters">
                                <span class="ff-ultra color-4 counter">505,648</span>
                                <span class="ff-bold color-4">gal</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-5 col-md-6 right">
                        <div class="title text-white fw-600 text-end">Our Gardens Can Change the World!</div>
                        <div class="p text-white fs-18 text-end">The world is facing a major water crisis – Water
                            Efficient
                            Gardens is helping manage that. So far, we‘ve converted over 31,020 sq ft of lawn and barren
                            spaces to native and drought-tolerant landscaping that sustain and promote bees, birds and
                            butterflies. These garden transformations have saved more than half a million gallons of
                            water – and counting!</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="casestudy mt-5">
        <div class="container-fluid px-0">
            <div class="row">

                <div class="col-md-5">
                    <div class=" text-start h-100">
                        <div class="title after fs-20 py-4 px-5 fw-600">
                            CASE STUDY
                        </div>
                        <div class="fs-30 px-5 lh-1-2 mb-3">
                            Jerry’s Front &amp; Backyard Redesign
                        </div>


                        <div class="fs-16 ff-bold px-5">
                            Before
                        </div>
                        <div class="detail fs-16 mb-4  px-5 fw-500">
                            Jerry is a resident of Santa Clara, CA. He used to have grass lawns in both his front and
                            backyard (featured in the picture on the right). His front yard was about 800 sq ft and his
                            backyard was about 3000 sq ft.
                        </div>
                        <div class="fs-16 ff-bold px-5">
                            The Transformation
                        </div>
                        <div class="detail fs-16 mb-4 px-5 fw-500">
                            Jerry kept about 1/5 of his backyard as lawn; for his front yard and the 4/5 of backyard. He
                            wanted
                            to change to drought-tolerant landscaping. We designed a native and rain garden for both his
                            front
                            and back yard.
                        </div>
                    </div>
                </div>

                <div class="col-md-7">
                    <div class="bg-no-repeat bg-cover bg-center lazyload h-100"
                        style="background-image: url('{{ static_asset('assets/img/placeholder.jpg') }}');"
                        data-bg="{{ static_asset('assets/img/ws-before.jpg') }}">
                        <img src="{{ static_asset('assets/img/placeholder.jpg') }}" class="img-fluid lazyload invisible"
                            data-src="{{ static_asset('assets/img/ws-before.jpg') }}">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="casestudy mt-5">
        <div class="container-fluid px-0">
            <div class="row">
                <div class="col-md-7 order-2 order-md-1">
                    <div class="bg-no-repeat bg-cover bg-center lazyload h-100"
                        style="background-image: url('{{ static_asset('assets/img/placeholder.jpg') }}');"
                        data-bg="{{ static_asset('assets/img/ws-result.jpg') }}">
                        <img src="{{ static_asset('assets/img/placeholder.jpg') }}" class="img-fluid lazyload invisible"
                            data-src="{{ static_asset('assets/img/ws-result.jpg') }}">
                    </div>
                </div>
                <div class="col-md-5 order-1">
                    <div class=" text-end h-100">
                        <div class="title fs-20 py-4 ps-4 px-5 ff-bold">The Result</div>

                        <div class="detail fs-16 mb-4 ps-4 px-5 fw-500">
                            The gardens were installed Nov. 2020.
                            In 2021, the household water usage reduced by about 37% versus last year. In the hot summer
                            month of
                            June, the water usage was 43% less than last year.
                        </div>

                        <img src="{{ static_asset('assets/img/placeholder.jpg') }}" class="img-fluid my-1 px-5 lazyload"
                            data-src="{{ static_asset('assets/img/ws-state.jpg') }}">

                        <div class="detail fs-16 mb-4 ps-4 px-5 fw-500">
                            Jerry’s water report from June 2021.
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>


    <section class="bg-3 mt-5">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center mt-5 pt-5 pb-3">
                    <div class="section-heading fs-32  px-5">Build a Beautiful, Water Efficient Garden.</div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 text-center mb-5 pb-5">
                    <a href="" class="btn btn-primary  ff-bold fs-20 btn-rounded px-5">START YOUR PROJECT</a>
                </div>
            </div>
        </div>
    </section>


@endsection
@section('script')
    <script src="//cdnjs.cloudflare.com/ajax/libs/waypoints/4.0.1/jquery.waypoints.min.js"></script>
    <script src="{{ static_asset('assets/js/jquery.countup.min.js') }}"></script>
    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript">
        var lawnSize = 1000;
        var days = 58;
        var houseCCF = 20;
        var billAmount = 120
        var ccfGallon = houseCCF * 748;
        var lawn = lawnSize / 1000 * 623 * days / 7;
        var nonlawn = ccfGallon - lawn;
        var garden = (lawnSize / 1000 * 623 * days / 7) - (50 * days)
        var gardenAmount = (nonlawn + garden) * (billAmount / ccfGallon)


        google.load("visualization", "1", {
            packages: ["corechart"]
        });
        google.setOnLoadCallback(drawChart);

        function drawChart() {

            lawnSize = document.getElementById('lawnsizegraphvalue').value * 1;
            days = document.getElementById('daysgraphvalue').value * 1;
            houseCCF = document.getElementById('houseccfgraphvalue').value * 1;
            billAmount = document.getElementById('billamountgraphvalue').value * 1;
            ccfGallon = houseCCF * 748;
            lawn = lawnSize / 1000 * 623 * days / 7;
            nonlawn = ccfGallon - lawn;
            garden = ((623 / 7) - 50) * lawnSize * days / 1000
            gardenAmount = (nonlawn + garden) * (billAmount / ccfGallon)



            var data = google.visualization.arrayToDataTable([
                ['Type', 'Gallons', {
                    role: "style"
                }],
                ['Lawn', lawn, '#627378'],
                ['Water Efficient Garden', garden, '#1d9bcf'],
            ]);

            var data2 = google.visualization.arrayToDataTable([
                ['Type', 'Non-Garden/Lawn', 'Garden/Lawn', {
                    role: 'annotation'
                }],
                ['Lawn', nonlawn, lawn, ''],
                ['Water Efficient Garden', nonlawn, garden, '']
            ]);

            var data3 = google.visualization.arrayToDataTable([
                ['Type', '$Amount', {
                    role: 'style'
                }],
                ['Lawn', billAmount, '#627378'],
                ['Water Efficient Garden', gardenAmount, '#8dc54f']
            ]);

            var options = {
                title: 'Est. Water Use for Landscaping',
                titleTextStyle: {
                    color: 'black',
                    fontName: 'GothamBold',
                    fontSize: '17',
                },
                'legend': 'left',
                'chartArea': {
                    width: '70%'
                }
            };

            var options2 = {
                title: 'Est. Total Water Use for the Household',
                titleTextStyle: {
                    color: 'black',
                    fontName: 'GothamBold',
                    fontSize: '17',
                },
                isStacked: true,
                'chartArea': {
                    width: '70%'
                },
                series: {
                    0: {
                        color: '#627378'
                    },
                    1: {
                        color: '#1d9bcf'
                    },
                }
            };

            var options3 = {
                title: 'Est. $ Amount Charged',
                titleTextStyle: {
                    color: 'black',
                    fontName: 'GothamBold',
                    fontSize: '17',
                },
                'legend': 'left',
                'chartArea': {
                    width: '70%'
                }
            };

            var chartContainer1 = document.getElementById('chart_div');
            var chart = new google.visualization.BarChart(chartContainer1);
            google.visualization.events.addListener(chart, 'ready', function() {
                var labels = chartContainer1.getElementsByTagName('text');
                for (var i = 0; i < labels.length; i++) {
                    // determine if label should be bold
                    labels[i].setAttribute('font-family', 'Gotham');
                    labels[i].setAttribute('font-weight', '600');
                }
            });
            chart.draw(data, options);
            var chartContainer2 = document.getElementById('chart_div2');
            var chart2 = new google.visualization.BarChart(chartContainer2);
            google.visualization.events.addListener(chart2, 'ready', function() {
                var labels = chartContainer2.getElementsByTagName('text');
                for (var i = 0; i < labels.length; i++) {
                    // determine if label should be bold
                    labels[i].setAttribute('font-family', 'Gotham');
                    labels[i].setAttribute('font-weight', '600');
                }
            });
            chart2.draw(data2, options2);
            var chartContainer3 = document.getElementById('chart_div3');
            var chart3 = new google.visualization.BarChart(chartContainer3);
            google.visualization.events.addListener(chart3, 'ready', function() {
                var labels = chartContainer3.getElementsByTagName('text');
                for (var i = 0; i < labels.length; i++) {
                    // determine if label should be bold
                    labels[i].setAttribute('font-family', 'Gotham');
                    labels[i].setAttribute('font-weight', '600');
                }
            });
            chart3.draw(data3, options3);
        }

        $('.counter').countUp();
    </script>
@endsection
