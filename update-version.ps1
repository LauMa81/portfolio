# Päivittää CSS-versiotunnisteen automaattisesti kaikissa HTML-tiedostoissa
# Käyttö: .\update-version.ps1

$timestamp = Get-Date -Format "yyyyMMddHHmm"
$oldPattern = 'styles\.css\?v=\d+'
$newVersion = "styles.css?v=$timestamp"

Get-ChildItem -Path . -Filter "*.html" | ForEach-Object {
    $content = Get-Content $_.FullName -Raw
    if ($content -match $oldPattern) {
        $content = $content -replace $oldPattern, $newVersion
        Set-Content -Path $_.FullName -Value $content -NoNewline
        Write-Host "✓ Päivitetty: $($_.Name) -> v=$timestamp" -ForegroundColor Green
    }
}

Write-Host "`n✅ Kaikki HTML-tiedostot päivitetty versioon: $timestamp" -ForegroundColor Cyan
