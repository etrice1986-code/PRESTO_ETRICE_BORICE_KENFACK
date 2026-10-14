<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Nuova Candidatura</title>
</head>
<body style="font-family: Arial, sans-serif; line-height: 1.6; color: #333;">
    <div style="max-width: 600px; margin: 0 auto; padding: 20px; border: 1px solid #ddd; border-radius: 8px;">
        <h2 style="color: #0d6efd;">Richiesta Lavora con Noi</h2>
        <p>Un utente ha inviato una richiesta per diventare revisore sulla piattaforma:</p>
        
        <table style="width: 100%; border-collapse: collapse; margin-bottom: 20px;">
            <tr>
                <td style="padding: 8px; border-bottom: 1px solid #ddd; font-weight: bold;">Nome:</td>
                <td style="padding: 8px; border-bottom: 1px solid #ddd;">{{ $user->name }}</td>
            </tr>
            <tr>
                <td style="padding: 8px; border-bottom: 1px solid #ddd; font-weight: bold;">Email:</td>
                <td style="padding: 8px; border-bottom: 1px solid #ddd;">{{ $user->email }}</td>
            </tr>
        </table>

        <h3 style="color: #495057;">Messaggio di presentazione:</h3>
        <p style="background-color: #f8f9fa; padding: 15px; border-left: 4px solid #0d6efd; border-radius: 4px; font-style: italic;">
            "{{ $messageText }}"
        </p>

        <hr style="border: 0; border-top: 1px solid #ddd; margin: 30px 0;">
        <p style="font-size: 12px; color: #6c757d; text-align: center;">
            Questa è una mail automatica generata dal portale Presto.it.
        </p>
    </div>
</body>
</html>
