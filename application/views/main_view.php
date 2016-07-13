<!-- Page Heading -->
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            Dashboard <small>Statistics Overview</small>
        </h1>
        <ol class="breadcrumb">
            <li class="active">
                <i class="fa fa-dashboard"></i> Dashboard
            </li>
        </ol>
    </div>
</div>
<!-- /.row -->

<div class="row">
    <div class="col-md-12">

        <?php if(!$user){ ?>
            <p><a href="<?php echo $authFacebookLink ?>" class="btn btn-success">Login With Facebook</a></p>
        <?php } ?>


        <?php
        if($user){
            echo "<pre>";
            print_r($user);
            echo "</pre>";
        }

        echo "<br/>";

        echo $isLogged;
        ?>
    </div>
</div>