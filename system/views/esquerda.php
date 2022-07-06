<section  class="lateral_esquerda"> 
	<div class="topo">
		<a href="{$url_base}feed/{$usuarios['url_user']}">
		<img src="{$usuarios['foto_user']}"></a>
		<div class="info">
			<a href="{$url_base}feed/{$usuarios['url_user']}">
			<p>{$usuarios['nome_user']}</p></a>
			{if="$usuario_logado['id'] != $usuarios['id']"}
				<button class="btn-seguir">seguir</button>
			{/if}
		</div>
	</div>
	{if="$pagina_mensagem == true"}
		<div class="lista_mensagens">
			<div class="item">
				<div class="foto">
					<img src="{$url_base}resources/img/user.png">
				</div>
				<div class="info">
					<p class="nome">Fulano de tal</p>
					<div class="ultima_mensagem">
						Lorem ipsum dolor sit amet, consectetur...
					</div>
				</div>	
			</div>
			
			<div class="item">
				<div class="foto">
					<img src="{$url_base}resources/img/user.png">
				</div>
				<div class="info">
					<p class="nome">Fulano de tal</p>
					<div class="ultima_mensagem">
						Lorem ipsum dolor sit amet, consectetur...
					</div>
				</div>	
			</div>

			<div class="item">
				<div class="foto">
					<img src="{$url_base}resources/img/user.png">
				</div>
				<div class="info">
					<p class="nome">Fulano de tal</p>
					<div class="ultima_mensagem">
						Lorem ipsum dolor sit amet, consectetur...
					</div>
				</div>	
			</div>
		</div>
	{else}
		{if="$links == true"}
			<div class="links">
				<ul>
					<li><a href="{$url_base}mensagem">Mensgens<span>(2)</a></span></li>
					<li><a href="{$url_base}config">Configurações</a></li>
					<li><a href="{$url_base}fotos">Fotos</a></li>
				</ul>
			</div>
			<div class="quem_sou">
				<form class="form_ajax "action="{$url_base}quem_sou_eu" method="POST">
					<textarea name="quem_sou_eu" placeholder="Quem sou eu" maxlength="160">{$usuarios['descricao_user']}</textarea>
					<input type="submit" name="btn" value="salvar">
					<div class="alerta"></div>
				</form>
			</div>
		{else}
			<div class="quem_ele_e">
				<form>
					<textarea placeholder="Quem é ele(a)"readonly="readonly">{$usuarios['descricao_user']}</textarea>
					
				</form>
			</div>
		{/if}
	{/if}

	
</section>