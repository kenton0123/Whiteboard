<?php
// Include the function file
include 'functions.php';
include 'top-nav.php';
include 'left-nav.php';
	 $msag	 = isset($_SESSION["msag"])  ?  $_SESSION["msag"]  : "";
?>


<?=template_header()?>
<br/><br/><br/><br/><br/>
<div class="content home comman">
<div class="panel panel-default" style="margin-top:50px">
  <div class="panel-body">
    <h3>Community forum</h3>
    <hr>
    <form name="frm" method="post" action="dealcom.php">
        <input type="hidden" id="commentid" name="Pcommentid" value="0">
    <nav class="form-group">
	<table>
		<td>
      <label for="comment">Message:  </label>
		</td>
		<td>
      <textarea class="form-control" rows="5" cols="100" name="msag" id="msag" value="<?= $msag ?>" required></textarea>
		</td>	  
		<td>
            <input type="submit" id="btn-submit" value="Submit"/>
	 	</td>
	</table>
	</nav>
    </div>
  </form>
	  <?=show_message()?>

</div>




