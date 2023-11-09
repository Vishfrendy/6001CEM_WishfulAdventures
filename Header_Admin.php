<!DOCTYPE html>
<html>
	<head>
		<title>Wishful Adventures</title>
		
		<!---------- Style ---------->
		<style>
			body {
				margin: 0;
				padding: 0;
			}

			.header {
				background-color: white;
				color: black;
				display: flex;
				justify-content: space-between;
				align-items: center;
				height: 60px;
				padding: 0 20px;
				font-family: Arial, sans-serif;
			}
			
			.header img {
				height: 100px; 
				width: 150px;
			}

			.title {
				font-size: 24px;
				position: relative;
				left: 250px;
				top: 20px;
			}

			.sidebar {
				background-color: #f1f1f1;
				width: 250px;
				height: 100%;
				position: fixed;
				top: 0;
				left: 0;
				transition: left 0.3s;
				padding-top: 60px;
			}

			.sidebar-title {
				font-size: 20px;
				font-weight: bold;
				padding: 10px;
				margin-top: -65px;
				display: flex;
				justify-content: center;
				align-items: center;
				height: 60px;
			}

			.sidebar-menu {
				list-style: none;
				padding: 0;
			}

			.sidebar-menu-item {
				padding: 8px 15px;
			}

			.sidebar-menu-link {
				color: #333;
				text-decoration: none;
				display: block;
				padding: 8px 15px;
				transition: background-color 0.3s, color 0.3s;
				border-radius: 5px;
			}

			.sidebar-menu-link:hover {
				background-color: #ca8dfd;
				color: #fff;
				padding-left: 10px;
				border-radius: 5px;
				transform: scale(1.05);
				transition: transform 0.3s ease-in-out;
			}

			.menu {
				display: flex;
				align-items: center;
			}

			.menu-link {
				color: black;
				text-decoration: none;
				padding: 10px;
				border-radius: 5px;
				transition: background-color 0.3s;
			}

			.menu-link:hover {
				background-color: #007bff;
			}
		</style>
		<!---------- End of Style ---------->
	</head>
	
	<body>
		<div class="header">
			<div class="title"><img src="Logo4.png" alt="Logo"></div>
		</div>
		
		<!---------- Sidebar ---------->
		<div class="sidebar" id="sidebar">
			<div class="sidebar-title">Admin Menu</div>
			
			<ul class="sidebar-menu">
				<li class="sidebar-menu-item"><a href="Admin.php" class="sidebar-menu-link">Destinations</a></li>
				<li class="sidebar-menu-item"><a href="Admin_Hotels.php" class="sidebar-menu-link">Hotels</a></li>
				<li class="sidebar-menu-item"><a href="Admin_Restaurants.php" class="sidebar-menu-link">Restaurants</a></li>
				<li class="sidebar-menu-item"><a href="#" class="sidebar-menu-link">Travel Stories</a></li>
				<li class="sidebar-menu-item"><a href="#" class="sidebar-menu-link">Car Hire</a></li>
				<li class="sidebar-menu-item"><a href="#" class="sidebar-menu-link">Travel Forums</a></li>
				<li class="sidebar-menu-item"><a href="#" class="sidebar-menu-link">Travellers' Choice</a></li>
			</ul>
		</div>
		<!---------- End of Sidebar ---------->

		<!---------- Script ---------->
		<script>
			// Function to toggle the sidebar
			function toggleSidebar() {
				const sidebar = document.getElementById('sidebar');
				sidebar.classList.toggle('sidebar-open');
			}
		</script>
		<!---------- End of Script ---------->
		
	</body>
</html>
