<!-- DOCTYPE HTML -->
<?php
	ob_start();

	function getActualShape($shape) {
		$actualShape = "";
		for ($iShape=0; $iShape<$shape; $iShape++) :
			$actualShape .= mb_convert_encoding('&#x1f4aa;', 'UTF-8', 'HTML-ENTITIES');
		endfor;
		return $actualShape;
	}
?>

	<?php
		$iTraining = 0;
		foreach ($trainings as $trainee) :
			$actualDate = new DateTime($trainee->getAttribute("date"));
			$actualShape = getActualShape($trainee->getAttribute("shape"));
			if ($iTraining % 2 == 0 or $iTraining == 0) :
	?>
				<div class="columns is-centered">;
	<?php endif; ?>

			<div class="column is-two-fifths">
				<div class="box has-text-centered">
					
					<!-- Header -->
					<div class="columns">

						<!-- Date -->
						<div class="column has-text-left">
							<a class="button has-background-success has-text-white" href="<?= $paths['APP'] ?>training/<?= $trainee->getAttribute('id') ?>">
								<?= $actualDate->format('l') ?>
							</a>
							<a class="button has-background-light" href="<?= $paths['APP'] ?>training/<?= $trainee->getAttribute('id') ?>"><?= $trainee->getAttribute("date") ?></a>			
						</div>

						<!-- Shape -->
						<div class="column has-text-right">
							<button class="button has-background-success has-text-white">
								<?= $actualShape?>
							</button>
						</div>	
					</div>
					<!-- #END Header -->

					<!-- Exercises -->
					<table class="table is-fullwidth">
						<thead>
							<tr>
								<th>Exercise</th>
								<th class="has-text-centered">Work load</th>
								<th class="has-text-centered">Sets</th>
								<th class="has-text-centered">Reps</th>
								<th class="has-text-centered">Rest</th>
								<th class="has-text-centered">Method</th>
							</tr>
						</thead>
						<tbody>
					<?php
						foreach ($trainee->getAttribute("exercises") as $exo) :
							$method = ($exo->getAttribute("method") != NULL) ? $exo->getAttribute("method") : "None";
					?>
							<tr>
								<td><?= $exo->getAttribute("name") ?></td>
								<td class="has-text-centered"><?= $exo->getAttribute("workLoad") ?> kg</td>
								<td class="has-text-centered"><?= $exo->getAttribute("nbSets") ?></td>
								<td class="has-text-centered"><?= $exo->getAttribute("nbReps") ?></td>
								<td class="has-text-centered"><?= $exo->getAttribute("rest") ?>s</td>
								<td class="has-text-centered"><?= $method ?></td>
							</tr>
					<?php
						endforeach;
					?>
						</tbody>
					</table>
					<!-- #END Exercises -->

					<div class="content has-text-left">
						<a class="button is-info" href="<?= $paths['APP'] ?>edittraining/<?= $trainee->getAttribute('id') ?>">Edit</a>
						<a class="button is-danger" href="<?= $paths['APP'] ?>deletetraining/<?= $trainee->getAttribute('id') ?>">(-) Remove</a>
					</div>
				</div>
			</div>
		<?php
			if ($iTraining % 2 != 0) :
				echo '</div>';
			endif;
			$iTraining++;
		endforeach;
	?>				
</div>

<nav class="pagination" role="navigation" aria-label="pagination">
	<?php if ($actualPageNb != 1) : ?>
		<a class="pagination-previous" href="<?= $paths['APP'] ?>alltrainings/<?= $actualPageNb-1 ?>">Previous</a>
	<?php endif; ?>

	<?php if ($actualPageNb < $maxNbPages) : ?>
		<a class="pagination-next" href="<?= $paths['APP'] ?>alltrainings/<?= $actualPageNb+1 ?>">Next page</a>
	<?php endif; ?>

	<ul class="pagination-list">
		<?php
			for ($i=1; $i<=$maxNbPages;$i++) :
				$isCurrent = "";

				if ($i == $actualPageNb) :
					$isCurrent = "has-background-success";
				endif;
		?>
		<li>
			<a href="<?= $paths['APP'] ?>alltrainings/<?= $i ?>" class="pagination-link <?= $isCurrent ?>" aria-label="Page <?= $i ?>">
				<?= $i ?>
			</a>
		</li>
		<?php endfor; ?>
	</ul>
</nav>

<?php
	$content = ob_get_clean();
	require ($paths['TEMPLATE'] . "/template.php");
?>