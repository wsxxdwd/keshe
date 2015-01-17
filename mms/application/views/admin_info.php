<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
    <meta charset="utf-8" />
    <title>用户信息--成员管理系统</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <meta content="wsxxdwdd@gmail.com" name="author" />
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <base href = "<?php echo base_url();?>"/> 
    <link href="./media/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
    <link href="./media/css/bootstrap-responsive.min.css" rel="stylesheet" type="text/css"/>
    <link href="./media/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
    <link href="./media/css/style-metro.css" rel="stylesheet" type="text/css"/>
    <link href="./media/css/style.css" rel="stylesheet" type="text/css"/>
    <link href="./media/css/uniform.default.css" rel="stylesheet" type="text/css"/>
    <!-- END GLOBAL MANDATORY STYLES -->
    <!-- BEGIN PAGE LEVEL STYLES -->
    <link rel="stylesheet" type="text/css" href="./media/css/select2_metro.css" />
    <link rel="stylesheet" href="./media/css/DT_bootstrap.css" />
    <!-- END PAGE LEVEL STYLES -->
    <link rel="shortcut icon" href="./media/image/favicon.ico" />
</head>
<body class="page-header-fixed">
    <!-- BEGIN CONTAINER -->
    <div class="page-container row-fluid">
        <!-- BEGIN PAGE -->
        <div class="page-content">
            <!-- BEGIN PAGE CONTAINER-->        
            <div class="container-fluid">
                <!-- BEGIN PAGE CONTENT-->
                <a href="./index.php/admin/do_logout" class="btn red" style="float:right;margin-bottom:10px;">登出</a>
                <div class="row-fluid">
                    <div class="span12">
                        <!-- BEGIN EXAMPLE TABLE PORTLET-->
                        <div class="portlet box blue">
                            <div class="portlet-title">
                                <div class="caption"><i class="icon-edit"></i>成员信息表</div>
                                <div class="tools">
                                    <a href="javascript:;" class="reload"></a>
                                </div>
                            </div>
                            <div class="portlet-body">
                                <div class="clearfix">
                                    <div class="btn-group">
                                        <button id="sample_editable_1_new" class="btn green">
                                        新增成员 <i class="icon-plus"></i>
                                        </button>
                                    </div>
                                    <div class="btn-group pull-right">
                                        <button class="btn dropdown-toggle" data-toggle="dropdown">选项 <i class="icon-angle-down"></i>
                                        </button>
                                        <ul class="dropdown-menu pull-right">
                                            <li><a>打印</a></li>
                                            <li><a>保存为PDF</a></li>
                                            <li><a>导出为Excel</a></li>
                                        </ul>
                                    </div>
                                </div>
                                <table class="table table-striped table-hover table-bordered" id="sample_editable_1">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>用户名</th>
                                            <th>名字</th>
                                            <th>性别(1:男,0:女)</th>
                                            <th>邮箱</th>
                                            <th>分组(1:管,2:后,3:前,4:设,5:产)</th>
                                            <th>motto</th>
                                            <th>描述</th>
                                            <th>联系电话</th>
                                            <th>qq</th>
                                            <th>状态(1:在团队,2:已毕业,3:离开)</th>
                                            <th class="sorting_disabled">编辑</th>
                                            <th class="sorting_disabled">删除</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                        foreach ($mem as $user) {
                                            $userid = $user["userid"];
                                            $username = $user["username"];
                                            $name = $user["name"];
                                            $motto = $user["motto"];
                                            $sex = $user["sex"];
                                            $description = $user["description"];
                                            $avatar = $user["avatar"];
                                            $qq = $user["qq"];
                                            $phone = $user["phone"];
                                            $email = $user["email"];
                                            $group = $user["groups"];
                                            $status = $user["status"];
                                            echo "<tr class=''>
                                                <td>$userid</td>
                                                <td>$username</td>
                                                <td>$name</td>
                                                <td>$sex</td>
                                                <td>$email</td>
                                                <td>$group</td>
                                                <td>$description</td>
                                                <td>$motto</td>
                                                <td>$phone</td>
                                                <td>$qq</td>
                                                <td>$status</td>
                                                <td><a class='edit' href='javascript:;'>Edit</a></td>
                                                <td><a class='delete' href='javascript:;'>Delete</a></td>
                                            </tr>";
                                        }
                                    ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- END EXAMPLE TABLE PORTLET-->
                    </div>
                </div>
                <!-- END PAGE CONTENT -->
            </div>
            <!-- END PAGE CONTAINER-->
        </div>
        <!-- END PAGE -->
    </div>
    <!-- END CONTAINER -->
    <!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
    <!-- BEGIN CORE PLUGINS -->
    <script src="media/js/jquery-1.10.1.min.js" type="text/javascript"></script>
    <script src="media/js/jquery-migrate-1.2.1.min.js" type="text/javascript"></script>
    <!-- IMPORTANT! Load jquery-ui-1.10.1.custom.min.js before bootstrap.min.js to fix bootstrap tooltip conflict with jquery ui tooltip -->
    <script src="media/js/jquery-ui-1.10.1.custom.min.js" type="text/javascript"></script>      
    <script src="media/js/bootstrap.min.js" type="text/javascript"></script>
    <!--[if lt IE 9]>
    <script src="media/js/excanvas.min.js"></script>
    <script src="media/js/respond.min.js"></script>  
    <![endif]-->   
    <script src="media/js/jquery.slimscroll.min.js" type="text/javascript"></script>
    <script src="media/js/jquery.blockui.min.js" type="text/javascript"></script>  
    <script src="media/js/jquery.cookie.min.js" type="text/javascript"></script>
    <script src="media/js/jquery.uniform.min.js" type="text/javascript" ></script>
    <!-- END CORE PLUGINS -->
    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <script type="text/javascript" src="media/js/select2.min.js"></script>
    <script type="text/javascript" src="media/js/jquery.dataTables.js"></script>
    <script type="text/javascript" src="media/js/DT_bootstrap.js"></script>
    <!-- END PAGE LEVEL PLUGINS -->
    <!-- BEGIN PAGE LEVEL SCRIPTS -->
    <script src="media/js/app.js"></script>
    <script src="media/js/table-editable.js"></script>    
    <script>
        jQuery(document).ready(function() {       
           App.init();
           TableEditable.init();
        });
    </script>
<script type="text/javascript">  var _gaq = _gaq || [];  _gaq.push(['_setAccount', 'UA-37564768-1']);  _gaq.push(['_setDomainName', 'keenthemes.com']);  _gaq.push(['_setAllowLinker', true]);  _gaq.push(['_trackPageview']);  (function() {    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;    ga.src = ('https:' == document.location.protocol ? 'https://' : 'http://') + 'stats.g.doubleclick.net/dc.js';    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);  })();</script></body>
<!-- END BODY -->
</html>