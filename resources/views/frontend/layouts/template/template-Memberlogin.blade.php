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
	</head>
	<body>
		@yield("content")
	</body>
</html>