<!DOCTYPE html>
<html>
<head>
<title> Ninja | G5</title>

<link rel="shortcut icon" href="/g5quality_2.0/favicon.ico">

<!-- need to change source path when moving into production -->
<script src= "/g5quality_2.0/AJAXsubmit.js" type = "text/javascript"> </script>
<script src= "/g5quality_2.0/demo_only.js" type = "text/javascript"> </script>

<!-- start: CSS -->
    <link href="/g5quality_2.0/assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="/g5quality_2.0/assets/css/style.css" rel="stylesheet">
    <link href="/g5quality_2.0/assets/css/retina.min.css" rel="stylesheet">
    <link href="/g5quality_2.0/assets/css/print.css" rel="stylesheet" type="text/css" media="print"/>
    <link href="/g5quality_2.0/assets/css/customstyle.css" rel="stylesheet">

        <style>
            input:focus { 
            outline:none;
            border-color:#78cd51;
            box-shadow:0 0 13px #00FF00;
            -webkit-border-radius: 4px;
            -moz-border-radius: 4px;
            border-radius: 4px;
            }
        
        .btnsub {
            border: none;
            -webkit-border-radius: 2px;
            -moz-border-radius: 2px;
            border-radius: 2px;
            text-shadow: none;
            padding-bottom: 6px;
            padding-top: 6px;
            padding-right: 7px;
            background: #34383C;
            color: #e9ebec;
          }
          .btnsub:hover {color: #34383C; background-color: #78CD51;}
	  .btnsub.active {
            color: #34383C;
            background-color: #78CD51;
          }
        
        </style>

<!-- end: CSS -->
    
    <!-- jquery and javascript -->
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <script src="/g5quality_2.0/assets/js/respond.min.js"></script>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
    <script type="text/javascript" src="/g5quality_2.0/assets/js/searchjava.js"></script>
    <script type="text/javascript" src="/g5quality_2.0/FormConstraint.js"></script>

    
</head>
<body>
    <header class="navbar">
        <div class="container">
            <a href="../" id="main-menu-toggle" ><i><img style="width:26px;"  src="/g5quality_2.0/Temple_Icon.png"></i></a>
            
			<!-- start header Menu -->
			
			<div class="nav-no-collapse header-nav" >
				<ul class="nav navbar-nav pull-left" style="padding-left: 25px; ">
					<li class="dropdown hidden-xs">
						<a style="width:90px;" class="btn dropdown-toggle" target="_blank" href="https://g5.jiveon.com/thread/2515" >
							<i class="fa fa-comment" >&nbsp comments</i>
						</a>
					</li>
				</ul>
				
				<ul class="nav navbar-nav pull-left">
					<li class="dropdown hidden-xs">
						<a style="width:90px;" class="btn dropdown-toggle" target="_blank" href="https://g5.jiveon.com/docs/DOC-6305" >
							<i class="fa fa-info-circle">&nbsp more info</i>
						</a>
					</li>
				</ul>
			</div>
	    
			<!-- end: Header Menu -->
                        
                        <div id="search" class="col-lg-3 pull-right">
               
                            <input type="text" placeholder="search" autocomplete="off" id="searchbar">
                            <i class="fa fa-search"></i>
                            
                            <h4 id="results-text">Showing results for: <b id="search-string">Array</b></h4>
                            <ul class="col-lg-3"  id="results"></ul>
                            
                        </div>
            
            
            
        <div/>
    </header>
