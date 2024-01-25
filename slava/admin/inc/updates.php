<?php 
	if ( ! defined ( 'BLOCK' ) )
	{
		exit ( "
		<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" /> 
		<html>
			<head>
				<title>404 Not Found</title>
			</head>
			<body>
				<h1>Not Found</h1>
				<p>The requested URL was not found on this server.</p>
			</body>
		</html>" ); 
	}
    $query = $db->m_query( "SELECT * FROM `".DBcfg::$dbopt['db_prefix']."_updates` WHERE `id` = 1 LIMIT 1" );
		
	$date = $db->f_arr( $query );
		
    echo '<div class="col-md-12">
        <div class="box box-solid">
            <div class="box-header with-border">
                <i class="fa fa-refresh"></i> <h3 class="box-title">Система обновлений</h3>
            </div>
            <div class="box-body">
                <style>
                blockquote {
                    font-size: 13px;
                    margin: 0px;
                    padding-left: 10px;
                }
                h4 {
                    margin: 0px
                }
                hr {
                    margin-top: 10px;
                    margin-bottom: 10px;
                }
                up {
                    font-size: 16px
                }
                a {
                    cursor: pointer;
                }
                </style>
                <blockquote>
                    <up><b>Версия движка:</b> <span id="updates_version"><i class="fa fa-refresh fa-spin"></i></span></up>
                    <hr>
                    <span id="updates_desc" class="updates_desc"><i class="fa fa-refresh fa-spin"></i> Загрузка...</span>
                </blockquote>
            </div>
            <!-- /.box-body -->
            <!-- Loading --> 
            <div class="overlay" style="display: none">
                <i class="fa fa-refresh fa-spin"></i>
            </div>
            <!-- end loading -->
        </div>
        <!-- /.box -->
    </div>
    <!-- /.col -->';
?>