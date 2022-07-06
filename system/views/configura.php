<div class="conteudo">
	<section class="configuracoes">
		<form class="form_ajax"action="{$url_base}config" method="POST" enctype="multipart/form-data">

			<label for="campo-img">
				<!–será possível a troca de imagem, id= será uma função js para que seja trocado–> 
				<img src="{$url_base}resources\img\user.png" id="img-config">
				<input type="file" id="campo-img" name="image">
			</label>
			
			<div class="nome">
				<input class='pessoa' type="text" name="nome" placeholder="Nome">
				<input class='pessoa' type="text" name="sobrenome" placeholder="Sobrenome">	
			</div>

			<input type="email" name="email" placeholder="Email">
			<input type="tel" name="telefone" class="celular_ddd" placeholder="Celular">
			<input type="password" name="senha" placeholder="Senha">
			<input type="password" name="confirmar_senha" placeholder="Confirmar senha">

			<input type="submit" name="btn-salvar" class="btn" value="salvar">



		</form>
	</section>
</div>