<?php
include('inc/header4.php');
?>
<title>Seminar Topics</title>
<?php include('inc/container4.php');?>

<?php 
require "connection.php";
?>
<?php
	$sql='SELECT * FROM api.subject';
	$statement=$connection->prepare($sql);
	$statement->execute();
	$subjects=$statement->fetchAll(PDO::FETCH_OBJ);

?>
<div class="container background my-5 w-75">	
	<br><br>	
	<h2 >Seminar Topics </h2>					
	<form method="post" action="">
		<div class="form-group">
			<!-- <label for="email">Ask Your Question Here:</label> -->
			<select name="subject" class="form-control w-50">
				<option selected>SELECT YOUR SUBJECT</option>
				<?php foreach($subjects as $subject):?>
				<option value=<?=$subject->id;?>> <?=$subject->subject;?></option>
				<?php endforeach; ?>
			</select>
			
			<!-- <textarea class="form-control w-75" id="question" name="question" rows="5"></textarea> -->
		</div>					
		<input type="submit" class="btn btn-primary" value="Get Answer" name="question">
	</form>			
	<br>
					
	<?php
	if(!empty($_POST["question"]) && $_POST['question']) {	
		$subject=$_POST['subject'];
		$sql='SELECT * FROM api.subject WHERE id=:id';
		$statement=$connection->prepare($sql);
		$statement->execute([':id'=>$subject]);
		$subjects=$statement->fetch(PDO::FETCH_OBJ);
		$q="Best 10 seminar topics on ".$subjects->subject;
		// echo $q;
		include('class/OpenAi.php');
		$openai = new OpenAi();	
		$openai->question=$q;	

	?>
		
	<!-- <span class="text-danger font-weight-bold">Question : </span> -->
	<!-- <span class="font-weight-normal" style="margin-left:10px;"><?php echo ucfirst($_POST['question']); ?><span><br> -->


	<span class="text-success font-weight-bold">Answer : </span>
	<span class="font-weight-normal" style="margin-left:10px;">
	<?php 
	echo $openai->getAnswer();
	?>
	<span>		
	<?php
	}			
	?>

</div>	
<?php include('inc/footer4.php');?>



