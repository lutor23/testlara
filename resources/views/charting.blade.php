<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>My Charts</title>



        {!! Charts::assets() !!}

<?php


// print_r(Charts::types());

print_r(Charts::libraries('percentage'));

// Return all the libraries available for the line chart
// print_r(Charts::libraries('line'));

?>

    </head>
    <body>
        <center>
            {!! $chart->render() !!}



        </center>
    </body>
</html>