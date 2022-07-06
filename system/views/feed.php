<div class="conteudo">
	<section class="publicar">
		<div class="exibir">
			<span>Nova Publicação</span>
			<button class="btn">Publicar</button>
		</div>
		<div class="lightbox">
			<span class="close"></span>
			<form action="{$url_base}publicar" method="POST" class="form_ajax" enctype="multipart/form-data">
				<textarea name="mensagem" placeholder="Nova Publicação"></textarea>
				<label for="imagem">
					<span>Imagens</span>
					<input id="imagem" type="file" name="imagem[]" multiple="multipe" accept="image/">
				</label>
				<input type="submit" value="Publicar">

			</form>
		</div>
	</section>

	<section class="publicacoes">
		<div class="item">
			<div class="topo">
				<a href="{$url_base}feed/gabriel">
					<img src="{$url_base}resources/img/user.png"></a>
				<a href="{$url_base}feed/gabriel">
				<span>Nome da pessoa</span></a>
			</div>
			<div class="info">
				<div class="texto">
					Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
				</div>
				<div class="galeria">
					<img src="{$url_base}resources/img/place.jpg">
				</div>
			</div>
		</div>

		<div class="item">
			<div class="topo">
				<a href="{$url_base}feed/gabriel">
					<img src="{$url_base}resources/img/user.png"></a>
				<a href="{$url_base}feed/gabriel">
				<span>Nome da pessoa</span></a>
			</div>
			<div class="info">
				<div class="texto">
					Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
				</div>
			</div>
		</div>

		<div class="item">
			<div class="topo">
				<a href="{$url_base}feed/gabriel">
					<img src="{$url_base}resources/img/user.png"></a>
				<a href="{$url_base}feed/gabriel">
				<span>Nome da pessoa</span></a>
			</div>
			<div class="info">
				<div class="galeria">
					<img src="{$url_base}resources/img/place.jpg">
				</div>
			</div>
		</div>

	</section>
</div>

