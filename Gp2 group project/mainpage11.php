<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Whiteboard - Main Page</title>
<link rel="stylesheet" href="main.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

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

  .main-content {
    margin-left: 200px;
    padding: 1.5rem;
    padding-top: 100px; /* Adjust padding to account for fixed header */
    display: flex;
    flex-direction: column;
    gap: 20px;
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

	<?php include 'top-nav.php'; ?>
	<?php include 'left-nav.php'; ?>

<div class="main-content">

 	<h2>Course Overview</h2>
	
  <div class="overview-container">
	
    <div class="overview-item blue-bg">
	<?php
	if($_SESSION['identity'] == "Student"){
		include 'db1.php';
		$sql = "SELECT COUNT(*) AS total_assessments FROM files WHERE file_type = 'assessment';";
		$stmt = $pdo->prepare($sql);
		$stmt->execute();
		$result = $stmt->fetch(PDO::FETCH_ASSOC);
		$total_assessments = $result['total_assessments'];
	?>
		<h3><?php echo $total_assessments; ?></h3><?php
		}
		else{
			?>
			<h3><?php echo "Null" ?></h3><?php
		} ?>
		<p>Total Assignment</p>
	</div>

    <div class="overview-item purple-bg">
    <?php
	if($_SESSION['identity'] == "Student"){
		include 'db1.php';
		$student_id = $_SESSION['id'];
		$sql = "SELECT COUNT(*) AS submitted_submissions FROM submissions WHERE student_id = :student_id AND submitted_at IS NOT NULL";
		$stmt = $pdo->prepare($sql);
		$stmt->bindParam(':student_id', $student_id);
		$stmt->execute();
		$result = $stmt->fetch(PDO::FETCH_ASSOC);
		$assessment_handed_in = $result['submitted_submissions'];
	?>
		<h3><?php echo $assessment_handed_in; ?></h3><?php
		}
		else{
			?>
			<h3><?php echo "Null" ?></h3><?php
		} ?>
		<p>Finished Assignment</p>
    </div>

    <div class="overview-item orange-bg">
	<?php
	if($_SESSION['identity'] == "Student"){
		include 'db1.php';
		$student_id = $_SESSION['id'];
		$sql = "SELECT AVG(mark) AS average_mark FROM submissions WHERE student_id = :student_id AND submitted_at IS NOT NULL";
		$stmt = $pdo->prepare($sql);
		$stmt->bindParam(':student_id', $student_id);
		$stmt->execute();
		$result = $stmt->fetch(PDO::FETCH_ASSOC);
		$avg_mark = $result['average_mark'];
	?>
		<h3><?php echo $avg_mark; ?></h3><?php
		}
		else{
			?>
			<h3><?php echo "Null" ?></h3><?php
		} ?>
		<p>Average Assignment Score</p>

    </div>

    <div class="overview-item green-bg">
	<?php
	if($_SESSION['identity'] == "Student"){
		include 'db1.php';
		$sql = "SELECT (SELECT COUNT(*) FROM files WHERE file_type = 'assessment' AND deadline BETWEEN NOW() AND DATE_ADD(NOW(), INTERVAL 7 DAY)) 
		AS upcoming_assessments, 
		(SELECT COUNT(*) FROM submissions WHERE student_id = :student_id AND submitted_at IS NOT NULL 
		AND (SELECT deadline FROM files WHERE id = submissions.assessment_id) BETWEEN NOW() AND DATE_ADD(NOW(), INTERVAL 7 DAY)) 
		AS submitted_assessments_in_7_days;";
		$stmt = $pdo->prepare($sql);
		$stmt->bindParam(':student_id', $student_id);
		$stmt->execute();
		$result = $stmt->fetch(PDO::FETCH_ASSOC);
		$next_hand_in = $result['upcoming_assessments'] - $result['submitted_assessments_in_7_days'];
	?>
		<h3><?php echo $next_hand_in; ?></h3><?php
		}
		else{
			?>
			<h3><?php echo "Null" ?></h3><?php
		} ?>
		<p>Assessments need to hand </p><p>in next 7 days</p>

    </div>
	

  </div>

<?php

include 'db1.php';

$sql = "SELECT type, title, course, description, due_date FROM activities ORDER BY due_date ASC";
$stmt = $pdo->prepare($sql);
$stmt->execute();

$activities = $stmt->fetchAll(PDO::FETCH_GROUP|PDO::FETCH_ASSOC);
?>
  <div class="Activity Stream">
    <div class="Activity">
      <h2>Activity Stream</h2>
    </div>
    
<div class="activity-section" id="activity-stream">

    <header><h3>Important</h3></header>
    <ul class="activity-list">
        <?php foreach ($activities['important'] as $activity): ?>
            <li class="activity">
                <strong><?= htmlspecialchars($activity['title']) ?></strong>
                <p><?= htmlspecialchars($activity['course']) ?></p>
                <p><?= htmlspecialchars($activity['description']) ?></p>
                <p><?= htmlspecialchars($activity['due_date']) ?></p>
            </li>
        <?php endforeach; ?>
    </ul>


    <header><h3>Upcoming</h3></header>
    <ul class="activity-list">
        <?php foreach ($activities['upcoming'] as $activity): ?>
            <li class="activity">
                <strong><?= htmlspecialchars($activity['title']) ?></strong>
                <p><?= htmlspecialchars($activity['course']) ?></p>
                <p><?= htmlspecialchars($activity['description']) ?></p>
                <p><?= htmlspecialchars($activity['due_date']) ?></p>
            </li>
        <?php endforeach; ?>
    </ul>


    <header><h3>Recent</h3></header>
    <ul class="activity-list">
        <?php foreach ($activities['recent'] as $activity): ?>
            <li class="activity">
                <strong><?= htmlspecialchars($activity['title']) ?></strong>
                <p><?= htmlspecialchars($activity['course']) ?></p>
                <p><?= htmlspecialchars($activity['description']) ?></p>
                <p><?= htmlspecialchars($activity['due_date']) ?></p>
            </li>
        <?php endforeach; ?>
    </ul>
</div>
  
</div>

</body>
</html>