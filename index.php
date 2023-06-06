<?php
require_once "app/init.php";

if(isset($_GET['q'])){
        $q = $_GET['q'];
        $query = $es->search([
            'body'=> [
                'query' => [
                    'bool' => [
                        'should' => [
                            [ 'match' => [ 'title' => $q ] ],
                            [ 'match' => [ 'body' => $q ] ],
                        ]
                    ]
                ]
            ]
        ]);

	if($query['hits']['total']["value"] >= 1){
		$results = $query['hits']['hits'];
    }
}
?>
<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Search | ElasticSearch Demo</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">    
   </head>
    <body>
    	<div class="row mt-3">
            <div class="mx-auto col-10 col-md-8 col-lg-6">
                <!-- We are setting method as GET for form post, so we can see the enered text in url -->
                <form action="<?=$_SERVER["PHP_SELF"]?>" method="GET" autocomplete="off">
                    <div class="row mb-3">
                        <div class="col">
                        <input type="text" class="form-control" name="q" placeholder="Enter text to Search Blog" />
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <input type="submit" class="btn btn-primary" value="Search" />
                        </div>
                    </div>
		</form>
		<?php
        if(isset($results)){
            foreach($results as $r){
    ?>
            <div class="row mb-3">
                <div class="col">
			<div class="alert alert-secondary" role="alert">
                        <p class="fw-bolder"><?=$r["_source"]["title"]?></p>
                        <?=implode(",",$r["_source"]["tags"])?>
                    </div>	
		</div>
            </div>
    <?php
            }
	}else{
	  echo '<div class="alert alert-danger" role="alert">
			No data found
		  </div>';
	}
    ?>
            </div>
        </div>
            <!-- We are going to skip validation checks -->
    </body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</html>
