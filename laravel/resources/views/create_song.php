<html>

   <head>
      <title>Song Management | Add</title>
		
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

                <form action = "/create" method = "post" enctype="multipart/form-data">
                    <input type = "hidden" name = "_token" value = "<?php echo csrf_token(); ?>">
                    <table>
                        <!-- Title -->
                        <tr>
                        <td>Song title</td>
                        <td><input type='text' name='song_title' /></td>
                        </tr>

                        <!-- Artist -->
                        <tr>
                        <td>Artist</td>
                        <td><input type='text' name='artist' /></td>
                        </tr>

                        <!-- Desc -->
                        <tr>
                        <td>Desc</td>
                        <td><input type='text' name='txtDescr' /></td>
                        </tr>

						<!-- Mp3 file -->


                        <!-- Song img -->
                        <tr>
                            <td>Select image to upload:</td>
                            <td>                      
                                <?php
                                    echo Form::open(array('url' => '/uploadfile','files'=>'true'));
                                    echo Form::file('image');
                                    echo Form::close();
                                ?>
                            </td>
                        </tr>

                        <tr>
                        <td colspan = '2'>
                            <input type = 'submit' value = "Add song"/>
                        </td>
                        </tr>
                    </table>

                        
                        
                </form>
   
            </div>
		</div>
	</body>
</html>

