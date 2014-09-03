Vagrant.configure("2") do |config|
	
    # Specify the base box
    # config.vm.box = "lucid32"
    # config.vm.box_url = "http://files.vagrantup.com/lucid32.box"

    config.vm.define :web, primary: true do |web|
        web.vm.box = "lucid32"
        web.vm.network :private_network, ip: "10.0.0.10"
        web.vm.synced_folder "src/", "/var/www", create: true, group: "www-data", owner: "www-data"
        web.vm.provision "shell" do |s|
            s.path = "provision/web.sh"
        end
        config.vm.hostname = "web.dev"
    end

	config.vm.provider "virtualbox" do |v|
		v.memory = 1024
		v.cpus = 1
	end

    # Setup port forwarding
    # config.vm.network :forwarded_port, guest: 80, host: 8080, auto_correct: true
    # config.vm.network :private_network, ip: "192.168.10.10"
    # config.vm.network :public_network
	# web.vm.network :public_network, ip: "192.168.1.101", bridge: 'wlan0'

end