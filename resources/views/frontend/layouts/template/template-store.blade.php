<!DOCTYPE html>
<html class="no-js" lang="en">
	<head>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0 shrink-to-fit=no"/>
		
    	<meta name="csrf-token" content="{{ csrf_token() }}">
		<title>MY CARE Smart Choice เพื่อนแท้ดูแลกัน</title>
		<meta name="author" content="codepixer">
		<meta name="description" content="">
		<meta name="keywords" content="">
		@include("/frontend/layouts/layout/css")
		<style>
			#bg {
				/* background-image:	url(img/mycare/bg/background.png), url(img/mycare/symbol/logo.png); */
				background-image:	url(../../img/mycare/bg/background.png);
				background-size: 100%, 50%;
				background-position: right center, left bottom;
				background-repeat: no-repeat, no-repeat;
				/* padding: 15px; */
			}

			@media only screen and (max-width : 991px) {
				.img-fluid {
					display: none;
				}
			}
			.h1-color {
				color: #0038ff;
				background: -webkit-linear-gradient(#001d86, #0056ff);
				-webkit-background-clip: text;
				-webkit-text-fill-color: transparent;
			}
			.fas {
				font-size: 46px;
				color: #0038ff;
				background-color: #204be3;
				-webkit-background-clip: text;
				-webkit-text-fill-color: transparent;
			}

			.about-video-right {
				background: url("{{ asset('/img/video-bg.jpg') }}") no-repeat center;
				background-size: cover;
				height: 400px;
			}
			.about-video-right .play-btn {
				z-index: 2;
			}
			span {
				font-family: 'Prompt' !important; 
			}
			h1 {
				font-family: 'Prompt' !important;
				margin-bottom: 0px !important;
			}
			h2 {
				font-family: 'Prompt' !important;
				font-size: 29px;
			}
			h3 {
				font-family: 'Prompt' !important;
				font-size: 24px;
			}
			p{
				font-family: 'Prompt' !important;
			}
		
		</style>
	</head>
	<body id="bg">
		@yield("content")
		@include("/frontend/layouts/layout/js")
	</body>
</html>