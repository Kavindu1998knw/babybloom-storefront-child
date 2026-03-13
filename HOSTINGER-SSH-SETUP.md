# Hostinger SSH Key Setup

Use this once so `deploy.ps1` can log in without asking for your password every time.

## 1. Create an SSH key on your computer

Open PowerShell and run:

```powershell
ssh-keygen -t ed25519 -C "babybloom-hostinger"
```

Press `Enter` for the default file location.

If you want the deploy script to run without a passphrase prompt, leave the passphrase empty.

This creates:

- private key: `C:\Users\DELL\.ssh\id_ed25519`
- public key: `C:\Users\DELL\.ssh\id_ed25519.pub`

## 2. Copy the public key

Run:

```powershell
Get-Content $env:USERPROFILE\.ssh\id_ed25519.pub
```

Copy the full output.

## 3. Add the public key on Hostinger

Log in to Hostinger over SSH with your password, then run:

```bash
mkdir -p ~/.ssh
chmod 700 ~/.ssh
nano ~/.ssh/authorized_keys
```

Paste the public key as a single line, save, then run:

```bash
chmod 600 ~/.ssh/authorized_keys
```

## 4. Test passwordless login

From PowerShell:

```powershell
ssh -p 65002 u962744879@157.173.208.27
```

If it logs in without asking for the account password, the setup is complete.

## 5. Configure the deploy script

Inside this theme folder:

1. copy `deploy.config.example.json` to `deploy.config.json`
2. update the values if needed

## 6. Deploy future changes

From this folder:

```powershell
.\deploy.ps1 "Describe the change"
```
