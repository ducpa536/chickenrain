<!DOCTYPE html>

<html lang="vi">

<head>

    <?php echo $this->Html->charset(); ?>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>
      <?php echo $title_for_layout ?>
    </title>

    <!-- Bootstrap Core CSS -->
    <?php echo $this->Html->css('bootstrap') ?>
    <?php echo $this->Html->css('style') ?>
    <!-- Custom CSS -->
    <link href="css/stylish-portfolio.css" rel="stylesheet">


    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="http://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css">
    <?php
        echo $this->fetch('meta');
        echo $this->fetch('css');
        echo $this->fetch('script');
    ?>
</head>

<body>
    <!-- bat dau menuchinh -->
    <nav class="navbar navbar-inverse container mainmenu " role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">ChickenRain</a>
            </div>
    
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav">
                    <!-- <li><a href="#">Sách mới</a></li> -->
                    <li><?php echo $this->Html->link('Sách mới', 'sach-moi') ?></li>
                    <li><a href="#">Sách bán chạy</a></li>
                    <li><a href="#">liên hệ</a></li>
                </ul>
                    <!-- Form -->
                <ul class="nav navbar-nav navbar-right">
                    <?php 
                        echo $this->Form->Create('Book',  array(
                            'url' => array(
                                'action' => 'get_keyword',
                                'novalidate'=>true,
                            ),
                            'class' => 'navbar-form search',
                            'role' => 'search' 
                        ));

                    ?>
                    <div class="form-group">
                    <?php 
                        echo $this->Form->input(
                            'keyword', 
                            array(
                                'label' => '',
                                'type'=>'text',
                                'placeholder' => 'Gõ vào từ khóa tìm kiếm..',
                                'class' => 'form-control'
                            )
                        );
                    ?>
                    </div>
                    <?php echo $this->Form->end(); ?>
                </ul>
            </div><!-- /.navbar-collapse -->
        </div>
    </nav>
<!--     kết thúc menu chính -->
<!-- bắt đầu content -->
<div class="content container">
    <div class="row">
        <div class="col col-md-9">
            <?php echo $this->Session->flash(); ?>
            <?php echo $this->fetch('content'); ?>
        </div><!-- end col-9 -->

        <div class="col col-md-3">
            <div class="panel xinchao panel-default">
              <div class="panel-heading">
                    <h4 class="titleuser"><i class="glyphicon glyphicon-user"></i> 
                        <small>Xin chào <strong>Khách</strong></small>
                    </h4>
              </div>
              <div class="panel-body">
                  <p>Nhấn vào <a href="/login">đây</a> để đăng nhập <br/>
                    Nếu bạn chưa có tài khoản thì nhấn vào <a href="/dang-ky">đây</a> để đăng ký</p>
              </div>
            </div><!-- end panel -->
            <div class="panel giohang panel-info">
              <div class="panel-heading">
                  <h4 class="titlecart"><i class="glyphicon glyphicon-shopping-cart"></i> Giỏ hàng</h4>
              </div>
              <div class="panel-body">
                  <?php echo $this->element('cart'); ?>
              </div>
            </div><!-- end panel -->
            <div class="panel danhmuc panel-default">
              <div class="panel-heading">
                  <h4 class="titlelist"><i class="glyphicon glyphicon-th-list"></i> Danh mục sách</h4>
              </div>
              <div class="panel-body">
                    <!-- <?php echo $this->element('menu_categories') ?> -->
              </div>
            </div><!-- end panel -->

        </div><!-- end col-3  -->
    </div><!-- END ROW LON -->
</div>
<!-- kết thúc content -->

    <!-- jQuery -->

    <?php echo $this->Html->script('jquery')?>
    <!-- Bootstrap Core JavaScript -->
    
    <?php echo $this->Html->script('bootstrap') ?>
    <!-- Custom Theme JavaScript -->
    <?php echo $this->Html->script('main')?>
</body>

</html>
