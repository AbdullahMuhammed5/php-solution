<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="../public/css/bootstrap.css">
    <link rel="stylesheet" href="../public/css/jquery.dataTables.min.css">
    <style>
        body{
            background-color: #eaeaea;
        }
        .table{
            margin-top: 50px;
            background-color: white;
        }
        form{
            margin: 40px auto;
        }
    </style>

</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-sm-8">
                <form>
                    <div class="row">
                        <div class="col-sm-6">
                            <label for="country-ddl"></label>
                            <select name="country" class="form-control" id="country-ddl">
                                <option value="">Select Country</option>
                                <!-- Rest of option to be rendered with javascript via Ajax request -->
                            </select>
                        </div>
                        <div class="col-sm-6">
                            <label for="state-ddl"></label>
                            <select name="state" id="state-ddl" class="form-control">
                                <option value="1">Valid phone numbers</option>
                                <option value="0">Invalid phone numbers</option>
                            </select>
                        </div>
                    </div>
                </form>
                <table id="example" class="display table">
                    <thead>
                        <tr>
                            <td>Country</td>
                            <td>State</td>
                            <td>Country Code</td>
                            <td>Phone</td>
                        </tr>
                    </thead>
                </table>
            </div>
            <div class="col-sm-4"></div>
        </div>
    </div>

    <script src="../public/js/jquery-3.5.1.js"></script>
    <script src="../public/js/jquery.dataTables.min.js"></script>
    <script src="../public/js/app.js"></script>
</body>
</html>