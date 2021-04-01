<?php
$url = 'https://api.themoviedb.org';
$collection_name = '3/movie/top_rated?api_key=5ac2a5685f512d8bfdeec30d78ee9d8f&language=en-US&page=1';
$request_url = $url . '/' . $collection_name;

$curl = curl_init($request_url);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

$response = curl_exec($curl);
curl_close($curl);

$top_rated_raw_data = json_decode($response,true);

$collection_name2 = '3/movie/upcoming?api_key=5ac2a5685f512d8bfdeec30d78ee9d8f&language=en-US&page=1';
$request_url2 = $url . '/' . $collection_name2;

$curl2 = curl_init($request_url2);
curl_setopt($curl2, CURLOPT_RETURNTRANSFER, true);

$response2 = curl_exec($curl2);
curl_close($curl2);


$upcoming_raw_data = json_decode($response2,true);

?>



<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel = "stylesheet" type = "text/css" href = "css/bootstrap.min.css">
	<script src = "https://code.jquery.com/jquery-3.4.0.min.js"></script>
	<script src = "js/bootstrap.min.js"></script>
	  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

<style>

.top-movie-wrap {
    display: flex;
    flex-wrap: wrap;
}

.top-heading{
    text-align: center;
    font-size: 25px;
    margin-bottom: 30px;
}

p.movie-name {
    width: 100%;
    text-overflow: ellipsis;
    overflow: hidden;
    white-space: nowrap;
    font-weight: 600;
    padding: 5px;

}

.top-movie {
    margin-right: 0px;
    width: 16%;
    padding: 10px;

}

.upcoming-movie {
    margin-right: 0px;
    width: 16%;
    padding: 10px;

}

.upcoming-movie-wrap {
    display: flex;
    flex-wrap: wrap;
}

img.movie-photo {
    border-radius: 5px;
}

.on-page-search {
width: 50%;
font-size: 14px;
line-height: 26px;
color: #787d85;
background-color: #fcfcfc;
border: 1px solid #e0e1e1;
padding: 10px 15px;
margin-left: 100px;

}

/* Style the list */
.demo-links {
border-bottom: none;
padding: 5px 5px;
line-height: 36px;
}

/* Style the results */
.results {
background: #de1919;
color: white;
}
.results:hover {
background: #333;
color: white;
}

.navbar-nav {
	flex-direction: row !important;

}

.navbar-default .navbar-nav>.active>a, .navbar-default .navbar-nav>.active>a:focus, .navbar-default .navbar-nav>.active>a:hover{
	color: #fff !important;
	background-color: #680d0d !important;
</style>
</head>
<body>
	
	
	<div class = "container-fluid">
		<div class = "row">
			<div class = "col-lg-12 col-md-12 col-xs-12">
				<nav class="navbar navbar-default">
					<div class="container-fluid">
						<div class="navbar-header">
						  <a class="navbar-brand" href="#">Demo@NUMI</a>
						</div>
						<ul class="nav navbar-nav">
						  <li class="active"><a href="#">Movies</a></li>
						  <li><a href="#">Page 1</a></li>
						  <li><a href="#">Page 2</a></li>
						  <li><form name="f1" id="f1" style = "margin-top: 11px;" action=""><input type="text" class="t1" style = "height: 30px; border-radius: 4px; margin-left: 50px;" name="t1" value="the" /><input style = "height: 30px; border-radius: 4px;" type="submit" name="b1" value="Find" /></li>
						</ul>
					</div>
				</nav>
				<div class = "heading">
					<h3 class = "top-heading">Top Rated Movies</h3> 
					<div class = "top-movie-wrap">
						<?php for($i = 0; $i < count($top_rated_raw_data['results']); $i++) {?>
							<div class = "top-movie">
								<img class = "movie-photo" src = "https://www.themoviedb.org/t/p/w220_and_h330_face<?= $top_rated_raw_data['results'][$i]['poster_path']; ?>"/>
								<p class = "movie-name"><?= $top_rated_raw_data['results'][$i]['title']; ?></p>
							</div>
						<?php } ?>
					</div>
				</div>
				<div class = "heading">
					<h3 class = "top-heading">Upcoming Movies</h3>
					<div class = "upcoming-movie-wrap"> 
						<?php for($i = 0; $i < count($upcoming_raw_data['results']); $i++) {?>
							<div class = "upcoming-movie">
								<img class = "movie-photo" src = "https://www.themoviedb.org/t/p/w220_and_h330_face<?= $upcoming_raw_data['results'][$i]['poster_path']; ?>"/>
								<p class = "movie-name"><?= $upcoming_raw_data['results'][$i]['title']; ?></p>
							</div>    
						<?php } ?>
					</div>    
				</div>
			</div>    
		</div>
	</div>

<script>	
var TRange = null;

function findString(str) {
    if (parseInt(navigator.appVersion) < 4) return;
    var strFound;
    if (window.find) {
        // CODE FOR BROWSERS THAT SUPPORT window.find
        strFound = self.find(str);
        if (strFound && self.getSelection && !self.getSelection().anchorNode) {
            strFound = self.find(str)
        }
        if (!strFound) {
            strFound = self.find(str, 0, 1)
            while (self.find(str, 0, 1)) continue
        }
    } else if (navigator.appName.indexOf("Microsoft") != -1) {
        // EXPLORER-SPECIFIC CODE        
        if (TRange != null) {
            TRange.collapse(false)
            strFound = TRange.findText(str)
            if (strFound) TRange.select()
        }
        if (TRange == null || strFound == 0) {
            TRange = self.document.body.createTextRange()
            strFound = TRange.findText(str)
            if (strFound) TRange.select()
        }
    } else if (navigator.appName == "Opera") {
        alert("Opera browsers not supported, sorry...")
        return;
    }
    if (!strFound) alert("String '" + str + "' not found!")
        return;
};

document.getElementById('f1').onsubmit = function() {
    findString(this.t1.value);
    return false;
};
</script>
</body>
</html>	