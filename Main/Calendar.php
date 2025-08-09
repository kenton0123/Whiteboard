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
<title>Whiteboard - Calendar</title>
<link rel="stylesheet" href="main.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
<?=template_header()?>
<style>
</style>
</head>
<body>
<div class="main-content">
<link rel="stylesheet" href="./style1.css">
    <div style="padding:20px;max-width:600px;">
                <h3 id="monthAndYear"></h3>
                <div class="button-container-calendar">
                    <button id="previous"
                            onclick="previous()">
                          ‹
                      </button>
                    <button id="next"
                            onclick="next()">
                          ›
                      </button>
                </div>
                <table class="table-calendar"
                       id="calendar"
                       data-lang="en">
                    <thead id="thead-month"></thead>
                    <tbody id="calendar-body"></tbody>
                </table>
                <div class="footer-container-calendar">
                    <label for="month">Jump To: </label>
                    <select id="month" onchange="jump()">
                        <option value=0>Jan</option>
                        <option value=1>Feb</option>
                        <option value=2>Mar</option>
                        <option value=3>Apr</option>
                        <option value=4>May</option>
                        <option value=5>Jun</option>
                        <option value=6>Jul</option>
                        <option value=7>Aug</option>
                        <option value=8>Sep</option>
                        <option value=9>Oct</option>
                        <option value=10>Nov</option>
                        <option value=11>Dec</option>
                    </select>
                    <select id="year" onchange="jump()"></select>
                </div>
    </div>
    <!-- Include the JavaScript file for the calendar functionality -->
    <script src="./Calendar.js"></script>
</div>
</body>
</html>