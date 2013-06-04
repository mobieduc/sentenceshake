<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Sentence Shake - Erro</title>
    </head>
    <body>
        <h1>Ocorreu um erro</h1>
        <h2>{$message}</h2>

        {if (isset($exception))}

           <h3>Informação sobre a exceção:</h3>
            <p>
                <b>Mensagem:</b> {$exception->getMessage()}
            </p>

            <h3>Stack trace:</h3>
            <pre>{$exception->getTraceAsString()}
            </pre>

            <h3>Parametros de requisição:</h3>
            <pre>{escape(var_export($request->getParams(), true))}
            </pre>

        {/if}

    </body>
</html>
