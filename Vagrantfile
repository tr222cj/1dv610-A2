Vagrant.configure(2) do |config|

	# Specify base box
	config.vm.box = "bento/ubuntu-16.04"
	
	# Setup port forwarding
	config.vm.network :forwarded_port, guest: 80, host: 8080

	# Configure synced folders
	config.vm.synced_folder "exercise", "/home/vagrant/exercise"
	
	# Fix TTY error message
	config.vm.provision "fix-no-tty", type: "shell" do |s|
		s.privileged = false
		s.inline = "sudo sed -i '/tty/!s/mesg n/tty -s \\&\\& mesg n/' /root/.profile"
	end
	
	# Provision
	config.vm.provision "shell" do |s|
		s.path = ".provision/setup.sh"
	end
end
