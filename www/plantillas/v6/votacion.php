<?php defined('OK') or die(); ?>

				<script src="<?php print($rutas['w_js']); ?>votar.js" type="text/javascript"></script>
				
				<div id="votos" class="borrar">
					<span class="columna"><strong><?php print($resultado['textos']['valoracion']); ?>: <span id="num_valoracion"><?php print($resultado['votos']['valoracion']); ?></span></strong> (<span id="num_votos"><?php print($resultado['votos']['votos'].'</span> '.$resultado['textos']['votos']); ?>)</span>
					<ul style="width: 95px;">
						<li class="voto_actual" style="width: <?php print($resultado['votos']['porcentaxe']); ?>px;"></li>
						
						<li><a rel="nofollow" href="t_votos=tipografias&amp;id_votos=<?php print($resultado['votos']['id']); ?>&amp;puntos_votos=1" class="un">1</a></li>
						<li><a rel="nofollow" href="t_votos=tipografias&amp;id_votos=<?php print($resultado['votos']['id']); ?>&amp;puntos_votos=2" class="dous">2</a></li>
						<li><a rel="nofollow" href="t_votos=tipografias&amp;id_votos=<?php print($resultado['votos']['id']); ?>&amp;puntos_votos=3" class="tres">3</a></li>
						<li><a rel="nofollow" href="t_votos=tipografias&amp;id_votos=<?php print($resultado['votos']['id']); ?>&amp;puntos_votos=4" class="catro">4</a></li>
						<li><a rel="nofollow" href="t_votos=tipografias&amp;id_votos=<?php print($resultado['votos']['id']); ?>&amp;puntos_votos=5" class="cinco">5</a></li>
					</ul>
				</div>