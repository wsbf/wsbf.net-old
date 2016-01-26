<!DOCTYPE html>

<html lang="en">
    <head>
        <title>WSBF-FM Clemson | Charts</title>
        <?php include('views/fragments/styles.html'); ?>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <div id="wrapper">
            <!-- LazyJaxDavis start -->
            <div class="page-wrapper">
                <section class="banner">
                    <?php include('views/fragments/nav_main.php'); ?>
                </section>
                <section class="content" id="lazyjaxdavisroot">

                    <div class="container">
                        <div class="row">
                            <div class="col-md staff-wrapper">
                                <h2 class="page-head-2">Weekly Charts</h2>
                                <div class="chart-main">
                                    <div class="row">
                                        <div class="col-md-3 pull-left week-date"><h3><span>Thur. 07/19</span> - <span>Wed. 07/26</span></h3></div> 
                                        <div class="col-md-4 pull-right">
                                            <div class="dropdown pull-left">
                                                <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu3" data-toggle="dropdown">
                                                    jump to
                                                    <span class="caret"></span>
                                                </button>
                                                <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu3">
                                                    <li role="presentation"><a role="menuitem" tabindex="-1" href="#1">1 - 25</a></li>
                                                    <li role="presentation"><a role="menuitem" tabindex="-1" href="#25">25 - 50</a></li>
                                                    <li role="presentation"><a role="menuitem" tabindex="-1" href="#50">50 - 75</a></li>
                                                    <li role="presentation"><a role="menuitem" tabindex="-1" href="#75">75 - 100</a></li>
                                                </ul>
                                            </div>
                                            <div class="pull-right">
                                                <button class="prev-wk btn btn-sm">prev week</button>
                                                <button class="next-wk btn btn-sm" disabled>next week</button>
                                                <button class="curr-wk btn btn-sm" disabled>current</button>
                                            </div>
                                        </div> 
                                    </div>
                                    <div class="row tableDiv">
                                        <div class="col-md-9">
                                            <table class="table charts-table">
                                                <tr class="chart-table-head">
                                                    <th>Rank</th>
                                                    <th>Change</th>
                                                    <th>Plays</th>
                                                    <th>Album info</th>
                                                </tr>
                                            </table>
                                        </div>
                                        <div class="col-md-3">
                                            <table class="legend-table table table-bordered">
                                                <tr>
                                                    <th class="legend-head">
                                                        Chart Legend
                                                    </th>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <i class="fa fa-long-arrow-up"></i>
                                                        Position increased relative to last week
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <i class="fa fa-long-arrow-down"></i>
                                                        Position dropped relative to last week
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <i class="fa fa-minus"></i>
                                                        Position stayed the same relative to last week
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </section>
                <section id="footer">
                    <div class="overlay clearfix">
                        <?php include('views/fragments/footer.home.php'); ?>
                    </div>
                </section>
            </div>
            <!-- LazyJaxDavis end -->
        </div>

        <?php include('views/fragments/mediawidget.php'); ?>
        <?php include('views/fragments/page.dialog.html'); ?>


        <?php include('views/fragments/libraries.html'); ?>
        <script type="text/javascript">
            $(function(){
                loadChartsPage();
            });
        </script>
    </body>
</html>