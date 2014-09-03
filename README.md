## Laboratorio de Proyectos - BLOGS - UAL 

### APP Web with Laravel 4 PHP Framework

### INSTALL SOFTWARE

Linux (all apt-get)
- vagrant (1.4.3)
- vagrant-vbguest (0.10.0)
- virtualbox (vagrant)
- git

Windows
- vagrant (https://www.vagrantup.com/downloads.html)
- virtualbox (https://www.virtualbox.org/wiki/Downloads)
- git (http://git-scm.com/downloads)

### DOWNLOAD SOURCE

Download or Clone the repository: https://github.com/jh2odo/lp-blogs-ual.git

Example:
Linux: git clone https://github.com/jh2odo/lp-blogs-ual.git /home/jose/webs/lp-blogs-ual
Windows: Download ZIP in D:\Webs\lp-blogs-ual

- /provision/ -> file configuration vagrant virtual machine
- /src/ -> Source
- /Vagrantfile -> file init vagrant

### CONFIGURATION

Public: Select free IP in your network, example: 192.168.1.101
Private: example: 10.0.0.10

Change IP in 2 files:

- In file hosts in host pc, add (administrator mode): 
10.0.0.10		web.dev
192.168.1.101	web.dev

- Linux: /etc/hosts || Windows: C:\Windows\System32\drivers\etc\hosts

- In Vagrantfile
web.vm.network :public_network, ip: "192.168.1.101" or web.vm.network :private_network, ip: "10.0.0.10"

### INITIAL

1. Start GitBash (Cgywin in Windows) or Terminal (Linux) 
2. Execute the following command:  vagrant box add lucid32 http://files.vagrantup.com/lucid32.box
3. Go to directory to download or clone the repository
4. Execute: vagrant up web
5. Go to navigator: http://web.dev or http://IP/
6. Create and Modify files in src/app/ and src/public to do changes

### VAGRANT MANUAL
- Start: vagrant up web
- Stop: vagrant halt web
- SSH: vagrant ssh web

### PHPMYADMIN
- http://IP/phpmyadmin/
- root/1234



