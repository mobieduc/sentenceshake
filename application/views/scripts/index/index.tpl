{extends file="template.tpl"}

{block name=container}
<div class='logar'>
    <div class='milk-shake'></div>
    <div class='table'></div>

    <div class='login'>
        <form action='/' name='login' method='post'>
            <label>Email:</label>
            <input type='email' name='email' required />
            <label>Password:</label>
            <input type='password' name='senha' required />
            <input type='submit' name='login' value='log in'>
        </form>
        <span class='forgot-password' >Forgot Password</span>
        <span class='create-account' >Create Account</span>
        {$erro}
    </div><!--login-->

    <div class='lost-password' >
        <form action='' name='lost-password' method='post'>
            <label>Please, insert email to recover password</label>
            <input type='email' name='email' required />
            <input type='submit' name='lost-psw' id='send' value='send'>
        </form>
        <span class='close-psw'>x</span>
    </div><!--lost-password-->

</div><!--logar-->

<div class='cadastro'>
    <form action='/usuario/cadastro' name='cadastro' id='cadastro' method='post'>
        <label>Name:</label>
        <input type='text' name='name'  pattern="[a-zA-Z]+" required/>
        <label>E-mail:</label>
        <input type='email' name='email' required/>
        <label>Password:</label>
        <input type='password' id='password' name='password' required/><span id="result"></span>
        <label>Retype Password:</label>
        <input type='password' id='password-confirm' name='senha-confirmacao' required/><span id='msg-psw'></span>
        <input type='submit' name='register' value='register'>
    </form>
    <span class='close-cadastro'>x</span>
</div>

{/block}