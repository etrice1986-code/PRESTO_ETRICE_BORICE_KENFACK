<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: Arial, sans-serif; color: #1E293B; background-color: #F8FAFC; padding: 20px; }
        .card { background: #ffffff; padding: 30px; border-radius: 12px; max-width: 600px; margin: 0 auto; border: 1px solid #E2E8F0; }
        h2 { color: #2563EB; margin-top: 0; }
        p { line-height: 1.6; margin: 8px 0; }
        .label { font-weight: bold; color: #64748B; }
    </style>
</head>
<body>
    <div class="card">
        <h2>Nuovo messaggio dal modulo contatti</h2>
        <p><span class="label">Nome:</span> {{ $contactData['name'] ?? 'Nessun nome' }}</p>
        <p><span class="label">Email:</span> {{ $contactData['email'] ?? 'Nessuna email' }}</p>
        <p><span class="label">Oggetto:</span> {{ $contactData['subject'] ?? 'Nessun oggetto' }}</p>
        <p><span class="label">Messaggio:</span></p>
        <p style="background: #F1F5F9; padding: 15px; border-radius: 8px; white-space: pre-wrap;">{{ $contactData['message'] ?? 'Nessun messaggio' }}</p>
    </div>
</body>
</html>
