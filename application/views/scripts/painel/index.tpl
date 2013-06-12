{extends file="template.tpl"}

{block name=container}
<br /><br /><br />
<p>Olá  {$auth->nome} Você está LOGADO</p>
<br /><br /><br />
<a href='/logout'>Logout</a>

{/block}