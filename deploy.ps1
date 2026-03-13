param(
    [Parameter(Mandatory = $true)]
    [string]$Message,

    [string]$ConfigPath = (Join-Path $PSScriptRoot 'deploy.config.json')
)

Set-StrictMode -Version Latest
$ErrorActionPreference = 'Stop'

function Read-DeployConfig {
    param(
        [Parameter(Mandatory = $true)]
        [string]$Path
    )

    if (-not (Test-Path $Path)) {
        throw "Missing deploy.config.json. Copy deploy.config.example.json to deploy.config.json and fill in the values first."
    }

    $raw = Get-Content $Path -Raw
    if (-not $raw.Trim()) {
        throw "deploy.config.json is empty."
    }

    return $raw | ConvertFrom-Json
}

function Invoke-Git {
    param(
        [Parameter(Mandatory = $true, ValueFromRemainingArguments = $true)]
        [string[]]$Arguments
    )

    & git @Arguments
    if ($LASTEXITCODE -ne 0) {
        throw "Git command failed: git $($Arguments -join ' ')"
    }
}

function Invoke-Ssh {
    param(
        [Parameter(Mandatory = $true)]
        [string]$User,

        [Parameter(Mandatory = $true)]
        [string]$Host,

        [Parameter(Mandatory = $true)]
        [int]$Port,

        [Parameter(Mandatory = $true)]
        [string]$Command
    )

    & ssh -p $Port "$User@$Host" $Command
    if ($LASTEXITCODE -ne 0) {
        throw "SSH command failed."
    }
}

function Get-QuotedRemotePath {
    param(
        [Parameter(Mandatory = $true)]
        [string]$Path
    )

    return "'" + ($Path -replace "'", "'\"'\"'") + "'"
}

$config = Read-DeployConfig -Path $ConfigPath

foreach ($required in @('sshUser', 'sshHost', 'sshPort', 'remotePath', 'gitRemote', 'gitBranch')) {
    if (-not $config.$required) {
        throw "deploy.config.json is missing '$required'."
    }
}

Push-Location $PSScriptRoot

try {
    Invoke-Git rev-parse --is-inside-work-tree

    $status = git status --short
    if ($LASTEXITCODE -ne 0) {
        throw "Unable to read git status."
    }

    if ($status) {
        Write-Host "Staging local changes..."
        Invoke-Git add -A
        Write-Host "Creating commit..."
        Invoke-Git commit -m $Message
    } else {
        Write-Host "No local changes to commit. Deploying current HEAD..."
    }

    Write-Host "Pushing to GitHub..."
    Invoke-Git push $config.gitRemote $config.gitBranch

    $remotePath = Get-QuotedRemotePath -Path $config.remotePath
    $remoteCommand = "cd $remotePath && git pull $($config.gitRemote) $($config.gitBranch)"

    Write-Host "Pulling latest code on Hostinger..."
    Invoke-Ssh -User $config.sshUser -Host $config.sshHost -Port ([int]$config.sshPort) -Command $remoteCommand

    Write-Host "Deployment complete."
}
finally {
    Pop-Location
}
