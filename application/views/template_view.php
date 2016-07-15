<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <title>Comments</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css">

    <link rel="stylesheet" href="/assets/css/sb-admin.css">
    <link rel="stylesheet" href="/assets/css/style.css">


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>



    <script src="/assets/js/script.js"></script>

</head>
<body>



<div id="wrapper">

    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.html">SB Admin</a>
        </div>
        <!-- Top Menu Items -->
        <ul class="nav navbar-right top-nav">
            <?php if($user){ ?>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?php echo $user['name']?> <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                    <li>
                        <a href="/main/logout/"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
                    </li>
                </ul>
            <?php } else{ ?>
                <li>
                    <a href="/main/logout/"><i class="fa fa-fw fa-power-off"></i> Sign In</a>
                </li>
            <?php } ?>
        </ul>
        <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
        <div class="collapse navbar-collapse navbar-ex1-collapse">
            <ul class="nav navbar-nav side-nav">
                <?php if(!$user){ ?>
                <li>
                    <a href="/"><i class="fa fa-facebook-square" aria-hidden="true"></i> Login</a>
                </li>
                <?php } ?>
                <li>
                    <a href="/comments"><i class="fa fa-comments-o" aria-hidden="true"></i> Comments</a>
                </li>
                <?php if($user){ ?>
                    <li>
                        <a href="/main/logout"><i class="fa fa-sign-out" aria-hidden="true"></i> Log Out</a>
                    </li>
                <?php } ?>
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </nav>

    <div id="page-wrapper">

        <div class="container-fluid">

            <?php include 'application/views/'.$content_view; ?>

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->


</body>
</html>