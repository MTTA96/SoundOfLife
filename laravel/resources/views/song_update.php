<?php
    require_once("../entities/song.class.php");
?>

<html>
   
   <head>
      <title>Song Management | Edit</title>
      <link href='//fonts.googleapis.com/css?family=Lato:100' rel='stylesheet' type='text/css'>

		<style>
			body {
				margin: 0;
				padding: 0;
				width: 100%;
				height: 100%;
				color: #B0BEC5;
				display: table;
				font-weight: 100;
				font-family: 'Lato';
			}

			.container {
				text-align: center;
				display: table-cell;
				vertical-align: middle;
			}

			.content {
				text-align: center;
				display: inline-block;
			}

			.title {
				font-size: 96px;
				margin-bottom: 40px;
			}

			.quote {
				font-size: 24px;
			}

			label{
				margin-right:20px;
			}

			form{
				background:#f5f5f5;
				padding:20px;
				border-radius:10px;
			}

			input[type="submit"]{
				background:#0098cb;
				border:0px;
				border-radius:5px;
				color:#fff;
				padding:10px;
				margin:20px auto;
			}

		</style>
   </head>
   
   <body>
        <div class="container">
			<div class="content">
                <form action = "/edit/<?php echo $songs[0]->SONG_ID; ?>" method = "post">
                    <input type = "hidden" name = "_token" value = "<?php echo csrf_token(); ?>">
                
					<!-- Back to manage -->
                    <li>
                        <a href = "../song_list">Manage Songs</a>
                    </li><br>

                    <table>

                        <!-- Title -->
                        <tr>
                            <td>Song title</td>
                            <td><input type='SONG_TITLE' name='SONG_TITLE' value = '<?php echo$songs[0]->SONG_TITLE; ?>'/></td>
                        </tr>

                        <!-- Artist -->
                        <tr>
                            <td>Artist</td>
                            <td><input type='text' name='artist' value = '<?php echo$songs[0]->ARTIST; ?>'/></td>
                        </tr>

                        <!-- Desc -->
                        <tr>
                          <td>Desc</td>
                          <td><input type='text' name='txtDescr' value = '<?php echo$songs[0]->DESCR; ?>'/></td>
                        </tr>

                        <!-- Mp3 file --> 
                        <tr>
                            <td>Select song to update:</td>
                            <td>                      
                                <?php
                                    echo Form::open(array('url' => '/uploadfile','files'=>'true'));
                                    echo Form::file('song');
                                ?>
                            </td>
                        </tr>
                                    
                        <!-- Song img -->
                        <tr>
                            <td>Select image to update:</td>
                            <td>
                                <div>
                                    <img src="<?php echo "storage/songIMG/" .$songs[0]->SONG_IMGL_INK;?>" class="img-responsive" style="width:10%"/>
                                </div>
                            </td>
                            <td>                      
                                <?php
                                    echo Form::file('image');
                                    echo Form::close();
                                ?>
                            </td>
                        </tr>

                        <tr>
                        <td colspan = '2'>
                            <input type = 'submit' value = "Update song" />
                        </td>
                        </tr>
                    </table>
                
                </form>
            </div>
        </div>
   </body>
</html>