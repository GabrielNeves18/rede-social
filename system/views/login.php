<section class="el-login">
	<form class="form_ajax" action="{$url_base}cadastrar" method="POST">
		<legend>Cadastrar</legend>
		<input type="text" name="nome" placeholder="Nome">
		<input type="email" name="email" placeholder="E-mail">
		<input type="tel" name="telefone" placeholder="Celular" class="celular_ddd">
		<input type="password" name="senha" placeholder="Senha">
		<p>Ao cadastrar você aeita os <a href="#">termos e politica </a></p>
		<input type="submit" name="btn" value="Cadastrar">
		<div class="alerta"></div>
	</form> 
</section>