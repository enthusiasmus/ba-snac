<?php 
	//For puplishing on mediacube
	//set_include_path('/home/store/fhs33140/public_html/zend_framework/library');
	
	//general zend loader for loading every arbitrary plugin
	require_once 'Zend/Loader.php';
	Zend_Loader::loadClass('Zend_Gdata_YouTube');

	//create a new youtube instance
    $youtube = new Zend_Gdata_YouTube();
	
	//create a query from the comedy-channel
    $query = $youtube->newVideoQuery();
    $query->videoQuery = 'comedy';
	//$query->setTime('this_month');
	
	//define local variables 
	$counter = 0;
	//define global variables
	$duration = 0;
	$viewCount = 0;

	do{
		//get a random number between 0 and 999
		srand ((double) microtime( )*1000000);
		$random_number = rand(0,999);
		
		//search for 50 arbitrary video
	    $query->startIndex = $random_number;
	    $query->maxResults = 1;
	    $query->orderBy = 'viewCount';
	    
		//get all the queried videos we want
	    $videoFeed = $youtube->getVideoFeed($query);
		
		//get only the raw information from one exclusive video     
	    foreach ($videoFeed as $videoEntry){
	        printVideoEntry($videoEntry);
			if($duration <= 100 && $viewCount > 5000)
				break;
		}
		
		//exit when there is no video with our exclusive filters
		if($counter >= 1000){
			echo "Die Suchkriterien ergaben keine Treffer!";
			break;
		}
		$counter++;
	}while($duration > 150 || $viewCount < 5000);
	
	//here we check the array of videos for my choosen filters
	function printVideoEntry($videoEntry) 
	{
	  global $duration, $viewCount;
	  $duration = $videoEntry->getVideoDuration();
	  $viewCount = $videoEntry->getVideoViewCount();
	  
	  //when the filters apply the needed information about the video get print
	  if($duration <= 150 && $viewCount > 5000){
		  echo $videoEntry->getVideoId();
	  }
	}
?>