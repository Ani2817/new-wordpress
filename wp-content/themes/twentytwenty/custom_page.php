<?php

/*

Template Name:custom-page
*/

if(isset($_GET['ajax']) && $_GET['ajax']==true)
{
  $loc = $_POST['lc'];
  $price = $_POST['prc'];
  $neighbour = $_POST['nbh'];
  $str_arr = array();

     $condition = array(
    "post_type"=>"post",
    "post_status"=>"publish",
    'tax_query' => array(
        array(
            'taxonomy' => 'neighborhood',
            'field'    => 'slug',
            'terms'    => $neighbour
        ),
        array(
            'taxonomy' => 'price',
            'field'    => 'slug',
            'terms'    => $price
        ),
        array(
            'taxonomy' => 'location',
            'field'    => 'slug',
            'terms'    => $loc
        ),

        'relation' => "OR"
    )
    );   
    $the_query = new WP_Query($condition);

    $cnt = 0;

    if($the_query->have_posts()){

        while($the_query->have_posts()){
             $the_query->the_post();
           // global $post;

            if($cnt == 3)
            {
              array_push($str_arr , "<li class='list_li'>".get_the_post_thumbnail($post->ID)."</li><br />");
              $cnt = 0;
            }
            else
            {
              array_push($str_arr , "<li class='list_li'>".get_the_post_thumbnail($post->ID)."</li>");
              // $str .= get_the_title()."<br /><br /><br />";
              $cnt++;
            }

        }

        wp_reset_postdata();// restore our original post data

          }

    $retData = json_encode($str_arr);

    if(empty($retData))
    {
      $retData = "NOT FOUND";
    }
    echo $retData;
}
else
{
?>
 <html>
    <head>
    	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
      <script src="https://pagination.js.org/dist/2.1.5/pagination.min.js"></script>
    
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
     <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    	<style >

        ul#pagination li {
          display:inline;
        }

        li.list_li
        {
          margin: 20px;
        }

    		.nav-links>li {
    			display: inline-block;
    			width: 33%;
    			
    		}
    		.nav-links li{
    			list-style-type: none;
    		}
    		.social-links li{
    			display: inline-block;
    			width: 24%;
    			list-style-type: none;

    		}
    		ul li ul.neighbour{
        display: none;
        position: absolute;
        z-index: 999;
        
        }
        ul li:hover ul.neighbour{
            display: block; /* Display the dropdown */
        }
        ul li ul.neighbour li{
            display: block;
        }
    		

    		.text-center{
    			margin-left: -600px;
    		}
    		.heading h1{
    			width:100%;
          text-shadow: 5px 5px 5px;

    		}

    		.display-block{
    			display:block;
    		}

        .fa {
          padding:  0px;
          font-size: 23px;
          width: 50px;
          text-align: center;
          text-decoration: none;
          margin: 5px 2px;
            }

          img {
            height: 250px;
            width: 250px;
          }
          .pagination {
            display: inline-block;
          }

          .pagination li {
            color: black;
            float: left;
            text-decoration: none;
          }

          .current {
            color: green;
          }

          #pagin li {
            display: inline-block;
            padding:7px;

          }

          #output {
            display: flex;
          }

          li {
            list-style: none;
          }

    	</style>

      <script type="text/javascript">

        var data_src = "";

        var neighbourhood = "";
        var price = "";
        var loc = "";

        function neighborhood_update(x){
          if(x.checked){
           neighbourhood=x.name;

          }
          request_ajax();
        }
        function price_update(x){
          if(x.checked){
           price=x.name;
          }
          request_ajax();
        }
        function loc_update(x){
          if(x.checked){
           loc=x.name;
          }
          request_ajax();
        }

        function request_ajax(){
                  var target = window.location.href + "?ajax=true";
                  //console.log(target);
                  var xhttp = new XMLHttpRequest();
                  xhttp.onreadystatechange = function() {
                  if (this.readyState == 4 && this.status == 200) {
                    var data = JSON.parse(this.responseText);
                    //console.log(data);
                    data_src = data;
                    update_pagination();
                  }
                };
                xhttp.open("POST", target, true);
                xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                xhttp.send("nbh="+neighbourhood+"&prc="+price+"&lc="+loc);
        }
      </script>

      <script>
        function update_pagination()
        {
          $('#pagin').pagination({
                dataSource: data_src,
                pageSize: 8,
                callback: function(data, pagination) {
                    // template method of yourself
                    var html = data;
                    dataContainer = $("#output")
                    dataContainer.html(html);
                }
            })
        }

      </script>
    </head>
    <body>
    <div>
    	<div class="row">
    		<div class="col-md-2">
              <a href="https://www.kw.com/" target="_blank">
          			<img style="width:150px;height:150px" src="<?php echo get_template_directory_uri()."/image/download.png" ?>" alt="download">
              </a>
          	</div>
          	<div class="col-md-10">
          		<div class="text-center heading">
          			<h1>Find New Home</h1>
          		</div>
          		<div class='row'>
          			<div class="col-md-8">
          				<ul class="nav-links">
          					<li>
          						<a>Neighborhood</a>
          						
          							<ul class="neighbour">
		          						<?php
		          							 $conn = new mysqli('localhost','root','','new-wordpress');
		          							 $type= 'neighborhood';
		          							 $qry="SELECT slug,term_id from wp_terms where term_id in (SELECT term_id from wp_term_taxonomy where taxonomy='$type')";
		          							
		          							if ($result = $conn -> query($qry)) {
		          								while ($row = mysqli_fetch_array($result)) { 
													echo "<li><input type='radio' name='".$row['slug']."' onclick='neighborhood_update(this)' value='".$row['term_id']."'>".$row['slug']."</li>";
		          								}
												  
												  // Free result set
												  $result -> free_result();
												}

												$conn -> close();
		          						?>

		          					</ul>
          						
          					</li>
          					<li>
          						<a>Price</a>
          						<div>
          							<ul class="neighbour">
		          						<?php
		          							 $conn = new mysqli('localhost','root','','new-wordpress');
		          							 $type= 'price';
		          							$qry="SELECT slug,term_id from wp_terms where term_id in (SELECT term_id from wp_term_taxonomy where taxonomy='$type')";
		          							
		          							if ($result = $conn -> query($qry)) {
		          								while ($row = mysqli_fetch_array($result)) { 
													echo "<li><input type='radio' name='".$row['slug']."' onclick='price_update(this)'  value='".$row['term_id']."'>".$row['slug']."</li>";
		          								}
												  
												  // Free result set
												  $result -> free_result();
												}

												$conn -> close();
		          						?>

		          					</ul>
          						</div>
          					</li>
          					<li>
          						<a>Location/City</a>
          						<div>
                        <ul class="neighbour">
          							
		          						<?php
		          							 $conn = new mysqli('localhost','root','','new-wordpress');
		          							 $type= 'location/city';
		          							$qry="SELECT slug,term_id from wp_terms where term_id in (SELECT term_id from wp_term_taxonomy where taxonomy='$type')";
		          							
		          							if ($result = $conn -> query($qry)) {
		          								while ($row = mysqli_fetch_array($result)) { 

													echo "<li><input type='radio' name='".$row['slug']."' onclick='loc_update(this)' value='".$row['term_id']."'>".$row['slug']."</li>";
		          								}
												  
												  // Free result set
												  $result -> free_result();
												}

												$conn -> close();
		          						?>

		          					</ul>
		          				
          						</div>
          					</li>
          				</ul>
          			</div>
          		<div class="col-md-4">
          				<ul class='social-links'>
          					<li><a href="https://www.facebook.com/" target="_blank" class="fa fa-facebook"></a></li>
          					<li><a href="https://www.youtube.com/" target="_blank" class="fa fa-youtube"></a></li>
          					<li><a href="https://www.pinterest.com/" target="_blank" class="fa fa-pinterest"></a></li>
                    <li><a href="https://www.twitter.com/" target="_blank" class="fa fa-twitter"></a></li>
          				</ul>
          			</div>
          		</div>
          	</div>
    	</div>
    	<div id="output">
    			</div>
    		</div>
    	</div>
    </div>
    <ul id="pagin">
         
</ul>
    </body>
    </html>
<?php

}
