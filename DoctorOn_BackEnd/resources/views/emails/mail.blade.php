<html lang="pt">

<head>
    <title>DoctorOn</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>

<body bgcolor="#FFFFFF" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
    <table width="500" height="" border="0" cellpadding="20" cellspacing="0" align="center">
        <tr>
            <td height="60" bgcolor="#48742C " valign="center" align="center">
                <img height="130"
                    src="https://ik.imagekit.io/mnbr5uwksus/DoctorOn/DoctorOn.png?updatedAt=1634255509856">
            </td>
        </tr>
        <tr>
            <td height="120" bgcolor="#ffffff" valign="center" align="center">
                <h2 style="font-size: 20px; font-weight: 500; font-family: 'Arial', sans-serif; color: #000000;">Olá,
                    {{ $user->name }}</h2>
                <h4 style="font-size: 16px; font-weight: 500; font-family: 'Arial', sans-serif; color: #000000;">Você
                    está recebendo este e-mail porque recebemos um reset de senha para sua conta.</h4>
                <p style="font-size: 16px; font-weight: 500; font-family: 'Arial', sans-serif; color: #000000;">Nova
                    senha de acesso: {{ $password }}</p>
                <p style="font-size: 12px; font-family: 'Arial', sans-serif; color: #cdcdcd;">Caso você não tenha
                    solicitado um reset de senha, nenhuma ação é necessária.</p>
            </td>
        </tr>
    </table>
</body>

</html>
