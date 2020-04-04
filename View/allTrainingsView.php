<!-- DOCTYPE HTML -->
<?php
	ob_start();
?>

<?php
	foreach ($trainings as $trainee) {
		echo "<table class='training'>
			<thead>
				<tr>
					<td>Date</td>
					<td colspan=2>" . $trainee->getDate() . "</td>
					<td>Shape</td>
					<td colspan=2>" . $trainee->getShape() . "</td>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td class='title exofield'>Exercise</td>
					<td class='exo title'>Work load</td>
					<td class='exo title'>Sets</td>
					<td class='exo title'>Reps</td>
					<td class='exo title'>Rest</td>
					<td class='exo title'>Method</td>
				</tr>
";
		foreach ($trainee->getExercises() as $exo) {
			$method = $exo->getMethod() != NULL ? $exo->getMethod() : "None";
			echo '<tr>' .
				'<td class="exoName">' . $exo->getName() . '</td>' .
				'<td class="exo">' . $exo->getWorkLoad() . 'kg</td>' .
				'<td class="exo">' . $exo->getSets() . '</td>' .
				'<td class="exo">' . $exo->getReps() . '</td>' .
				'<td class="exo">' . $exo->getRest() . 's</td>' .
				'<td class="exo">' . $method . '</td>' .
			'</tr>';
		}
			echo "<tbody>
		</table>";
	}
?>

<?php
	// $content contains the html content from ob_start so far
	$content = ob_get_clean();
	require ("template.php");
?>