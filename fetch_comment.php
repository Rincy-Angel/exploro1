<?
$connect=new PDO('mysql:host=localhost;dbname=db testing','root','');
$query="
SELECT * FROM comment
WHERE parent_comment_id='0'
ORDER BY comment_id DESC";
$statement = $connect-> prepare($query);
$statement->execute();
$result=$statement->fetchAll();
$output ='';
foreach($result as $row){
  $output .= '
  <div class="panel panel-default">
  <div class="panel-heading">By <b> '.$row["comment_sender_name"].'
  </b> on <i>'.$row["date"].'</i></div>
  <div class="panel-body">'.$row["comment"].'</div>
  <div class="panel-footer" align="right"><button type="button"
  class="btn btn-default reply" id="'.$row["comment_id"].'"
  Reply</button></div>
  </div>
  ';
}
echo $output;
?>
