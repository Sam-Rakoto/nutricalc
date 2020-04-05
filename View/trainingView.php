<!-- DOCTYPE HTML -->
<?php
	ob_start();
	require_once("Config/Path.php");
	use Config\Path;
?>

<table class="training">
	<thead>
		<tr>
			<th>Date</th>
			<th colspan=2><?= $training->getDate() ?></th>
			<th>Shape</th>
			<th colspan=2><?= $training->getShape() ?></th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td class ='title exofield'>Exercise</td>
			<td class='exo title'>Work load</td>
			<td class='exo title'>Sets</td>
			<td class='exo title'>Reps</td>
			<td class='exo title'>Rest</td>
			<td class='exo title'>Method</td>
		</tr>
		<?php
			foreach ($training->getExercises() as $exo) {
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
		?>
		<a class="buttonDangerous" href="<?= PATH::KERNEL?>app/deletetraining/<?= $training->getId() ?>">Delete this training</a>
	</tbody>
</table>

<?php
	// $content contains the html content from ob_start so far
	$content = ob_get_clean();
	require ("template.php");
?>