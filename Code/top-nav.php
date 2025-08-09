<div class="header">
  <a href="mainpage.php" class="logo">
    <i class="fas fa-chalkboard"></i>
    <span>Whiteboard</span>
  </a>
  <div class="calendar-container">
    <button class="calendar-nav" onclick="navigateCalendar(-1)"><i class="fas fa-chevron-left"></i></button>
    <span class="calendar-date" id="calendarDate"></span>
    <button class="calendar-nav" onclick="navigateCalendar(1)"><i class="fas fa-chevron-right"></i></button>
  </div>
</div>

<script>
  const calendarDate = document.getElementById('calendarDate');
  let currentDate = new Date();

  function navigateCalendar(direction) {
    currentDate.setDate(currentDate.getDate() + direction);
    updateCalendarDate();
  }

  function updateCalendarDate() {
    calendarDate.textContent = currentDate.toLocaleDateString('en-US', {
      year: 'numeric',
      month: 'long',
      day: 'numeric'
    });
  }

  updateCalendarDate(); 
</script>