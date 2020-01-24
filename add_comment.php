<?
$connect = new PDO('mysql:host=localhost;dbname=db testing', 'root', '');

$error='';
$comment_name='';
$comment_content='';

if(empty($_POST["comment_name"]))
{
  $error .= '<p class="text-danger">Name is Required</p>';
}
else{
  $comment_name  =  $_POST["comment_name"];
}
if(empty($_POST["comment_content"])){
  $error .='<p class="text-danger">Comment is Required</p>';
}
else{
  $comment_content = $_POST["comment_content"];
}
if($error=='')
{
  $query="INSERT INTO comment (parent_comment_id, comment, comment_sender_name)
  VALUES (:parent_comment_id,:comment,:comment_sender_name)";


  $statement = $connect->prepare($query);
  $statement->execute(
    array(
      ':parent_comment_id'              =>$_POST["comment_id"],
      ':comment'                        => $comment_content,
      ':comment_sender_name'            => $commnet_name

    )
  );
  $error='<label class="text-success">Comment Added</label>';
}
$data= array(
  'error' => $error

);
echo json_encode($data);
?>
