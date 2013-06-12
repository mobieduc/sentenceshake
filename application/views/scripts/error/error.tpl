{extends file="template.tpl"}

{block name=container}
<h1>Ocorreu um erro</h1>
<h2>{$message}</h2>

{if (isset($exception))}
    <h3>Informação sobre a exceção:</h3>
    <p> <b>Mensagem:</b> {$exception->getMessage()}</p>

    <h3>Stack trace:</h3>
    <pre>{$exception->getTraceAsString()}</pre>

    <h3>Parametros de requisição:</h3>
    <pre>{ escape(var_export($request->getParams(), true))} </pre>
{/if}
{/block}
