# Install the module
```bash
sudo dnf install mod_authnz_pam
# Ubuntu/Debian
# sudo apt install libapache2-mod-authnz-pam
```

# Allow apache to read shadow hashes
```bash
sudo chmod 640 /etc/shadow
sudo chgrp apache /etc/shadow   # Use 'www-data' instead of 'apache' on Ubuntu/Debian
```

# Create a dedicated PAM Service

Create a new configuration file at `/etc/pam.d/httpd-pam`
```
auth    include    system-auth
account include    system-auth
```

# Load the module

Edit `/etc/httpd/conf.modules.d/55-authnz_pam.conf` and uncomment
```
LoadModule authnz_pam_module modules/mod_authnz_pam.so
```

# Configure Apache directory block

Add the configuration directives to the virtual host or main Apache configuration file:
```conf
<Directory /var/www/html/protected>
    AuthType Basic
    AuthName "System Account Login"
    AuthBasicProvider PAM
    AuthPAMService httpd-pam
    Require valid-user
</Directory>
```

# Test
```bash
curl http://[SERVER]:[PORT]/protected/ # This shouldn't be allowed

curl -u "[USER]:[PASSWORD]" http://[SERVER]:[PORT]/protected/
```
