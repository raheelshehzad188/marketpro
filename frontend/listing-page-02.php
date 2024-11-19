<?php include 'top.php' ?>

<div class="body">
    <!-- 
				<header id="header" data-plugin-options="{'stickyEnabled': false, 'stickyEnableOnBoxed': false, 'stickyEnableOnMobile': false, 'stickyStartAt': 135, 'stickySetTop': '-135px', 'stickyChangeLogo': false}">
				<div class="header-body box-shadow-none" data-sticky-header-style="{'minResolution': 0}" data-sticky-header-style-active="{'background-color': '#F4F4F4'}" data-sticky-header-style-deactive="{'background-color': '#FFF'}">
			-->
    <?php include 'header.php' ?>


    <div role="main" class="main">






        <section class="page-header ">
            <div class="container">
                <div class="row align-items-center">

                    <div class="col">
                        <div class="row">
                            <div class="col-md-12 align-self-center order-1">
                                <ul class="breadcrumb d-block appear-animation animated fadeIn appear-animation-visible">
                                    <li><a href="#">Home</a></li>
                                    <li><a href="#">Cross parts </a></li>
                                    <li><a href="#"> Chassis</a></li>
                                    <li><a href="#"> Brake pedals</a></li>
                                </ul>
                                <h2 class="page-title">Helmets</h2>
                                <div class="top-categories">
                                    <ul>
                                        <li><a href="#">Cross helmets</a></li>
                                        <li><a href="#">Accessories Helmets</a></li>
                                    </ul>
                                </div>
                                <div class="filters">

                                    <button class="btn btn-filter" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasWithBothOptions" aria-controls="offcanvasWithBothOptions"> Filter <i class="fa-solid fa-align-left"></i></button>


                                    <div class="offcanvas offcanvas-start" data-bs-scroll="true" tabindex="-1" id="offcanvasWithBothOptions" aria-labelledby="offcanvasWithBothOptionsLabel">
                                        <div class="offcanvas-header">
                                            <h5 class="offcanvas-title font-weight-bold letter-space-2" id="offcanvasWithBothOptionsLabel">Filter</h5>
                                            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>

                                        </div>
                                        <div class="offcanvas-body">



                                            <div class="accordion accordion-flush filter-items" id="accordionFlushExample">


                                                <div id="tree">

                                                </div>


                                            </div>




                                            <div class="bottom-offcanv">
                                                <div class="filter-result"> 303 products - 2 active filters</div>
                                                <div class="filter-rest"><button class="btn-reset">Rest</button></div>
                                                <div class="filter-submmit">
                                                    <button class="btn-submit">Use & close</button>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
        </section>

        <?php include 'widgets/product-list.php' ?>





        <?php include 'widgets/instagram.php' ?>



    </div>

    <?php include 'footer.php' ?>
</div>

<?php include 'bottom.php' ?>

<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

<script src="js/bstreeview.js"></script>
<script>
    $(function() {

        var json = [{
                text: "TYRES",
                nodes: [{
                        text: "GIBSON TECH 6.2 Rear Enduro FIM Soft",
                        nodes: [{
                                text: "Inner"
                            },
                            {
                                text: "Inner"
                            }
                        ]
                    },
                    {
                        text: "GIBSON TECH 9.1 Front Tyre",
                        nodes: [{
                                text: "Inner"
                            },
                            {
                                text: "Inner"
                            }
                        ]
                    },
                    {
                        text: "GIBSON TECH 7.1 Rear enduro tyre",
                        nodes: [{
                                text: "Inner"
                            },
                            {
                                text: "Inner"
                            }
                        ]
                    },
                    {
                        text: "GIBSON MX 5.1 Rear Tyre",
                        nodes: [{
                                text: "Inner GIBSON MX 5.1 Rear Tyre"
                            },
                            {
                                text: "Inner GIBSON MX 5.1 Rear Tyre"
                            }
                        ]
                    },
                    {
                        text: "GIBSON MX 4.1 Rear Tyre",
                        nodes: [{
                                text: " Inner GIBSON MX 4.1 Rear Tyre"
                            },
                            {
                                text: " Inner GIBSON MX 4.1 Rear Tyre"
                            }
                        ]
                    },
                    {
                        text: "Gibson® MX 3.1 Rear Tyre",
                        nodes: [{
                                text: "Inner Gibson® MX 3.1 Rear Tyre"
                            },
                            {
                                text: "Inner Gibson® MX 3.1 Rear Tyre"
                            }
                        ]
                    },
                    {
                        text: "GIBSON TECH 6.1 Enduro FIM Rear",
                        nodes: [{
                                text: "Inner GIBSON TECH 6.1 Enduro FIM Rear"
                            },
                            {
                                text: "Inner GIBSON TECH 6.1 Enduro FIM Rear"
                            }
                        ]
                    },
                    {
                        text: "Gibson® MX 1.1 Front tyre",
                        nodes: [{
                                text: "Inner Gibson® MX 1.1 Front tyre"
                            },
                            {
                                text: "Inner Gibson® MX 1.1 Front tyre"
                            }
                        ]
                    },

                    {
                        text: "Others"
                    }
                ]
            },
            {
                text: "TM ORIGINAL SPAREPARTS",
                nodes: [{
                        text: "Inner"
                    },
                    {
                        text: "Inner"
                    }
                ]
            },
            {
                text: "VROOAM OIL",
                nodes: [{
                        text: "Inner"
                    },
                    {
                        text: "Inner"
                    }
                ]
            },
            {
                text: "SCALVINI PIPES AND SILENCERS",
                nodes: [{
                        text: "Inner"
                    },
                    {
                        text: "Inner"
                    }
                ]
            },
            {
                text: "GIBSON TYRES",
                nodes: [{
                        text: "Inner"
                    },
                    {
                        text: "Inner"
                    }
                ]
            },
            {
                text: "MECA SYSTEM PROTECTORS",
                nodes: [{
                        text: "Inner"
                    },
                    {
                        text: "Inner"
                    }
                ]
                //class: "text-info",
                //  href: "https://google.com"
            }
        ];

        $('#tree').bstreeview({
            data: json,
            expandIcon: 'fa fa-minus fa-fw',
            collapseIcon: 'fa fa-plus fa-fw',
            indent: 1.25,
            parentsMarginLeft: '1.25rem',
            openNodeLinkOnNewTab: true
        });
    });
</script>
</body>

</html>