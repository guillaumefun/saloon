<div class="gallery" itemscope>

	<?php
		for ($i=0; $i < $bet['nb_img']; $i++) {
			$img_info = getimagesize('../../img/proofs/' . $bet['id'] . '/' . $i . '.jpeg');
			?>

				<figure itemprop="associatedMedia" itemscope >
			      <a href="../../img/proofs/<?php echo $bet['id'] . '/' . $i . '.jpeg'; ?>" itemprop="contentUrl" data-size="<?php echo $img_info[0] . 'x' . $img_info[1]; ?>">
			          <img src="../../img/proofs/<?php echo $bet['id'] . '/' . $i . '_thumb.jpeg'; ?>" itemprop="thumbnail" alt="" />
			      </a>
			    </figure>

			<?php

		}

	?>

</div>
