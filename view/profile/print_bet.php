						<div class="projo">
							<div class="row" style="margin: 0;">
								<!--BLOCK de GAUCGE-->
								<div class="col-md-8">
									<div class="row mywell"> <!-- pp + infos projet-->


										<div class="col-md-10">
											<h4><?php echo $bet['name']; ?></h4>
											<h6>Deadline : <?php echo $bet['deadline']; ?></h6>
											<h5><?php echo $bet['description']; ?></h5>
										</div>
									</div>
									<div class="row"> <!-- Commentaires -->

										<?php
										$comments = getCommentsByBetID( $bet['id'] );
										?>

										<div class="panel-group">
											<div class="panel panel-default">
												<div class="panel-heading">
													<h4 class="panel-title comm comm2">
														<a data-toggle="collapse" href="#comments<?php echo $bet['id']; ?>">Comments <span class="badge"><?php echo count($comments); ?></span></a>
													</h4>
												</div>
												<div id="comments<?php echo $bet['id']; ?>" class="panel-collapse collapse">
													<div class="panel-body">

														<?php
														foreach ($comments as $comment) {
															?>

															<div class="row">

																<div class="col-md-12 comment">
																	<p><span><?php echo $comment['user_name']; ?>:</span> <?php echo $comment['content']; ?></p>
																</div>

															</div>

															<?php
														}
														if( count($comments) == 0 ){
															?>

															<p style="font-size:0.8em;margin">Il n'y a pas encore de commentaires</p>

															<?php
														}
														?>

														<form action="../../controller/add_comment.controller.php?b=<?php  echo $bet['id'] . "&s=" . $saloon_id; ?>" method="post">
															<div class="row form-group lol">
																<div class="col-md-7 nop">
																	<input type="text" class="form-control" placeholder="Commentaire" name="comment">
																</div>
																<div class="col-md-5 nop2">
																	<input type="submit" class="btn btn-primary" value="Publier">
																</div>
															</div>
														</form>
													</div>

												</div>

											</div>
										</div>
									</div>
								</div>  <!--END BLOC de GAUCHE-->



								<!--BLOC de DROITE-->
								<div class="col-md-4">
									<div class="mywell2">
									<div class="row">
										<?php
										$rewards = getRewardsByBetID( $bet['id'] );
										$count_rewards = 0;
										foreach( $rewards as $reward ){
											$count_rewards++;
											$reward_detail = getRewardDetail( $reward['id'] );
											$reward_quantity = getRewardQuantity( $reward_detail );
											?>
											<div class="col-md-12 rewa">
												<?php echo $reward['name'] . "  "; ?><a href="#" data-toggle="tooltip" title="<?php echo printRewardDetail( $reward_detail ); ?>" id="quantity_<?php echo $reward['id']; ?>"><?php echo $reward_quantity; ?></a>
												<?php
												if($bet['accomplished'] == '0'){
														?>
													<button class="btn btn-default btn-xs plus" value="<?php echo $reward['id']; ?>"><span class="glyphicon glyphicon-plus"></span></button>
													<button class="btn btn-default btn-xs minus" value="<?php echo $reward['id']; ?>"><span class="glyphicon glyphicon-minus"></span></button>
												<?php 
												}

												?>
											</div>


											<?php
										}
										if($count_rewards == 0){
											?>
											<div class="col-md-12 rewa">
												<p>Il n'y a pas de récompense</p>
											</div>
											<?php
										}
										?>

									</div>
									<?php
									if($bet['accomplished'] == '0'){
										?>

										<div class="row">

											<div class="col-md-4">
												<a href="../rewards.view.php?bet_id=<?php echo $bet['id'] ."&s=" . $saloon_id . "&user_id=" . $bet['user']; ?>"><button class="btn btn-default">Parie un truc!</button></a>
											</div>
										</div>
										<?php } ?>
								</div>
								</div> <!--END BLOC de DROITE-->


							</div>
						</div> <!--projo-->
