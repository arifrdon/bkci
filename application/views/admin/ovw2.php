<html>
<head>
        <title>Area range and line</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
        <?php $chart->printScripts(); ?>
        
</head>
    <body>
    <script type="text/javascript">
    $(function() {

        $.getJSON('http://www.highcharts.com/samples/data/jsonp.php?filename=aapl-c.json&callback=?', function(data) {
            // Create the chart
            <?php echo $chart->render('chart1'); ?>
        });

    });

            </script>
    </body>
</html>