<?php
    require_once "app/init.php";

    if(!empty($_POST)){
        if(isset($_POST["title"]) && isset($_POST["body"]) && isset($_POST["tags"])){
            $title = $_POST["title"];
            $body = $_POST["body"];
            $tags = explode("," , $_POST["tags"]);

            $indexed = $es->index([
                "index" => "blog",
                "title" => $title,
                "body" => [
                    'title' => $title,
                    'body' => $body,
                    'tags' => $tags 
                ]
            ]);

            if($indexed){
                echo '<div class="alert alert-success mt-3 mb-3" role="alert">
                        Document inserted successfully!
                      </div>';
            }
        }
    }
?>
<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Create | ElasticSearch Demo</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous"> 
   </head>
    <body>
	<div class="row mt-3">
	  <div class="mx-auto col-10 col-md-8 col-lg-6">
        <!-- We are setting method as GET for form post, so we can see the enered text in url -->
        <form action="<?=$_SERVER["PHP_SELF"]?>" method="POST" autocomplete="off">
            <div class="row mb-3">
  		<div class="col">
                	<input type="text" name="title" class="form-control" placeholder="Enter Title" />
		</div>
	    </div>
            <div class="row mb-3">
  		<div class="col">
                	<textarea name="body" rows="8" class="form-control" placeholder="Enter Body content"></textarea>
            	</div>
	    </div>
            <div class="row mb-3">
  		<div class="col">
                	<input type="text" name="tags" class="form-control" placeholder="Enter comma separated Tags" />
            	</div>
	    </div>    
	   <div class="row mb-3">
  		<div class="col">
                	<input type="submit" class="btn btn-primary"  value="Create" />
            	</div>
	   </div>
	</form>
	</div>
	</div>
	<!-- We are going to skip validation checks -->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    </body>
</html>
