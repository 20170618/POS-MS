<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">

        <title>Point of Sale Migui's Store</title>


        <!-- <link href="../../../css/bootstrap.css" rel="stylesheet">    -->
        <style>
           /* devanagari */
           @font-face {
            font-family: 'Poppins';
            font-style: normal;
            font-weight: 400;
            src: url(https://fonts.gstatic.com/s/poppins/v15/pxiEyp8kv8JHgFVrJJbecmNE.woff2) format('woff2');
            unicode-range: U+0900-097F, U+1CD0-1CF6, U+1CF8-1CF9, U+200C-200D, U+20A8, U+20B9, U+25CC, U+A830-A839, U+A8E0-A8FB;
            }
            /* latin-ext */
            @font-face {
            font-family: 'Poppins';
            font-style: normal;
            font-weight: 400;
            src: url(https://fonts.gstatic.com/s/poppins/v15/pxiEyp8kv8JHgFVrJJnecmNE.woff2) format('woff2');
            unicode-range: U+0100-024F, U+0259, U+1E00-1EFF, U+2020, U+20A0-20AB, U+20AD-20CF, U+2113, U+2C60-2C7F, U+A720-A7FF;
            }
            /* latin */
            @font-face {
            font-family: 'Poppins';
            font-style: normal;
            font-weight: 400;
            src: url(https://fonts.gstatic.com/s/poppins/v15/pxiEyp8kv8JHgFVrJJfecg.woff2) format('woff2');
            unicode-range: U+0000-00FF, U+0131, U+0152-0153, U+02BB-02BC, U+02C6, U+02DA, U+02DC, U+2000-206F, U+2074, U+20AC, U+2122, U+2191, U+2193, U+2212, U+2215, U+FEFF, U+FFFD;
            }

           body {
            margin: 0;
            font-family: 'Poppins', sans-serif;
            font-size: 1.1rem;
            font-weight: 400;
            line-height: 1.5;
            color: #343a40;
            background-color: white;
            }

            .button {
            background-color:#008CBA;
            border: none;
            color: white;
            padding: 15px 32px;
            text-align: right;
            text-decoration: none;
            font-size: 16px;
            border-radius: 8px;
            display:inline-block;
            overflow: auto;
            white-space: nowrap;
            }

            th, td {
            padding: 15px;
            text-align: left;
            }
            table {

            border-collapse: collapse;
            width: 100%;
            }

            table td, table th {
            border: 1px solid #ddd;
            padding: 8px;
            }

            table tr:nth-child(even){background-color: #f2f2f2;}

            table tr:hover {background-color: #ddd;}

            table th {
            padding-top: 12px;
            padding-bottom: 12px;
            text-align: left;
            background-color: grey;
            color: white;
            }

            a {
            color: #ffffff;
            text-decoration: none;
            }

            .container,
            .container-fluid,
            .container-xl,
            .container-lg,
            .container-md,
            .container-sm {
            width: 80%;
            padding-right: 15px;
            padding-left: 15px;
            margin-right: auto;
            margin-left: auto;
            }



       </style>

    
    </head>

    <body>

        <div style="container-lg">
                <br>
                <h1 style="text-align:center">Migui's Store Report</h1>

                        <table style="table table-bordered mb-5">
                            <thead>
                                <tr>
                                    <th scope="col">Product name</th>
                                    <th scope="col">Category</th>
                                    <th scope="col">Stock remaining</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $d)
                                <tr>
                                    <td>{{$d->ProductName}}</td>
                                    <td>{{$d->Category}}</td>
                                    <td>{{$d->Stock}}</td>
                                  
                                </tr>
                                    
                                @endforeach

                                

                            </tbody>

                        </table>

        </div>


    </body>
</html>
