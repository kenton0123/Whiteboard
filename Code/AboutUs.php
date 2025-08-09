<?php
    include 'functions.php';
    include 'left-nav.php';
    include 'top-nav.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Whiteboard - Our Project</title>
<link rel="stylesheet" href="main.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
<?=template_header()?>
<style>
  .project-content {
    margin-left: 215px;
    padding: 25px;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
  }
  
  .project-header {
    color: #2c3e50;
    border-bottom: 2px solid #3498db;
    padding-bottom: 10px;
    margin-bottom: 25px;
  }
  
  .section-header {
    color: #34495e;
    margin: 30px 0 15px 40px;
  }
  
  .project-text {
    font-size: 18px;
    line-height: 1.6;
    margin: 20px 80px;
    max-width: 800px;
  }
  
  .team-table {
    margin: 30px 80px;
    font-size: 18px;
    width: 80%;
    border-collapse: collapse;
  }
  
  .team-table th {
    background-color: #3498db;
    color: white;
    padding: 12px;
    text-align: left;
  }
  
  .team-table td {
    padding: 12px;
    border-bottom: 1px solid #ddd;
    vertical-align: top;
  }
  
  .team-table ul {
    margin: 0;
    padding-left: 20px;
  }
  
  .team-table li {
    margin-bottom: 8px;
  }
  
  .divider {
    border-top: 1px solid #eee;
    margin: 30px 80px;
  }
</style>
</head>
<body>

<div class="project-content">
    <h1 class="project-header">Web Development Project Showcase</h1>
    
    <h2 class="section-header">Project Overview</h2>
    <p class="project-text">
        This comprehensive web application was developed as a collaborative academic project, demonstrating our team's ability to design and implement modern web solutions. 
        The platform integrates multiple functional modules to create a complete learning management system with interactive features.
    </p>

    <div class="divider"></div>

    <h2 class="section-header">Technical Objectives</h2>
    <p class="project-text">
        Our development team successfully implemented a system that:
    </p>
    <div class="project-text">
        <ol>
            <li>Demonstrates full-stack web development capabilities using modern technologies</li>
            <li>Implements secure user authentication and role-based access control</li>
            <li>Integrates interactive features with real-time data processing</li>
            <li>Showcases responsive design principles for cross-device compatibility</li>
            <li>Utilizes efficient database design and management techniques</li>
        </ol>
    </div>

    <div class="divider"></div>

    <h2 class="section-header">Key Achievements</h2>
    <p class="project-text">
        Through this project, we demonstrated our ability to:
    </p>
    <div class="project-text">
        <ul>
            <li>Collaborate effectively in a team development environment</li>
            <li>Solve complex technical challenges with innovative solutions</li>
            <li>Implement industry-standard security practices</li>
            <li>Design intuitive user interfaces with optimal UX principles</li>
            <li>Deliver a fully functional system within project constraints</li>
        </ul>
    </div>

    <div class="divider"></div>

    <h2 class="section-header">Development Team</h2>
	<div class="project-text" style="margin-top: 30px;">
        <p><b>Lam Kai Chak & Kwok Chun Wing</b></p>
    </div>
    
    <div class="project-text" style="margin-top: 30px;">
        <p>This project serves as a demonstration of our technical capabilities and collaborative development skills. We welcome any inquiries about our implementation approaches or technical decisions.</p>
    </div>
</div>

</body>
</html>