<section class="lateral_direita">
	{if="$links == false && $usuario_logado['id'] != $usuarios['id']"}
		<div class="form_nova_mensagem">
			<form class="form_ajax" action="{$url_base}nova_mensagem" method="POST">
				<input type="hidden" name="id_user_recebe" value="{$usuarios['id']}">
				<textarea  name="mensagem" placeholder="Nova mensagem"></textarea>
				<input type="submit" name="btn" value="enviar">
				<div class="alerta"></div>
			</form>
		</div>

	{/if}
	<div class="fotos">
		<a href="{$url_base}fotos{$url_base}fotos">
			<p>Fotos</p></a>
		<ul>
			<li>
				<a href="{$url_base}fotos">
					<img src="{$url_base}resources/img/place.jpg">
				</a>
			</li>
			
			<li>
				<a href="{$url_base}fotos">
					<img src="{$url_base}resources/img/place.jpg">
				</a>
			</li>

			<li>
				<a href="{$url_base}fotos">
					<img src="{$url_base}resources/img/place.jpg">
				</a>
			</li>

			<li>
				<a href="{$url_base}fotos">
					<img src="{$url_base}resources/img/place.jpg">
				</a>
			</li>
			
			<li>
				<a href="{$url_base}fotos">
					<img src="{$url_base}resources/img/place.jpg">
				</a>
			</li>

			<li>
				<a href="{$url_base}fotos">
					<img src="{$url_base}resources/img/place.jpg">
				</a>
			</li>
		</ul>
	</div>
	<div class="seguindo">
		<p>Seguindo</p>
		<ul>
			<li>
				<a href="{$url_base}feed/gabriel">
					<img src="{$url_base}resources/img/place.jpg">
				</a>
			</li>
			
			<li>
				<a href="{$url_base}feed/gabriel">
					<img src="{$url_base}resources/img/place.jpg">
				</a>
			</li>

			<li>
				<a href="{$url_base}feed/gabriel">
					<img src="{$url_base}resources/img/place.jpg">
				</a>
			</li>

			<li>
				<a href="{$url_base}feed/gabriel">
					<img src="{$url_base}resources/img/place.jpg">
				</a>
			</li>
			
			<li>
				<a href="{$url_base}feed/gabriel">
					<img src="{$url_base}resources/img/place.jpg">
				</a>
			</li>

			<li>
				<a href="{$url_base}feed/gabriel">
					<img src="{$url_base}resources/img/place.jpg">
				</a>
			</li>
		</ul>
	</div>
	<div class="footer">
		<div class="content"> 
		<p>Todos os direitos Reservados {function="date('Y')"}</p></div>
	</div>

		
</section>