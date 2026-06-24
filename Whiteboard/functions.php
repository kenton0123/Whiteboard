<?php

// Template header, feel free to customize it, but DO NOT INDENT THE PHP CODE
function template_header() {
// DO NOT INDENT THE BELOW PHP CODE OR YOU WILL ENCOUNTER ISSUES
// Also this is the top of the website
echo <<<EOT
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<link href="pollstyle.css" rel="stylesheet" type="text/css">
		<link href="main.css" rel="stylesheet" type="text/css">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
		<style>

  body, h1, h2, h3, p, ul, li, a, div { margin: 0; padding: 0; }
  body { font-family: Arial, sans-serif; background-color: #eee; }
  .header { background-color: #292961; color: white; padding: 1rem; position: fixed; width: 100%; top: 0; z-index: 1000; display: flex; justify-content: space-between; align-items: center; }
  .header .logo { cursor: pointer; font-weight: bold; text-decoration: none; color: white; display: flex; align-items: center; }
  .header .date { font-size: 0.95rem; margin-left: 10px; }

  .header {
    background-color: #292961;
    color: white;
    padding: 1.5rem;
    position: fixed;
    width: 100%;
    top: 0;
    z-index: 1000;
    display: flex;
    justify-content: space-between;
    align-items: center;
  }

  .header .logo {
    cursor: pointer;
    font-weight: bold;
    text-decoration: none;
    color: white;
    display: flex;
    align-items: center;
  }

  .header .calendar-container {
    position: absolute;
    left: 50%;
    transform: translateX(-50%);
    display: flex;
    align-items: center;
  }

  .nav-bar { 
    background-color: #333;
    position: fixed;
    top: 0;
    left: 0;
    bottom: 0;
    width: 200px;
    overflow-y: auto;
    padding-top: 60px;
  }
  
  .nav-bar ul { 
    list-style-type: none; 
    padding: 0;
  }
  
  .nav-bar li a { 
    color: white; 
    text-decoration: none; 
    padding: 10px 15px; 
    display: flex; 
    align-items: center; 
    transition: background-color 0.3s; 
  }
  
  .nav-bar li a i { 
    margin-right: 10px; 
  }
  
  .nav-bar li a:hover { 
    background-color: #575757; 
  }

  .nav-bar .separator {
    border-bottom: 2px solid #575757;
    margin: 20px 0;
  }

  .speed-label, .logout-label {
    text-align: center;
    margin-bottom: 10px;
    font-weight: bold;
    padding: 10px 15px;
    background-color: #575757;
  }

  .content.home,.main-content {
    margin-left: 200px;
    padding: 1.5rem;
    padding-top: 100px; //Adjust padding to account for fixed header
    display: flex;
    flex-direction: column;
    gap: 20px;
  }
  

br {
    display: none;
}

@media (max-width: 768px) {
    .nav-bar {
      width: 100%;
      height: auto;
      position: relative;
    }
    
    .nav-bar ul {
      display: flex;
      flex-direction: column;
      padding-top: 0;
    }
    
    .main-content {
      margin-left: 0;
      padding-top: 1rem;
    }
    
    .header .calendar-container {
      position: static;
      transform: none;
      margin: auto;
    }
  }

  .Activity {
    background: white;
    border-radius: 10px;
    padding: 20px;
    box-shadow: 0 4px 8px rgba(0,0,0,0.1);
  }

  .Activity-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 20px;
  }

  .Activity-header h2 {
    color: #333;
  }

.overview-container {
    display: flex;
    justify-content: space-around;
    padding-bottom: 20px;
    border-bottom: 1px solid #ccc;
    margin-bottom: 20px;
  }

  .overview-item {
    flex-grow: 1;
    margin: 0 10px;
    padding: 20px;
    background: #f4f4f4;
    border-radius: 10px;
    text-align: center;
    box-shadow: 0 2px 5px rgba(0,0,0,0.1);
  }

  .overview-item h3 {
    font-size: 22px;
    color: #1F586C;
    margin-bottom: 10px;
  }

  .overview-item p {
    color: #20233D;
	front-size: 22px;
	margin-bottom: 10px;
  }

  .overview-item:last-child {
    margin-right: 0;
  }

  .overview-item:first-child {
    margin-left: 0;
  }

  .overview-item.blue-bg { background-color: #8AAAE5; }
  .overview-item.purple-bg { background-color: #CAB8FF; }
  .overview-item.orange-bg { background-color: #FFB579; }
  .overview-item.green-bg { background-color: #9DD6A3; }
  .overview-item.red-bg { background-color: #C9152E; }


  .activity-stream {
    list-style: none;
  }

  .activity {
    display: flex;
    align-items: center;
    padding: 10px 0;
    border-bottom: 1px solid #eee;
  }

  .activity:last-child {
    border-bottom: none;
  }

  .activity-icon {
    font-size: 24px;
    margin-right: 15px;
  }

  .activity-section {
    margin-bottom: 20px;
	padding: 20px;
    box-shadow: 0 4px 8px rgba(0,0,0,0.1);
  }
  .activity-section:last-child {
    margin-bottom: 0;
  }
  .activity-section header {
    margin-bottom: 10px;
  }
  .activity-section header h3 {
    color: #292961;
    font-size: 1.2rem;
    margin-bottom: 5px;
  }
  
  .button-link {
  display: inline-block;
  padding: 10px 20px;
  background-color: #0F0E0D;
  color: white;
  text-align: center;
  text-decoration: none;
  border-radius: 5px;
  font-weight: bold;
  }

</style>
	</head>
	<body>
	</body>
EOT;
}




function show_message() {
	
require_once('db.php');

echo <<<EOT
<!DOCTYPE html>
<html>
	<head>
       <div><h3>Recent Message</h3></div>
	</head>
	<body>
	<body>
EOT;

        // Fetch all records from the database
        $sql = "SELECT * FROM discuss ;";
        $result = mysqli_query($conn, $sql);

        // Display all records
            echo "<table>";
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
				echo "<td>" . $row['com_time'] . "</td>";
			    echo "<td>" . $row['studentid'] . "</td>";
                echo "<td>" . $row['msag'] . "</td>";
                echo "</tr>";
			}
            echo "</table>";
        

}



?>